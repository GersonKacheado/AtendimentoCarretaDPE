
<link rel="stylesheet" href="tmpt/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="tmpt/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="tmpt/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="tmpt/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="tmpt/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="tmpt/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="tmpt/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="tmpt/plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="tmpt/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="tmpt/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="tmpt/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="tmpt/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="tmpt/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="tmpt/dist/css/adminlte.min.css">
<div class="container col-12">
<section class="content">

  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-11 col-lg-8 col-xl-5">
        <div class="card-header"> 
<h4 class="h3 text-uppercase text-center text-secondary">Defensoria Pública do Estado do Amapá</h4>
<p class="h4 text-center"><i class="text-sm"> Sistema de Atendimento - </i><strong> <a href="https://defensoria.ap.def.br/" target="_blank" title="visitar site: https://defensoria.ap.def.br/" class="text-success text-uppercase"> carreta dpe ap </a></strong></p>
        </div>
        <div class="col-md-12" id="slides">
            <div class="card">
                <div id="meuCarousel" class="carousel slide w-100" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#meuCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#meuCarousel" data-slide-to="1"></li>
                        <li data-target="#meuCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                    <div class='carousel-item active'>
                        <img class='d-block w-100 img-fluid card-img-top' src="img/topo/1.jpg" alt='primeiro slide'>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 img-fluid card-img-top" src="img/topo/2.jpg" alt="segundo slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 img-fluid card-img-top" src="img/topo/3.jpg" alt="terceiro slide">
                    </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#meuCarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#meuCarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-4 offset-xl-1 text-uppercase">
      <?php
                require 'admin/usuario.class.php';
                    $dscmenu = ['logar' => 'Logar', 'registro'=>'Registrar'];
                    echo "
                        <li class='nav-item invisible'>
                            <a class='btn btn-secondary invisible'>
                                ".$dscmenu['logar']."
                            </a>
                        </li>
                    ";
                    
              ?>
      <div class="card-header text-center mt-2">
        <img src="tmpt/dist/img/T_logo.png" alt="">
        <h1 class="h3 text-secondary mt-0"> <strong> LOGIN </strong></h1>
      </div>
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 text-sm text-secondary"> <strong> Atendimento DPE </strong> <?php echo date('d/m/Y');?></p>
          </div>
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-secondary"><strong> digite suas credenciais para conectar-se</strong></p>
          </div>
          <form action="admin/logar.php" method="post" autocomplete="off">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" name="cpf" id="form3Example3" class="form-control form-control-lg" autofocus required
            maxlength="11"  pattern="[0-9]+$" placeholder="Digite seu CPF..." />
            <label class="form-label" for="form3Example3">* Informe seu CPF <span class="text-sm text-lowercase">* <u> digite somente numeros!</u></span></label>
          </div>
          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="senha" id="form3Example4" class="form-control form-control-lg" required
            placeholder="*** Senha ***" />
            <label class="form-label" for="form3Example4">* Informe sua Senha</label>
          </div>
          <div class="d-flex justify-content-between align-items-center text-sm">
            <!-- Checkbox -->
           
            <a href="#!" title="CLIQUE AQUI, PARA REALIZAR CONTATO DIRETO COM O SUPORTE." data-toggle="modal" data-target="#exampleModalCenter" class="text-sm m-0"> <i class='fas fa-exclamation-circle text-danger'></i> <u class="text-secondary"> Entre em contato com o Suporte da DPE-AP </u></a>
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name="btn-login"  class="btn btn-success btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;"> <i class="fa fa-user"></i> <strong> LOGAR </strong></button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
 
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-uppercase text-sm" id="exampleModalCenterTitle">você será redirecinado ao suporte da DPE - AP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <div class="modal-footer">
        <button type="button" title="REGRESSAR E CONTINUAR TENTANDO EFETUAR LOGIN" class="btn btn-danger" data-dismiss="modal"> <i class='fas fa-arrow-left'></i> CANCELAR</button>
        <a href="http://dpe1.ap.def.br/chamados_ti/index.php" target="_blank" title="ENTRAR EM CONTATO DIRETO COM SUPORTE DE T.I. DPE-AP" class="btn btn-success">PROSSEGUIR <i class='fas fa-arrow-right'></i> </a>
      </div>
    </div>
  </div>
</div>
