<?php
/* @var $this ProductoInventarioController */
/* @var $model ProductoInventario */

$this->menu=array(
	array('label'=>'Listar Productos', 'url'=>array('index')),
	array('label'=>'Buscar Productos', 'url'=>array('admin')),
);
?>

<h1>Crear Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>