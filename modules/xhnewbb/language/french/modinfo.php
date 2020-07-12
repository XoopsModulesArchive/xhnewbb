<?php
// $Id: modinfo.php,v 1.2 2004/12/20 04:23:18 gij Exp $
// Module Info

// The name of this module


// Appended by Xoops Language Checker -GIJOE- in 2006-09-12 17:51:39
define('_MI_XHNEWBB_SELFEDITLIMIT','Time limit for users edit (sec)');
define('_MI_XHNEWBB_SELFEDITLIMITDSC','To allow normal users can edit his/her posts, set plus value as seconds. To disallow normal users can edit it, set 0.');
define('_MI_XHNEWBB_SELFDELLIMIT','Time limit for users delete (sec)');
define('_MI_XHNEWBB_SELFDELLIMITDSC','To allow normal users can delete his/her posts, set plus value as seconds. To disallow normal users can delete it, set 0. Anyway any parent posts cannot be removed.');
define('_MI_XHNEWBB_CSS_URI','URI of CSS file for this module');
define('_MI_XHNEWBB_CSS_URIDSC','relative or absolute path can be set. default: index.css');

// Appended by Xoops Language Checker -GIJOE- in 2006-05-10 12:17:01
define('_MI_XHNEWBB_ADMENU_MYTPLSADMIN','Templates');
define('_MI_XHNEWBB_ALLOW_TEXTIMG','Allow to dipslay external images in the post');
define('_MI_XHNEWBB_ALLOW_TEXTIMGDSC','If some attackers post an external image using [img], he can know IPs or User-Agents of users visited your site.');
define('_MI_XHNEWBB_ALLOW_SIGIMG','Allow to display external images in the signature');
define('_MI_XHNEWBB_ALLOW_SIGIMGDSC','If some attackers post an external image using [img], he can know IPs or User-Agents of users visited your site.');
define('_MI_XHNEWBB_USE_SOLVED','use the feature of SOLVED');
define('_MI_XHNEWBB_USE_SOLVEDDSC','You can find the topic is solved or unsolved by the color of message icons etc.');
define('_MI_XHNEWBB_ALLOW_MARK','use the feature of MARKING');
define('_MI_XHNEWBB_ALLOW_MARKDSC','Registered users can mark each topics');
define('_MI_XHNEWBB_VIEWALLBREAK','page break number of viewallforum.php');

define("_MI_XHNEWBB_NAME","Forum");

// A brief description of this module
define("_MI_XHNEWBB_DESC","Module de Forums pour XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_XHNEWBB_BNAME1","Sujets");
define("_MI_XHNEWBB_BDESC1","Ce bloc peut &ecirc;tre utilis&eacute; pour diff&eacute;rents usages. Bien s&ucirc;r vous pouvez le dupliquer.");


// Names of admin menu items
define("_MI_XHNEWBB_ADMENU1","Ajouter un Forum");
define("_MI_XHNEWBB_ADMENU2","Editer un Forum");
define("_MI_XHNEWBB_ADMENU3","Editer un Forum Priv&eacute;");
define("_MI_XHNEWBB_ADMENU4","Synchroniser forums/sujets");
define("_MI_XHNEWBB_ADMENU5","Ajouter une Cat&eacute;gorie");
define("_MI_XHNEWBB_ADMENU6","Editer une Cat&eacute;gorie");
define("_MI_XHNEWBB_ADMENU7","Supprimer une Cat&eacute;gorie");
define("_MI_XHNEWBB_ADMENU8","Re-ordonner les Cat&eacute;gories");
define("_MI_XHNEWBB_ADMENU_MYBLOCKSADMIN","Blocs et Groupes");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_XHNEWBB_THREAD_NOTIFY', 'Sujet');
define ("_MI_XHNEWBB_THREAD_NOTIFYDSC", "Options de notification qui s'appliquent au sujet courant.");

define ('_MI_XHNEWBB_FORUM_NOTIFY', 'Forum');
define ("_MI_XHNEWBB_FORUM_NOTIFYDSC", "Options de Notification qui s'appliquent au forum courant.");

define ('_MI_XHNEWBB_GLOBAL_NOTIFY', 'Globale');
define ('_MI_XHNEWBB_GLOBAL_NOTIFYDSC', 'Options de notifications globales.');

define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFY', 'Nouveau message');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP', 'Notifiez-moi des nouveaux messages  dans le sujet courant.');
define ("_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC", "Recevoir des notifications lorsqu'un nouveau message est post&eacute; dans le sujet courant.");
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notification Automatique : Nouveau message dans le sujet');

define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY', 'Nouveau Sujet');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP', 'Notifiez-moi des nouveaux sujets dans le forum courant.');
define ("_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC", "Recevoir des notifications lorqu'un nouveau sujet est lanc&eacute; dans le forum courant.");
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Nouveau sujet dans le forum');

define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY', 'Nouveau Forum');
define ("_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP", "Notifiez-moi lorsqu'un nouveau forum est cr&eacute;e.");
define ("_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC", "Recevoir des notifications lorsqu'un nouveau forum est cr&eacute;e.");
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notification Automatique : Nouveau forum');

define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY', 'Nouveau Message');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP', 'Notifiez-moi pour tout nouveau message.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC', 'Recevoir une notification pour tout nouveau message post&eacute;.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notification Automatique : Nouveau message');

define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFY', 'Nouveau Mesage');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP', 'Notifier-moi pour tout nouveau message dans le forum courant.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC', 'Recevoir une notification pour tout nouveau message post&eacute; dans le forum courant.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notification Automatique : Nouveau message dans le forum');

define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY', 'Nouveau Message (texte complet)');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Notifier-moi de tout nouveau message (inclure le texte complet du message).');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Recevoir une notification incluant le texte complet du message pour tout nouveau message post&eacute;.');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notification Automatique : Nouveau Message (texte complet)');

?>
