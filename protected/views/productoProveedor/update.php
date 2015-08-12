<?php
/* @var $this ProductoProveedorController */
/* @var $model ProductoProveedor */

$this->menu=array(
	array('label'=>'Listar Proveedor de Productos', 'url'=>array('index')),
	array('label'=>'Crear Proveedor de Productos', 'url'=>array('create')),
	array('label'=>'Ver Proveedor de Productos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Proveedor de Productos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Proveedor de Productos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>