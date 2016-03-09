<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->menu=array(
	//array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Buscar Promociones Activas', 'url'=>array('admin', 'estado'=>'Activa')),
	array('label'=>'Buscar Promociones Vencidas', 'url'=>array('admin', 'estado'=>'Vencida')),
);
?>

<h1>Crear Promoción</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>