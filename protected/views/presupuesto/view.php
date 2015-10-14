<?php
/* @var $this PresupuestoController */
/* @var $model Presupuesto */

// $this->menu=array(
// 	array('label'=>'Listar Presupuestos', 'url'=>array('index')),	
// 	array('label'=>'Buscar Presupuesto', 'url'=>array('admin')),
// );
?>

<h1>Presupuesto #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span7">
		<?php
		if ($model->fecha!='') {
				$fecha=date('d-m-Y',strtotime($model->fecha));
		}else{$fecha=null;}

		 $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'paciente.nombreCompleto',
				array('name'=>'Cedula', 'value'=>$model->paciente->n_identificacion, ''),
				array('name'=>'Dirección', 'value'=>$model->paciente->direccion, ''),
				array('name'=>'Celular', 'value'=>$model->paciente->celular, ''),
				array('name'=>'total', 'value'=>'$ '.number_format($model->total,2),''),
				array('name'=>'fecha', 'value'=>$fecha,''),
				'estado',
				array('name'=>'Elaborado por:', 'value'=>$model->elusuario->nombreCompleto,''),
				array('name'=>'Vendido por:', 'value'=>$model->vendedor->nombreCompleto,''),
				'adicionales',
				'observaciones',
			),
		)); ?>
	</div>
	<div class="span5">
		<a class="btn btn-warning" href='index.php?r=paciente/view&id=<?php echo $model->paciente_id;?>'>Ficha de Paciente</a>
	</div>
</div>


<?php 
//Consultar Detalle de presupuesto
$detallePresupuesto = PresupuestoDetalle::model()->findAll("presupuesto_id = $model->id");
if (count($detallePresupuesto)>0) {
		?>
		
		<div class="row">
			<div class="span11">
				<h2 class="text-center">Detalle del Presupuesto</h2>
				<table class="table table-striped">
					<tr>
						<th><small>Cantidad</small></th>
						<th><small>Linea de Servicio</small></th>
						<th><small>Valor Unitario</small></th>
						<th><small>Descuento (%)</small></th>
						<th><small>Valor Unitario con descuento</small></th>
						<th><small>Valor Total sin descuento</small></th>
						<th><small>Valor Total con descuento</small></th>
						<th><small>Total</small></th>
					</tr>
				<?php 
					foreach ($detallePresupuesto as $detalle_presupuesto) 
					{
				?>
					<tr>
						<td><?php echo $detalle_presupuesto->cantidad; ?></td>
						<td><?php echo $detalle_presupuesto->lineaServicio->nombre; ?></td>
						<td><?php echo '$ '.number_format($detalle_presupuesto->vu,2); ?></td>
						<td><?php echo $detalle_presupuesto->desc; ?></td>
						<td><?php echo '$ '.number_format($detalle_presupuesto->vu_desc,2); ?></td>
						<td><?php echo '$ '.number_format($detalle_presupuesto->vt_sin_desc,2); ?></td>
						<td><?php echo '$ '.number_format($detalle_presupuesto->vt_con_desc,2); ?></td>
						<td><?php echo '$ '.number_format($detalle_presupuesto->total,2); ?></td>						
					</tr>
				<?php
					}
				?>					
				</table>
			</div>
		</div>

		<?php
	}
?>

<div class="row">
	<div class="span6">
		<?php
		$this->widget('ext.popup.JPopupWindow', array( 
		'tagName'=>'button',
		'content'=> '<i class="icon-file icon-white"></i> Imprimir ', 
		'url'=>array('presupuesto/presupuesto', 'id'=>$model->id),
		/*'url'=>array('/site/contact'), */
		'htmlOptions'=>array('class'=>'btn btn-primary'),
		'options'=>array( 
		'height'=>700, 
		'width'=>800, 
		'top'=>50, 
		'left'=>50, 
		), 
		)); 
		?>
	</div>
	<div class="span6">
		<a href="#modificar" role="button" class="btn btn-primary" data-toggle="modal"><i class="icon-ok-sign icon-white"></i> Modificar Presupuesto de Servicio</a>
		<a href="#contrato" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-ok-sign icon-white"></i> Crear Contrato de Servicio</a>
	</div>
</div>


<!-- Modal Modificar Presupuesto de Servicio -->
<div id="modificar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modificar Presupuesto de Servicio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Desea modificar presupuesto de servicio?</p>
 	<center>
	 	<?php echo CHtml::submitButton('SI', array('submit'=>array('presupuesto/update&id='.$model->id), 'class'=>'btn btn-large btn-primary')); ?>
	 	<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>
	</center>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>



<!-- Modal Contrato de Servicio -->
<div id="contrato" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Se dispone a realizar un Contrato de Servicio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Desea generar un Contrato de Servicio en base a este presupuesto?</p>
 	<center>
	 	<?php echo CHtml::submitButton('SI', array('submit'=>array('contratos/guardarContratos&idpresupuesto='.$model->id), 'class'=>'btn btn-large btn-primary')); ?>
	 	<?php echo CHtml::submitButton('NO', array('submit'=>array('contratos/create&idPaciente='.$model->paciente->id), 'class'=>'btn btn-large')); ?>
	</center>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>