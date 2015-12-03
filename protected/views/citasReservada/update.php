<?php
/* @var $this CitasReservadaController */
/* @var $model CitasReservada */

$this->breadcrumbs=array(
	'Citas Reservadas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CitasReservada', 'url'=>array('index')),
	array('label'=>'Create CitasReservada', 'url'=>array('create')),
	array('label'=>'View CitasReservada', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CitasReservada', 'url'=>array('admin')),
);
?>

<h1>Update CitasReservada <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>