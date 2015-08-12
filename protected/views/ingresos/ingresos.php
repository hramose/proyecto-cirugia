<?php 
	
	//Detalles
	$numIngresos = $_GET['id'];
	$elIngresos = Ingresos::model()->findByPk($numIngresos);


?>

			<style type="text/css">
			p{
				margin: 2px 0px;
			}
				
			</style>

<body>
	<p>SMADIA CLINIC S.A.S</p>
	<br>
	<p>NIT: 900-423-704-7</p>
	<p>CALLE 87 N° 47 - 47</p>
	<p>PBX: 3177190</p>
	<p>RES. 20000160110 del 2013/10/23 del 1 al 2000</p>
	<br>
	<p>FACTURA N°: <?php echo $elIngresos->id; ?></p>
	<p>FECHA: <?php echo $elIngresos->fecha; ?></p>
	<p>HORA: <?php echo $elIngresos->fecha; ?></p>
	<p>LE ATENDIO: <?php echo $elIngresos->personal->nombreCompleto; ?></p>
	<br>
	<p>DATOS DEL CLIENTE</p>
	<p>NOMBRE: <?php echo $elIngresos->paciente->nombreCompleto; ?></p>
	<p>NIT/CC: <?php echo $elIngresos->paciente->n_identificacion; ?></p>
	<p>CELULAR: <?php echo $elIngresos->paciente->celular; ?></p>
	<br><br>
	<p>DATOS DE LA VENTA</p>
	<p>F. DE PAGO: <?php echo $elIngresos->forma_pago; ?></p>
	<p>VALOR: $<?php echo $elIngresos->valor;  ?></p>
	<br><br>
	<p>DESCRIPCION:</p>
	<div style="width:200px">
		<p><?php echo $elIngresos->descripcion; ?></p>	
	</div>
	<br><br><br>
	<p>Apreciable cliente SMADIA CLINIC S.A.S</p>
	<p>no realizara devolución del dinero recibido</p>
	<p>por prestación de servicios o tratamientos</p>
	<p>adquiridos, en caso de ser solicitado el</p>
	<p>reenbolso se le entregara un bono equivalente</p>
	<p>al valor correspondiente que podrá utilizar</p>
	<p>en cualquiera de nuestros tratamientos.</p>

</body>