<div class='panel bg-white'>
        <div class='panel-heading'>
            <div style="padding: 1em;"> 
                <h3 class='panel-title'> <?php echo strtoupper($op). ' Usuários do Sistema'; ?> </h3>
                <h3 class="panel-title"> <?php if ((@$_GET['msg'])){ echo base64_decode(@$_GET['msg']);} ?> </h3>
            </div>
            <div class="row" id='fonte_panel' style="color: #000; ">
                <div class="order-1 col-lg-3 col-6" onclick="Mostra(1)" style='cursor: crosshair; color:#fff'>
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 >Carreta</h3>
                            <h4 class="box-body">Eventos/Multirão</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ionic"></i>
                        </div>
                        <a href="#" class="small-box-footer text-sm">Configurações de Eventos</a>

                        <div class="inner h3 bg-default">

                        <button type="button" class="btn btn-secondary text-justify" data-toggle="tooltip" data-placement="bottom" 
                        title="
Usado para cadastrar novos eventos relacionados aos atendimentos externos
da Defensoria Públicado do Amapá, utilizando ou não a Carreta da Defensoria
Usado para editar os dados já cadastrados, podendo ajustar as informações ja
cadastrados Evento ou eventos já cadastrado podem ser habilitados ou desabiliatos.
Este procedimento é obrigatório para qualquer atuação nos atendimentos
da Defensoria Pública no atendimento externo aos assistidos.
                        ">Módulo Carreta</button>                        
                        </div>
                    </div>
                </div>
                <div class="order-2 col-lg-3 col-6" onclick="Mostra(2)" style='cursor: crosshair;'>
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 >Usuários</h3>
                            <h4 class="box-body">Cadastrar/Editar</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer text-sm">Configurações de Membros e Usuários</a>

                        <div class="inner h3 bg-default">
                        <button type="button" class="btn btn-secondary text-justify" data-toggle="tooltip" data-placement="bottom" 
                        title="
Usado para cadastrar novos usuários relacionados aos atendimentos 
externos da Defensoria Públicado do Amapá,utilizando ou não a Carreta da Defensoria
Usado para editar os dados já cadastrados,podendo ajustar as informações dos usários;
É obrigatório habilitar os usários que deverão atuar nos eventos.
Não deverá habilitar o mesmo usuário para diferentes eventos ao mesmo tempo, e o mesmo terá
um histórico de suas respectivas atuações.
                            ">Módulo Usuários</button>      
                        </div>                       
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
                        <a href="#" class="small-box-footer text-sm">Relatórios finlizados/em espera</a>

                        <div class="inner h3 bg-default">
                            <button type="button" class="btn btn-secondary text-justify" data-toggle="tooltip" data-placement="bottom" 
                        title="
Usado para relatar por evento relacionados aos atendimentos 
externos da Defensoria Públicado do Amapá, utilizando ou não 
a Carreta da Defensoria, Podendo criar relatório dinâmicos por, eventos, membros e 
respectivos assistidos que tenham sido atendidos;
Os relatórios podem também ser criados por, assistidos em 
direfetes eventos. Nomes de membro, nome ou cpf do  assistido,
tempo de atendimento, número de assistidos.">Módulo Relatórios</button>      
                        </div>
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
                        <a href="#" class="small-box-footer text-sm">Configurações de Módulos</a>

                        <div class="inner h3 bg-default">
                            <button type="button" class="btn btn-secondary text-justify" data-toggle="tooltip" data-placement="bottom" 
                        title=" 
Usado para cadastrar novas opções relacionados aos atendimentos 
externos da Defensoria Públicado do Amapá,
utilizando ou não a Carreta da Defensoria
Cadastrar Deficiências se necessário, relaconado ao assistido.
Cadastrar Nível de Atendimento e ou Sexo.
Cadastrar Núcleo, Ações e ou Tipo de Documento.
Cadastrar função no sistema.
                            ">Módulo Inserir</button>                             
                        </div>

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
                location.href='?op=admin_modulo';
                break;    

        }        
    }
</script>     