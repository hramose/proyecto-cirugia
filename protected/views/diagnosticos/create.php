<?php
/* @var $this DiagnosticosController */
/* @var $model Diagnosticos */


$this->menu=array(
	array('label'=>'Listar Diagnosticos', 'url'=>array('index')),
	array('label'=>'Buscar Diagnosticos', 'url'=>array('admin')),
);
?>

<h1>Crear Diagnostico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>