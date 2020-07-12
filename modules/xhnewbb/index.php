<?php

include dirname(__FILE__).'/include/common_prepend.php' ;

$xoopsOption['template_main']= 'xhnewbb_index.html';
include XOOPS_ROOT_PATH."/header.php";

$sql = 'SELECT c.* FROM '.$xoopsDB->prefix('xhnewbb_categories').' c, '.$xoopsDB->prefix("xhnewbb_forums").' f WHERE f.cat_id=c.cat_id GROUP BY c.cat_id, c.cat_title, c.cat_order ORDER BY c.cat_order';
if( ! $result = $xoopsDB->query( $sql ) ) {
	redirect_header( XOOPS_URL.'/' , 1 , _MD_XHNEWBB_ERROROCCURED ) ;
	exit ;
}

$uid = is_object( @$xoopsUser ) ? $xoopsUser->getVar('uid') : 0 ;
if( $uid > 0 ) {
	$db =& Database::getInstance() ;
	$lv_result = $db->query( "SELECT MAX(u2t_time) FROM ".$db->prefix("xhnewbb_users2topics")." WHERE uid='$uid'" ) ;
	list( $last_visit ) = $db->fetchRow( $lv_result ) ;
}
if( empty( $last_visit ) ) $last_visit = time() ;

$xoopsTpl->assign(array("lang_welcomemsg" => sprintf(_MD_XHNEWBB_WELCOME,$xoopsConfig['sitename']), "lang_tostart" => _MD_XHNEWBB_TOSTART, "lang_totaltopics" => _MD_XHNEWBB_TOTALTOPICSC, "lang_totalposts" => _MD_XHNEWBB_TOTALPOSTSC, "total_topics" => xhnewbb_get_total_topics(), "total_posts" => xhnewbb_get_total_posts(0, 'all'), "lang_lastvisit" => sprintf(_MD_XHNEWBB_LASTVISIT,formatTimestamp($last_visit,'m')), "lang_currenttime" => sprintf(_MD_XHNEWBB_TIMENOW,formatTimestamp(time(),"m")), "lang_forum" => _MD_XHNEWBB_FORUM, "lang_topics" => _MD_XHNEWBB_TOPICS, "lang_posts" => _MD_XHNEWBB_POSTS, "lang_lastpost" => _MD_XHNEWBB_LASTPOST, "lang_moderators" => _MD_XHNEWBB_MODERATOR));

// category limitation
$viewcat = (!empty($_GET['cat'])) ? intval($_GET['cat']) : 0;
if ( $viewcat != 0 ) {
	$whr_categories = 'f.cat_id='.$viewcat ;
	$xoopsTpl->assign('forum_index_title', _MD_XHNEWBB_FORUMINDEX) ;
} else {
	$whr_categories = '1' ;
	$xoopsTpl->assign('forum_index_title', '') ;
}

$categories = array();
while ( $cat_row = $xoopsDB->fetchArray($result) ) {
	$categories[] = $cat_row;
}

if( $uid > 0 ) {
	$sql = 'SELECT f.*, u.uname, u.uid, p.topic_id, p.post_time, p.subject, p.icon, u2t.u2t_time FROM '.$xoopsDB->prefix('xhnewbb_forums').' f LEFT JOIN '.$xoopsDB->prefix('xhnewbb_posts').' p ON p.post_id = f.forum_last_post_id LEFT JOIN '.$xoopsDB->prefix('users').' u ON u.uid = p.uid LEFT JOIN '.$xoopsDB->prefix('xhnewbb_users2topics').' u2t ON  u2t.topic_id = p.topic_id AND u2t.uid = '.$uid.' WHERE '.$whr_categories ;
} else {
	$sql = 'SELECT f.*, u.uname, u.uid, p.topic_id, p.post_time, p.subject, p.icon, 0 AS u2t_time FROM '.$xoopsDB->prefix('xhnewbb_forums').' f LEFT JOIN '.$xoopsDB->prefix('xhnewbb_posts').' p ON p.post_id = f.forum_last_post_id LEFT JOIN '.$xoopsDB->prefix('users').' u ON u.uid = p.uid'.' WHERE '.$whr_categories ;
}

if( ! $result = $xoopsDB->query($sql.' ORDER BY f.cat_id, f.forum_weight, f.forum_id') ) {
	if ( !$result = $xoopsDB->query($sql.' ORDER BY f.cat_id, f.forum_id') ) {
		die( 'Error' ) ;
	}
}
$forums = array() ;
while ( $forum_data = $xoopsDB->fetchArray( $result ) ) {
	// private or public
	if( $forum_data['forum_type'] == 0 || $uid > 0 && ( $xoopsUser->isAdmin( $xoopsModule->mid() ) || xhnewbb_check_priv_forum_read( $uid , $forum_data['forum_id'] ) ) ) {
		$forums[] = $forum_data;
	}
}

