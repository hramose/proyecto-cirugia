<?php
/* @var $this ActivoInventarioController */
/* @var $model ActivoInventario */

$this->menu=array(
	array('label'=>'Listar Activos', 'url'=>array('index')),
	array('label'=>'Buscar Activos', 'url'=>array('admin')),
);
?>

<h1>Crear Activo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>