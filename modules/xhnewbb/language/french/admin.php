<?php
// $Id: admin.php,v 1.1.1.1 2003/11/26 05:17:35 ryuji_amano Exp $
//%%%%%%	File Name  index.php   	%%%%%


// Appended by Xoops Language Checker -GIJOE- in 2006-05-23 05:19:25
define('_MD_XHNEWBB_A_GROUPPERMS','Permissions per groups:');
define('_MD_XHNEWBB_A_TH_CAN_READ','View');
define('_MD_XHNEWBB_A_TH_CAN_POST','Post');
define('_MD_XHNEWBB_A_TH_UID','uid');
define('_MD_XHNEWBB_A_TH_UNAME','uname');
define('_MD_XHNEWBB_A_TH_GROUPNAME','Group');
define('_MD_XHNEWBB_A_NOTICE_ADDUSERS','It is necessary to input either uid (as number) or user name (uname) if you want to add a user.<br />Unchecking \'View\' and \'Vost\' hides the user\'s name in the list');

// Appended by Xoops Language Checker -GIJOE- in 2006-05-10 12:17:01
define('_MD_XHNEWBB_A_WEIGHTOFFORUM','weight:');

define("_MD_XHNEWBB_A_FORUMCONF","Configuration du Forum");
define("_MD_XHNEWBB_A_ADDAFORUM","Ajouter un Forum");
define("_MD_XHNEWBB_A_LINK2ADDFORUM","Ce lien vous menera &agrave; une page o&ugrave; vous pourrez ajouter un forum dans la base de donn&eacute;es.");
define("_MD_XHNEWBB_A_EDITAFORUM","Editer un Forum");
define("_MD_XHNEWBB_A_LINK2EDITFORUM","Ce lien vous permettra d'&eacute;diter un forum existant.");
define("_MD_XHNEWBB_A_SETPRIVFORUM","D&eacute;finir les Permissions du Forum Priv&eacute;");
define("_MD_XHNEWBB_A_LINK2SETPRIV","Ce lien vous permettra de d&eacute;finir les droits d'acc&egrave;s pour un forum priv&eacute; d&eacute;ja existant.");
define("_MD_XHNEWBB_A_SYNCFORUM","Index Page Synchronisation forum/sujet");
define("_MD_XHNEWBB_A_LINK2SYNC","Ce lien vous permettra de synchroniser les index des forums et des sujets lorsque vous remarquez des anomalies d'affichage ou de d&eacute;pendances sujets/forums");
define("_MD_XHNEWBB_A_ADDACAT","Ajouter une Cat&eacute;gorie");
define("_MD_XHNEWBB_A_LINK2ADDCAT","Ce lien vous permettra d'ajouter une nouvelle cat&eacute;gorie afin d'y ajouter de nouveaux forums.");
define("_MD_XHNEWBB_A_EDITCATTTL","Editer le titre de la cat&eacute;gorie");
define("_MD_XHNEWBB_A_LINK2EDITCAT","Ce lien vous permettra d'&eacute;diter le titre d'une cat&eacute;gorie.");
define("_MD_XHNEWBB_A_RMVACAT","Supprimer la Cat&eacute;gorie");
define("_MD_XHNEWBB_A_LINK2RMVCAT","Ce lien vous permettra de supprimer une cat&eacute;gorie de la base de donn&eacute;es");
define("_MD_XHNEWBB_A_REORDERCAT","Re-Ordonner les Cat&eacute;gories");
define("_MD_XHNEWBB_A_LINK2ORDERCAT","Ce lien vous permettra de modifier l'ordre dans lequel des cat&eacute;gories s'affichent dans la page d'index");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MD_XHNEWBB_A_FORUMUPDATED","Forum mis &agrave; jour");
define("_MD_XHNEWBB_A_HTSMHNBRBITHBTWNLBAMOTF","Le(s) mod&eacute;rateur(s) s&eacute;lectionn&eacute;s ne doivent pas &ecirc;tre supprim&eacute;s sinon il n'y aura plus aucun mod&eacute;rateur dans ce forum.");
define("_MD_XHNEWBB_A_FORUMREMOVED","Forum Supprim&eacute;.");
define("_MD_XHNEWBB_A_FRFDAWAIP","Forum supprim&eacute; de la base de donn&eacute;es avec tout les discussions associ&eacute;es.");
define("_MD_XHNEWBB_A_NOSUCHFORUM","Aucun forum de ce type");
define("_MD_XHNEWBB_A_EDITTHISFORUM","Editer ce forum");
define("_MD_XHNEWBB_A_DTFTWARAPITF","Supprimer ce forum (ceci supprimera &eacute;galement toutes les discussions de ce forum!)");
define("_MD_XHNEWBB_A_FORUMNAME","Nom du Forum:");
define("_MD_XHNEWBB_A_FORUMDESCRIPTION","Description du Forum:");
define("_MD_XHNEWBB_A_MODERATOR","Mod&eacute;rateur(s):");
define("_MD_XHNEWBB_A_REMOVE","Supprimer");
define("_MD_XHNEWBB_A_NOMODERATORASSIGNED","Aucun Moderateur n'a &eacute;té D&eacute;sign&eacute;");
define("_MD_XHNEWBB_A_NONE","Aucun");
define("_MD_XHNEWBB_A_CATEGORY","Cat&eacute;gorie:");
define("_MD_XHNEWBB_A_ANONYMOUSPOST","Poster anonymement");
define("_MD_XHNEWBB_A_REGISTERUSERONLY","Seulement les Utilisateurs enregistr&eacute;s");
define("_MD_XHNEWBB_A_MODERATORANDADMINONLY","Mod&eacute;rateurs/Administrateurs seulement");
define("_MD_XHNEWBB_A_TYPE","Type:");
define("_MD_XHNEWBB_A_PUBLIC","Public");
define("_MD_XHNEWBB_A_PRIVATE","Priv&eacute;");
define("_MD_XHNEWBB_A_SELECTFORUMEDIT","S&eacute;lectionner un forum &agrave; Editer");
define("_MD_XHNEWBB_A_NOFORUMINDATABASE","Aucun Forum dans la Base de Donn&eacute;es");
define("_MD_XHNEWBB_A_DATABASEERROR","Erreur Base de Donn&eacute;es");
define("_MD_XHNEWBB_A_EDIT","Editer");
define("_MD_XHNEWBB_A_CATEGORYUPDATED","Cat&eacute;gorie mise &agrave; jour.");
define("_MD_XHNEWBB_A_EDITCATEGORY","Editer la &eacute;gorie:");
define("_MD_XHNEWBB_A_CATEGORYTITLE","Titre de la Cat&eacute;gorie:");
define("_MD_XHNEWBB_A_SELECTACATEGORYEDIT","S&eacute;lectionner la Cat&eacute;gorie &agrave; Editer");
define("_MD_XHNEWBB_A_CATEGORYCREATED","Cat&eacute;gorie cr&eacute;&eacute;e.");
define("_MD_XHNEWBB_A_NTWNRTFUTCYMDTVTEFS","Note: cela ne supprimera PAS les forums d&eacute;finis sous cette cat&eacute;gorie, vous devez effectuer cette op&eacute;ration via la section Editer les Forums.");
define("_MD_XHNEWBB_A_REMOVECATEGORY","Supprimer la Cat&eacute;gorie");
define("_MD_XHNEWBB_A_CREATENEWCATEGORY","Cr&eacute;er une nouvelle Cat&eacute;gorie");
define("_MD_XHNEWBB_A_YDNFOATPOTFDYAA","Vous n'avez pas rempli toutes les zones du formulaire.<br>Avez-vous d&eacute;sign&eacute; au moins un mod&eacute;rateur? Merci de revenir en arri&egrave;re et de corriger le formulaire.");
define("_MD_XHNEWBB_A_FORUMCREATED","Forum Cr&eacute;e.");
define("_MD_XHNEWBB_A_VTFYJC","Voir le forum que vous venez de cr&eacute;er.");
define("_MD_XHNEWBB_A_EYMAACBYAF","Erreur, vous devez cr&eacute;er au moins une cat&eacute;gorie avant d'ajouter des forums");
define("_MD_XHNEWBB_A_CREATENEWFORUM","Cr&eacute;er un nouveau Forum");
define("_MD_XHNEWBB_A_ACCESSLEVEL","Niveau d'Acc&egrave;s:");
define("_MD_XHNEWBB_A_CATEGORYMOVEUP","Cat&eacute;gorie Remont&eacute;e");
define("_MD_XHNEWBB_A_TCIATHU","Cette cat&eacute;gorie est d&eacute;ja la plus ca&eacute;gorie affich&eacute;e le plus en haut.");
define("_MD_XHNEWBB_A_CATEGORYMOVEDOWN","Cat&eacute;gorie Descendue");
define("_MD_XHNEWBB_A_TCIATLD","Cette cat&eacute;gorie est d&eacute;ja la plus ca&eacute;gorie affich&eacute;e le plus en bas.");
define("_MD_XHNEWBB_A_SETCATEGORYORDER","D&eacute;finir l'ordre des Cat&eacute;gories");
define("_MD_XHNEWBB_A_TODHITOTCWDOTIP","L'ordre d&eacute;fini ici sera l'ordre d'affichage des cat&eacute;gories dans la page d'index. Pour d&eacute;placer une cat&eacute;gorie en haut, cliquez sur Remonter, pour la d&eacute;placer en bas, cliquez sur Descendre.");
define("_MD_XHNEWBB_A_ECWMTCPUODITO","Chaque clic d&eacute;placera l'ordre de la cat&eacute;gorie d'une place en haut ou en bas selon le sens choisi.");
define("_MD_XHNEWBB_A_CATEGORY1","Cat&eacute;gorie");
define("_MD_XHNEWBB_A_MOVEUP","Monter");
define("_MD_XHNEWBB_A_MOVEDOWN","Descendre");


