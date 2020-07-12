<?php
/***************************************************************************
                           functions.php  -  description
                             -------------------
    begin                : Sat June 17 2000
    copyright            : (C) 2001 The phpBB Group
    email                : support@phpbb.com

    $Id: functions.php,v 1.2 2005/02/10 19:04:21 gij Exp $

 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*
 * Gets the total number of topics in a form
 */
function xhnewbb_get_total_topics($forum_id="")
{
	global $xoopsDB;
	if ( $forum_id ) {
		$sql = "SELECT COUNT(*) AS total FROM ".$xoopsDB->prefix("xhnewbb_topics")." WHERE forum_id = $forum_id";
	} else {
		$sql = "SELECT COUNT(*) AS total FROM ".$xoopsDB->prefix("xhnewbb_topics");
	}
	if ( !$result = $xoopsDB->query($sql) ) {
		return _MD_XHNEWBB_ERROR;
	}

	if ( !$myrow = $xoopsDB->fetchArray($result) ) {
		return _MD_XHNEWBB_ERROR;
	}

	return $myrow['total'];
}

/*
 * Returns the total number of posts in the whole system, a forum, or a topic
 * Also can return the number of users on the system.
 */
function xhnewbb_get_total_posts($id, $type)
{
	global $xoopsDB;
	switch ( $type ) {
	case 'users':
		$sql = "SELECT COUNT(*) AS total FROM ".$xoopsDB->prefix("users")." WHERE (uid > 0) AND ( level >0 )";
	    break;
	case 'all':
		$sql = "SELECT COUNT(*) AS total FROM ".$xoopsDB->prefix("xhnewbb_posts");
	    break;
	case 'forum':
		$sql = "SELECT COUNT(*) AS total FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE forum_id = $id";
	    break;
	case 'topic':
		$sql = "SELECT COUNT(*) AS total FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE topic_id = $id";
	    break;
	// Old, we should never get this.
	case 'user':
		exit("Should be using the users.user_posts column for this.");
	}
	if ( !$result = $xoopsDB->query($sql) ) {
		return "ERROR";
	}
	if ( !$myrow = $xoopsDB->fetchArray($result) ) {
		return 0;
	}
	return $myrow['total'];
}

/*
 * Returns the most recent post in a forum, or a topic
 */
function xhnewbb_get_last_post($id, $type)
{
	global $xoopsDB;
	switch ( $type ) {
	case 'time_fix':
		$sql = "SELECT post_time FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE topic_id = $id ORDER BY post_time DESC";
		break;
	case 'forum':
		$sql = "SELECT p.post_time, p.uid, u.uname FROM ".$xoopsDB->prefix("xhnewbb_posts")." p, ".$xoopsDB->prefix("users")." u WHERE p.forum_id = $id AND p.uid = u.uid ORDER BY post_time DESC";
		break;
	case 'topic':
		$sql = "SELECT p.post_time, u.uname FROM ".$xoopsDB->prefix("xhnewbb_posts")." p, ".$xoopsDB->prefix("users")." u WHERE p.topic_id = $id AND p.uid = u.uid ORDER BY post_time DESC";
		break;
	case 'user':
		$sql = "SELECT post_time FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE uid = $id";
	    break;
	}
	if ( !$result = $xoopsDB->query($sql,1,0) ) {
		return _MD_XHNEWBB_ERROR;
	}
	if ( !$myrow = $xoopsDB->fetchArray($result) ) {
		return _MD_XHNEWBB_NOPOSTS;
	}
	if ( ($type != 'user') && ($type != 'time_fix') ) {
		$val = sprintf("%s <br /> %s %s", $myrow['post_time'], _MD_XHNEWBB_BY, $myrow['uname']);
	} else {
		$val = $myrow['post_time'];
	}
	return $val;
}

/*
 * Returns an array of all the moderators of a forum
 */
