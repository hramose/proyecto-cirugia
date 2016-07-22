<?php
/* @var $this InventarioPersonalController */
/* @var $model InventarioPersonal */

$this->menu=array(
	array('label'=>'Listar Inventario Personal', 'url'=>array('index')),
	array('label'=>'Crear Inventario Personal', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#inventario-personal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Inventario Personal</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inventario-personal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Personal:',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'personal_id','personal.nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->personal->nombreCompleto',
			'htmlOptions'=>array('width'=>'300'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>


<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#inventario-personal-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#inventario-personal-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('InventarioPersonal/view'); ?>&id=' + rowId;
        });
    });
</script>