define("_MD_XHNEWBB_A_FORUMUPDATE","Param&eacute;trages Forum mis &agrave; jour");
define("_MD_XHNEWBB_A_RETURNTOADMINPANEL","Revenir &agrave; l'Administration.");
define("_MD_XHNEWBB_A_ALLOWHTML","Autoriser le HTML:");
define("_MD_XHNEWBB_A_YES","Oui");
define("_MD_XHNEWBB_A_NO","Non");
define("_MD_XHNEWBB_A_ALLOWSIGNATURES","Autoriser les Signatures:");
define("_MD_XHNEWBB_A_HOTTOPICTHRESHOLD","Mettre en &eacute;vidence les sujets chauds:");
define("_MD_XHNEWBB_A_POSTPERPAGE","Sujets par Page:");
define("_MD_XHNEWBB_A_TITNOPPTTWBDPPOT","(Ceci est le nombre de messages par discussion qui seront affich&eacute;s par page et dans une discussion)");
define("_MD_XHNEWBB_A_TOPICPERFORUM","Sujets par Forum:");
define("_MD_XHNEWBB_A_TITNOTPFTWBDPPOAF","(Ceci est le nombre de sujets par forum qui seront affich&eacute;s par page dans un forum)");
define("_MD_XHNEWBB_A_SAVECHANGES","Sauvegarder les Changements");
define("_MD_XHNEWBB_A_CLEAR","Supprimer");
define("_MD_XHNEWBB_A_CLICKBELOWSYNC","Un clic sur le bouton ci-dessous synchronisera vos forums et sujets avec les donn&eacute;es de la base de donn&eacute;es. Utilisez cette fonctionnalit&eacute; dès que vous remarquez des anomalies de d&eacute;pendance/affichage des listes de sujets/forums.");
define("_MD_XHNEWBB_A_SYNCHING","Synchroniser l'index du forum et les sujets (Ceci peut prendre du temps)");
define("_MD_XHNEWBB_A_DONESYNC","Fait!");
define("_MD_XHNEWBB_A_CATEGORYDELETED","Cat&eacute;gorie supprim&eacute;e.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MD_XHNEWBB_A_SAFTE","S&eacute;lectionner un Forum &agrave; Editer");
define("_MD_XHNEWBB_A_NFID","Aucun Forum dans la base de donn&eacute;es");
define("_MD_XHNEWBB_A_EFPF","D&eacute;finir les droits d'acc&egrave;s pour le forum : <b>%s</b>");
define("_MD_XHNEWBB_A_UWA","Utilisateurs avec Acc&egrave;s:");
define("_MD_XHNEWBB_A_UWOA","Utilisateurs sans Acc&egrave;s:");
define("_MD_XHNEWBB_A_ADDUSERS","Ajouter des Utilisateurs -->");
define("_MD_XHNEWBB_A_CLEARALLUSERS","Supprimer tous les utilisateurs");
define("_MD_XHNEWBB_A_REVOKEPOSTING","revoquer le droit de poster");
define("_MD_XHNEWBB_A_GRANTPOSTING","autoriser le droit de poster");
?>