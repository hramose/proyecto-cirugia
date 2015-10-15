<?php
/* @var $this PromocionesController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Promociones', 'url'=>array('create')),
	array('label'=>'Buscar Promociones', 'url'=>array('admin')),
);
?>

<h1>Promociones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
