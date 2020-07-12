<?php
// $Id: modinfo.php,v 1.2 2004/12/20 04:23:18 gij Exp $
// Module Info

// The name of this module
define("_MI_XHNEWBB_NAME","Forum");

// A brief description of this module
define("_MI_XHNEWBB_DESC","Forums module for XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_XHNEWBB_BNAME1","Topics");
define("_MI_XHNEWBB_BDESC1","This block can be used for multi-purpose. Of course, you can put it multiplly.");

// Names of admin menu items
define("_MI_XHNEWBB_ADMENU1","Add Forum");
define("_MI_XHNEWBB_ADMENU2","Edit Forum");
define("_MI_XHNEWBB_ADMENU3","Edit Priv. Forum");
define("_MI_XHNEWBB_ADMENU4","Sync forums/topics");
define("_MI_XHNEWBB_ADMENU5","Add Category");
define("_MI_XHNEWBB_ADMENU6","Edit Category");
define("_MI_XHNEWBB_ADMENU7","Delete Category");
define("_MI_XHNEWBB_ADMENU8","Re-order Category");
define("_MI_XHNEWBB_ADMENU_MYBLOCKSADMIN","Blocks&Groups");
define("_MI_XHNEWBB_ADMENU_MYTPLSADMIN","Templates");

// configurations
define('_MI_XHNEWBB_ALLOW_TEXTIMG','Allow to dipslay external images in the post');
define('_MI_XHNEWBB_ALLOW_TEXTIMGDSC','If some attackers post an external image using [img], he can know IPs or User-Agents of users visited your site.');
define('_MI_XHNEWBB_ALLOW_SIGIMG','Allow to display external images in the signature');
define('_MI_XHNEWBB_ALLOW_SIGIMGDSC','If some attackers post an external image using [img], he can know IPs or User-Agents of users visited your site.');
define('_MI_XHNEWBB_USE_SOLVED','use the feature of SOLVED1');
define('_MI_XHNEWBB_USE_SOLVEDDSC','You can find the topic is solved or unsolved by the color of message icons etc.');
define('_MI_XHNEWBB_ALLOW_MARK','use the feature of MARKING');
define('_MI_XHNEWBB_ALLOW_MARKDSC','Registered users can mark each topics');
define('_MI_XHNEWBB_VIEWALLBREAK','page break number of viewallforum.php');
define('_MI_XHNEWBB_SELFEDITLIMIT','Time limit for users edit (sec)');
define('_MI_XHNEWBB_SELFEDITLIMITDSC','To allow normal users can edit his/her posts, set plus value as seconds. To disallow normal users can edit it, set 0.');
define('_MI_XHNEWBB_SELFDELLIMIT','Time limit for users delete (sec)');
define('_MI_XHNEWBB_SELFDELLIMITDSC','To allow normal users can delete his/her posts, set plus value as seconds. To disallow normal users can delete it, set 0. Anyway any parent posts cannot be removed.');
define('_MI_XHNEWBB_CSS_URI','URI of CSS file for this module');
define('_MI_XHNEWBB_CSS_URIDSC','relative or absolute path can be set. default: index.css');

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_XHNEWBB_THREAD_NOTIFY', 'Thread');
define ('_MI_XHNEWBB_THREAD_NOTIFYDSC', 'Notification options that apply to the current thread.');

define ('_MI_XHNEWBB_FORUM_NOTIFY', 'Forum');
define ('_MI_XHNEWBB_FORUM_NOTIFYDSC', 'Notification options that apply to the current forum.');

define ('_MI_XHNEWBB_GLOBAL_NOTIFY', 'Global');
define ('_MI_XHNEWBB_GLOBAL_NOTIFYDSC', 'Global forum notification options.');

define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFY', 'New Post');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP', 'Notify me of new posts in the current thread.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC', 'Receive notification when a new message is posted to the current thread.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post in thread');

define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY', 'New Thread');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP', 'Notify me of new topics in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC', 'Receive notification when a new thread is started in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New thread in forum');

define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY', 'New Forum');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP', 'Notify me when a new forum is created.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC', 'Receive notification when a new forum is created.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New forum');

define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY', 'New Post');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP', 'Notify me of any new posts.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC', 'Receive notification when any new message is posted.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post');

define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFY', 'New Post');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP', 'Notify me of any new posts in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC', 'Receive notification when any new message is posted in the current forum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post in forum');

define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY', 'New Post (Full Text)');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Notify me of any new posts (include full text in message).');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Receive full text notification when any new message is posted.');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post (full text)');

?>
