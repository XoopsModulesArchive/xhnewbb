<?php
// $Id: main.php,v 1.2 2003/12/17 09:42:25 gij Exp $
//%%%%%%		Module Name phpBB  		%%%%%





// Appended by Xoops Language Checker -GIJOE- in 2006-09-12 17:51:39
define('_MD_XHNEWBB_DELTIMELIMITED','Sorry, it has been expired to delete this post');
define('_MD_XHNEWBB_DELCHILDEXISTS','Sorry, any parent posts cannot be removed.');
define('_MD_XHNEWBB_AREUSUREDELONE','Are you sure you want to delete this post?');
define('_MD_XHNEWBB_CUTPASTEPOSTS','Cut and paste posts');
define('_MD_XHNEWBB_ERROR_PIDLOOP','parent/child loop error');
define('_MD_XHNEWBB_CHILDREN_COUNT','child posts');
define('_MD_XHNEWBB_CUTPASTEPOSTS_DEST','destination post_id');
define('_MD_XHNEWBB_CUTPASTEPOSTSDSC','Specify post_id to be parent of this post. 0 means creating a new topic.');
define('_MD_XHNEWBB_CUTPASTESUCCESS','The post has been cut and/or pasted successfully');

// Appended by Xoops Language Checker -GIJOE- in 2006-08-07 17:50:20
define('_MD_XHNEWBB_ALT_ICON1','normal');
define('_MD_XHNEWBB_ALT_ICON2','unhappy');
define('_MD_XHNEWBB_ALT_ICON3','happy');
define('_MD_XHNEWBB_ALT_ICON4','raise it');
define('_MD_XHNEWBB_ALT_ICON5','lower it');
define('_MD_XHNEWBB_ALT_ICON6','report');
define('_MD_XHNEWBB_ALT_ICON7','question');
define('_MD_XHNEWBB_ALT_SOLVED','(solved)');
define('_MD_XHNEWBB_ALT_UNSOLVED','(unsolved)');

// Appended by Xoops Language Checker -GIJOE- in 2006-08-06 06:01:42
define('_MD_XHNEWBB_UPPERTOPIC','top of the posts');
define('_MD_XHNEWBB_LOWERTOPIC','bottom of the posts');

// Appended by Xoops Language Checker -GIJOE- in 2006-05-10 12:17:01
define('_MD_XHNEWBB_LATESTPOST','latest');
define('_MD_XHNEWBB_MARK_TURNON','mark this topic');
define('_MD_XHNEWBB_MARK_TURNOFF','unmark this topic');
define('_MD_XHNEWBB_THANKSEDIT','The post is modified');

define("_MD_XHNEWBB_UPDATE","Mise &agrave; jour");
define("_MD_XHNEWBB_UPDATED","Mis &agrave; jour");


//functions.php
define("_MD_XHNEWBB_ERROR","Erreur");
define("_MD_XHNEWBB_NOPOSTS","Aucun Message");
define("_MD_XHNEWBB_GO","Aller");

//index.php
define("_MD_XHNEWBB_FORUM","Forum");
define("_MD_XHNEWBB_WELCOME","Bienvenue dans les Forums de %s.");
define("_MD_XHNEWBB_TOPICS","Sujets");
define("_MD_XHNEWBB_POSTS","Messages");
define("_MD_XHNEWBB_LASTPOST","Dernier Message");
define("_MD_XHNEWBB_MODERATOR","Mod&eacute;rateur");
define("_MD_XHNEWBB_NEWPOSTS","Nouveaux messages");
define("_MD_XHNEWBB_NONEWPOSTS","Aucun nouveau message");
define("_MD_XHNEWBB_PRIVATEFORUM","Forum Priv&eacute;");
define("_MD_XHNEWBB_BY","par"); // Posted by
define("_MD_XHNEWBB_TOSTART","Pour commencer &agrave; visualiser les nouveaux messages, s&eacute;lectionner le forum que vous souhaitez visiter &agrave; partir de la boite de s&eacute;lection ci-dessous.");
define("_MD_XHNEWBB_TOTALTOPICSC","Nbre Total Sujets: ");
define("_MD_XHNEWBB_TOTALPOSTSC","Nbre Total Messages: ");
define("_MD_XHNEWBB_TIMENOW","Il est %s");
define("_MD_XHNEWBB_LASTVISIT","Votre derni&egrave;re visite: %s");
define("_MD_XHNEWBB_ADVSEARCH","Recherche Avanc&eacute;e");
define("_MD_XHNEWBB_POSTEDON","Post&eacute; le: ");
define("_MD_XHNEWBB_SUBJECT","Sujet");

