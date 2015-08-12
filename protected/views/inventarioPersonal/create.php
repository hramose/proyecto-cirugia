<?php
/* @var $this InventarioPersonalController */
/* @var $model InventarioPersonal */

$this->menu=array(
	array('label'=>'Listar Inventario Personal', 'url'=>array('index')),
	array('label'=>'Buscar Inventario Personal', 'url'=>array('admin')),
);
?>

<h1>Crear Inventario Personal</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>