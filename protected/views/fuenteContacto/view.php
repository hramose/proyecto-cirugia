<?php
/* @var $this FuenteContactoController */
/* @var $model FuenteContacto */

$this->menu=array(
	array('label'=>'Listar Fuentes de Contacto', 'url'=>array('index')),
	array('label'=>'Crear Fuente de Contacto','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Actualizar Fuente de Contacto','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Fuente de Contacto', 'url'=>array('admin')),
);
?>

<h1>Fuente de Contacto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fuente',
	),
)); ?>
