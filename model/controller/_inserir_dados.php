<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

session_start();
if(!isset($_SESSION["UsuarioCpf"])){
	echo "<script>location.href='public/login/index.php'</script>";
	exit();
  	}
 include_once("../SQL.php");
 
 $inserirDados 	= new SQL;
 $validarForm 	= @$_POST['insertDadosForm'];
 $validarLinks 	= @$_GET['insertDadosLinks'];


// cadastrar USER
 
if(isset($_POST['btn_Cad_User']) && $_POST['validarFormCadUser']=='TarcisoDpeapUser') {

	$fk_funcao 			= $_POST['fk_funcao'];
	$fk_tipo_user		= $_POST['fk_tipo_user'];
	$nome				= $_POST['nome'];
	$cpf				= $_POST['cpf'];
	$dsc_funcao_user	= $_POST['dsc_funcao_user'];	
	$login_user			= 'null';
	$senha_user			= $_POST['senha_user'];
	$habilitado_user	= $_POST['habilitado_user'];
	if($habilitado_user == 'N'){
		$habilitado = 'N';
	}else{
		$habilitado = 'S';
	}
/*
	if($fk_funcao == 7){
		$tabela = 'tbl_atendentes';
		$colunas = "`id_atendentes`, `dsc_atendentes`, `data`, `status_atendentes`";
		$valores = "null, '".$nome."', current_timestamp(), '".$status_atendente."'";

	}elseif($fk_funcao <> 7){

		$tabela  = 'tbl_user';
		$colunas = "`iduser`, `fk_funcao`, `fk_evento`, `nome_user`, `cpf_user`, `dsc_funcao_user`, `login_user`, `senha_user`, `habilitado`";
		$valores = "null, '".$fk_funcao."', '".$fk_evento."', '".$nome."', '".$cpf."', '".$dsc_funcao_user."', '".$login_user."', '".$senha_user."', '".$habilitado_user."'";
		
	}
*/	
	$tabela  = 'tbl_user';
	$colunas = "
	`iduser`, 
	`fk_funcao`, 
	`fk_tipo_user`, 
	`nome_user`, 
	`cpf_user`, 
	`dsc_funcao_user`, 
	`login_user`, 
	`senha_user`, 
	`habilitado`";

	$valores = "
	null,
	'".$fk_funcao."', 
	'".$fk_tipo_user."', 
	'".$nome."', 
	'".$cpf."', 
	'".$dsc_funcao_user."', 
	'".$login_user."', 
	'".$senha_user."', 
	'".$habilitado."'
	";

	$inserirDados->setTabela($tabela);
	$inserirDados->setColunas($colunas);
	$inserirDados->setValues($valores);
	$inserirDados->insert();

	if ($inserirDados->getMsg()) {
		$msg = 'Adicionado a lista de espera';
		
	}else{
		$msg = 'Erro: ao Adicionado a lista';
		
	}
	//header("Location: ../../?op=admin&msg=".base64_encode($msg)."");

	echo "<script>location.href=' ../../?op=admin&msg=".base64_encode($msg)."';</script>";
	
}

 if (isset($_POST['btnDadosInsert']) && $validarForm=='Assistidos') {
	 
	 $fk_nivelAtendimento 	= strtoupper($_POST['nivel_atendimento']);
	 $fk_sexoAtendimento 	= strtoupper($_POST['sexo_atendimento']);
	 $fk_obsnucleos 		= strtoupper($_POST['obsnucleos']);
	 $fk_obsacoes 			= strtoupper($_POST['obsacoes']);
	 $fk_atendente 			= strtoupper($_POST['atendente']);
	 $fk_evento 			= $_POST['fk_evento'];
	 $chamdo_para_atendimento	= 0; 
	 $cpf 					= $_POST['cpf'];
	 $nome 					= strtoupper($_POST['nome']);
	 $dsc_fisica 			= strtoupper($_POST['dsc_fisica']);
	 $endereco 				= strtoupper($_POST['endereco']);
	 $telefone 				= $_POST['telefone'];
	 $observacao			= strtoupper($_POST['observacao']);
 
	$tabela = 'tbl_fila';
	$colunas = "
	`idfila`,
	`fk_nivel_atenimeneto`,
	`fk_sexo_atendimento`,
	`fk_obsnucleos`,
	`fk_obsacoes`,
	`fk_atendente`,
	`fk_evento`,
	`data_entrada`,
	`data_saida`,
	`chamdo_para_atendimento`,
	`cpf`,
	`nome`,
	`dsc_fisica`,
	`endereco`,
	`telefone`,
	`observacao`"; 
 	
 	$valores = "
 	null, 
	'".$fk_nivelAtendimento."',
	'".$fk_sexoAtendimento."',
	'".$fk_obsnucleos."',
	'".$fk_obsacoes."',
	'".$fk_atendente."',
	'".$fk_evento."',
 	current_timestamp(), 
 	current_timestamp(), 
	'".$chamdo_para_atendimento."',
	'".$cpf."',
	'".$nome."',
	'".$dsc_fisica."',
	'".$endereco."',
	'".$telefone."',
	'".$observacao."'
	";

	$inserirDados->setTabela($tabela);
	$inserirDados->setColunas($colunas);
	$inserirDados->setValues($valores);

	$inserirDados->insert();
	

	if ($inserirDados->getMsg()) {
		$msg = 'Adicionado a lista de espera';
		
	}else{
		$msg = 'Erro: ao Adicionado a lista';
		
	}
//	header("Location: ../../?op=recepcao&msg=".base64_encode($msg)."");

	echo "<script>location.href=' ../../?op=recepcao&msg=".base64_encode($msg)."';</script>";
}

