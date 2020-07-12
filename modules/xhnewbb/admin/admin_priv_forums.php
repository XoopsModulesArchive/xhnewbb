<?php

include '../../../include/cp_header.php' ;
include dirname(dirname(__FILE__)).'/include/functions.php' ;
include dirname(dirname(__FILE__)).'/include/config.php' ;
$myts =& MyTextSanitizer::getInstance() ;
$db =& Database::getInstance() ;


// get $forum
$forum = intval( @$_GET['forum'] ) ;
list( $forum_type ) = $db->fetchRow( $db->query( "SELECT forum_type FROM ".$db->prefix("xhnewbb_forums")." WHERE forum_id=$forum" ) ) ;
if( $forum_type != 1 ) {
	list( $forum ) = $db->fetchRow( $db->query( "SELECT MIN(forum_id) FROM ".$db->prefix("xhnewbb_forums")." WHERE forum_type=1" ) ) ;
	if( empty( $forum ) ) die( _MD_XHNEWBB_A_NFID . ' (no private)'  ) ;
}

//
// transaction stage
//

// group update
if( ! empty( $_POST['group_update'] ) ) {
	$db->query( "DELETE FROM ".$db->prefix("xhnewbb_forum_access")." WHERE forum_id=$forum AND groupid>0" ) ;
	$result = $db->query( "SELECT groupid FROM ".$db->prefix("groups")." WHERE groupid <> ".intval(XOOPS_GROUP_ANONYMOUS) ) ;
	while( list( $gid ) = $db->fetchRow( $result ) ) {
		if( ! empty( $_POST['can_posts'][$gid] ) ) {
			$db->query( "INSERT INTO ".$db->prefix("xhnewbb_forum_access")." SET forum_id=$forum, groupid=$gid, can_post=1" ) ;
		} else if( ! empty( $_POST['can_reads'][$gid] ) ) {
			$db->query( "INSERT INTO ".$db->prefix("xhnewbb_forum_access")." SET forum_id=$forum, groupid=$gid, can_post=0" ) ;
		}
	}
	redirect_header( 'admin_priv_forums.php?forum='.$forum , 3 , _MD_XHNEWBB_A_FORUMUPDATED ) ;
	exit ;
}

// user update
if( ! empty( $_POST['user_update'] ) ) {
	$db->query( "DELETE FROM ".$db->prefix("xhnewbb_forum_access")." WHERE forum_id=$forum AND user_id>0" ) ;
	$can_posts = is_array( @$_POST['can_posts'] ) ? $_POST['can_posts'] : array() ;
	$can_reads = is_array( @$_POST['can_reads'] ) ? $_POST['can_reads'] + $can_posts : $can_posts ;

	foreach( $can_reads as $uid => $val ) {
		$uid = intval( $uid ) ;
		if( ! empty( $can_posts[ $uid ] ) ) {
			$db->query( "INSERT INTO ".$db->prefix("xhnewbb_forum_access")." SET forum_id=$forum, user_id=$uid, can_post=1" ) ;
		} else if( $val ) {
			$db->query( "INSERT INTO ".$db->prefix("xhnewbb_forum_access")." SET forum_id=$forum, user_id=$uid, can_post=0" ) ;
		}
	}
	
	$member_hander =& xoops_gethandler( 'member' ) ;
	if( is_array( @$_POST['new_uids'] ) ) foreach( $_POST['new_uids'] as $i => $uid ) {
		$can_post = empty( $_POST['new_posts'][$i] ) ? 0 : 1 ;
		if( empty( $uid ) ) {
			$criteria =& new Criteria( 'uname' , addslashes( @$_POST['new_unames'][$i] ) ) ;
			@list( $user ) = $member_handler->getUsers( $criteria ) ;
		} else {
			$user =& $member_handler->getUser( intval( $uid ) ) ;
		}
		if( is_object( $user ) ) {
			$db->query( "INSERT INTO ".$db->prefix("xhnewbb_forum_access")." SET forum_id=$forum, user_id=".$user->getVar('uid').", can_post=$can_post" ) ;
		}
	}
	
	redirect_header( 'admin_priv_forums.php?forum='.$forum , 3 , _MD_XHNEWBB_A_FORUMUPDATED ) ;
	exit ;
}



//
// form stage
//

// forum selection
$result = $db->query( "SELECT forum_id,forum_name FROM ".$db->prefix("xhnewbb_forums")." WHERE forum_type=1" ) ;
$forum_options = '' ;
while( list( $id , $name ) = $db->fetchRow( $result ) ) {
	$selected = $id == $forum ? "selected='selected'" : "" ;
	$forum_options .= "<option value='$id' $selected>".htmlspecialchars( $name )."</option>\n" ;
}

