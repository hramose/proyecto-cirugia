<?php
/* @var $this ContratosController */
/* @var $model Contratos */

$this->menu=array(
	//array('label'=>'Listar Contrato', 'url'=>array('index')),
	//array('label'=>'Actualizar Contrato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Contratos', 'url'=>array('admin')),
);

//Variables
$valorRealizados = 0;
$texto_liquidar = "";

//Calculo de Edad
?>

<h1>Ver Contrato #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span2"></div>
	<div class="span3 text-center">
		<img  src="images/manos.png"/>
		<a class="btn btn-warning" href='index.php?r=paciente/view&id=<?php echo $model->paciente_id;?>'><i class="icon-search icon-white"></i> Ficha de Paciente</a>
		<br>
		<?php 
			if ($model->estado == "Completado") {
				echo "<br><div class='text-center'>";
				echo "<p><b>Completo el Contrato</b></p>";
				echo $model->usuarioCompleto->nombreCompleto;
				echo "<br><br><p><b>Fecha en que se Completo</b></p>";
				echo Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$model->fecha_completo);
				echo "</div>";
			}
		?>
	</div>

	<div class="span7">
		<?php 

		if ($model->fecha!='') {
			$fecha=date('d-m-Y',strtotime($model->fecha));
		}else{$fecha=null;}


		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'presupuesto_id',
				'paciente.nombreCompleto',
				array('name'=>'Cedula', 'value'=>$model->paciente->n_identificacion, ''),
				array('name'=>'Dirección', 'value'=>$model->paciente->direccion, ''),
				array('name'=>'Celular', 'value'=>$model->paciente->celular, ''),
				'estado',
				array('name'=>'fecha', 'value'=>$fecha,''),
				array('name'=>'total', 'value'=>'$ '.number_format($model->total,2),''),
				array('name'=>'Elaborado por', 'value'=>$model->usuario->nombreCompleto),
				array('name'=>'Vendido por:', 'value'=>$model->vendedor->nombreCompleto,''),
				'observaciones',
			),
		));
		if ($model->estado == "Anulado") 
		{
			echo "<h4>Observaciones de Anulado</h4>";
			echo $model->observacion_anular;
		}

		?>

	</div>
</div>

<div class="row">
	<div class="span10">
	</div>
</div>
<?php 
//Consultar Detalle de presupuesto
$detalleContrato = ContratoDetalle::model()->findAll("contrato_id = $model->id");
$losRealizados = 0;
$valor_sindescuento = 0;
$tratamiento_programado = 0;
$tratamiento_realizado = 0;
if (count($detalleContrato)>0) {
		?>
		
		<div class="row">
			
			<div class="span12">
				<h2 class="text-center">Detalle del Contrato</h2>
				<table class="table table-striped">
					<tr>
						<th><small>Cantidad</small></th>
						<th><small>Linea de Servicio</small></th>
						<th><small>Valor sin descuento</small></th>
						<th><small>Descuento (%)</small></th>
						<th><small>Valor con descuento</small></th>
						<th><small>Valor Total sin descuento</small></th>
						<th><small>Valor Total con descuento</small></th>
						<th><small>Total</small></th>
						<th><small>Estado</small></th>
						<th><small></small></th>
					</tr>
				<?php 
					foreach ($detalleContrato as $detalle_contrato) 
					{
						//Suma de valor total sin descuento
						$valor_sindescuento = $valor_sindescuento + $detalle_contrato->vt_sin_desc;
						$losRealizados = $losRealizados + $detalle_contrato->realizadas;
						$tratamiento_programado = $tratamiento_programado + $detalle_contrato->cantidad;
						$tratamiento_realizado = $tratamiento_realizado + $detalle_contrato->realizadas;

				?>
					<tr>
						<td><?php echo $detalle_contrato->cantidad ." / ".$detalle_contrato->realizadas; ?></td>
						<td><?php echo $detalle_contrato->lineaServicio->nombre; ?></td>
						<td><?php echo '$ '.number_format($detalle_contrato->vu,2); ?></td>
						<td><?php echo '% '.$detalle_contrato->desc; ?></td>
						<td><?php echo '$ '.number_format($detalle_contrato->vu_desc,2); ?></td>
						<td><?php echo '$ '.number_format($detalle_contrato->vt_sin_desc,2); ?></td>
						<td><?php echo '$ '.number_format($detalle_contrato->vt_con_desc,2); ?></td>
						<td><?php echo '$ '.number_format($detalle_contrato->total,2); ?></td>
						<td><?php echo $detalle_contrato->estado; ?></td>
						<td>
						<?php 
							if ($model->estado != "Activo") 
							{
						?>
							
						<?php 
							}
						?>
					</tr>
				<?php
					//Calculo de valor de tratamientos realizados
					$valorRealizados = $valorRealizados + (($detalle_contrato->total / $detalle_contrato->cantidad) * $detalle_contrato->realizadas);
					}
				?>					
				</table>
			</div>
		</div>

		<?php
	}
