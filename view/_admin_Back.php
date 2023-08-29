<?php

/*    como saber a senha ou criar novas 
*
    $teste        = md5(hash('sha512', "@g5p10y@"));
    echo $teste;
 *
 *
 */ 

$senhas =( md5(hash('sha512', "dpeap")));

if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
}else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);
    @$habilitado = $_GET['habilita_user'];
 ?>

<div style='position: relative;'>
    <div class='panel' id='profissionais' style="background-color:rgb(220,220,220);">
        <div class='panel-heading'>
            <div style="padding: 1em;"> 
                <h3 class='panel-title'> <?php echo strtoupper($op). ' Usuários do Sistema'; ?> </h3>
                <h3 class="panel-title"> <?php if ((@$_GET['msg'])){ echo base64_decode(@$_GET['msg']);} ?> </h3>
            </div>

<!-- INICIO PANEL DE ACESSO RÁDPIDO -->

            <div class="row" id='fonte_panel' style="color: #000; ">
                <div class="col-lg-3 col-6" onclick="Mostra(4)" style='cursor: crosshair;'>
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 >Carreta</h3>
                            <h4 class="box-body">Eventos/Multirão</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ionic"></i>
                        </div>
                        <a href="#" class="small-box-footer">Configurações de Eventos</a>
                    </div>
                </div>
                <div class="col-lg-3 col-6" onclick="Mostra(2)" style='cursor: crosshair;'>
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
                <div class="col-lg-3 col-6" onclick="Mostra(3)" style='cursor: crosshair;'>
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
                <div class="col-lg-3 col-6 flex=item-4" onclick="Mostra(2)" style='cursor: crosshair; '>
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
<!-- FIM PANEL DE ACESSO RÁDPIDO -->

        </div>    
    </div>

<!-- INICIO configuração dos eventos -->
    <div id="card_4" class="bg-info panel-body col-md-12 btn-group" style="display:none; padding: 0 10px 10px 0; margin-bottom: 10px;" role='group' aria-label='Exemplo'>

        <?php 
            if(isset($_GET['resp']) && $_GET['resp']=='TarcisoeditEvento'){
                $nome_btn = 'Editar';
                $acao = 'editar_dados.php';
            }else{
                $nome_btn = 'Cadastrar';
                $acao = 'inserir_dados.php';
            }

        ?>
            <div class="panel-body"><h3><?php echo $nome_btn." Eventos - Carreta"; ?></h3></div>
            <form method="POST" action="model/controller/<?php echo $acao; ?>" >
                <div class="form-group">
                    <div class="col-md-4 dropdown">
                        <label for="funcao">Tipo do Evento</label>
                        <select class="form-control" name="fk_tipo_evento" id="fk_tipo_evento">
                            <?php $selecionar_dados->setTipoEvento();?>
                        </select>
                    </div>
                    <div class="col-md-4 dropdown">
                        <label for="nome">Descrição do Evento</label>
                        <input autofocus='0' required class="form-control" type="text" name='dsc_evento' placeholder="Descrição do Evento"  style="max-width:100%" 
                        value="<?php if(isset($_GET['dsc_evento'])) echo @$_GET['dsc_evento'];?>">
                    </div> 
                    <div class="col-md-4 dropdown">
                        <label for="nome">Endereço</label>
                        <input  required class="form-control" type="text" name='endereco' placeholder="Endereço do evento"  style="max-width:100%" 
                        value="<?php if(isset($_GET['endereco'])) echo @$_GET['endereco'];?>">
                    </div> 

                    <div class="col-md-2 dropdown">
                        <label>Data Início</label>
                        <input  required class="form-control" type="date" name='data_inicio' value="<?php if(isset($_GET['data_inicio'])) echo @$_GET['data_inicio'];?>">
                    </div> 

                    <div class="col-md-2 dropdown">
                        <label>Data Fim</label>
                        <input  required class="form-control" type="date" name='data_fim' value="<?php if(isset($_GET['data_fim'])) echo @$_GET['data_fim'];?>">
                    </div> 
                    <?php if($nome_btn <> 'Cadastrar'){?>

                    <div class="col-md-2 dropdown">
                        <label>Habilitado</label>
                        <select class="form-control" name="satus_evento" id="satus_evento" style="max-width:100%">
                            <?php 
                                if($_GET['satus_evento'] == 1){ ?>
                                    <option value='1' checked>Sim</option>
                                    <option value='OFF'>Não</option>
                                <?php }else { ?>
                                    <option value='0' >Não</option>
                                    <option value='ON' checked>Sim</option>
                                <?php } ?>
                            ?>
                        </select>
                    </div> 
                    <?php } ?>                    

                    <input type="hidden" name="validarFormEvento" value="TarcisoDpeapEvento">   
                     <input type="hidden" name="id_evento" value="<?php echo @$_GET['id_evento'];?>"> 
                    <div class="col-md-2 dropdown">
                        <label>Ação</label><br>
                        <button type="submit" class="btn btn-success" style="max-width:100%"><?php echo $nome_btn; ?></button>
                    </div>
                </div>    
            </form>
        </div>
    </div>        
