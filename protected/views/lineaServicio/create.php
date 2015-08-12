<?php
/* @var $this LineaServicioController */
/* @var $model LineaServicio */


$this->menu=array(
	array('label'=>'Listar Lineas de Servicio', 'url'=>array('index')),
	array('label'=>'Buscar Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Crear Linea de Servicio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>