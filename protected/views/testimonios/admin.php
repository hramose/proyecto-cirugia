<?php
/* @var $this TestimoniosController */
/* @var $model Testimonios */

$this->menu=array(
	array('label'=>'Listar Testimonios', 'url'=>array('index')),
	array('label'=>'Crear Testimonio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#testimonios-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Testimonios</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'testimonios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'testimonio',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
