<?php
// Module Info

// The name of this module
define("_MI_XHNEWBB_NAME","討論區");

// A brief description of this module
define("_MI_XHNEWBB_DESC","XOOPS討論區模組");

// Names of blocks for this module (Not all module has blocks)
define("_MI_XHNEWBB_BNAME1","發表一覽");
define("_MI_XHNEWBB_BDESC1","「編輯」這個區塊可以有很多不同的用途。當然，要設定幾個都沒有限制。");

define("_MI_XHNEWBB_ADMENU1","新增討論區");
define("_MI_XHNEWBB_ADMENU2","編輯討論區");
define("_MI_XHNEWBB_ADMENU3","私人討論區的設定");
define("_MI_XHNEWBB_ADMENU4","重新計算發表數");
define("_MI_XHNEWBB_ADMENU5","新增類別");
define("_MI_XHNEWBB_ADMENU6","編輯類別");
define("_MI_XHNEWBB_ADMENU7","刪除類別");
define("_MI_XHNEWBB_ADMENU8","更改類別的配置");
define("_MI_XHNEWBB_ADMENU_MYBLOCKSADMIN","區塊・群組管理");
define("_MI_XHNEWBB_ADMENU_MYTPLSADMIN","樣版管理");

// configurations
define('_MI_XHNEWBB_ALLOW_TEXTIMG','允許在發表內容中連結外部的圖檔');
define('_MI_XHNEWBB_ALLOW_TEXTIMGDSC','如果允許[img]標籤來連結外部的圖像，將有可能被擷取觀覽者的IP或是User-Agent等資訊。');
define('_MI_XHNEWBB_ALLOW_SIGIMG','允許在簽名檔中連結外部圖檔');
define('_MI_XHNEWBB_ALLOW_SIGIMGDSC','如果允許[img]標籤來連結外部的圖像，將有可能被擷取觀覽者的IP或是User-Agent等資訊。');
define('_MI_XHNEWBB_USE_SOLVED','使用問題解決功能');
define('_MI_XHNEWBB_USE_SOLVEDDSC','可以利用這個項目設定使用不同的圖檔來區分「已解決」的功能。');
define('_MI_XHNEWBB_ALLOW_MARK','使用話題追蹤功能');
define('_MI_XHNEWBB_ALLOW_MARKDSC','決定是否要開放登入會員自己可以設定注意的話題討論，追蹤後續情報的功能');
define('_MI_XHNEWBB_VIEWALLBREAK','標題一覽的標題數');
define('_MI_XHNEWBB_SELFEDITLIMIT','允許發表者可以重複編輯的時間(秒)');
define('_MI_XHNEWBB_SELFEDITLIMITDSC','設定會員要編輯自己曾經發表的文章時的許可時間，超過這個設定時間就無法再度編輯內容。如果一開始就不允許編輯請設定為 0 ');
define('_MI_XHNEWBB_SELFDELLIMIT','允許發表者可以刪除的時間(秒)');
define('_MI_XHNEWBB_SELFDELLIMITDSC','設定會員要刪除自己曾經發表的文章時的許可時間。不過一旦此文章之下有了回應，就無法刪除。如果一開始就不允許刪除請設定為 0 ');
define('_MI_XHNEWBB_CSS_URI','模組專用的CSS樣式表網址');
define('_MI_XHNEWBB_CSS_URIDSC','可以指定給予這個模組專屬的樣式表，網址允許相對路徑(模組資料夾內的CSS名稱)和絕對路徑(完整網址)。預設為 index.css 。');

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_XHNEWBB_THREAD_NOTIFY', '顯示中的主題'); 
define ('_MI_XHNEWBB_THREAD_NOTIFYDSC', '關於顯示中的主題選項');

define ('_MI_XHNEWBB_FORUM_NOTIFY', '顯示中的討論區內容'); 
define ('_MI_XHNEWBB_FORUM_NOTIFYDSC', '對於顯示中的討論區選項');

define ('_MI_XHNEWBB_GLOBAL_NOTIFY', '整個模組');
define ('_MI_XHNEWBB_GLOBAL_NOTIFYDSC', '關於整個模組的通知選項');

define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFY', '回應的發表');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYCAP', '有關這個主題有回應時的通知');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYDSC', '有關這個主題有回應時的通知');
define ('_MI_XHNEWBB_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 主題中有人回應了喔');

define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFY', '發表新主題');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYCAP', '在這個討論區中有新主題時的通知');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYDSC', '在這個討論區中有新主題時的通知');
define ('_MI_XHNEWBB_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 有新的主題公開了！');

define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFY', '新的討論區');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYCAP', '網站成立新討論區時的通知');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYDSC', '網站成立新討論區時的通知');
define ('_MI_XHNEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 有新的討論區！');

define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFY', '回應或新主題');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYCAP', '如果有新主題還是回應時的通知');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYDSC', '如果有新主題還是回應時的通知');
define ('_MI_XHNEWBB_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 有人發表新的內容了喔！');

define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFY', '發表新主題');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYCAP', '在這個討論區中有新主題時的通知');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYDSC', '在這個討論區中有新主題時的通知');
define ('_MI_XHNEWBB_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 討論區中有新的主題發表了！');

define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFY', '發表新主題或回應（包含內容）');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP', '有新主題或是新回應時的通知（包含內文）');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC', '有新主題或是新回應時的通知（包含內文）');
define ('_MI_XHNEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}: 有新的發表（包含內文）');


?>
