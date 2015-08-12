<?php
/* @var $this ProductoRetencionesController */
/* @var $model ProductoRetenciones */

$this->menu=array(
	array('label'=>'Listar Retenciones', 'url'=>array('index')),
	array('label'=>'Crear Retenciones', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-retenciones-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Retenciones</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-retenciones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'retencion',
		'a_retener',
		'base',
		'porcentaje',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
