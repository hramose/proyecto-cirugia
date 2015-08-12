<?php
/* @var $this DiagnosticoPrincipalController */
/* @var $model DiagnosticoPrincipal */


$this->menu=array(
	array('label'=>'Listar Diagnosticos Principales', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico Principal', 'url'=>array('create')),
	array('label'=>'Ver Diagnostico Principal', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Diagnostico Principal', 'url'=>array('admin')),
);
?>

<h1>Actualizar Diagnostico Principal <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>