<!-- Fim configuração dos eventos -->
    <div class="container">
        <div  id="card_4_1" class="container mt-12 btn-group">
            <table class="table table-hover text-left" style="width:100%" id="minhaTabelaC">
                <thead>
                    <tr>
                        <th scope="col" colspan="8">
                            <h3 class="panel panel-success">Eventos Cadastrados No Sistema</h3>
                        </th>
                    </tr>
                    <tr class="h5"><th scope="col">#</th><th scope="col">DESCRIÇÃO</th><th scope="col">ENDEREÇO</th><th scope="col">INÍCIO</th>
                        <th scope="col">FIM</th><th scope="col">STATUS</th><th></th><th scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $selecionar_dados->setListaViewEventos();?>
                </tbody>
            </table>
        </div>
    </div>

<!-- INICO Modulos Inserção -->
    <div id="card_1" class='bg-success col-md-12 btn-group' style="display:none; padding: 10px; margin-bottom: 10px;" role='group' aria-label='Exemplo'>
        <form  method="POST" action="model/controller/inserir_dados.php" name='CadastrarModulo' >
            <h1>Módulos para Cadastrar</h1>
            <div class="col-md-6 dropdown">
            <table class="table table-striped" style='background:#ccc'>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th class='text-center' colspans='2' scope="col">Módulo habilitado para inserção de Dados</th>
                </tr>
            </thead>
            <tbody>
                <tr> <th scope="row">1</th> <td>Deficiência</td> <td class='text-center' colspan='3'><input type='radio' value='cad_deficiencia' name='radio_modulo' checked></td> </tr>
                <tr> <th scope="row">2</th> <td>Nivel de atendfimento</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_atendimento' name='radio_modulo'></td> </tr>
                <tr> <th scope="row">3</th> <td>Sexo</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_sexo' name='radio_modulo'></td> </tr>
                <tr> <th scope="row">4</th> <td>Núcleo</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_nucleo' name='radio_modulo'></td> </tr>
                <tr> <th scope="row">5</th> <td>Ação</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_acao' name='radio_modulo'></td> </tr>
                <tr> <th scope="row">#</th>
                    <td colspan='3'><input type="text" name="valor_modulo"></td>
                    <td><button type="submit" class="btn btn-success" value='Valid_Cad_Modulo' name='Btn_Cad_Modulo'>Cadastrar</button></td> 
                </tr>
            </tbody>
            </table>
        </form>    
    </div>
<!-- FIM Modulos Inserção  -->        
                                    
