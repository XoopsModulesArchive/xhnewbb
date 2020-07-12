<?php

include dirname(__FILE__).'/include/common_prepend.php' ;

$forum = intval( @$_GET['forum'] ) ;
if( empty( $forum ) ) die( _MD_XHNEWBB_ERRORFORUM ) ;

// process and check by $forum
include dirname(__FILE__).'/include/process_forum2postperm.inc.php' ;

// specific variables for newtopic
$pid = 0 ;
$subject4html = '' ;
$message4html = '' ;
$post_id = 0 ;
$topic_id = 0 ;
$u2t_marked = 1 ;
$formTitle = _MD_XHNEWBB_POST ;
$mode = 'newtopic' ;

include dirname(__FILE__).'/include/display_post_form.inc.php' ;

?>