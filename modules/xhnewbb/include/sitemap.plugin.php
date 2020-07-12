<?php

function b_sitemap_xhnewbb()
{
	include_once dirname(__FILE__).'/perm_functions.php' ;

	$db =& Database::getInstance() ;
	$myts =& MyTextSanitizer::getInstance() ;
	$sitemap = array() ;

	$whr_forum = 'f.forum_id IN (' . implode( ',' , xhnewbb_get_forums_can_read() ) . ')' ;
	$sql = "SELECT c.cat_id,c.cat_title,f.forum_id,f.forum_name FROM ".$db->prefix("xhnewbb_forums")." f LEFT JOIN ".$db->prefix("xhnewbb_categories")." c ON f.cat_id=c.cat_id WHERE ($whr_forum) ORDER BY c.cat_order, f.forum_weight, f.forum_id";
	if( ! $result = $db->query( $sql ) ) die( __LINE__ . 'SQL Error' ) ;

	while ( $row = $db->fetchArray( $result ) ) {
		$cat_id = intval( $row['cat_id'] ) ;
		if( empty( $sitemap['parent'][ $cat_id ] ) ) {
			$sitemap['parent'][ $cat_id ] = array(
				'id' => $cat_id ,
				'title' => $myts->makeTboxData4Show( $row['cat_title'] ) ,
				'url' => 'index.php?cat='.$cat_id ,
			) ;
		}
		$sitemap['parent'][ $cat_id ]['child'][] = array(
			'id' => intval( $row['forum_id'] ) ,
			'title' => $myts->makeTboxData4Show( $row['forum_name'] ) ,
			'image' => 2 ,
			'url' => 'viewforum.php?forum='.intval( $row['forum_id'] ) ,
		) ;
	}
	return $sitemap ;
}


?>