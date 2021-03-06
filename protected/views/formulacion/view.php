<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */


$this->menu=array(
	array('label'=>'Listar Formulaciones', 'url'=>array('index')),
	array('label'=>'Crear Formulación','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Actualizar Formulación','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Formulación', 'url'=>array('admin')),
);
?>

<h1>Formulación #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'presentacion',
		'unidad_medida',
	),
)); ?>
