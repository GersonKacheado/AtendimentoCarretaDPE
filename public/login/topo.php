<?php
      session_start();;
     define("ID_USER", @$_SESSION["UsuarioId"]);
     define("GUICHE_USER", @$_SESSION["ID_GUICHE_USER"]);
 
    ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
		<title>Atendimento - DPE</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Console de Acesso Admin tipo login">
		<meta name="author" content="Esp. Paulo Tarciso">

        <link href="css/principal.css" rel="stylesheet">
        <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">

<!-- Bootstrap core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
<!-- Quando logado -->
        
        <?php if($usuario === 'Visitante') {
            echo "<link rel='stylesheet' href='css/logar.css.php'>";
        }
        ?>

    </head>
  <body>