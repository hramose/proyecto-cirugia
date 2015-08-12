<?php
/* @var $this CitasController */
/* @var $model Citas */


$this->menu=array(
	array('label'=>'Listar Citas', 'url'=>array('index')),
	array('label'=>'Ver Citas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Citas', 'url'=>array('admin')),
);
?>

<h1>Actualizar Cita <?php echo $model->id; ?></h1>

<?php 
	$model->hora_fin = $model->hora_fin+ 1;
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>