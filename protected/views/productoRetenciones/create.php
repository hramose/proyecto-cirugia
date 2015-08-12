<?php
/* @var $this ProductoRetencionesController */
/* @var $model ProductoRetenciones */


$this->menu=array(
	array('label'=>'Listar Retenciones', 'url'=>array('index')),
	array('label'=>'Buscar Retenciones', 'url'=>array('admin')),
);
?>

<h1>Crear Retenciones</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>