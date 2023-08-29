<?php
include_once("conn.php");
define("ID_USER", @$_SESSION["UsuarioId"]);
define("GUICHE_USER", @$_SESSION["ID_GUICHE_USER"]);


class SELECIONARDADOS extends Database
{
    public $nome_assistido, $guiche, $nivel, $falarDados;

    function getNome(){
        return $this->nome_assistido;
    }
    function getGuiche(){
        return $this->guiche;
    }
    function getNivel(){
        return $this->nivel;
    }
/*
    function getFalarNomeGuiche(){
        return $this->falarDados;
    }
    function __construct($guiche){

        $sql = "SELECT * FROM `tbl_guiche` WHERE `ippc` = '".$guiche."' ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            define("ID_GUICHE_USER", $resultado->idguiche);    
        }
    }
*/
/*
*
*
nome que esta sendo falado...
*
*
*/


    function setListaAtendimentoChamado(){
        $sql = "SELECT * FROM `VIEW_DADOS_ATENDIMENTO` where finalizar_falar <> 1 ORDER BY `idatendimento` DESC LIMIT 0,1";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            if ($resultado->nome_nivel=='normal') {
                $this->nivel = "NORMAL";
            }else{
                $this->nivel = "<button type='button' style='background-color:#98cf4b; color:green'>PRIORIDADE</button></td>";
            }
            $this->nome_assistido = $resultado->nome_assistido;
            $this->guiche = $resultado->guiche_numero;
            $this->falarDados = "Nome: .".strtolower($resultado->nome_assistido).".  Guichê: .".$resultado->guiche_numero;
        }
    }

    function setTipoDeficiencia(){
        $sql = "SELECT * FROM `tbl_tipo_deficiencia` where status_deficiencia = 1";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
           echo "<option value='".$resultado->dsc_deficiencia."'>".$resultado->dsc_deficiencia."</option>";    
        }
        
    }
    
    function setNivelAtendimento(){
        $sql = "SELECT * FROM `tbl_nivel_atendimento` where status_nivel = 1  ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "<option value='".$resultado->idl_nivel_atendimento."'>".$resultado->nome_nivel."</option>";    
        }
    }

    function setSexoAtendimento(){
        $sql = "SELECT * FROM `tbl_sexo_atendimento` where status_sexo = 1  ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "<option value='".$resultado->id_sexo_atendimento."'>".$resultado->nome_sexo."</option>";    
        }
    }

    function setListaAddAssistidoEditar(){
        $sql = "SELECT * FROM `VIEW_DADOS_FILA` ORDER BY `VIEW_DADOS_FILA`.`idfila` ASC ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$esperando++;
            if ($resultado->nome_nivel=='normal') {
                $nivel = "NORMAL";
                $cor='';
                $font = "";
            }else{$nivel = "<button type='button' class='btn btn-success'>PRIORIDADE</button></td>";$cor="#5F9EA0"; $font = "#000";}

            echo "
                 <tr style='color:".$font."; background-color:".$cor.";'>   
                    <th>".$esperando."</th> 
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->nome."</td> 
                    <td>
                        <select class='form-control' name='obsnucleos' id='obsnucleos'>";

             echo "     </select>
                    </td> 
                    <td>
                        <select class='form-control' name='obsacoes' id='obsacoes'>";

             echo "     </select>
                    </td> 
                    <td>
                        <select class='form-control' name='atendente' id='atendente'>";
   
             echo "     </select>
                    </td>
                    <td>
                        <a href='model/controller/editar_dados.php?
                            idfila=".$resultado->idfila.
                            "&obsnucleos=".$resultado->idnucleo.
                            "&obsacoes=".$resultado->id_acao.
                            "&atendente=".$resultado->id_atendentes.
                            "&cpf=".$resultado->cpf."'>

                            <button type='button' class='btn btn-success'>Editar</button>
                        </a>


                    </td>
                 </tr>
            ";    
        }
    }

    function setNucleoAtendimento(){
        $sql = "SELECT * FROM `tbl_nucleo` where status_nucleo = 1 ORDER by dsc_nucleo";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->idnucleo."'";
                if(isset($_GET['nucleo'])){
                    if($resultado->dsc_nucleo == $_GET['nucleo']) { echo(" SELECTED ");}
                }else {echo "<option value='".$resultado->idnucleo."'>".$resultado->dsc_nucleo."</option>";}
            echo ">".$resultado->dsc_nucleo."
            </option>";
        }
    }

    function setAcaoAtendimento(){
        $sql = "SELECT * FROM `tbl_acao` where status_acao = 1 ORDER by dsc_acao ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->id_acao."'";
                if(isset($_GET['dsc_acao'])){
                    if($resultado->dsc_acao == $_GET['dsc_acao']) { echo(" SELECTED ");}
                }else {echo "<option value='".$resultado->id_acao."'>".$resultado->dsc_acao."</option>";}
            echo ">".$resultado->dsc_acao."
            </option>";        
        }
    }

    function setAtendenteAtendimento(){
        @$id_evento = $_SESSION["EventoId_evento"];
        $sql = "SELECT * FROM `tbl_user` u, tbl_historico h where u.habilitado = 'S' and (u.fk_tipo_user = 3 or u.fk_tipo_user = 9) and h.fk_iduser = u.iduser and h.fk_idevento = '".$id_evento."'  ORDER BY `u`.`nome_user` ASC";

        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->iduser."'";
                if(isset($_GET['fk_atendente'])){
                    if($resultado->iduser == $_GET['fk_atendente']) { echo(" SELECTED ");}
                }else {echo "<option value='".$resultado->iduser."'>".strtoupper($resultado->nome_user)."</option>";}
            echo ">".$resultado->nome_user."
            </option>";   
            
        }
    }


    function setAtendenteAtendimentoRelatorio(){
         @$id_evento = $_GET['idevento'];
         $sql = "SELECT * FROM `tbl_user` u, tbl_historico h where u.habilitado = 'S' and (u.fk_tipo_user = 3 or u.fk_tipo_user = 9) and h.fk_iduser = u.iduser and h.fk_idevento = '".$id_evento."'  ORDER BY `u`.`nome_user` ASC";
 
         self::execute($sql);
         while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
             echo "
             <option value='".$resultado->iduser."'";
                 if(isset($_GET['fk_atendente'])){
                     if($resultado->iduser == $_GET['fk_atendente']) { echo(" SELECTED ");}
                 }else {echo "<option value='".$resultado->iduser."'>".strtoupper($resultado->nome_user)."</option>";}
             echo ">".$resultado->nome_user."
             </option>";   
             
         }
     }
 

// INICIO evento que deseja trabalhar 
    
    function setAtendenteAtendimentoEvento(){
        $sql = "SELECT * FROM `tbl_evento` where satus_evento = 1 order by dsc_evento";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->id_evento."'";
                if(isset($_POST['eventotrabalha'])){
                    if($resultado->dsc_evento == $_POST['eventotrabalha']) { echo(" SELECTED ");}
                }else {echo "<option value='".$resultado->id_evento."'>".strtolower($resultado->dsc_evento)."</option>";}
            echo ">".$resultado->dsc_evento."
            </option>";   
            
        }
    }
