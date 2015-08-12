<?php
/* @var $this NotaCreditoController */
/* @var $model NotaCredito */

$this->menu=array(
	// array('label'=>'List NotaCredito', 'url'=>array('index')),
	// array('label'=>'Create NotaCredito', 'url'=>array('create')),
	// array('label'=>'Update NotaCredito', 'url'=>array('update', 'id'=>$model->id)),
	// array('label'=>'Delete NotaCredito', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Nota de Crédito', 'url'=>array('admin')),
);
?>

<h1>Nota de Crédito #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name'=>'Nombre', 'value'=>$model->paciente->nombreCompleto,''),
		'n_identificacion',
		'contrato_id',
		array('name'=>'Valor', 'value'=>"$ ".number_format($model->valor,2),''),
		array('name'=>'Fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha)),
		array('name'=>'Registrado por', 'value'=>$model->personal->nombreCompleto,''),
	),
)); ?>
