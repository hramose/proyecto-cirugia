<?php
/* @var $this PresupuestoController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Presupuesto', 'url'=>array('create')),
	array('label'=>'Buscar Presupuesto', 'url'=>array('admin')),
);
?>

<h1>Presupuestos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
