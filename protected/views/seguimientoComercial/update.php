<?php
/* @var $this SeguimientoComercialController */
/* @var $model SeguimientoComercial */

$this->menu=array(
	array('label'=>'Listar Seguimiento Comercial', 'url'=>array('index')),
	array('label'=>'Crear Seguimiento Comercial', 'url'=>array('create')),
	array('label'=>'Ver Seguimiento Comercial', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Seguimiento Comercial', 'url'=>array('admin')),
);
?>

<h1>Actualizar Seguimiento Comercial <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>