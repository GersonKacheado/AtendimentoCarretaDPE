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
    
    <?php 
    if($_SESSION["UsuarioIdFuncao"] == 1)
        include_once('opcoes.php'); 
    ?>


<!-- INICIO Relatório Finalizado -->

    <div id="card_3" style="padding: 10px; margin-bottom: 10px;" class='bg-danger panel-body col-md-12 btn-group' role='group' aria-label='Exemplo'>
        <form method="get">
                <h3>Assistidos Atendidos</h3>

                <div class='col-md-2 dropdown'>
                    <label for='nucleo_atendimento'>Ação/Evento</label>
                    <select class='form-control' name='idevento' id='idevento'>
                        <?php $selecionar_dados->setFuncaoEventoRelatorio();?>
                    </select>
                </div>
                <input type="hidden" name='validarForm' value='TarcisoGrafico'> 
                <input type="hidden" name='op' value='admin_relatorio'> 

                <div class='col-md-1 dropdown'>
                    <label for='nucleo_atendimento'>Ação</label>
                    <input class=' btn btn-primary form-control' type="submit" value="Selecionar" name="BtnExecutarGrafico">
                </div>
                
        </form>
        <form method="get">
                <div class='col-md-3 dropdown'>
                    <label for='nucleo_atendimento'>Nome ou Cpf do Assistido</label>
                    <input type='text' class='form-control' name='buscarNomeCpf' id='buscarNomeCpf' required>
                </div>

                <input type="hidden" name='validarForm' value='TarcisoBuscar'> 
                <input type="hidden" name='op' value='admin_relatorio'> 

                <div class='col-md-1 dropdown'>
                    <label for='nucleo_atendimento'>Ação</label>
                    <input class=' btn btn-primary form-control' type="submit" value="Buscar" name="BtnBuscar">
                </div>
                
        </form>
        <?php if (isset($_GET['BtnExecutarGrafico']) && $_GET['BtnExecutarGrafico']=='Selecionar'){ ?>
        <form method="get">
                <input type="hidden" name='validarForm' value='TarcisoGrafico'> 
                <input type="hidden" name='op' value='graficosarco'> 
                <input type="hidden" name='idevento' value='<?= @$_GET['idevento'] ;?>'>  

                <div class='col-md-3 dropdown'>
                    <label for='nucleo_atendimento'>Membro</label>
                    <select class='form-control' name='atendente' id='atendente'>
                        <?php $selecionar_dados->setAtendenteAtendimentoRelatorio();?>
                    </select>
                </div>
                <div class='col-md-1 dropdown'>
                    <label for='nucleo_atendimento'>Ação</label>
                    <input class=' btn btn-primary form-control' type='submit' value='Executar' name='BtnExecutarGrafico'>
                </div>
        </form>
        <?php } ?>
     
    </div>

    <div class="container-fluid fs-1">
        <div  id="card_3_3" class="container mt-12 btn-group">
            <table class="table table-hover text-left" id="minhaTabelaB" style="width:100% !important">
                <tr>
                    <th scope="col" colspan="20">
                        <h3 class="panel panel-success">Assistidos Atendidos e Finalizados - <span class='text-primary'><?php echo (isset($_GET['BtnExecutarGrafico']) && $_GET['BtnExecutarGrafico']=='Selecionar')? $selecionar_dados->FuncaoSelecaoEvento($_GET['idevento']): $selecionar_dados->FuncaoSelecaoEvento($_SESSION["EventoId_evento"]);?></span></h3>
                    </th>
                </tr>
                <tr class="h5">                   
                    <th scope="col">#</th> <th scope="col">CPF</th> <th scope="col">NOME</th> <th scope="col">TELEFONE</th> <th scope="col">ENDERECO</th>
                    <th scope="col">ENTRADA</th> <th scope="col">SAÍDA</th> <th scope="col">NÚCLEO</th> <th scope="col">MEMBRO</th> <th scope="col">NÍVEL</th> <th scope="col">SEXO</th>
                    <th scope="col">AÇÃO</th> <th scope="col">OBSERVAÇÃO</th><th scope="col">Desistência</th><th scope="col">Entrevistado</th><th scope="col">Tempo Espera</th><th scope="col">Inicio Atendimento</th><th scope="col">Fim Atendimento</th>
                    <th scope="col">Tempo do Atendimento</th>
                </tr>
                <tbody>
                    <?php 
                        @$contador = 0; @$valores = 0;
                        if(isset($_GET['idevento']) && !is_null($_GET['idevento'])){
                            $selecionar_dados->setListaAtendimentoFinalizadosGeral($contador, $valores, (isset($_GET['BtnExecutarGrafico']) && $_GET['BtnExecutarGrafico']=='Selecionar')? $id=$_GET['idevento']:$id=$_SESSION["EventoId_evento"]);
                        }elseif(isset($_GET['buscarNomeCpf']) && !is_null($_GET['buscarNomeCpf'])) {
                            $selecionar_dados->setListaAtendimentoFinalizadosPorAssistido($contador, $valores, (isset($_GET['BtnBuscar']) && $_GET['BtnBuscar']=='Buscar')? $id=$_GET['buscarNomeCpf']:'');
                        }
                     ?>
                </tbody>
                <tfoot>
                    <th colspan='20'>Total da Listagem Finalizados: <?= @$contador;?></th> 
                </tfoot>            
            </table>
        </div>
    </div>
<!-- FIM Relatório Finalizado -->
     
</div>    

<?php } ?>


