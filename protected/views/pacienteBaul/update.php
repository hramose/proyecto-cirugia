<?php
/* @var $this PacienteBaulController */
/* @var $model PacienteBaul */

$this->breadcrumbs=array(
	'Paciente Bauls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PacienteBaul', 'url'=>array('index')),
	array('label'=>'Create PacienteBaul', 'url'=>array('create')),
	array('label'=>'View PacienteBaul', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PacienteBaul', 'url'=>array('admin')),
);
?>

<h1>Update PacienteBaul <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>