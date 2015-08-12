<?php
/* @var $this LaboratorioController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Laboratorio', 'url'=>array('create')),
	array('label'=>'Buscar Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Laboratorios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