//page_header.php
define("_MD_XHNEWBB_MODERATEDBY","Mod&eacute;rat&eacute; par");
define("_MD_XHNEWBB_SEARCH","Recherche");
define("_MD_XHNEWBB_SEARCHRESULTS","Page de R&eacute;sultats");
define("_MD_XHNEWBB_FORUMINDEX","Index du Forum");
define("_MD_XHNEWBB_ALLTOPICSINDEX","Index des Sujets");
define("_MD_XHNEWBB_POSTNEW","Poster un nouveau message");
define("_MD_XHNEWBB_REGTOPOST","S'enregister pour Poster");

//search.php
define("_MD_XHNEWBB_KEYWORDS","Mots clefs:");
define("_MD_XHNEWBB_SEARCHANY","Recherche pour CHACUN (=OU) des mots (par d&eacute;faut)");
define("_MD_XHNEWBB_SEARCHALL","Recherche pour tous les mots (=ET)");
define("_MD_XHNEWBB_SEARCHALLFORUMS","Recherche dans tous les Forums");
define("_MD_XHNEWBB_FORUMC","Forum");
define("_MD_XHNEWBB_SORTBY","Tr&eacute;e");
define("_MD_XHNEWBB_DATE","Date");
define("_MD_XHNEWBB_TOPIC","Sujet");
define("_MD_XHNEWBB_USERNAME","Nom Utilisateur");
define("_MD_XHNEWBB_SEARCHIN","Rechercher dans");
define("_MD_XHNEWBB_BODY","Corps du message");
define("_MD_XHNEWBB_NOMATCH","Aucun enregistrement trouv&eacute;. Merci d'affiner votre recherche.");
define("_MD_XHNEWBB_POSTTIME","Heure du D&eacute;p&ocirc;t Message");

//viewforum.php
define("_MD_XHNEWBB_REPLIES","R&eacute;ponses");
define("_MD_XHNEWBB_POSTER","Auteur");
define("_MD_XHNEWBB_VIEWS","Lectures");
define("_MD_XHNEWBB_MORETHAN","Nouveaux messages Populaires");
define("_MD_XHNEWBB_MORETHAN2","Aucun Nouveau message Populaires");
define("_MD_XHNEWBB_TOPICLOCKED","Le sujet est Verrouill&eacute;");
define("_MD_XHNEWBB_LEGEND","L&eacute;gende");
define("_MD_XHNEWBB_NEXTPAGE","Page Suivante");
define("_MD_XHNEWBB_SORTEDBY","Tri&eacute; par");
define("_MD_XHNEWBB_FORUMNAME","Nom du Forum");
define("_MD_XHNEWBB_TOPICTITLE","Titre du Sujet");
define("_MD_XHNEWBB_NUMBERREPLIES","Nombre de R&eacute;ponses");
define("_MD_XHNEWBB_TOPICPOSTER","Auteur du sujet");
define("_MD_XHNEWBB_LASTPOSTTIME","Dernier message");
define("_MD_XHNEWBB_ASCENDING","Ordre Ascendent");
define("_MD_XHNEWBB_DESCENDING","Ordre Descendant");
define("_MD_XHNEWBB_FROMLASTDAYS","Des derniers %s jours");
define("_MD_XHNEWBB_THELASTYEAR","De la derni&egrave;re ann&eacute;e");
define("_MD_XHNEWBB_BEGINNING","A partir du D&eacute;but");
define("_MD_XHNEWBB_WHRSOLVED","Statut:");
define("_MD_XHNEWBB_SOLVEDNO","Non r&eacute;solu");
define("_MD_XHNEWBB_SOLVEDYES","R&eacute;solu");
define("_MD_XHNEWBB_SOLVEDBOTH","Les Deux");

//viewtopic.php
define("_MD_XHNEWBB_AUTHOR","Auteur");
define("_MD_XHNEWBB_LOCKTOPIC","Verrouiller ce sujet");
define("_MD_XHNEWBB_UNLOCKTOPIC","D&eacute;verrouiller ce sujet");

