<?php

include dirname(__FILE__).'/include/common_prepend.php' ;

// process and check by $_GET['post_id']
include dirname(__FILE__).'/include/process_postid2forum.inc.php' ;

// process and check by $forum
include dirname(__FILE__).'/include/process_forum2postperm.inc.php' ;

// check edit permission
if( ! is_object( $xoopsUser ) ) die( _MD_XHNEWBB_EDITNOTALLOWED ) ;
else if( ! $isadminormod && ( $forumpost->uid() != $xoopsUser->getVar('uid') || time() >= $forumpost->posttime() + $xoopsModuleConfig['xhnewbb_selfeditlimit'] ) ) die( _MD_XHNEWBB_EDITNOTALLOWED ) ;

// specific variables for edit
$nohtml = $forumpost->nohtml();
$nosmiley = $forumpost->nosmiley();
$icon = $forumpost->icon();
$attachsig = $forumpost->attachsig();
$subject4html = $forumpost->subject("Edit") ;
$message4html = $forumpost->text("Edit") ;
$solved = $forumpost->solved() ;
$u2t_marked = $forumpost->u2t_marked() ;
$formTitle = _MD_XHNEWBB_EDITMODEC ;
$mode = 'edit' ;

include dirname(__FILE__).'/include/display_post_form.inc.php' ;

?>