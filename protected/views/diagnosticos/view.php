<?php
/* @var $this DiagnosticosController */
/* @var $model Diagnosticos */

$this->menu=array(
	array('label'=>'Listar Diagnostico', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico', 'url'=>array('create')),
	array('label'=>'Actualizar Diagnostico', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Diagnostico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Diagnostico', 'url'=>array('admin')),
);
?>

<h1>Diagnostico #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'diagnostico',
		'tipo',
	),
)); ?>
