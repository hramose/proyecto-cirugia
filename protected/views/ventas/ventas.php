<?php 
	
	//Detalles
	$numVentas = $_GET['id'];
	$lasVentas = Ventas::model()->findByPk($numVentas);
	$detalleVenta = VentasDetalle::model()->findAll("venta_id=$numVentas");


?>

			<style type="text/css">
			p{
				margin: 2px 0px;
			}
				
			</style>

<table>
	<tr>
		<td width="200">
			<p>MARIA ANGELICA DIAZ</p>
			<br>
			<p>NIT: 39.017.694-2</p>
			<p>CALLE 87 N° 47 – 47</p>
			<p>PBX: 3177190</p>
			<p>RES. REGIMEN SIMPLIFICADO</p>
			<p>ORDEN DE PAGO N°: <?php echo $lasVentas->id; ?></p>
			<p>FECHA: <?php echo $lasVentas->fecha; ?></p>
			<p>LE ATENDIO: <?php echo $lasVentas->personal0->nombreCompleto; ?></p>
			__________________________________
			<br>
			<p>CLIENTE: <?php echo $lasVentas->paciente->nombreCompleto; ?></p>
			<p>NIT/CC: <?php echo $lasVentas->paciente->n_identificacion; ?></p>
			<p>DIRECCION: <?php echo $lasVentas->paciente->direccion; ?></p>
			<p>TELEFONO: <?php echo $lasVentas->paciente->telefono1; ?></p>
			___________________________________
			<br>
			<p>DETALLES DE LA VENTA</p>
			<?php 
				foreach ($detalleVenta as $detalle_venta) 
				{
					echo $detalle_venta->producto->nombre_producto . " - CANT: " . $detalle_venta->cantidad . "<br><br>";
				}
			?>
			____________________________________
			<br>
			<p>DCTO:</p>
			<p>SUBTOTAL: $<?php echo $lasVentas->sub_total;  ?></p>
			<p>IVA(16%): $<?php echo $lasVentas->total_iva;  ?></p>
			<p>NETO: $<?php echo $lasVentas->total_venta;  ?></p>
			<br>
			<p>RECIBIDO: <?php echo $lasVentas->dinero_recibido; ?></p>
			<p>CAMBIO: <?php echo $lasVentas->dinero_cambio; ?></p>
			____________________________________
			<br>
			<p>F. DE PAGO: <?php echo $lasVentas->forma_pago; ?></p>
			<?php if ($lasVentas->forma_pago2 != 'Ninguna') {
				?>
			<p>F. DE PAGO 2: <?php echo $lasVentas->forma_pago2; ?></p>	
				<?php
			} ?>
			<br>
			<p>GRACIAS POR PREFERIRNOS</p>
			<br>
			<p>CONDICIONES DE GARANTIA:</p>
			<p>PARA EFECTOS DE GARANTIA SE DEBE PRESENTAR LA FACTURA.</p>
			<br>
			<p>___*** FIN FACTURA ***___</p>
			<br><br><br>
			<p>Apreciable cliente SMADIA MEDICAL GROUP S.A.S.</p>
			<p>no realizara cambio de productos</p>
			<p>devolución de dinero por compra de los</p>
			<p>mismos, solo en los casos en que haya lugar</p>
			<p>a hacer efectiva la garantia.</p>
		</td>
	</tr>
</table>