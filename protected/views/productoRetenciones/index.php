<?php
/* @var $this ProductoRetencionesController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Retenciones', 'url'=>array('create')),
	array('label'=>'Buscar Retenciones', 'url'=>array('admin')),
);
?>

<h1>Retenciones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
