<?php

include dirname(__FILE__).'/include/common_prepend.php' ;

if( ! empty( $_POST['post_id'] ) ) {

	// EDIT
	$_GET['post_id'] = intval( $_POST['post_id'] ) ;
	// process and check by $_GET['post_id']
	include dirname(__FILE__).'/include/process_postid2forum.inc.php' ;
	$pid = 0 ;
	$mode = 'edit' ;

} else if( ! empty( $_POST['pid'] ) ) {

	// REPLY
	$_GET['post_id'] = intval( $_POST['pid'] ) ;
	// process and check by $_GET['post_id']
	include dirname(__FILE__).'/include/process_postid2forum.inc.php' ;
	$pid = $post_id ;
	$post_id = 0 ;
	$mode = 'reply' ;

} else {

	// NEWTOPIC
	$forum = intval( @$_POST['forum'] ) ;
	$topic_id = 0 ;
	$post_id = 0 ;
	$pid = 0 ;
	$mode = 'newtopic' ;

}

// process and check by $forum
include dirname(__FILE__).'/include/process_forum2postperm.inc.php' ;

// GIJ Patch for security
if( empty( $forumdata['allow_html'] ) ) $_POST['nohtml'] = 1 ;
$_POST['icon'] = preg_match( '/^icon[1-7]\.gif$/' , @$_POST['icon'] ) ? $_POST['icon'] : 'icon7.gif' ;

// check edit permission
if( $mode == 'edit' ) {
	if( ! is_object( $xoopsUser ) ) die( _MD_XHNEWBB_EDITNOTALLOWED ) ;
	else if( ! $isadminormod && ( $forumpost->uid() != $xoopsUser->getVar('uid') || time() >= $forumpost->posttime() + $xoopsModuleConfig['xhnewbb_selfeditlimit'] ) ) die( _MD_XHNEWBB_EDITNOTALLOWED ) ;
}