<!--  INICIO form cadastrar Dadms User --> 
        <div id="card_2" class='bg-primary panel-body col-md-12 btn-group' style="display:none; padding: 10px; margin-bottom: 10px;"  role='group' aria-label='Exemplo'>
        <?php 
            if(isset($_GET['resp']) && $_GET['resp']=='TarcisoeditUser'){
                $nome_btn = 'Editar';
                $acao = 'editar_dados.php';
            }else{
                $nome_btn = 'Cadastrar';
                $acao = 'inserir_dados.php';
            }

        ?>
            <form method="POST" action="model/controller/<?php echo $acao; ?>" name='CadastrarUser'>
                <div class="form-group">
                    <h3><?php echo $nome_btn." Usuários Eventos - Carreta"; ?></h3>
                    <div class="col-md-2 dropdown">
                        <label for="funcao">Evento</label>
                        <select class="form-control" name="fk_evento" id="fk_evento" style="max-width:100%">
                            <?php $selecionar_dados->setFuncaoEvento();?>
                        </select>
                    </div>                      
                    <div class="col-md-2 dropdown">
                        <label for="funcao">Função Sistema</label>
                        <select class="form-control" name="fk_funcao" id="fk_funcao" style="max-width:100%">
                            <?php $selecionar_dados->setFuncaoUser();?>
                        </select>
                    </div>
                    <div class="col-md-2 dropdown">
                        <label for="funcao">Tipo Usuário</label>
                        <select class="form-control" name="fk_tipo_user" id="fk_tipo_user" style="max-width:100%">
                            <?php $selecionar_dados->setTipoUser();?>
                        </select>
                    </div>                    
                    <div class="col-md-2 dropdown">
                        <label for="cpf">CPF</label>
                        <input  class="form-control"  type="cpf" name='cpf' placeholder="cpf" style="max-width:100%" 
                        value="<?php if(isset($_GET['cpf'])) echo @$_GET['cpf'];?>">
                    </div>
                    <div class="col-md-3 dropdown">
                        <label for="nome">Nome Completo</label>
                        <input  required class="form-control" type="text" name='nome' placeholder="nome do assistido"  style="max-width:100%" 
                        value="<?php if(isset($_GET['nome'])) echo @$_GET['nome'];?>">
                    </div> 
                    <div class="col-md-4 dropdown">
                        <label for="cargo">Cargo Funcionário</label>
                        <input required class="form-control" type="text" name='dsc_funcao_user' placeholder="cargo ou função"  style="max-width:200%" 
                        value="<?php if(isset($_GET['dsc_funcao_user'])) echo @$_GET['dsc_funcao_user'];?>">
                    </div> 
                    <div class="col-md-2 dropdown">
                        <label for="funcao">Habilitado</label>
                        <select class="form-control" name="habilitado_user" id="habilitado_user" style="max-width:100%">
                            <?php 
                                if($habilitado == 'S'){?>
                                    <option value='S' checked>Sim</option>
                                    <option value='N'>Não</option>
                                <?php }else { ?>
                                    <option value='N' checked>Não</option>
                                    <option value='S' >Sim</option>
                                <?php } ?>
                            ?>
                        </select>
                    </div> 
                    <input type="hidden" name="senha_user" value="<?php echo $senhas;?>">
                    <input type="hidden" name="iduser" value="<?php echo @$_GET['iduser'];?>">   
                    <input type="hidden" name="validarFormCadUser" value="TarcisoDpeapUser">   
                    <div class="col-md-2 dropdown">
                        <label for="exampleInputEmail1">Ação</label><br>
                        <button type="submit" name='btn_Cad_User' class="btn btn-success"  style="max-width:100%"><?php echo $nome_btn;?></button>
                    </div>
                </div>    
            </form>
        </div>
<!--  FIM form cadastrar dados User --> 

<!-- INICIO Exibir Lista de Informações -->
    <div class="container">
        <div id="card_1_2" class="container mt-10 btn-group">
            <table class="table table-hover text-left" style="width:100%" id="minhaTabelaA">
                <thead>
                    <tr>
                        <th scope="col" colspan="6">
                            <form name="form_usuarios_no_evento">
                                <input type="hidden" name="op" value="admin"> 
                                <div class="col-md-5 dropdown">
                                    <label for="funcao">Selecionar Grupo de Usuário:</label>
                                    <select class="form-control" name="fk_funcao" id="fk_funcao" style="max-width:100%">
                                        <?php $selecionar_dados->setFuncaoUser();?>
                                    </select>
                                </div>
                                <div class="col-md-2 dropdown">
                                    <label for="exampleInputEmail1">Ação</label><br>
                                    <button type="submit" class="btn btn-success" value='SeelcaoGrupo' name='SelecaoGrupo' style="max-width:100%">Selecionar Grupo</button>
                                </div>
                            </form>
                            <form name="form_pesquisa_usuario">
                                <input type="hidden" name="op" value="admin"> 
                                <div class="col-md-3 dropdown">
                                    <label for="nome">Nome Completo</label>
                                    <input  required class="form-control" type="text" name='nomepesquisa' placeholder="usuário">
                                </div>
                                <div class="col-md-2 dropdown">
                                    <label>Ação</label><br>
                                    <button type="submit" class="btn btn-success" value="btn_buscanomeTarciso" name="btn_buscanome">Consultar</button>
                                </div>
                            </form>

                        </th>
                    </tr>
                    <tr class="h5"><th scope="col">#</th><th scope="col">USUÁRIO</th><th scope="col">CPF</th><th scope="col">FUNÇÃO</th>
                    <th scope="col">HABILITADO</th><th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($_GET['fk_funcao'])){
                            @$funcao_user = $_GET['fk_funcao'];
                            $selecionar_dados->setListaViewUser(@$funcao_user);
                        }elseif(isset($_GET['btn_buscanome']) && $_GET['btn_buscanome'] == 'btn_buscanomeTarciso'){
                            @$nomepesquisa = $_GET['nomepesquisa'];
                            $selecionar_dados->setListaViewUserPesquisa(@$nomepesquisa);
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<!-- FIM Exibir Lista de Informações -->

<!-- INICIO Relatório Finalizado -->

    <div id="card_3" class='bg-danger panel-body col-md-12 btn-group' style="display:none; padding: 10px; margin-bottom: 10px;" role='group' aria-label='Exemplo'>
            <form method="get">
                <h3>Assistidos Atendidos</h3>
                <input type="hidden" name='validarForm' value='TarcisoGrafico'> 
                <input type="hidden" name='op' value='graficosarco'> 
                <input type="hidden" name='idevento' value='<?=$_SESSION["EventoId_evento"] ;?>'> 
                <div class='col-md-4 dropdown'>
                    <label for='nucleo_atendimento'>Membro</label>
                    <select class='form-control' name='atendente' id='atendente'>
                        <?php $selecionar_dados->setAtendenteAtendimento();?>
                    </select>
                </div>
                <div class='col-md-2 dropdown'>
                    <label for='nucleo_atendimento'>Ação</label>
                    <input class=' btn btn-primary form-control' type="submit" value="Executar" name="BtnExecutarGrafico">
                </div>
            </form>
    </div>

    <div class="container">
        <div  id="card_3_1" class="container mt-12 btn-group">
            <table class="table table-hover text-left" style="width:100%" id="minhaTabelaB">
                <thead>
                    <tr>
                        <th scope="col" colspan="12">
                            <h3 class="panel panel-success">Assistidos Atendidos e Finalizados</h3>
                        </th>
                    </tr>
                    <tr class="h5">                   
                        <th scope="col">#</th> <th scope="col">CPF</th> <th scope="col">NOME</th> <th scope="col">TELEFONE</th> <th scope="col">ENDERECO</th>
                        <th scope="col">DATA</th> <th scope="col">NÚCLEO</th> <th scope="col">MEMBRO</th> <th scope="col">NÍVEL</th> <th scope="col">SEXO</th>
                        <th scope="col">AÇÃO</th> <th scope="col">OBSERVAÇÃO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        @$contador = 0; $valores = 0;
                        $selecionar_dados->setListaAtendimentoFinalizadosGeral($contador, $valores);
                    ?>
                </tbody>
                <tfoot>
                    <th colspan='12'>Total da Listagem Finalizados: <?= $contador;?></th> 
                </tfoot>            
            </table>
        </div>
    </div>


<!-- FIM Relatório Finalizado -->
    


</div>    
 
<?php } ?>