?>

<!-- Botones de opción -->
<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php 
			if ($model->estado == "Sin Confirmar") 
			{
				?>
					<a href="#aprobar" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-ok-sign icon-white"></i> Aprobar Contrato</a>
					<a href="#modificar" role="button" class="btn btn-primary" data-toggle="modal"><i class="icon-ok-sign icon-white"></i> Modificar</a>
				<?php
			} 
		?>

		<?php 
			if ($model->estado == "Activo") 
			{
				$this->widget('ext.popup.JPopupWindow', array( 
				'tagName'=>'button',
				'content'=> '<i class="icon-file icon-white"></i> Imprimir ', 
				'url'=>array('contratos/contratos', 'id'=>$model->id),
				/*'url'=>array('/site/contact'), */
				'htmlOptions'=>array('class'=>'btn btn-primary btn-small'),
				'options'=>array( 
				'height'=>700, 
				'width'=>800, 
				'top'=>50, 
				'left'=>50, 
				), 
				)); 

				if ($model->saldo > 0) 
				{
				?>
				<a href="index.php?r=Ingresos/create&idPaciente=<?php echo $model->paciente_id; ?>&idContrato=<?php echo $model->id; ?>" class="btn btn-small btn-inverse"><i class="icon-hdd icon-white"></i> Generar Ingreso</a>
				<?php
				}
			}

			//Generar Ingreso cuando esta liquidado.
			if ($model->estado == "Liquidado" and $model->saldo > 0) {
			 	?>
					<a href="index.php?r=Ingresos/create&idPaciente=<?php echo $model->paciente_id; ?>&idContrato=<?php echo $model->id; ?>" class="btn btn-small btn-inverse"><i class="icon-hdd icon-white"></i> Generar Ingreso</a>
			 	<?php
			 } 
			 //Anular Contrato
			 if ($model->estado == "Activo" and ($model->saldo == $model->total) and $losRealizados == 0) 
			 {
			 	?>
				 	<a href="#anular" class="btn btn-small btn-info" data-toggle="modal"><i class="icon-download icon-white"></i> Anular Contrato</a>
			 	<?php
			 }
		?>
		<?php 
			if ($model->presupuesto_id != Null) 
			{
				$elPresupuesto = Presupuesto::model()->findByPk($model->presupuesto_id);
				?>
					<a href="#presupuesto" class="btn btn-small btn-warning" data-toggle="modal"><i class="icon-asterisk icon-white"></i> Ver Presupuesto</a>
				<?php
			}
			else
			{
				$elPresupuesto = Presupuesto::model()->findByPk(0);
			}
		?>		
	</div>

	<div class="span5">
	<?php 
	if ($model->estado == "Activo") 
	{
		?>
		<?php 
			if(($valorRealizados == $model->total) and ($model->saldo == 0) and ($tratamiento_programado == $tratamiento_realizado)) 
			{
			?>
				<a href="index.php?r=contratos/completar&idContrato=<?php echo $model->id; ?>" class="btn btn-small btn-inverse"><i class="icon-ok-circle icon-white"></i> Completar Contrato</a>
			<?php	
			}
			else
			{
				?>
				<a href="#cancelar" role="button" class="btn btn-danger btn-small" data-toggle="modal"><i class="icon-ok-sign icon-white"></i> Liquidar Contrato</a>
				<?php
			}
		?>
			
		<?php if($tratamiento_programado != $tratamiento_realizado)
		{
		?>
			<a href="#cita" role="button" class="btn btn-small btn-success" data-toggle="modal"><i class="icon-calendar icon-white"></i> Agendar Cita</a>
		<?php } ?>
		<?php
	}
	?>
	</div>
	<div class="span1"></div>
