<?php
/* @var $this HojaGastosCirugiaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Hoja de Gastos de Cirugía', 'url'=>array('create')),
	array('label'=>'Buscar Hoja de Gastos de Cirugía', 'url'=>array('admin')),
);
?>

<h1>Hoja de Gastos de Cirugía</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
