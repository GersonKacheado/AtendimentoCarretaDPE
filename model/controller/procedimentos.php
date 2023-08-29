<?php 
session_start();
if(!isset($_SESSION["UsuarioCpf"])){
  echo "<script>location.href='public/login/index.php'</script>";
  exit();
}

include_once("../SQL.php");
$procedimentos = new SQL;
/*
if (base64_decode($_GET['finalizar'])=='finalizarAtendimento') {

	$idfila 				= base64_decode($_GET['idfila']);


	$procedimentos->startPcd("`pcd_finaliza_atendimento`($idfila)");
	$msg = "o atendimento ...";
	header("Location: ../../?op=atendimento&msg=".base64_encode($msg)."");
}

*/

// INICIO selecionar evento
if(isset($_GET['TARCISO']) && $_GET['TARCISO']=='MarcaVolante'){

	$id_evento 		= $_GET['id_evento'];
	$satus_evento 	= ($_GET['valor'] == 'Fechar')?0:1;

	$procedimentos->startPcd("pcd_atualiza_LiberaEvento($id_evento, $satus_evento)");

	//  inicio mudar sessao do evento
	$_SESSION["EventoId_evento"] 	= @$linhas->id_evento;
	//  fim mudar sessao do evento 

	$msg = "Registro Atualizado :". $id_evento;
	if($satus_evento == 0)
		echo "<script>location.href=' ../../?op=admin_evento&msg=".base64_encode($msg)."&id_evento=".$id_evento."&status_evento=".$satus_evento."';</script>";
	else
	echo "<script>location.href=' ../../public/login/admin/logar.php';</script>";
	//echo "<script>location.href=' ../../?op=admin_user&msg=".base64_encode($msg)."&id_evento=".$id_evento."&status_evento=".$satus_evento."';</script>";


}
// FIM selecionar evento


// INICIO selecionar Desistencia
if(isset($_GET['TARCISO']) && $_GET['TARCISO']=='MarcaDesistencia'){

	$idfila 		= $_GET['idfila'];
	$desistencia 	= ($_GET['valor'] == 'Não')?1:0;

	$procedimentos->startPcd("pcd_atualiza_FilaDesistencia($idfila, $desistencia)");
	$msg = "Registro Atualizado :". $idfila;
// 	header("Location: ../../?op=admin&msg=".base64_encode($msg)."");

echo "<script>location.href=' ../../?op=recepcao&msg=".base64_encode($msg)."';</script>";
}
// FIM selecionar Desistencia

// INICIO selecionar Entrevistado
if(isset($_GET['TARCISO']) && $_GET['TARCISO']=='MarcaEntrevistado'){

	$idfila 		= $_GET['idfila'];
	$entrevistado 	= ($_GET['valor'] == 'Não')?0:1;

	$procedimentos->startPcd("pcd_atualiza_FilaEntrevistado($idfila, $entrevistado)");
	$msg = "Registro Atualizado :". $idfila;
// 	header("Location: ../../?op=admin&msg=".base64_encode($msg)."");

echo "<script>location.href=' ../../?op=entrevista&msg=".base64_encode($msg)."';</script>";
}
// FIM selecionar Entrevistado




// INICIO Marca Tempo de Atendimento.........
if(isset($_GET['TARCISO']) && $_GET['TARCISO']=='MarcaTempo'){

	$idfila 		= $_GET['idfila'];
	$rotuloTempo 	= $_GET['rotulotempo']; 

	if(isset($rotuloTempo) && $rotuloTempo == 'Iniciar'){
		$procedimentos->startPcd("pcd_atualiza_TempoAtendimentoInicio($idfila)");
	}elseif(isset($rotuloTempo) && $rotuloTempo == 'Finalizar') {
		$procedimentos->startPcd("pcd_atualiza_TempoAtendimentoFim($idfila)");

	}
	$msg = "Registro Atualizado :". $idfila;
	echo "<script>location.href=' ../../?op=recepcao&msg=".base64_encode($msg)."';</script>";
}
// FIM Marca Tempo de Atendimento.........


// INIICO inserir usuarios no evento do mutirão atual
if(isset($_GET['dados_id_user']) && isset($_GET['TARCISO']) && $_GET['TARCISO'] == 'insercaodenovousuarios_carreta'){

	$fk_iduser 		=  $_GET['dados_id_user'];
	$fk_idevento 	=  $_GET['id_evento'];

	$procedimentos->startPcd("pcd_atualiza_Historico($fk_idevento, $fk_iduser)");
	$msg = "Usuário inserido no evento atual :". $fk_idevento;
	echo "<script>location.href=' ../../?op=admin_user&msg=".base64_encode($msg)."';</script>";

}
// FIM inserir usuarios no evento do mutirão atual


// INIICO Retirar usuarios no evento do mutirão atual

if(isset($_GET['dados_id_user']) && isset($_GET['TARCISO']) && $_GET['TARCISO'] == 'retirardenovousuarios_carreta'){


	$fk_iduser 		=  $_GET['dados_id_user'];
	$fk_idevento 	=  $_GET['id_evento'];

	$procedimentos->startPcd("pcd_retirar_Historico($fk_idevento, $fk_iduser)");
	$msg = "Usuário removido no evento atual :". $fk_idevento;
	echo "<script>location.href=' ../../?op=admin_user&msg=".base64_encode($msg)."';</script>";

}


// FIM retiriar usuarios no evento do mutirão atual
?>