<?php
/* @var $this VentasDetalleController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	//array('label'=>'Create VentasDetalle', 'url'=>array('create')),
	array('label'=>'Buscar Relación de Productos', 'url'=>array('admin')),
);
?>

<h1>Ventas Detalles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
