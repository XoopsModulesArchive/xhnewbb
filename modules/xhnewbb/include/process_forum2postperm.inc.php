<?php

if( ! defined('XOOPS_ROOT_PATH') ) exit ;

// getting (array)$forumdata from (int)$forum 
$sql = "SELECT * FROM ".$xoopsDB->prefix("xhnewbb_forums")." WHERE forum_id = $forum";
if( ! $result = $xoopsDB->query( $sql ) ) die( _MD_XHNEWBB_ERROROCCURED ) ;
$forumdata = $xoopsDB->fetchArray( $result ) ;

// get $isadminormod
$isadminormod = is_object( @$xoopsUser ) && ( $xoopsUser->isAdmin() || xhnewbb_is_moderator( $forum , $xoopsUser->getVar('uid') ) ) ? true : false ;

// check permission to post
if( ! xhnewbb_can_user_post_forum( $forumdata , $xoopsUser , $isadminormod ) ) die( _MD_XHNEWBB_NORIGHTTOPOST ) ;

?>