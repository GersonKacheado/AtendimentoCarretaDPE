<?php
            // $data = implode("/",array_reverse(explode("-",$data)));  Ex; 2010-31-04 para 31/04/2010
            // $data = implode("-",array_reverse(explode("/",$data)));  Ex; 31/04/2010 para 2010-31-04



if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
    }
    else{
        /* Acesso ao SGBD do saude_ap */

        class Database
        {
            protected static $db;
             function __construct()
            {

               include_once('pdo_all.php');    

            }

            public static function conexao()
            {
                if (!self::$db) {
                    new Database();
                }
                return self::$db;
            }
            protected function execute($sql)
            {
             @$this->stmt = self::$db->prepare($sql);
             return $this->stmt->execute();
            }

        }

        /* configura��o de Data do Sistema */

        function data_portugues($data_noticia)
        {
            setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            @$var_DateTime = $data_noticia;
            return @utf8_encode(strftime("%A", time($var_DateTime)) . ' ' .
                strftime("%d de ", time($var_DateTime)) .
                strftime("%B", time($var_DateTime)) . ' ' .
                strftime("de %Y. ", time($var_DateTime)));
        }

        /**
         * isCpfValid
         *
         * Esta função testa se um cpf é valido ou nãoo.
         *
         * @param string $cpf Guarda o cpf como ele foi digitado pelo cliente
         * @param array $num Guarda apenas os números do cpf
         * @param boolean $isCpfValid Guarda o retorno da função
         * @param int $multiplica Auxilia no Calculo dos Dígitos verificadores
         * @param int $soma Auxilia no Calculo dos Dígitos verificadores
         * @param int $resto Auxilia no Calculo dos Dí­gitos verificadores
         * @param int $dg DÃ­gito verificador
         * @return  boolean                     "true" se o cpf é válido ou "false" caso o
         *                                               contrário....
         *
         * @author  Raoni Botelho Sporteman <raonibs@gmail.com>
         * @version 1.0 Debugada em 26/09/2011 no PHP 5.3.8
         */

        function isCpfValid($cpf)
        {

            //Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
            $j = 0;
            for ($i = 0; $i < (strlen($cpf)); $i++) {
                if (is_numeric($cpf[$i])) {
                    $num[$j] = $cpf[$i];
                    $j++;
                }
            }

            if(!is_numeric($cpf)) {   // Verificando se é uma entrada de Numeros 28/05/2019 * Santos P. Tarciso *
                $isCpfValid = false;
            } //Etapa 2: Conta os dígitos, um cpf válido possui 11 dígitos numéricos.
            else if (count($num) != 11) {
                $isCpfValid = false;
            } //Etapa 3: Combinações como 00000000000 e 22222222222 embora nãoo sejam cpfs reais resultariam em cpfs válidos após o calculo dos dí­gitos verificares e por isso precisam ser filtradas nesta parte.
            else {
                for ($i = 0; $i < 10; $i++) {
                    if ($num[0] == $i && $num[1] == $i && $num[2] == $i && $num[3] == $i && $num[4] == $i && $num[5] == $i && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                        $isCpfValid = false;
                        break;
                    }
                }
            }
            //Etapa 4: Calcula e compara o primeiro dÃ­gito verificador.
            if (!isset($isCpfValid)) {
                $j = 10;
                for ($i = 0; $i < 9; $i++) {
                    $multiplica[$i] = $num[$i] * $j;
                    $j--;
                }
                $soma = array_sum($multiplica);
                $resto = $soma % 11;
                if ($resto < 2) {
                    $dg = 0;
                } else {
                    $dg = 11 - $resto;
                }
                if ($dg != $num[9]) {
                    $isCpfValid = false;
                }
            }
            //Etapa 5: Calcula e compara o segundo dígito verificador.
            if (!isset($isCpfValid)) {
                $j = 11;
                for ($i = 0; $i < 10; $i++) {
                    $multiplica[$i] = $num[$i] * $j;
                    $j--;
                }
                $soma = array_sum($multiplica);
                $resto = $soma % 11;
                if ($resto < 2) {
                    $dg = 0;
                } else {
                    $dg = 11 - $resto;
                }
                if ($dg != $num[10]) {
                    $isCpfValid = false;
                } else {
                    $isCpfValid = true;
                }
            }
            //Etapa 6: Retorna o Resultado em um valor booleano.
            return $isCpfValid;
        }



        function Menu($habilita)
        {
            $pdo = Database::conexao();
            $menu = $pdo->prepare("SELECT * FROM menu WHERE habilita = :HABILITA ORDER BY ordem");
            $menu->bindParam(":HABILITA", $habilita, PDO::PARAM_STR);
            $menu->execute();
            $r_menu = $menu->fetchAll(PDO::FETCH_OBJ);

            return $r_menu;
        }
/*
        function LoginCPF($login, $senha, $habilitado)
        {
            $pdo = Database::conexao();
            $i = $pdo->prepare("SELECT * FROM tbl_user u, tbl_funcao f 
                                WHERE u.login_user = :LOGIN 
                                AND u.senha = :SENHA
                                AND f.id_funcao = u.fk_funcao
                                AND u.habilitado = :HABILITA");
            $i->bindParam(":LOGIN", $login, PDO::PARAM_INT);
            $i->bindParam(":SENHA", $senha, PDO::PARAM_STR);
            $i->bindParam(":HABILITA", $habilitado, PDO::PARAM_STR);
            $i->execute();
            $achou = $i->rowCount();
            $r_i = $i->fetchAll(PDO::FETCH_OBJ);
            $retorno = [$achou, $r_i];
            return $retorno;
        }
*/        
}

    function SemImgDados(){
        echo "<img src='public/login/img/login/visitante.png' class='user-image' alt='User Image'>";
    }

