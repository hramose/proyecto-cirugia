<?php
/* @var $this VentasController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Venta', 'url'=>array('create')),
	array('label'=>'Buscar Ventas', 'url'=>array('admin')),
);
?>

<h1>Ventas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
