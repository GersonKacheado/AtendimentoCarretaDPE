<?php
	require_once("../../model/pdo_relatorios.php");
	require_once("dompdf/dompdf_config.inc.php");

	$avaliado = 'S'; $emsala = 'S'; $redeensinom = 'MUNICIPAL';
	$consulta = AvaliadosEmSalaM($avaliado, $emsala, $redeensinom);


//print_r($consulta);die();


	$html = "<h2 class='text-center'>Relatório de Escolas com Avalidos e Não Enturmados</h2> 
			<table><thead>
				<tr>
	               <th>Ordem</th><th>Código</th><th>Município</th><th>Avaliado</th><th>Sala</th>
	         	</tr>
	         	</thead><tbody>";
	foreach ($consulta as $valores) { @$ordem++;
	    $html .= "<tr>
	    			<td>".$ordem."</td>
	    			<td>".$valores['idmunicipio']."</td>
	    			<td>".$valores['dscmunicipio']."</td>
	    			<td>".$valores['avaliado']."</td>
	    			<td>".$valores['emsala']."</td>
	               </tr>";
	}
	$html .= "</tbody></table>";
//	echo $html;


	$dompdf = new DOMPDF();
	$dompdf->load_html($html);

	$dompdf->set_paper('letter', 'portrait');

	$dompdf->render();
	$dompdf->stream("saida.pdf", array("Attachment" => false));



?>