<script type="text/javascript">
    $(document).ready(function(){
        document.getElementById("card_3_1").style.display='none';
        document.getElementById("card_4_1").style.display='none';
    });    

    function Mostra($id){
        if($id == 1){
            var card = document.getElementById("card_1");
            document.getElementById("card_1_2").style.display='none';
            document.getElementById("card_3_1").style.display='none';
            document.getElementById("card_4_1").style.display='none';
            document.getElementById("card_2").style.display='none';
            document.getElementById("card_3").style.display='none';
            document.getElementById("card_4").style.display='none';
            var elem   = window.getComputedStyle(card_1).display;
        }      
        else if($id == 2){
            var card = document.getElementById("card_2");
            document.getElementById("card_1_2").style.display='block';
            document.getElementById("card_3_1").style.display='none';
            document.getElementById("card_4_1").style.display='none';
            document.getElementById("card_1").style.display='none';
            document.getElementById("card_3").style.display='none';
            document.getElementById("card_4").style.display='none';
            var elem   = window.getComputedStyle(card_2).display;

        }
        else if($id == 3){
            var card   = document.getElementById("card_3");
            document.getElementById("card_3_1").style.display='block';
            document.getElementById("card_1_2").style.display='none';
            document.getElementById("card_4_1").style.display='none';
            document.getElementById("card_1").style.display='none';
            document.getElementById("card_2").style.display='none';
            document.getElementById("card_4").style.display='none';
            var elem   = window.getComputedStyle(card_3).display;

        }
        else if($id == 4){
            var card = document.getElementById("card_4");
            document.getElementById("card_4_1").style.display='block';
            document.getElementById("card_1_2").style.display='none';
            document.getElementById("card_3_1").style.display='none';
            document.getElementById("card_1").style.display='none';
            document.getElementById("card_2").style.display='none';
            document.getElementById("card_3").style.display='none';
            var elem   = window.getComputedStyle(card_4).display;

        }

        if(elem == 'none'){
            card.style.display='block';
        }else{
            card.style.display='none';
            if(card_3.style.display == 'none') {
                document.getElementById("card_1").style.display='block';
                document.getElementById("card_1_2").style.display='block';
                document.getElementById("card_4_1").style.display='none';
                document.getElementById("card_3_1").style.display='none';
                document.getElementById("card_2").style.display='none';
                document.getElementById("card_3").style.display='none';                
            }
        }   
        
    }
</script>       