</div>

<br>
<br>
<br>
<!-- Detalle de sesiones -->


<?php
	//Variables de calculo de tratamientos
	$tratamiendo_sindescuento = 0;
	$tratamiento_condescuento = 0; 
	$tratamientosRealizados = ContratosTratamientoRealizados::model()->findAll("contrato_id = $model->id");
	if ($tratamientosRealizados) {
?>

<h4 class="text-center">Detalle de Tratamientos Realizados</h4>
<table class="table table-striped">
	<tr>
		<th><small>Sesión</small></th>
		<th><small>Linea de Servicio</small></th>
		<th><small>Fecha y Hora</small></th>
		<th><small>Valor con Descuento</small></th>
		<th><small>Valor sin Descuento</small></th>
		<th><small>Realizado por</small></th>
	</tr>
	<?php 
	
	foreach ($tratamientosRealizados as $tratamientos_realizados) 
	{
		$preciosTratamiento = ContratoDetalle::model()->find("contrato_id = $tratamientos_realizados->contrato_id and linea_servicio_id = $tratamientos_realizados->linea_servicio_id");
		$tratamiendo_sindescuento = $tratamiendo_sindescuento + $preciosTratamiento->vu;
		$tratamiento_condescuento = $tratamiento_condescuento + $preciosTratamiento->vu_desc;
?>
	<tr>
		<td><?php echo $tratamientos_realizados->sesion . " / ".$preciosTratamiento->cantidad; ?></td>
		<td><?php echo $tratamientos_realizados->lineaServicio->nombre; ?></td>
		<td><?php echo $tratamientos_realizados->cita->fecha_accion; ?></td>
		<td><?php echo '$ '.number_format($preciosTratamiento->vu_desc,2); ?></td>
		<td><?php echo '$ '.number_format($preciosTratamiento->vu,2); ?></td>
		<td><?php echo $tratamientos_realizados->cita->personal->nombreCompleto; ?></td>
	</tr>
<?php
	}
}
?>	
</table>



<hr>
<?php $detalleNotaCredito = NotaCredito::model()->findAll("paciente_id = $model->paciente_id and contrato_asociado_id is NULL"); ?>
<?php if ($detalleNotaCredito): ?>
<!-- Notas de Crédito -->
<h4 class="text-center">Notas de Crédito Disponible sin Contrato Vinculado</h4>
<table class="table table-striped">
	<tr>
		<th><small>Valor</small></th>
		<th><small>Realizado por</small></th>
		<th><small>Fecha</small></th>
		<th></th>
	</tr>
<?php 
	foreach ($detalleNotaCredito as $detalle_notaCredito) 
	{
?>
	<tr>
		<td><?php echo '$ '.number_format($detalle_notaCredito->valor,2); ?></td>
		<td><?php echo $detalle_notaCredito->personal->nombreCompleto; ?></td>
		<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$detalle_notaCredito->fecha_hora); ?></td>
		<td>
			<?php if ($model->saldo > $detalle_notaCredito->valor){ ?>
				<a href="index.php?r=Contratos/vincularNota&idNota=<?php echo $detalle_notaCredito->id; ?>&idContrato=<?php echo $model->id; ?>" class="btn btn-mini btn-warning"><i class="icon-random icon-white"></i> Vincular</a>	
				<!-- <a href="index.php?r=Ingresos/create&idPaciente=<?php //echo $model->paciente_id; ?>&idContrato=<?php //echo $model->id; ?>" class="btn btn-mini btn-warning"><i class="icon-random icon-white"></i> Vincular</a>	 -->
			<?php }else{?>
				<small>Supera saldo de contrato</small>
			<?php } ?>
			
		</td>
	</tr>
<?php
	}
?>					
</table>
<?php endif ?>

