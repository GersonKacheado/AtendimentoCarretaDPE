<!DOCTYPE html>
<?php
  if (!isset($_SESSION)) session_start();
  if(!isset($_SESSION["UsuarioCpf"]))
      echo "<script>location.href='public/login/index.php'</script>";
  else {
      include_once("model/conn.php"); // inclusao do acesso ao SGBD 
?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Lista de Chamada - DPE</title>
      <meta http-equiv="cache-control" content="no-cache,no-store" />
      <meta http-equiv="pragma" content="no-cache" />
      <meta http-equiv="expires" content="Mon, 04 mai 2018 11:12:01 GMT" />
     

      <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
      <link rel="icon" href="public/img/favicon.ico" type="image/png" />
      <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
     
      
<!--   
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
-->
      <style>
          *{outline:none!important;}


          @font-face {
              font-family:InYourFace;
              src: url('Ubuntu-B.eot');
              src: url('Ubuntu-B.eot?') format('☺'),
              url('Ubuntu-B.woff') format('woff'),
              url('Ubuntu-B.ttf') format('truetype'),
              url('Ubuntu-B.svg#webfontssbCkuz5') format('svg');
          }
          @-ms-viewport{
              width: extend-to-zoom;
              zoom: 0.90;
          }
          input:focus,select:focus, textarea:focus{background: green; color: #fff; font-weight:bolder;}


          @media (max-width: 480px) {
            h3  {font-size: 1.4em; display: inline-block;}
            table {overflow-y: 90%}
            table thead  { display: inline-block;}
            * {text-align: left;}
            body {font-size: 1.2em;}

            .bannercarreta{margin-top:400px;}
          }
          @media (max-width: 768px) {
            table {display: block;}

          }
          #fonte_panel a:hover{color:#000 !important;}
          .inner h2, h3, h4, .small-box-footer {color: #000 !important;}

          input { color: : #fff !importante; }
          #selecao_user {background: #ccc; color: #fff; }
          #evento_user:focus, #selecao_user:focus {background: #ccc; color: #fff; font-weight:bolder;}
   
          body {
    background: #eee; 
}

.toggle {
    margin-bottom: 40px; 
}

.toggle > input {
    display: none; 
}

.toggle > label {
    position: relative;
    display: block;
    height: 20px;
    width: 70px;
    background: #898989;
    border-radius: 100px;
    cursor: pointer;
    transition: all 0.3s ease; 
}
.toggle > label:after {
    position: absolute; 
    left: -6px;
    top: -3px;
    display: block;
    width: 26px;
    height: 26px;
    border-radius: 100px;
    background: #6fbeb5;;
    box-shadow: 0px 3px 3px rgba(0,0,0,0.05);
    content: '';
    transition: all 0.3s ease; 
}
.toggle > label:active:after {
    transform: scale(1.15, 0.85);
}
.toggle > input:checked ~ label { 
    background: green; font-weight: bold;
}
.toggle > input:checked ~ label:after {
    left: 55px; 
    background: #fff;
}
.toggle > input:disabled ~ label {
    background: #d5d5d5; 
    pointer-events: none;
}
.toggle > input:disabled ~ label:after {
    background: #bcbdbc;
}
#rotulo {font-size: 10px;}          
      </style>

      
      <script src="public/json/jquery-1.11.2.min.js"></script>
      <script src="public/bootstrap4/js/bootstrap.bundle.min.js"></script>
      <script>
          $(document).ready(function(){
              $("#myInput").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  $("#myTable tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
              });
          });
          $(document).ready(function(){
              $("#Input").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  $("#tabela tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
              });
          });
      </script>  
 
  </head>
  <body class="hold-transition skin-blue sidebar-mini text-light-blue fixed">
    <div class="wrapper">
      <header class="main-header">
        <a href="#" class="logo" style="background-color: rgba(0, 65, 83, 1) !important">
          <span class="logo-mini"><b>D</b>pe</span>
          <span class="logo-lg"><b>Chamada/</b>Dpe</span>
        </a>
        <nav class="navbar navbar-static-top"  style="background-color: rgba(0, 65, 83, 1) !important">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"  
            style="background-color: rgba(0, 65, 83, 1) !important">
            <span class="html"></span>
            <strong><?=@$_SESSION["EventoDsc_evento"] ;?></strong>
            <strong><? // = $_SESSION["EventoTotal_evento"] ;?></strong>
 
          </a>


<!-- INICIO a Apresentação do Usuário no topo da página principal -->        
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php $foto_ColunaA ="public/login/img/login/".$_SESSION["UsuarioFoto"];
                        if (file_exists($foto_ColunaA))
                            echo "<img src='$foto_ColunaA' class='user-image' alt='User Image'/>";
                        else SemImgDados();?>

                    <span class="hidden-xs"><?php echo strtoupper($_SESSION["UsuarioNome"]);?></span>
                    <small class="hidden-xs"><?= ' - '.$_SESSION["UsuarioFuncao"];?></small>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                      <?php $foto_ColunaA ="public/login/img/login/".$_SESSION["UsuarioFoto"];
                      if (file_exists($foto_ColunaA))
                          echo "<img src='$foto_ColunaA' class='img-circle' alt='User Image'/>";
                      else SemImgDados();?>
                    <p style='min-height: 10px'>
                        <?=strtoupper($_SESSION["UsuarioNome"]);?>
                      <small><?=$_SESSION["UsuarioCpf"].' - '.$_SESSION["UsuarioFuncao"] ;?></small>
                      <small><strong><?=$_SESSION["UsuarioFuncao_user"] ;?></strong></small>

                   </p>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
<!-- FIM a Apresentação do Usuário no topo da página principal -->        
        </nav>

<!-- Efeitos de ORdenacao nos capoms da tabela e busca -->
    <script src="public/bower_components/layout/jquery.min.js"></script>
    <link href="public/bower_components/layout/jquery.dataTables.min.css" rel="stylesheet">

      </header>

<?php } ?>
