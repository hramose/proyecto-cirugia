<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->menu=array(
	//array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Buscar Promociones', 'url'=>array('admin')),
);
?>

<h1>Crear Promoción</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>