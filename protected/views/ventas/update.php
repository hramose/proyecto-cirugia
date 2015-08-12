<?php
/* @var $this VentasController */
/* @var $model Ventas */

$this->menu=array(
	array('label'=>'Listar Ventas', 'url'=>array('index')),
	array('label'=>'Crear Ventas', 'url'=>array('create')),
	array('label'=>'Ver Ventas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Ventas', 'url'=>array('admin')),
);
?>

<h1>Actualizar Venta <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>