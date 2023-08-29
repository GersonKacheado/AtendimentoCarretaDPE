
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
            <h3 class="panel-title"> <?php echo strtoupper($op); ?> </h3>
            <h3 class="panel-title"> 
                <?php 
                    if ((@$_GET['msg'])) {
                        echo base64_decode(@$_GET['msg']);
                    }  
                ?> 
            </h3>
        </div>
        <div class='p-0 panel-body col-md-12 btn-group' role='group' aria-label='Exemplo'>
            <?php 
                if(isset($_GET['resp']) && $_GET['resp']=='Tarcisoedit'){ 
                    @$idfila = $_GET['idfila']; 
                    $idade              = fopen('public/select_text/idade.txt', 'r');
                    $escolaridade       = fopen('public/select_text/escolaridade.txt', 'r');
                    $renda              = fopen('public/select_text/renda.txt', 'r');
                    $ocupacao           = fopen('public/select_text/ocupacao.txt', 'r');
                    $estado_civil       = fopen('public/select_text/estado_civil.txt', 'r');
                    $filhos_qtd         = fopen('public/select_text/filhos_qtd.txt', 'r');
                    $tipo_residencia    = fopen('public/select_text/tipo_residencia.txt', 'r');
                    $condicao_imovel    = fopen('public/select_text/condicao_imovel.txt', 'r');
                    $local_residencia   = fopen('public/select_text/local_residencia.txt', 'r');
                    $rede_esgoto        = fopen('public/select_text/rede_esgoto.txt', 'r');
                    $fossa_septica      = fopen('public/select_text/fossa_septica.txt', 'r');
                    $agua_tratda        = fopen('public/select_text/agua_tratda.txt', 'r');
                    $rede_internet      = fopen('public/select_text/rede_internet.txt', 'r');
                    $conhecimento_acao  = fopen('public/select_text/conhecimento_acao.txt', 'r');
                    $avaliacao_defensor = fopen('public/select_text/avaliacao_defensor.txt', 'r');
                    $avaliacao_tempo    = fopen('public/select_text/avaliacao_tempo.txt', 'r');
                    $importancia_carreta= fopen('public/select_text/importancia_carreta.txt', 'r');
                    $area_buscou        = fopen('public/select_text/area_buscou.txt', 'r');
                    $providencia_tomada = fopen('public/select_text/providencia_tomada.txt', 'r');

?>
                <form class="p-0" method="POST" action="model/controller/inserir_dados.php" >
                    <input type="hidden" name='idfila' value="<?php echo $idfila; ?>">
                    <input type="hidden" name='validarFormEntrevista' value='TarcisoEntrevista'>
                    <div class="form-group">
                        <div class="col-md-4 dropdown">
                            <label for="exampleInputEmail1">Nome Completo</label>
                            <input  class="form-control border-0" type="text" name='nome' value="<?php echo $_GET['nome']; ?>"  readonly>
                        </div>   
                        <div class='col-md-10' dropdown></div>
                        <div class="col-md-6 dropdown">
                            <label for="idade">Idade</label>
                            <select class="form-control" name="idade" id="idade"  autofocus=0 >
                                <?php while($linha = fgets($idade)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($idade);
                                ?>
                            </select>
                        </div>   
                        <div class="col-md-6 dropdown">
                            <label for="esclaridade">Escolaridade</label>
                            <select class="form-control" name="escolaridade" id="escolaridade">
                                <?php while($linha = fgets($escolaridade)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($escolaridade);
                                ?>
                            </select>
                        </div>   
                        <div class="col-md-6 dropdown">
                            <label for="renda_domiciliar">Renda</label>
                            <select class="form-control" name="renda_domiciliar" id="renda_domiciliar">
                                <?php while($linha = fgets($renda)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($renda);
                                ?>
                            </select>
                        </div>   
                        <div class="col-md-6 dropdown">
                            <label for="ocupacao">Ocupação</label>
                            <select class="form-control" name="ocupacao" id="ocupacao">
                                <?php while($linha = fgets($ocupacao)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($ocupacao);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="estado_civil">Estado Civil</label>
                            <select class="form-control" name="estado_civil" id="estado_civil">
                                <?php while($linha = fgets($estado_civil)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($estado_civil);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="possui_filhos_qtd">Possui Filhos</label>
                            <select class="form-control" name="possui_filhos_qtd" id="possui_filhos_qtd">
                                <?php while($linha = fgets($filhos_qtd)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($filhos_qtd);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="tipo_residencia">Tipo de Residência</label>
                            <select class="form-control" name="tipo_residencia" id="tipo_residencia">
                                <?php while($linha = fgets($tipo_residencia)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($tipo_residencia);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="condicao_imovel">Condição do Imóvel</label>
                            <select class="form-control" name="condicao_imovel" id="condicao_imovel">
                                <?php while($linha = fgets($condicao_imovel)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($condicao_imovel);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="local_residencia">Local da Residência</label>
                            <select class="form-control" name="local_residencia" id="local_residencia">
                                <?php while($linha = fgets($local_residencia)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($local_residencia);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="rede_esgoto">Tem Acesso a Rede de Esgoto</label>
                            <select class="form-control" name="rede_esgoto" id="rede_esgoto">
                                <?php while($linha = fgets($rede_esgoto)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($rede_esgoto);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="fossa_septica">Tem Fossa Séptica</label>
                            <select class="form-control" name="fossa_septica" id="fossa_septica">
                                <?php while($linha = fgets($fossa_septica)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($fossa_septica);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="agua_tratada">Tem Acesso a Àgua Tratada</label>
                            <select class="form-control" name="agua_tratada" id="agua_tratada">
                                <?php while($linha = fgets($agua_tratda)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($agua_tratda);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="rede_internet">Possui Rede de Internet</label>
                            <select class="form-control" name="rede_internet" id="rede_internet">
                                <?php while($linha = fgets($rede_internet)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($rede_internet);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="conhecimento_acao">Como Tomou Conhecimento da Ação</label>
                            <select class="form-control" name="conhecimento_acao" id="conhecimento_acao">
                                <?php while($linha = fgets($conhecimento_acao)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($conhecimento_acao);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="avaliacao_defensor">Como Avalia atuação do Defensor(a)</label>
                            <select class="form-control" name="avaliacao_defensor" id="avaliacao_defensor">
                                <?php while($linha = fgets($avaliacao_defensor)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($avaliacao_defensor);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="avaliacao_tempo">Como Avalia o Tempo de Atendimento do Defensor(a)</label>
                            <select class="form-control" name="avaliacao_tempo" id="avaliacao_tempo">
                                <?php while($linha = fgets($avaliacao_tempo)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($avaliacao_tempo);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="importancia_carreta">Qual a importância da carreta na sua Opnião</label>
                            <select class="form-control" name="importancia_carreta" id="importancia_carreta">
                                <?php while($linha = fgets($importancia_carreta)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($importancia_carreta);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for='area_buscou_nao_houve_atendimento'>Houve alguma área que buscou e não foi Atendido(a)</label>
                            <select class="form-control" name="area_buscou_nao_houve_atendimento" id="area_buscou_nao_houve_atendimento">
                                <?php while($linha = fgets($area_buscou)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($area_buscou);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for='melhorar_atendimento'>O que acha que poderia ser feito para melhorar o atendimento da DPE durante a ação?</label>
                            <input class="form-control border-0" type="text" name='melhorar_atendimento'>
                        </div>   
                        <div class="col-md-6 dropdown">
                            <label for='providencia_tomada'>Qual Providência Tomada após Atendimento</label>
                            <select class="form-control" name="providencia_tomada" id="providencia_tomada">
                                <?php while($linha = fgets($providencia_tomada)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($providencia_tomada);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for='acao_prolongada'>Qual a providência tomada após atendimento? Caso resposta seja Outros?</label>
                            <input class="form-control border-0" type="text" name='acao_prolongada'>
                        </div>
                        <div class="col-md-6 dropdown">
                            <label>Nome Completo do Entrevistador(a)</label>
                            <input class="form-control border-0" type="text" name='nome_entrevistador' required>
                        </div>

                          
                        <div class="col-md-1 dropdown" style="display: block;">
                            <label>Ação</label><br>
                            <button type="submit" class="btn btn-primary"  name='btnDadosEntrevista'>Enviar Dados </button>
                        </div>
                    </div>    
                </form>
            <?php } ?>
        </div>

        <div class="mt-10 col-md-12 btn-group table-responsive">
            <h3 class="ps-12 panel-titulo" style="color:green">Usuários Aptos para Entrevista</h3>
            <table class="col-md-12 table table-striped table-responsive " id="minhaTabelaD">
                <thead>
                    <tr class="h5">
                        <th scope="col">#</th>
                        <th scope="col">NOME DO ASSISTIDO</th>
                        <th scope="col">CPF</th>
                        <th scope="col">ENDEREÇO</th>
                        <th scope="col">TELEFONE</th>
                        <th scope="col">OBSERVAÇÃO</th>
                        <th scope="col">DESISTÊNCIA</th>
                    </tr>
                </thead>
                <tbody style="color:#000">
                    
                    <?php
                        if(isset($_GET['buscar']) && $_GET['buscar']<>NULL && isset($_GET['acao']) && $_GET['acao']=='Tarcisobuscar'){
                            $busca = $_GET['buscar']; 
                            $selecionar_dados->setListaViewBuscarEntrevista($busca);
                        }else {
                            $selecionar_dados->setListaVieEntrevista();
                        }                     
                    ?>  
                </tbody>
            </table>
        </div>     
    </div>
</div>  
<?php }  ?>



