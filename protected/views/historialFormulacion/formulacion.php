<?php 
	
	//Detalles
	$numFormulacion = $_GET['id'];
	$laFormulacion = HistorialFormulacion::model()->findByPk($numFormulacion);
	$detalleFormulacion = HistorialFormulacionDetalle::model()->findAll("historial_formulacion_id = $numFormulacion");
	


?>

			<style type="text/css">
				#parrafo{
					padding: 0px 50px 0px 0px 
				}
				#cuerpo{
				   font-size: 70%;
				}
			
			</style>

<div id="cuerpo" style="background-image: url(images/m_horizontal_presupuesto.jpg); background-repeat: no-repeat; height:100%; width:100%; padding:0px 0px 0px 50px;">			
<!-- <div style="height:175px"></div> -->
<div style="padding:150px 0px 0px 0px;">
<h4>Formulaciones</h4>

<p id="parrafo">Paciente: <?php echo "<b>".$laFormulacion->paciente->nombreCompleto. "</b>" ?></p>
<p id="parrafo">Medico: <?php echo "<b>".$laFormulacion->personal->nombreCompleto. "</b>" ?></p>
<br>

<h5>Descripción de Formulaciones</h5>
<br>
<div style="paddin:0px 0px 0px 0px;">
	<table border=1 cellspacing=0 cellpadding=2>
		<thead>
		<tr>
			<th width="150">Formula</th>
			<th width="500">Formulación</th>
		</tr>
		</thead>
		<?php
			foreach($detalleFormulacion as $detalle_formulacion){ 
		?>
		<tr>
			<td>
				<?php 
				if ($detalle_formulacion->formulacion_id == NULL) {
					echo $detalle_formulacion->otra_formulacion;
				}
				else
				{
					echo $detalle_formulacion->laformulacion->nombre;	
				}
				 ?></td>
			<td width="500"><?php echo $detalle_formulacion->formulacion; ?></td>
		</tr>
		<?php } ?>
	</table>	
</div>
</div>
</div>