// FIM evento que deseja trabalhar

    function setAtendenteObsEdit(){ 
        if(isset($_GET['idfila'])&& isset($_GET['idfila'])&& $_GET['resp']=='Tarcisoedit'){ 
            $sql = "SELECT * FROM `tbl_fila` WHERE idfila =".$_GET['idfila']." LIMIT 1";        
        }else{
            $sql = "SELECT * FROM `tbl_fila` LIMIT 1";        
        }
        self::execute($sql);
        $resultado = $this->stmt->fetch(PDO::FETCH_OBJ);
        echo "<textarea class='form-control' name='observacao' id='observacao'>".@$resultado->observacao."</textarea>";
    }
        

    function setAtendenteTipoSolucaoEdit(){ 
        $sql = "SELECT * FROM `tbl_tipo_documento` where status_documento = 1 ORDER by dsc_documento ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->id_tipo_documento."'";
                if(isset($_GET['dsc_documento'])){
                    if($resultado->dsc_documento == $_GET['dsc_documento']) { echo(" SELECTED ");}
                }else {echo "<option value='".$resultado->id_tipo_documento."'>".$resultado->dsc_documento."</option>";}
            echo ">".$resultado->dsc_documento."
            </option>";        
        }
    }
          

    function setAtendenteSolucaoEdit(){ 
        if(isset($_GET['idfila'])&& isset($_GET['idfila'])&& $_GET['resp']=='Tarcisoedit'){ 
            $sql = "SELECT * FROM `tbl_fila` WHERE idfila =".$_GET['idfila']." LIMIT 1";        
        }else{
            $sql = "SELECT * FROM `tbl_fila` LIMIT 1";        
        }
        self::execute($sql);
        $resultado = $this->stmt->fetch(PDO::FETCH_OBJ);
        echo "<textarea class='form-control' name='solucao' id='solucao'>".@$resultado->solucao."</textarea>";
    }
            

    function setListaAddAssistido(){
        $sql = "SELECT * FROM `VIEW_DADOS_FILA` ORDER BY `VIEW_DADOS_FILA`.`nome`, `VIEW_DADOS_FILA`.`idfila` ASC ";
        
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$esperando++;
            if ($resultado->nome_nivel=='normal') {
                $nivel = "NORMAL";
                $cor='';
                $font = "";
            }else{$nivel = "<button type='button' class='btn btn-success'>PRIORIDADE</button></td>";$cor="#5F9EA0"; $font = "#000";}
            echo "
                 <tr style='color:".$font."; background-color:".$cor.";'>   
                    <th>".$esperando."</th> 
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->nome."</td> 
                    <td>".$resultado->inicio."</td> 
                    <td>".$resultado->obsnucleos."</td> 
                    <td>".$resultado->obsacoes."</td> 
                    <td><a href='model/controller/inserir_dados.php?btnDadosInsert=true&insertDadosLinks=novoAtendemento&user=".ID_USER."&guiche=".ID_GUICHE_USER."&fila=".$resultado->idfila."'><button type='button' class='btn btn-success'>Chamar</button></a>
                    </td>
                 </tr>
            ";    
        }
    }

// lISTA OS ASSITIDOS CADASTRADOS NO EVENTO - AGUARDANDO ATENDIMENTO

    function setListaViewAssistido(){
        $horahoje =  date("H:i:s");    

        @$contador = 0;
        @$id_evento = $_SESSION["EventoId_evento"];
        if($_SESSION["UsuarioFuncao"]=="Admin"){
            @$ordernar = 'nome';
        }else{
            @$ordernar = 'idfila';
        }
        $sql = "SELECT * FROM `VIEW_DADOS_FILA` WHERE fk_evento = '".$id_evento."' AND satus_evento = 1 AND desistencia <> 1 ORDER BY '".$ordernar."'";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) { 
            @$contador ++;
            if($resultado->desistencia==1){
                $ok_value = 1;
                $rotulo = 'Sim';
            }else{
                $v_checked='';
                $ok_value = 0;
                $rotulo = 'Não';
            };  

            if(!is_null(@$resultado->tempoinicio) && !is_null(@$resultado->tempofim)){

                @$rotuloTempo=$resultado->tempo_de_atendimento;
                $cortempo = '';
            }        
            elseif(is_null(@$resultado->tempoinicio)){
                $rotuloTempo='Iniciar';
                $cortempo = '';
            }else{
                $rotuloTempo='Finalizar';
                $cortempo = 'green';
            }

            @$linhas++;
     
            if ($resultado->nome_nivel=='normal') {
                $nivel = "NORMAL";
                $cor='';
                $font = "";
            }else{
                $nivel = "<button type='button' class='btn btn-success'>PRIORIDADE</button></td>";$cor="#5F9EA0"; $font = "#000";
            }

        echo"   <tr style='color:".$font."; color:".$cor."; color:".$cortempo."'>   

                <th>".$contador."</th> 
                <td>";
                if($_SESSION["UsuarioFuncao"]=="Admin"){
                    echo "<a href='model/controller/procedimentos.php?idfila=".$resultado->idfila."&rotulotempo=".$rotuloTempo."&TARCISO=MarcaTempo' id='rotuloTempo'> ".$rotuloTempo."</a>";
                 }else {
                    echo $rotuloTempo;
                 }
                                 
        echo"   </td><td>";

                
                if($_SESSION["UsuarioFuncao"]=="Admin" && !is_null(@$resultado->tempoinicio) && !is_null(@$resultado->tempofim)){
                    echo "<a href='?op=recepcao&idfila=".$resultado->idfila."&resp=Tarcisoedit&nome=".$resultado->nome."&fk_atendente=".$resultado->iduser."&fk_tipo_documento=".$resultado->fk_tipo_documento."&nucleo=".$resultado->dsc_nucleo."&dsc_acao=".$resultado->dsc_acao."&dsc_atendentes=".$resultado->nome_user."'>".$resultado->nome."</a>";
                }else{
                    echo $resultado->nome;
                }


        echo"   </td>
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->nome_nivel."</td> 
                    <td>".$resultado->dsc_fisica."</td> 
                    <td>".$resultado->inicio."</td> 
                    <td>".$resultado->telefone."</td> 
                    <td>".$resultado->endereco."</td> 
                    <td>".$resultado->dsc_nucleo."</td> 
                    <td>".$resultado->dsc_acao."</td> 
                    <td>".$resultado->nome_user."</td> 
                    <td>".$resultado->observacao."</td> 
                    <td class='text-center'>";
                    if($_SESSION["UsuarioFuncao"]=="Admin"){        
                      echo "<a class= 'btn btn-link fa fa-ban' href='model/controller/procedimentos.php?idfila=".$resultado->idfila."&valor=".$rotulo."&TARCISO=MarcaDesistencia' id='rotulo'>".$rotulo."</a>";
                    }else {
                        echo $rotulo;
                    }   
                 echo "     </td>
    
                        </td>                
                    </tr>
                    ";  
        }
    }   


// BUSCA ASSITIDO CADASTRADO NO EVENTO

