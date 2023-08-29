<?php
    if(!isset($_SESSION["UsuarioCpf"])){
      echo "<script>location.href='public/login/index.php'</script>";
    } else {
    ?>

    <aside class="main-sidebar" style="background-color: rgba(0, 65, 83, 1) !important">
        <section class="sidebar">
            <form class="sidebar-form" name="formsearch" autocomplete="off" >
                <div class="input-group">
                    <input type="search" class="form-control" name="buscar" setfocus pattern="[Aa-Zz\s] [0-9]+$">
                    <input type="hidden" name="acao" value='Tarcisobuscar'>
                    <span class="input-group-btn">
                        <button type="submit" name="op" id="search-btn" value="recepcao" class="btn btn-flat" onclick="<?php echo $op;?>">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>

            <ul class="sidebar-menu" data-widget="tree">
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
                        <li><a href="?op=<?php echo strtolower($link);?>">
                            <i class="fa <?php echo $cor; ?> "></i>
                            <span> <?php echo $dscmenu; ?> </span></a>
                         </li>
                        <?php }
                        elseif(@$_SESSION["UsuarioIdFuncao"] == 1){ ?>
                            <li><a href="?op=<?php echo strtolower($link);?>">
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
            </ul>

<!-- INÍCIO Exibição dos Dados - Relatorios -->            
            <hr>
            <div style='color:#fff;'>
                <?php if(@$_SESSION["UsuarioIdFuncao"] == 1 || @$_SESSION["UsuarioIdFuncao"] == 7){ ?>
                <h5 class="text-center">Relatório Parcial</h5>
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
                <ul class="sidebar-menu">
                    <table class='table text-white-50'><tr>
                    <tr><td>Aguardando:</td><td><?php echo @$aguardando; ?></td></tr>       
                    <tr><td>Chamado p/ Atendimento:</td><td><?php echo @$chama; ?></td></tr>       
                    <tr><td>Desistencia s/ Atendimento:</td><td><?php echo @$desiste_sem_atender; ?></td></tr>
                    <tr><td>Atendimento s/ Entrevista:</td><td><?php echo @$atende_sem_entrevista; ?></td></tr>
                    <tr><td>- Entrevistado:</td><td><?php echo @$entrevistado; ?></td></tr>
                    </tr>    
                    <tfoot>
                        <tr>
                            <td>- Assistidos Atendidos:</td><td><?php echo @$atendido; ?></td>
                        </tr>
                        <tr>
                            <td>- Total Assistidos:</td><td><?php echo @$total_dia; ?></td>
                        </tr>
                        <tr>
                            <td>- Total :</td><td><?php echo @$final; ?></td>
                        </tr>                        
                    </tfoot>    
             
                  </table>
                </ul>
                <?php } ?>
  
            </div>

<!-- FIM Exibição dos Dados -->            
        </section>
    </aside>
    <?php


} ?>





                
