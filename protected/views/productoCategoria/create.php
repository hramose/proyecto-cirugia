<?php
/* @var $this ProductoCategoriaController */
/* @var $model ProductoCategoria */

$this->menu=array(
	array('label'=>'Listar Categoría de Producto', 'url'=>array('index')),
	array('label'=>'Buscar Categoría de Producto', 'url'=>array('admin')),
);
?>

<h1>Crear Categoría de Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>