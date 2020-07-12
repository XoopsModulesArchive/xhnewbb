<?php

function xhnewbb_search( $keywords , $andor , $limit , $offset , $userid )
{
	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance() ;

	$andor = strtoupper( $andor ) ;
	$userid = intval( $userid ) ;

	// XOOPS Search module
	$showcontext = empty( $_GET['showcontext'] ) ? 0 : 1 ;
	$select4con = $showcontext ? "t.post_text" : "'' AS post_text" ;

	require_once dirname(__FILE__).'/perm_functions.php' ;
	$whr_forum = "p.forum_id IN (".implode(",",xhnewbb_get_forums_can_read()).")" ;

	$whr_uid = $userid > 0 ? "p.uid=$userid" : "1" ;

	$whr_query = $andor == 'OR' ? '0' : '1' ;
	if( is_array( $keywords ) ) foreach( $keywords as $word ) {
		// I know this is not a right escaping, but I can't believe $keywords :-)
		$word4sql = addslashes( stripslashes( $word ) ) ;
		$whr_query .= $andor == 'EXACT' ? ' AND' : ' '.$andor ;
		$whr_query .= " (p.subject LIKE '%$word4sql%' OR t.post_text LIKE '%$word4sql%')" ;
	}

	$sql = "SELECT p.post_id,p.topic_id,p.post_time,p.uid,p.subject,$select4con FROM ".$db->prefix("xhnewbb_posts")." p LEFT JOIN ".$db->prefix("xhnewbb_posts_text")." t ON t.post_id=p.post_id LEFT JOIN ".$db->prefix("xhnewbb_forums")." f ON f.forum_id=p.forum_id WHERE ($whr_forum) AND ($whr_uid) AND ($whr_query) ORDER BY p.post_time DESC" ;

	$result = $db->query( $sql , $limit , $offset ) ;
	$ret = array() ;
	$context = '' ;
 	while( list( $post_id , $topic_id , $post_time , $uid , $subject , $text ) = $db->fetchRow( $result ) ) {

		// get context for module "search"
		if( function_exists( 'search_make_context' ) && $showcontext ) {
			if( function_exists( 'easiestml' ) ) $text = easiestml( $text ) ;
			$full_context = strip_tags( $myts->displayTarea( $text , 1 , 1 , 1 , 1 , 1 ) ) ;
			$context = search_make_context( $full_context , $keywords ) ;
		}

		$ret[] = array(
			'link' => "viewtopic.php?topic_id=$topic_id&post_id=$post_id#forumpost$post_id" ,
			'title' => $subject ,
			'time' => $post_time ,
			'uid' => $uid ,
			"context" => $context ,
		) ;
	}
	return $ret;
}
?>