function setListaViewBuscar($busca){
    @$contador = 0;
    @$busca_nome = '%'.$busca.'%';
    @$id_evento = $_SESSION["EventoId_evento"];
    $sql = "SELECT * FROM `VIEW_DADOS_BUSCA` WHERE  fk_evento = '".$id_evento."' AND satus_evento = 1 AND nome LIKE '".$busca_nome."' ORDER BY nome";
    self::execute($sql);
    while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) { 
        @$contador ++;
        
        if($resultado->desistencia==1){
            $ok_value = 1;
            $rotulo = 'Sim';
        }else{
            $v_checked='';
            $ok_value = 0;
            $rotulo = 'Não';
        };  

        if(!is_null(@$resultado->tempoinicio) && !is_null(@$resultado->tempofim)){

            @$rotuloTempo=$resultado->tempo_de_atendimento;
            $cortempo = '';
        }elseif(is_null(@$resultado->tempoinicio)){
            $rotuloTempo='Iniciar';
            $cortempo = '';
        }else{
            $rotuloTempo='Finalizar';
            $cortempo = 'green';
        }

       
        if ($resultado->nome_nivel=='normal') {
            $nivel = "NORMAL";
            $cor='';
            $font = "";
        }else{$nivel = "<button type='button' class='btn btn-success'>PRIORIDADE</button></td>";$cor="#5F9EA0"; $font = "#000";}

            echo"<tr style='color:".$font."; color:".$cor."; color:".$cortempo."'>   
                    <th>".$contador."</th> 
                    <td>";
                    if($_SESSION["UsuarioFuncao"]=="Admin"){
                       echo "<a href='model/controller/procedimentos.php?idfila=".$resultado->idfila."&rotulotempo=".$rotuloTempo."&TARCISO=MarcaTempo' id='rotuloTempo'> ".$rotuloTempo."</a>";
                    }else {
                        echo $rotuloTempo;
                     }    
            echo"   </td>     
                    <td>";
                        if($_SESSION["UsuarioFuncao"]=="Admin" && !is_null(@$resultado->tempoinicio) && !is_null(@$resultado->tempofim)){
                            echo "<a href='?op=recepcao&idfila=".$resultado->idfila."&resp=Tarcisoedit&nome=".$resultado->nome."&fk_atendente=".$resultado->iduser."&fk_tipo_documento=".$resultado->fk_tipo_documento."&nucleo=".$resultado->dsc_nucleo."&dsc_acao=".$resultado->dsc_acao."&dsc_atendentes=".$resultado->nome_user."'>".$resultado->nome."</a>";
                        }else{
                            echo $resultado->nome;
                        }
            echo"   </td>
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->nome_nivel."</td> 
                    <td>".$resultado->dsc_fisica."</td> 
                    <td>".$resultado->inicio."</td> 
                    <td>".$resultado->telefone."</td> 
                    <td>".$resultado->endereco."</td> 
                    <td>".$resultado->dsc_nucleo."</td> 
                    <td>".$resultado->dsc_acao."</td> 
                    <td>".$resultado->nome_user."</td> 
                    <td>".$resultado->observacao."</td>
                <td class='text-center'>";
                if($_SESSION["UsuarioFuncao"]=="Admin"){        
                  echo "<a class= 'btn btn-link fa fa-ban' href='model/controller/procedimentos.php?idfila=".$resultado->idfila."&valor=".$rotulo."&TARCISO=MarcaDesistencia' id='rotulo'>".$rotulo."</a>";
                }else {
                    echo $rotulo;
                }   
             echo "     </td>

                    </td>                
                </tr>
                ";  
    }    

}    

    function setListaViewRecepcao(){
        $sql = "SELECT * FROM `VIEW_DADOS_FILA`";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            if ($resultado->nome_nivel=='normal') {
                $nivel = "NORMAL";
                $cor='';
                $font = "";
            }else{$nivel = "<button type='button' class='btn btn-success'>PRIORIDADE</button></td>";$cor="#5F9EA0"; $font = "#000";}
            echo "
                 <tr style='color:".$font."; background-color:".$cor.";'>   
                    <td>".$nivel."</td> 
                    <td class='h3'>".strtoupper($resultado->nome)."</td> 
                    <td>".$resultado->inicio."</td> 
                    
                </tr>
             ";    
        }
    }

    function setListaViewRecepcaoAtendido(){
        $sql = "SELECT * FROM `VIEW_DADOS_ATENDIMENTO` 
                ORDER by `idatendimento` DESC  LIMIT 0, 4";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            if ($resultado->nome_nivel=='normal') {
                $nivel = "NORMAL";
                $cor='';
                $font = "";
            }else{$nivel = "<button type='button' class='btn btn-success'>PRIORIDADE</button></td>";$cor="#5F9EA0"; $font = "#000";}
            echo "
                 <tr style='color:".$font."; background-color:".$cor.";'>   
                    <td>".$nivel."</td> 
                    <td>".strtoupper($resultado->nome_assistido)."</td> 
                    <td>".$resultado->guiche_numero."</td> 
                    
                </tr>
            ";    
        }
    }     


/* 
* 
*
        Programando os botoes ATENDER e FINALIZAR 
*
*
*/

    function setListaAtendimento(){
        $sql = "SELECT * FROM `VIEW_DADOS_ATENDIMENTO` where finalizar_atendimento <> 1";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$atendimento++;
            echo "
                 <tr>   
                    <th>".$atendimento."</th> 
                    <td>".$resultado->cpf_assistido."</td> 
                    <td>".$resultado->nome_assistido."</td>
                    <td>".$resultado->nome_nivel."</td> 
                    <td>".$resultado->inicio."</td>
                    <td>".$resultado->fim."</td>
                    <td>".$resultado->guiche_numero."</td>
                    <td>".$resultado->obsnucleos."</td>
                    <td>".$resultado->obsacoes."</td>

                  <td id='btn_Finalizar'>
                        <a href='model/controller/procedimentos.php?
                        finalizar=".base64_encode('finalizarAtendimento').
                        "&idfila=".base64_encode($resultado->idfila_assistido).
                        "&'>
                            <button type='button' class='btn btn-danger'>Finalizar</button>
                        </a>
                    </td>

                ";
        }
    }
    

// Relatório - Especifico
function setListaAtendimentoFinalizadosPorAssistido(&$contador, &$valores, $id){
    @$id = '%'.$id.'%';
    $sql = "SELECT * FROM `VIEW_RELATORIO_CARRETA_FULL` v, tbl_evento e WHERE (v.cpf like  '".$id."' or v.nome like  '".$id."') AND e.id_evento = v.fk_evento ORDER BY v.nome";
    self::execute($sql);

    if($rows = $this->stmt->rowCount()==0){
        $sql = "SELECT * FROM `VIEW_RELATORIO_CARRETA` v, tbl_evento e WHERE (v.cpf like  '".$id."' or v.nome like  '".$id."') AND e.id_evento = v.fk_evento ORDER BY v.nome";
        self::execute($sql);
    }    
    
    while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
        $desistencia    = ($resultado->desistencia==1)?'Sim':'Não';
        $entrevistado   = ($resultado->entrevistado==1)?'Sim':'Não';
        @$contador ++;
        @$valores = @$contador; 
        
        if($resultado->iduser == 1 || $resultado->desistencia == 1){
            @$cor ="#c00";
        }else{
            @$cor ="#000";
        }
        echo" 
            <tr><th colspan='8' style='color:green'>".$resultado->dsc_evento."</th></tr>
            <tr style='color:".@$cor."; '>   
                <th>".$contador."</th> 
                <td style='color:red'>".$resultado->cpf."</td> 
                <td>";

                        if($_SESSION["UsuarioFuncao"]=="Admin" && !is_null(@$resultado->tempoinicio) && !is_null(@$resultado->tempofim)){
                            echo "<a href='?op=recepcao&idfila=".$resultado->idfila."&resp=Tarcisoedit&nome=".$resultado->nome."&fk_atendente=".$resultado->iduser."&fk_tipo_documento=".@$resultado->fk_tipo_documento."&nucleo=".$resultado->dsc_nucleo."&dsc_acao=".$resultado->dsc_acao."&dsc_atendentes=".$resultado->nome_user."'>".$resultado->nome."</a>";
                        }else{
                            echo $resultado->nome;
                        }


        echo   "</td> 
                <td>".$resultado->telefone."</td> 
                <td>".$resultado->endereco."</td>
                <td>".$resultado->inicio."</td>
                <td>".$resultado->fim."</td>
                <td>".$resultado->dsc_nucleo."</td> 
                <td>".$resultado->nome_user."</td>
                <td>".$resultado->nome_nivel."</td> 
                <td>".$resultado->nome_sexo."</td>
                <td>".$resultado->dsc_acao."</td> 
                <td>".$resultado->observacaos."</td>
                <td class='text-center'>".$desistencia."</td>
                <td class='text-center'>".$entrevistado."</td>
                <td class='text-center'>".$resultado->tempo_de_espera."</td>
                <td class='text-center'>".$resultado->tempoinicio."</td>
                <td class='text-center'>".$resultado->tempofim."</td>
                <td class='text-center'>".$resultado->tempo_de_atendimento."</td>
            </tr>
         ";  
    }
}   

