<?php
/* @var $this ProductoUnidadMedidaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Unidad de Medida', 'url'=>array('create')),
	array('label'=>'Buscar Unidad de Medida', 'url'=>array('admin')),
);
?>

<h1>Unidad de Medida</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
