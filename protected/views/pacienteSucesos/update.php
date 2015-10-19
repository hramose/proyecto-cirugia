<?php
/* @var $this PacienteSucesosController */
/* @var $model PacienteSucesos */

$this->breadcrumbs=array(
	'Paciente Sucesoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PacienteSucesos', 'url'=>array('index')),
	array('label'=>'Create PacienteSucesos', 'url'=>array('create')),
	array('label'=>'View PacienteSucesos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PacienteSucesos', 'url'=>array('admin')),
);
?>

<h1>Update PacienteSucesos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>