function xhnewbb_get_moderators($forum_id)
{
	global $xoopsDB;
	$sql = "SELECT u.uid, u.uname FROM ".$xoopsDB->prefix("users")." u, ".$xoopsDB->prefix("xhnewbb_forum_mods")." f WHERE f.forum_id = $forum_id and f.user_id = u.uid";
	//echo $sql;
	if ( !$result = $xoopsDB->query($sql) ) {
		return array();
	}
	if ( !$myrow = $xoopsDB->fetchArray($result) ) {
		return array();
	}
	do {
		$array[] = array($myrow['uid'] => $myrow['uname']);
	} while ( $myrow = $xoopsDB->fetchArray($result) );
	return $array;
}

/*
 * Checks if a user (user_id) is a moderator of a perticular forum (forum_id)
 * Retruns 1 if TRUE, 0 if FALSE or Error
 */
function xhnewbb_is_moderator($forum_id, $user_id)
{
	global $xoopsDB;
	$sql = "SELECT COUNT(*) FROM ".$xoopsDB->prefix("xhnewbb_forum_mods")." WHERE forum_id = $forum_id AND user_id = $user_id";
	$ret = false;
	if ( $result = $xoopsDB->query($sql) ) {
		if ( $myrow = $xoopsDB->fetchRow($result) ) {
			if ( $myrow[0] > 0 ) {
				$ret = true;
			}
		}
	}
	return $ret;
}

/*
 * Checks if a topic is locked
 */
function xhnewbb_is_locked($topic)
{
	global $xoopsDB;
	$ret = false;
	$sql = "SELECT topic_status FROM ".$xoopsDB->prefix("xhnewbb_topics")." WHERE topic_id = $topic";
	if ( $r = $xoopsDB->query($sql) ) {
		if ( $m = $xoopsDB->fetchArray($r) ) {
			if ( $m['topic_status'] == 1 ) {
				$ret = true;
			}
		}
	}
	return $ret;
}

function xhnewbb_check_priv_forum_read( $userid , $forumid )
{
	$userid = intval( $userid ) ;
	$db =& Database::getInstance() ;

	$member_handler =& xoops_gethandler( 'member' ) ;
	$groups = $member_handler->getGroupsByUser( intval( $userid ) ) ;

	$sql = "SELECT count(*) FROM ".$db->prefix("xhnewbb_forum_access")." WHERE (`user_id`=$userid || `groupid` IN (".implode(",",$groups).") ) AND `forum_id`=$forumid";

	@list( $count ) = $db->fetchRow( $db->query( $sql ) ) ;

	if( empty( $count ) ) return false ;
	else return true ;
}

function xhnewbb_check_priv_forum_post( $userid , $forumid )
{
	$userid = intval( $userid ) ;
	$db =& Database::getInstance() ;

	$member_handler =& xoops_gethandler( 'member' ) ;
	$groups = $member_handler->getGroupsByUser( intval( $userid ) ) ;

	$sql = "SELECT count(*) FROM ".$db->prefix("xhnewbb_forum_access")." WHERE (`user_id`=$userid || `groupid` IN (".implode(",",$groups).") ) AND `forum_id`=$forumid AND can_post=1";

	@list( $count ) = $db->fetchRow( $db->query( $sql ) ) ;

	if( empty( $count ) ) return false ;
	else return true ;
}

function xhnewbb_make_jumpbox($selected=0)
{
	global $xoopsDB;
	$myts = MyTextSanitizer::getInstance();
	$box = '<form action="viewforum.php" method="get">
	<select name="forum">
	';
	$sql = 'SELECT cat_id, cat_title FROM '.$xoopsDB->prefix('xhnewbb_categories').' ORDER BY cat_order';
	if ( $result = $xoopsDB->query($sql) ) {
		$myrow = $xoopsDB->fetchArray($result);
		$myrow['cat_title'] = $myts->makeTboxData4Show($myrow['cat_title']);
		do {
			$box .= '<option value="-1">________________</option>';
			$box .= '<option value="-1">'.$myrow['cat_title'].'</option>';
			//$box .= "<option value=\"-1\">----------------</option>\n";
			$sub_sql = "SELECT forum_id, forum_name FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE cat_id ='".$myrow['cat_id']."' ORDER BY forum_id";
			if ( $res = $xoopsDB->query($sub_sql) ) {
				if ( $row = $xoopsDB->fetchArray($res) ) {
					do {
						$name = $myts->makeTboxData4Show($row['forum_name']);
						$box .= "<option value='".$row['forum_id']."'";
						if ( !empty($selected) && $row['forum_id'] == $selected ) {
							$box .= ' selected="selected"';
						}
						$box .= ">&nbsp;&nbsp;- $name</option>\n";
					} while ( $row = $xoopsDB->fetchArray($res) );
				}
			} else {
				$box .= "<option value=\"0\">ERROR</option>\n";
			}
		} while ( $myrow = $xoopsDB->fetchArray($result) );
	} else {
		$box .= "<option value=\"-1\">ERROR</option>\n";
	}
	$box .= "</select>\n<input type=\"submit\" class=\"formButton\" value=\""._MD_XHNEWBB_GO."\" />\n</form>";
	return $box;
}