define("_MD_XHNEWBB_MOVETOPIC","D&eacute;placer ce sujet");
define("_MD_XHNEWBB_DELETETOPIC","Supprimer ce sujet");
define("_MD_XHNEWBB_TOP","Top");
define("_MD_XHNEWBB_PARENT","Parent");
define("_MD_XHNEWBB_PREVTOPIC","Sujet Pr&eacute;c&eacute;dent");
define("_MD_XHNEWBB_NEXTTOPIC","Sujet Suivant");

//forumform.inc
define("_MD_XHNEWBB_ABOUTPOST","A propos de ce forum");
define("_MD_XHNEWBB_ANONCANPOST","Les utilisateurs <b>Anonymes</b> peuvent poster de nouveaux messages et r&eacute;pondre aux messages dans ce forum");
define("_MD_XHNEWBB_PRIVATE","Ce forum est un forum <b>Priv&eacute;</b>.<br />Seuls les utilisateurs avec un acc&egrave;s privil&eacute;gi&eacute; peuvent poster et r&eacute;pondre dans ce forum");
define("_MD_XHNEWBB_REGCANPOST","Tous les utilisateurs<b>Enregistr&eacute;es</b> peuvent poster de nouveaux messages et r&eacute;pondre aux messages dans ce forum");
define("_MD_XHNEWBB_MODSCANPOST","Seuls les <B>Mod&eacute;rateurs et les Administrateurs</b> peuvent poster de nouveaux messages et r&eacute;pondre aux messages dans ce forum");
define("_MD_XHNEWBB_PREVPAGE","Page Pr&eacute;c&eacute;dente");
define("_MD_XHNEWBB_QUOTE","Voter");

// ERROR messages
define("_MD_XHNEWBB_ERRORFORUM","ERREUR: Forum non s&eacute;lectionn&eacute;!");
define("_MD_XHNEWBB_ERRORPOST","ERREUR: Message non s&eacute;lectionn&eacute;!");
define("_MD_XHNEWBB_NORIGHTTOPOST","Vous n'&ecirc;tes pas autoris&eacute; &agrave; poster dans ce forum.");
define("_MD_XHNEWBB_NORIGHTTOACCESS","Vous n4&ecirc;tes pas autoris&eacute; &agrave; acc&eacute;der à ce forum.");
define("_MD_XHNEWBB_ERRORTOPIC","ERREUR: Sujet non s&eacute;lectionn&eacute;!");
define("_MD_XHNEWBB_ERRORCONNECT","ERREUR: Impossible de se connecter &agrave; la base de donn&eacute;es des forums.");
define("_MD_XHNEWBB_ERROREXIST","ERREUR: Le forum que vous avez s&eacute;lectionn&eacute; n'existe pas. Merci de revenir en arri&egrave;re et de r&eacute;essayer.");
define("_MD_XHNEWBB_ERROROCCURED","Une erreur est survenue");
define("_MD_XHNEWBB_COULDNOTQUERY","Impossible d'interroger la base de donn&eacute;es des forums.");
define("_MD_XHNEWBB_FORUMNOEXIST","Erreur - Le forum/sujet que vous avez s&eacute;lectionn&eacute; n'existe past. Merci de revenir en arri&egrave;re et de r&eacute;essayer.");
define("_MD_XHNEWBB_USERNOEXIST","Cet Utilisateur n'existe pas. Merci de revenir en arri&egrave;re et de rechercher de nouveau.");
define("_MD_XHNEWBB_COULDNOTREMOVE","Erreur - Impossible de supprimer les messages de la base de donn&eacute;es!");
define("_MD_XHNEWBB_COULDNOTREMOVETXT","Erreur - Impossible de Supprimer le texte du message!");

//reply.php
define("_MD_XHNEWBB_ON","le"); //Posted on
define("_MD_XHNEWBB_USERWROTE","%s a &eacute;crt:"); // %s is username

