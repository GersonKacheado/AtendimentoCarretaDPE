<?php
    if(!isset($_SESSION["UsuarioCpf"])){
      echo "<script>location.href='public/login/index.php'</script>";
    } else {
    ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="public/tmpt/dist/img/logo.png" alt="Atendimento" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CARRETA - DPE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php $foto_ColunaA ="public/login/img/login/".$_SESSION["UsuarioFoto"];
                        if (file_exists($foto_ColunaA))
                            echo "<img src='$foto_ColunaA' class='img-circle elevation-2' alt='User Image'/>";
                        else SemImgDados();?>
        </div>
        <div class="info">
          <a href="#" class="d-block text-sm"><?php echo strtoupper($_SESSION["UsuarioNome"]);?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
                    $habilita = 's';
                    $menu = Menu($habilita);
                    foreach ($menu as $valor) {
                        $id         = $valor->idmenu;
                        $dscmenu    = $valor->dscmenu;
                        $cor        = $valor->cor;
                        $link       = $valor->link;
                        if($dscmenu == @$_SESSION["UsuarioFuncao"] || $link == 'Logout' || $link == 'Entrevista'){ 
                        ?>
                        <li class="nav-item has-treeview"><a class="nav-link" href="?op=<?php echo strtolower($link);?>">
                            <i class="fa <?php echo $cor; ?> "></i>
                            <span> <?php echo $dscmenu; ?> </span></a>
                         </li>
                        <?php }
                        elseif(@$_SESSION["UsuarioIdFuncao"] == 1){ ?>
                            <li><a class="nav-link" href="?op=<?php echo strtolower($link);?>">
                                    <i class="fa <?php echo $cor; ?> "></i>
                                    <span> 
                                        <?php    
                                            if($link == 'Resumo') echo 'Relatório Finalizado'; 
                                                elseif($link == 'Previa') echo 'Relatório Aguardando'; 
                                                    else echo $link;
                                        ?>  
                                    </span>
                                </a>
                             </li>

                        <?php }
                    } 
                ?>        
        
        
        <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-header"><h5 class="text-center text-sm">Relatório Parcial</h5></li>
          <?php if(@$_SESSION["UsuarioIdFuncao"] == 1 || @$_SESSION["UsuarioIdFuncao"] == 7){ ?>
                
                <?php
                    $Total_view_assistidos = TotalViewAssistidos();
                    foreach($Total_view_assistidos as $value) { 
                        @$chamdo_para_atendimento   = $value->chamdo_para_atendimento;  
                        @$entrevistado              = $value->entrevistado;  
                        @$desistencia               = $value->desistencia;

                        if($chamdo_para_atendimento == 0 AND $entrevistado == 0 AND $desistencia == 1) $desiste_sem_atender             = $value->total_chamados;
                        elseif($chamdo_para_atendimento == 1 AND $entrevistado == 0 AND $desistencia == 0) $chama                       = $value->total_chamados;  
                        elseif($chamdo_para_atendimento == 1 AND $entrevistado == 0 AND $desistencia == 1) $atende_sem_entrevista       = $value->total_chamados;  
                        elseif($chamdo_para_atendimento == 1 AND $entrevistado == 1 AND $desistencia == 0) $entrevistado                = $value->total_chamados;  
                        else $aguardando                = $value->total_chamados;  

                        @$atendido          = $entrevistado + $atende_sem_entrevista;
                        @$total_dia         = $desiste_sem_atender  + $chama + $atende_sem_entrevista + $entrevistado;
                        @$final             = $aguardando + $total_dia;
                    }        
                ?>
                
                <?php } ?>

          <li class="nav-item text-sm">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger text-sm"></i>
              <p class="text">Aguardando
              <span class="right badge badge-danger"><?php echo @$aguardando; ?></span>

              </p>
            </a>
          </li>
          <li class="nav-item text-sm">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning text-sm"></i>
              <p>Chamado p/ Atendimento
              <span class="right badge badge-warning"><?php echo @$chama; ?></span>

              </p>
            </a>
          </li>
          <li class="nav-item text-sm">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info text-sm"></i>
              <p>Desistencia s/ Atendimento
              <span class="right badge badge-info"><?php echo @$desiste_sem_atender; ?></span>

              </p>
            </a>
          </li>

          <li class="nav-item text-sm">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-primary text-sm"></i>
              <p class="text">Atendimento s/ Entrevista
              <span class="right badge badge-primary"><?php echo @$atende_sem_entrevista; ?></span>

              </p>
            </a>
          </li>
          <li class="nav-item text-sm">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-white text-sm"></i>
              <p>Entrevistado
              <span class="right badge badge-white"><?php echo @$entrevistado; ?></span>

              </p>
            </a>
          </li>
          <li class="nav-item text-sm">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-success text-sm"></i>
              <p>Assistidos Atendidos
              <span class="right badge badge-success"><?php echo @$atendido; ?></span>

              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>









<?php


} ?>
