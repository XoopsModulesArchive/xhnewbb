<?php

include dirname(__FILE__).'/include/common_prepend.php' ;

if ( ! isset( $_POST['submit'] ) ) {
	$xoopsOption['template_main']= 'xhnewbb_search.html';
	include XOOPS_ROOT_PATH.'/header.php';

	// It avoids to display names of private forums.
	$sql = 'SELECT forum_name,forum_id FROM '.$xoopsDB->prefix('xhnewbb_forums').' WHERE forum_type=0' ;
	if( ! $result = $xoopsDB->query( $sql ) ) {
		exit("<big>"._MD_XHNEWBB_ERROROCCURED."</big><hr />"._MD_XHNEWBB_COULDNOTQUERY);
	}
	$select = '<select name="forum"><option value="">----</option>';
	while ( $row = $xoopsDB->fetchArray($result) ) {
		$select .= '<option value="'.$row['forum_id'].'">'.$row['forum_name'].'</option>
		';
	}
	$select .= '</select>';
	$xoopsTpl->assign("forum_selection_box", $select);

} else {

	$xoopsOption['template_main'] = 'xhnewbb_searchresults.html' ;
	include XOOPS_ROOT_PATH."/header.php" ;

	if( ! empty( $_POST['term'] ) ) {
		$term = $myts->stripSlashesGPC( $_POST['term'] ) ;
		$term4disp = htmlspecialchars( $term , ENT_QUOTES ) ;
		$term4sql = addslashes( $term ) ;
		if( defined( '_MD_XHNEWBB_MULTIBYTESPACES' ) ) {
			$term4sql = str_replace( explode( ',' , _MD_XHNEWBB_MULTIBYTESPACES ) , ' ' , $term4sql ) ;
		}
		$words = explode( ' ' , $term4sql ) ;
		$andor = @$_POST['addterms'] == "any" ? 'OR ' : 'AND' ;
		$whr_term = '' ;
		foreach( $words as $word4sql ) {
			switch( @$_POST['searchboth'] ) {
				case 'both':
					$whr_term .= " (p.subject LIKE '%$word4sql%' OR pt.post_text LIKE '%$word4sql%') $andor";
					break;
				case 'title':
					$whr_term .= " (p.subject LIKE '%$word4sql%') $andor";
					break;
				case 'text':
				default:
					$whr_term .= " (pt.post_text LIKE '%$word4sql%') $andor";
					break;
			}
		}
		$whr_term = substr( $whr_term , 0 , -3 ) ;
	} else {
		$whr_term = '1' ;
		$term4disp = '' ;
	}

	// forum_id
	require_once dirname(__FILE__).'/include/perm_functions.php' ;
	$whr_forum = "p.forum_id IN (".implode(",",xhnewbb_get_forums_can_read()).")" ;	$forum = intval( @$_POST['forum'] ) ;
	if( ! empty( $forum ) ) {
		$whr_forum .= "AND p.forum_id=$forum" ;
	}

	// uname
	if( ! empty( $_POST['search_username'] ) ) {
		$uname = $myts->stripSlashesGPC( $_POST['search_username'] ) ;
		$uname4disp = htmlspecialchars( $uname , ENT_QUOTES ) ;
		$uname4sql = addslashes( $uname ) ;
		$whr_uname = "u.uname='$uname4sql'" ;
	} else {
		$whr_uname = '1' ;
		$uname4disp = '' ;
	}

	$allowed_sortbys = array(
		"p.post_time" ,
		"p.post_time desc" ,
		"t.topic_title" ,
		"t.topic_title desc" ,
		"t.topic_views" ,
		"t.topic_views desc" ,
		"t.topic_replies" ,
		"t.topic_replies desc" ,
		"f.forum_name",
		"f.forum_name desc",
		"u.uname" ,
		"u.uname desc" ,
	) ;
	$sortby = in_array( @$_POST['sortby'] , $allowed_sortbys ) ? $_POST['sortby'] : "p.post_time desc" ;

	$sql = 'SELECT u.uid,f.forum_id, p.topic_id, u.uname, p.post_time,t.topic_title,t.topic_views,t.topic_replies,f.forum_name FROM '.$xoopsDB->prefix('xhnewbb_posts').' p LEFT JOIN '.$xoopsDB->prefix('xhnewbb_posts_text').' pt ON p.post_id = pt.post_id LEFT JOIN '.$xoopsDB->prefix('users').' u ON p.uid=u.uid LEFT JOIN '.$xoopsDB->prefix('xhnewbb_forums').' f ON p.forum_id = f.forum_id LEFT JOIN '.$xoopsDB->prefix('xhnewbb_topics')." t ON p.topic_id = t.topic_id WHERE ($whr_term) AND ($whr_forum) AND ($whr_uname) ORDER BY $sortby" ;

	// TODO
	if( ! $result = $xoopsDB->query( $sql , 100 , 0 ) ) {
		exit("<big>"._MD_XHNEWBB_ERROROCCURED."</big><hr />"._MD_XHNEWBB_COULDNOTQUERY);
	}
	if( ! $row = $xoopsDB->getRowsNum( $result ) ) {
		$xoopsTpl->assign("lang_nomatch", _MD_XHNEWBB_NOMATCH);
	} else {
		while ( $row = $xoopsDB->fetchArray($result) ) {
			$xoopsTpl->append( 'results' , array('forum_name' => $myts->makeTboxData4Show($row['forum_name']), 'forum_id' => $row['forum_id'], 'topic_id' => $row['topic_id'], 'topic_title' => $myts->makeTboxData4Show($row['topic_title']), 'topic_replies' => $row['topic_replies'], 'topic_views' => $row['topic_views'], 'user_id' => $row['uid'], 'user_name' => $myts->makeTboxData4Show($row['uname']), 'post_time' => formatTimestamp($row['post_time'], "m")));
		}
	}

	$xoopsTpl->assign( "prev_term", $term4disp ) ;
	$xoopsTpl->assign( "prev_uname" , $uname4disp ) ;
}