if (isset($_GET['btnDadosInsert']) && $validarLinks=='novoAtendemento') {
	
	$fkUser 	= $_GET['user'];
	$fkFila 	= $_GET['fila'];
	$fkGuiche 	= $_GET['guiche'];

	$inserirDados->setTabela("`tbl_atendimento`");
	$inserirDados->setColunas("`idatendimento`, `fk_user`, `fk_fila`, `fk_guiche`, `parou_falar`, `status_atendido`");
	$inserirDados->setValues("null, '".$fkUser."', '".$fkFila."', '".$fkGuiche."', 0, 0");
	$inserirDados->insert();
	if ($inserirDados->getMsg()) {
		$msg = 'Chamando para atendimento';
	}else{
		$msg = 'erro Chamando para atendimento';
	}
	header("Location: ../../?op=finaliza&msg=".base64_encode($msg)."");
}

// inicio Cadastrar Evento - botao MUTIRAO
if(isset($_POST['validarFormEvento']) && $_POST['validarFormEvento']=='TarcisoDpeapEvento'){
	$fk_tipo_evento 		= $_POST['fk_tipo_evento'];
	$dsc_evento 			= $_POST['dsc_evento'];
	$endereco 				= $_POST['endereco'];
	$data_inicio_eveento 	= implode("-",array_reverse(explode("/",$_POST['data_inicio'])));
	$data_fim_evento		= implode("-",array_reverse(explode("/",$_POST['data_fim'])));
	//$satus_evento 	= $_POST['satus_evento'];

	(string)$cpf = $_SESSION["UsuarioCpf"];

	$tabela 	= "`tbl_evento`";
	$colunas 	= "`id_evento`, `fk_tipo_evento`, `dsc_evento`, `endereco`, `data_inicio_eveento`, `data_fim_evento`";
	$valores    = "null, '".$fk_tipo_evento."', '".$dsc_evento."', '".$endereco."', '".$data_inicio_eveento."', '".$data_fim_evento."'";

	$inserirDados->setTabela($tabela);
	$inserirDados->setColunas($colunas);
	$inserirDados->setValues($valores);

	$inserirDados->insert();


	$inserirDados->startPcd("pcd_atualiza_historicoNovo($cpf)");


	$msg = 'Operação relaizada com sucesso...';
	echo "<script>location.href=' ../../?op=admin_evento&msg=".base64_encode($msg)."';</script>";
}
// fim Cadastrar Evento - botao MUTIRAO

