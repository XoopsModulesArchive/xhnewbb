<?php
// $Id: admin.php,v 1.1.1.1 2003/11/26 05:17:35 ryuji_amano Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MD_XHNEWBB_A_FORUMCONF","Configura��o do f�rum");
define("_MD_XHNEWBB_A_ADDAFORUM","Criar um f�rum");
define("_MD_XHNEWBB_A_LINK2ADDFORUM","Este link permite que voc� crie um f�rum no banco de dados.");
define("_MD_XHNEWBB_A_EDITAFORUM","Editar um f�rum");
define("_MD_XHNEWBB_A_LINK2EDITFORUM","Este link permite que voc� edite um f�rum existente.");
define("_MD_XHNEWBB_A_SETPRIVFORUM","Ajustar permiss�es privadas do f�rum");
define("_MD_XHNEWBB_A_LINK2SETPRIV","Este link permite que voc� configure o acesso a um f�rum privado existente.");
define("_MD_XHNEWBB_A_SYNCFORUM","Sincronizar �ndices de F�runs/T�picos");
define("_MD_XHNEWBB_A_LINK2SYNC","Este link te permite sincronizar os �ndeces F�rum e T�pico para consertar qualquer erro que possa aparecer");
define("_MD_XHNEWBB_A_ADDACAT","Criar categoria");
define("_MD_XHNEWBB_A_LINK2ADDCAT","Este link permite que voc� adicione uma categoria nova para colocar f�runs.");
define("_MD_XHNEWBB_A_EDITCATTTL","Editar t�tulo da categoria");
define("_MD_XHNEWBB_A_LINK2EDITCAT","Este link permite editar o titulo de uma categoria.");
define("_MD_XHNEWBB_A_RMVACAT","Apagar categoria");
define("_MD_XHNEWBB_A_LINK2RMVCAT","Este link permite remover categorias do banco de dados");
define("_MD_XHNEWBB_A_REORDERCAT","Reordenar Categorias");
define("_MD_XHNEWBB_A_LINK2ORDERCAT","Este link permitir� que voc� mude a ordem em que suas categorias aparecem no �ndice da p�gina");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MD_XHNEWBB_A_FORUMUPDATED","F�rum atualizado");
define("_MD_XHNEWBB_A_HTSMHNBRBITHBTWNLBAMOTF","O(s) moderador(es) selecionado(s) provavelmente n�o foram removidos, pois, se tivessem sido, n�o haveriam mais moderadores neste f�rum.");
define("_MD_XHNEWBB_A_FORUMREMOVED","F�rum Removido.");
define("_MD_XHNEWBB_A_FRFDAWAIP","F�rum removido da base de dados com todas as suas mensagens.");
define("_MD_XHNEWBB_A_NOSUCHFORUM","Nenhum f�rum");
define("_MD_XHNEWBB_A_EDITTHISFORUM","Editar este f�rum");
define("_MD_XHNEWBB_A_DTFTWARAPITF","Apagar f�rum (Ser�o removidos o F�rum e todas as suas mensagens.<br><br>ATEN��O: Voc� tem certeza que quer excluir este F�rum?!)");
define("_MD_XHNEWBB_A_FORUMNAME","Nome do f�rum:");
define("_MD_XHNEWBB_A_FORUMDESCRIPTION","Descri��o do F�rum:");
define("_MD_XHNEWBB_A_MODERATOR","Moderador(es):");
define("_MD_XHNEWBB_A_REMOVE","Apagar");
define("_MD_XHNEWBB_A_NOMODERATORASSIGNED","Nenhum moderador atribu�do");
define("_MD_XHNEWBB_A_NONE","Nenhum");
define("_MD_XHNEWBB_A_CATEGORY","Categoria:");
define("_MD_XHNEWBB_A_ANONYMOUSPOST","Visitante");
define("_MD_XHNEWBB_A_REGISTERUSERONLY","Somente usu�rios registrados");
define("_MD_XHNEWBB_A_MODERATORANDADMINONLY","Somente Moderadores/Administradores");
define("_MD_XHNEWBB_A_TYPE","P�blico ou Privado:");
define("_MD_XHNEWBB_A_PUBLIC","P�blico");
define("_MD_XHNEWBB_A_PRIVATE","Privado");
define("_MD_XHNEWBB_A_SELECTFORUMEDIT","Selecione o F�rum a ser editado");
define("_MD_XHNEWBB_A_NOFORUMINDATABASE","N�o h� f�runs no banco de dados");
define("_MD_XHNEWBB_A_DATABASEERROR","Erro banco de dados");
define("_MD_XHNEWBB_A_EDIT","Editar");
define("_MD_XHNEWBB_A_CATEGORYUPDATED","Atualizar Categoria.");
define("_MD_XHNEWBB_A_EDITCATEGORY","Editar categoria:");
define("_MD_XHNEWBB_A_CATEGORYTITLE","T�tulo da categoria:");
define("_MD_XHNEWBB_A_SELECTACATEGORYEDIT","Selecione a categoria a ser editada");
define("_MD_XHNEWBB_A_CATEGORYCREATED","Categoria criada.");
define("_MD_XHNEWBB_A_NTWNRTFUTCYMDTVTEFS","Nota: Isto N�O ir� excluir os f�runs desta categoria, para isso voc� dever� usar o Gerenciador de F�runs.<br /><br />ATEN��O: Voc� tem certeza que quer excluir esta categoria?.");
define("_MD_XHNEWBB_A_REMOVECATEGORY","Apagar Categoria");
define("_MD_XHNEWBB_A_CREATENEWCATEGORY","Criar nova categoria");
define("_MD_XHNEWBB_A_YDNFOATPOTFDYAA","Voc� n�o preencheu todas as partes do formul�rio.<br>Voc� atribuiu pelo menos um moderador? Por favor, volte e corrija o formul�rio.");
define("_MD_XHNEWBB_A_FORUMCREATED","F�rum Criado.");
define("_MD_XHNEWBB_A_VTFYJC","Exibir o f�rum criado.");
define("_MD_XHNEWBB_A_EYMAACBYAF","Erro, voc� deve adicionar uma categoria antes de adicionar f�runs");
define("_MD_XHNEWBB_A_CREATENEWFORUM","Criar um novo f�rum");
define("_MD_XHNEWBB_A_ACCESSLEVEL","N�vel de Acesso:");
define("_MD_XHNEWBB_A_CATEGORYMOVEUP","Mover categoria para cima");
define("_MD_XHNEWBB_A_TCIATHU","Esta � a categoria mais elevada.");
define("_MD_XHNEWBB_A_CATEGORYMOVEDOWN","Mover categoria para baixo");
define("_MD_XHNEWBB_A_TCIATLD","Esta � a categoria a mais baixa.");
define("_MD_XHNEWBB_A_SETCATEGORYORDER","Ajustar Ordem da Categoria");
define("_MD_XHNEWBB_A_TODHITOTCWDOTIP","A ordem mostrada aqui � a ordem que as categorias ser�o mostradas na p�gina do �ndice. Para mover uma categoria para cima na ordem clique Suba para mov�-la para baixo clique Des�a .");
define("_MD_XHNEWBB_A_ECWMTCPUODITO","Cada clique mover� a categoria 1 posi��o para cima ou para baixo na ordem.");
define("_MD_XHNEWBB_A_CATEGORY1","Categoria");
define("_MD_XHNEWBB_A_MOVEUP","Suba");
define("_MD_XHNEWBB_A_MOVEDOWN","Des�a");


