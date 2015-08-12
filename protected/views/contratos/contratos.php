<?php 
	
	//Detalles
	$numContratos = $_GET['id'];
	$elContrato = Contratos::model()->findByPk($numContratos);
	$detalleContrato = ContratoDetalle::model()->findAll("contrato_id = $numContratos");
	//$elnumero = $laFactura->factura->numero;


?>

			<style type="text/css">
				#parrafo{
					padding: 0px 80px 0px 0px;
				}
				
				#total{
					/*color:red;*/
					background: #A9A9A9;
				}
			</style>

<div style="background-image: url(images/hoja_menbrete-1.jpg); background-repeat: no-repeat; height:100%; width:100%; padding:0px 0px 0px 50px;">			
<!-- <div style="height:175px"></div> -->
<div style="padding:150px 0px 0px 0px;">
<h4>Contrato de Prestación de Servicios</h4>

<p id="parrafo">Yo <?php echo "  <b>".$elContrato->paciente->nombreCompleto."</b>  "; ?>  Identificado  con  CC   <?php echo "  <b>".$elContrato->paciente->n_identificacion."</b>  "; ?>  quien  en  adelante  seré  EL 
CONTRATANTE  y  SMADIA  CLINIC  S.A.S.  identificada  con  Nit  900.423.704-7,  quien  en  adelante  y 
para  efectos  del  presente  contrato  será  EL  CONTRATISTA,  suscribimos  el  siguiente  contrato  de 
Prestación de Servicio bajo las siguientes clausulas.</p>

<div style="width:700px">
			<small id="parrafo">PRIMERA:  EL  CONTRATISTA  me  ha  informado  que  sí,  y  solo  si  podre  dar  inicio  al  tratamiento 
			adquirido en el momento de haber pagado la totalidad del mismo.</small>
			<br><br>

			<small id="parrafo">SEGUNDA: EL CONTRATISTA me ha informado que en el caso en que yo decida no realizarme el 
			tratamiento, ya sea por una causa personal o por otra de cualquier índole, EL CONTRATISTA no 
			hará devolución del dinero dejado de consumir, solo me entregara un BONO por el valor dejado de 
			consumir que yo podré  utilizar en otros servicios que EL CONTRATISTA ofrezca, o podre regalar o 
			vender a un tercero este BONO para que sea utilizado, en un  término  no mayor a 2 años después 
			de adquirido el servicio.</small>
			<br><br>
			<small id="parrafo">TERCERA: Los descuentos que EL CONTRATISTA me ofrece en el momento de la compra, aplican si 
			y  solo  si  me  realizo  la  totalidad  del  tratamiento  adquirido,  en  caso  que  por  alguna  razón  EL 
			CONTRATANTE decida no continuar con el  tratamiento adquirido o desee cambiarlo por otro, las 
			sesiones realizadas del tratamiento iniciado se liquidaran a precio público sin descuento y el valor 
			restante se aplicara al nuevo tratamiento.</small>
			<br><br>
			<small id="parrafo">CUARTA: Para procedimientos de Mad Laser y/o Cirugias en las que se realiza una programacion previa, 
			el Paciente o CONTRATANTE debe llegar 20 minutos antes de la hora indicada, en caso de que el paciente llegue 30 minutos 
			despues de la hora establecida, se suspenderá la programacion del procedimiento y se reprogramara para otra fecha, como 
			consecuencia el paciente debe cancelar la suma de $300.000 Pesos correspondientes a gastos ocasionados por la reprogramacion 
			del servicio, que serán descontados del dinero abonado al procedimiento.</small>
			<br><br>
			<small id="parrafo">PARRAGRAFO 1: Los cambios de fecha de procedimientos de M.A.D. Laser y/o Cirugias, se deben realizar con 
			mínimo 72 horas hábiles de anticipación a la fecha programada, en caso contrario, el paciente o CONTRATANTE debe cancelar la 
			suma de $300.000 Pesos, que serán descontados del dinero abonado al mismo.</small>
</div>


<br>
<h5>Descripción de Tratamientos</h5>
<br>
	<table>
		<thead>
		<tr>
			<th width="35">Cant.</th>
			<th width="250">Linea de Servicio</th>
			<th width="100">Valor Unitario</th>
			<th width="50">Desc.</th>
			<th width="120">Valor con Desc.</th>
			<th width="100">Total</th>
			
		</tr>
		</thead>
		<?php
			
			foreach($detalleContrato as $detalle_contrato){ 
		?>
		<tr class="info">
			<td><?php echo $detalle_contrato->cantidad; ?></td>
			<td><?php echo $detalle_contrato->lineaServicio->nombre; ?></td>
			<td><?php echo '$ '.number_format($detalle_contrato->vu,2); ?></td>
			<td><?php echo '% '.$detalle_contrato->desc; ?></td>
			<td><?php echo '$ '.number_format($detalle_contrato->vt_con_desc,2); ?></td>
			<td id="total"><b><?php echo '$ '.number_format($detalle_contrato->total, 2, '.', ''); ?></b></td>
		</tr>
		<?php } ?>
	</table>

	<br>
	
	<p><b>Observaciones: </b><?php echo $elContrato->observaciones; ?></p>

	<br>
		<h4>El total de este contrato es de: $ <?php echo $elContrato->total; ?></h4>
		<br><br>
		<br><br>
		<br><br>
		<table>
			<tr>
				<td width="500">______________</td>
				<td width="0">________________</td>
			</tr>
			<tr>
				<td width="500">Firma Paciente</td>
				<td width="0">Firma Clinica</td>
			</tr>
			<tr>
				<td width="500">C.C: <?php echo $elContrato->paciente->n_identificacion; ?></td>
				<td width="0">NIT: 900.423.704-7</td>
			</tr>
		</table>
</div>
</div>





