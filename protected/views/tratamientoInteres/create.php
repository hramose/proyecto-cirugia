<?php
/* @var $this TratamientoInteresController */
/* @var $model TratamientoInteres */

$this->menu=array(
	array('label'=>'Listar Tratamiento de Interes', 'url'=>array('index')),
	array('label'=>'Buscar Tratamiento de Interes', 'url'=>array('admin')),
);
?>

<h1>Crear Tratamiento de Interes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>