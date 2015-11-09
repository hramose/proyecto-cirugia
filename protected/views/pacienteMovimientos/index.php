<?php
/* @var $this PacienteMovimientosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Paciente Movimientoses',
);

$this->menu=array(
	array('label'=>'Create PacienteMovimientos', 'url'=>array('create')),
	array('label'=>'Manage PacienteMovimientos', 'url'=>array('admin')),
);
?>

<h1>Paciente Movimientoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
