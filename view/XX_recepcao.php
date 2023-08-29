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
            <?php if(isset($_GET['resp']) && $_GET['resp']=='Tarcisoedit'){ @$idfila = $_GET['idfila']; ?>
                <form class="p-0" method="POST" action="model/controller/editar_dados.php" >
                    <input type="hidden" name='idfila' value="<?php echo $idfila; ?>">
                    <input type="hidden" name='EditarDadosForm' value='AssistidosCarreta'> 
                    <input type="hidden" name='chamdo_para_atendimento' value='1'> 
                    <div class="form-group">
                        <div class="col-md-10 dropdown">
                            <label for="exampleInputEmail1">Nome Completo</label>
                            <input  class="form-control border-0" type="name" name='nome' value="<?php echo $_GET['nome']; ?>"  readonly>
                        </div>   
                        <div class="col-md-3 dropdown">
                            <label for="nucleo_atendimento">Núcleo</label>
                            <select class="form-control" name="obsnucleos" id="obsnucleos"  autofocus=0 >
                                <?php $selecionar_dados->setNucleoAtendimento();?>
                            </select>
                        </div>   
                        <div class="col-md-3 dropdown">
                            <label for="nucleo_atendimento">Ação</label>
                            <select class="form-control" name="obsacoes" id="obsacoes" >
                                <?php $selecionar_dados->setAcaoAtendimento();?>
                            </select>
                        </div>   
                        <div class="col-md-4 dropdown">
                            <label for="nucleo_atendimento">Defensor(a)</label>
                            <select class="form-control" name="atendente" id="atendente" >
                                <?php $selecionar_dados->setAtendenteAtendimento();?>
                            </select>
                        </div> 
                        <div class="col-md-6 dropdown">
                            <label for="nucleo_atendimento">Observações</label>
                            <?php $selecionar_dados->setAtendenteObsEdit();?>
                        </div> 
                        <div class="col-md-2 dropdown">
                            <label for="">Tipo de Documento</label>
                            <select class="form-control" name="tipo_documento" id="tipo_documento" >
                            
                                <?php $selecionar_dados->setAtendenteTipoSolucaoEdit();?>
                            </select>
                        </div> 
                        <div class="col-md-2 dropdown">
                            <label for="">Registro Documento</label>
                            <?php $selecionar_dados->setAtendenteSolucaoEdit();?>
                        </div> 
                          
                        <div class="col-md-1 dropdown" style="display: block;">
                            <label for="exampleInputEmail1">Ação</label><br>
                            <button type="submit" class="btn btn-primary"  name='btnDadosEdit'>Edição</button>
                        </div>
                        
                    </div>    
                </form>
            <?php }else{ ?>
                <form class="p-0" method="POST" action="model/controller/inserir_dados.php" >
                    <div class="form-group">
                         <div class="col-md-2 dropdown" >
                            <label for="dsc_fisica">Deficiência </label>
                            <select class="form-control" name="dsc_fisica" id="dsc_fisica" autofocus=0>
                                
                                <?php $selecionar_dados->setTipoDeficiencia();?>
                            </select>
                        </div>
                        <div class="col-md-2 dropdown">
                            <label for="nivel_atendimento">Tipo</label>
                            <select class="form-control" name="nivel_atendimento" id="nivel_atendimento">
                                <?php $selecionar_dados->setNivelAtendimento();?>
                            </select>
                        </div>                    
                        <div class="col-md-2 dropdown">
                            <label for="sexo_atendimento">Sexo</label>
                            <select class="form-control" name="sexo_atendimento" id="sexo_atendimento">
                                <?php $selecionar_dados->setSexoAtendimento();?>
                            </select>
                        </div>                    
                        <div class="col-md-2 dropdown">
                            <label for="exampleInputEmail1">CPF</label>
                            <input  class="form-control"  type="cpf" name='cpf' placeholder="cpf" required>
                        </div>
                        <div class="col-md-2 dropdown">
                            <label for="exampleInputEmail1">Telefone</label>
                            <input  class="form-control" type="name" name='telefone' placeholder="Telefone do assistido"  required>
                        </div>    

                        <div class="col-md-5 dropdown">
                            <label for="exampleInputEmail1">Nome Completo</label>
                            <input  class="form-control" type="name" name='nome' placeholder="nome do assistido"  required>
                        </div>    
                        <div class="col-md-5 dropdown">
                            <label for="exampleInputEmail1">Endereço</label>
                            <input  class="form-control" type="name" name='endereco' placeholder="Endreço Completo do assistido"  required>
                        </div>    
                        <div class="col-md-3 dropdown">
                            <label for="nucleo_atendimento">Núcleo</label>
                            <select class="form-control" name="obsnucleos" id="obsnucleos"  >
                                <?php $selecionar_dados->setNucleoAtendimento();?>
                            </select>
                        </div>   
                        <div class="col-md-3 dropdown">
                            <label for="nucleo_atendimento">Ação</label>
                            <select class="form-control" name="obsacoes" id="obsacoes">
                                <?php $selecionar_dados->setAcaoAtendimento();?>
                            </select>
                        </div>   
                        <div class="col-md-4 dropdown">
                            <label for="nucleo_atendimento">Defensor(a)</label>
                            
                            <select class="form-control" name="atendente" id="atendente">
                                <option value='52'>Qual ?</option>
                                <?php $selecionar_dados->setAtendenteAtendimento();?>
                            </select>
                        </div> 
                        <div class="col-md-9 dropdown">
                            <label for="nucleo_atendimento">Observações</label>
                            <textarea type='text' class='form-control' name='observacao' id='observacao' placeholder="Observações, se necessário..."></textarea>                        
                        </div> 

                        <input class="form-control" value="<?= date('Y-m-d');?>" type="hidden" name='data'>
                        <input class="form-control" value="<?= $_SESSION["EventoId_evento"]?>" type="hidden" name='fk_evento'>


                        <input type="hidden" name='insertDadosForm' value='Assistidos'>       
                        <div class="col-md-2 dropdown" style="display: block;">
                            <label for="exampleInputEmail1">Ação</label><br>
                            <button type="submit" class="btn btn-primary"  name='btnDadosInsert'>Cadastro</button>
                        </div>
                    </div>    
                </form>
            <?php } ?>
        </div>

        <div class="mt-10 col-md-12 btn-group table-responsive">
            <h3 class="ps-12 panel-titulo" style="color:green">Usuários Cadastrados para Atendimento</h3>
            <table class="col-md-12 table table-striped table-responsive" id="minhaTabelaE">
                <thead>
                    <tr class="h5">
                        <th scope="col">#</th>    
                        <th scope="col">TEMPO</th>
                        
                        <th scope="col">NOME DO ASSISTIDO</th>
                        <th scope="col">CPF</th>
                        <th scope="col">ATENDIMENTO</th>
                        <th scope="col">DEFICIÊNCIA</th>
                        <th scope="col">HORA/DATA</th>
                        <th scope="col">TELEFONE</th>
                        <th scope="col">ENDEREÇO</th>
                        <th scope="col">NÚCLEOS</th>
                        <th scope="col">AÇÕES</th>
                        <th scope="col">ATENDENTE</th>
                        <th scope="col">OBSERVAÇÃO</th>
                        <th scope="col">DESISTÊNCIA</th>
                    </tr>
                </thead>
                <tbody style="color:#000">
                    
                    <?php
                        if(isset($_GET['buscar']) && $_GET['buscar']<>NULL && isset($_GET['acao']) && $_GET['acao']=='Tarcisobuscar'){
                            $busca = $_GET['buscar']; 
                            $selecionar_dados->setListaViewBuscar($busca);
                        }else {
                            $selecionar_dados->setListaViewAssistido();
                        }                     
                    ?>                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>  
<?php }  ?>
<script>
    $("#dsc_fisica").blur(_ => { 
        if($('#dsc_fisica :selected').text()!='Não')
            $("#nivel_atendimento").val("7");
        else
        $("#nivel_atendimento").val("1");
    });


</script>


