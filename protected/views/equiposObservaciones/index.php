<?php
/* @var $this EquiposObservacionesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Equipos Observaciones',
);

$this->menu=array(
	array('label'=>'Create EquiposObservaciones', 'url'=>array('create')),
	array('label'=>'Manage EquiposObservaciones', 'url'=>array('admin')),
);
?>

<h1>Equipos Observaciones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
