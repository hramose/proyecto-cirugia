<?php
/* @var $this HistorialFormulacionDetalleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Historial Formulacion Detalles',
);

$this->menu=array(
	array('label'=>'Create HistorialFormulacionDetalle', 'url'=>array('create')),
	array('label'=>'Manage HistorialFormulacionDetalle', 'url'=>array('admin')),
);
?>

<h1>Historial Formulacion Detalles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
