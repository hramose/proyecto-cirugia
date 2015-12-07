<?php
/* @var $this PacienteMovimientosController */
/* @var $model PacienteMovimientos */

$this->menu=array(
	//array('label'=>'List PacienteMovimientos', 'url'=>array('index')),
	//array('label'=>'Create PacienteMovimientos', 'url'=>array('create')),
	//array('label'=>'Update PacienteMovimientos', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete PacienteMovimientos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Bucar Movimiento', 'url'=>array('admin')),
);
?>

<h1>Movimiento #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span5 text-center">
		<br>
		<img class="img" src="images/movimientos.png"/>
		<br>
		<a href="index.php?r=pacienteMovimientos/viewCaja&id=<?php echo $model->paciente_id;?>" class="btn btn-mini btn-success"><i class="icon-user icon-white"></i> Ver Caja de Paciente</a>
	</div>
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'paciente.nombreCompleto',
			'valor',
			'tipo',
			'sub_tipo',
			'descripcion',
			'comentario',
			'contrato_id',
			array('name'=>'usuario_id', 'value'=>$model->personal->nombreCompleto),
			array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$model->fecha),''),
		),
	)); ?>	
	</div>
</div>
