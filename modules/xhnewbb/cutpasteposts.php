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

// special permission check for cutpasteposts
if( ! $isadminormod ) die( _NOPERM ) ;

if( ! empty( $_POST['cutpastepostsok'] ) ) {
	// TRANSACTION PART
	$pid = intval( @$_POST['pid'] ) ;
	$children[] = $post_id ;

	if( $pid == 0 ) {
		// create a new topic
		$sql = "INSERT INTO ".$xoopsDB->prefix("xhnewbb_topics")." SET topic_title='".addslashes($forumpost->subject)."', topic_poster='".addslashes($forumpost->uid())."', forum_id='$forum', topic_time=UNIX_TIMESTAMP(), topic_solved=0" ;
		if( ! $xoopsDB->query( $sql ) ) die( _MD_XHNEWBB_DATABASEERROR ) ;
		$new_topic_id = intval( $xoopsDB->getInsertId() ) ;
		$new_forum = $forum ;
		$sql = "UPDATE ".$xoopsDB->prefix("xhnewbb_posts")." SET pid=0 WHERE post_id=$post_id" ;
		if( ! $xoopsDB->query( $sql ) ) die( _MD_XHNEWBB_DATABASEERROR ) ;
	} else {
		// get topic_id from post_id
		$targetpost = new ForumPosts( $pid ) ;
		$pid = intval( $targetpost->postid() ) ;
		// loop check
		if( in_array( $pid , $children ) ) die( _MD_XHNEWBB_ERROR_PIDLOOP ) ;
		$new_forum = intval( $targetpost->forum() ) ;
		if( empty( $pid ) ) die( _MD_XHNEWBB_ERRORPOST ) ;
		$new_topic_id = intval( $targetpost->topic() ) ;
		$sql = "UPDATE ".$xoopsDB->prefix("xhnewbb_posts")." SET pid=$pid WHERE post_id=$post_id" ;
		if( ! $xoopsDB->query( $sql ) ) die( _MD_XHNEWBB_DATABASEERROR ) ;
	}
	foreach( $children as $child_post_id ) {
		$child_post_id = intval( $child_post_id ) ;
		$sql = "UPDATE ".$xoopsDB->prefix("xhnewbb_posts")." SET topic_id=$new_topic_id,forum_id=$new_forum WHERE post_id=$child_post_id" ;
		$xoopsDB->query( $sql ) ;
	}

	xhnewbb_sync( $new_forum , "forum" ) ;
	xhnewbb_sync( $forum , "forum" ) ;
	xhnewbb_sync( $topic_id , "topic" ) ;
	xhnewbb_sync( $new_topic_id , "topic" ) ;

	redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$new_topic_id" , 2 , _MD_XHNEWBB_CUTPASTESUCCESS ) ;
	exit ;

} else {
	// FORM PART
	include XOOPS_ROOT_PATH."/header.php";
	$xoopsOption['template_main'] = 'xhnewbb_cutpasteposts.html' ;

	// references to confirm the post will be cut/paste
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

	$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) , "xoops_pagetitle" => _MD_XHNEWBB_CUTPASTEPOSTS ) ) ;

	include XOOPS_ROOT_PATH.'/footer.php';
}

?>