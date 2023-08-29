<?php
   if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
}else{ ?>

  <div class="panel panel-primary" id='profissionais'>
        <div class="panel-heading"><h3 class="panel-title">
                <?php echo strtoupper($op) ; ?></h3></div>
        <div class="panel-body">

            <h3>Página Modelo !</h3>

        </div>
    </div>
<?php } ?>

