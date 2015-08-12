<?php
/* @var $this TestimoniosController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Crear Testimonio', 'url'=>array('create')),
	array('label'=>'Buscar Testimonios', 'url'=>array('admin')),
);
?>

<h1>Testimonios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
