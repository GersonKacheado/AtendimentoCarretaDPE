<?php
   if(!isset($_SESSION["UsuarioCpf"])) {
      echo "<script>location.href='public/login/index.php'</script>";
}else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);
?>
<div class="panel panel-success" id='profissionais'>
    <div class="panel-heading">
        <h3 class="panel-title"> <?php echo strtoupper($op); ?>
            <?php 
                if ((@$_GET['msg'])) {
                    echo base64_decode(@$_GET['msg']);
                } 
            ?> 
        </h3>
    </div>
    <div class="panel-body"><h1 class="panel panel-success" style="color:green;">Assistidos em Espera</h1>
        
    <!-- Inico da Chamada do Gráfico -->      
        <form method="get">
            <input type="hidden" name='validarForm' value='TarcisoGrafico'> 
            <input type="hidden" name='op' value='graficosarcoprevio'> 
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
    <!-- Fim da Chamda do Gráfico -->
        <?php
            $agora = new DateTime(); 
            @$contador = 0; $valores = 0; @$titulo = '';
            $html = "
                <table class='col-md-12 table table-striped table-responsive'>
  
                    <tbody>";
                        $selecionar_dados->setListaAtendimentoFinalizadosGeralPrevio($contador, $valores, $titulo, $html);
                        $html .= "    
                        <tfoot>
                            <th colspan='11'>Total da Listagem : ". $contador. "</th>
                            <th colspan='11' class='text-right'>".$valores. "</th>
                        </tfoot>";                                
                        echo $html.
                    "</tbody>
                  <thead>
                    	<tr>
                            <th colspan='11'>Total da Listagem : ". $contador. "</th>
                            <th colspan='11' class='text-right'>".$valores. "</th>                    	
                    	</tr>
                        <tr>
                            <th scope='col'>#</th><th scope='col'>Cpf</th><th scope='col'>Nome</th><th scope='col'>Telefone</th><th scope='col'>Endereço</th>
                            <th scope='col'>Data</th><th scope='col'>Núcleo</th><th scope='col'>Membro</th><th scope='col'>Nível</th><th scope='col'>Sexo</th>
                            <th scope='col'>Ação</th><th scope='col'>Observacao</th><th scope='col'>Qtd</th>
                        </tr>
                    </thead>                    
                    <caption class='text-center'><h1><?= $titulo;?></h1></caption>
                </table>";

        ?>
       </div>    
    </div>
<?php } 
?>

