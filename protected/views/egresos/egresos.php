<?php 
	
	//Detalles
	$numEgresos = $_GET['id'];
	$elEgresos = Egresos::model()->findByPk($numEgresos);


?>

			<style type="text/css">
			#cuerpo{
				   font-size: 70%;
				}
			p{
				margin: 2px 0px;
			}
				
			</style>

<body>
<div id="cuerpo">
<table>
	<tr>
		<td width="80">
			<img src="images/logo_menbrete.jpg" alt="" height="90">
		</td>
		<td width="250">
				<p style="text-align: center;">CALLE 87 N° 47 - 47</p>
				<p style="text-align: center;">PBX 3177190</p>
				<p style="text-align: center;">BARRANQUILLA - COLOMBIA</p>
		</td>
	</tr>
	<tr>
		<td>
			<!-- columna izquierda -->
			<p>GENERADO: <?php echo $elEgresos->fecha; ?></p>
			<p>PAGADO A: <?php echo $elEgresos->proveedor->nombre; ?></p>
			<p>NIT O CC: <?php echo $elEgresos->proveedor->doc_nit; ?> </p>
			<p>DIRECCION: <?php echo $elEgresos->proveedor->direccion; ?> </p>
			<p>TELEFONO: <?php echo $elEgresos->proveedor->telefono; ?> </p>
			<p>CIUDAD: <?php echo $elEgresos->proveedor->ciudad; ?> </p>
			<p>ESTADO: <?php echo $elEgresos->estado; ?> </p>
		</td>
		<td>
			<!-- Columna Derecha -->
			<table>
				<tr>
					<td>COMPROBANTE DE EGRESO N°: </td>
					<td width="80" border=1><?php echo $elEgresos->id; ?></td>
				</tr>
				<tr>
					<td>FACTURA N°: </td>
					<td width="80" border=1><?php if ($elEgresos->factura_id == NULL) {
						echo "";
					}
					else{
						echo $elEgresos->factura->factura_n;
					}
						 ?></td>
				</tr>
				<tr>
					<td>VALOR: </td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->valor_egreso,2); ?></td>
				</tr>
				<tr>
					<td>MENOS DESCUENTO: </td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->total_descuento,2); ?></td>
				</tr>
				<tr>
					<td>IVA: </td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->iva_valor,2); ?></td>
				</tr>
				<tr>
					<td>MENOS RETE. FUENTE: </td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->a_retener,2); ?></td>
				</tr>
				<tr>
					<td>MENOS RETE. IVA: </td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->rte_iva_valor,2); ?></td>
				</tr>
				<tr>
					<td>MENOS RETE. ICA: </td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->rte_ica_valor,2); ?></td>
				</tr>
				<tr>
					<td>MENOS RETE. CREE: </td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->rte_cree_valor,2); ?></td>
				</tr>
				<tr>
					<td><b>TOTAL PAGADO: </b></td>
					<td width="80" border=1><?php echo '$ '.number_format($elEgresos->total_egreso,2); ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br><br>
<p>POR CONCEPTO DE:</p>
<table border=1 cellspacing=0 cellpadding=2>
	<tr>
		<td width="250">
			<p>FORMA DE PAGO: <?php echo $elEgresos->forma_pago; ?></p>
			<p>CHEQUE N°: </p>
			<p>BANCO: </p>
			<p>CENTRO DE COSTO: <?php echo $elEgresos->centroCosto->nombre; ?></p>
		</td>
		<td width="470">
			<?php echo $elEgresos->observaciones; ?>
		</td>
	</tr>
</table>
<p>SON:</p>
<table border=1 cellspacing=0 cellpadding=2>
	<tr>
		<td width="250">
			FIRMA Y SELLO DEL BENEFICIARIO
			<br><br><br><br><br><br><br><br><br>
			C.C / NIT
		</td>
		
		<td width="470">
			<p>CONTABILIZACION: COMPROBANTE DE CONTABILIDAD N° ######</p>
			<table>
				<tr>
					<td width="100">CODIGO</td>
					<td width="150">NOMBRE CUENTA</td>
					<td width="100">DEBE</td>
					<td>HABER</td>
				</tr>
			</table>
			<br><br><br><br><br><br><br>
		</td>
	</tr>
</table>

<table border=1 cellspacing=0 cellpadding=2>
	<tr>
		<td width="175">PREPARADO:<br><?php echo $elEgresos->personal->nombreCompleto; ?></td>
		<td width="175">REVISADO:<br><br></td>
		<td width="175">APROBADO:<br><br></td>
		<td width="175">CONTABILIZADO:<br><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$elEgresos->fecha); ?></td>
	</tr>
</table>
</div>
</body>