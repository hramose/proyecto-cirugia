<?php
/* @var $this ProductoInventarioController */
/* @var $model ProductoInventario */

$this->menu=array(
	array('label'=>'Listar Productos', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Ver Producto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Productos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Producto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>