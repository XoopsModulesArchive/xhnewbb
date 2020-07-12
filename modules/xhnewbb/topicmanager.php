<?php
/***************************************************************************
                            topicmanager.php  -  description
                             -------------------
    begin                : Sat June 17 2000
    copyright            : (C) 2001 The phpBB Group
    email                : support@phpbb.com

    $Id: topicmanager.php,v 1.3 2005/02/10 19:04:21 gij Exp $

 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
include "include/common_prepend.php";

if( empty( $topic_id ) ) {
	die(_MD_XHNEWBB_ERRORTOPIC);
}
if( empty( $forum ) ) {
	die(_MD_XHNEWBB_ERRORFORUM);
}

$accesserror = 0;
if ( $xoopsUser ) {
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
		if ( !xhnewbb_is_moderator($forum, $xoopsUser->uid()) ) {
			$accesserror = 1;
		}
	}
} else {
	$accesserror = 1;
}
if ( $accesserror == 1 ) {
	die(_MD_XHNEWBB_YANTMOTFTYCPTF);
}

include XOOPS_ROOT_PATH.'/header.php';
OpenTable();
if ( ! empty( $_POST['submit'] ) ) {
	$newforum = isset( $_POST['newforum'] ) ? intval($_POST['newforum']) : 0 ;
	switch (@$_POST['mode']) {
	case 'del':
		// Update the users's post count, this might be slow on big topics but it makes other parts of the
	    // forum faster so we win out in the long run.
		$sql = "SELECT uid, post_id FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE topic_id = $topic_id";
		if ( !$r = $xoopsDB->query($sql) ) {
			exit(_MD_XHNEWBB_COULDNOTQUERY);
		}
		while ( $row = $xoopsDB->fetchArray($r) ) {
			if ( $row['uid'] != 0 ) {
				$sql = sprintf("UPDATE %s SET posts = posts - 1 WHERE uid = %u", $xoopsDB->prefix("users"), $row['uid']);
	    		$xoopsDB->query($sql);
	 		}
		}

		// Get the post ID's we have to remove.
		$sql = "SELECT post_id FROM ".$xoopsDB->prefix("xhnewbb_posts")." WHERE topic_id = $topic_id";
		if ( !$r = $xoopsDB->query($sql) ) {
			exit(_MD_XHNEWBB_COULDNOTQUERY);
		}
		while ( $row = $xoopsDB->fetchArray($r) ) {
			$posts_to_remove[] = $row['post_id'];
		}
		
		$sql = sprintf("DELETE FROM %s WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_posts"), $topic_id);
		if ( !$result = $xoopsDB->query($sql) ) {
			exit(_MD_XHNEWBB_COULDNOTREMOVE);
		}
		$sql= sprintf("DELETE FROM %s WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_topics"), $topic_id);
		if ( !$result = $xoopsDB->query($sql) ) {
			exit(_MD_XHNEWBB_COULDNOTQUERY);
		}

		// u2t table
		$xoopsDB->query( "DELETE FROM ".$xoopsDB->prefix("xhnewbb_users2topics")." WHERE topic_id = $topic_id" ) ;
		// end of u2t table

		$sql = "DELETE FROM ".$xoopsDB->prefix("xhnewbb_posts_text")." WHERE ";
		$set = false ;
		for ( $x = 0; $x < count($posts_to_remove); $x++ ) {
			if ( $set ) {
				$sql .= " OR ";
			}
			$sql .= "post_id = ".$posts_to_remove[$x];
			$set = true;
		}

		if ( !$xoopsDB->query($sql) ) {
			exit(_MD_XHNEWBB_COULDNOTREMOVETXT);
		}
		xhnewbb_sync($forum, 'forum');
		// RMV-NOTIFY
		xoops_notification_deletebyitem ($xoopsModule->getVar('mid'), 'thread', $topic_id);
		echo _MD_XHNEWBB_TTHBRFTD."<p><a href='".XOOPS_URL."/modules/xhnewbb/viewforum.php?forum=$forum'>"._MD_XHNEWBB_RETURNTOTHEFORUM."</a></p><p><a href='".XOOPS_URL."/modules/xhnewbb/index.php'>"._MD_XHNEWBB_RTTFI."</a></p>";
		break;
	case 'move':
		if ($newforum > 0) {
			$sql = "SELECT * FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id=$newforum" ;
			if ( ! ( $r = $xoopsDB->query($sql) ) || $xoopsDB->getRowsNum($r)!=1 ) {
				exit(_MD_XHNEWBB_EPGBATA);
			}
			$sql = sprintf("UPDATE %s SET forum_id = %u WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_topics"), $newforum, $topic_id);
	    	if ( !$r = $xoopsDB->query($sql) ) {
				exit(_MD_XHNEWBB_EPGBATA);
			}
			$sql = sprintf("UPDATE %s SET forum_id = %u WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_posts"), $newforum, $topic_id);
			if ( !$r = $xoopsDB->query($sql) ) {
				exit(_MD_XHNEWBB_EPGBATA);
			}
			xhnewbb_sync($newforum, 'forum');
			xhnewbb_sync($forum, 'forum');
		}
		echo _MD_XHNEWBB_TTHBM."<p><a href='".XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id'>"._MD_XHNEWBB_VTUT."</a></p><p><a href='".XOOPS_URL."/modules/xhnewbb/index.php'>"._MD_XHNEWBB_RTTFI."</a></p>";
		break;
	case 'lock':
		$sql = sprintf("UPDATE %s SET topic_status = 1 WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_topics"), $topic_id);
	    if ( !$r = $xoopsDB->query($sql) ) {
			exit(_MD_XHNEWBB_EPGBATA);
		}
		echo _MD_XHNEWBB_TTHBL."<p><a href='".XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id'>"._MD_XHNEWBB_VIEWTHETOPIC."</a></p><p><a href='".XOOPS_URL."/modules/xhnewbb/index.php'>"._MD_XHNEWBB_RTTFI."</a></p>";
		break;
	case 'unlock':
		$sql = sprintf("UPDATE %s SET topic_status = 0 WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_topics"), $topic_id);
	    if ( !$r = $xoopsDB->query($sql) ) {
			exit("Error - Could not unlock the selected topic. Please go back and try again.");
		}
		echo _MD_XHNEWBB_TTHBU."<p><a href='".XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id'>"._MD_XHNEWBB_VIEWTHETOPIC."</a></p><p><a href='".XOOPS_URL."/modules/xhnewbb/index.php'>"._MD_XHNEWBB_RTTFI."</a></p>";
		break;
	case 'sticky':
		$sql = sprintf("UPDATE %s SET topic_sticky = 1 WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_topics"), $topic_id);
	    if ( !$r = $xoopsDB->query($sql) ) {
			exit("Error - Could not sticky the selected topic. Please go back and try again.");
		}
		echo _MD_XHNEWBB_TTHBS."<p><a href='".XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id'>"._MD_XHNEWBB_VIEWTHETOPIC."</a></p><p><a href='".XOOPS_URL."/modules/xhnewbb/index.php'>"._MD_XHNEWBB_RTTFI."</a></p>";
		break;
	case 'unsticky':
		$sql = sprintf("UPDATE %s SET topic_sticky = 0 WHERE topic_id = %u", $xoopsDB->prefix("xhnewbb_topics"), $topic_id);
	    if ( !$r = $xoopsDB->query($sql) ) {
			exit("Error - Could not unsticky the selected topic. Please go back and try again.");
		}
		echo _MD_XHNEWBB_TTHBUS."<p><a href='".XOOPS_URL."/modules/xhnewbb/viewtopic.php?topic_id=$topic_id'>"._MD_XHNEWBB_VIEWTHETOPIC."</a></p><p><a href='".XOOPS_URL."/modules/xhnewbb/index.php'>"._MD_XHNEWBB_RTTFI."</a></p>";
		break;
	}
} else {  // No submit
	$mode = @$_GET['mode'];
    echo "<form action='?topic_id=$topic_id' method='post'>
	<table border='0' cellpadding='1' cellspacing='0' align='center' width='95%'><tr><td class='bg2'>
	<table border='0' cellpadding='1' cellspacing='1' width='100%'>
	<tr class='bg3' align='left'>";
	switch ( $mode ) {
	case 'del':
		echo '<td colspan="2">'. _MD_XHNEWBB_OYPTDBATBOTFTTY .'</td>';
		break;
	case 'move':
		echo '<td colspan="2">'._MD_XHNEWBB_OYPTMBATBOTFTTY.'</td>';
		break;
	case 'lock':
		echo '<td colspan="2">'._MD_XHNEWBB_OYPTLBATBOTFTTY.'</td>';
		break;
	case 'unlock':
		echo '<td colspan="2">'._MD_XHNEWBB_OYPTUBATBOTFTTY.'</td>';
		break;
	case 'sticky':
		echo '<td colspan="2">'._MD_XHNEWBB_OYPTSBATBOTFTTY.'</td>';
		break;
	case 'unsticky':
		echo '<td colspan="2">'._MD_XHNEWBB_OYPTTBATBOTFTTY.'</td>';
		break;
	}
	echo '</tr>';

	if ( $mode == 'move' ) {
		echo '<tr>
		<td class="bg3">'._MD_XHNEWBB_MOVETOPICTO.'</td>
		<td class="bg1"><select name="newforum" size="0">';
		$sql = "SELECT forum_id, forum_name FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id != $forum ORDER BY forum_id";
		if ( $result = $xoopsDB->query($sql) ) {
			if ( $myrow = $xoopsDB->fetchArray($result) ) {
				do {
					echo "<option value='".$myrow['forum_id']."'>".$myrow['forum_name']."</option>\n";
				} while ( $myrow = $xoopsDB->fetchArray($result) );
			} else {
				echo "<option value='-1'>"._MD_XHNEWBB_NOFORUMINDB."</option>\n";
			}
		} else {
			echo "<option value='-1'>"._MD_XHNEWBB_DATABASEERROR."</option>\n";
		}
		echo '</select></td></tr>';
	}
	echo '<tr class="bg3">
	<td colspan="2" align="center">';

	switch ( $mode ) {
	case 'del':
		echo '<input type="hidden" name="mode" value="del" />
		<input type="submit" name="submit" value="'._MD_XHNEWBB_DELTOPIC.'" />';
		break;
	case 'move':
		echo '<input type="hidden" name="mode" value="move" />
		<input type="submit" name="submit" value="'._MD_XHNEWBB_MOVETOPIC.'" />';
		break;
	case 'lock':
		echo '<input type="hidden" name="mode" value="lock" />
		<input type="submit" name="submit" value="'._MD_XHNEWBB_LOCKTOPIC.'" />';
		break;
	case 'unlock':
		echo '<input type="hidden" name="mode" value="unlock" />
		<input type="submit" name="submit" value="'._MD_XHNEWBB_UNLOCKTOPIC.'" />';
		break;
	case 'sticky':
		echo "<input type='hidden' name='mode' value='sticky' />
		<input type='submit' name='submit' value='"._MD_XHNEWBB_STICKYTOPIC."' />";
		break;
	case 'unsticky':
		echo "<input type='hidden' name='mode' value='unsticky' />
		<input type='submit' name='submit' value='". _MD_XHNEWBB_UNSTICKYTOPIC."' />";
		break;
	}
	echo '</td></tr>
	</form>
	</table></td></tr></table>';
}
CloseTable();

$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ) ) ;

include XOOPS_ROOT_PATH.'/footer.php';
?>
