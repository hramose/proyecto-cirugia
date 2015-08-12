<?php
/* @var $this HistorialPlanTratamientoController */
/* @var $model HistorialPlanTratamiento */

$this->menu=array(
	array('label'=>'Listar Planes de Tratamiento', 'url'=>array('index')),
	array('label'=>'Crear Plan de Tratamiento', 'url'=>array('create')),
	array('label'=>'Ver Plan de Tratamiento', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Plan de Tratamiento', 'url'=>array('admin')),
);
?>

<h1>Actualizar Plan de Tratamiento <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>