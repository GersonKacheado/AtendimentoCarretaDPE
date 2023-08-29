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



<div class='container col-12'>
<div class='card'>  
 <div class='card-body'>
 <?php 
    if(isset($_GET['resp']) && $_GET['resp']=='TarcisoeditEvento'){
        $nome_btn = 'Editar';
        $acao = 'editar_dados.php';
    }else{
        $nome_btn = 'Cadastrar';
        $acao = 'inserir_dados.php';
    }
?>
 <form>
    <h3> <?php echo $nome_btn." Eventos - Mutirão"; ?> </h3>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <select class="form-control" name="fk_tipo_evento" id="fk_tipo_evento">
                            <?php $selecionar_dados->setTipoEvento();?>
                        </select>    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Descrição do Evento</label>
      <input type="text" name='dsc_evento' value="<?php if(isset($_GET['dsc_evento'])) echo @$_GET['dsc_evento'];?>" class="form-control" id="inputPassword4" placeholder="Descrição do Evento">
    </div>
  </div>

<div class="form-group">
    <label for="inputAddress2">Endereço</label>
    <input type="text" class="form-control" id="inputAddress2" name='endereco' placeholder="Endereço do evento"  value="<?php if(isset($_GET['endereco'])) echo @$_GET['endereco'];?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Data Início</label>
      <input type="date" class="form-control" id="inputEmail4"  name='data_inicio' value="<?php if(isset($_GET['data_inicio'])) echo @$_GET['data_inicio'];?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Data Fim</label>
      <input type="date" class="form-control" id="inputPassword4"  name='data_fim' value="<?php if(isset($_GET['data_fim'])) echo @$_GET['data_fim'];?>">
    </div>
  </div>

  <?php if($nome_btn <> 'Cadastrar'){?>
                        <div class="col-md-2 dropdown">
                            <label>Habilitado</label>
                            <select class="form-control" name="satus_evento" id="satus_evento" style="max-width:100%">
                                <?php 
                                    if($_GET['satus_evento'] == 1){ ?>
                                        <option value='1' checked>Sim</option>
                                        <option value='OFF'>Não</option>
                                    <?php }else { ?>
                                        <option value='0' >Não</option>
                                        <option value='ON' checked>Sim</option>
                                    <?php } ?>
                                
                            </select>
                        </div> 
                    <?php } ?> 

                    <input type="hidden" name="validarFormEvento" value="TarcisoDpeapEvento">   
                     <input type="hidden" name="id_evento" value="<?php echo @$_GET['id_evento'];?>"> 
                    <div class="col-md-2 dropdown">
                        <label>Ação</label><br>
                        <button type="submit" class="btn btn-success" style="max-width:100%"><?php echo $nome_btn; ?></button>
                    </div>
                </form>
 </div>   

</div>
</div>


<div class="card">
            <div class="card-body">
                <table class="table table-hover text-left" style="width:100%" id="minhaTabelaC">
                    <thead>
                        <tr>
                            <th scope="col" colspan="8">
                                <h3 class="panel panel-success">Eventos Cadastrados No Sistema</h3>
                            </th>
                        </tr>
                        <tr class="h5"><th scope="col">#</th><th scope="col">DESCRIÇÃO</th><th scope="col">ENDEREÇO</th><th scope="col">INÍCIO</th>
                            <th scope="col">FIM</th><th scope="col">STATUS</th><th></th><th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $selecionar_dados->setListaViewEventos();
                            if(isset($_GET['status_evento']) && $_GET['status_evento'] == 1){ 

//Inicio Modal de Relatorios Corregedoria Solicitação de Senha P Acesso aos Gráficos -->
echo "<script>
   

  
  
</script>";
// Fim Modal de Relatorios Corregedoria Solicitação de Senha P Acesso aos Gráficos -->
                                
                         } ?>
                    </tbody>
                </table>
            </div>
        </div> 



        <script type="text/javascript">

//    function Mostra($id){
//        switch($id){
//            case 1:
//                var card = document.getElementById("card_1");
//                var cardy = document.getElementById("card_1_1");
//                var elem   = window.getComputedStyle(card_1).display;
//                break;

//        }
//        if(elem == 'none'){
//            card.style.display='block';
//            cardy.style.display='block';
//            
//        }else{
    //        card.style.display='none';
    //        cardy.style.display='none';
//        }   
       
//    }
</script>





<?php } ?>