// Relatório - Geral
    function setListaAtendimentoFinalizadosGeral(&$contador, &$valores, $id){
        @$id_evento = $id;
        $sql = "SELECT * FROM `VIEW_RELATORIO_CARRETA_FULL` WHERE fk_evento =  '".$id_evento."' ORDER BY nome";

        self::execute($sql);

        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT * FROM `VIEW_RELATORIO_CARRETA` WHERE fk_evento =  '".$id_evento."' ORDER BY nome";
            self::execute($sql);
        }
 
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $desistencia    = ($resultado->desistencia==1)?'Sim':'Não';
            $entrevistado   = ($resultado->entrevistado==1)?'Sim':'Não';
            @$contador ++;
            @$valores = @$contador; 
            
            if($resultado->iduser == 1 || $resultado->desistencia == 1){
                @$cor ="#c00";
            }else{
                @$cor ="#000";
            }
            echo" 
                <tr style='color:".@$cor."; '>   
                    <th>".$contador."</th> 
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->nome."</td> 
                    <td>".$resultado->telefone."</td> 
                    <td>".$resultado->endereco."</td>
                    <td>".$resultado->inicio."</td>
                    <td>".$resultado->fim."</td>
                    <td>".$resultado->dsc_nucleo."</td> 
                    <td>".$resultado->nome_user."</td>
                    <td>".$resultado->nome_nivel."</td> 
                    <td>".$resultado->nome_sexo."</td>
                    <td>".$resultado->dsc_acao."</td> 
                    <td>".$resultado->observacaos."</td>
                    <td class='text-center'>".$desistencia."</td>
                    <td class='text-center'>".$entrevistado."</td>
                    <td class='text-center'>".$resultado->tempo_de_espera."</td>
                    <td class='text-center'>".$resultado->tempoinicio."</td>
                    <td class='text-center'>".$resultado->tempofim."</td>
                    <td class='text-center'>".$resultado->tempo_de_atendimento."</td>
                </tr>
             ";  
        }
    }   

// Relatório - Geral PREVIO
    function setListaAtendimentoFinalizadosGeralPrevio(&$contador, &$valores){
        $sql = "SELECT * FROM `VIEW_RELATORIO_PREVIO` ORDER BY nome";
        self::execute($sql);
        $titulo = "GERAL";
        $nome   = '';
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$contador ++;
            @$valores = @$contador; 
            echo "
                <tr style='color: #000; '>   
                    <th>".$contador."</th> 
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->nome."</td> 
                    <td>".$resultado->telefone."</td> 
                    <td>".$resultado->endereco."</td>
                    <td>".$resultado->inicio."</td>
                    <td>".$resultado->dsc_nucleo."</td> 
                    <td>".$resultado->dsc_atendentes."</td>
                    <td>".$resultado->nome_nivel."</td> 
                    <td>".$resultado->nome_sexo."</td>
                    <td>".$resultado->dsc_acao."</td> 
                    <td>".$resultado->observacao."</td>
                </tr>
             ";  
        }
    }   
    
// Gráficos

// Atendentes individual

    function setAtendenteGrafico(&$i, &$cor, &$nomes, &$acoes, &$nucleos, $idfiltro, &$membro, $id_evento){

        $sql = "SELECT * FROM VIEW_RELATORIO_CARRETA_FULL WHERE fk_evento = '".$id_evento."' AND iduser = '".$idfiltro."' AND fk_tipo_user = 3  ORDER by nome";
        self::execute($sql);


        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT * FROM VIEW_RELATORIO_CARRETA WHERE fk_evento = '".$id_evento."' AND iduser = '".$idfiltro."' AND fk_tipo_user = 3  ORDER by nome";
            self::execute($sql);
        }


        $cor[0]     = '#ff3300';
        $cor[1]     = '#ff0000';
        $cor[2]     = '#ff33ff';
        $cor[3]     = '#0000ff';
        $cor[4]     = '#006600';
        $cor[5]     = '#660000';
        $cor[6]     = '#000066';
        $cor[7]     = '#ff3355';
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $nomes[$i]   = strtoupper($resultado->nome);
            $acoes[$i]   = strtoupper($resultado->dsc_acao);
            $nucleos[$i] = strtoupper($resultado->dsc_nucleo);
            $membro      = strtoupper($resultado->nome_user);
            $i++;
        }        
    }

// Ações

    function setAcaoGrafico(&$indiceacao, &$valoracao, &$acao, $id_evento){

        $sql = "SELECT a.dsc_acao, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA_FULL f inner join tbl_acao a On (f.fk_obsacoes = a.id_acao) inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.dsc_acao ORDER by a.dsc_acao";
        self::execute($sql);


        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT a.dsc_acao, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA f inner join tbl_acao a On (f.fk_obsacoes = a.id_acao) inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.dsc_acao ORDER by a.dsc_acao";
            self::execute($sql);
        }




        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valoracao[$indiceacao] = $resultado->total;
            $acao[$indiceacao]      = ($resultado->dsc_acao=='?')?'DESISTÊNCIA S/ ATENDIMENTO':strtoupper($resultado->dsc_acao);
            $indiceacao++;
        }        

    }  

    function setAcaoGraficoPrevio(&$indiceacao, &$valoracao, &$acao, $id_evento){
        $sql = "SELECT a.dsc_acao, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA_FULL f inner join tbl_acao a On (f.fk_obsacoes = a.id_acao) inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.dsc_acao ORDER by a.dsc_acao;";
        self::execute($sql);

        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT a.dsc_acao, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA f inner join tbl_acao a On (f.fk_obsacoes = a.id_acao) inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.dsc_acao ORDER by a.dsc_acao;";
            self::execute($sql);
        }



        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valoracao[$indiceacao] = $resultado->total;
            $acao[$indiceacao]      = strtoupper($resultado->dsc_acao);
            $indiceacao++;
        }        

    }      

// Núcleos


    function setNucleoGrafico(&$indicenucleo, &$valornucleo, &$nucleo, $id_evento){
        $sql = "SELECT n.dsc_nucleo, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA_FULL f inner join tbl_nucleo n On f.fk_obsnucleos = n.idnucleo inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by n.dsc_nucleo";
        self::execute($sql);


        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT n.dsc_nucleo, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA f inner join tbl_nucleo n On f.fk_obsnucleos = n.idnucleo inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by n.dsc_nucleo";
            self::execute($sql);
        }



        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valornucleo[$indicenucleo] = $resultado->total;
            $nucleo[$indicenucleo]      = ($resultado->dsc_nucleo=='?')?'Desistencia s/ Atendimento':strtoupper($resultado->dsc_nucleo);
            $indicenucleo++;
        }        

    }  

    function setNucleoGraficoPrevio(&$indicenucleo, &$valornucleo, &$nucleo, $id_evento){
        $sql = "SELECT n.dsc_nucleo, COUNT(*) as total FROM VIEW_RELATORIO_PREVIO f inner join tbl_nucleo n On f.fk_obsnucleos = n.idnucleo inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by n.dsc_nucleo";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valornucleo[$indicenucleo] = $resultado->total;
            $nucleo[$indicenucleo]      = strtoupper($resultado->dsc_nucleo);
            $indicenucleo++;
        }        

    }  



