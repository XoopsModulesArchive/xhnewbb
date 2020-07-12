<?php
// $Id: admin.php,v 1.1.1.1 2003/11/26 05:17:35 ryuji_amano Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MD_XHNEWBB_A_FORUMCONF","Configuração do fórum");
define("_MD_XHNEWBB_A_ADDAFORUM","Criar um fórum");
define("_MD_XHNEWBB_A_LINK2ADDFORUM","Este link permite que você crie um fórum no banco de dados.");
define("_MD_XHNEWBB_A_EDITAFORUM","Editar um fórum");
define("_MD_XHNEWBB_A_LINK2EDITFORUM","Este link permite que você edite um fórum existente.");
define("_MD_XHNEWBB_A_SETPRIVFORUM","Ajustar permissões privadas do fórum");
define("_MD_XHNEWBB_A_LINK2SETPRIV","Este link permite que você configure o acesso a um fórum privado existente.");
define("_MD_XHNEWBB_A_SYNCFORUM","Sincronizar índices de Fóruns/Tópicos");
define("_MD_XHNEWBB_A_LINK2SYNC","Este link te permite sincronizar os índeces Fórum e Tópico para consertar qualquer erro que possa aparecer");
define("_MD_XHNEWBB_A_ADDACAT","Criar categoria");
define("_MD_XHNEWBB_A_LINK2ADDCAT","Este link permite que você adicione uma categoria nova para colocar fóruns.");
define("_MD_XHNEWBB_A_EDITCATTTL","Editar título da categoria");
define("_MD_XHNEWBB_A_LINK2EDITCAT","Este link permite editar o titulo de uma categoria.");
define("_MD_XHNEWBB_A_RMVACAT","Apagar categoria");
define("_MD_XHNEWBB_A_LINK2RMVCAT","Este link permite remover categorias do banco de dados");
define("_MD_XHNEWBB_A_REORDERCAT","Reordenar Categorias");
define("_MD_XHNEWBB_A_LINK2ORDERCAT","Este link permitirá que você mude a ordem em que suas categorias aparecem no índice da página");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MD_XHNEWBB_A_FORUMUPDATED","Fórum atualizado");
define("_MD_XHNEWBB_A_HTSMHNBRBITHBTWNLBAMOTF","O(s) moderador(es) selecionado(s) provavelmente não foram removidos, pois, se tivessem sido, não haveriam mais moderadores neste fórum.");
define("_MD_XHNEWBB_A_FORUMREMOVED","Fórum Removido.");
define("_MD_XHNEWBB_A_FRFDAWAIP","Fórum removido da base de dados com todas as suas mensagens.");
define("_MD_XHNEWBB_A_NOSUCHFORUM","Nenhum fórum");
define("_MD_XHNEWBB_A_EDITTHISFORUM","Editar este fórum");
define("_MD_XHNEWBB_A_DTFTWARAPITF","Apagar fórum (Serão removidos o Fórum e todas as suas mensagens.<br><br>ATENÇÃO: Você tem certeza que quer excluir este Fórum?!)");
define("_MD_XHNEWBB_A_FORUMNAME","Nome do fórum:");
define("_MD_XHNEWBB_A_FORUMDESCRIPTION","Descrição do Fórum:");
define("_MD_XHNEWBB_A_MODERATOR","Moderador(es):");
define("_MD_XHNEWBB_A_REMOVE","Apagar");
define("_MD_XHNEWBB_A_NOMODERATORASSIGNED","Nenhum moderador atribuído");
define("_MD_XHNEWBB_A_NONE","Nenhum");
define("_MD_XHNEWBB_A_CATEGORY","Categoria:");
define("_MD_XHNEWBB_A_ANONYMOUSPOST","Visitante");
define("_MD_XHNEWBB_A_REGISTERUSERONLY","Somente usuários registrados");
define("_MD_XHNEWBB_A_MODERATORANDADMINONLY","Somente Moderadores/Administradores");
define("_MD_XHNEWBB_A_TYPE","Público ou Privado:");
define("_MD_XHNEWBB_A_PUBLIC","Público");
define("_MD_XHNEWBB_A_PRIVATE","Privado");
define("_MD_XHNEWBB_A_SELECTFORUMEDIT","Selecione o Fórum a ser editado");
define("_MD_XHNEWBB_A_NOFORUMINDATABASE","Não há fóruns no banco de dados");
define("_MD_XHNEWBB_A_DATABASEERROR","Erro banco de dados");
define("_MD_XHNEWBB_A_EDIT","Editar");
define("_MD_XHNEWBB_A_CATEGORYUPDATED","Atualizar Categoria.");
define("_MD_XHNEWBB_A_EDITCATEGORY","Editar categoria:");
define("_MD_XHNEWBB_A_CATEGORYTITLE","Título da categoria:");
define("_MD_XHNEWBB_A_SELECTACATEGORYEDIT","Selecione a categoria a ser editada");
define("_MD_XHNEWBB_A_CATEGORYCREATED","Categoria criada.");
define("_MD_XHNEWBB_A_NTWNRTFUTCYMDTVTEFS","Nota: Isto NÃO irá excluir os fóruns desta categoria, para isso você deverá usar o Gerenciador de Fóruns.<br /><br />ATENÇÃO: Você tem certeza que quer excluir esta categoria?.");
define("_MD_XHNEWBB_A_REMOVECATEGORY","Apagar Categoria");
define("_MD_XHNEWBB_A_CREATENEWCATEGORY","Criar nova categoria");
define("_MD_XHNEWBB_A_YDNFOATPOTFDYAA","Você não preencheu todas as partes do formulário.<br>Você atribuiu pelo menos um moderador? Por favor, volte e corrija o formulário.");
define("_MD_XHNEWBB_A_FORUMCREATED","Fórum Criado.");
define("_MD_XHNEWBB_A_VTFYJC","Exibir o fórum criado.");
define("_MD_XHNEWBB_A_EYMAACBYAF","Erro, você deve adicionar uma categoria antes de adicionar fóruns");
define("_MD_XHNEWBB_A_CREATENEWFORUM","Criar um novo fórum");
define("_MD_XHNEWBB_A_ACCESSLEVEL","Nível de Acesso:");
define("_MD_XHNEWBB_A_CATEGORYMOVEUP","Mover categoria para cima");
define("_MD_XHNEWBB_A_TCIATHU","Esta é a categoria mais elevada.");
define("_MD_XHNEWBB_A_CATEGORYMOVEDOWN","Mover categoria para baixo");
define("_MD_XHNEWBB_A_TCIATLD","Esta é a categoria a mais baixa.");
define("_MD_XHNEWBB_A_SETCATEGORYORDER","Ajustar Ordem da Categoria");
define("_MD_XHNEWBB_A_TODHITOTCWDOTIP","A ordem mostrada aqui é a ordem que as categorias serão mostradas na página do índice. Para mover uma categoria para cima na ordem clique Suba para movê-la para baixo clique Desça .");
define("_MD_XHNEWBB_A_ECWMTCPUODITO","Cada clique moverá a categoria 1 posição para cima ou para baixo na ordem.");
define("_MD_XHNEWBB_A_CATEGORY1","Categoria");
define("_MD_XHNEWBB_A_MOVEUP","Suba");
define("_MD_XHNEWBB_A_MOVEDOWN","Desça");


