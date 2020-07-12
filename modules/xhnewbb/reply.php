<?php

include dirname(__FILE__).'/include/common_prepend.php' ;

// process and check by $_GET['post_id']
include dirname(__FILE__).'/include/process_postid2forum.inc.php' ;

// process and check by $forum
include dirname(__FILE__).'/include/process_forum2postperm.inc.php' ;


// references to post reply
$reference_message4html = $forumpost->text('Show');
$reference_date4html = formatTimestamp( $forumpost->posttime() ) ;
$reference_name4html = $forumpost->uid() ? XoopsUser::getUnameFromId( $forumpost->uid() ) : $xoopsConfig['anonymous'] ;
$reference_subject4html = $forumpost->subject('Show');

// specific variables for reply
$message4html = '' ;
$subject4html = substr( $reference_subject4html , 0 , 3 ) == 'Re:' ? $reference_subject4html : 'Re: ' . $reference_subject4html ;
$quote4html = "[quote]\n".sprintf(_MD_XHNEWBB_USERWROTE,$reference_name4html)."\n".$forumpost->text("Quotes")."[/quote]";
$pid = $post_id ;
$post_id = 0 ;
$u2t_marked = $forumpost->u2t_marked() ;
$formTitle = _MD_XHNEWBB_REPLY ;
$mode = 'reply' ;

include dirname(__FILE__).'/include/display_post_form.inc.php' ;

?>