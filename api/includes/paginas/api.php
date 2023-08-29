<?php 
use \App\CLASSES\SQL;
$crud = new SQL;



$fn = $_REQUEST['fn'] ?? 0;
$tabela = $_REQUEST['tabela'] ?? 0; // colocar as tabelas 
$colunas  = $_REQUEST['colunas'] ?? 0; // colocar as colunas da tabela
$valores = $_REQUEST['valores'] ?? 0; // colocar os values dos user
$comando = $_REQUEST['comando'] ?? ''; // os condicionais where
$idcolunas = $_REQUEST['idcolunas'] ?? 0; // nome e id da tabela
$idvalor = $_REQUEST['idvalor'] ?? 0; // nome do valor do campo da tabela 


switch ($fn) {
    case 'create':
        @$data['dados']=$crud->criarDados($tabela,$colunas,$valores);
        break;
    case 'read':
        @$data['dados']=$crud->BuscarDados($tabela,$colunas, $comando);
        break;
    case 'update':
        @$data['dados']=$crud->AtualizarDados($tabela,$valores,$idcolunas,$idvalor);
        break;
    case 'delete':
        @$data['dados']=$crud->ApagarDados($tabela,$idcolunas,$idvalor);
        break;
    default:
        @$data['dados']= "ERRO:404-Dados não encontrados entre em contado com o DTI-DPE-AP";
        break;
}

$json = json_encode($data['dados']) ;
header("Content-type: application/json; charset=utf-8");
echo $json;
?>



 