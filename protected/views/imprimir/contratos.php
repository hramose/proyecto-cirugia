<?php 
	
	//Detalles
	$numContratos = $_GET['id'];
	$elContrato = Contratos::model()->findByPk($numContratos);
	$detalleContrato = ContratoDetalle::model()->findAll("contrato_id = $numContratos");
	//$elnumero = $laFactura->factura->numero;


?>

			<style type="text/css">

				body{
					line-height:1.5;
					font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;color:#000; 
					background: url("images/hoja_menbrete-2-01.jpg")no-repeat;
					background-size: 100%;
					width: 21.59cm;
					height: 27.94cm;
					font-size:100pt;
				}
				p{
					font-size:30px;
				}
				/*.container {background:none;}*/
				/*hr {background:#ccc;color:#ccc;width:100%;height:2px;margin:2em 0;padding:0;border:none;}
				hr.space {background:#fff;color:#fff;visibility:hidden;}
				h1, h2, h3, h4, h5, h6 {font-family:"Helvetica Neue", Arial, "Lucida Grande", sans-serif;}
				code {font:.9em "Courier New", Monaco, Courier, monospace;}
				a img {border:none;}
				p img.top {margin-top:0;}
				blockquote {margin:1.5em;padding:1em;font-style:italic;font-size:.9em;}
				.small {font-size:.9em;}
				.large {font-size:1.1em;}
				.quiet {color:#999;}
				.hide {display:none;}
				a:link, a:visited {background:transparent;font-weight:700;text-decoration:underline;}
				a:link:after, a:visited:after {content:" (" attr(href) ")";font-size:90%;}

				@media print{
					body{
						content:url("images/hoja_menbrete-2-01.jpg");
						overflow: hidden;
					}
				}

				body
				{*/
					/*background-image: url("images/hoja_menbrete-2-01.jpg");*/
				/*}*/
			</style>

<div style="background-image: url(images/menbrete1.jpg); background-repeat: no-repeat;height:100%; width:100%">			
		
<p>Texto antes del Contrato</p>

<?php
	/*Detalle de Presupuesto*/
?>
<!-- <img src="images/hoja_menbrete-2-01.jpg" alt="" style="position:absolute;z-index:0;"> -->

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
			
			foreach($detalleContrato as $detalle_contrato){ 
		?>
		<tr class="info">
			<td><?php echo $detalle_contrato->cantidad; ?></td>
			<td><?php echo $detalle_contrato->lineaServicio->nombre; ?></td>
			<td><?php echo number_format($detalle_contrato->total, 2, '.', ''); ?></td>
		</tr>
		<?php } ?>
	</table>

	<br>
	<?php echo $elContrato->total; ?>
	</div>