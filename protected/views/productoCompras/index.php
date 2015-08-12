<?php
/* @var $this ProductoComprasController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Compra', 'url'=>array('create')),
	array('label'=>'Buscar Compras', 'url'=>array('admin')),
);
?>

<h1>Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
