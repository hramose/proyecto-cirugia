<?php
/* @var $this ProductoPresentacionController */
/* @var $model ProductoPresentacion */

$this->menu=array(
	array('label'=>'Listar Presentación de Producto', 'url'=>array('index')),
	array('label'=>'Crear Presentación de Producto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-presentacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Presentación de Producto</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-presentacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'presentacion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
