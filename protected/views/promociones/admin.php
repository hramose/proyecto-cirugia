<?php
/* @var $this PromocionesController */
/* @var $model Promociones */


$this->menu=array(
	//array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Crear Promociones', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#promociones-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Promociones</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'promociones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'titulo_promocion',
		'fecha_inicio',
		'fecha_fin',
		'promocion',
		'estado',
		/*
		'usuario_id',
		'fecha_creacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
