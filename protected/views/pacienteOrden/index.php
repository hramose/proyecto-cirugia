<?php
/* @var $this PacienteOrdenController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Buscar Orden de Paciente', 'url'=>array('admin')),
);
?>

<h1>Ordenes de Paciente</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