if( !empty($_POST['contents_preview']) ) {

	//
	// PREVIEW
	//

	if( $mode == 'reply' ) {
		// references to post reply
		$reference_message4html = $forumpost->text('Show');
		$reference_date4html = formatTimestamp( $forumpost->posttime() ) ;
		$reference_name4html = $forumpost->uid() ? XoopsUser::getUnameFromId( $forumpost->uid() ) : $xoopsConfig['anonymous'] ;
		$reference_subject4html = $forumpost->subject('Show');
	}

	// user's post data
	$preview_subject4html = $myts->makeTboxData4Preview( @$_POST['subject'] ) ;
	$preview_message4html = $myts->previewTarea( $_POST['message'] , intval( ! @$_POST['nohtml'] ) , intval( ! @$_POST['nosmiley'] ) , 1 , @$GLOBALS['xoopsModuleConfig']['xhnewbb_allow_textimg'] ) ;
	$subject4html = $myts->makeTboxData4PreviewInForm( @$_POST['subject'] ) ;
	$message4html = $myts->makeTareaData4PreviewInForm( @$_POST['message'] ) ;
	$guestname4html = $myts->makeTboxData4PreviewInForm( @$_POST['guestname'] ) ;
	$quote4html = $myts->makeTboxData4PreviewInForm( @$_POST['reference_quote'] ) ;
	$icon = @$_POST['icon'] ;
	// options
	$nosmiley = empty( $_POST['nosmiley'] ) ? 0 : 1 ;
	$nohtml = empty( $_POST['nohtml'] ) ? 0 : 1 ;
	$notify = empty( $_POST['notify'] ) ? 0 : 1 ;
	$attachsig = empty( $_POST['attachsig'] ) ? 0 : 1 ;
	$solved = empty( $_POST['solved'] ) ? 0 : 1 ;
	$u2t_marked = empty( $_POST['u2t_marked'] ) ? 0 : 1 ;

	$formTitle = _MD_XHNEWBB_FORMTITLEINPREVIEW ;
	switch( $mode ) {
		case 'edit' : $formTitle .= ' ('._MD_XHNEWBB_EDITMODEC.')' ; break ;
		case 'reply' : $formTitle .= ' ('._MD_XHNEWBB_REPLY.')' ; break ;
		case 'newtopic' : $formTitle .= ' ('._MD_XHNEWBB_POST.')' ; break ;
	}
	$ispreview = true ;

	include dirname(__FILE__).'/include/display_post_form.inc.php' ;

} else {

	//
	// POST
	//

	if( $mode != 'edit' ) {
		// NEWTOPIC or REPLY
		if( is_object( @$xoopsUser ) ) {
			// user's post
			$uid = $xoopsUser->getVar('uid') ;
		} else {
			// guest's post
			$uid = 0 ;
			// Insert guest name into the top of message (origined from Ryuji)
			if( ! empty( $_POST['guestname'] ) ) {
				$_POST['message'] = sprintf( _MD_XHNEWBB_FMT_GUESTSPOSTHEADER , $_POST['guestname'] ) . @$_POST['message'] ;
			}
		}
		$forumpost = new ForumPosts() ;
		$forumpost->setForum( $forum ) ;
		if( $mode == 'reply' ) {
			$forumpost->setParent( $pid ) ;
			$forumpost->setTopicId( $topic_id ) ;
		}
		$forumpost->setIp( @$_SERVER['REMOTE_ADDR'] ) ;
		$forumpost->setUid( $uid ) ;
	}

	$subject = xoops_trim( @$_POST['subject'] ) ;
	$subject = $subject ? $subject : _NOTITLE ;
	$icon = preg_match( '/^icon[1-7]\.gif$/' , @$_POST['icon'] ) ? $_POST['icon'] : 'icon7.gif' ;
	$solved = empty( $_POST['solved'] ) ? 0 : 1 ;
	$forumpost->setSubject( $subject ) ;
	$forumpost->setText( @$_POST['message'] ) ;
	$forumpost->setNohtml( @$_POST['nohtml'] ) ;
	$forumpost->setNosmiley( @$_POST['nosmiley'] ) ;
	$forumpost->setIcon( $icon ) ;
	if( ! empty( $xoopsModuleConfig['xhnewbb_use_solved'] ) && $isadminormod ) {
		$forumpost->setSolved( @$_POST['solved'] ) ;
	}
	if( $forumdata['allow_sig'] ) {
		$forumpost->setAttachsig( @$_POST['attachsig'] ) ;
	} else {
		$forumpost->setAttachsig( 0 ) ;
	}
	// insert
	if( ! $post_id = $forumpost->store() ) die( 'Could not insert forum post' ) ;

	// increment post
	if( is_object( @$xoopsUser ) && $mode != 'edit' ) {
		$xoopsUser->incrementPost() ;
	}

	// set u2t_marked
	$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
	$topic_id = $forumpost->topic() ;
	$u2t_marked = empty( $_POST['u2t_marked'] ) ? 0 : 1 ;
	if( ! empty( $xoopsModuleConfig['xhnewbb_allow_mark'] ) && $uid > 0 ) {
		$xoopsDB->query( "UPDATE ".$xoopsDB->prefix("xhnewbb_users2topics")." SET u2t_marked=$u2t_marked , u2t_time=".time()." WHERE uid='$uid' AND topic_id='$topic_id'" ) ;
		if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->query( 'INSERT INTO '.$xoopsDB->prefix('xhnewbb_users2topics')." SET uid='$uid',topic_id='$topic_id',u2t_marked=$u2t_marked , u2t_time=".time() ) ;
	}

	// RMV-NOTIFY
	// Define tags for notification message
	$tags = array();
	$tags['POSTER_UNAME'] = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uname') : _GUESTS ;
	$tags['THREAD_NAME'] = $_POST['subject'];
	$tags['THREAD_URL'] = XOOPS_URL . "/modules/" . $xoopsModule->dirname() . "/viewtopic.php?post_id=$post_id&topic_id=" . $forumpost->topic() ;
	$tags['POST_URL'] = $tags['THREAD_URL'] . '#forumpost' . $post_id ;
	include_once XOOPS_ROOT_PATH.'/modules/xhnewbb/include/notification.inc.php' ;
	$forum_info = xhnewbb_notify_iteminfo( 'forum' , $forum ) ;
	$tags['FORUM_NAME'] = $forum_info['name'] ;
	$tags['FORUM_URL'] = $forum_info['url'] ;
	$notification_handler =& xoops_gethandler('notification') ;
	if( $mode != 'edit' ) {
		if ( $forumdata['forum_type'] == 1 ) {
			// PRIVATE FORUM
			require_once dirname(__FILE__).'/include/perm_functions.php' ;
			$users2notify = get_users_can_read_forum( $forum ) ;
			if( empty( $users2notify ) ) $users2notify = array( 0 ) ;
		} else {
			// PUBLIC FORUM
			$users2notify = array() ;
		}
		if( $mode == 'reply' ) {
			// Notify of new thread
			$notification_handler->triggerEvent('forum', $forum, 'new_thread', $tags , $users2notify );
		} else {
			// Notify of new post
			$notification_handler->triggerEvent('thread', $topic_id, 'new_post', $tags , $users2notify );
		}
		$notification_handler->triggerEvent('global', 0, 'new_post', $tags , $users2notify );
		$notification_handler->triggerEvent('forum', $forum, 'new_post', $tags , $users2notify );
		$tags['POST_CONTENT'] = $myts->stripSlashesGPC($_POST['message']);
		$tags['POST_NAME'] = $myts->stripSlashesGPC($_POST['subject']);
		$notification_handler->triggerEvent('global', 0, 'new_fullpost', $tags , $users2notify );
	}

	// If user checked notification box, subscribe them to the
	// appropriate event; if unchecked, then unsubscribe
	if( ! empty( $xoopsUser ) && ! empty( $xoopsModuleConfig['notification_enabled']) && in_array( 'thread-new_post' , @$xoopsModuleConfig['notification_events'] ) ) {
		if (!empty($_POST['notify'])) {
			$notification_handler->subscribe('thread', $forumpost->getTopicId(), 'new_post');
		} else {
			$notification_handler->unsubscribe('thread', $forumpost->getTopicId(), 'new_post');
		}
	}

	$post_id = $forumpost->postid();
	redirect_header( XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=".$forumpost->topic()."&amp;post_id=$post_id&amp;viewmode=$viewmode&amp;order=$order#forumpost$post_id" , 2 , $mode == 'edit' ? _MD_XHNEWBB_THANKSEDIT : _MD_XHNEWBB_THANKSSUBMIT ) ;
	exit ;
}

?>