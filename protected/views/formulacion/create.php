<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */

$this->menu=array(
	array('label'=>'Listar Formulaciones', 'url'=>array('index')),
	array('label'=>'Buscar Formulación', 'url'=>array('admin')),
);
?>

<h1>Crear Formulación</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>