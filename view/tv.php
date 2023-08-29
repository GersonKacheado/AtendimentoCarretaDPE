<?php
   if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
    }else{
        include_once("model/DQL.php");
        $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);
        $selecionar_dados->setListaAtendimentoChamado();
    
    //echo("<meta http-equiv='refresh' content='15'>");
     
    ?>
    <script>
       setTimeout(function() {
            document.location.assign("index.php?op=tv");
        }, 10000);
    </script>
      
<?php
    if ($selecionar_dados->getFalarNomeGuiche()) {
        
        $txt= $selecionar_dados->getFalarNomeGuiche();
        $txt=htmlspecialchars($txt);
        $txt=rawurlencode($txt);

        $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=pt-IN');
        $player="<audio style='background-color:#000' controls='controls' autoplay>
        <source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
        
    }else{
        $player='';
    }

?>

<style>
    aside {display: none;}
    section.content { width: 100%; position: absolute; right: 0; padding: 0;}
    div.box { height: 100vh; }
    div.container { height:70vh; padding: 0}
</style>

<div style="position: relative;">
   
<!--        
        <div class="panel-heading d-flex justify-content-between">
            <h3 class="panel-title" > <?php // echo strtoupper($op);?> </h3>
        </div>
-->
        <div class="panel-body">
            <div class="row justify-content-center" style="background-color:#489f58; height:40vh">
                <div class="col-12 my-auto" style="color:#000;">
            <?php if($player != null){ ?>

                    <div class="card justify-content-center">
                        <h2 class="text-center"><?php echo $selecionar_dados->getNivel();?></h2> 
                    </div>
                    <div class="col-md-10 card">
                       <h2>Nome do Assistido</h2> 
                       <p style="font-size:50px"><strong><?php echo ucwords($selecionar_dados->getNome());?></strong></p>
                    </div>
                    <div class="col-md-2 card">
                        <h2>Guichê</h2> 
                        <p  style="font-size:50px"><strong><?php echo $selecionar_dados->getGuiche();?></strong></p>
                    </div>
            <?php 
            } else {

                include('home.php');
            }   
            ?> 

                </div>
            </div>

            <div class="container">
                    
                <div class="col-md-7" style="font-size:100%;">
                    <h1 class="panel panel-success text-center" style="color:green">Aguardando Atendimento</h1>
                    <table class="table" id="tablebase"> 
                        <thead>
                            <tr>
                                <th scope="col">ATENDIMENTO</th>
                                <th scope="col">NOME DO ASSISTIDO</th>
                                <th scope="col">DATA/HORA</th>
                            </tr>
                        </thead>
                        <tbody style="color:#000">
                            <?php $selecionar_dados->setListaViewRecepcao();?>
                        </tbody>
                    </table>
                </div>
             

                <div class="col-md-5" style="font-size:100%; border-left:1px #ccc solid;">
                    <h1 class="panel panel-success text-center" style="color:green">Em Atendimento</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ATENDIMENTO</th>
                                <th scope="col">NOME DO ASSISTIDO</th>
                                <th scope="col">GUICHÊ</th>
                            </tr>
                        </thead>
                        <tbody style="color:#000">
                            <?php $selecionar_dados->setListaViewRecepcaoAtendido();?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div class="text-center">
                <?php echo $player;?>
            </div>
                
        </div>
   

</div>



<?php } ?>

