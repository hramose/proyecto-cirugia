<?php
/* @var $this ProductoPresentacionController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Presentación de Producto', 'url'=>array('create')),
	array('label'=>'Buscar Presentación de Producto', 'url'=>array('admin')),
);
?>

<h1>Presentación de Producto</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