<hr>
<?php $detalleIngresos = Ingresos::model()->findAll("paciente_id = $model->paciente_id and contrato_id is NULL and cita_id is NULL and estado ='Activo'"); ?>
<?php if ($detalleIngresos): ?>
<!-- Ingresos sin contratos -->
<h4 class="text-center">Ingresos Disponible sin Contrato Vinculado</h4>
<table class="table table-striped">
	<tr>
		<th><small>Valor</small></th>
		<th><small>Forma de Pago</small></th>
		<th><small>Descripción</small></th>
		<th><small>Realizado por</small></th>
		<th><small>Fecha</small></th>
		<th></th>
	</tr>
<?php 
	foreach ($detalleIngresos as $detalle_ingreso) 
	{
?>
	<tr>
		<td><?php echo '$ '.number_format($detalle_ingreso->valor,2); ?></td>
		<td><?php echo $detalle_ingreso->forma_pago; ?></td>
		<td><?php echo $detalle_ingreso->descripcion; ?></td>
		<td><?php echo $detalle_ingreso->personal->nombreCompleto; ?></td>
		<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$detalle_ingreso->fecha); ?></td>
		<td>
			<?php if ($model->saldo >= $detalle_ingreso->valor){ ?>
				<a href="index.php?r=Contratos/vincular&idIngreso=<?php echo $detalle_ingreso->id; ?>&idContrato=<?php echo $model->id; ?>" class="btn btn-mini btn-warning"><i class="icon-random icon-white"></i> Vincular</a>	
				<!-- <a href="index.php?r=Ingresos/create&idPaciente=<?php //echo $model->paciente_id; ?>&idContrato=<?php //echo $model->id; ?>" class="btn btn-mini btn-warning"><i class="icon-random icon-white"></i> Vincular</a>	 -->
			<?php }else{?>
				<small>Supera saldo de contrato</small>
			<?php } ?>
			
		</td>
	</tr>
<?php
	}
?>					
</table>
<?php endif ?>
<hr>

<div class="row">
	<div class="span6">
		<h4 class="text-center">Detalle de Movimientos de Contrato</h4>
		<div class="span5">
			<h4 class="text-center">Total de Contrato</h4>
			<h4 class="text-center text-info">$ <?php echo number_format($model->total,2); ?></h4>
		</div>
		<div class="span5">
			<h4 class="text-center">Saldo Pendiente</h4>
			<h4 class="text-center text-error">$ <?php echo number_format($model->saldo,2); ?></h4>
		</div>
		<div class="row">
			<div class="span1"></div>
			<div class="span11">
				<table class="table table-striped">
					<tr>
						<th><small>Valor</small></th>
						<th><small>Forma de Pago</small></th>
						<th><small>Fecha</small></th>
						<th><small>Responsable</small></th>
					</tr>
				<?php 
					$detalleIngresos = Ingresos::model()->findAll("contrato_id = $model->id");
					foreach ($detalleIngresos as $detalle_ingreso) 
					{
				?>
					<tr>
						<td><?php echo '$ '.number_format($detalle_ingreso->valor,2); ?></td>
						<td><?php echo $detalle_ingreso->forma_pago; ?></td>
						<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$detalle_ingreso->fecha); ?></td>
						<td><?php echo $detalle_ingreso->personal->nombreCompleto; ?></td>
					</tr>
				<?php
					}
				?>					
				</table>
			</div>
		</div>
	</div>