//post.php
define("_MD_XHNEWBB_FORMTITLEINPREVIEW","Pr&eacute;viualiser");
define("_MD_XHNEWBB_EDITNOTALLOWED","Vous n'&ecirc;tes pas autoris&eacute; à &eacute;diter ce message!");
define("_MD_XHNEWBB_EDITEDBY","Edit&eacute; par");
define("_MD_XHNEWBB_ANONNOTALLOWED","Les anonymes ne sont pas autoris&eacute;s &agrave; poster.<br>Merci de vous enregistrer.");
define("_MD_XHNEWBB_THANKSSUBMIT","Merci pour votre contribution!");
define("_MD_XHNEWBB_REPLYPOSTED","Une r&eacute;ponse à votre sujet a &eacute;t&eacute; post&eacute;e.");
define("_MD_XHNEWBB_HELLO","Bonjour %s,");
define("_MD_XHNEWBB_URRECEIVING","Vous recevez cet email parce qu'une r&eacute;ponse &agrave; votre message a &eacute;t&eacute; apport&eacute;e dans le forum %s ."); // %s is your site name
define("_MD_XHNEWBB_CLICKBELOW","Cliquer sur le lien ci-dessous pour visualiser la discussion:");
define("_MD_XHNEWBB_FMT_GUESTSPOSTHEADER","Message de %s en tant qu'invit&eacute;\n---\n\n");

//forumform.inc
define("_MD_XHNEWBB_YOURNAME","Votre Nom:");
define("_MD_XHNEWBB_LOGOUT","D&eacute;connecter");
define("_MD_XHNEWBB_REGISTER","S'enregistrer");
define("_MD_XHNEWBB_SUBJECTC","Sujet:");
define("_MD_XHNEWBB_EDITMODEC","Mode:");
define("_MD_XHNEWBB_ALERTEDIT","<div style='background:#FE0000;color:#FFFFFF;font-size:120%;font-weight:bold;padding:3px;'>Vous &ecirc;tes en train d'&eacute;diter votre message en ce moment</div>");
define("_MD_XHNEWBB_GUESTNAMEC","Votre Nom:");
define("_MD_XHNEWBB_UNAMEC","Auteur:");
define("_MD_XHNEWBB_FMT_UNAME","%s");
define("_MD_XHNEWBB_MESSAGEICON","Icone de Message:");
define("_MD_XHNEWBB_SOLVEDCHECKBOX","R&eacute;solu");
define("_MD_XHNEWBB_MESSAGEC","Message:");
define("_MD_XHNEWBB_ALLOWEDHTML","Autoriser le HTML:");
define("_MD_XHNEWBB_OPTIONS","Options:");
define("_MD_XHNEWBB_POSTANONLY","Post&eacute; Anonymement");
define("_MD_XHNEWBB_DISABLESMILEY","D&eacute;sactiver les smileys");
define("_MD_XHNEWBB_DISABLEHTML","Dis&eacute;sactiver le html");
define("_MD_XHNEWBB_NEWPOSTNOTIFY", "Notifiez-moi des nouveaux messages dans cette discussion");
define("_MD_XHNEWBB_ATTACHSIG","Attacher ma Signature");
define("_MD_XHNEWBB_POST","Message");
define("_MD_XHNEWBB_SUBMIT","Valider");
define("_MD_XHNEWBB_CANCELPOST","Annuler");

// forumuserpost.php
define("_MD_XHNEWBB_ADD","Ajouter");
define("_MD_XHNEWBB_REPLY","R&eacute;pondre");

// topicmanager.php
define("_MD_XHNEWBB_YANTMOTFTYCPTF","Vous n'&ecirc;tes pas mod&eacute;rateur de ce forum c'est pourquoi vous ne pouvez effectuer cette op&eacute;ration.");
define("_MD_XHNEWBB_TTHBRFTD","Ce sujet a &eacute;t&eacute; supprim&eacute; de la base de donn&eacute;es.");
define("_MD_XHNEWBB_RETURNTOTHEFORUM","Retourner au forum");
define("_MD_XHNEWBB_RTTFI","Retourner &agrave; l'index des forums");
define("_MD_XHNEWBB_EPGBATA","Erreur - Merci de revenir en arri&egrave;re et de r&eacute;essayer.");
define("_MD_XHNEWBB_TTHBM","Ce sujet a &eacute;t&eacute; d&eacute;plac&eacute;.");
define("_MD_XHNEWBB_VTUT","Voir le sujet mis &agrave; jour");
define("_MD_XHNEWBB_TTHBL","Le sujet a &eacute;t&eacute; verrouill&eacute;.");

