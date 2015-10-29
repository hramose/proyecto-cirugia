<?php
/* @var $this CentroCompraController */
/* @var $model CentroCompra */

$this->menu=array(
	array('label'=>'Crear Centro de Compra', 'url'=>array('create')),
	array('label'=>'Actualizar Centro de Compra', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Centro de Compra', 'url'=>array('admin')),
);
?>

<h1>Centro de Compra #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'estado',
	),
)); ?>