<?php
	//Suma de deuda
	$sumaDeuda = 0;
	$numCotratos = 0;
	$totalDeuda = Contratos::model()->findAll("paciente_id = $model->paciente_id and estado = 'Activo'");
	foreach ($totalDeuda as $total_deuda)
	{
		$sumaDeuda = $sumaDeuda + $total_deuda->saldo;
		$numCotratos = $numCotratos + 1;
	}

	//Saldo a favor
	if ($model->saldo == 0) 
	{
		if ($model->estado == "Liquidado") 
		{
			$saldo_favor = 0;
		}
		else
		{
			$saldo_favor = ($model->total - $model->saldo)-$tratamiento_condescuento;	
		}
		
	}
	else
	{
		if ($model->saldo == $model->total) 
		{
			if ($model->descuento == "Si") {
				$saldo_favor = $tratamiento_condescuento *-1;
			}
			else
			{
				$saldo_favor = $tratamiendo_sindescuento *-1;
			}
			
		}
		else
		{
			if ($model->descuento == "Si") {
				$saldo_favor = ($model->total - $model->saldo)-$tratamiento_condescuento;
			}
			else
			{
				$saldo_favor = ($model->total - $model->saldo)-$tratamiendo_sindescuento;
			}
			
		}
	}

	//Para Liquidar Contrato
	if ($model->descuento == "Si") {
				$saldo_liquidar = ($model->total - $model->saldo)-$tratamiento_condescuento;
			}
			else
			{
				$saldo_liquidar = ($model->total - $model->saldo)-$tratamiendo_sindescuento;
			}
	
	if ($saldo_liquidar < 0) {
		$mostrarBoton = 1;
		//$saldo_liquidar = ($saldo_liquidar * -1);
		$texto_liquidar = "El cliente pasara a Cuentas por Cobrar con un saldo de <b>$". number_format($saldo_liquidar,2)."</b>";
	}
	if ($saldo_liquidar > 0) {
		$texto_liquidar = "El cliente posee saldo a favor. Se creara nota de crédito con un saldo de <b>$". number_format($saldo_liquidar,2)."</b>";
	}

?>

	<div class="span6">
		<h4 class="text-center">Estado de Cuenta de Paciente</h4>
		<br>
		<h5>Total de Contrato sin Descuento: <span class="muted">$ <?php echo number_format($valor_sindescuento,2); ?></span></h5>
		<h5>Total de procedimientos realizados sin descuento: <span class="text-success">$ <?php echo number_format($tratamiendo_sindescuento,2); ?></span></h5>
		<h5>Total de procedimientos realizados con descuento: <span class="text-success">$ <?php echo number_format($valorRealizados,2); ?></span></h5>
		<h5>Total de ingresos a contrato: <span class="text-warning">$ <?php echo number_format($model->total - $model->saldo,2); ?></span></h5>
		<h5>Saldo a favor: <?php if($saldo_favor < 0) { ?>
				<span class="text-error">$ <?php echo number_format($saldo_favor,2); ?></span></h5>
				<?php } else{ ?>
				<span class="text-info">$ <?php echo number_format($saldo_favor,2); ?></span></h5>
				<?php } ?>

		<hr>
		<h5>Total de deuda a la clinica: <span class="text-info">$ <?php echo number_format($sumaDeuda,2); ?></span></h5>
		<h5>Contratos activos: <span class="text-warning"><?php echo $numCotratos; ?></span></h5>
	</div>		
		
</div>

<div class="row">
	<div class="span4"></div>
	<div class="span5">
		
	</div>
	<div class="span3"></div>
</div>





<!-- Modal Contrato de Servicio -->
<div id="aprobar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Aprobar Contrato de Servicio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Desea generar un Contrato de Servicio y activarlo?</p>
 	<center>
	 	<?php echo CHtml::submitButton('SI', array('submit'=>array('contratos/aprobarContratos&idContrato='.$model->id), 'class'=>'btn btn-large btn-primary')); ?>
	 	<?php echo CHtml::submitButton('NO', array('submit'=>array('contratos/create&idPaciente='.$model->paciente->id), 'class'=>'btn btn-large')); ?>
	</center>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Modal Contrato de Servicio -->