define("_MD_XHNEWBB_A_FORUMUPDATE","Ajustes no Fórum Atualizados");
define("_MD_XHNEWBB_A_RETURNTOADMINPANEL","Retorne ao Painel Administrativo.");
define("_MD_XHNEWBB_A_ALLOWHTML","Ativar HTML:");
define("_MD_XHNEWBB_A_YES","Sim");
define("_MD_XHNEWBB_A_NO","Não");
define("_MD_XHNEWBB_A_ALLOWSIGNATURES","Ativar Assinaturas:");
define("_MD_XHNEWBB_A_HOTTOPICTHRESHOLD","Início do tópico:");
define("_MD_XHNEWBB_A_POSTPERPAGE","Tópicos por página:");
define("_MD_XHNEWBB_A_TITNOPPTTWBDPPOT","(Este é o número de mensagens por tópico que será indicado por página de um tópico)");
define("_MD_XHNEWBB_A_TOPICPERFORUM","Tópicos por fórum:");
define("_MD_XHNEWBB_A_TITNOTPFTWBDPPOAF","(Este é o número dos tópicos por o fórum que será indicado por página de um fórum)");
define("_MD_XHNEWBB_A_WEIGHTOFFORUM","peso:");
define("_MD_XHNEWBB_A_SAVECHANGES","Salvar modificações");
define("_MD_XHNEWBB_A_CLEAR","Limpar");
define("_MD_XHNEWBB_A_CLICKBELOWSYNC","Clicar no botão abaixo irá sincronizar seus fóruns e as páginas de tópicos com os dados corretos do banco de dados. Use esta seção toda vez que verificar falhas nas listas de tópicos ou fóruns.");
define("_MD_XHNEWBB_A_SYNCHING","Sincronizando o índice do fórum e tópicos (pode demorar alguns minutos");
define("_MD_XHNEWBB_A_DONESYNC","Completo!");
define("_MD_XHNEWBB_A_CATEGORYDELETED","Categoria apagada.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MD_XHNEWBB_A_SAFTE","Selecione o Fórum para Editar");
define("_MD_XHNEWBB_A_NFID","Não há fórums no banco de dados");
define("_MD_XHNEWBB_A_EFPF","Editando permissões do fórum: <b>%s</b>");
define("_MD_XHNEWBB_A_UWA","Usuários Com Acesso:");
//define("_MD_XHNEWBB_A_UWOA","Users Without Access:");
//define("_MD_XHNEWBB_A_ADDUSERS","Add Users -->");
define("_MD_XHNEWBB_A_CLEARALLUSERS","Apagar usuários");
//define("_MD_XHNEWBB_A_REVOKEPOSTING","revoke posting");
//define("_MD_XHNEWBB_A_GRANTPOSTING","grant posting");
define("_MD_XHNEWBB_A_GROUPPERMS","Permissões por grupos:");
define("_MD_XHNEWBB_A_TH_CAN_READ","Ver");
define("_MD_XHNEWBB_A_TH_CAN_POST","Msg");
define("_MD_XHNEWBB_A_TH_UID","uid");
define("_MD_XHNEWBB_A_TH_UNAME","uname");
define("_MD_XHNEWBB_A_TH_GROUPNAME","Grupo");
define("_MD_XHNEWBB_A_NOTICE_ADDUSERS","É necessário introduzir uid (como número) ou nome de usuário (uname) se você quiser adicionar um usuário.<br />
Desmarcar 'Ver' e 'Post' esconde o nome do usuário na lista
");
?>
