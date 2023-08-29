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
            <h3 class="panel-title"> <?php echo strtoupper($op);  echo " - ".base64_decode(@$_GET['msg']); ?> </h3>
        </div>
        <div class="panel-body">
            <h1 class="panel panel-success" style="color:green">Usuários em Atendimento</h1>
            <table class="table table-dark col-md-12" >
                <thead>
                    <tr class="h4">
                        <th scope="col">#</th>
                        <th scope="col">CPF</th>
                        <th scope="col">ASSISTIDO</th>
                        <th scope="col">TIPO</th>
                        <th scope="col">ENTRADA</th>
                        <th scope="col">SAÍDA</th>
                        <th scope="col" id='titulo_nucleo'>GUICHE</th>
                        <th scope="col" id='titulo_nucleo'>NÚCLEO</th>
                        <th scope="col" id='titulo_nucleo'>AÇÃO</th>
                        <th colspan ="2" id ="acao_th" scope="col" class='text-center'>#</th>
                    </tr>
                </thead>
                <tbody style="color:#000">

                    <?php
                        $selecionar_dados->setListaAtendimento();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>          

<?php } ?>





    
  


