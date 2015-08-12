<?php
/* @var $this PacienteController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Ingresar Paciente', 'url'=>array('create')),
	array('label'=>'Buscar Paciente', 'url'=>array('admin')),
);
?>

<h1>Pacientes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
