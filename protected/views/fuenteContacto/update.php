<?php
/* @var $this FuenteContactoController */
/* @var $model FuenteContacto */

$this->breadcrumbs=array(
	'Fuente Contactos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FuenteContacto', 'url'=>array('index')),
	array('label'=>'Create FuenteContacto', 'url'=>array('create')),
	array('label'=>'View FuenteContacto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FuenteContacto', 'url'=>array('admin')),
);
?>

<h1>Update FuenteContacto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>