<?php

function xhnewbb_can_user_post_forum( $forumdata , $user = null , $isadminormod = false )
{
	if( ! isset( $user ) ) $user = @$GLOBALS['xoopsUser'] ;

	if( $isadminormod ) return true ;

	if( $forumdata['forum_type'] == 1 ) {
		// PRIVATE FORUM
		if( ! is_object( @$user ) || ! xhnewbb_check_priv_forum_post( $user->getVar('uid') , $forumdata['forum_id'] ) ) {
			return false ;
		}
	} else if( $forumdata['forum_access'] == 3 ) {
		// only admin or moderator can post
		return false ;
	} else if( $forumdata['forum_access'] == 1 ) {
		// users can post (guest cannot)
		if( ! is_object( @$user ) ) return false ;
	} else if( $forumdata['forum_access'] == 2 ) {
		// all users/guests can post
	} else {
		// Invalid forum_type
		return false ;
	}
	return true ;
}


function xhnewbb_get_message_for_post_perm( $forumdata ) 
{
	// message for each forum types
	if( $forumdata['forum_type'] == 1 ) {
		return _MD_XHNEWBB_PRIVATE;
	} else {
		switch( $forumdata['forum_access'] ) {
		  case 1 :
			return _MD_XHNEWBB_REGCANPOST ;
		  case 2 :
			return _MD_XHNEWBB_ANONCANPOST ;
		  case 3 :
			return _MD_XHNEWBB_MODSCANPOST ;
		}
	}
	return '' ;
}


function xhnewbb_get_forums_can_read()
{
	global $xoopsUser ;

	$db =& Database::getInstance() ;

	if( is_object( $xoopsUser ) ) {
		$uid = intval( $xoopsUser->getVar('uid') ) ;
		$member_handler =& xoops_gethandler( 'member' ) ;
		$groups = $member_handler->getGroupsByUser( intval( $uid ) ) ;
		if( ! empty( $groups ) ) $whr = "f.forum_type=0 || fa.`user_id`=$uid || fa.`groupid` IN (".implode(",",$groups).")" ;
		else $whr = "f.forum_type=0 || fa.`user_id`=$uid" ;
	} else {
		$whr = "f.forum_type=0" ;
	}

	$sql = "SELECT distinct f.forum_id FROM ".$db->prefix("xhnewbb_forums")." f LEFT JOIN ".$db->prefix("xhnewbb_forum_access")." fa ON fa.forum_id=f.forum_id WHERE ($whr)" ;
	$result = $db->query( $sql ) ;
	if( $result ) while( list( $forum ) = $db->fetchRow( $result ) ) {
		$ret[] = intval( $forum ) ;
	}

	if( empty( $ret ) ) return array(0) ;
	else return $ret ;
}


function get_users_can_read_forum( $forum )
{
	$db =& Database::getInstance() ;
	$forumid = intval( $forum ) ;
	$uids = array() ;

	$sql = "SELECT `user_id` FROM ".$db->prefix("xhnewbb_forum_access")." WHERE `forum_id`=$forumid AND `user_id` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$uids[] = $uid ;
	}

	$sql = "SELECT distinct g.uid FROM ".$db->prefix("xhnewbb_forum_access")." x , ".$db->prefix("groups_users_link")." g WHERE x.groupid=g.groupid AND x.`forum_id`=$forumid AND x.`groupid` IS NOT NULL" ;
	$result = $db->query( $sql ) ;
	while( list( $uid ) = $db->fetchRow( $result ) ) {
		$uids[] = $uid ;
	}

	return array_unique( $uids ) ;
}


?>