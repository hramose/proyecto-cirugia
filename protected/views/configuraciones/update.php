<?php
/* @var $this ConfiguracionesController */
/* @var $model Configuraciones */

$this->breadcrumbs=array(
	'Configuraciones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Configuraciones', 'url'=>array('index')),
	array('label'=>'Create Configuraciones', 'url'=>array('create')),
	array('label'=>'View Configuraciones', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Configuraciones', 'url'=>array('admin')),
);
?>

<h1>Update Configuraciones <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>