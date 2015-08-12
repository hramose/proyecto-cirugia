<?php
/* @var $this CentroCostoController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Centro de Costo', 'url'=>array('create')),
	array('label'=>'Buscar Centro de Costo', 'url'=>array('admin')),
);
?>

<h1>Centros de Costos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
