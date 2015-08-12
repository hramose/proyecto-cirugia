<?php 
	
	//Detalles
	$idCita = $_GET['id'];
	$descripcion = HistorialDescripcionQuirurgica::model()->find("cita_id = $idCita");
	
	if ($descripcion->ayudante_id == NULL) {
			$nombreAyudante = "";
		}
		else
		{
			$nombreAyudante = $descripcion->ayudante->nombreCompleto;
		}

		if ($descripcion->anestesiologo_id == NULL) {
			$nombreAnesteciologo = "";
		}
		else
		{
			$nombreAnesteciologo = $descripcion->anestesiologo->nombreCompleto;
		}
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
<div style="padding:150px 200px 0px 0px;">

<h3>DESCRIPCION QUIRURGICA</h3>
<br><br>
<p><b>Datos de Identificación</b></p>

<table>
	<tr>
		<td><b>Paciente: </b><?php echo $descripcion->cita->paciente->nombreCompleto; ?></td>
	</tr>
</table>

<?php
	if ($descripcion->cita->paciente->genero == 1) {
		$sexo = "Masculino";	
	}else
	{
		$sexo = "Femenino";
	}
?>

<table>
	<tr>
		<td width="400"><p><b>Sexo: </b><?php echo $sexo; ?></p></td>
		<td width="0"><p><b>Fecha: </b><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$descripcion->fecha); ?></p></td>
	</tr>
</table>

<p><b>Diagnosticos</b></p>
<br>

<table>
	<tr>
		<td><b>Preoperatorio</b></td>
	</tr>
	<tr>
		<td><?php echo $descripcion->diagnostico_preoperatorio; ?></td>
	</tr>
</table>
<br>
<br>
<table>
	<tr>
		<td><b>Posoperatorio</b></td>
	</tr>
	<tr>
		<td><?php echo $descripcion->diagnostico_posoperatorio; ?></td>
	</tr>
</table>
<br>
<br>
<table>
	<tr>
		<td  width="400"><p><b>Cirujano: </b><?php echo $descripcion->cirujano->nombreCompleto ?></p></td>
		<td><p><b>Ayudante: </b><?php echo $nombreAyudante ?></p></td>
	</tr>
	<tr>
		<td  width="400"><p><b>Anestesiólogo: </b><?php echo $nombreAnesteciologo ?></p></td>
		<td><p><b>Inst Quirúrgico: </b><?php echo $descripcion->instQuirurgico->nombreCompleto ?></p></td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td width="100"><p><b>Fecha: </b></p></td>
		<td width="100"><p><b>Hora Inicio: </b></p></td>
		<td width="100"><p><b>Hora Final: </b></p></td>
		<td width="100"><p><b>Codigo CUPS: </b></p></td>
		<td><p><b>Intervención Practicada: </b></p></td>
	</tr>
	<tr>
		<td><p><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$descripcion->fecha_cirugia); ?></p></td>
		<td><p><?php echo $descripcion->hora_inicio; ?></p></td>
		<td><p><?php echo $descripcion->hora_final; ?></p></td>
		<td><p><?php echo $descripcion->codigo_cups ?></p></td>
		<td><p><?php echo $descripcion->intervencion; ?></p></td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td width="300"><p><b>Control de Compresas: </b><?php echo $descripcion->control_compresas; ?></p></td>
		<td><p><b>Tipo de Anestesia: </b><?php echo $descripcion->tipo_anestesia; ?></p></td>
	</tr>
</table>
<br>
<table style="border: solid 0px #440000; width: 85%"    cellspacing="0">
	<tr>
		<td style="width: 100%"><p><b>Descripción de los Hallazgos operatorios, procedimientos y/o complicaciones</b></p></td>
	</tr>
	<tr>
		<td style="width: 100%"><?php echo $descripcion->descripcion_hallazgos; ?></td>
	</tr>
</table>
<table style="border: solid 0px #440000; width: 85%"    cellspacing="0">
	<tr>
		<td style="width: 100%"><p><b>Observaciones</b></p></td>
	</tr>
	<tr>
		<td style="width: 100%"><?php echo $descripcion->observaciones; ?></td>
	</tr>
</table>
</div>
</div>
</body>