function xhnewbb_sync($id, $type)
{
	global $xoopsDB;
	$id = intval( $id ) ;
	switch ( $type ) {
	case 'forum':
		$sql = "SELECT MAX(post_id) AS last_post FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE forum_id = $id";
   		if ( !$result = $xoopsDB->query($sql) ) {
			exit("Could not get post ID");
		}
   		if ( $row = $xoopsDB->fetchArray($result) ) {
			$last_post = $row['last_post'];
   		}

   		$sql = "SELECT COUNT(post_id) AS total FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE forum_id = $id";
   		if ( !$result = $xoopsDB->query($sql) ) {
			exit("Could not get post count");
   		}
   		if ( $row = $xoopsDB->fetchArray($result) ) {
			$total_posts = $row['total'];
   		}

   		$sql = "SELECT COUNT(topic_id) AS total FROM ".$xoopsDB->prefix("xhnewbb_topics")." WHERE forum_id = $id";
   		if ( !$result = $xoopsDB->query($sql) ) {
			exit("Could not get topic count");
   		}
   		if ( $row = $xoopsDB->fetchArray($result) ) {
			$total_topics = $row['total'];
   		}

		$sql = sprintf("UPDATE %s SET forum_last_post_id = %u, forum_posts = %u, forum_topics = %u WHERE forum_id = %u", $xoopsDB->prefix("xhnewbb_forums"), $last_post, $total_posts, $total_topics, $id);
   		if ( !$result = $xoopsDB->queryF($sql) ) {
			exit("Could not update forum $id");
   		}
		break;
	case 'topic':
		$sql = "SELECT MAX(post_id),COUNT(post_id) FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE topic_id = $id";
   		if ( !$result = $xoopsDB->query($sql) ) {
			exit("Could not get post ID");
		}
		list( $last_post_id , $total_posts ) = $xoopsDB->fetchRow($result) ;

   		if ( $last_post_id > 0 ) {
			$sql = "SELECT post_time FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE post_id = $last_post_id";
	   		if ( !$result = $xoopsDB->query($sql) ) {
				exit("Could not get post ID");
			}
			list( $topic_time ) = $xoopsDB->fetchRow($result) ;

			$sql = "UPDATE ".$xoopsDB->prefix("xhnewbb_topics")." SET topic_replies = ".($total_posts-1).", topic_last_post_id = $last_post_id, topic_time=$topic_time WHERE topic_id = $id" ;
   			if ( !$result = $xoopsDB->queryF($sql) ) {
				exit("Could not update topic $id");
   			}
		}
		break;
	case 'all forums':
		$sql = "SELECT forum_id FROM ".$xoopsDB->prefix("xhnewbb_forums");
   		if ( !$result = $xoopsDB->query($sql) ) {
			exit("Could not get forum IDs");
   		}
   		while ( $row = $xoopsDB->fetchArray($result) ) {
			$id = $row['forum_id'];
			xhnewbb_sync($id, "forum");
		}
		break;
	case 'all topics':
		$sql = "SELECT topic_id FROM ".$xoopsDB->prefix("xhnewbb_topics");
	    if ( !$result = $xoopsDB->query($sql) ) {
			exit("Could not get topic ID's");
		}
		while ( $row = $xoopsDB->fetchArray($result) ) {
			$id = $row['topic_id'];
   			xhnewbb_sync($id, "topic");
   		}
		break;
	}
	return true;
}

?>