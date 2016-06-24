<?php
/* @var $this CentroCompraController */
/* @var $model CentroCompra */


$this->menu=array(
	array('label'=>'Listar Centros de Compra', 'url'=>array('index')),
	array('label'=>'Crear Centro de Compra','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#centro-compra-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Centros de Compra</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'centro-compra-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		'nombre',
		'estado',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>


<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#centro-compra-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#centro-compra-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('CentroCompra/view'); ?>&id=' + rowId;
        });
    });
</script>