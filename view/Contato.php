<?php
if (isset($_GET["txtnome"])) {
    $nome = $_GET["txtnome"];
    include_once("../model/conn.php");
    $pdo        = Database::conexao();

    if (empty($nome)) {
        $pdo->prepare("SELECT * FROM tbl_user");
    } else {
        $pdo->prepare("SELECT * FROM tbl_user WHERE nome_user like '%".$nome."%'");
    }
    sleep(1);
    $pdo = Database::conexao();
    $cont = $pdo->rowCount(); 
    if ($cont > 0) {

        $tabela = "<table border='1'>
                    <thead>
                        <tr><th>NOME</th><th>CPF</th> </tr>
                    </thead>
                    <tbody>
                    <tr>";
        $return = "$tabela";
        
         while ($resultado = $pdo->fetchAll(PDO::FETCH_OBJ)) {
            $return.= "<td>" . $resultado->nome_user . "</td>";
            $return.= "<td>" . $resultado->cpf_user . "</td>";
            $return.= "</tr>";
        }
        echo $return.="</tbody></table>";
    } else {
        echo "Não foram encontrados registros!";
    }
}
?>