<div id="Nocancelar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Liquidar Contrato de Servicio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<!-- <p>Desea cancelar Contrato de Servicio y activarlo?</p> -->




		<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'liquidacion-form',
		//'action'=>'/smadia/index.php?r=citas/calendario&idpersonal='.$los_medicos->id_perfil.'&fecha=24-01-2015',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		)); ?>
	 	<?php 
	 		//$tabla_seguimiento = new SeguimientoComercial;
	 	?>

				<div class='span12'>
					<?php echo $form->labelEx($model,'saldo'); ?>
					<?php echo $form->textField($model,'saldo', array('class'=>'input-small', 'readOnly'=>'readOnly')); ?>
					<?php echo $form->error($model,'saldo'); ?>
				</div>
				<div class='span4'>
					<?php echo $form->labelEx($model,'descuento_liquidacion'); ?>
					<?php echo $form->textField($model,'descuento_liquidacion', array('class'=>'input-small')); ?>
					<?php echo $form->error($model,'descuento_liquidacion'); ?>
				</div>
				<div class='span4'>
					<?php echo $form->labelEx($model,'porcentaje_descuento_liquidacion'); ?>
					<?php echo $form->textField($model,'porcentaje_descuento_liquidacion', array('size'=>4,'maxlength'=>4, 'class'=>'input-mini')); ?>
					<?php echo $form->error($model,'porcentaje_descuento_liquidacion'); ?>
				</div>

				<div class='span12'>
					<?php echo $form->labelEx($model, 'Total a Pagar'); ?>
					<input type='text' class='input-small' placeholder='' name='total_pagar' id='total_pagar' readonly='readonly' value='<?php echo $model->saldo; ?>'>
				</div>

				<div class='span12'>
					<?php echo $form->labelEx($model,'observaciones_liquidacion'); ?>
					<?php echo $form->textArea($model,'observaciones_liquidacion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($model,'observaciones_liquidacion'); ?>
				</div>
	
				<div class = 'span6' >
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
					<button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
				</div>

		<?php $this->endWidget(); ?>
 	
 	
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Modal Modificar Contrato de Servicio -->
<div id="modificar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modificar Contrato de Servicio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Desea modificar contrato de servicio?</p>
 	<center>
	 	<?php echo CHtml::submitButton('SI', array('submit'=>array('contratos/update&id='.$model->id), 'class'=>'btn btn-large btn-primary')); ?>
	 	<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>
	</center>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Modal Cita Preguntar con quien -->
<div id="cita" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Profesional que Atenderá</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Seleccione el Profesional</p>
 	<center>
 		<?php
 		$elPersonal = Perfil::model()->findAll("Estado = 'Activo' and agenda = 'Si'");
 			foreach ($elPersonal as $el_personal) 
 			{
 			echo CHtml::submitButton($el_personal->nombre, array('submit'=>array('citas/calendario&idpaciente='.$model->paciente_id.'&idpersonal='.$el_personal->id), 'class'=>'btn btn-success'));

			}	 		
	 	?>

	</center>
  </div>  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Modal Contrato de Servicio -->
<div id="cancelar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Liquidar Contrato de Servicio</h3>
	</div>
	<div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<!-- <p>Desea cancelar Contrato de Servicio y activarlo?</p> -->
	
	<!-- Evaluar politicas de cancelación -->
 	<p>Se dispone a liquidar el contrato.<?php echo $texto_liquidar; ?></p>
 	<p><strong>¿Desea liquidar el monto total o realizar descuento?</strong></p>
 	<h4 class="text-center">Saldo a favor:  <span class="text-info">$<?php echo number_format($saldo_liquidar,2); ?></h4>
 	<center>
	 	<?php echo CHtml::submitButton('Descuento', array('submit'=>array('contratos/update&id='.$model->id.'&liquidar=1'), 'class'=>'btn btn-large btn-primary')); ?>
	 	<?php echo CHtml::submitButton('Liquidar', array('submit'=>array('contratos/liquidar&id='.$model->id), 'class'=>'btn btn-large')); ?>
	</center>
 	
 	
 	</div>
  
	<div class="modal-footer">
		<!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
	</div>
</div>

<!-- Anular Contrato -->
<div id="anular1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Anular Contrato de Servicio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<!-- <p>Desea cancelar Contrato de Servicio y activarlo?</p> -->

	<!-- Evaluar politicas de cancelación -->
 	<p>Se dispone a anular el contrato. Si se anula este contrato ya no estará disponible.<?php echo $texto_liquidar; ?></p>
 	<p><strong>¿Desea anular este contrato?</strong></p>
 	<center>
	 	<?php echo CHtml::submitButton('Si', array('submit'=>array('contratos/anular&id='.$model->id.'&liquidar=1'), 'class'=>'btn btn-large btn-primary')); ?>
	 	<button type="button" class="btn btn-danger btn-large" data-dismiss="modal" aria-hidden="true">No</button>
	</center>
 	
 	
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<!-- Ver Presupuesto -->
<div id="presupuesto" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Presupuesto original</h3>
  </div>
  <div class="modal-body">
 	<p>Estos son los detalles del presupuesto original de este contrato.</p> 	
 	<br>
		<?php 
			if ($elPresupuesto) {
				?>
					<p><b>Fecha de Registro: </b><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$elPresupuesto->fecha); ?></p>
					<p><b>Observaciones: </b><?php echo $elPresupuesto->observaciones ?></p>
					<br>
					<?php
					$detallePresupuesto = PresupuestoDetalle::model()->findAll("presupuesto_id = $elPresupuesto->id");
					if (count($detallePresupuesto)>0) {
							?>
							
							
								<div class="span12">
									<h2 class="text-center">Detalle del Presupuesto</h2>
									<table class="table table-striped">
										<tr>
											<th><small>Can.</small></th>
											<th><small>Linea</small></th>
											<th><small>Val. Unit.</small></th>
											<th><small>Desc. (%)</small></th>
											<th><small>Val. Unit. con desc.</small></th>
											<th><small>Val. Total sin desc.</small></th>
											<th><small>Val. Total con desc.</small></th>
											<th><small>Total</small></th>
										</tr>
									<?php 
										foreach ($detallePresupuesto as $detalle_presupuesto) 
										{
									?>
										<tr>
											<td><small><?php echo $detalle_presupuesto->cantidad; ?></small></td>
											<td><small><?php echo $detalle_presupuesto->lineaServicio->nombre; ?></small></td>
											<td><small><?php echo '$ '.number_format($detalle_presupuesto->vu,2); ?></small></td>
											<td><small><?php echo $detalle_presupuesto->desc; ?></small></td>
											<td><small><?php echo '$ '.number_format($detalle_presupuesto->vu_desc,2); ?></small></td>
											<td><small><?php echo '$ '.number_format($detalle_presupuesto->vt_sin_desc,2); ?></small></td>
											<td><small><?php echo '$ '.number_format($detalle_presupuesto->vt_con_desc,2); ?></small></td>
											<td><small><?php echo '$ '.number_format($detalle_presupuesto->total,2); ?></small></td>						
										</tr>
									<?php
										}
									?>					
									</table>
								</div>

							<?php
						}
					?>
				<?php
			}
		?>

  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Cancelar Contrato -->
