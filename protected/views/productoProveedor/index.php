<?php
/* @var $this ProductoProveedorController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Proveedor de Productos', 'url'=>array('create')),
	array('label'=>'Buscar Proveedor de Productos', 'url'=>array('admin')),
);
?>

<h1>Proveedor de Productos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
