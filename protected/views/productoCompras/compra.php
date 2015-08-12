<?php 

	//Detalles
	$numCompra = $_GET['id'];
	$laCompra = ProductoCompras::model()->findByPk($numCompra);
	$detalleCompra = ProductoCompraDetalle::model()->findAll("producto_compra_id=$laCompra->id");

?>

			<style type="text/css">
			p{
				margin: 2px 0px;
			}
				
			</style>

<body>
<table>
	<tr>
		<td width="80">
			<img src="images/logo_menbrete1.jpg" alt="" height="90">
		</td>
		<td width="250">
				<p style="text-align: center;">CALLE 87 No 47 – 47</p>
				<p style="text-align: center;">PBX 3177190</p>
				<p style="text-align: center;">BARRANQUILLA - COLOMBIA</p>
		</td>
	</tr>
	<tr>
		<td>
			<!-- columna izquierda -->
			<p>GENERADO: <?php echo $laCompra->fecha; ?></p>
			<p>NOMBRE: <?php echo $laCompra->productoProveedor->nombre; ?></p>
			<p>NIT O CC: <?php echo $laCompra->productoProveedor->doc_nit; ?> </p>
			<p>DIRECCION: <?php echo $laCompra->productoProveedor->direccion; ?> </p>
			<p>TELEFONO: <?php echo $laCompra->productoProveedor->telefono; ?> </p>
			<p>N°. FACTURA: <?php echo $laCompra->factura_n; ?> </p>
		</td>
		<td>
			<!-- Columna Derecha -->
			<table>
				<tr>
					<td>COMPROBANTE DE COMPRA N°: </td>
					<td width="80" border=1><?php echo $laCompra->id; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br><br>

<table border=1 cellspacing=0 cellpadding=2>
	<tr>
		<td width="20"><p style="text-align: center;">#</p></td>
		<td width="300" tyle="text-align: center;"><p style="text-align: center;">PRODUCTO</p></td>
		<td width="100" tyle="text-align: center;"><p style="text-align: center;">PRESENT.</p></td>
		<td width="40" tyle="text-align: center;"><p style="text-align: center;">CANT</p></td>
		<td width="85" tyle="text-align: center;"><p style="text-align: center;">V.UNIT</p></td>
		<td width="40" tyle="text-align: center;"><p style="text-align: center;">IVA</p></td>
		<td width="85" tyle="text-align: center;"><p style="text-align: center;">TOTAL</p></td>
	</tr>
	<?php 
		$conteo = 0;
		foreach ($detalleCompra as $detalle_compra) 
		{
			$conteo = $conteo + 1;
		?>
		<tr>
			<td><?php echo $conteo; ?></td>
			<td><?php echo $detalle_compra->producto->nombre_producto; ?></td>
			<td><?php echo $detalle_compra->producto->productoUnidadMedida->medida; ?></td>
			<td><?php echo $detalle_compra->cantidad; ?></td>
			<td><?php echo $detalle_compra->producto->precio_publico; ?></td>
			<td><?php echo $detalle_compra->iva; ?></td>
			<td><?php echo $detalle_compra->total; ?></td>
		</tr>
		<?php
		}
	?>
</table>

<table>
	<tr>
		<td width="520">
			<p><b>FORMA DE PAGO: </b><?php echo $laCompra->forma_pago; ?> </p>
		</td>
		<td>
			<table>
				<tr>
					<td width="125">SUBTOTAL: </td>
					<td><p style="text-align: right;"><?php echo $laCompra->total_orden; ?></p></td>
				</tr>
				<tr>
					<td>RETE FUENTE:</td>
					<td><p style="text-align: right;"><?php echo $laCompra->retencion_retener; ?></p></td>
				</tr>
				<tr>
					<td>RETE. IVA:</td>
					<td><p style="text-align: right;"><?php echo $laCompra->rte_iva_valor; ?></p></td>
				</tr>
				<tr>
					<td>RETE. ICA:</td>
					<td><p style="text-align: right;"><?php echo $laCompra->rte_ica_valor; ?></p></td>
				</tr>
				<tr>
					<td>IVA</td>
					<td><p style="text-align: right;"><?php echo $laCompra->iva_total; ?></p></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table>
	<tr>
		<td width="520">
			<b>ELABORO: <?php echo $laCompra->personal->nombreCompleto; ?></b>
		</td>
		<td>
			<table>
				<tr>
					<td  width="125"><b>TOTAL A PAGAR:</b></td>
					<td><b><?php echo $laCompra->total_compra; ?></b></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>