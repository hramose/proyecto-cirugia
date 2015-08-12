<?php
/* @var $this LaboratorioController */
/* @var $model Laboratorio */

$this->menu=array(
	array('label'=>'Listar Laboratorios', 'url'=>array('index')),
	array('label'=>'Buscar Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Crear Laboratorio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>