<?php
/* @var $this HistorialEvaluacionCosmetologicaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	// array('label'=>'Crear Evaluación Cosmetológica', 'url'=>array('create')),
	// array('label'=>'Buscar Evaluación Cosmetológica', 'url'=>array('admin')),
);
?>

<h1>Evoluciones Cosmetológicas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
