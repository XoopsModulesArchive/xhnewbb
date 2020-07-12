<?php
// $Id: modinfo.php,v 1.2 2004/12/20 04:23:18 gij Exp $
// Module Info

// The name of this module
define("_MI_XHNEWBB_NAME","F�rum");

// A brief description of this module
define("_MI_XHNEWBB_DESC","M�dulo de F�rum para XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_XHNEWBB_BNAME1","T�picos");
define("_MI_XHNEWBB_BDESC1","Este bloco pode ser usado para finalidades variadas.  Naturalmente, voc� pode faz�-lo se multiplicar.");

// Names of admin menu items
define("_MI_XHNEWBB_ADMENU1","Criar F�rum");
define("_MI_XHNEWBB_ADMENU2","Editar F�rum");
define("_MI_XHNEWBB_ADMENU3","Editar F�rum privado");
define("_MI_XHNEWBB_ADMENU4","Reordenar F�runs/T�picos");
define("_MI_XHNEWBB_ADMENU5","Criar Categoria");
define("_MI_XHNEWBB_ADMENU6","Editar Categoria");
define("_MI_XHNEWBB_ADMENU7","Apagar Categoria");
define("_MI_XHNEWBB_ADMENU8","Reordenar Categoria");
define("_MI_XHNEWBB_ADMENU_MYBLOCKSADMIN","Blocos&Grupos");
define("_MI_XHNEWBB_ADMENU_MYTPLSADMIN","Templates");

// configurations
define('_MI_XHNEWBB_ALLOW_TEXTIMG','Permitir que sejam mostradas imagens externas na mensagem');
define('_MI_XHNEWBB_ALLOW_TEXTIMGDSC','Se algum agressor postar uma imagem usando [img], ele poder� descobrir os IPs ou User-Agents dos usu�rios que visitaram seu site.');
define('_MI_XHNEWBB_ALLOW_SIGIMG','Permitir que insiram imagens externas na assinatura');
define('_MI_XHNEWBB_ALLOW_SIGIMGDSC','Se algum agressor postar uma imagem usando [img], ele poder� descobrir os IPs ou User-Agents dos usu�rios que visitaram seu site.');
define('_MI_XHNEWBB_USE_SOLVED','usar a fun��o RESOLVIDO');
define('_MI_XHNEWBB_USE_SOLVEDDSC','Voc� pode saber se o t�pico est� resolvido ou n�o resolvido pela cor do �cone da mensagem, etc.');
define('_MI_XHNEWBB_ALLOW_MARK','usar a fun��o MARCAR');
define('_MI_XHNEWBB_ALLOW_MARKDSC','Usu�rios registrados podem marcar cada t�pico');
define('_MI_XHNEWBB_VIEWALLBREAK','N�mero de quebra de p�ginas do viewallforum.php');
define('_MI_XHNEWBB_SELFEDITLIMIT','O limite de tempo para usu�rios editar em (sec)');
define('_MI_XHNEWBB_SELFEDITLIMITDSC','Permitir usu�rios normais poder edit�-la os posts, coloque o valor em segundos. Desabilitar usu�rios normais de poder edit�-lo, coloque 0.');
define('_MI_XHNEWBB_SELFDELLIMIT','Limite de tempo para os usu�rios apagar(sec)');
define('_MI_XHNEWBB_SELFDELLIMITDSC','Permitir usu�rios normais poder apagar os posts, coloque o valor em segundos. Desabilitar usu�rios normais de poder apagar, coloque 0. Em todo o caso, nenhuns dos posts principais, n�o podem ser removidos.');
define('_MI_XHNEWBB_CSS_URI','URI de CSS arquivo para este m�dulo');
define('_MI_XHNEWBB_CSS_URIDSC','o trajeto relativo ou absoluto pode ser ajustado. padr�o: index.css');

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_XHNEWBB_THREAD_NOTIFY', 'T�pico');
define ('_MI_XHNEWBB_THREAD_NOTIFYDSC', 'Op��es da notifica��o que se aplicam ao t�pico atual.');

define ('_MI_XHNEWBB_FORUM_NOTIFY', 'F�rum');
define ('_MI_XHNEWBB_FORUM_NOTIFYDSC', 'Op��es da notifica��o que se aplicam ao forum atual.');

define ('_MI_XHNEWBB_GLOBAL_NOTIFY', 'Global');
define ('_MI_XHNEWBB_GLOBAL_NOTIFYDSC', 'Op��es globais de notifica��o do f�rum.');

define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFY', 'Nova mensagem');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP', 'Avise-me sobre novas mensagens neste t�pico.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC', 'Receba avisos de novas mensagens no t�pico atual.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Nova mensagem no t�pico');

define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY', 'Novo T�pico');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP', 'Avise-me sobre novos t�picos deste f�rum.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC', 'Receba aviso quando um novo t�pico for iniciado no f�rum atual.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Novo t�pico no f�rum');

define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY', 'Novo f�rum');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP', 'Avise-me sobre novos f�runs.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC', 'Receba aviso quando for criado um novo f�rum.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notifica��o autom�tica: Novo f�rum');

define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY', 'Nova mensagem');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP', 'Avise-me de qualquer nova mensagem.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC', 'Receba aviso quando uma nova mensagem for enviada.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Nova mensagem');

define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFY', 'Nova Mensagem');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP', 'Avise-me sobre novas mensagens neste f�rum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC', 'Receba aviso quando uma nova mensagem for enviada para este f�rum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Nova mensagem no f�rum');

define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY', 'Nova Mensagem (texto completo)');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Avise-me de qualquer nova mensagem (inclui texto completo no aviso).');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Receba aviso com texto completo quando uma nova mensagem for enviada.');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notifica��o autom�tica: Nova mensagem (texto completo)');

?>
