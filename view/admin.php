<div class='panel' id='profissionais' style="background-color:rgb(220,220,220);">
    <!-- INICIO PANEL DE ACESSO RÁDPIDO -->
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
                        <a href="#" class="small-box-footer">Configurações de Eventos</a>

                        <div class="inner h3 bg-primary">
                            <strong style="color:#000">Módulo Carreta:</strong> 
                            <p class='text-justify'>- Usado para cadastrar novos eventos relacionados aos atendimentos 
                            externos da Defensoria Públicado do Amapá,
                            utilizando ou não a Carreta da Defensoria;</p>
                            <p class='text-justify'>- Usado para editar os dados já cadastrados,
                            podendo ajustar as informações ja cadastrados;</p>
                            <p class='text-justify'>- Evento ou eventos já cadastrado podem ser habilitados ou desabiliatos.
                                Este procedimento é obrigatório para qualquer atuação nos atendimentos
                                da Defensoria Pública no atendimento externo aos assistidos.</p>                            
                        </div>

                    </div>
                </div>
                <div class="order-2 col-lg-3 col-6" onclick="Mostra(2)" style='cursor: crosshair;'>
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3 >Usuários</h3>
                            <h4 class="box-body">Cadastrar/Editar</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Configurações de Membros e Usuários</a>

                        <div class="inner h3 bg-primary">
                            <strong style="color:#000">Módulo Usuários:</strong> 
                            <p class='text-justify'>- Usado para cadastrar novos usuários relacionados aos atendimentos 
                            externos da Defensoria Públicado do Amapá,
                            utilizando ou não a Carreta da Defensoria;</p>
                            <p class='text-justify'>- Usado para editar os dados já cadastrados,
                            podendo ajustar as informações dos usários;</p>
                            <p class='text-justify'>- É obrigatório habilitar os usários que deverão atuar nos eventos.
                            Não deverá habilitar o mesmo usuário para diferentes eventos ao mesmo tempo, e o mesmo terá
                            um histórico de suas respectivas atuações.</p>                            
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
                        <a href="#" class="small-box-footer">Relatórios finlizados/em espera</a>

                        <div class="inner h3 bg-primary">
                            <strong style="color:#000">Módulo Relatórios:</strong> 
                            <p class='text-justify'>- Usado para relatar por evento relacionados aos atendimentos 
                            externos da Defensoria Públicado do Amapá,
                            utilizando ou não a Carreta da Defensoria;</p>
                            <p class='text-justify'>- Podendo criar relatório dinâmicos por, eventos, membros e 
                            respectivos assistidos que tenham sido atendidos;</p>
                            <p class='text-justify'>- Os relatórios podem também ser criados por, assistidos em 
                            direfetes eventos.</p>      
                            <p class='text-justify'>- Nomes de membro, nome ou cpf do  assistido, tempo de atendimento,
                                número de assistidos.</p>                       
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
                        <a href="#" class="small-box-footer">Configurações de Módulos</a>

                        <div class="inner h3 bg-primary">
                            <strong style="color:#000;">Módulo Inserir:</strong> 
                            <p class='text-justify'>- Usado para cadastrar novas opções relacionados aos atendimentos 
                            externos da Defensoria Públicado do Amapá,
                            utilizando ou não a Carreta da Defensoria;</p>
                            <p class='text-justify'>- Cadastrar Deficiências se necessário, relaconado ao assistido;</p>
                            <p class='text-justify'>- Cadastrar Nível de Atendimento e ou Sexo;</p>                            
                            <p class='text-justify'>- Cadastrar Núcleo, Ações e ou Tipo de Documento;</p>                            
                            <p class='text-justify'>- Cadastrar função no sistema.</p>                            
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