<?php
/* @var $this LaboratorioController */
/* @var $model Laboratorio */

$this->menu=array(
	array('label'=>'Listar Laboratorios', 'url'=>array('index')),
	array('label'=>'Crear Laboratorio', 'url'=>array('create')),
	array('label'=>'Ver Laboratorio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Actualizar Laboratorio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>