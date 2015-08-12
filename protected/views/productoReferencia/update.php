<?php
/* @var $this ProductoReferenciaController */
/* @var $model ProductoReferencia */

$this->menu=array(
	array('label'=>'Listar Referencia de Producto', 'url'=>array('index')),
	array('label'=>'Crear Referencia de Producto', 'url'=>array('create')),
	array('label'=>'Ver Referencia de Producto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Referencia de Producto', 'url'=>array('admin')),
);
?>

<h1>Actualizar Referencia de Producto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>