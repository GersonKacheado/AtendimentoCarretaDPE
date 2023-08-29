<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION["UsuarioCpf"])){
  echo "<script>location.href='public/login/index.php'</script>";
  exit();
}
include_once("../SQL.php");

$procedimentos 					= new SQL;
//$validarForm 					= @$_POST['validarForm'];
$validarFormUser 				= @$_POST['validarFormUser'];
$validarFormAll 				= @$_POST['validarFormAll'];
$validarForm 						= @$_POST['EditarDadosForm'];
$idfila 								=	@$_POST['idfila']; 

$ValidarEventoTrabalha 	= @$_POST['ValidarEventoTrabalha'];


// INICIO Eventro Trabalha
if(isset($_POST['BtnEventoTrabalha']) && $ValidarEventoTrabalha=='TarcisoEventoTrabalha') {
	
	$fk_iduser 		= $iduser;
	$fk_idevento 	= $fk_evento;

	$procedimentos->startPcd("pcd_atualiza_historicoEventoTrabalha($fk_idevento, $fk_iduser)");
  
}

// FIM Eventro Trabalha


// INICIO Edição dos Dados do assistido .. depois de atendimento para encaminhamento da ENTREVISTA.............................

if ($validarForm=='AssistidosCarreta') { 
	$idfila 										= @$_POST['idfila'];
  	$nome 										= @$_POST['nome'];
  	$obsnucleo								= @$_POST['obsnucleos'];
  	$obsacoes 								= @$_POST['obsacoes'];
  	$atendente 								= @$_POST['atendente'];
  	$chamdo_para_atendimento	= @$_POST['chamdo_para_atendimento'];
	$observacao									= @$_POST['observacao'];
	$solucao										= @$_POST['solucao'];
	$tipo_documento							= @$_POST['tipo_documento'];

//	$procedimentos->startPcd("`pcd_finaliza_atendimento`($idfila,$obsnucleos,$obsacoes,$atendente,$chamdo_para_atendimento,$observacao)");

	$procedimentos->setTabela("`tbl_fila`");
	$procedimentos->setValuesTbl("`observacao` = '".$observacao."'");

	$procedimentos->setValuesTbl("
   		`fk_obsnucleos` = '".$obsnucleo."',
   		`fk_obsacoes` = '".$obsacoes."',
   		`fk_atendente` = '".$atendente."',
   		`chamdo_para_atendimento` = '".$chamdo_para_atendimento."',
   		`observacao` = '".$observacao."',
   		`solucao` = '".$solucao."',
   		`data_saida` = current_timestamp(),
   		`fk_tipo_documento` = '".$tipo_documento."' 
   ");

	$procedimentos->setIdDados("`idfila`");
	$procedimentos->setIdValues("$idfila");
	$procedimentos->alterar();

	$msg = "Registro Editado :". $idfila;
// 	header("Location: ../../?op=recepcao&msg=".base64_encode($msg)."");
	echo "<script>location.href=' ../../?op=recepcao&msg=".base64_encode($msg)."';</script>";
}

// FIM Edição dos Dados do assistido .. depois de atendimento para encaminhamento da ENTREVISTA.............................



// editar USER
if (isset($_POST['btn_Cad_User']) && $_POST['validarFormCadUser']=='TarcisoDpeapUser') {   

 	$iduser								= @$_POST['iduser'];
	$fk_funcao 						= $_POST['fk_funcao'];
	$fk_tipo_user					= $_POST['fk_tipo_user'];
	$fk_evento						= $_POST['fk_evento'];
	$nome 								= strtoupper(@$_POST['nome']);
	$cpf 									= @$_POST['cpf'];
	$dsc_funcao_user			= $_POST['dsc_funcao_user'];	
	$login_user						= 'null';
	$senha_user						= $_POST['senha_user'];
	$habilitado_user			= $_POST['habilitado_user'];
	if($habilitado_user == 'N'){
		$habilitado = 'N';
	}else{
		$habilitado = 'S';
	}
	switch ($fk_funcao) {
		case 1:
			$user		= 'Amin';
			break;
		case 2:
			$user		= 'Recepcao';
			break;
		case 3:
			$user		= 'Atendimento';
			break;
		case 7:
			$user		= 'Defensor(a)';
			break;

	}

	$procedimentos->setTabela("`tbl_user`");
	$procedimentos->setValuesTbl("
		`fk_funcao` 		= '".$fk_funcao."',
		`fk_tipo_user` 		= '".$fk_tipo_user."',
		`nome_user` 		= '".$nome."',
		`cpf_user` 			= '".$cpf."',
		`dsc_funcao_user` 	= '".$dsc_funcao_user."',
		`login_user` 		= '".$login_user."',
		`senha_user`		= '".$senha_user."',
		`habilitado` 		= '".$habilitado."'
	");
	
	$procedimentos->setIdDados("`iduser`");
	$procedimentos->setIdValues("$iduser");
	$procedimentos->alterar();

// INICIO atualizar HISTORICO

	$fk_iduser 		= $iduser;
	$fk_idevento 	= $fk_evento;
	
	$procedimentos->startPcd("pcd_atualiza_historico($fk_idevento, $fk_iduser)");


// FIM atualizar HISTORICO

	$msg = "Registro Editado :". $iduser;
//	header("Location: ../../?op=admin&msg=".base64_encode($msg)."");

echo "<script>location.href=' ../../?op=admin&msg=".base64_encode($msg)."';</script>";

}elseif(isset($_POST['btnDadosAlterarTriagem']) && $validarForm=='TarcisoDpeapTriagem'){

	$fk_fila 					= @$_POST['fk_fila'];
	$observacao 			= @$_POST['observacao'];
	$fk_id_nucleo			= @$_POST['fk_id_nucleo'];
//	$iduser		= @$_POST['iduser'];

	$procedimentos->setTabela("`tbl_atendimento`");
	$procedimentos->setValuesTbl("
		`fk_id_nucleo` 	= '".$fk_id_nucleo."',
		`observacao` 	= '".$observacao."'
		");
	
	$procedimentos->setIdDados("`fk_fila`");
	$procedimentos->setIdValues("$fk_fila");
	$procedimentos->alterar();
	
	
//	$obs = base64_encode($observacao);
//	$procedimentos->startPcd("`pcd_atualiza_atendimento`($fk_fila, $fk_id_nucleo, $obs)";

	$msg = "Registado um Novo Núcleo..";
 //	header("Location: ../../?op=admin&msg=".base64_encode($msg)."");	

	echo "<script>location.href=' ../../?op=admin&msg=".base64_encode($msg)."';</script>";
}
elseif(isset($_POST['validarFormAll']) && $validarFormAll=='TarcisoDpeapAll')
{
	$procedimentos->startPcd("`pcd_finaliza_atendimento_apos_triagem`(1)");
	$msg = "Finalização Geral...";

//	header("Location: ../../?op=admin&msg=".base64_encode($msg)."");	

	echo "<script>location.href=' ../../?op=admin&msg=".base64_encode($msg)."';</script>";
}


// iniico Edicao do Evento - botao MULTIRAO

if(isset($_POST['validarFormEvento']) && $_POST['validarFormEvento']=='TarcisoDpeapEvento'){

	$id_evento 					= $_POST['id_evento'];
	$fk_tipo_evento 		= $_POST['fk_tipo_evento'];
	$dsc_evento 				= $_POST['dsc_evento'];
	$endereco 					= $_POST['endereco'];
	$satus_evento 			= ($_POST['satus_evento'] == 'ON')? 1 : 0;

	$procedimentos->setTabela("`tbl_evento`");
	$procedimentos->setValuesTbl("`fk_tipo_evento` 	= '".$fk_tipo_evento."',`dsc_evento` 	= '".$dsc_evento."', `endereco` 	= '".$endereco."', `satus_evento` 	= '".$satus_evento."'");
	
	$procedimentos->setIdDados("`id_evento`");
	$procedimentos->setIdValues("$id_evento");
	$procedimentos->alterar();

	$msg = 'Operação de Edição relaizada com sucesso...';

	echo "<script>location.href=' ../../?op=admin_user&msg=".base64_encode($msg)."';</script>";

}

// fim Edicao do Evento - botao MULTIRAO




?>