$xoopsTpl->assign("lang_keywords", _MD_XHNEWBB_KEYWORDS);
$xoopsTpl->assign("lang_searchany", _MD_XHNEWBB_SEARCHANY);
$xoopsTpl->assign("lang_searchall", _MD_XHNEWBB_SEARCHALL);
$xoopsTpl->assign("lang_forumc", _MD_XHNEWBB_FORUMC);
$xoopsTpl->assign("lang_searchallforums", _MD_XHNEWBB_SEARCHALLFORUMS);
$xoopsTpl->assign("lang_sortby", _MD_XHNEWBB_SORTBY);
$xoopsTpl->assign("lang_date", _MD_XHNEWBB_DATE);
$xoopsTpl->assign("lang_username", _MD_XHNEWBB_USERNAME);
$xoopsTpl->assign("lang_searchin", _MD_XHNEWBB_SEARCHIN);
$xoopsTpl->assign("lang_subject", _MD_XHNEWBB_SUBJECT);
$xoopsTpl->assign("lang_body", _MD_XHNEWBB_BODY);

$xoopsTpl->assign("lang_forumindex",_MD_XHNEWBB_FORUMINDEX);
$xoopsTpl->assign("lang_alltopicsindex",_MD_XHNEWBB_ALLTOPICSINDEX);
$xoopsTpl->assign("mod_url" , XOOPS_URL.'/modules/xhnewbb' ) ;
$xoopsTpl->assign("lang_search", _MD_XHNEWBB_SEARCH);
$xoopsTpl->assign("lang_forum", _MD_XHNEWBB_FORUM);
$xoopsTpl->assign("lang_topic", _MD_XHNEWBB_TOPIC);
$xoopsTpl->assign("lang_author", _MD_XHNEWBB_AUTHOR);
$xoopsTpl->assign('lang_replies', _MD_XHNEWBB_REPLIES);
$xoopsTpl->assign('lang_views', _MD_XHNEWBB_VIEWS);
$xoopsTpl->assign("lang_possttime", _MD_XHNEWBB_POSTTIME);
$xoopsTpl->assign("lang_searchresults", _MD_XHNEWBB_SEARCHRESULTS);
$xoopsTpl->assign("img_folder", $bbImage['folder_topic']);

$xoopsTpl->assign( array( "xoops_module_header" => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['xhnewbb_css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ) ) ;


include XOOPS_ROOT_PATH.'/footer.php';
?>