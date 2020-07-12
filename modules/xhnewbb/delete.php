<?php

include dirname(__FILE__).'/include/common_prepend.php';

// process and check by $_GET['post_id']
include dirname(__FILE__).'/include/process_postid2forum.inc.php' ;

// process and check by $forum
include dirname(__FILE__).'/include/process_forum2postperm.inc.php' ;

// count children
include_once XOOPS_ROOT_PATH."/class/xoopstree.php" ;
$mytree = new XoopsTree( $xoopsDB->prefix("xhnewbb_posts") , "post_id" , "pid" ) ;
$children = $mytree->getAllChildId( $post_id ) ;

// special permission check for delete
if( ! is_object( @$xoopsUser ) ) die( _MD_XHNEWBB_DELNOTALLOWED ) ;
$uid = $xoopsUser->getVar('uid') ;

if( $isadminormod ) {
	// admin delete
	// ok
} else if( $uid == $forumpost->uid() && $xoopsModuleConfig['xhnewbb_selfdellimit'] > 0 ) {
	// self delete
	if( time() < $forumpost->posttime() + intval( $xoopsModuleConfig['xhnewbb_selfdellimit'] ) ) {
		// before time limit
		include_once XOOPS_ROOT_PATH."/class/xoopstree.php" ;
		$mytree = new XoopsTree( $xoopsDB->prefix("xhnewbb_posts") , "post_id" , "pid" ) ;
		if( count( $children ) > 0 ) {
			// child(ren) exist(s)
			redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&viewmode=$viewmode&order=$order" , 2 , _MD_XHNEWBB_DELCHILDEXISTS ) ;
			exit ;
		} else {
			// all green for self delete
			$isadminormod = false ;
		}
	} else {
		// after time limit
		redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&viewmode=$viewmode&order=$order" , 2 , _MD_XHNEWBB_DELTIMELIMITED ) ;
		exit ;
	}
} else {
	// no perm
	die( _MD_XHNEWBB_DELNOTALLOWED ) ;
}


if( ! empty( $_POST['deletepostsok'] ) ) {
	// TRANSACTION PART
	$forumpost->delete() ;
	xhnewbb_sync( $forumpost->forum() , "forum" ) ;
	xhnewbb_sync( $forumpost->topic() , "topic" ) ;

	if( $forumpost->istopic() ) {
		redirect_header( XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=$forum" , 2 , _MD_XHNEWBB_POSTSDELETED ) ;
		exit ;
	} else {
		redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id&viewmode=$viewmode&order=$order" , 2 , _MD_XHNEWBB_POSTSDELETED ) ;
		exit ;
	}

} else {
	// FORM PART
	include XOOPS_ROOT_PATH."/header.php";
	$xoopsOption['template_main'] = 'xhnewbb_delete.html' ;

	// references to confirm the post will be deleted
	$reference_message4html = $forumpost->text('Show');
	$reference_date4html = formatTimestamp( $forumpost->posttime() ) ;
	$reference_name4html = $forumpost->uid() ? XoopsUser::getUnameFromId( $forumpost->uid() ) : $xoopsConfig['anonymous'] ;
	$reference_subject4html = $forumpost->subject('Show');

	$xoopsTpl->assign( array(
		'post_id' => $post_id ,
		'topic_id' => $topic_id ,
		'forum' => $forum ,
		'forumdata' => $forumdata ,
		'reference_subject' => @$reference_subject4html ,
		'reference_message' => @$reference_message4html ,
		'reference_name' => @$reference_name4html ,
		'reference_date' => @$reference_date4html ,
		'children_count' => count( $children ) ,
		'forum_index_title' => _MD_XHNEWBB_FORUMINDEX ,
		'lang_alltopicsindex' => _MD_XHNEWBB_ALLTOPICSINDEX ,
		'mod_url' => XOOPS_URL.'/modules/xhnewbb' ,
		'img_hotfolder' => $bbImage['newposts_forum'] ,
	) ) ;

	$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) , "xoops_pagetitle" => _DELETE ) ) ;

	include XOOPS_ROOT_PATH.'/footer.php';
}

?>