<?php
/* @var $this ProductoReferenciaController */
/* @var $model ProductoReferencia */

$this->menu=array(
	array('label'=>'Listar Referencia de Producto', 'url'=>array('index')),
	array('label'=>'Crear Referencia de Producto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-referencia-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Referencia de Producto</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-referencia-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'referencia',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
