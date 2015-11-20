<?php
/* @var $this PersonalTareasController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Tarea', 'url'=>array('create')),
	array('label'=>'Buscar Tareas', 'url'=>array('admin')),
);
?>

<h1>Tareas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
