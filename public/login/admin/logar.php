<?php
session_start();
	require_once 'usuario.class.php';

	$usuario 	= new Usuario();
	$cpf		= strtolower($_POST['cpf']);
  	$senha		= strtolower($_POST['senha']);
  	$habilitado	= 'S';
  	$total =  0;

  	$logado = $usuario->logar($cpf, $senha, $habilitado, $total);
	//  header("Location: ../../../login.php?msg=" . $msg);
	$msg =  " <span>  mensagem! </span> ";

	if($logado){

		foreach($logado as $linhas) {
			
			$_SESSION["UsuarioId"] 			= $linhas->iduser;
			$_SESSION["UsuarioCpf"] 		= $linhas->cpf_user;
			$_SESSION["UsuarioNome"] 		= $linhas->nome_user;
			$_SESSION["UsuarioFoto"] 		= $linhas->cpf_user.".png";
			$_SESSION["UsuarioHabilita"] 	= $linhas->habilitado;
			$_SESSION["UsuarioFuncao"] 		= $linhas->dsc_funcao;
			$_SESSION["UsuarioIdFuncao"] 	= $linhas->id_funcao;
			$_SESSION["UsuarioFuncao_user"] = $linhas->dsc_funcao_user;
			$_SESSION["EventoDsc_evento"] 	= $linhas->dsc_evento;
			$_SESSION["EventoId_evento"] 	= $linhas->id_evento;
			$_SESSION["EventoTotal_evento"] = $total;
			$_SESSION["ID_GUICHE_USER"]		= $_SERVER['REMOTE_ADDR'];
		 // 	header("Location:../../../index.php");
			echo "<script>location.href='../../../index.php';</script>"; 
		}
	}else{


	//	header("Location: logout.php");
		echo "<script>location.href='logout.php?msg=".$msg."';</script>"; 
		exit();
	}

?>

