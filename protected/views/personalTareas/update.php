<?php
/* @var $this PersonalTareasController */
/* @var $model PersonalTareas */

$this->menu=array(
	array('label'=>'Crear Tarea', 'url'=>array('create')),
	array('label'=>'Ver Tarea', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Tareas', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tarea <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>