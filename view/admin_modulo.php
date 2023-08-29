<?php

/*    como saber a senha ou criar novas 
*
    $teste        = md5(hash('sha512', "@g5p10y@"));
    echo $teste;
 *
 *
 */ 

$senhas =( md5(hash('sha512', "dpeap")));

if(!isset($_SESSION["UsuarioCpf"])) {
        echo "<script>location.href='public/login/index.php'</script>";
}else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);
    @$habilitado = $_GET['habilita_user'];
 ?>

   <?php include_once('opcoes.php'); ?>

<!-- FIM Relatório Finalizado -->
    
    <!-- INICO Modulo -->
    <div class="col-md-12 offset-md-3" role='group' aria-label='Exemplo'>
        <form  method="POST" action="model/controller/inserir_dados.php" name='CadastrarModulo' >
            <h1>Módulos para Cadastrar</h1>
            <div class="col-md-6 dropdown">
            <table class="table table-striped" style='background:#ccc'>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th class='text-center' colspans='2' scope="col">Módulo habilitado para inserção de Dados</th>
                </tr>
            </thead>
            <tbody>
                <tr> <th scope="row">1</th> <td>Deficiência</td> <td class='text-center' colspan='3'><input type='radio' value='cad_deficiencia' name='radio_modulo' id='radio_modulo' checked></td> </tr>
                <tr> <th scope="row">2</th> <td>Nivel de atendfimento</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_atendimento' name='radio_modulo' id='radio_modulo'></td> </tr>
                <tr> <th scope="row">3</th> <td>Sexo</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_sexo' name='radio_modulo' id='radio_modulo'></td> </tr>
                <tr> <th scope="row">4</th> <td>Núcleo</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_nucleo' name='radio_modulo' id='radio_modulo'></td> </tr>
                <tr> <th scope="row">5</th> <td>Ação</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_acao' name='radio_modulo' id='radio_modulo'></td> </tr>
                <tr> <th scope="row">6</th> <td>Tipo Documento</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_tipo_documento' name='radio_modulo' id='radio_modulo'></td> </tr>
                <tr> <th scope="row">7</th> <td>Tpo Usuário</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_grupo_user' name='radio_modulo' id='radio_modulo'></td> </tr>
                <tr> <th scope="row">8</th> <td>Função no Sistema</td> <td  class='text-center' colspan='3'><input type='radio' value='cad_funcao_sistema' name='radio_modulo' id='radio_modulo'></td> </tr>

                <tr> <th scope="row">#</th>
                    <td colspan='3'><input type="text" name="valor_modulo"></td>
                    <td><button type="submit" class="btn btn-success" value='Valid_Cad_Modulo' name='Btn_Cad_Modulo'>Cadastrar</button></td> 
                </tr>
            </tbody>
            </table>
        </form>    
    </div>
<!-- FIM Modulo -->   
   

<?php

} ?>
