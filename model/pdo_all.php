<?php
     $db_host = "localhost";        
     $db_nome = "atendimento_carreta2023_dpeap";
     $db_usuario = "root";
    $db_senha = 'Root@1234'; //online  
 //  $db_senha = "@g5p10y@"; //local

 //   $db_senha = "#..(PL4N3T4)t3rr4..?;@"; //local
    
    $db_driver = "mysql";
    try{
        self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db->exec('SET NAMES utf8');
    }catch (PDOException $e){
        mail(@$sistema_email, "PDOException em $sistema_titulo", $e->getMessage());
        die("Connection Error: " . $e->getMessage());
    }     
?>



