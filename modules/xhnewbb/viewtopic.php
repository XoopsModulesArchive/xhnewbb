<?php

include dirname(__FILE__).'/include/common_prepend.php';

if( empty( $topic_id ) ) {
	die(_MD_XHNEWBB_ERRORTOPIC);
}
if( empty( $forum ) ) {
	die(_MD_XHNEWBB_ERRORFORUM);
}

$topic_time = (isset($_GET['topic_time'])) ? intval($_GET['topic_time']) : 0;
$post_id = !empty($_GET['post_id']) ? intval($_GET['post_id']) : 0;

//use users preferences
if (is_object($xoopsUser)) {
	$viewmode = $viewmode ? $viewmode : $xoopsUser->getVar('umode') ;
	$uorder = $xoopsUser->getVar('uorder') == 1 ? 'DESC' : 'ASC' ;
	$order = $order ? $order : $uorder ;
}

// newbb does not have nested mode
if ($viewmode == 'nest') {
	$viewmode = 'thread';
}

// check $viewmode and $order again, and force to set if blank
$viewmode = in_array( $viewmode , array( 'flat' , 'thread' ) ) ? $viewmode : 'flat' ;
$order = in_array( $order , array( 'ASC' , 'DESC' ) ) ? $order : 'ASC' ;



if ($viewmode != 'flat') {
	$xoopsOption['template_main'] =  'xhnewbb_viewtopic_thread.html';
} else {
	$xoopsOption['template_main'] =  'xhnewbb_viewtopic_flat.html';
}

include XOOPS_ROOT_PATH.'/header.php';

if ( isset($_GET['move']) && 'next' == $_GET['move'] ) {
	$sql = 'SELECT t.topic_id, t.topic_title, t.topic_time, t.topic_status, t.topic_sticky, t.topic_last_post_id, f.forum_id, f.forum_name, f.forum_access, f.forum_type, f.allow_html, f.allow_sig, f.posts_per_page, f.hot_threshold, f.topics_per_page FROM '.$xoopsDB->prefix('xhnewbb_topics').' t LEFT JOIN '.$xoopsDB->prefix('xhnewbb_forums').' f ON f.forum_id = t.forum_id WHERE t.topic_time > '.$topic_time.' AND t.forum_id = '.$forum.' ORDER BY t.topic_time ASC LIMIT 1';
} elseif ( isset($_GET['move']) && 'prev' == $_GET['move']) {
	$sql = 'SELECT t.topic_id, t.topic_title, t.topic_time, t.topic_status, t.topic_sticky, t.topic_last_post_id, f.forum_id, f.forum_name, f.forum_access, f.forum_type, f.allow_html, f.allow_sig, f.posts_per_page, f.hot_threshold, f.topics_per_page FROM '.$xoopsDB->prefix('xhnewbb_topics').' t LEFT JOIN '.$xoopsDB->prefix('xhnewbb_forums').' f ON f.forum_id = t.forum_id WHERE t.topic_time < '.$topic_time.' AND t.forum_id = '.$forum.' ORDER BY t.topic_time DESC LIMIT 1';
} else {
	$sql = 'SELECT t.topic_id, t.topic_title, t.topic_time, t.topic_status, t.topic_sticky, t.topic_last_post_id, f.forum_id, f.forum_name, f.forum_access, f.forum_type, f.allow_html, f.allow_sig, f.posts_per_page, f.hot_threshold, f.topics_per_page FROM '.$xoopsDB->prefix('xhnewbb_topics').' t LEFT JOIN '.$xoopsDB->prefix('xhnewbb_forums').' f ON f.forum_id = t.forum_id WHERE t.topic_id = '.$topic_id.' AND t.forum_id = '.$forum;
}

if ( !$result = $xoopsDB->query($sql) ) {
	die(_MD_XHNEWBB_ERROROCCURED);
}

if ( !$forumdata = $xoopsDB->fetchArray($result) ) {
	die(_MD_XHNEWBB_FORUMNOEXIST);
}

$myts =& MyTextSanitizer::getInstance();

