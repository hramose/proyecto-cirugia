<?php
/* @var $this HistorialPlanTratamientoController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	// array('label'=>'Crear Plan de Tratamiento', 'url'=>array('create')),
	// array('label'=>'Buscar Plan de Tratamiento', 'url'=>array('admin')),
);
?>

<h1>Historial Plan Tratamientos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
