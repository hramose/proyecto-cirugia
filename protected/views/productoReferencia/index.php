<?php
/* @var $this ProductoReferenciaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Referencia de Producto', 'url'=>array('create')),
	array('label'=>'Buscar Referencia de Producto', 'url'=>array('admin')),
);
?>

<h1>Referencia de Producto</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
