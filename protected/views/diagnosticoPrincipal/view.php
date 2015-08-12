<?php
/* @var $this DiagnosticoPrincipalController */
/* @var $model DiagnosticoPrincipal */

$this->menu=array(
	array('label'=>'Listar Diagnosticos Principales', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico Principal', 'url'=>array('create')),
	array('label'=>'Actualizar Diagnostico Principal', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete DiagnosticoPrincipal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Diagnostico Principal', 'url'=>array('admin')),
);
?>

<h1>Diagnostico Principal #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'diagnostico',
	),
)); ?>
