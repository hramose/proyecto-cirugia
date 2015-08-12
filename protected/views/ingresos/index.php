<?php
/* @var $this IngresosController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Ingreso', 'url'=>array('create')),
	array('label'=>'Buscar Ingresos', 'url'=>array('admin')),
);
?>

<h1>Ingresos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
