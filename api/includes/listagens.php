<?php
use \App\CLASSES\URL;
?>

        <?php
            $trocarpagina = new URL;
            $trocarpagina -> getLink($retVal = (isset($_GET['url'])) ? $_GET['url']:'');
        ?>
