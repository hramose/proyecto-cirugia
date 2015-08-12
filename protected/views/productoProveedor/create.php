<?php
/* @var $this ProductoProveedorController */
/* @var $model ProductoProveedor */

$this->menu=array(
	array('label'=>'Listar Proveedor de Productos', 'url'=>array('index')),
	array('label'=>'Buscar Proveedor de Productos', 'url'=>array('admin')),
);
?>

<h1>Crear Proveedor de Productos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>