<?php
/* @var $this ProductoPresentacionController */
/* @var $model ProductoPresentacion */

$this->menu=array(
	array('label'=>'Listar Presentación de Producto', 'url'=>array('index')),
	array('label'=>'Buscar Presentación de Producto', 'url'=>array('admin')),
);
?>

<h1>Crear Presentación de Producto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>