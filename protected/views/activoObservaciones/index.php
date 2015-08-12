<?php
/* @var $this ActivoObservacionesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Activo Observaciones',
);

$this->menu=array(
	array('label'=>'Create ActivoObservaciones', 'url'=>array('create')),
	array('label'=>'Manage ActivoObservaciones', 'url'=>array('admin')),
);
?>

<h1>Activo Observaciones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
