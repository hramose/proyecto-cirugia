<?php
/* @var $this ProductoCategoriaController */
/* @var $model ProductoCategoria */

$this->menu=array(
	array('label'=>'Listar ategoría de Producto', 'url'=>array('index')),
	array('label'=>'Crear ategoría de Producto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-categoria-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Categoría de Producto</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-categoria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'categoria',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
