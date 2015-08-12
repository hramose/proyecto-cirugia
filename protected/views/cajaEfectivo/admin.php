<?php
/* @var $this CajaEfectivoController */
/* @var $model CajaEfectivo */

$this->menu=array(
	array('label'=>'Listar Saldos', 'url'=>array('index')),
	//array('label'=>'Create CajaEfectivo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#caja-efectivo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Saldos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'caja-efectivo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Personal',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'personal\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		'total',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>

<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#caja-efectivo-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#caja-efectivo-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('CajaEfectivo/view'); ?>&id=' + rowId;
        });
    });
</script>