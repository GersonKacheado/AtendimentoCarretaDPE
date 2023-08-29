
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
                    $cor                                 = fopen('public/select_text/cor.txt', 'r');
                    $possui_doenca_cronica               = fopen('public/select_text/possui_doenca_cronica.txt', 'r');
                    $possui_problema_psicologico         = fopen('public/select_text/possui_problema_psicologico.txt', 'r');
                    $possui_filho_doenca_cronica         = fopen('public/select_text/possui_filho_doenca_cronica.txt', 'r');
                   
                    $esta_gestante                       = fopen('public/select_text/esta_gestante.txt', 'r');
                    $frequencia_de_visita                   = fopen('public/select_text/frequencia_de_visita.txt', 'r');
                    $frequencia_recebe_absorvente_intimo    = fopen('public/select_text/frequencia_recebe_absorvente_intimo.txt', 'r');
                    $atendimento_mutirao_iapen              = fopen('public/select_text/atendimento_mutirao_iapen.txt', 'r');

                    $ocupacao           = fopen('public/select_text/ocupacao.txt', 'r');
                    $estado_civil       = fopen('public/select_text/estado_civil.txt', 'r');
                    $filhos_qtd         = fopen('public/select_text/filhos_qtd.txt', 'r');

 
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
                            <label for="cor">Cor</label>
                            <select class="form-control" name="cor" id="cor">
                                <?php while($linha = fgets($cor)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($cor);
                                ?>
                            </select>
                        </div>   

                        <div class="col-md-6 dropdown">
                            <label for="possui_doenca_cronica">Possui doença crônica</label>
                            <select class="form-control" name="possui_doenca_cronica" id="possui_doenca_cronica">
                                <?php while($linha = fgets($possui_doenca_cronica)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($possui_doenca_cronica);
                                ?>
                            </select>
                        </div>   

                        <div class="col-md-6 dropdown">
                            <label for="renda_domiciliar">Possui problema psicológico</label>
                            <select class="form-control" name="possui_problema_psicologico" id="possui_problema_psicologico">
                                <?php while($linha = fgets($possui_problema_psicologico)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($possui_problema_psicologico);
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
                            <label for="possui_filho_doenca_cronica">Possui Filhos com deficência ou doençcas crônicas</label>
                            <select class="form-control" name="possui_filho_doenca_cronica" id="possui_filho_doenca_cronica">
                                <?php while($linha = fgets($possui_filho_doenca_cronica)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($possui_filho_doenca_cronica);
                                ?>
                            </select>
                        </div> 

                        <div class="col-md-6 dropdown">
                            <label for="esta_gestante">Está gestante</label>
                            <select class="form-control" name="esta_gestante" id="esta_gestante">
                                <?php while($linha = fgets($esta_gestante)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($esta_gestante);
                                ?>
                            </select>
                        </div> 

                        <div class="col-md-6 dropdown">
                            <label for="frequencia_de_visita">Qual a frequência de visitas</label>
                            <select class="form-control" name="frequencia_de_visita" id="frequencia_de_visita">
                                <?php while($linha = fgets($frequencia_de_visita)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($frequencia_de_visita);
                                ?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="frequencia_recebe_absorvente_intimo">Qual a frequência que recebe os absorventes íntimos</label>
                            <select class="form-control" name="frequencia_recebe_absorvente_intimo" id="frequencia_recebe_absorvente_intimo">
                                <?php while($linha = fgets($frequencia_recebe_absorvente_intimo)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($frequencia_recebe_absorvente_intimo);
                                ?>
                            </select>
                        </div> 

                        <div class="col-md-6 dropdown">
                            <label for="atendimento_mutirao_iapen">Qual a área que procura atendimento </label>
                            <select class="form-control" name="atendimento_mutirao_iapen" id="atendimento_mutirao_iapen">
                                <?php while($linha = fgets($atendimento_mutirao_iapen)){ ?>
                                    <option value="<?php echo $linha; ?>"><?php echo $linha; ?></option>
                                <?php }
                                fclose($atendimento_mutirao_iapen);
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



