<?php
/* @var $this IngresosController */
/* @var $model Ingresos */

$this->menu=array(
	array('label'=>'Listar Ingresos', 'url'=>array('index')),
	array('label'=>'Crear Ingreso', 'url'=>array('create')),
	array('label'=>'Ver Ingreso', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Ingresos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Ingreso <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>