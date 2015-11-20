<?php
/* @var $this PersonalTareasController */
/* @var $model PersonalTareas */

$this->menu=array(
	array('label'=>'Crear Tarea', 'url'=>array('create')),
	array('label'=>'Actualizar Tarea', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Tarea', 'url'=>array('admin')),
);
?>

<h1>Tarea #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name'=>'personal_id', 'value'=>$model->personal->nombreCompleto),
		'tarea',
		array('name'=>'fecha_cumplir', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy", $model->fecha_cumplir)),
		'estado',
		array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss", $model->fecha)),
		array('name'=>'usuario_id', 'value'=>$model->usuario->nombreCompleto),
	),
)); ?>