// Atendimentos por membros

    function setDefGrafico(&$indicedef, &$valordef, &$def, $id_evento){
        $sql = "SELECT a.nome_user, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA_FULL f inner join tbl_user a On f.iduser = a.iduser inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.nome_user";
        self::execute($sql);

        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT a.nome_user, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA f inner join tbl_user a On f.iduser = a.iduser inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.nome_user";
            self::execute($sql);
        }



        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valordef[$indicedef] = $resultado->total;
            $def[$indicedef]      = strtoupper($resultado->nome_user);
            $indicedef++;
        }        

    }  


    function setDefGraficoPrevio(&$indicedef, &$valordef, &$def, $id_evento){
        $sql = "SELECT a.nome_user, COUNT(*) as total FROM VIEW_RELATORIO_PREVIO f inner join tbl_user a On f.iduser = a.iduser inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.nome_user";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valordef[$indicedef] = $resultado->total;
            $def[$indicedef]      = strtoupper($resultado->nome_user);
            $indicedef++;
        }        

    }  



// Atendimentos por Tipo

    function setTipoGrafico(&$indicetipo, &$valortipo, &$tipo, $id_evento){
        $sql = "SELECT a.nome_nivel, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA_FULL f inner join tbl_nivel_atendimento a On f.fk_nivel_atendimento = a.idl_nivel_atendimento inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.nome_nivel";
        self::execute($sql);

        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT a.nome_nivel, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA f inner join tbl_nivel_atendimento a On f.fk_nivel_atendimento = a.idl_nivel_atendimento inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.nome_nivel";
            self::execute($sql);
        }


        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valortipo[$indicetipo] = $resultado->total;
            $tipo[$indicetipo]      = strtoupper($resultado->nome_nivel);
            $indicetipo++;
        }        
        
    }  

    function setTipoGraficoPrevio(&$indicetipo, &$valortipo, &$tipo, $id_evento){
        $sql = "SELECT a.nome_nivel, COUNT(*) as total FROM VIEW_RELATORIO_PREVIO f inner join tbl_nivel_atendimento a On f.fk_nivel_atendimento = a.idl_nivel_atendimento inner join tbl_evento e On (e.id_evento = '".$id_evento."' AND f.fk_evento = e.id_evento) GROUP by a.nome_nivel";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valortipo[$indicetipo] = $resultado->total;
            $tipo[$indicetipo]      = strtoupper($resultado->nome_nivel);
            $indicetipo++;
        }        
        
    }  

    // Sexo

    function setSexoGrafico(&$indicesexo, &$valorsexo, &$sexo, $id_evento){
        $sql = "SELECT a.nome_sexo, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA_FULL a  WHERE a.fk_evento = '".$id_evento."' GROUP by a.nome_sexo ";
        self::execute($sql);

        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT a.nome_sexo, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA a  WHERE a.fk_evento = '".$id_evento."' GROUP by a.nome_sexo ";
            self::execute($sql);
        }

        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valorsexo[$indicesexo] = $resultado->total;
            $sexo[$indicesexo]      = strtoupper($resultado->nome_sexo);
            $indicesexo++;
        }        
        
    }  

    function setSexoGraficoPrevio(&$indicesexo, &$valorsexo, &$sexo, $id_evento){
        $sql = "SELECT a.nome_sexo, COUNT(*) as total FROM VIEW_RELATORIO_PREVIO a WHERE a.fk_evento = '".$id_evento."' GROUP by a.nome_sexo ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            $valorsexo[$indicesexo] = $resultado->total;
            $sexo[$indicesexo]      = strtoupper($resultado->nome_sexo);
            $indicesexo++;
        }        
        
    }  

    // Assistdi por Membros e seus respectivos assistidos ......
    
    function setAmGrafico($id_evento){
        $sql = "SELECT f.nome_user, f.nome, f.cpf, f.telefone, f.endereco, f.tempo_de_atendimento, f.fk_funcao, f.tempoinicio, f.tempofim, f.dsc_acao, f.dsc_nucleo, f.observacaos,
        COUNT(*) as total 
        FROM VIEW_RELATORIO_CARRETA_FULL f 
        WHERE f.fk_evento = '".$id_evento."'  
        GROUP by f.nome_user, f.nome, f.cpf, f.telefone, f.endereco, f.tempo_de_atendimento ORDER BY f.fk_funcao, f.nome_user";

        self::execute($sql);


        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT f.nome_user, f.nome, f.cpf, f.telefone, f.endereco, f.tempo_de_atendimento, f.fk_funcao, f.tempoinicio, f.tempofim, f.dsc_acao, f.dsc_nucleo, f.observacaos, COUNT(*) as total 
        FROM VIEW_RELATORIO_CARRETA f 
        WHERE f.fk_evento = '".$id_evento."'  
        GROUP by f.nome_user, f.nome, f.cpf, f.telefone, f.endereco, f.tempo_de_atendimento ORDER BY f.fk_funcao, f.nome_user";
            self::execute($sql);
        }




        @$membro = '';
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            if($resultado->nome_user == '?') $resultado->nome_user = "<span class='text-danger'>Desistencia no Atendimento</span>"; 
            @$total = $total + $resultado->total; 
            @$linhas++;
            if($membro !== $resultado->nome_user) { 
                $membro = $resultado->nome_user;
                @$conta = 0;

                echo "
                <tr>
                    <td scope='row' class='h4'>".$linhas."</td>
                    <td colspan='8' scope='row' class='h4'>".strtoupper($resultado->nome_user)."</td>
                </tr>
                <thead style='color:#000'><tr><th></th><th>Nome Completo</th><th>Cpf</th><th>Telefone</th><th>Endereço</th>
                <th>Início</th><th>Fim</th>
                <th>Nucleo</th>
                <th>Ação</th>
                <th>T. de Atendimento</th>
                <th>Observação</th>
                </tr></thead>";
            }
            echo "<tr>
                    <td></td>
                    <td scope='row' style='color:green; padding:0 0 0 25px;'>".@++$conta .". ".$resultado->nome."</td>
                    <td>".$resultado->cpf."</td><td>".$resultado->telefone."</td><td>".$resultado->endereco."</td>
                    <td>".$resultado->tempoinicio."</td><td>".$resultado->tempofim."</td>
                    <td>".$resultado->dsc_nucleo."</td><td>".$resultado->dsc_acao."</td>
                    <td>".$resultado->tempo_de_atendimento."</td>
                    <td>".$resultado->observacaos."</td></tr>";
            

        }
        @$html .= "<tr><td class='h3 bg-success' colspan='3'>Total de Assistdos Atendidos: </td><td colspan='3' class='h3 bg-success'>".@$total."</td></tr>";
        echo $html;

//        $teste        = md5(hash('sha512', "@ad2023"));
//        echo $teste;
    


    }  

