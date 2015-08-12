<?php
/* @var $this ProductoCategoriaController */
/* @var $model ProductoCategoria */

$this->menu=array(
	array('label'=>'Listar Categoría de Producto', 'url'=>array('index')),
	array('label'=>'Crear Categoría de Producto', 'url'=>array('create')),
	array('label'=>'Ver Categoría de Producto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Categoría de Producto', 'url'=>array('admin')),
);
?>

<h1>Actualizar Categoría de Producto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>