if(isset($_POST['btnDadosEntrevista']) && $_POST['validarFormEntrevista']=='TarcisoEntrevista'){ 

	$idfila 							= $_POST['idfila'];
	$idade								= $_POST['idade'];
	$escolaridade						= $_POST['escolaridade'];

	@$possui_doenca_cronica               = $_POST['possui_doenca_cronica'];
	@$possui_problema_psicologico         = $_POST['possui_problema_psicologico'];
	@$ocupacao							= $_POST['ocupacao'];
	$estado_civil						= $_POST['estado_civil'];
	$possui_filhos_qtd					= $_POST['possui_filhos_qtd'];
	@$possui_filho_doenca_cronica         	= $_POST['possui_filho_doenca_cronica'];
	@$esta_gestante                       	= $_POST['esta_gestante'];
	@$frequencia_de_visita                   = $_POST['frequencia_de_visita'];
	@$frequencia_recebe_absorvente_intimo    = $_POST['frequencia_recebe_absorvente_intimo'];
	@$atendimento_mutirao_iapen              = $_POST['atendimento_mutirao_iapen'];

	$avaliacao_defensor					= $_POST['avaliacao_defensor']; 
	$avaliacao_tempo					= $_POST['avaliacao_tempo'];
	$importancia_carreta				= $_POST['importancia_carreta']; 
	
	
	$providencia_tomada					= $_POST['providencia_tomada']; 
	$acao_prolongada					= $_POST['acao_prolongada']; 
	$nome_entrevistador					= $_POST['nome_entrevistador'];

	$melhorar_atendimento				= $_POST['melhorar_atendimento']; 
	$renda_domiciliar					= $_POST['renda_domiciliar'];
	$tipo_residencia					= $_POST['tipo_residencia'];
	$condicao_imovel					= $_POST['condicao_imovel']; 
	$local_residencia					= $_POST['local_residencia'];
	$rede_esgoto						= $_POST['rede_esgoto']; 
	$fossa_septica						= $_POST['fossa_septica']; 
	$agua_tratada						= $_POST['agua_tratada'];	 
	$rede_internet						= $_POST['rede_internet'];
	$conhecimento_acao					= $_POST['conhecimento_acao'];
	$area_buscou_nao_houve_atendimento 	= $_POST['area_buscou_nao_houve_atendimento'];


	$tabela 	= "`tbl_entrevistas`";
	$colunas 	= "
	`id`, 
	`fk_idfila`,
	`idade`, 
	`escolaridade`, 
	`renda_domiciliar`, 
	`ocupacao`, 
	`estado_civil`, 
	`possui_filhos_qtd`, 
	`tipo_residencia`, 
	`condicao_imovel`, 
	`local_residencia`, 
	`rede_esgoto`, 
	`fossa_septica`, 
	`agua_tratada`, 
	`rede_internet`, 
	`conhecimento_acao`, 
	`avaliacao_defensor`, 
	`avaliacao_tempo`, 
	`importancia_carreta`, 
	`area_buscou_nao_houve_atendimento`, 
	`melhorar_atendimento`, 
	`providencia_tomada`, 
	`acao_prolongada`, 
	`cor`, 
	`possui_doenca_cronica`, 
	`possui_problema_psicologico`, 
	`possui_filho_doenca_cronica`, 
	`esta_gestante`, 
	`frequencia_de_visita`, 
	`frequencia_recebe_absorvente_intimo`, 
	`atendimento_mutirao_iapen`, 
	`nome_entrevistador`, 
	`data_entrevista`";

	$valores    = "
	null, 
	'".$idfila."', 
	'".$idade."', 
	'".$escolaridade."', 
	'".$renda_domiciliar."', 
	'".$ocupacao."', 
	'".$estado_civil."', 
	'".$possui_filhos_qtd."', 
	'".$tipo_residencia."', 
	'".$condicao_imovel."', 
	'".$local_residencia."', 
	'".$rede_esgoto."', 
	'".$fossa_septica."', 
	'".$agua_tratada."', 
	'".$rede_internet."', 
	'".$conhecimento_acao."', 
	'".$avaliacao_defensor."', 
	'".$avaliacao_tempo."', 
	'".$importancia_carreta."', 
	'".$area_buscou_nao_houve_atendimento."', 
	'".$melhorar_atendimento."', 
	'".$providencia_tomada."', 
	'".$acao_prolongada."', 
	'".$cor."', 
	'".$possui_doenca_cronica."', 
	'".$possui_problema_psicologico."', 
	'".$possui_filho_doenca_cronica."', 
	'".$esta_gestante."', 
	'".$frequencia_de_visita."', 
	'".$frequencia_recebe_absorvente_intimo."', 
	'".$atendimento_mutirao_iapen."', 
	'".$nome_entrevistador."', 
	current_timestamp()";



	$inserirDados->setTabela($tabela);
	$inserirDados->setColunas($colunas);
	$inserirDados->setValues($valores);
	$inserirDados->insert();

	// atualizar tabela_fila para os entrevistado ok
	$inserirDados->startPcd("pcd_atualiza_tb_fila_entrevistado($idfila)");

	$msg = 'Operação relaizada com sucesso...';
//	header("Location: ../../?op=entrevista&msg=".base64_encode($msg)."");

	echo "<script>location.href=' ../../?op=entrevista&msg=".base64_encode($msg)."';</script>";

}
if(isset($_POST['Btn_Cad_Modulo']) && $_POST['Btn_Cad_Modulo']=='Valid_Cad_Modulo'){
	$modulo 	= $_POST['radio_modulo'];
	$valor 		= $_POST['valor_modulo'];

	switch ($modulo) {
		case 'cad_deficiencia':
			$tabela 	= "`tbl_tipo_deficiencia`";
			$colunas 	= "`id_tipo_deficiencia`,`dsc_deficiencia`";
			break;
		case 'cad_atendimento':
			$tabela 	= "`tbl_nivel_atendimento`";
			$colunas 	= "`idl_nivel_atendimento`,`nome_nivel`";
			break;
		case 'cad_sexo':
			$tabela 	= "`tbl_sexo_atendimento`";
			$colunas 	= "`id_sexo_atendimento`,`nome_sexo`";
			break;
		case 'cad_nucleo':
			$tabela 	= "`tbl_nucleo`";
			$colunas 	= "`idnucleo`,`dsc_nucleo`";
			break;
		case 'cad_acao':
			$tabela 	= "`tbl_acao`";
			$colunas 	= "`id_acao`,`dsc_acao`";
			break;
		case 'cad_tipo_documento':
			$tabela 	= "`tbl_tipo_documento`";
			$colunas 	= "`id_tipo_documento`,`dsc_documento`";
			break;		
		case 'cad_grupo_user':
			$tabela 	= "`tbl_tipo_user`";
			$colunas 	= "`id_tipo_user`,`dsc_tipo_user`";
			break;					
		case 'cad_funcao_sistema':
			$tabela 	= "`tbl_funcao`";
			$colunas 	= "`id_funcao`,`dsc_funcao`";
			break;	
		}

		$valores    = "null,'".$valor."'";

		$inserirDados->setTabela($tabela);
		$inserirDados->setColunas($colunas);
		$inserirDados->setValues($valores);
		$inserirDados->insert();
		$msg = 'Operação relaizada com sucesso...';
		echo "<script>location.href=' ../../?op=admin&msg=".base64_encode($msg)."';</script>";
	
}

?>
