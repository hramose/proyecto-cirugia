<?php
/* @var $this EquiposController */
/* @var $model Equipos */

$this->menu=array(
	array('label'=>'Listar Equipos', 'url'=>array('index')),
	array('label'=>'Buscar Equipos', 'url'=>array('admin')),
);
?>

<h1>Crear Equipo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>