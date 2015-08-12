<?php 
	
	//Detalles
	$idCita = $_GET['id'];
	$historialNotas = HistorialNotasEnfermeria::model()->find("cita_id = $idCita");
	$detalleNotas = HistorialNotasEnfermeriaDetalles::model()->findAll("historial_notas_enfermeria_id = $historialNotas->id");
	//$elnumero = $laFactura->factura->numero;


?>

			<style type="text/css">
			p{
				margin: 2px 0px;
			}
				
			</style>

<body>
<div style="background-image: url(images/membrete_varios.jpg); background-repeat: no-repeat; height:100%; width:100%; padding:0px 0px 0px 40px;">			
<!-- <div style="height:175px"></div> -->
<div style="padding:170px 0px 0px 0px;">

<table>
	<tr>
		<td><p><b>N°: </b><?php echo $historialNotas->id; ?></p></td>
	</tr>
	<tr>
		<td width="400"><p><b>NOMBRE: </b><?php echo $historialNotas->paciente->nombreCompleto; ?></p></td>
		<td width="200"><p><b>FECHA: </b><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$historialNotas->fecha); ?></p></td>
	</tr>
</table>

<table border=1 cellspacing=0 cellpadding=2>
			<tr>
				<th width="100">Fecha</th>
				<th width="100">Hora</th>
				<th width="150">Nota</th>
				<th width="150">Fima</th>

			</tr>
		<?php 
			foreach ($detalleNotas as $las_notas) 
			{
				?>
				<tr>
					<td><?php echo $las_notas->fecha; ?></td>
					<td><?php echo $las_notas->hora; ?></td>
					<td width="300"><?php echo $las_notas->nota; ?></td>
					<td></td>
				</tr>
				<?php
			}
		?>
		</table>
<br><br>


</div>
</div>
</body>