/*
    function setAmGraficoPrevio(){
        $sql = "SELECT a.nome_user, COUNT(*) as total  FROM VIEW_RELATORIO_CARRETA f inner join tbl_user a On f.iduser = a.iduser  
        GROUP by a.nome_user";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$total = $total + $resultado->total; 
            @$linhas++;
            echo "
                <tr>
                    <td scope='row'>".$linhas."</td>
                    <td>".$resultado->dsc_atendentes."</td>
                    <td>".$resultado->total."</td>
                </tr>";
            }
            @$html .= "<tr><td colspan='2'>Total</td><td>".@$total."</td></tr>";
            echo $html;
    }  
*/

    function setListaViewEventos(){
        $sql = "SELECT * FROM tbl_evento ORDER BY satus_evento DESC";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            if($resultado->satus_evento==1){
                $v_checked='checked';
                $cor ='green';
                $ok_value = 1;
                $rotulo = "Fechar";
            }else{
                $v_checked='';
                $cor ='red';
                $ok_value = 0;
                $rotulo = 'Ativar';
            };  
            @$linhas++;
            @$data_inicio   = $resultado->data_inicio_eveento;
            @$data_fim      = $resultado->data_fim_evento;
            
            echo "
                <tr style='color:".$cor."'>
                    <td scope='row'>".$linhas."</td>
                    <td style='color: ".$cor."'>".strtoupper($resultado->dsc_evento)."
                    </td>
                    <td>".$resultado->endereco."</td>
                     <td>".$data_inicio."</td>
                    <td>".$data_fim."</td>

                    <td class='text-center toggle'>
                        <input type='checkbox' ".$v_checked." data-toggle='toggle' data-size='sm' data-onstyle='success' id='foo'>
                        <label for='foo'>
                            <a href='model/controller/procedimentos.php?id_evento=".$resultado->id_evento."&valor=".$rotulo."&TARCISO=MarcaVolante' id='rotulo'>
                                <span style='color: #fff; font-weight:bold'>".$rotulo."</span></a>
                        </label>
                    </td><td colspan='1'></td>
                    <td>
                       <a class='btn btn-success' style='color: #fff; font-weight:bold' 
                       href='?op=admin_evento&id_evento=".$resultado->id_evento."&resp=TarcisoeditEvento&dsc_evento=".$resultado->dsc_evento."&data_inicio=".$data_inicio."&data_fim=".$data_fim."&fk_tipo_evento=".$resultado->fk_tipo_evento."&endereco=".$resultado->endereco."&satus_evento=".$resultado->satus_evento."'>Editar</a>
                    </td>
                </tr>";
        }
    }  


// BUSCA ASSITIDO APTOS PARA ENTREVISTA
 
function setListaViewBuscarEntrevista($busca){
    @$contador = 0;
    @$busca_nome = '%'.$busca.'%';
    @$id_evento = $_SESSION["EventoId_evento"];
   
    $sql = "SELECT * FROM `tbl_fila` WHERE chamdo_para_atendimento = 1 AND entrevistado = 0 AND fk_evento = '".$id_evento."' AND nome LIKE '".$busca_nome."' ORDER BY nome";
    self::execute($sql);
    while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) { 
        @$contador ++;
        if ($resultado->nome_nivel=='normal') {
            $nivel = "NORMAL";
            $cor='';
            $font = "";
        }else{$nivel = "<button type='button' class='btn btn-success'>PRIORIDADE</button></td>";$cor="#5F9EA0"; $font = "#000";}

            echo"<tr style='color:".$font."; color:".$cor.";'>   
                    <th><input type='checkbox' id='cahamada_atendimento_dia' name='cahamada_atendimento_dia'></th> 
                    <th>".$contador.":" .$resultado->idfila."</th> 
                    <td>
                    <a href='?op=entrevista&idfila=".$resultado->idfila."&resp=Tarcisoedit&nome=".$resultado->nome."&nucleo=".$resultado->dsc_nucleo."&dsc_acao=".$resultado->dsc_acao."&dsc_atendentes=".$resultado->nome_user."'>".$resultado->nome."</a>
                        
               </td>
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->nome_nivel."</td> 
                    <td>".$resultado->dsc_nucleo."</td> 
                    <td>".$resultado->dsc_acao."</td> 
                    <td>".$resultado->nome_user."</td> 
                    <td>".$resultado->observacao."</td> 
                </tr>
                ";  
    }    

}

function setListaVieEntrevista(){
    @$contador = 0;
    @$id_evento = $_SESSION["EventoId_evento"];
   
    $sql = "SELECT * FROM `tbl_fila` WHERE  chamdo_para_atendimento = 1 AND entrevistado = 0 AND desistencia = 0 AND fk_evento = '".$id_evento."' ORDER BY nome";
    self::execute($sql);
    while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) { 
        @$contador ++;
                    if($resultado->desistencia==1){
                $ok_value = 1;
                $rotulo = 'Sim';
            }else{
                $v_checked='';
                $ok_value = 0;
                $rotulo = 'Não';
            }; 
        $cor="#5F9EA0"; 
        $font = "#000";

            echo"<tr style='color:".$font."; color:".$cor.";'>   
        
                    <th>".$contador."</th> 
                    <td>
                    <a href='?op=entrevista&idfila=".$resultado->idfila."&resp=Tarcisoedit&nome=".$resultado->nome."'>".$resultado->nome."</a>
                        
               </td>
                    <td>".$resultado->cpf."</td> 
                    <td>".$resultado->endereco."</td> 
                    <td>".$resultado->telefone."</td> 
                    <td>".$resultado->observacao."</td> 
                    <td class='text-center'>
                        <a class= 'btn btn-link fa fa-ban'href='model/controller/procedimentos.php?idfila=".$resultado->idfila."&valor=".$rotulo."&TARCISO=MarcaEntrevistado' id='rotulo'>".$rotulo."</a>
                    </td> 
                </tr>
                ";  
    }    

}


    /* Edicao e insercao do evento */
    
    function setFuncaoEvento(){
        $sql = "SELECT * FROM `tbl_evento` where satus_evento = '1'";
        self::execute($sql);
        
    
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->id_evento."'";
                if(isset($_GET['fk_evento'])){
                    if($resultado->id_evento == $_GET['fk_evento']) { echo(" SELECTED "); }
                }else {echo "<option value='".$resultado->id_evento."'>".$resultado->dsc_evento."</option>";}
            echo ">".$resultado->dsc_evento."
            </option>";
        }
    }

    

// Eventos para Relatórios - Do Evento Selecionado
function setFuncaoEventoRelatorioSelecionado($idevento){
    $sql = "SELECT * FROM `tbl_evento` WHERE id_evento = $idevento";
    self::execute($sql);
    
    while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<span class=' text-success'>".$resultado->dsc_evento."</span>";
      }
    
} 



// Eventos para Relatórios
function setFuncaoEventoRelatorio(){
    $sql = "SELECT * FROM `tbl_evento` order by satus_evento DESC";
    self::execute($sql);
    while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
        echo "
        <option value='".$resultado->id_evento."'";
            if(isset($_GET['fk_evento'])){
                if($resultado->id_evento == $_GET['fk_evento']) { echo(" SELECTED "); @$x = $resultado->dsc_evento; }
            }else {echo "<option value='".$resultado->id_evento."'>".$resultado->dsc_evento."</option>";}
        echo ">".$resultado->dsc_evento."
        </option>";
    }
} 

// titulo do evento selecionado para relatorio
function FuncaoSelecaoEvento($id){
    $sql = "SELECT * FROM `tbl_evento` WHERE id_evento ='".$id."'";
    self::execute($sql);
    $resultado = $this->stmt->fetch(PDO::FETCH_OBJ);
    return @$resultado->dsc_evento;
    
}  
    
// INICIO Cadastro de eventos     
    function setTipoEvento(){
        $sql = "SELECT * FROM `tbl_tipo_evento` ORDER BY dsc_evento";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->id_tipo_evento."'";
                if(isset($_GET['fk_tipo_evento'])){
                    if($resultado->id_tipo_evento == $_GET['fk_tipo_evento']) { echo(" SELECTED "); }
                }else {echo "<option value='".$resultado->id_tipo_evento."'>".$resultado->dsc_evento."</option>";}
            echo ">".$resultado->dsc_evento."
            </option>";
        }
    }
// FIM Cadastro de eventos

