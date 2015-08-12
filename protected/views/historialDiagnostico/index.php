<?php
/* @var $this HistorialDiagnosticoController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Diagnostico Clinico', 'url'=>array('create')),
	array('label'=>'Buscar Diagnostico Clinico', 'url'=>array('admin')),
);
?>

<h1>Diagnosticos Clinicos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
