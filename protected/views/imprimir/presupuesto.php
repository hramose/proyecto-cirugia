<?php 
	
	//Detalles
	$numPresupuesto = $_GET['id'];
	$elPresupuesto = Presupuesto::model()->findByPk($numPresupuesto);
	$detallePresupuesto = PresupuestoDetalle::model()->findAll("presupuesto_id = $numPresupuesto");
	//$elnumero = $laFactura->factura->numero;


?>

<html>
	<head>
			<title>Presupuesto</title>
		
	</head>
	<body>
	<p>Texto antes del presupuesto</p>


	<?php 
			
	/*Detalle de Presupuesto*/
	
?>

<p>&nbsp;</p>

	<table border = "0" width="80%">
		<thead>
		<tr>
			<th>Cantidad</th>
			<th>Linea de Servicio</th>
			<th>Total</th>
			
			
		</tr>
		</thead>
		<?php
			
			foreach($detallePresupuesto as $detalle_presupuesto){ 
		?>
		<tr class="info">
			<td><?php echo $detalle_presupuesto->cantidad; ?></td>
			<td><?php echo $detalle_presupuesto->lineaServicio->nombre; ?></td>
			<td><?php echo number_format($detalle_presupuesto->total, 2, '.', ''); ?></td>
		</tr>
		<?php } ?>
	</table>
	</div>

	<br>
	<?php echo $elPresupuesto->total; ?>
	</body>
</html>