define("_MD_XHNEWBB_A_FORUMUPDATE","Ajustes no F�rum Atualizados");
define("_MD_XHNEWBB_A_RETURNTOADMINPANEL","Retorne ao Painel Administrativo.");
define("_MD_XHNEWBB_A_ALLOWHTML","Ativar HTML:");
define("_MD_XHNEWBB_A_YES","Sim");
define("_MD_XHNEWBB_A_NO","N�o");
define("_MD_XHNEWBB_A_ALLOWSIGNATURES","Ativar Assinaturas:");
define("_MD_XHNEWBB_A_HOTTOPICTHRESHOLD","In�cio do t�pico:");
define("_MD_XHNEWBB_A_POSTPERPAGE","T�picos por p�gina:");
define("_MD_XHNEWBB_A_TITNOPPTTWBDPPOT","(Este � o n�mero de mensagens por t�pico que ser� indicado por p�gina de um t�pico)");
define("_MD_XHNEWBB_A_TOPICPERFORUM","T�picos por f�rum:");
define("_MD_XHNEWBB_A_TITNOTPFTWBDPPOAF","(Este � o n�mero dos t�picos por o f�rum que ser� indicado por p�gina de um f�rum)");
define("_MD_XHNEWBB_A_WEIGHTOFFORUM","peso:");
define("_MD_XHNEWBB_A_SAVECHANGES","Salvar modifica��es");
define("_MD_XHNEWBB_A_CLEAR","Limpar");
define("_MD_XHNEWBB_A_CLICKBELOWSYNC","Clicar no bot�o abaixo ir� sincronizar seus f�runs e as p�ginas de t�picos com os dados corretos do banco de dados. Use esta se��o toda vez que verificar falhas nas listas de t�picos ou f�runs.");
define("_MD_XHNEWBB_A_SYNCHING","Sincronizando o �ndice do f�rum e t�picos (pode demorar alguns minutos");
define("_MD_XHNEWBB_A_DONESYNC","Completo!");
define("_MD_XHNEWBB_A_CATEGORYDELETED","Categoria apagada.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MD_XHNEWBB_A_SAFTE","Selecione o F�rum para Editar");
define("_MD_XHNEWBB_A_NFID","N�o h� f�rums no banco de dados");
define("_MD_XHNEWBB_A_EFPF","Editando permiss�es do f�rum: <b>%s</b>");
define("_MD_XHNEWBB_A_UWA","Usu�rios Com Acesso:");
//define("_MD_XHNEWBB_A_UWOA","Users Without Access:");
//define("_MD_XHNEWBB_A_ADDUSERS","Add Users -->");
define("_MD_XHNEWBB_A_CLEARALLUSERS","Apagar usu�rios");
//define("_MD_XHNEWBB_A_REVOKEPOSTING","revoke posting");
//define("_MD_XHNEWBB_A_GRANTPOSTING","grant posting");
define("_MD_XHNEWBB_A_GROUPPERMS","Permiss�es por grupos:");
define("_MD_XHNEWBB_A_TH_CAN_READ","Ver");
define("_MD_XHNEWBB_A_TH_CAN_POST","Msg");
define("_MD_XHNEWBB_A_TH_UID","uid");
define("_MD_XHNEWBB_A_TH_UNAME","uname");
define("_MD_XHNEWBB_A_TH_GROUPNAME","Grupo");
define("_MD_XHNEWBB_A_NOTICE_ADDUSERS","� necess�rio introduzir uid (como n�mero) ou nome de usu�rio (uname) se voc� quiser adicionar um usu�rio.<br />
Desmarcar 'Ver' e 'Post' esconde o nome do usu�rio na lista
");
?>
