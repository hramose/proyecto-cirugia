<?php
/* @var $this PagoCosmetologasController */
/* @var $model PagoCosmetologas */

$this->menu=array(
	// array('label'=>'List PagoCosmetologas', 'url'=>array('index')),
	// array('label'=>'Create PagoCosmetologas', 'url'=>array('create')),
	// array('label'=>'Update PagoCosmetologas', 'url'=>array('update', 'id'=>$model->id)),
	// array('label'=>'Delete PagoCosmetologas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Pago', 'url'=>array('admin')),
);
?>

<h1>Pago a Cosmetologas #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Paciente', 'value'=>$model->paciente->nombreCompleto),
				'n_identificacion',
				array('name'=>'Cosmetologa', 'value'=>$model->personal->nombreCompleto),
				array('name'=>'Tratamiento Realizado', 'value'=>$model->lineaServicio->nombre),
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy H:m:s",$model->fecha)),
				'valor_comision',
				'valor_tratamiento',
				array('name'=>'Vendedor', 'value'=>$model->vendedor->nombreCompleto),
				array('name'=>'Establecio estado', 'value'=>$model->aprobo->nombreCompleto),
				'contrato.saldo',
			),
		)); ?>		
	</div>
	<div class="span6">
		<h4 class="text-center">Detalle de Trabajo Realizado</h4>
		<table class="table">
			<tr>
				<th>Tratamiento</th>
				<th>Sesión</th>
			</tr>
			<tr>
				<td><?php echo $model->cita->lineaServicio->nombre; ?></td>
				<td><?php echo $model->sesion; ?></td>
			</tr>
		</table>
		<?php 
		if ($model->cita->contrato_id != NULL) {
		?>
		<h4 class="text-center">Detalles de Contrato</h4>
		
		<table class="table">
			<tr>
				<th>Cantidad</th>
				<th>Tratamiento</th>
				<th>Total</th>
				<th>Estado</th>
			</tr>
			<?php 
				$detalleContrato = ContratoDetalle::model()->findAll("contrato_id =".$model->cita->contrato_id);
				foreach ($detalleContrato as $detalle_contrato) 
				{
				?>
				<tr>
					<td><?php echo $detalle_contrato->cantidad ." / ".$detalle_contrato->realizadas; ?></td>
					<td><?php echo $detalle_contrato->lineaServicio->nombre; ?></td>
					<td><?php echo '$ '.number_format($detalle_contrato->total,2); ?></td>
					<td><?php echo $detalle_contrato->estado; ?></td>
				</tr>
				<?php
					}
				?>
		</table>
		<?php 
		}	
			else
		{
			?>
				<h4 class="text-center">No Hay contrato asociado</h4>
			<?php
		}
		?>
		
		

	</div>

</div>

