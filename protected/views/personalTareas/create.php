<?php
/* @var $this PersonalTareasController */
/* @var $model PersonalTareas */

$this->menu=array(
	array('label'=>'Buscar Tareas', 'url'=>array('admin')),
);
?>

<h1>Crear Tarea</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>