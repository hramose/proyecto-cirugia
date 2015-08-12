<?php
/* @var $this FormulacionController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Formulación', 'url'=>array('create')),
	array('label'=>'Buscar Formulación', 'url'=>array('admin')),
);
?>

<h1>Formulaciones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
