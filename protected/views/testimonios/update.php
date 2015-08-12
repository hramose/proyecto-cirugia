<?php
/* @var $this TestimoniosController */
/* @var $model Testimonios */

$this->menu=array(
	array('label'=>'Listar Testimonios', 'url'=>array('index')),
	array('label'=>'Crear Testimonio', 'url'=>array('create')),
	array('label'=>'Ver Testimonio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Testimonios', 'url'=>array('admin')),
);
?>

<h1>Actualizar Testimonio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>