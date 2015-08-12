<?php
/* @var $this HistorialNotasEnfermeriaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Notas de Enfermería', 'url'=>array('create')),
	array('label'=>'Buscar Notas de Enfermería', 'url'=>array('admin')),
);
?>

<h1>Historial Notas de Enfermería</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
