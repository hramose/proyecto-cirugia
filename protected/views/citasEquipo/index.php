<?php
/* @var $this CitasEquipoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Citas Equipos',
);

$this->menu=array(
	array('label'=>'Create CitasEquipo', 'url'=>array('create')),
	array('label'=>'Manage CitasEquipo', 'url'=>array('admin')),
);
?>

<h1>Citas Equipos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
