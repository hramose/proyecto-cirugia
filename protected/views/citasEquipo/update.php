<?php
/* @var $this CitasEquipoController */
/* @var $model CitasEquipo */

$this->breadcrumbs=array(
	'Citas Equipos'=>array('index'),
	$model->cita_id=>array('view','id'=>$model->cita_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CitasEquipo', 'url'=>array('index')),
	array('label'=>'Create CitasEquipo', 'url'=>array('create')),
	array('label'=>'View CitasEquipo', 'url'=>array('view', 'id'=>$model->cita_id)),
	array('label'=>'Manage CitasEquipo', 'url'=>array('admin')),
);
?>

<h1>Update CitasEquipo <?php echo $model->cita_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>