$cat_count = count($categories);
if ($cat_count > 0) {
	for ( $i = 0; $i < $cat_count; $i++ ) {
		$categories[$i]['cat_title'] = $myts->makeTboxData4Show($categories[$i]['cat_title']);
		if ( $viewcat != 0 && $categories[$i]['cat_id'] != $viewcat ) {
			$xoopsTpl->append("categories", $categories[$i]);
			continue;
		}

		foreach ( $forums as $forum_row ) {
			unset($last_post);
			if ( $forum_row['cat_id'] == $categories[$i]['cat_id'] ) {
				if ($forum_row['post_time']) {
					$categories[$i]['forums']['forum_lastpost_time'][] = formatTimestamp($forum_row['post_time'],'m');
					$last_post_icon = '<a href="'.XOOPS_URL.'/modules/xhnewbb/viewtopic.php?post_id='.$forum_row['forum_last_post_id'].'&amp;topic_id='.$forum_row['topic_id'].'#forumpost'.$forum_row['forum_last_post_id'].'">';
					if ( $forum_row['icon'] ) {
						$last_post_icon .= '<img src="'.XOOPS_URL.'/modules/xhnewbb/images/'.$forum_row['icon'].'" border="0" alt="" />';
					} else {
						$last_post_icon .= '<img src="'.XOOPS_URL.'/modules/xhnewbb/images/icon1.gif" width="15" height="15" border="0" alt="" />';
					}
					$last_post_icon .= '</a>';
					$categories[$i]['forums']['forum_lastpost_icon'][] = $last_post_icon;
					if ( $forum_row['uid'] != 0 && $forum_row['uname'] ){
						$categories[$i]['forums']['forum_lastpost_user'][] = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$forum_row['uid'].'">' . $myts->makeTboxData4Show($forum_row['uname']).'</a>';
					} else {
						$categories[$i]['forums']['forum_lastpost_user'][] = $xoopsConfig['anonymous'];
					}
					if ( $forum_row['forum_type'] == 1 ) {
						$categories[$i]['forums']['forum_folder'][] = $bbImage['locked_forum'];
						$categories[$i]['forums']['forum_type'][] = 'private' ;
					} elseif ( $forum_row['post_time'] > $forum_row['u2t_time'] && !empty($forum_row['topic_id'])) {
						$categories[$i]['forums']['forum_folder'][] = $bbImage['newposts_forum'];
						$categories[$i]['forums']['forum_type'][] = 'newposts' ;
					} else {
						$categories[$i]['forums']['forum_folder'][] = $bbImage['folder_forum'];
						$categories[$i]['forums']['forum_type'][] = 'nonewposts' ;
					}
				} else {
					// no forums, so put empty values
					$categories[$i]['forums']['forum_lastpost_time'][] = "";
					$categories[$i]['forums']['forum_lastpost_icon'][] = "";
					$categories[$i]['forums']['forum_lastpost_user'][] = "";
					if ( $forum_row['forum_type'] == 1 ) {
						$categories[$i]['forums']['forum_folder'][] = $bbImage['locked_forum'];
						$categories[$i]['forums']['forum_type'][] = 'private' ;
					} else {
						$categories[$i]['forums']['forum_folder'][] = $bbImage['folder_forum'];
						$categories[$i]['forums']['forum_type'][] = 'nonewposts' ;
					}
				}
				$categories[$i]['forums']['forum_id'][] = $forum_row['forum_id'];
				$categories[$i]['forums']['forum_name'][] = $myts->makeTboxData4Show($forum_row['forum_name']);
				$categories[$i]['forums']['forum_desc'][] = $myts->makeTareaData4Show($forum_row['forum_desc']);
				$categories[$i]['forums']['forum_topics'][] = $forum_row['forum_topics'];
				$categories[$i]['forums']['forum_posts'][] = $forum_row['forum_posts'];
	 			$all_moderators = xhnewbb_get_moderators($forum_row['forum_id']);
	 			$count = 0;
				$forum_moderators = '';
				foreach ( $all_moderators as $mods) {
					foreach ( $mods as $mod_id => $mod_name) {
						if ( $count > 0 ) {
							$forum_moderators .= ', ';
						}
						$forum_moderators .= '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$mod_id.'">'.$myts->makeTboxData4Show($mod_name).'</a>';
						$count = 1;
					}
				}
				$categories[$i]['forums']['forum_moderators'][] = $forum_moderators;
			}
		}
		$xoopsTpl->append("categories", $categories[$i]);
	}
} else {
	$xoopsTpl->append("categories", array());
}

$xoopsTpl->assign(array('mod_url' => XOOPS_URL.'/modules/xhnewbb',"img_hotfolder" => $bbImage['newposts_forum'], "img_folder" => $bbImage['folder_forum'], "img_locked" => $bbImage['locked_forum'], "lang_newposts" => _MD_XHNEWBB_NEWPOSTS, "lang_private" => _MD_XHNEWBB_PRIVATEFORUM, "lang_nonewposts" => _MD_XHNEWBB_NONEWPOSTS, "lang_search" => _MD_XHNEWBB_SEARCH, "lang_advsearch" => _MD_XHNEWBB_ADVSEARCH));

$xoopsTpl->assign( "xoops_module_header" , "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>