/* Edicao e insercao do admin */

    function setTipoUser(){
        $sql = "SELECT * FROM `tbl_tipo_user` where status_tipo_user = 1";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->id_tipo_user."'";
                if(isset($_GET['tipo_user'])){
                    if($resultado->id_tipo_user == $_GET['tipo_user']) { echo(" SELECTED "); }
                }else {echo "<option value='".$resultado->id_tipo_user."'>".$resultado->dsc_tipo_user."</option>";}
            echo ">".$resultado->dsc_tipo_user."
            </option>";
        }
    }
    

    
    function setFuncaoUser(){
        $sql = "SELECT * FROM `tbl_funcao` where habilitado = 'S' AND id_funcao <> 4 AND id_funcao <> 5 AND id_funcao <> 6";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "
            <option value='".$resultado->id_funcao."'";
                if(isset($_GET['fk_funcao'])){
                    if($resultado->id_funcao == $_GET['fk_funcao']) { echo(" SELECTED "); }
                }else {echo "<option value='".$resultado->id_funcao."'>".$resultado->dsc_funcao."</option>";}
            echo ">".$resultado->dsc_funcao."
            </option>";
        }
    }
    
    function setListaViewUser($funcao_user){
        
        @$id_evento = $_SESSION["EventoId_evento"];
 
        $sql = "SELECT * FROM VIEW_DADOS_CONFIGURAR WHERE fk_funcao = '".$funcao_user."' AND iduser <> 52 ORDER BY iduser DESC";
 
 //       $sql = "SELECT * FROM VIEW_DADOS_CONFIGURAR WHERE fk_funcao = '".$funcao_user."' AND iduser <> 52 AND fk_idevento = '".$id_evento."' ORDER BY iduser DESC";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$atendido ++;
            if($resultado->fk_funcao == 1 && $resultado->habilitado_user <> "N") {
                $cor='green';
            }elseif($resultado->fk_funcao <> 1 && $resultado->habilitado_user <> "N"){
                $cor='blue';
            }else {
                $cor = 'red';
            }
     //       if($resultado->iduser <> 52 AND $resultado->fk_idevento = $id_evento){
                echo "
                    <tr style='color: ".$cor.";'>   
                        <td>".$atendido."</td> 
                        <td style='color: ".$cor."'>".strtoupper($resultado->nome_user)."</td> 
                        <td>".$resultado->cpf_user."</td> 
                        <td>".$resultado->dsc_funcao."</td> 
                        <td class='text-center'>".$resultado->habilitado_user."</td> 
                        <td class='text-center'>".$resultado->dsc_evento."</td>
                        <td>
                        <a class='btn btn-primary' style='color: ".$cor."' href='?op=admin_user&iduser=".$resultado->iduser."&resp=TarcisoeditUser&nome=".$resultado->nome_user."&tipo_user=".$resultado->fk_tipo_user."&dsc_funcao_user=".$resultado->dsc_funcao."&login_user=".$resultado->login_user."&cpf=".$resultado->cpf_user."&fk_funcao=".$resultado->fk_funcao."&fk_evento=".$resultado->fk_idevento."&habilita_user=".$resultado->habilitado_user."'>Editar</a>
                        </td>                 
                    </tr>
                ";
       //     }  
        }
    } 

// INICIO Pesquisa de Usuario sistema - sessao administrador   

    function setListaViewUserPesquisa($nomepesquisa){
        @$nome          = '%'.$nomepesquisa.'%';        
        $sql = "SELECT * FROM VIEW_DADOS_CONFIGURAR WHERE iduser <> 52 AND nome_user LIKE '".$nome."' ORDER BY iduser DESC";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$atendido ++;
            if($resultado->fk_funcao == 1 && $resultado->habilitado_user <> "N") {
                $cor='green';
            }elseif($resultado->fk_funcao <> 1 && $resultado->habilitado_user <> "N"){
                $cor='blue';
            }else {
                $cor = 'red';
            }
            echo "
                <tr style='color: ".$cor.";'>   
                    <td>".$atendido."</td> 
                    <td style='color: ".$cor."'>".strtoupper($resultado->nome_user)."</td> 
                    <td>".$resultado->cpf_user."</td> 
                    <td>".$resultado->dsc_funcao."</td> 
                    <td class='text-center'>".$resultado->habilitado_user."</td> 
                    <td class='text-center'>".$resultado->dsc_evento."</td>
                    <td>
                    <a class='btn btn-primary' style='color: ".$cor."' href='?op=admin_user&iduser=".$resultado->iduser."&resp=TarcisoeditUser&nome=".$resultado->nome_user."&tipo_user=".$resultado->fk_tipo_user."&dsc_funcao_user=".$resultado->dsc_funcao."&login_user=".$resultado->login_user."&cpf=".$resultado->cpf_user."&fk_funcao=".$resultado->fk_funcao."&fk_evento=".$resultado->fk_idevento."&habilita_user=".$resultado->habilitado_user."'>Editar</a>
                    </td>                 
                </tr>
            ";
        }
    } 

