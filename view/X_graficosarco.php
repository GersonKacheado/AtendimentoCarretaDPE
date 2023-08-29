<?php
  if(!isset($_SESSION["UsuarioCpf"])) {
      echo "<script>location.href='public/login/index.php'</script>";
  }else{
    include_once("model/DQL.php");
    $selecionar_dados = new SELECIONARDADOS($_SERVER['REMOTE_ADDR']);

    if (isset($_GET['BtnExecutarGrafico']) && $_GET['validarForm']=='TarcisoGrafico') {
      
      @$id_evento = $_GET["idevento"];
      @$idfiltro = $_GET['atendente'];

      $nomes      = array();
      $acoes      = array();
      $nucleos    = array();
      $cor        = array();
      $i          = 0;
      $membro     = array();
      $selecionar_dados->setAtendenteGrafico($i, $cor, $nomes, $acoes, $nucleos, $idfiltro, $membro, $id_evento);

      $valoracao    = array();
      $indiceacao  = 0;
      $acao         = array();
      $selecionar_dados->setAcaoGrafico($indiceacao, $valoracao, $acao, $id_evento);

      $valornucleo   = array();
      $indicenucleo  = 0;
      $nucleo        = array();
      $selecionar_dados->setNucleoGrafico($indicenucleo, $valornucleo, $nucleo, $id_evento);

      $valordef   = array();
      $indicedef  = 0;
      $def        = array();
      $selecionar_dados->setDefGrafico($indicedef, $valordef, $def, $id_evento);

      $valortipo   = array();
      $indicetipo  = 0;
      $tipo        = array();
      $selecionar_dados->setTipoGrafico($indicetipo, $valortipo, $tipo, $id_evento);
      
      $valorsexo   = array();
      $indicesexo  = 0;
      $sexo        = array();
      $selecionar_dados->setSexoGrafico($indicesexo, $valorsexo, $sexo, $id_evento);      
    ?>
  <head>
    <script type="text/javascript" src="public/js/charts/loader.js"></script>

<!-- barra  Por Atendente-->

    <script type="text/javascript">
        dayName = new Array ("domingo", "segunda", "terça", "quarta", "quinta", "sexta", "sábado")
        monName = new Array ("janeiro", "fevereiro", "março", "abril", "maio", "junho", "agosto", "outubro", "novembro", "dezembro")
        now = new Date

	      var datahoje = ("Hoje é " + dayName[now.getDay() ] + ", " + now.getDate () + " de " + monName [now.getMonth() ]   +  " de "  +     now.getFullYear ())

        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
          <?php
            echo "['".$membro."',"; 
            for($k=0; $k < $i; $k++){
              echo "'".$nomes[$k]."', ";
            }
            echo "],";
            echo "['Total de Atendidos: $i',";
            for($k=0; $k < $i; $k++){
              echo "'".$nucleos[$k].':'.$acoes[$k]."', ";
            }  
            echo "],"; 
          ?>
          ]);
          var options = {
            chart: {
              title: 'MUTIRÃO DE ATENDIMENTO - CARRETA - DPEAP',
              subtitle: datahoje,
              is3D: true,

            }
          };
          var chart = new google.charts.Bar(document.getElementById('barra_atendentes'));
          chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

<!-- Circle   Acoes-->

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ações', 'percentual de atendimento'],
         <?php
         for($kv=0; $kv < $indiceacao; $kv++){
          echo "['".$acao[$kv]."',     ".$valoracao[$kv]."],";
         }
         ?>
        ]);
        var options = {
          title: 'Acoes',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('Circle_Acoes_3d'));
        chart.draw(data, options);
      }
    </script>

<!-- Circle  Núcleos -->

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Language', 'Speakers (in millions)'],
          <?php
         for($kv=0; $kv < $indicenucleo; $kv++){
          echo "['".$nucleo[$kv]."', ".$valornucleo[$kv]."],";
         }
         ?>

        ]);

        var options = {
          title: 'Núcleos',
          legend: 'display',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
   
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('Circle_Nuecles'));
        chart.draw(data, options);
      }
    </script>

<!-- Circle Atendimento por Defensor -->

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
         for($kv=0; $kv < $indicedef; $kv++){
          echo "['".$def[$kv]."', ".$valordef[$kv]."],";
         }
         ?>
        ]);

        var options = {
          title: 'Atendimento por Defensor(a)',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('Circle_Atendimento_defensor'));
        chart.draw(data, options);
      }
    </script>   

