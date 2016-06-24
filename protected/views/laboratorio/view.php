<?php
/* @var $this LaboratorioController */
/* @var $model Laboratorio */

$this->menu=array(
	array('label'=>'Listar Laboratorios', 'url'=>array('index')),
	array('label'=>'Crear Laboratorio','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Actualizar Laboratorio','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Laboratorio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Laboratorio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
	),
)); ?>
