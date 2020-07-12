<?php

if( ! defined('XOOPS_ROOT_PATH') ) exit ;

// variable check
$nosmiley = empty( $nosmiley ) ? 0 : 1 ;
$icon = empty( $icon ) ? 'icon7.gif' : htmlspecialchars( $icon , ENT_QUOTES ) ;
$solved = isset( $solved ) ? $solved : 1 ;
$pid = empty( $pid ) ? 0 : intval( $pid ) ;
$post_id = empty( $post_id ) ? 0 : intval( $post_id ) ;
$topic_id = empty( $topic_id ) ? 0 : intval( $topic_id ) ;
$forum = empty( $forum ) ? 0 : intval( $forum ) ;
$formTitle = empty( $formTitle ) ? '' : $formTitle ;
$guestname4html = empty( $guestname4html ) ? '' : $guestname4html ;
$mode = ! in_array( @$mode , array('newtopic','edit','reply','preview') ) ? 'newtopic' : $mode ;
$allow_html = $forumdata['allow_html'] ;
$nohtml = isset( $nohtml ) ? intval( $nohtml ) : 1 ;

if( is_object( @$xoopsUser ) ) {
	$uid = $xoopsUser->getVar('uid') ;
	$allow_sig = $forumdata['allow_sig'] ;
	$attachsig = isset( $attachsig ) ? intval( $attachsig ) : $xoopsUser->getVar('attachsig') ;
	// notification (what a buggy functions ... :-x
	if( ! empty( $xoopsModuleConfig['notification_enabled'] ) && in_array( 'thread-new_post' , @$xoopsModuleConfig['notification_events'] ) ) {
		$allow_notify = true ;
		if( isset( $notify ) ) {
			$notify = intval( $notify ) ;
		} else {
			$notification_handler =& xoops_gethandler('notification') ;
			if( ! empty( $topic_id ) && $notification_handler->isSubscribed('thread' , $topic_id , 'new_post' , $xoopsModule->getVar('mid') , $uid ) ) {
				$notify = 1;
			} else {
				$notify = 0;
			}
		}
	} else {
		$allow_notify = false ;
		$notify = 0 ;
	}
} else {
	$uid = 0 ;
	$allow_sig = false ;
	$attachsig = 0 ;
	$allow_notify = false ;
	$notify = 0 ;
}

// solved changeable?
if( ! empty( $xoopsModuleConfig['xhnewbb_use_solved'] ) && $isadminormod ) {
	$can_change_solved = true ;
} else {
	$can_change_solved = false ;
}


// dare to set 'template_main' after header.php (for disabling cache)
include XOOPS_ROOT_PATH.'/header.php' ;
$xoopsOption['template_main'] = 'xhnewbb_post_form.html' ;

$xoopsTpl->assign( array(
	'forumdata' => $forumdata ,
	'mode' => $mode ,
	'ispreview' => intval( @$ispreview ) ,
	'formtitle' => $formTitle ,
	'viewmode' => $viewmode ,
	'order' => $order ,
	'message_about_post' => xhnewbb_get_message_for_post_perm( $forumdata ) ,
	'uid' => $uid ,
	'uname' => $uid ? $xoopsUser->getVar('uname') : $guestname4html ,
	'subject' => @$subject4html ,
	'message' => @$message4html ,
	'reference_quote' => @$quote4html ,
	'reference_subject' => @$reference_subject4html ,
	'reference_message' => @$reference_message4html ,
	'reference_name' => @$reference_name4html ,
	'reference_date' => @$reference_date4html ,
	'preview_subject' => @$preview_subject4html ,
	'preview_message' => @$preview_message4html ,
	'icons' => array(
		'icon1.gif' => _MD_XHNEWBB_ALT_ICON1 ,
		'icon2.gif' => _MD_XHNEWBB_ALT_ICON2 ,
		'icon3.gif' => _MD_XHNEWBB_ALT_ICON3 ,
		'icon4.gif' => _MD_XHNEWBB_ALT_ICON4 ,
		'icon5.gif' => _MD_XHNEWBB_ALT_ICON5 ,
		'icon6.gif' => _MD_XHNEWBB_ALT_ICON6 ,
		'icon7.gif' => _MD_XHNEWBB_ALT_ICON7 ,
		) ,
	'icon_selected' => $icon ,
	'pid' => $pid ,
	'post_id' => $post_id ,
	'topic_id' => $topic_id ,
	'forum' => $forum ,
	'can_change_solved' => $can_change_solved ,
	'solved' => $solved ,
	'solved_checked' => $solved ? 'checked="checked"' : '' ,
	'allow_mark' => @$xoopsModuleConfig['xhnewbb_allow_mark'] ,
	'u2t_marked' => intval( @$u2t_marked ) ,
	'u2t_marked_checked' => $u2t_marked ? 'checked="checked"' : '' ,
	'nosmiley' => $nosmiley ,
	'nosmiley_checked' => $nosmiley ? 'checked="checked"' : '' ,
	'allow_sig' => $allow_sig ,
	'attachsig' => $attachsig ,
	'attachsig_checked' => $attachsig ? 'checked="checked"' : '' ,
	'allow_notify' => $allow_notify ,
	'notify' => $notify ,
	'notify_checked' => $notify ? 'checked="checked"' : '' ,
	'allow_html' => $allow_html ,
	'nohtml' => $nohtml ,
	'nohtml_checked' => $nohtml ? 'checked="checked"' : '' ,
	'forum_index_title' => _MD_XHNEWBB_FORUMINDEX ,
	'lang_alltopicsindex' => _MD_XHNEWBB_ALLTOPICSINDEX ,
	'mod_url' => XOOPS_URL.'/modules/xhnewbb' ,
	'img_hotfolder' => $bbImage['newposts_forum'] ,
) ) ;

$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) , "xoops_pagetitle" => $formTitle ) ) ;

include XOOPS_ROOT_PATH.'/footer.php' ;

?>