<?php
/* @var $this HojaGastosController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Hoja de Gastos', 'url'=>array('create')),
	array('label'=>'Buscar Hoja de Gastos', 'url'=>array('admin')),
);
?>

<h1>Hoja de Gastos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
