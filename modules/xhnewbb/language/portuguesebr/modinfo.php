<?php
// $Id: modinfo.php,v 1.2 2004/12/20 04:23:18 gij Exp $
// Module Info

// The name of this module
define("_MI_XHNEWBB_NAME","Fórum");

// A brief description of this module
define("_MI_XHNEWBB_DESC","Módulo de Fórum para XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_XHNEWBB_BNAME1","Tópicos");
define("_MI_XHNEWBB_BDESC1","Este bloco pode ser usado para finalidades variadas.  Naturalmente, você pode fazê-lo se multiplicar.");

// Names of admin menu items
define("_MI_XHNEWBB_ADMENU1","Criar Fórum");
define("_MI_XHNEWBB_ADMENU2","Editar Fórum");
define("_MI_XHNEWBB_ADMENU3","Editar Fórum privado");
define("_MI_XHNEWBB_ADMENU4","Reordenar Fóruns/Tópicos");
define("_MI_XHNEWBB_ADMENU5","Criar Categoria");
define("_MI_XHNEWBB_ADMENU6","Editar Categoria");
define("_MI_XHNEWBB_ADMENU7","Apagar Categoria");
define("_MI_XHNEWBB_ADMENU8","Reordenar Categoria");
define("_MI_XHNEWBB_ADMENU_MYBLOCKSADMIN","Blocos&Grupos");
define("_MI_XHNEWBB_ADMENU_MYTPLSADMIN","Templates");

// configurations
define('_MI_XHNEWBB_ALLOW_TEXTIMG','Permitir que sejam mostradas imagens externas na mensagem');
define('_MI_XHNEWBB_ALLOW_TEXTIMGDSC','Se algum agressor postar uma imagem usando [img], ele poderá descobrir os IPs ou User-Agents dos usuários que visitaram seu site.');
define('_MI_XHNEWBB_ALLOW_SIGIMG','Permitir que insiram imagens externas na assinatura');
define('_MI_XHNEWBB_ALLOW_SIGIMGDSC','Se algum agressor postar uma imagem usando [img], ele poderá descobrir os IPs ou User-Agents dos usuários que visitaram seu site.');
define('_MI_XHNEWBB_USE_SOLVED','usar a função RESOLVIDO');
define('_MI_XHNEWBB_USE_SOLVEDDSC','Você pode saber se o tópico está resolvido ou não resolvido pela cor do ícone da mensagem, etc.');
define('_MI_XHNEWBB_ALLOW_MARK','usar a função MARCAR');
define('_MI_XHNEWBB_ALLOW_MARKDSC','Usuários registrados podem marcar cada tópico');
define('_MI_XHNEWBB_VIEWALLBREAK','Número de quebra de páginas do viewallforum.php');
define('_MI_XHNEWBB_SELFEDITLIMIT','O limite de tempo para usuários editar em (sec)');
define('_MI_XHNEWBB_SELFEDITLIMITDSC','Permitir usuários normais poder editá-la os posts, coloque o valor em segundos. Desabilitar usuários normais de poder editá-lo, coloque 0.');
define('_MI_XHNEWBB_SELFDELLIMIT','Limite de tempo para os usuários apagar(sec)');
define('_MI_XHNEWBB_SELFDELLIMITDSC','Permitir usuários normais poder apagar os posts, coloque o valor em segundos. Desabilitar usuários normais de poder apagar, coloque 0. Em todo o caso, nenhuns dos posts principais, não podem ser removidos.');
define('_MI_XHNEWBB_CSS_URI','URI de CSS arquivo para este módulo');
define('_MI_XHNEWBB_CSS_URIDSC','o trajeto relativo ou absoluto pode ser ajustado. padrão: index.css');

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_XHNEWBB_THREAD_NOTIFY', 'Tópico');
define ('_MI_XHNEWBB_THREAD_NOTIFYDSC', 'Opções da notificação que se aplicam ao tópico atual.');

define ('_MI_XHNEWBB_FORUM_NOTIFY', 'Fórum');
define ('_MI_XHNEWBB_FORUM_NOTIFYDSC', 'Opções da notificação que se aplicam ao forum atual.');

define ('_MI_XHNEWBB_GLOBAL_NOTIFY', 'Global');
define ('_MI_XHNEWBB_GLOBAL_NOTIFYDSC', 'Opções globais de notificação do fórum.');

define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFY', 'Nova mensagem');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP', 'Avise-me sobre novas mensagens neste tópico.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC', 'Receba avisos de novas mensagens no tópico atual.');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Nova mensagem no tópico');

define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY', 'Novo Tópico');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP', 'Avise-me sobre novos tópicos deste fórum.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC', 'Receba aviso quando um novo tópico for iniciado no fórum atual.');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Novo tópico no fórum');

define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY', 'Novo fórum');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP', 'Avise-me sobre novos fóruns.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC', 'Receba aviso quando for criado um novo fórum.');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notificação automática: Novo fórum');

define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY', 'Nova mensagem');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP', 'Avise-me de qualquer nova mensagem.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC', 'Receba aviso quando uma nova mensagem for enviada.');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Nova mensagem');

define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFY', 'Nova Mensagem');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP', 'Avise-me sobre novas mensagens neste fórum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC', 'Receba aviso quando uma nova mensagem for enviada para este fórum.');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificação : Nova mensagem no fórum');

define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY', 'Nova Mensagem (texto completo)');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Avise-me de qualquer nova mensagem (inclui texto completo no aviso).');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Receba aviso com texto completo quando uma nova mensagem for enviada.');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notificação automática: Nova mensagem (texto completo)');

?>
