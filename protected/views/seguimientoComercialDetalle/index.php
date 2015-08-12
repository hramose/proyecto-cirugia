<?php
/* @var $this SeguimientoComercialDetalleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguimiento Comercial Detalles',
);

$this->menu=array(
	array('label'=>'Create SeguimientoComercialDetalle', 'url'=>array('create')),
	array('label'=>'Manage SeguimientoComercialDetalle', 'url'=>array('admin')),
);
?>

<h1>Seguimiento Comercial Detalles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
