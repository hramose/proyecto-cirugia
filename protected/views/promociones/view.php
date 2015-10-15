<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->menu=array(
	//array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Crear Promociones', 'url'=>array('create')),
	array('label'=>'Actualizar Promociones', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Promociones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Promociones', 'url'=>array('admin')),
);
?>

<h1>Promoción #<?php echo $model->titulo_promocion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'titulo_promocion',
		'fecha_inicio',
		'fecha_fin',
		'estado',
		'usuario_id',
		'fecha_creacion',
	),
)); ?>


	<h3>Detalle de Promoción</h3>

		<?php echo $model->promocion; ?>

