<?php
/* @var $this DiagnosticoRelacionadoController */
/* @var $model DiagnosticoRelacionado */

$this->menu=array(
	array('label'=>'Listar Diagnosticos Relacionados', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico Relacionado', 'url'=>array('create')),
	array('label'=>'Actualizar Diagnostico Relacionado', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete DiagnosticoRelacionado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Diagnosticos Relacionados', 'url'=>array('admin')),
);
?>

<h1>Diagnostico Relacionado #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'diagnostico',
	),
)); ?>