$xoopsTpl->assign('topic_id', $forumdata['topic_id']);
$xoopsTpl->assign( 'xoops_pagetitle' , $myts->makeTboxData4Show($forumdata['topic_title'] ) ) ;
$topic_id = $forumdata['topic_id'];
$xoopsTpl->assign('forum_id', $forumdata['forum_id']);
$forum = $forumdata['forum_id'];
$can_post = 0;
$show_reg = 0;

// ADMIN FLAG
if( is_object( @$xoopsUser ) && ( $xoopsUser->isAdmin($xoopsModule->mid()) || xhnewbb_is_moderator( $forum , $xoopsUser->getVar('uid') ) ) ) {
	$isadminormod = true ;
} else {
	$isadminormod = false ;
}

// CHECK PRIVILEGES FOR VIEW
if ( $forumdata['forum_type'] == 1 ) {
	// this is a private forum.
	$accesserror = 0;
	if ( $xoopsUser ) {
		if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
			if ( !xhnewbb_check_priv_forum_read($xoopsUser->getVar('uid'), $forum) ) {
				$accesserror = 1;
			}
		}
	} else {
		$accesserror = 1;
	}
	if ( $accesserror == 1 ) {
		die(_MD_XHNEWBB_NORIGHTTOACCESS);
	}
	$can_post = 1;
	$show_reg = 1;
} else {
	// this is not a priv forum
	if ( $forumdata['forum_access'] == 1 ) {
		// this is a reg user only forum
		if ( $xoopsUser ) {
			$can_post = 1;
		} else {
			$show_reg = 1;
		}
	} elseif ( $forumdata['forum_access'] == 2 ) {
		// this is an open forum
		$can_post = 1;
	} else {
		// this is an admin/moderator only forum
		if ( $isadminormod ) {
			$can_post = 1;
		}
	}
}
$forumdata['topic_title'] = $myts->makeTboxData4Show($forumdata['topic_title']);
$forumdata['forum_name'] = $myts->makeTboxData4Show($forumdata['forum_name']);

$xoopsTpl->assign(array('topic_title' => '<a href="'.$bbUrl['root'].'viewtopic.php?topic_id='.$topic_id.'&amp;viewmode='.$viewmode.'">'.$forumdata['topic_title'].'</a>', 'forum_name' => $forumdata['forum_name'], 'topic_time' => $forumdata['topic_time'], 'lang_nexttopic' => _MD_XHNEWBB_NEXTTOPIC, 'lang_prevtopic' => _MD_XHNEWBB_PREVTOPIC));

// Next link
$sql = 'SELECT t.topic_id FROM '.$xoopsDB->prefix('xhnewbb_topics').' t WHERE t.topic_time > '.intval($forumdata['topic_time']).' AND t.forum_id='.$forum.' ORDER BY t.topic_time ASC LIMIT 1';
if( ! $result = $xoopsDB->query( $sql ) ) die(_MD_XHNEWBB_ERROROCCURED.__LINE__);
@list( $next_topic_id ) = $xoopsDB->fetchRow( $result ) ;
$xoopsTpl->assign( 'next_topic_id' , @$next_topic_id ) ;

// Prev link
$sql = 'SELECT t.topic_id FROM '.$xoopsDB->prefix('xhnewbb_topics').' t WHERE t.topic_time < '.intval($forumdata['topic_time']).' AND t.forum_id='.$forum.' ORDER BY t.topic_time DESC LIMIT 1';
if( ! $result = $xoopsDB->query( $sql ) ) die(_MD_XHNEWBB_ERROROCCURED.__LINE__);
@list( $prev_topic_id ) = $xoopsDB->fetchRow( $result ) ;
$xoopsTpl->assign( 'prev_topic_id' , @$prev_topic_id ) ;


