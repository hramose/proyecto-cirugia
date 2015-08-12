<?php
/* @var $this InventarioPersonalController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Inventario Personal', 'url'=>array('create')),
	array('label'=>'Buscar Inventario Personal', 'url'=>array('admin')),
);
?>

<h1>Inventario Personal</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
