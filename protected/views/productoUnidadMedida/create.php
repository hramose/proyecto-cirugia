<?php
/* @var $this ProductoUnidadMedidaController */
/* @var $model ProductoUnidadMedida */

$this->menu=array(
	array('label'=>'Listar Unidad de Medida', 'url'=>array('index')),
	array('label'=>'Buscar Unidad de Medida', 'url'=>array('admin')),
);
?>

<h1>Crear Unidad de Medida</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>