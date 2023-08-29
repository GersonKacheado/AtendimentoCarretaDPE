<?php
   if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
}else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);

?>

    
    <div class="panel panel-success" id='profissionais'>
        <div class="panel-heading">
            <h3 class="panel-title"> <?php echo strtoupper($op); ?> </h3>

            <h3 class="panel-title"> 
                <?php 
                    if ((@$_GET['msg'])) {
                        echo base64_decode(@$_GET['msg']);
                    } 
                ?> 
            </h3>
        </div>

        <div class="panel-body">
            <h1 class="panel panel-success" style="color:green;">Usuários Atendidos e Finalizados</h1>


            <div class="h3 text-right m-3 menu_print">
                <a href="index.php?op=atendidos&rel=geral" style='margin-right:20px;'>Geral</a> 
                <a href="index.php?op=atendidos&rel=preferencial" style='margin-right:20px;'>Normal/Preferencial</a> 
                <a href="index.php?op=atendidos&rel=atendente" style='margin-right:20px;'>Atendente</a> 
                <a href="index.php?op=atendidos&rel=deficienteNao" style='margin-right:20px;'>Deficiente/Não</a> 
                <a href="index.php?op=atendidos&rel=guiche" style='margin-right:20px;'>Guiche</a>
                <a href="index.php?op=atendidos&rel=diario" style='margin-right:20px;'>Diário</a>


                <a href="index.php?op=atendidos&rel=imprimir" style='margin-right:20px;'>Imprimir</a>
            </div>

            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>                            
                            <th scope="col">Cpf Assistido</th>
                            <th scope="col">Assistido</th>
                            <th scope="col">Deficiência</th>
                            <th scope="col">Atendimento</th>
                            <th scope="col">Nome Atendente</th>
                            <th scope="col">Cpf Atendente</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Saída</th>
                            <th scope="col">Esperou</th>
                            <th scope="col">N. guiche</th>
                            <th scope="col">Data</th>
                            <th scope="col">Qtd</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:65%;">
 
    
                        <?php
                            $agora = new DateTime(); 
                            if(isset($_GET['rel']) and $_GET['rel'] =='imprimir'){

                                $t = "<script>window.print();</script>";
                                echo $t;
                                if(isset($t)){
                                    echo "
                                        <style>
                                            div.menu_print {display: none;} 
                                        </style>
                                    ";
                                }
                            }
                            
                            @$contador = 0; @$titulo = '';
                            if(isset($_GET['rel']) and $_GET['rel'] == 'guiche'){
                                $selecionar_dados->setListaAtendimentoFinalizadosGuche($contador, $titulo);
                            }elseif(isset($_GET['rel']) and $_GET['rel'] =='preferencial') {
                                $selecionar_dados->setListaAtendimentoFinalizadosPreferencial($contador, $titulo);
                            }elseif(isset($_GET['rel']) and $_GET['rel'] =='atendente'){
                                $selecionar_dados->setListaAtendimentoFinalizadosAtendente($contador, $titulo);
                            }elseif(isset($_GET['rel']) and $_GET['rel'] =='deficienteNao'){
                                $selecionar_dados->setListaAtendimentoDeficienteNao($contador, $titulo);
                            }elseif(isset($_GET['rel']) and $_GET['rel'] =='diario'){
                                @$dataInicio = '01/12/2021'; @$dataFim =  $agora->format('d/m/Y');
                                $selecionar_dados->setListaAtendimentoFinalizadosDiario($contador, $titulo, $dataInicio, $dataFim);
                            }else{
                                $selecionar_dados->setListaAtendimentoFinalizadosGeral($contador, $titulo);
                            }
                        ?>
   

                    </tbody>
                    <caption class="text-center"><h1>Listagem: <?= $titulo;?></h1></caption>
                    <tfoot>
                        <th colspan="11">Total da Listagem: <?= $contador;?></th>
                    </tfoot>
                </table>
            </div>
        </div>    
    </div>

<?php
/*    como saber a senha ou criar novas 
*
*
*
    $teste        = md5(hash('sha512', "@g5p10y@"));
    echo $teste;
 *
 *
 */       
} ?>

