<?php
/* @var $this PacienteSucesosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Paciente Sucesoses',
);

$this->menu=array(
	array('label'=>'Create PacienteSucesos', 'url'=>array('create')),
	array('label'=>'Manage PacienteSucesos', 'url'=>array('admin')),
);
?>

<h1>Paciente Sucesoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
