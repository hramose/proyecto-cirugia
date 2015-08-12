<?php
/* @var $this HistorialExamenFisicoController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Examen Físico', 'url'=>array('create')),
	array('label'=>'Buscar Examen Físico', 'url'=>array('admin')),
);
?>

<h1>Examen Físico</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
