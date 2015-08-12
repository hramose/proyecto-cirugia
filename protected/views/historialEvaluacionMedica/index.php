<?php
/* @var $this HistorialEvaluacionMedicaController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	// array('label'=>'Crear Evaluación Médica', 'url'=>array('create')),
	// array('label'=>'Buscar Evaluación Médica', 'url'=>array('admin')),
);
?>

<h1>Evolución Médica</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
