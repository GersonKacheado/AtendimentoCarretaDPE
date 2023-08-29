
    <div class="panel panel-success" id='profissionais'>
        <div class="panel-heading">
            <h3 class="panel-title"> Abertura do Atendimento DPE  </h3>
        </div>
        <div class="panel-body">
            <?php 
                if(@$_SESSION["UsuarioIdFuncao"] == 1 || @$_SESSION["UsuarioIdFuncao"] == 7)
                {
                    echo   "<script>location.href='?op=admin';</script>";
                 
                }
            ?>
            <img src="public/login/img/topo/tv.png" alt="" class='col-md-12' style="max-width: 100%">
        </div>
    </div>    
