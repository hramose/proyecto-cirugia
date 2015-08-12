<?php
/* @var $this HistorialMedicinaBiologicaController */
/* @var $model HistorialMedicinaBiologica */

$this->menu=array(
	// array('label'=>'Listar Planes de Medicina Biologica', 'url'=>array('index')),
	// array('label'=>'Crear Plan de Medicina Biologica', 'url'=>array('create')),
	array('label'=>'Ver Plan de Medicina Biologica', 'url'=>array('view', 'id'=>$model->id)),
	// array('label'=>'Buscar Plan de Medicina Biologica', 'url'=>array('admin')),
);
?>

<h1>Actualizar Plan de Medicina Biologica <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>