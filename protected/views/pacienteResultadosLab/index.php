<?php
/* @var $this PacienteResultadosLabController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Agregar Resultados de Laboratorio', 'url'=>array('create')),
	array('label'=>'Buscar Resultados de Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Resultados de Laboratorio</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
