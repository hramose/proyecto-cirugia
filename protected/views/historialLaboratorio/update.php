<?php
/* @var $this HistorialLaboratorioController */
/* @var $model HistorialLaboratorio */


$this->menu=array(
	array('label'=>'Listar Examenes de Laboratorio', 'url'=>array('index')),
	array('label'=>'Crear Examenes de Laboratorio', 'url'=>array('create')),
	array('label'=>'Ver Examenes de Laboratorio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Examenes de Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Actualizar Examenes de Laboratorio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>