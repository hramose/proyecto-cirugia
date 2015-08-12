<?php
/* @var $this TestimoniosController */
/* @var $model Testimonios */

$this->breadcrumbs=array(
	'Testimonioses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Testimonio', 'url'=>array('index')),
	array('label'=>'Crear Testimonio', 'url'=>array('create')),
	array('label'=>'Actualizar Testimonio', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Testimonio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Testimonios', 'url'=>array('admin')),
);
?>

<h1>Testimonio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'paciente_id',
		'testimonio',
		'fecha',
	),
)); ?>
