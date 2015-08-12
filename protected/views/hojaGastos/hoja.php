<?php 
	
	//Detalles
	$idCita = $_GET['id'];
	$hojaGastos = HojaGastos::model()->find("cita_id = $idCita");
	$detalleHoja = HojaGastosDetalle::model()->findAll("hoja_gastos_id = $hojaGastos->id");
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
		<td><p>N°: <?php echo $hojaGastos->id; ?></p></td>
	</tr>
	<tr>
		<td width="400"><p>NOMBRE: <?php echo $hojaGastos->paciente->nombreCompleto; ?></p></td>
		<td width="200"><p>FECHA: <?php echo Yii::app()->dateformatter->format("yyyy-MM-dd",$hojaGastos->fecha); ?></p></td>
	</tr>
</table>

<table  border=1 cellspacing=0 cellpadding=2>
			<tr>
				<th width="60"><small>Codigo</small></th>
				<th width="200"><small>Producto</small></th>
				<th width="75"><small>Lote</small></th>
				<th width="200"><small>Presentación</small></th>
				<th width="80"><small>Uni. de Medida</small></th>
				<th width="50"><small>Cant.</small></th>
			</tr>
			<?php 
			$cantidad = 0;
			//$losGastos = HojaGastosDetalle::model()->findAll("hoja_gastos_id = $idHojaGastos->id");
			foreach ($detalleHoja as $los_gastos) 
			{
				?>
				<tr>
					<td><?php echo $los_gastos->producto->producto_referencia; ?></td>
					<td><?php echo $los_gastos->producto->nombre_producto; ?></td>
					<td><?php echo $los_gastos->producto->lote; ?></td>
					<td><?php echo $los_gastos->producto->productoPresentacion->presentacion; ?></td>
					<td><?php echo $los_gastos->producto->productoUnidadMedida->corto; ?></td>
					<td><?php echo $los_gastos->cantidad; ?></td>
				</tr>
				<?php
				$cantidad = $cantidad + $los_gastos->cantidad;
			}
			?>
		</table>
<br><br>
		<table>
			<tr>
				<td width="200"></td>
				<td width="200"></td>
				<td width="200"><b>Cantidad de Productos: <?php echo $cantidad; ?></b></td>
				<td width="200"></td>
			</tr>
		</table>

</div>
</div>
</body>