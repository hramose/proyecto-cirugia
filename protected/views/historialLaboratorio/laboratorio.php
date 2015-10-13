<?php 
	
	//Detalles
	$id = $_GET['id'];
	$historialLaboratorios = HistorialLaboratorio::model()->find("id = $id");
	$detalleLaboratorios = HistorialLaboratorioDetalle::model()->findAll("historial_laboratorio_id = $historialLaboratorios->id");
	//$elnumero = $laFactura->factura->numero;


?>

			<style type="text/css">
				#cuerpo{
				   font-size: 70%;
				}
				#total{
					/*color:red;*/
					background: #A9A9A9;
				}
			</style>

<body>
<div id="cuerpo" style="background-image: url(images/m_horizontal_presupuesto.jpg); background-repeat: no-repeat; height:100%; padding:0px 0px 0px 20px;">

<!-- <div style="height:175px"></div> -->
<!-- <div style="padding:170px 0px 0px 0px;"> -->

<div style="padding:90px 0px 0px 0px;">

<table>
	<tr>
		<td><p><b>N°: </b><?php echo $historialLaboratorios->id; ?></p></td>
	</tr>
	<tr>
		<td width="400"><p><b>NOMBRE: </b><?php echo $historialLaboratorios->paciente->nombreCompleto; ?></p></td>
		<td width="200"><p><b>FECHA: </b><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$historialLaboratorios->fecha); ?></p></td>
	</tr>
</table>
<br>
<h3>Orden de Exámenes de laboratorio</h3>
<table border=1 cellspacing=0 cellpadding=2>
			<tr>
				<th width="300">Exámen</th>
				<th width="300">Otro Examen</th>
			</tr>
		<?php 
			foreach ($detalleLaboratorios as $los_laboratorios) 
			{
				?>
				<tr>
					<td><?php 
					if ($los_laboratorios->laboratorio_id) {
						echo $los_laboratorios->laboratorio->nombre; 	
					}
					else
					{
						echo "Otro"; 
					}
					
					?></td>
					<td><?php echo $los_laboratorios->examen; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
<br><br>
<p>Observaciones:</p>
<div style="width:700px">
	<?php 
		echo $historialLaboratorios->comentarios;
	?>

</div>
</div>
</div>
</body>