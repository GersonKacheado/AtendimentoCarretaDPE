<?php
   if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
}else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);
    echo("<meta http-equiv='refresh' content='15'>");    
?>
<div style="position: relative;">
    <div class="panel panel-success" id='profissionais'>
        <div class="panel-heading">
            <h3 class="panel-title"> <?php echo strtoupper($op); ?> </h3>
        </div>
        <div class="panel-body">
            <h1 class="panel panel-success" style="color:green">Usuários Aguardando Atendimento</h1>
            <table class="table table-dark col-md-12">
                <thead>
                    <tr class="h3">
                        <th scope="col">#</th>
                        <th scope="col">CPF</th>
                        <th scope="col">NOME DO ASSISTIDO</th>
                        <th scope="col">HORA/DATA</th>
                        <th scope="col">NÚCLEOS</th>
                        <th scope="col">AÇÕES</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $selecionar_dados->setListaAddAssistido();?>
                </tbody>
            </table>
        </div>
    </div>
</div>    

<?php } ?>

