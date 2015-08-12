<?php
/* @var $this DiagnosticoPrincipalController */
/* @var $model DiagnosticoPrincipal */

$this->menu=array(
	array('label'=>'Listar Diagnosticos Principales', 'url'=>array('index')),
	array('label'=>'Buscar Diagnostico Principal', 'url'=>array('admin')),
);
?>

<h1>Crear Diagnostico Principal</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>