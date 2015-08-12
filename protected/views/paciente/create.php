<?php
/* @var $this PacienteController */
/* @var $model Paciente */


$this->menu=array(
	array('label'=>'Listar Pacientes', 'url'=>array('index')),
	array('label'=>'Buscar Paciente', 'url'=>array('admin')),
);
?>

<h1>Ingresar Paciente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>