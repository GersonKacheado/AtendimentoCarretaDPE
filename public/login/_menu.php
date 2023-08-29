<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid open-modal">

<!-- inicio do Logo de abertura -->          

        <span class="text-white" style="font-size:1em">Atendimento DPE - <?php echo date('d/m/Y');?></span>
   
<!-- fim do Logo de abertura -->        

        <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarResponsive" aria-controls="navbarResponsive" 
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
             <?php
                require 'admin/usuario.class.php';
                    $dscmenu = ['logar' => 'Logar', 'registro'=>'Registrar'];
                    echo "
                        <li class='nav-item'>
                            <a class='btn btn-secondary' href='#myModal_logar' data-toggle='modal'>
                                ".$dscmenu['logar']."
                            </a>
                        </li>
                    ";
                    
              ?>
          </ul>
        </div>
      </div>
    </nav>

    <div id="myModal_logar" class="modal fade text-center">
      <div class="modal-dialog">
        <div class="col-lg-8 col-sm-8 col-12 main-section">
          <div class="modal-content p-2">
            <div class="col-lg-12 col-sm-12 col-12 user-img">
  	          <button type="button" class="close" data-dismiss="modal">
                <i class="fa fa-power-off text-green "></i>
              </button>   
           	<?php echo "<img src=$foto>"; ?>
            </div>
            <div class="col-lg-12 col-sm-12 col-12 user-name">
              <h4>Logar</h4>
            </div>
            <div class="col-lg-12 col-sm-12 col-12 form-input">

  <form action="admin/logar.php" method="post" autocomplete="off">
    <div class="form-group">
      <input type="text" name="cpf" class="form-control" placeholder="Informe seu CPF..."
              maxlength="11"  pattern="[0-9]+$">
    </div>
    <div class="form-group">
      <input type="password" name="senha" class="form-control" placeholder="Informe sua Senha...">
    </div>
    <div class="form-group margin-top-pq">
      <div class="col-sm-12 controls">
        <button type="submit" class="btn btn-primary" name="btn-login" id="btn-login">
          Logar
        </button>
      </div>
    </div> 
  </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>

