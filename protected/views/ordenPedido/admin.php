<?php
/* @var $this OrdenPedidoController */
/* @var $model OrdenPedido */

$this->menu=array(
	//array('label'=>'Listar Orden de Pedido', 'url'=>array('index')),
	array('label'=>'Crear Orden de Pedido', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orden-pedido-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Orden de Pedidos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orden-pedido-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Personal que Entrega',
			'name'=>'personal_entrega_id',
			'value'=>'$data->personalEntrega->nombreCompleto',
		),
		array(
			'header'=>'Personal que Recibe',
			'name'=>'personal_recibe_id',
			'value'=>'$data->personalRecibe->nombreCompleto',
		),
		array(
			'header'=>'Fecha',
			'name'=>'fecha',
			'value'=>'date("d-m-Y",strtotime($data->fecha))',
			'htmlOptions'=>array('width'=>'90'),
		),
		'observacion',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>



<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#orden-pedido-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#orden-pedido-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('ordenPedido/view'); ?>&id=' + rowId;
        });
    });
</script>