<?php
/* @var $this ProductoReferenciaController */
/* @var $model ProductoReferencia */

$this->menu=array(
	array('label'=>'Listar Referencia de Producto', 'url'=>array('index')),
	array('label'=>'Buscar Referencia de Producto', 'url'=>array('admin')),
);
?>

<h1>Crear Referencia de Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>