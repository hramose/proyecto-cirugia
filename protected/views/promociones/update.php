<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->menu=array(
	//array('label'=>'Listar Promociones', 'url'=>array('index')),
	array('label'=>'Crear Promociones', 'url'=>array('create')),
	array('label'=>'Ver Promociones', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Promociones Activas', 'url'=>array('admin', 'estado'=>'Activa')),
	array('label'=>'Buscar Promociones Vencidas', 'url'=>array('admin', 'estado'=>'Vencida')),
);
?>

<h1>Actualizar Promociones <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>