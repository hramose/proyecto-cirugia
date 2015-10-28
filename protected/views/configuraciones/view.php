<?php
/* @var $this ConfiguracionesController */
/* @var $model Configuraciones */

$this->menu=array(
	array('label'=>'Actualizar', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>Clave Super Usuario</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'super_usuario',
	),
)); ?>