// INICIO Pesquisa de Usuario sistema - sessao administrador   - GERAL

    function setListaViewUserPesquisaAoAbrir(){     
        @$id_evento = $_SESSION["EventoId_evento"];
        $sql = "SELECT nome_user, iduser, fk_tipo_user, login_user, fk_idevento, cpf_user, dsc_funcao, habilitado_user, dsc_evento, fk_funcao FROM VIEW_DADOS_CONFIGURAR WHERE iduser <> 52";
        self::execute($sql);

        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            @$atendido ++;
            if($resultado->fk_funcao == 1 && $resultado->habilitado_user <> "N") {
                $cor='green';
            }elseif($resultado->fk_funcao <> 1 && $resultado->habilitado_user <> "N"){
                $cor='blue';
            }else {
                $cor = 'red';
            }
        }
        echo "
        <tr>
            <td></td><td>
            <script>
            function getComboA(selectObject) {
                var id = selectObject.value; 
                window.location.href = 'model/controller/procedimentos.php?TARCISO=insercaodenovousuarios_carreta&dados_id_user='+id+'&id_evento='+{$id_evento}
            }
            </script>";
        echo "  
                <div class'col-md-6 dropdown'>
                    <label for='selecao_user'>Selecionar Usuário:</label>
                    <select class='form-control' name='selecao_user' id='selecao_user' style='width:400px; height:800px;' multiple onchange='getComboA(this)'>";
                        $sql = "SELECT u.iduser, u.nome_user, u.fk_tipo_user , u.fk_funcao FROM `tbl_evento` e, tbl_historico h, tbl_user u 
                        WHERE e.satus_evento = 0 AND h.fk_idevento = e.id_evento AND u.iduser = h.fk_iduser AND u.iduser <> 52 AND u.iduser <> 3 AND u.habilitado = 'S' ORDER BY u.fk_funcao, u.nome_user";
                        self::execute($sql);
                        @$usuario = '';
                        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
                            if($resultado->fk_funcao == 7){
                                $cor = 'text-primary';
                            }
                            elseif($resultado->fk_funcao == 1){
                                $cor = 'text-success';
                            }
                            else{
                                $cor = 'text-dark';
                            }

                            if($usuario !== $resultado->nome_user){
                                $usuario = $resultado->nome_user;
                                echo "<option class='".$cor."' value='".$resultado->iduser."'>".strtoupper($resultado->nome_user)."</option>";
                            }
                            
                        }
        echo"       </select>
                </div>
            </td>
    
            <td class='text-center h1' colspan='2'> </td>";
        echo "   
        
        <script>
        function getComboB(selectObject) {
            var id = selectObject.value; 
            window.location.href = 'model/controller/procedimentos.php?TARCISO=retirardenovousuarios_carreta&dados_id_user='+id+'&id_evento='+{$id_evento}
        }
        </script>
        <td>
                <div class'col-md-6 dropdown'>
                    <label for='evento_user'>Usuários no evento atual:</label>
                    <select class='form-control' name='evento_user' id='evento_user' style='width:400px; height:800px;' multiple onchange='getComboB(this)'>";
                        $sql = "SELECT u.iduser, u.nome_user, u.fk_tipo_user, u.fk_funcao  FROM `tbl_evento` e, tbl_historico h, tbl_user u 
                        WHERE e.satus_evento = 1 AND h.fk_idevento = e.id_evento AND u.iduser = h.fk_iduser AND u.iduser <> 52 AND u.iduser <> 3 ORDER BY u.fk_funcao, u.nome_user";
                        self::execute($sql);
                        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
                            if($resultado->fk_funcao == 7){
                                $cor = 'text-primary';
                            }
                            elseif($resultado->fk_funcao == 1){
                                $cor = 'text-success font-weight-bold';
                            }
                            else{
                                $cor = 'text-dark';
                            }

                            if($usuario !== $resultado->nome_user){
                                $usuario = $resultado->nome_user;
                                echo "<option class='".$cor."' value='".$resultado->iduser."'>".strtoupper($resultado->nome_user)."</option>";
                            }
                        }
        echo"       </select>
                </div>            
            </td>
        </tr>";
    } 

    // Assistdi por Membro
    
    function setAmGraficoQtd($id_evento){
        $sql = "SELECT f.nome_user, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA_FULL f WHERE f.fk_evento = '".$id_evento."' GROUP by f.nome_user ORDER BY f.nome_user";
        self::execute($sql);

        if($rows = $this->stmt->rowCount()==0){
            $sql = "SELECT f.nome_user, COUNT(*) as total FROM VIEW_RELATORIO_CARRETA f WHERE f.fk_evento = '".$id_evento."' GROUP by f.nome_user ORDER BY f.nome_user";
            self::execute($sql);
        }


        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
             if($resultado->nome_user == '?') $resultado->nome_user = "<span class='text-danger'>DESISTÊNCIA NO ATENDIMENTO</span>"; 
            @$total = $total + $resultado->total; 
            @$linhas++;
            echo "
                <tr>
                    <td scope='row'>".$linhas."</td>
                    <td>".$resultado->nome_user."</td>
                    <td>".$resultado->total."</td>
                </tr>";
            }
            @$html .= "<tr><td colspan='2'>Total</td><td>".@$total."</td></tr>";
            echo $html;
    }  


    function setNucleoAtendimentoInput(){
        $sql = "SELECT * FROM `tbl_nucleo` where status_nucleo = 1 ORDER by dsc_nucleo";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "<input type='checkbox' name='id_".$resultado->idnucleo."'> <span style='padding:0 42px 0 0'>".$resultado->dsc_nucleo."</span>";  
        }
    }


    function setAcaoAtendimentoInput(){
        $sql = "SELECT * FROM `tbl_acao` where status_acao = 1 ORDER by dsc_acao ";
        self::execute($sql);
        while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) {
            echo "<input type='checkbox' name='id_".$resultado->id_acao."'> <span style='padding:0 42px 0 0'>".$resultado->dsc_acao."</span>";        
        }
    }


// lISTA OS ASSITIDOS CADASTRADOS NO EVENTO - AGUARDANDO ATENDIMENTO

function setListaViewAssistidoAtendimentos($idfila){
    @$contador  = 0;
    @$id_evento = $_SESSION["EventoId_evento"];
    @$idfila    = @$idfila;
    
    $sql = "SELECT 
                s.idservico, s.fk_idfila, s.fk_idacao, s.fk_idnucleo, s.fk_atendente, s.observacao, s.solucao, s.tipo_documento, s.status_servico, s.tempoinicio, s.tempofim,
                f.idfila, f.nome, f.cpf, 
                a.id_acao, a.dsc_acao,
                n.idnucleo, n.dsc_nucleo,
                u.iduser, u.nome_user,
                d.id_tipo_documento,
                d.dsc_documento

                FROM tbl_servicos s, tbl_fila f, tbl_acao a, tbl_nucleo n, tbl_user u, tbl_tipo_documento d
                    WHERE f.fk_evento = '".$id_evento."' AND f.idfila = '".$idfila."' AND s.fk_idfila = f.idfila 
                            AND s.status_servico = 1
                                AND a.id_acao = s.fk_idacao
                                    AND n.idnucleo = s.fk_idnucleo
                                        AND u.iduser = s.fk_atendente
                                            AND d.id_tipo_documento = s.tipo_documento";
    self::execute($sql);
    while($resultado = $this->stmt->fetch(PDO::FETCH_OBJ)) { 
        @$contador ++;
    echo"   <tr>   
                <th>".$contador."</th> 
                </td>
                    <td>".$resultado->nome."</td> 
                    <td>".$resultado->dsc_nucleo."</td> 
                    <td>".$resultado->dsc_acao."</td> 
                    <td>".$resultado->nome_user."</td> 
                    <td>".$resultado->observacao."</td>
                    <td>".$resultado->tempoinicio."</td>
                    <td>".$resultado->tempofim."</td>
                    <td>".$resultado->dsc_documento."</td> 
                    <td>".$resultado->solucao."</td> 
                    <td class='text-center'><a href='?op=recepcao&idfila=".$resultado->idfila."&idservico=".$resultado->idservico."&resp=Tarcisoedit&nome=".$resultado->nome."&fk_atendente=".$resultado->iduser."&fk_tipo_documento=".@$resultado->fk_tipo_documento."&nucleo=".$resultado->dsc_nucleo."&dsc_acao=".$resultado->dsc_acao."&dsc_atendentes=".$resultado->nome_user."&mudarservico=mudarservico'><i style='font-size:24px' class='fa fa-edit text-green 3x'></i></a></td> 
                </td>                
            </tr>";  
    }
}   


// BUSCA ASSITIDO CADASTRADO NO EVENTO



    
}





// SELECT * FROM `VIEW_RELATORIO_ENTREVISTA` e, tbl_fila f WHERE f.fk_evento = 7 and e.idfila = f.idfila; 

/*
SELECT id, data_entrada, data_saida, cpf, nome, endereco, telefone, observacao, solucao, idade, nome_nivel, nome_sexo, dsc_acao, dsc_documento, acao_prolongada, agua_tratada, area_buscou_nao_houve_atendimento, avaliacao_defensor, avaliacao_tempo, condicao_imovel, conhecimento_acao, cor, data_entrevista, escolaridade, estado_civil, esta_gestante, fossa_septica, frequencia_de_visita, importancia_carreta, local_residencia, melhorar_atendimento, ocupacao, possui_filhos_qtd, providencia_tomada, rede_esgoto, rede_internet, renda_domiciliar, tipo_residencia
FROM `tbl_fila` f,  `tbl_entrevistas` e, tbl_nivel_atendimento a, tbl_sexo_atendimento s, tbl_acao ac, tbl_tipo_documento d
WHERE f.fk_evento = 9 and e.fk_idfila = f.idfila and a.idl_nivel_atendimento = f.fk_nivel_atenimeneto and s.id_sexo_atendimento = f.fk_sexo_atendimento and ac.id_acao = f.fk_obsacoes and d.id_tipo_documento = f.fk_tipo_documento
order by nome asc;



uPDATE tbl_fila SET tbl_fila.tempoinicio = DATE_SUB(tbl_fila.tempofim, INTERVAL 3 HOUR) WHERE tbl_fila.fk_evento = 12; 
uPDATE tbl_fila SET tbl_fila.tempofim = DATE_SUB(tbl_fila.tempofim, INTERVAL 3 HOUR) WHERE tbl_fila.idfila = 867; 


*/
?>


