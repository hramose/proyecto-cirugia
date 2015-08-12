<?php
/* @var $this PacienteOrdenController */
/* @var $model PacienteOrden */


$this->menu=array(
	array('label'=>'Listar Ordenes de Pacientes', 'url'=>array('index')),
	array('label'=>'Ver Orden de Paciente', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Orden de Paciente', 'url'=>array('admin')),
);
?>

<h1>Actalizar Orden de Paciente <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>