define("_MD_XHNEWBB_VIEWTHETOPIC","Voir le sujet");
define("_MD_XHNEWBB_TTHBU","Le sujet a &eacute;t&eacute; d&eacute;verrouill&eacute;.");
define("_MD_XHNEWBB_OYPTDBATBOTFTTY","Une fois que vous aurez appuy&eacute; sur le bouton Supprimer en haut de ce formulaire, le sujet que vous avez s&eacute;lectionn&eacute;, ainsi que les messages associ&eacute;s, seront supprim&eacute;s <b>d&eacute;finitivement</b>.");
define("_MD_XHNEWBB_OYPTMBATBOTFTTY","Une fois que vous aurez appuy&eacute; sur le bouton D&eacute;placer  en haut de ce formulaire, le sujet que vous avez s&eacute;lectionn&eacute;, ainsi que les messages associ&eacute;s, seront d&eacute;plac&eacute;s dans le forum que vous avez s&eacute;lectionn&eacute;.");
define("_MD_XHNEWBB_OYPTLBATBOTFTTY","Une fois que vous aurez appuy&eacute; sur le bouton Verrouiller  en haut de ce formulaire, le sujet que vous avez s&eacute;lectionn&eacute; sera verrouill&eacute;. Vous pourrez le d&eacute;verrouiller plus tard si vous le souhaitez.");
define("_MD_XHNEWBB_OYPTUBATBOTFTTY","Une fois que vous aurez appuy&eacute; sur le bouton D&eacute;verrouiller  en haut de ce formulaire, le sujet que vous avez s&eacute;lectionn&eacute; sera d&eacute;verrouill&eacute;. Vous pourrez le verrouiller de nouveau plus tard si vous le souhaitez.");
define("_MD_XHNEWBB_MOVETOPICTO","D&eacute;placer ce sujet vers:");
define("_MD_XHNEWBB_NOFORUMINDB","Aucun forum dans la base de donn&eacute;es");
define("_MD_XHNEWBB_DATABASEERROR","Erreur Base de Ddonn&eacute;es");
define("_MD_XHNEWBB_DELTOPIC","Supprimer le sujet");
define("_MD_XHNEWBB_TOPICSTICKY","Le sujet est en Post-it");
define("_MD_XHNEWBB_STICKYTOPIC","Mettre ce sujet en Post-it");
define("_MD_XHNEWBB_UNSTICKYTOPIC","Enlever ce sujet du Post-it");
define("_MD_XHNEWBB_TTHBS","Le sujet a &eacute;t&eacute; mis en Post-it.");
define("_MD_XHNEWBB_TTHBUS","Le sujet a &eacute;t&eacute; enlev&eacute;du Post-it.");
define("_MD_XHNEWBB_OYPTSBATBOTFTTY","Une fois que vous aurez appuy&eacute; sur le bouton Post-it en haut de ce formulaire, le sujet s&eacute;lectionn&eacute; sera mis en Post-it. Vous pourrez l'enlever du Post-it plus tard si vous le souhaitez.");
define("_MD_XHNEWBB_OYPTTBATBOTFTTY","Une fois que vous aurez appuy&eacute; sur le bouton Enlever du Post-it en haut du formulaire, le sujet que vous avez s&eacute;lectionn&eacute; sera enlev&eacute; du Post-it. Vous pourrez le remettre en Post-i plus tard si vous le souhaitez.");

// delete.php
define("_MD_XHNEWBB_DELNOTALLOWED","D&eacute;sol&eacute;, mais vous n'&ecirc;tes pas autoris&eacute;  &agrave; supprimer ce message.");
define("_MD_XHNEWBB_AREUSUREDEL","Etes-vous sur de vouloir supprimer ce message et tous les messages enfants?");
define("_MD_XHNEWBB_POSTSDELETED","Le message s&eacute;lectionn&eacute; a &eacute;t&eacute; supprimé ainsi que tous les messages enfants.");

// definitions moved from global.
define("_MD_XHNEWBB_THREAD","Discussion");
define("_MD_XHNEWBB_FROM","De");
define("_MD_XHNEWBB_JOINED","Membre depuis");
define("_MD_XHNEWBB_ONLINE","En Ligne");
define("_MD_XHNEWBB_BOTTOM","Haut");

?>
