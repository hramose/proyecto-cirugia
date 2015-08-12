<?php
/* @var $this TipoLineaServicioController */
/* @var $model TipoLineaServicio */


$this->menu=array(
	array('label'=>'Listar Tipo de Linea de Servicio', 'url'=>array('index')),
	array('label'=>'Buscar Tipo de Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo de Linea de Servicio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>