// add image links to admin page if the user viewing this page is a forum admin
if ( $xoopsUser ) {
	$xoopsTpl->assign('viewer_userid', $xoopsUser->getVar('uid'));
	if ( $isadminormod ) {
		// yup, the user is admin
		// the forum is locked?
		if ( $forumdata['topic_status'] != 1 ) {
			// nope
			$xoopsTpl->assign('topic_lock_image', '<a href="'.$bbUrl['root'].'topicmanager.php?mode=lock&amp;topic_id='.$topic_id.'"><img src="'.$bbImage['locktopic'].'" alt="'._MD_XHNEWBB_LOCKTOPIC.'" title="'._MD_XHNEWBB_LOCKTOPIC.'" /></a>');
		} else {
			// yup, it is..
			$xoopsTpl->assign('topic_lock_image', '<a href="'.$bbUrl['root'].'topicmanager.php?mode=unlock&amp;topic_id='.$topic_id.'"><img src="'.$bbImage['unlocktopic'].'" alt="'._MD_XHNEWBB_UNLOCKTOPIC.'" title="'._MD_XHNEWBB_UNLOCKTOPIC.'" /></a>');
		}
		$xoopsTpl->assign('topic_move_image', '<a href="'.$bbUrl['root'].'topicmanager.php?mode=move&amp;topic_id='.$topic_id.'"><img src="'.$bbImage['movetopic'].'" alt="'._MD_XHNEWBB_MOVETOPIC.'" title="'._MD_XHNEWBB_MOVETOPIC.'" /></a>');
		$xoopsTpl->assign('topic_delete_image', '<a href="'.$bbUrl['root'].'topicmanager.php?mode=del&amp;topic_id='.$topic_id.'"><img src="'.$bbImage['deltopic'].'" alt="'._MD_XHNEWBB_DELETETOPIC.'" title="'._MD_XHNEWBB_DELETETOPIC.'" /></a>');
		// is the topic sticky?
		if ( $forumdata['topic_sticky'] != 1 ) {
			// nope, not yet..
			$xoopsTpl->assign('topic_sticky_image', '<a href="'.$bbUrl['root'].'topicmanager.php?mode=sticky&amp;topic_id='.$topic_id.'"><img src="'.$bbImage['sticky'].'" alt="'._MD_XHNEWBB_STICKYTOPIC.'" title="'._MD_XHNEWBB_STICKYTOPIC.'" /></a>');
		} else {
			// yup it is sticking..
			$xoopsTpl->assign('topic_sticky_image', '<a href="'.$bbUrl['root'].'topicmanager.php?mode=unsticky&amp;topic_id='.$topic_id.'"><img src="'.$bbImage['unsticky'].'" alt="'._MD_XHNEWBB_UNSTICKYTOPIC.'" title="'._MD_XHNEWBB_UNSTICKYTOPIC.'" /></a>');
		}
		// need to set this also
		$xoopsTpl->assign('viewer_is_admin', true);
	} else {
		// nope, the user is not a forum admin..
		$xoopsTpl->assign('viewer_is_admin', false);
	}
} else {
	// nope, the user is not a forum admin, not even registered
	$xoopsTpl->assign(array('viewer_is_admin' => false, 'viewer_userid' => 0));
}

