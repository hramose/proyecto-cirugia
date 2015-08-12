<?php
/* @var $this CuentasXcDetalleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cuentas Xc Detalles',
);

$this->menu=array(
	array('label'=>'Create CuentasXcDetalle', 'url'=>array('create')),
	array('label'=>'Manage CuentasXcDetalle', 'url'=>array('admin')),
);
?>

<h1>Cuentas Xc Detalles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
