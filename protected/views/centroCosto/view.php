<?php
/* @var $this CentroCostoController */
/* @var $model CentroCosto */


$this->menu=array(
	array('label'=>'Listar Centros de Costos', 'url'=>array('index')),
	array('label'=>'Crear Centros de Costo','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Actualizar Centro de Costo','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Centro de Costo', 'url'=>array('admin')),
);
?>

<h1>Centro de Costo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'tipo',
		'estado',
	),
)); ?>
