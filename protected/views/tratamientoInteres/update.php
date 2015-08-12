<?php
/* @var $this TratamientoInteresController */
/* @var $model TratamientoInteres */

$this->menu=array(
	array('label'=>'Listar Tratamientos de Interes', 'url'=>array('index')),
	array('label'=>'Crear Tratamiento de Interes', 'url'=>array('create')),
	array('label'=>'Ver Tratamiento de Interes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Tratamiento de Interes', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tratamiento de Interes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>