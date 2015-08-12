<?php
/* @var $this SeguimientoTemaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Tema de Seguimiento', 'url'=>array('create')),
	array('label'=>'Buscar Tema de Seguimiento', 'url'=>array('admin')),
);
?>

<h1>Temas de Seguimiento</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
