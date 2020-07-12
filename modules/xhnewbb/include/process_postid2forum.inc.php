<?php

if( ! defined('XOOPS_ROOT_PATH') ) exit ;

// get (object)$forumpost
$forumpost = new ForumPosts( intval( @$_GET['post_id'] ) ) ;
$post_id = intval( $forumpost->postid() ) ;
if( empty( $post_id ) ) die( _MD_XHNEWBB_ERRORPOST ) ;
$topic_id = intval( $forumpost->topic() ) ;
$forum = intval( $forumpost->forum() ) ;

// lock check (even admin cannot post into locked topic)
if( xhnewbb_is_locked( $topic_id ) ) die( _MD_XHNEWBB_TOPICLOCKED ) ;

?>