/* semdados no banco */

    function SemDados(){
        echo "<img  src='img/conteudo/logo_sem_noticia.png' alt='Sem Dados..'>";
    }

/* Totais Parciais */


function TotalViewAssistidos(){

   @$id_evento      = $_SESSION["EventoId_evento"];
    $pdo            = Database::conexao();
    $sql            = $pdo->prepare("SELECT count(*) as total_chamados, dsc_evento, chamdo_para_atendimento, entrevistado, desistencia 
                                        FROM `tbl_fila` , tbl_evento 
                                                WHERE tbl_fila.fk_evento = '".$id_evento."' and tbl_evento.id_evento = tbl_fila.fk_evento 
                                                        GROUP by chamdo_para_atendimento, entrevistado, desistencia; ");
    $sql->execute();
    $r_sql          = $sql->fetchAll(PDO::FETCH_OBJ);
    return $r_sql;

}



function AguardandoNaFila()
{
   @$id_evento      = $_SESSION["EventoId_evento"];
    $pdo            = Database::conexao();
    $sql            = $pdo->prepare("SELECT count(*) as aguardando FROM `tbl_fila` 
    WHERE fk_evento = '".$id_evento."' AND chamdo_para_atendimento = 0 AND entrevistado = 0 AND desistencia = 0 AND fk_atendente = 52");
    $sql->execute();
    $r_sql          = $sql->fetchAll(PDO::FETCH_OBJ);
    return $r_sql;
}
function ChamaParaCarreta()
{
   @$id_evento      = $_SESSION["EventoId_evento"];
    $pdo            = Database::conexao();
    $sql            = $pdo->prepare("SELECT count(*) as chama FROM `tbl_fila` 
    WHERE fk_evento = '".$id_evento."' AND chamdo_para_atendimento = 1 AND entrevistado = 0 AND desistencia = 0 AND fk_atendente <> 52");
    $sql->execute();
    $r_sql          = $sql->fetchAll(PDO::FETCH_OBJ);
    return $r_sql;
}

function DesisteSemAtender()
{
   @$id_evento      = $_SESSION["EventoId_evento"];
    $pdo            = Database::conexao();
    $sql            = $pdo->prepare("SELECT count(*) as desistesematender FROM `tbl_fila` 
    WHERE fk_evento = '".$id_evento."' AND chamdo_para_atendimento = 0 AND entrevistado = 0 AND desistencia = 1 AND fk_atendente = 52");
    $sql->execute();
    $r_sql          = $sql->fetchAll(PDO::FETCH_OBJ);
    return $r_sql;
}
function AtenderSemEntrevista()
{
   @$id_evento      = $_SESSION["EventoId_evento"];
    $pdo            = Database::conexao();
    $sql            = $pdo->prepare("SELECT count(*) as atendesementrevista FROM `tbl_fila` 
    WHERE fk_evento = '".$id_evento."' AND chamdo_para_atendimento = 1 AND entrevistado = 0 AND desistencia = 1 AND fk_atendente <> 52");
    $sql->execute();
    $r_sql          = $sql->fetchAll(PDO::FETCH_OBJ);
    return $r_sql;
}
function EntrevistadoAposAtendimento()
{
   @$id_evento      = $_SESSION["EventoId_evento"];
    $pdo            = Database::conexao();
    $sql            = $pdo->prepare("SELECT count(*) as entrevistadoaposatendimento FROM `tbl_fila` 
    WHERE fk_evento = '".$id_evento."' AND chamdo_para_atendimento = 1 AND entrevistado = 1 AND desistencia = 0 AND fk_atendente <> 52");
    $sql->execute();
    $r_sql          = $sql->fetchAll(PDO::FETCH_OBJ);
    return $r_sql;
}

 

// 1 -> SELECT count(*) FROM `tbl_fila` WHERE fk_evento = 5 AND chamdo_para_atendimento = 0 and entrevistado = 0 and desistencia = 0 and fk_atendente = 52; 
// 2 -> SELECT count(*) FROM `tbl_fila` WHERE fk_evento = 5 AND chamdo_para_atendimento = 1 and entrevistado = 0 and desistencia = 0 and fk_atendente <> 52; 
// 3 -> SELECT count(*) FROM `tbl_fila` WHERE fk_evento = 5 AND chamdo_para_atendimento = 0 and entrevistado = 0 and desistencia = 1 and fk_atendente = 52;
// 4 -> SELECT count(*) FROM `tbl_fila` WHERE fk_evento = 5 AND chamdo_para_atendimento = 1 and entrevistado = 0 and desistencia = 1 and fk_atendente <> 52;
// 5 -> SELECT count(*) FROM `tbl_fila` WHERE fk_evento = 5 AND chamdo_para_atendimento = 1 and entrevistado = 1 and desistencia = 0 and fk_atendente <> 52;





// SELECT A.idfila, A.nome, A.fk_evento, A.chamdo_para_atendimento,B.fk_idfila, A.observacao, B.nome_entrevistador FROM tbl_fila as A LEFT JOIN tbl_entrevistas as B on A.idfila = B.fk_idfila WHERE A.fk_evento = 5 ORDER BY `A`.`fk_evento` ASC  
// 

//SELECT count(*) FROM `tbl_fila` WHERE fk_evento = 5 and chamdo_para_atendimento = 0 and entrevistado = 0 and observacao = 'Desistência' (nao esperaram atendimento) 
//SELECT count(*) FROM `tbl_fila` WHERE fk_evento = 5 and chamdo_para_atendimento = 1 and entrevistado = 1 and observacao <> 'Desistência'  (finalizados atendimento)
//SELECT * FROM `VIEW_RELATORIO_CARRETA` v , tbl_entrevistas e 
// SELECT * FROM `VIEW_RELATORIO_CARRETA` v , tbl_entrevistas e where v.fk_evento = 5 AND e.fk_idfila = v.idfila; 

// idfila 	cpf 	nome 	nome_sexo 	dsc_fisica 	endereco 	telefone 	observacao 	nome_nivel 	dsc_nucleo 	dsc_acao 	nome_user 	idade 	escolaridade 	renda_domiciliar 	ocupacao 	estado_civil 	possui_filhos_qtd 	tipo_residencia 	condicao_imovel 	local_residencia 	rede_esgoto 	fossa_septica 	agua_tratada 	rede_internet 	conhecimento_acao 	avaliacao_defensor 	avaliacao_tempo 	importancia_carreta 	area_buscou_nao_houve_atendimento 	melhorar_atendimento 	providencia_tomada 	acao_prolongada 	nome_entrevistador 	data_entrevista 


// entrevista com as demais tabelas - relatorio ------------------------------------------------------------------------------------------------------------------------------------------------

/*

SELECT 
idfila, cpf, nome, nome_sexo, dsc_fisica, endereco, telefone, observacao, nome_nivel, dsc_nucleo, dsc_acao, 	nome_user, 	idade, 	escolaridade, 	
renda_domiciliar, 	ocupacao, 	estado_civil, 	possui_filhos_qtd, 	tipo_residencia, 	condicao_imovel, 	local_residencia, 	rede_esgoto, 	fossa_septica, 	
agua_tratada, 	rede_internet, 	conhecimento_acao, 	avaliacao_defensor, 	avaliacao_tempo, 	importancia_carreta, 	area_buscou_nao_houve_atendimento, 	
melhorar_atendimento, 	providencia_tomada, 	acao_prolongada, 	nome_entrevistador, 	data_entrevista 

 FROM tbl_fila as A 
 LEFT JOIN tbl_entrevistas as B on A.idfila = B.fk_idfila
 left JOIN tbl_sexo_atendimento as S on A.fk_sexo_atendimento = S.id_sexo_atendimento
 left JOIN tbl_nivel_atendimento as N on A.fk_nivel_atenimeneto = N.idl_nivel_atendimento
 left JOIN tbl_nucleo as NU on A.fk_obsnucleos = NU.idnucleo
 left JOIN tbl_acao as AC on A.fk_obsacoes = AC.id_acao
 left JOIN tbl_user as U on A.fk_atendente = U.iduser
 
 
 WHERE A.fk_evento = 5 ORDER BY `A`.`fk_evento` ASC;

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/ 



?>


