<?php
$msg = 'DIGITE SUAS CREDENCIAIS PARA CONECTAR-SE';
	if (isset($_SESSION))   	
	   session_destroy();
	if(isset($_GET)) {
       unset($_GET);
       echo "<script>location.href='../../../public/login/index.php?&msg=".base64_encode($msg)."'</script>";
    }
    exit;
?>

