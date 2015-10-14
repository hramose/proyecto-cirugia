<?php
/* @var $this HistorialNotasEnfermeriaController */
/* @var $model HistorialNotasEnfermeria */

$this->menu=array(
	//array('label'=>'Listar Notas de Enfermería', 'url'=>array('index')),
	//array('label'=>'Crear Notas de Enfermería', 'url'=>array('create')),
	array('label'=>'Ver Nota de Enfermería', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Buscar Notas de Enfermería', 'url'=>array('admin')),
);
?>

<h1>Actualizar Notas de Enfermería <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>