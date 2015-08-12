<?php
/* @var $this ProductoUnidadMedidaController */
/* @var $model ProductoUnidadMedida */

$this->menu=array(
	array('label'=>'Listar Unidad de Medida', 'url'=>array('index')),
	array('label'=>'Crear Unidad de Medida', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-unidad-medida-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Unidad de Medida de Producto</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-unidad-medida-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'medida',
		'corto',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
