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
    
    <?php include_once('opcoes.php'); ?>

<!-- INICIO Listagem de User -->
    <div class="container">
        <div  id="card_2_2" class="container mt-10 btn-group">
            <table class="table table-hover text-left" style="width:100%" id="minhaTabelaA">
                <thead>
                    <tr><th colspan="5">Equipe que irá atuar no evendo de : <span class='text-success'><?=@$_SESSION["EventoDsc_evento"] ;?></span></th></tr>
                    <?php 
                        if(isset($_GET['fk_funcao'])){
                            @$funcao_user = $_GET['fk_funcao'];
                            $selecionar_dados->setListaViewUser(@$funcao_user);
                        }elseif(isset($_GET['btn_buscanome']) && $_GET['btn_buscanome'] == 'btn_buscanomeTarciso'){
                            @$nomepesquisa = $_GET['nomepesquisa'];
                            $selecionar_dados->setListaViewUserPesquisa(@$nomepesquisa);
                        } else{
                            $selecionar_dados->setListaViewUserPesquisaAoAbrir();
                        }

                    ?>

                </thead>
                <tbody>
                    <tr>
                        <th scope="col" colspan="7">
                            <!-- Consultar Por Grupo os Usuarios -->
                            <form name="form_usuarios_no_evento">
                                <input type="hidden" name="op" value="admin_user"> 
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
                            <!-- Consultar Por Nome  os Usuarios -->
                            <form name="form_pesquisa_usuario">
                                <input type="hidden" name="op" value="admin_user"> 
                                <div class="col-md-3 dropdown">
                                    <label for="nome">Nome Completo</label>
                                    <input class="form-control" type="text" name='nomepesquisa' placeholder="usuário">
                                </div>
                                <div class="col-md-2 dropdown">
                                    <label>Ação</label><br>
                                    <button type="submit" class="btn btn-success" value="btn_buscanomeTarciso" name="btn_buscanome">Consultar</button>
                                </div>
                            </form>

                        </th>
                    </tr>
                    <tr class="h5"><th scope="col">#</th><th scope="col">USUÁRIO</th><th scope="col">CPF</th><th scope="col">FUNÇÃO</th>
                    <th scope="col">HABILITADO</th><th>EVENTO</th><th>AÇÕES</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<!-- FIM listagem User -->
   
                                    
<!--  INICIO form cadastrar Dadms User --> 
<div id="card_2" style="padding: 10px; margin-bottom: 10px;" class='bg-primary panel-body col-md-12 btn-group' role='group' aria-label='Exemplo'>
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



</div>    

<script type="text/javascript">
//    function Mostra($id){
//        switch($id){
//            case 2:
//                var card = document.getElementById("card_2");
//                var cardy = document.getElementById("card_2_2");
//                var elem   = window.getComputedStyle(card_2).display;
//                break;

//        }
//        if(elem == 'none'){
//            card.style.display='block';
//            cardy.style.display='block';
            
//        }else{
//            card.style.display='none';
//            cardy.style.display='none';
//        }   
       
//    }
</script>        


<?php } ?>


