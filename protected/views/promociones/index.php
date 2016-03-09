<?php
/* @var $this PromocionesController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Promociones', 'url'=>array('create')),
	array('label'=>'Buscar Promociones Activas', 'url'=>array('admin', 'estado'=>'Activa')),
	array('label'=>'Buscar Promociones Vencidas', 'url'=>array('admin', 'estado'=>'Vencida')),
);
?>

<h1>Promociones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
