<?php
/* @var $this ActivoInventarioController */
/* @var $model ActivoInventario */

$this->menu=array(
	array('label'=>'Listar Activos', 'url'=>array('index')),
	array('label'=>'Crear Activo', 'url'=>array('create')),
	array('label'=>'Ver Activo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Activos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Activo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>