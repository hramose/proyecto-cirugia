<body>
<?php 
	
	//Detalles
	$numPresupuesto = $_GET['id'];
	$elPresupuesto = Presupuesto::model()->findByPk($numPresupuesto);
	$detallePresupuesto = PresupuestoDetalle::model()->findAll("presupuesto_id = $numPresupuesto");
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

<div id="cuerpo" style="background-image: url(images/m_horizontal_presupuesto.jpg); background-repeat: no-repeat; height:100%; padding:0px 0px 0px 20px;">

<!-- <div style="height:175px"></div> -->
<!-- <div style="padding:170px 0px 0px 0px;"> -->

<div style="padding:90px 0px 0px 0px;">
<h5>Presupuesto de Prestación de Servicios</h5>
<p><b>Nombre: </b><?php echo $elPresupuesto->paciente->nombreCompleto; ?></p>
<p><b>N° de Identificación: </b><?php echo $elPresupuesto->paciente->n_identificacion; ?></p>
<h5>Descripción de Tratamientos</h5>
	<table style="border: solid 0px #440000; width: 90%" cellspacing="0">
		<tr>
			<th>Cant.</th>
			<th>Linea de Servicio</th>
			<th>Val. Unitario</th>
			<th>Desc.</th>
			<th>Val. con Desc.</th>
			<th>Val. sin Desc.</th>
			<th id="total">Total</th>
		</tr>
		<?php
			foreach($detallePresupuesto as $detalle_presupuesto){ 
		?>
		<tr>
			<td width="100"><?php echo $detalle_presupuesto->cantidad; ?></td>
			<td width="100"><?php echo $detalle_presupuesto->lineaServicio->nombre; ?></td>
			<td width="100"><?php echo '$ '.number_format($detalle_presupuesto->vu,2); ?></td>
			<td width="100"><?php echo '% '.$detalle_presupuesto->desc; ?></td>
			<td width="100"><?php echo '$ '.number_format($detalle_presupuesto->vt_con_desc,2); ?></td>
			<td width="100"><?php echo '$ '.number_format($detalle_presupuesto->vt_sin_desc,2); ?></td>
			<td width="100" id="total"><b><?php echo '$ '.number_format($detalle_presupuesto->total, 2); ?></b></td>
		</tr>
		<?php } ?>
	</table>
		<p><b>Vendedor: </b><?php echo $elPresupuesto->vendedor->nombreCompleto; ?></p>
		<table style="border: solid 0px #440000; width: 90%" cellspacing="0">
			<tr>
				<td width="700">
					<b>Observaciones: </b><?php echo $elPresupuesto->observaciones; ?>
				</td>
			</tr>
		</table>
		
		<h5>El total de este contrato es de: $ <?php echo $elPresupuesto->total; ?></h5>
		<h5>¡Cotización valida por 30 días!</h5>
		<!-- <p id="parrafo">Firma Paciente y Firma Clinica</p> -->
</div>
</div>
</body>