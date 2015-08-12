<?php
/* @var $this SeguimientoComercialController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Seguimiento Comercial', 'url'=>array('create')),
	array('label'=>'Buscar Seguimiento Comercial', 'url'=>array('admin')),
);
?>

<h1>Seguimiento Comercial</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