<div id="anular" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel2">Anular Contrato</h3>
    <p>Se dispone a anular el contrato. Si se anula este contrato ya no estará disponible.<?php echo $texto_liquidar; ?></p>
  </div>
	<div class="modal-body text-center">
    	 	<h4>Para esta acción es necesario la clave de autorización</h4>
    	 	<?php 
			 	$form=$this->beginWidget('CActiveForm', array(
				'id'=>'seguimiento-comercial-form',
				'action'=>'index.php?r=contratos/anular&id='.$model->id.'&liquidar=1',
				// Please note: When you enable ajax validation, make sure the corresponding			
				// controller action is handling ajax validation correctly.								
				// There is a call to performAjaxValidation() commented in generated controller code.	
				// See class documentation of CActiveForm for details on this.							
				'enableAjaxValidation'=>true,
			)); ?>
	    	 	<div class="input-prepend">
	    	 	<span class="controls">
					<label><b>Observación de Anulación</b></label>
	    	 		<textarea name="observacion_anular" id="observacion_anular" cols="60" rows="5"></textarea>
	    	 		<br><br>

	    	 		<span class="add-on"><i class="icon-lock"></i></span>
	    	 		<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
					<br><br>
	    	 	</span>
	    	 		<button class="btn btn-primary" type="submit">Proceder</button>
	    	 	</div>
    	 	<?php $this->endWidget(); ?>
    </div>
 	
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php 
// 	 	if ($model->saldo == $model->total) 
// 	 	{
// 	 		?>
 				<!-- <p class="text-error"><b>No se a realizado ningun abono a esta cuenta por lo que debe de cancelar el monto total del contrato.</b></p>
