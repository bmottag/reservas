<?php
// create some HTML content	
$html = '
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}
	</style>';
				
//datos especificos
$html.= '<table border="0" cellspacing="0" cellpadding="4">';
$html.= '<tr>
			<th align="center" width="14%" bgcolor="#5ea431" style="color:white;"><strong>Fecha</strong></th>
			<th align="center" width="20%" bgcolor="#5ea431" style="color:white;"><strong>Horario</strong></th>
			<th align="center" width="20%" bgcolor="#5ea431" style="color:white;"><strong>Correo Electrónico</strong></th>
			<th align="center" width="23%" bgcolor="#5ea431" style="color:white;"><strong>No. Celular de Contacto</strong></th>
			<th align="center" width="23%" bgcolor="#5ea431" style="color:white;"><strong>Nombre</strong></th>
		</tr>';

$items = 0;
if($listaReservas)
{ 
	foreach ($listaReservas as $lista):
		$items++;
		
		$movil = $lista['numero_contacto'];
		// Separa en grupos de tres 
		$count = strlen($movil); 
			
		$num_tlf1 = substr($movil, 0, 3); 
		$num_tlf2 = substr($movil, 3, 3); 
		$num_tlf3 = substr($movil, 6, 2); 
		$num_tlf4 = substr($movil, -2); 

		if($count == 10){
			$resultado = "$num_tlf1 $num_tlf2 $num_tlf3 $num_tlf4";  
		}else{
			$resultado = chunk_split($movil,3," "); 
		}
		
		$html.=	'<tr>
					<th align="center">' . ucfirst(strftime("%b %d, %G",strtotime($lista['hora_inicial']))) . '</th>
					<th align="center">' . ucfirst(strftime("%I:%M",strtotime($lista['hora_inicial']))) . ' - ' . ucfirst(strftime("%I:%M %p",strtotime($lista['hora_final']))) . '</th>
					<th>' . $lista['correo_electronico'] . '</th>
					<th align="center">' . $resultado . '</th>
					<th>' . $lista['nombre_completo'] . '</th>';
		$html.= '</tr>';
	endforeach;
}


$html.= '</table>';	
			
echo $html;
						
?>