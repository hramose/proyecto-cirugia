<?php
/* @var $this HojaGastosController */
/* @var $model HojaGastos */

$this->menu=array(
	array('label'=>'Listar Hoja de Gastos', 'url'=>array('index')),
	array('label'=>'Crear Hoja ee Gastos', 'url'=>array('create')),
	array('label'=>'Ver Hoja ee Gastos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Hoja ee Gastos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Hoja de Gastos <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>