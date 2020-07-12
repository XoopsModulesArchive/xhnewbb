<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

// referer check
$ref = xoops_getenv('HTTP_REFERER');
if( $ref == '' || strpos( $ref , XOOPS_URL.'/modules/system/admin.php' ) === 0 ) {
	/* Module specific part */
	global $xoopsDB ;

	// newbb to xhnewbb
	$result = $xoopsDB->query( "SELECT forum_weight FROM ".$xoopsDB->prefix("xhnewbb_forums")." LIMIT 1" ) ;
	if( ! $result ) {
		$xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_forums")." ADD forum_weight int(8) NOT NULL default '0' AFTER forum_last_post_id" ) ;
	}

	// 1.0 to 1.10
	$result = $xoopsDB->query( "SELECT * FROM ".$xoopsDB->prefix("xhnewbb_users2topics")." LIMIT 1" ) ;
	if( ! $result ) {
		$xoopsDB->queryF( "CREATE TABLE ".$xoopsDB->prefix("xhnewbb_users2topics")." (
		  uid mediumint(8) unsigned NOT NULL default 0,
		  topic_id int(8) unsigned NOT NULL default 0,
		  u2t_time int(10) NOT NULL default 0,
		  u2t_marked tinyint NOT NULL default 0,
		  u2t_rsv tinyint NOT NULL default 0,
		  PRIMARY KEY (uid,topic_id),
		  KEY (uid),
		  KEY (topic_id),
		  KEY (u2t_time),
		  KEY (u2t_marked),
		  KEY (u2t_rsv)
		) TYPE=MyISAM;" ) ;
	}
	$result = $xoopsDB->query( "SELECT topic_solved FROM ".$xoopsDB->prefix("xhnewbb_topics")." LIMIT 1" ) ;
	if( ! $result ) {
		$xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_topics")." ADD topic_solved tinyint(1) NOT NULL default '0', ADD topic_rsv tinyint(1) NOT NULL default '0', ADD KEY (topic_time)" ) ;

		$xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_posts")." ADD KEY (post_time)" ) ;
	}

	// 1.1 -> 1.2
	$result = $xoopsDB->query( "SELECT groupid FROM ".$xoopsDB->prefix("xhnewbb_forum_access")." LIMIT 1" ) ;
	if( ! $result ) {
		$xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_forum_access")." DROP PRIMARY KEY, MODIFY `user_id` mediumint(8) default NULL, ADD `groupid` smallint(5) default NULL AFTER `user_id`, ADD UNIQUE KEY (forum_id,user_id), ADD UNIQUE KEY (forum_id,groupid), ADD KEY  (forum_id), ADD KEY (user_id), ADD KEY  (groupid), ADD KEY (can_post)" ) ;
	}

	// 1.2 -> 1.3
	$result = $xoopsDB->queryF( "ALTER TABLE ".$xoopsDB->prefix("xhnewbb_categories")." MODIFY `cat_order` smallint(5) NOT NULL default 0, ADD KEY `cat_order` (cat_order)" ) ;

	/* General part */

	// Keep the values of block's options when module is updated (by nobunobu)
	include dirname( __FILE__ ) . "/updateblock.inc.php" ;

}

?>