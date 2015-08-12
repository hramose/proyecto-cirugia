<?php
/* @var $this TestimoniosController */
/* @var $model Testimonios */


$this->menu=array(
	array('label'=>'Listar Testimonios', 'url'=>array('index')),
	array('label'=>'Buscar Testimonios', 'url'=>array('admin')),
);
?>

<h1>Crear Testimonio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>