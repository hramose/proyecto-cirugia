<?php
/* @var $this SeguimientoComercialDetalleController */
/* @var $model SeguimientoComercialDetalle */

$this->breadcrumbs=array(
	'Seguimiento Comercial Detalles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SeguimientoComercialDetalle', 'url'=>array('index')),
	array('label'=>'Create SeguimientoComercialDetalle', 'url'=>array('create')),
	array('label'=>'View SeguimientoComercialDetalle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SeguimientoComercialDetalle', 'url'=>array('admin')),
);
?>

<h1>Update SeguimientoComercialDetalle <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>