function xhnewbb_show_tree(&$arr, $current=0, $key=0, $prefix='', $foundusers=array()){
	global $xoopsConfig;
	if ($key != 0) {
		if ( 0 != $arr[$key]['obj']->uid() ) {
			if (!isset($foundusers[$arr[$key]['obj']->uid()])) {
				$eachposter = new XoopsUser($arr[$key]['obj']->uid());
				$foundusers[$arr[$key]['obj']->uid()] =& $eachposter;
			} else {
				$eachposter =& $foundusers[$arr[$key]['obj']->uid()];
			}
			$poster_rank = $eachposter->rank();
			if ( ! empty( $poster_rank['image'] ) ) {
				$poster_rank['image'] = '<img src="'.XOOPS_UPLOAD_URL.'/'.$poster_rank['image'].'" alt="" />';
			}
			if ( $eachposter->isActive() ) {
				$posterarr =  array('poster_uid' => $eachposter->getVar('uid'), 'poster_uname' => '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$eachposter->getVar('uid').'">'.$eachposter->getVar('uname').'</a>');
			} else {
				$posterarr = array('poster_uid' =>0, 'poster_uname' => $xoopsConfig['anonymous']);
			}
		} else {
			$posterarr = array('poster_uid' =>0, 'poster_uname' => $xoopsConfig['anonymous']);
		}
		$posticon = $arr[$key]['obj']->icon();
		if ( isset($posticon) && $posticon != '' ) {
			$post_image = '<img src="'.XOOPS_URL.'/modules/xhnewbb/images/'.$posticon.'" alt="" />';
		} else {
			$post_image =  '<img src="'.XOOPS_URL.'/images/icons/no_posticon.gif" alt="" />';
		}
		if ($current != $key) {
			$subject = '<a href="viewtopic.php?topic_id='.$arr[$key]['obj']->topic().'&amp;post_id='.$arr[$key]['obj']->postid().'&amp;viewmode=thread#forumpost'.$arr[$key]['obj']->postid().'">'.$arr[$key]['obj']->subject().'</a>';
			$GLOBALS['xoopsTpl']->append("topic_trees", array_merge($posterarr, array("post_id" => $arr[$key]['obj']->postid(), "post_parent_id" => $arr[$key]['obj']->parent(), "post_date" => formatTimestamp($arr[$key]['obj']->posttime(), "m"), "post_image" => $post_image, "post_title" => $subject, "post_prefix" => $prefix)));
		} else {
			$subject = '<b>'.$arr[$key]['obj']->subject().'</b>';
			$thisprefix = substr($prefix, 0, -6)."<b>&raquo;</b>";
			$GLOBALS['xoopsTpl']->append("topic_trees", array_merge($posterarr, array("post_id" => $arr[$key]['obj']->postid(), "post_parent_id" => $arr[$key]['obj']->parent(), "post_date" => formatTimestamp($arr[$key]['obj']->posttime(), "m"), "post_image" => $post_image, "post_title" => $subject, "post_prefix" => $thisprefix)));
		}
	}
	if ( isset($arr[$key]['replies']) && !empty($arr[$key]['replies']) ){
		$prefix .= "&nbsp;&nbsp;";
		foreach($arr[$key]['replies'] as $replykey) {
			$current = ( $current == 0 ) ? $replykey : $current;
			xhnewbb_show_tree($arr, $current, $replykey, $prefix, $foundusers);
		}
	}
}

if ($order == 'DESC') {
	$xoopsTpl->assign(array('order_current' => 'DESC', 'order_other' => 'ASC', 'lang_order_other' => _OLDESTFIRST));
} else {
	$xoopsTpl->assign(array('order_current' => 'ASC', 'order_other' => 'DESC', 'lang_order_other' => _NEWESTFIRST));
}

// initialize the start number of select query
$start = !empty($_GET['start']) ? intval($_GET['start']) : 0;

$total_posts = xhnewbb_get_total_posts($topic_id, 'topic');
if ($total_posts > 50) {
	$viewmode ="flat";
	// hide link to theaded view
	$xoopsTpl->assign('lang_threaded', "" );
	$xoopsTpl->assign('lang_flat', _FLAT );
} else {
	$xoopsTpl->assign(array('lang_threaded' => _THREADED, 'lang_flat' => _FLAT));
}

if ( $can_post == 1 ) {
	$xoopsTpl->assign(array('viewer_can_post' => true, 'forum_post_or_register' => "<a href=\"newtopic.php?forum=".$forum."\">"._MD_XHNEWBB_POSTNEW."</a>")); //jidaikobo
} else {
	$xoopsTpl->assign('viewer_can_post', false);
	if ( $show_reg == 1 ) {
		$xoopsTpl->assign('forum_post_or_register', '<a href="'.XOOPS_URL.'/user.php?xoops_redirect='.htmlspecialchars($xoopsRequestUri).'">'._MD_XHNEWBB_REGTOPOST.'</a>');
	} else {
		$xoopsTpl->assign('forum_post_or_register', '');
	}
}

if ( $viewmode == "thread" ) {
	// THREAD (TREE) MODE
	$start = 0 ;
	$postsArray = ForumPosts::getAllPosts($topic_id, "ASC", $total_posts, $start);
	$xoopsTpl->assign('topic_viewmode', 'thread');
	$xoopsTpl->assign('topic_order', $order);

	$newObjArr = array();
	foreach ( $postsArray as $eachpost ) {
		$key1 = $eachpost->postid();
		if ( (!empty($post_id) && $post_id == $key1) || ( empty($post_id) && $eachpost->parent() == 0 ) ) {
			$post_text = $eachpost->text();
			$posterarr = array() ;
			if ( 0 != $eachpost->uid() ) {
				$eachposter = new XoopsUser($eachpost->uid());
				$poster_rank = $eachposter->rank();
				if ( ! empty( $poster_rank['image'] ) ) {
					$poster_rank['image'] = "<img src='".XOOPS_UPLOAD_URL."/".$poster_rank['image']."' alt='' />";
				}
				if ( $eachposter->isActive() ) {
					$poster_status = $eachposter->isOnline() ? _MD_XHNEWBB_ONLINE : '';
					$posterarr =  array('poster_uid' => $eachposter->getVar('uid'), 'poster_uname' => '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$eachposter->getVar('uid').'">'.$eachposter->getVar('uname').'</a>', 'poster_avatar' => $eachposter->getVar('user_avatar'), 'poster_from' => $eachposter->getVar('user_from'), 'poster_regdate' => formatTimestamp($eachposter->getVar('user_regdate'), 's'), 'poster_postnum' => $eachposter->getVar('posts'), 'poster_sendpmtext' => sprintf(_SENDPMTO,$eachposter->getVar('uname')), 'poster_rank_title' => $poster_rank['title'], 'poster_rank_image' => @$poster_rank['image'], 'poster_status' => $poster_status);
					if ( 1 == $forumdata['allow_sig'] && $eachpost->attachsig() == 1 && $eachposter->attachsig() == 1 ) {
						$myts =& MytextSanitizer::getInstance();
						$post_text .= "<p><br />----------------<br />". $myts->displayTarea($eachposter->getVar("user_sig", "N"), 0, 1, 1, $xoopsModuleConfig['xhnewbb_allow_sigimg'])."</p>";
					}
					if( is_object( @$xoopsUser ) ) {
						$can_edit = ( $isadminormod || $eachpost->uid() == $xoopsUser->getVar('uid') && time() < $eachpost->posttime() + $xoopsModuleConfig['xhnewbb_selfeditlimit'] ) ? true : false ;
						$can_delete = ( $isadminormod || $eachpost->uid() == $xoopsUser->getVar('uid') && time() < $eachpost->posttime() + $xoopsModuleConfig['xhnewbb_selfdellimit'] ) ? true : false ;
					} else {
						$can_edit = $can_delete = false ;
					}
					$can_reply = $can_post ;
				}
			}

			// this is a post from guests or quitted users
			if( empty( $posterarr ) ) {
				$posterarr = array('poster_uid' =>0, 'poster_uname' => $xoopsConfig['anonymous'], 'poster_avatar' => '', 'poster_from' => '', 'poster_regdate' => '', 'poster_postnum' => '', 'poster_sendpmtext' => '', 'poster_rank_title' => '', 'poster_rank_image' => '');
				$can_edit = $isadminormod ? true : false ;
				$can_delete = $isadminormod ? true : false ;
				$can_reply = $can_post ;
			}

			// locked topic
			if( $forumdata['topic_status'] == 1 ) {
				$can_edit = false ;
				$can_reply = false ;
			}
			
			$posticon = $eachpost->icon();
			if ( isset($posticon) && $posticon != '' ) {
				$post_image = '<a name="'.$eachpost->postid().'"><img src="'.XOOPS_URL.'/modules/xhnewbb/images/'.$eachpost->icon().'" alt="" /></a>';
			} else {
				$post_image =  '<a name="'.$eachpost->postid().'"><img src="'.XOOPS_URL.'/images/icons/posticon.gif" alt="" /></a>';
			}
			$xoopsTpl->append('topic_posts', array_merge($posterarr, array('post_id' => $eachpost->postid(), 'post_parent_id' => $eachpost->parent(), 'post_date' => formatTimestamp($eachpost->posttime(), 'm'), 'post_poster_ip'=> $eachpost->posterip(), 'post_image' => $post_image, 'post_title' => $eachpost->subject(), 'post_text' => $post_text, 'can_edit' => @$can_edit, 'can_delete' => @$can_delete, 'can_reply' => @$can_reply)));
		}
		$newObjArr[$key1]['obj'] = $eachpost;
		$key2 = $eachpost->parent();
		$newObjArr[$key2]['replies'][] = $key1;
		$newObjArr[$key2]['leaf'] = $key1;
	}
	xhnewbb_show_tree($newObjArr, $post_id);
	$xoopsTpl->assign(array('lang_subject' => _MD_XHNEWBB_SUBJECT, 'lang_date' => _MD_XHNEWBB_DATE));

} else {
	// FLAT MODE
	$xoopsTpl->assign(array('topic_viewmode' => 'flat', 'lang_top' => _MD_XHNEWBB_TOP, 'lang_subject' => _MD_XHNEWBB_SUBJECT, 'lang_bottom' => _MD_XHNEWBB_BOTTOM));	$xoopsTpl->assign('topic_order', $order);

	$postsArray = ForumPosts::getAllPosts($topic_id, $order, $forumdata['posts_per_page'], $start, $post_id);
	$foundusers = array();
	foreach ( $postsArray as $eachpost ) {
		$post_text = $eachpost->text();
		$posterarr = array() ;
		if ( 0 != $eachpost->uid() ) {
			if (!isset($foundusers['user'.$eachpost->uid()])) {
				$eachposter = new XoopsUser($eachpost->uid());
				$foundusers['user'.$eachpost->uid()] =& $eachposter;
			} else {
				$eachposter =& $foundusers['user'.$eachpost->uid()];
			}
			$poster_rank = $eachposter->rank();
			if ( ! empty( $poster_rank['image'] ) ) {
				$poster_rank['image'] = '<img src="'.XOOPS_UPLOAD_URL.'/'.$poster_rank['image'].'" alt="" />';
			}
			if ( $eachposter->isActive() ) {
				$poster_status = $eachposter->isOnline() ? _MD_XHNEWBB_ONLINE : '';
				$posterarr =  array('poster_uid' => $eachposter->getVar('uid'), 'poster_uname' => '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$eachposter->getVar('uid').'">'.$eachposter->getVar('uname').'</a>', 'poster_avatar' => $eachposter->getVar('user_avatar'), 'poster_from' => $eachposter->getVar('user_from'), 'poster_regdate' => formatTimestamp($eachposter->getVar('user_regdate'), 's'), 'poster_postnum' => $eachposter->getVar('posts'), 'poster_sendpmtext' => sprintf(_SENDPMTO,$eachposter->getVar('uname')), 'poster_rank_title' => $poster_rank['title'], 'poster_rank_image' => @$poster_rank['image'], 'poster_status' => $poster_status);
				if ( 1 == $forumdata['allow_sig'] && $eachpost->attachsig() == 1 && $eachposter->attachsig() == 1 ) {
					$myts =& MytextSanitizer::getInstance();
					$post_text .= '<p><br />----------------<br />'. $myts->displayTarea($eachposter->getVar('user_sig', 'N'), 0, 1, 1, $xoopsModuleConfig['xhnewbb_allow_sigimg']).'</p>';
				}
				if( is_object( @$xoopsUser ) ) {
					$can_edit = ( $isadminormod || $eachpost->uid() == $xoopsUser->getVar('uid') && time() < $eachpost->posttime() + $xoopsModuleConfig['xhnewbb_selfeditlimit'] ) ? true : false ;
					$can_delete = ( $isadminormod || $eachpost->uid() == $xoopsUser->getVar('uid') && time() < $eachpost->posttime() + $xoopsModuleConfig['xhnewbb_selfdellimit'] ) ? true : false ;
				} else {
					$can_edit = $can_delete = false ;
				}
				$can_reply = $can_post ;
			}
		}

		// this is a post from guests or quitted users
		if( empty( $posterarr ) ) {
			$posterarr = array('poster_uid' =>0, 'poster_uname' => $xoopsConfig['anonymous'], 'poster_avatar' => '', 'poster_from' => '', 'poster_regdate' => '', 'poster_postnum' => '', 'poster_sendpmtext' => '', 'poster_rank_title' => '', 'poster_rank_image' => '');
			$can_edit = $isadminormod ? true : false ;
			$can_delete = $isadminormod ? true : false ;
			$can_reply = $can_post ;
		}

		// locked topic
		if( $forumdata['topic_status'] == 1 ) {
			$can_edit = false ;
			$can_reply = false ;
		}
		
		$posticon = $eachpost->icon();
		if ( isset($posticon) && $posticon != '' ) {
			$post_image = '<a name="'.$eachpost->postid().'"><img src="'.XOOPS_URL.'/modules/xhnewbb/images/'.$eachpost->icon().'" alt="" /></a>';
		} else {
			$post_image =  '<a name="'.$eachpost->postid().'"><img src="'.XOOPS_URL.'/images/icons/no_posticon.gif" alt="" /></a>';
		}
		$xoopsTpl->append('topic_posts', array_merge($posterarr, array('post_id' => $eachpost->postid(), 'post_parent_id' => $eachpost->parent(), 'post_date' => formatTimestamp($eachpost->posttime(), 'm'), 'post_poster_ip'=> $eachpost->posterip(), 'post_image' => $post_image, 'post_title' => $eachpost->subject(), 'post_text' => $post_text, 'can_edit' => @$can_edit, 'can_delete' => @$can_delete, 'can_reply' => @$can_reply)));
		unset($eachposter);
	}
	if ( $total_posts > $forumdata['posts_per_page'] ) {
		include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
		$nav = new XoopsPageNav($total_posts, $forumdata['posts_per_page'], $start, "start", 'topic_id='.$topic_id.'&amp;viewmode='.$viewmode.'&amp;order='.$order);
		$xoopsTpl->assign('forum_page_nav', $nav->renderNav(4));
	} else {
		$xoopsTpl->assign('forum_page_nav', '');
	}
}

// create jump box
$xoopsTpl->assign(array('mod_url' => XOOPS_URL.'/modules/xhnewbb' , 'forum_jumpbox' => xhnewbb_make_jumpbox($forum), 'lang_forum_index' => _MD_XHNEWBB_FORUMINDEX, 'lang_alltopicsindex' => _MD_XHNEWBB_ALLTOPICSINDEX, 'lang_from' => _MD_XHNEWBB_FROM, 'lang_joined' => _MD_XHNEWBB_JOINED, 'lang_posts' => _MD_XHNEWBB_POSTS, 'lang_poster' => _MD_XHNEWBB_POSTER, 'lang_thread' => _MD_XHNEWBB_THREAD, 'lang_edit' => _EDIT, 'lang_delete' => _DELETE, 'lang_reply' => _REPLY, 'lang_postedon' => _MD_XHNEWBB_POSTEDON));

// Read in cookie of 'lastread' times
// GIJ eliminated unserialize
/* if( empty( $_COOKIE['xhnewbb_topic_lastread'] ) ) $topic_lastread = array();
else {
	$topic_lastreadtmp = explode( ',' , $_COOKIE['xhnewbb_topic_lastread'] ) ;
	foreach( $topic_lastreadtmp as $tmp ) {
		$idmin = explode( '|' , $tmp ) ;
		$id = empty( $idmin[0] ) ? 0 : intval( $idmin[0] ) ;
		$min = empty( $idmin[1] ) ? 0 : intval( $idmin[1] ) ;
		$topic_lastread[ $id ] = $min ;
	}
}*/
// GIJ end
// if cookie is not set for this topic, update view count and set cookie
/* if ( empty($topic_lastread[$topic_id]) ) {
	$sql = 'UPDATE '.$xoopsDB->prefix('xhnewbb_topics').' SET topic_views = topic_views + 1 WHERE topic_id ='. $topic_id;
	$xoopsDB->queryF($sql);
}*/



// Update cookie
// FIXME: doesn't check if 4kB limit of cookie is exceeded!
// Hack start Ryuji_edit(2003-09-15)　最新100topicに制限する

// GIJ serialize

/* $topic_lastread[$topic_id] = intval( ceil( time() / 60 ) ) ;

arsort($topic_lastread);

$counter = 250 ;
$str4cookie = '' ;
foreach( $topic_lastread as $id => $time ) {
	$str4cookie .= intval( $id ) . '|' . intval( $time ) . ',' ;
	if( -- $counter < 0 ) break ;
}
$str4cookie = substr( $str4cookie , 0 , -1 ) ; */


// remove old cookies
setcookie( "xhnewbb_topic_lastread" , '' , time()-3600 ) ;

// count up
if( @$_SESSION['xhnewbb_last_topic_id'] != $topic_id ) {
	$_SESSION['xhnewbb_last_topic_id'] = $topic_id ;
	$xoopsDB->queryF( "UPDATE ".$xoopsDB->prefix("xhnewbb_topics")." SET topic_views = topic_views + 1 WHERE topic_id = '$topic_id'" ) ;
}

if( is_object( @$xoopsUser ) ) {

	$uid = $xoopsUser->getVar('uid') ;

	// already read
	$result = $xoopsDB->query( 'SELECT u2t_time,u2t_marked FROM '.$xoopsDB->prefix('xhnewbb_users2topics')." WHERE uid='$uid' AND topic_id='$topic_id'" ) ;
	if( $xoopsDB->getRowsNum( $result ) ) {
		list( $u2t_time , $u2t_marked ) = $xoopsDB->fetchRow( $result ) ;
	} else {
		list( $u2t_time , $u2t_marked ) = array( 0 , 0 ) ;
	}

	if( $u2t_time <= $forumdata['topic_time'] || ! empty( $_GET['change_u2t_mark'] ) ) {

		// u2t_marked on/off
		$set_u2t_marked = '' ;
		if( ! empty( $xoopsModuleConfig['xhnewbb_allow_mark'] ) && ! empty( $_GET['change_u2t_mark'] ) ) {
			$u2t_marked = $_GET['change_u2t_mark'] == 'on' ? 1 : 0 ;
			$set_u2t_marked = ",u2t_marked=$u2t_marked" ;
		}
		// update/insert u2t table
		$xoopsDB->queryF( 'UPDATE '.$xoopsDB->prefix('xhnewbb_users2topics')." SET u2t_time=".time().$set_u2t_marked." WHERE uid='$uid' AND topic_id='$topic_id'" ) ;
		if( ! $xoopsDB->getAffectedRows() ) $xoopsDB->queryF( 'INSERT INTO '.$xoopsDB->prefix('xhnewbb_users2topics')." SET uid='$uid',topic_id='$topic_id',u2t_time=".time().$set_u2t_marked ) ;
	}
} else {
	$uid = 0 ;
	$u2t_time = 0 ;
	$u2t_marked = 0 ;
}

$xoopsTpl->assign( 'uid' , $uid ) ;
$xoopsTpl->assign( 'isadminormod' , $isadminormod ) ;
$xoopsTpl->assign( 'u2t_time' , $u2t_time ) ;
$xoopsTpl->assign( 'u2t_marked' , $u2t_marked ) ;
$xoopsTpl->assign( 'allow_mark' , @$xoopsModuleConfig['xhnewbb_allow_mark'] ) ;

$xoopsTpl->assign('upper_topic', _MD_XHNEWBB_UPPERTOPIC); //jidaikobo
$xoopsTpl->assign('lower_topic', _MD_XHNEWBB_LOWERTOPIC); //jidaikobo


// setcookie("xhnewbb_topic_lastread", $str4cookie , time()+365*24*3600, $bbCookie['path'], $bbCookie['domain'], $bbCookie['secure']);

$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ) ) ;


include XOOPS_ROOT_PATH.'/footer.php';
?>
