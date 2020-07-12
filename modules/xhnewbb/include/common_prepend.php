<?php

require '../../mainfile.php' ;
require_once XOOPS_ROOT_PATH.'/modules/xhnewbb/include/functions.php' ;
require_once XOOPS_ROOT_PATH.'/modules/xhnewbb/include/perm_functions.php' ;
require_once XOOPS_ROOT_PATH.'/modules/xhnewbb/class/class.forumposts.php';
require XOOPS_ROOT_PATH.'/modules/xhnewbb/include/config.php' ;

$topic_id = isset($_GET['topic_id']) ? intval($_GET['topic_id']) : 0;
if( $topic_id > 0 ) {
	$forum_result = $xoopsDB->query( "SELECT forum_id FROM ".$xoopsDB->prefix("xhnewbb_topics")." WHERE topic_id = $topic_id" ) ;
	list( $forum ) = $xoopsDB->fetchRow( $forum_result ) ;
	$forum = intval( $forum ) ;
	$_GET['forum'] = $forum ;
}

$viewmode = in_array( @$_GET['viewmode'] , array( 'flat' , 'thread' ) ) ? $_GET['viewmode'] : '' ;
$order = in_array( @$_GET['order'] , array( 'ASC' , 'DESC' ) ) ? $_GET['order'] : '' ;

$myts =& MyTextSanitizer::getInstance() ;

?>