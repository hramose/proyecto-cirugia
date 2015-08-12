<?php
/* @var $this HistorialMedicinaBiologicaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	// array('label'=>'Crear Plan de Medicina Biologica', 'url'=>array('create')),
	// array('label'=>'Buscar Plan de Medicina Biologica', 'url'=>array('admin')),
);
?>

<h1>Plan de Medicina Biologica</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
