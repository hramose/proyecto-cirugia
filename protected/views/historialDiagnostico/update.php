<?php
/* @var $this HistorialDiagnosticoController */
/* @var $model HistorialDiagnostico */

$this->menu=array(
	array('label'=>'Listar Diagnosticos Clinicos', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico Clinico', 'url'=>array('create')),
	array('label'=>'Ver Diagnostico Clinico', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Diagnostico Clinico', 'url'=>array('admin')),
);
?>

<h1>Actualizar Diagnostico Clinico <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>