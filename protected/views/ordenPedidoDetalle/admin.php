<?php
/* @var $this OrdenPedidoDetalleController */
/* @var $model OrdenPedidoDetalle */

$this->breadcrumbs=array(
	'Orden Pedido Detalles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OrdenPedidoDetalle', 'url'=>array('index')),
	array('label'=>'Create OrdenPedidoDetalle', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orden-pedido-detalle-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Orden Pedido Detalles</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orden-pedido-detalle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'orden_pedido_id',
		'tipo_orden_pedido_id',
		'producto_id',
		'area',
		'cantidad',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
