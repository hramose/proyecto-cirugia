<?php
/* @var $this HistorialLaboratorioController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Examenes de Laboratorio', 'url'=>array('create')),
	array('label'=>'Buscar Examenes de Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Examenes de Laboratorio</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
