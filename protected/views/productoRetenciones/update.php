<?php
/* @var $this ProductoRetencionesController */
/* @var $model ProductoRetenciones */

$this->menu=array(
	array('label'=>'Listar Retenciones', 'url'=>array('index')),
	array('label'=>'Crear Retenciones', 'url'=>array('create')),
	array('label'=>'Ver Retenciones', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Retenciones', 'url'=>array('admin')),
);
?>

<h1>Actualizar Retenciones <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>