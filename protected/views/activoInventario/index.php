<?php
/* @var $this ActivoInventarioController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Activo', 'url'=>array('create')),
	array('label'=>'Buscar Activos', 'url'=>array('admin')),
);
?>

<h1>Activos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
