<?php
   if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
}else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);

 ?>
<div style="position: relative;">
    <div class="panel panel-success" id='profissionais'>
        <div class="panel-heading">
            <h3 class="panel-title"> <?php echo strtoupper($op). " Usuários do Sistema"; ?> </h3>
            <h3 class="panel-title"> 
                <?php 
                if ((@$_GET['msg'])) {
                    echo base64_decode(@$_GET['msg']);
                }  

                ?> 
            </h3>
        </div>
        <div class='panel-body col-md-12 btn-group' role='group' aria-label='Exemplo'>
            <form method="POST" action="model/controller/editar_dados.php" >
                <div class="form-group">
                    <div class="col-md-2 dropdown">
                        <label for="nivel_atendimento">Função</label>
                        <select class="form-control" name="fk_funcao" id="fk_funcao" style="max-width:100%">
                            <?php $selecionar_dados->setFuncaoUser();?>
                        </select>
                    </div>
                    <div class="col-md-2 dropdown">
                        <label for="exampleInputEmail1">CPF</label>
                        <input  class="form-control"  type="cpf" name='cpf' placeholder="cpf" style="max-width:100%" 
                        value="<?php if(isset($_GET['cpf'])) echo $_GET['cpf'];?>">
                    </div>
                    <div class="col-md-4 dropdown">
                        <label for="exampleInputEmail1">Nome Completo</label>
                        <input  class="form-control" type="name" name='nome' placeholder="nome do assistido"  style="max-width:200%" 
                        value="<?php if(isset($_GET['nome'])) echo $_GET['nome'];?>">
                    </div> 
                    <input type="hidden" name="iduser" value="<?= $_GET['iduser'];?>">   
                    <input type="hidden" name="validarForm" value="TarcisoDpeap">   
                    <div class="col-md-2 dropdown">
                        <label for="exampleInputEmail1">Ação</label><br>
                        <button type="submit" class="btn btn-primary"  style="max-width:100%" name='btnDadosAlterar'>Alterar Dados</button>
                    </div>
                </div>    
            </form>
        </div>

        <div class="mt-10 col-md-12 btn-group">
            <h1 class="panel panel-success" style="color:green">Usuários Cadastrados No Sistema</h1>
            <table class="table table-dark col-md-12">
                <thead>
                    <tr class="h3">
                        <th scope="col">#</th>
                        <th scope="col">NOME USUÁRIO</th>
                        <th scope="col">CPF</th>
                        <th scope="col">FUNÇÃO</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody style="color:#000">
                    <?php $selecionar_dados->setListaViewUser();?>
                </tbody>
            </table>
        </div>
    </div>
</div>    



<?php } ?>

