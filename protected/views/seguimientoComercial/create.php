<?php
/* @var $this SeguimientoComercialController */
/* @var $model SeguimientoComercial */

$this->menu=array(
	array('label'=>'Listar Seguimiento Comercial', 'url'=>array('index')),
	array('label'=>'Buscar Seguimiento Comercial', 'url'=>array('admin')),
);
?>

<h1>Crear Seguimiento Comercial</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>