<!-- Barra Vertical cNivel atendimento -->

    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Valor", { role: "style" } ],

            <?php
            for($kv=0; $kv < $indicetipo; $kv++){
              @$fundo = "#b87".$kv;
              echo "['.$tipo[$kv].',$valortipo[$kv] , '.$fundo[$kv].'],";
            }
            ?>

          ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                          { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                          2]);

          var options = {
            title: "Tipo Atendimento",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("Barra_vertical_Nivel"));
          chart.draw(view, options);
      }
    </script>

<!-- Barra Sexo -->

    <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Valor", { role: "style" } ],
            <?php
            for($kv=0; $kv < $indicesexo; $kv++){
            echo "['.$sexo[$kv].',$valorsexo[$kv] , '.$fundo[$kv].'],";

            }
            ?>
          ]);
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                          { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                          2]);
          var options = {
            title: "Sexo",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("Barra_Sexo"));
          chart.draw(view, options);
        }
    </script>


  </head>
  <body class="container">
    <div class="mb-5" style="width: 100%;">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th class='h4' scope="col" colspan='5'>NOME DEFENSOR(A) E SEUS REPSCTIVOS ASSISTIDOS OU ATENDIMENTO SOCIAL - <?php $idevento = $_GET['idevento'];  $selecionar_dados->setFuncaoEventoRelatorioSelecionado($idevento); ?> </th>
          </tr>
        </thead>
        <tbody>
          <?php
            $selecionar_dados->setAmGrafico($id_evento);
          ?>
        </tbody>
      </table>
    </div>



    <div class="mb-5" style="width: 100%;">
      <table class="table table-striped">
        <caption><h3>Atendimentos - <?php $idevento = $_GET['idevento'];  $selecionar_dados->setFuncaoEventoRelatorioSelecionado($idevento); ?> </h3></caption>
        <thead><tr><th scope="col">#</th><th scope="col">NOME DEFENSOR(A)</th> <th scope="col">QTD</th></tr></thead>
        <tbody>
          <?php
            $selecionar_dados->setAmGraficoQtd($id_evento);
          ?>
        </tbody>
      </table>
    </div>

    <div id="barra_atendentes" style="width: 100%; height:800px;"></div>
    <div id="Circle_Acoes_3d" style="width: 100%; height:500px;"></div>
    <div id="Circle_Nuecles" style="width: 100%; height:500px;"></div>
    <div id="Circle_Atendimento_defensor" style="width: 100%; height:500px;"></div>
    <div class="col-md-6" id="Barra_vertical_Nivel" style="width: 50%; height:500px;"></div>
    <div class="col-md-6" id="Barra_Sexo" style="width: 50%; height:500px;"></div>

  
    <form method="get">
      <h3>Opçõa de Outros Eventos </h3>
      <div class='col-md-2 dropdown'>
        <label for='nucleo_atendimento'>Ação/Evento</label>
        <select class='form-control' name='idevento' id='idevento'>
          <?php $selecionar_dados->setFuncaoEventoRelatorio();?>
        </select>
      </div>
        <input type="hidden" name='validarForm' value='TarcisoGrafico'> 
        <input type="hidden" name='op' value='admin_relatorio'> 
      <div class='col-md-2 dropdown'>
        <label for='nucleo_atendimento'>Ação</label>
        <input class=' btn btn-primary form-control' type="submit" value="Selecionar mais eventos" name="BtnExecutarGrafico">
      </div>
    </form>
<!--  
    <form method="get">
        <input type="hidden" name='validarForm' value='TarcisoGrafico'> 
        <input type="hidden" name='op' value='graficosarco'> 
        <input type="hidden" name='idevento' value='<? //=$_SESSION["EventoId_evento"] ;?>'> 
        <div class='col-md-4 dropdown'>
          <label for='nucleo_atendimento'>Membro</label>
          <select class='form-control' name='atendente' id='atendente'>
            <?php // $selecionar_dados->setAtendenteAtendimento();?>
          </select>
        </div>
        <div class='col-md-2 dropdown'>
          <label for='nucleo_atendimento'>Ação</label>
          <input class=' btn btn-primary form-control' type="submit" value="Executar Gráfico" name="BtnExecutarGrafico">
        </div>
    </form>
-->    
  </body>
<?php 
    } 
  }
?>
