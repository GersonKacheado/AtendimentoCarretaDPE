<?php
$senhas =( md5(hash('sha512', "dpeap")));
if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
}else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);
    @$habilitado = $_GET['habilita_user'];
 ?>
     <?php include_once('opcoes.php'); ?>

<div class='container'>
    <div class='card'>
        <div class='card-body'>
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
</div>









     <?php } ?>
