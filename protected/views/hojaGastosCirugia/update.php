<?php
/* @var $this HojaGastosCirugiaController */
/* @var $model HojaGastosCirugia */

$this->menu=array(
	array('label'=>'Listar Hoja de Gastos de Cirugía', 'url'=>array('index')),
	array('label'=>'Crear Hoja de Gastos de Cirugía', 'url'=>array('create')),
	array('label'=>'Ver Hoja de Gastos de Cirugía', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Hoja de Gastos de Cirugía', 'url'=>array('admin')),
);
?>

<h1>Actualizar Hoja de Gastos de Cirugía <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>