<?php
/* @var $this CuentasXcController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cuentas Xcs',
);

$this->menu=array(
	array('label'=>'Create CuentasXc', 'url'=>array('create')),
	array('label'=>'Manage CuentasXc', 'url'=>array('admin')),
);
?>

<h1>Cuentas Xcs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