// create group form
$group_handler =& xoops_gethandler( 'group' ) ;
$groups =& $group_handler->getObjects() ;
$group_trs = '' ;
foreach( $groups as $group ) {
	$gid = $group->getVar('groupid') ;

	// skip guest access
	if( $gid == XOOPS_GROUP_ANONYMOUS ) continue ;

	$fars = $db->query( "SELECT can_post FROM ".$db->prefix("xhnewbb_forum_access")." WHERE groupid=".$group->getVar('groupid')." AND forum_id=$forum" ) ;
	if( $db->getRowsNum( $fars ) > 0 ) {
		$can_read = true ;
		list( $can_post ) = $db->fetchRow( $fars ) ;
	} else {
		$can_post = $can_read = false ;
	}

	$can_read_checked = $can_read ? "checked='checked'" : "" ;
	$can_post_checked = $can_post ? "checked='checked'" : "" ;
	$group_trs .= "
		<tr>
			<td class='even'>".$group->getVar('name')."</td>
			<td class='even'><input type='checkbox' name='can_reads[$gid]' value='1' $can_read_checked /></td>
			<td class='even'><input type='checkbox' name='can_posts[$gid]' value='1' $can_post_checked /></td>
		</tr>\n" ;
}


// create user form
$fars = $db->query( "SELECT u.uid,u.uname,fa.can_post FROM ".$db->prefix("xhnewbb_forum_access")." fa LEFT JOIN ".$db->prefix("users")." u ON fa.user_id=u.uid WHERE fa.forum_id=$forum AND fa.groupid IS NULL ORDER BY u.uid ASC" ) ;
$user_trs = '' ;
while( list( $uid , $uname , $can_post ) = $db->fetchRow( $fars ) ) {

	$uid = intval( $uid ) ;
	$uname4disp = htmlspecialchars( $uname , ENT_QUOTES ) ;

	$can_post_checked = $can_post ? "checked='checked'" : "" ;
	$user_trs .= "
		<tr>
			<td class='even'>$uid</td>
			<td class='even'>$uname4disp</td>
			<td class='even'><input type='checkbox' name='can_reads[$uid]' value='1' checked='checked' /></td>
			<td class='even'><input type='checkbox' name='can_posts[$uid]' value='1' $can_post_checked /></td>
		</tr>\n" ;
}


// create new user form
$newuser_trs = '' ;
for( $i = 0 ; $i < 5 ; $i ++ ) {
	$newuser_trs .= "
		<tr>
			<td class='head'><input type='text' size='4' name='new_uids[$i]' value='' /></th>
			<td class='head'><input type='text' size='12' name='new_unames[$i]' value='' /></th>
			<td class='head'><input type='checkbox' name='new_reads[$i]' checked='checked' disabled='disabled' /></th>
			<td class='head'><input type='checkbox' name='new_posts[$i]' /></th>
		</tr>
	\n" ;
}


//
// display stage
//

xoops_cp_header();
include dirname(__FILE__).'/mymenu.php' ;

// forum selection
echo "
	<form action='' method='get' style='margin: 20px 0px'>
		"._MD_XHNEWBB_A_SAFTE.":
		<select name='forum'>$forum_options</select>
		<input type='submit' value='"._SUBMIT."' />
	</form>
" ;

// show group form
echo "
	<form action='?forum=$forum' method='post' style='margin:20px 0px'>
	"._MD_XHNEWBB_A_GROUPPERMS."
	<table class='outer'>
		<tr>
			<th>"._MD_XHNEWBB_A_TH_GROUPNAME."</th>
			<th>"._MD_XHNEWBB_A_TH_CAN_READ."</th>
			<th>"._MD_XHNEWBB_A_TH_CAN_POST."</th>
		</tr>
		$group_trs
	</table>
	<input type='submit' name='group_update' value='"._SUBMIT."' />
	</form>
" ;

// show user form
echo "
	<form action='?forum=$forum' method='post' style='margin:20px 0px'>
	"._MD_XHNEWBB_A_UWA."
	<table class='outer'>
		<tr>
			<th>"._MD_XHNEWBB_A_TH_UID."</th>
			<th>"._MD_XHNEWBB_A_TH_UNAME."</th>
			<th>"._MD_XHNEWBB_A_TH_CAN_READ."</th>
			<th>"._MD_XHNEWBB_A_TH_CAN_POST."</th>
		</tr>
		$user_trs
		$newuser_trs
	</table>
	<input type='submit' name='user_update' value='"._SUBMIT."' />
	<br />
	"._MD_XHNEWBB_A_NOTICE_ADDUSERS."
	</form>
" ;

xoops_cp_footer();
?>