// 				<h4 class="text-center"><b>$ <?php //echo $model->saldo; ?></b></h4>
// 			 	<center>
// 				 	<?php //echo CHtml::submitButton('SI', array('submit'=>array('Ingresos/create&idPaciente='.$model->paciente_id.'&idContrato='.$model->id.'&tipo=C'), 'class'=>'btn btn-large btn-primary')); ?>
// 				 	<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>
// 				</center> -->
 	 		<?php
// 	 	} 
// 	 	else
// 	 	{
// 	 		?>
 				<!-- <p><b>Se procedera a liquidar el contrato.</b></p>
// 			 	<center>
// 				 	<?php //echo CHtml::submitButton('SI', array('submit'=>array('contratos/view&id='.$model->id), 'class'=>'btn btn-large btn-primary')); ?>
// 				 	<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>
// 				</center> -->
 	 		<?php
// 	 	}

//  	?>

<script type="text/javascript">
	$("#Contratos_descuento_liquidacion").keyup(function (){
		//$$$$$$$$$$$$$
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    var valor_monetario = (($("#Contratos_descuento_liquidacion").val() * 100)/$("#Contratos_saldo").val());
	    $("#Contratos_porcentaje_descuento_liquidacion").val(valor_monetario);
	    $("#total_pagar").val($("#Contratos_saldo").val()-($("#Contratos_descuento_liquidacion").val()));
	});

	$("#Contratos_porcentaje_descuento_liquidacion").keyup(function (){
		//%%%%%%%%%%%%%
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    var valor_porcentaje = ($("#Contratos_saldo").val()*($("#Contratos_porcentaje_descuento_liquidacion").val() / 100));
	    $("#Contratos_descuento_liquidacion").val(valor_porcentaje);
	    $("#total_pagar").val($("#Contratos_saldo").val()-valor_porcentaje);

	});
</script>

<?php 
//Esta es una locura
	// $losContratos = Contratos::model()->findAll("saldo_favor = 0");
	// foreach ($losContratos as $los_contratos) 
	// {
	// 	$tratamiento_condescuentoTodos = 0;
	// 	$tratamiendo_sindescuentoTodos = 0;
	// 	$tratamientosRealizadosTodos = ContratosTratamientoRealizados::model()->findAll("contrato_id = $los_contratos->id");
		
	// 	foreach ($tratamientosRealizadosTodos as $tratamientos_realizadosTodos) 
	// 	{
	// 		$preciosTratamiento = ContratoDetalle::model()->find("contrato_id = $tratamientos_realizadosTodos->contrato_id and linea_servicio_id = $tratamientos_realizadosTodos->linea_servicio_id");
	// 		$tratamiento_condescuentoTodos = $tratamiento_condescuentoTodos + $preciosTratamiento->vu_desc;
	// 		$tratamiendo_sindescuentoTodos = $tratamiendo_sindescuentoTodos + $preciosTratamiento->vu;
	// 	}


	// 	//Saldo a favor
	// 		if ($los_contratos->saldo == 0) 
	// 		{
	// 			if ($los_contratos->estado == "Liquidado") 
	// 			{
	// 				$saldo_favorTodos = 0;
	// 			}
	// 			else
	// 			{
	// 				$saldo_favorTodos = ($los_contratos->total - $model->saldo)-$tratamiento_condescuentoTodos;	
	// 			}
				
	// 		}
	// 		else
	// 		{
	// 			if ($los_contratos->saldo == $los_contratos->total) 
	// 			{
	// 				if ($los_contratos->descuento == "Si") {
	// 					$saldo_favorTodos = $tratamiento_condescuentoTodos *-1;
	// 				}
	// 				else
	// 				{
	// 					$saldo_favorTodos = $tratamiendo_sindescuentoTodos *-1;
	// 				}
					
	// 			}
	// 			else
	// 			{
	// 				if ($los_contratos->descuento == "Si") {
	// 					$saldo_favorTodos = ($los_contratos->total - $los_contratos->saldo)-$tratamiento_condescuentoTodos;
	// 				}
	// 				else
	// 				{
	// 					$saldo_favorTodos = ($los_contratos->total - $los_contratos->saldo)-$tratamiendo_sindescuentoTodos;
	// 				}
					
	// 			}
	// 		}

	// 		$los_contratos->saldo_favor = $saldo_favorTodos;
	// 		$los_contratos->update();

	// }

?>