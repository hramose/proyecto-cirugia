<?php
/* @var $this ProductoPresentacionController */
/* @var $model ProductoPresentacion */

$this->menu=array(
	array('label'=>'Listar Presentación de Producto', 'url'=>array('index')),
	array('label'=>'Crear Presentación de Producto', 'url'=>array('create')),
	array('label'=>'Ver Presentación de Producto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Presentación de Producto', 'url'=>array('admin')),
);
?>

<h1>Actualizar Presentación de Producto<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>