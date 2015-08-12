<?php
/* @var $this PacienteOrdenController */
/* @var $model PacienteOrden */

$this->menu=array(
	array('label'=>'Listar Ordenes de Paciente', 'url'=>array('index')),
	array('label'=>'Buscar Orden de Paciente', 'url'=>array('admin')),
);
?>

<h1>Crear Orden de Paciente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>