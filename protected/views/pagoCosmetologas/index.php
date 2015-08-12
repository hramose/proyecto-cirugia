<?php
/* @var $this PagoCosmetologasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pago Cosmetologases',
);

$this->menu=array(
	array('label'=>'Create PagoCosmetologas', 'url'=>array('create')),
	array('label'=>'Manage PagoCosmetologas', 'url'=>array('admin')),
);
?>

<h1>Pago Cosmetologases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
