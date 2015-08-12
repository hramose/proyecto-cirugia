<?php
/* @var $this EgresosController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Egresos', 'url'=>array('create')),
	array('label'=>'Buscar Egresos', 'url'=>array('admin')),
);
?>

<h1>Egresos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
