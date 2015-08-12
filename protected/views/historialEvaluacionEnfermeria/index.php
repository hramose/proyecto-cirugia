<?php
/* @var $this HistorialEvaluacionEnfermeriaController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	//array('label'=>'Create HistorialEvaluacionEnfermeria', 'url'=>array('create')),
	//array('label'=>'Manage HistorialEvaluacionEnfermeria', 'url'=>array('admin')),
);
?>

<h1>Historial Evaluacion Enfermerias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
