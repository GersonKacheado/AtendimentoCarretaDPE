<div class='panel' id='profissionais' style="background-color:rgb(220,220,220);">
    <!-- INICIO PANEL DE ACESSO RÁDPIDO -->
        <div class='panel-heading'>
            <div style="padding: 1em;"> 
                <h3 class='panel-title'> <?php echo strtoupper($op). ' Usuários do Sistema'; ?> </h3>
                <h3 class="panel-title"> <?php if ((@$_GET['msg'])){ echo base64_decode(@$_GET['msg']);} ?> </h3>
            </div>
            <div class="row" id='fonte_panel' style="color: #000; ">
                <div class="order-1 col-lg-3 col-6" onclick="Mostra(1)" style='cursor: crosshair;'>
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 >Mutirão</h3>
                            <h4 class="box-body">Eventos/Multirão</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ionic"></i>
                        </div>
                        <a href="#" class="small-box-footer">Configurações de Eventos</a>
                    </div>
                </div>
                <div class="order-2 col-lg-3 col-6" onclick="Mostra(2)" style='cursor: crosshair;'>
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3 >Usuários</h3>
                            <h4 class="box-body">Cadastrar/Editar</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Configurações de Membros e Usuários</a>
                    </div>
                </div>
                <div class="order-3 col-lg-3 col-6" onclick="Mostra(3)" style='cursor: crosshair;'>
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 >Relatório</h3>
                            <h4 class="box-body">Finalizados</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Relatórios finlizados/em espera</a>
                    </div>
                </div>
                <div class="order-4 col-lg-3 col-6" onclick="Mostra(4)" style='cursor: crosshair;'>
                    <div class="small-box bg-success">
                        <div class="inner text-black-50">
                            <h3 >Inserir</h3>
                            <h4 class="box-body">Módulos</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">Configurações de Módulos</a>
                    </div>
                </div>    
            </div>  
        </div>    
    </div>
    <script type="text/javascript">
   
    function Mostra($id){
        switch($id){
            case 1:
                location.href='?op=admin_evento';
                break;
            case 2:
                location.href='?op=admin_user';
                break;    
            case 3:
                location.href='?op=admin_relatorio';
                break;
            case 4:
                location.href='?op=admin_modulo ';
                break;    

        }        
    }
</script>     