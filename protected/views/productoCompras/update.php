<?php
/* @var $this ProductoComprasController */
/* @var $model ProductoCompras */

$this->menu=array(
	//array('label'=>'Listar Compras de Producto', 'url'=>array('index')),
	array('label'=>'Crear Compra', 'url'=>array('create')),
	array('label'=>'Ver Compra', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Compras', 'url'=>array('admin')),
);
?>

<h1>Actualizar Compra<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>