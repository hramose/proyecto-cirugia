<?php
/* @var $this MedicamentosBiologicosController */
/* @var $model MedicamentosBiologicos */

$this->menu=array(
	array('label'=>'Listar Medicamentos Biológicos', 'url'=>array('index')),
	array('label'=>'Crear Medicamento Biológico','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Actualizar Medicamento Biológico','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete MedicamentosBiologicos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Medicamentos Biológicos', 'url'=>array('admin')),
);
?>

<h1>Medicamento Biologico #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'medicamento',
	),
)); ?>
