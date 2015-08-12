<?php
/* @var $this ContratosController */
/* @var $model Contratos */

$this->menu=array(
	//array('label'=>'Listar Contratos', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contratos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Cuentas por Cobrar</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contratos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Contrato',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
		array(
			'header'=>'Paciente',
			'name'=>'paciente_id',
			'filter'=>CHtml::listData(Paciente::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'paciente\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'250'),
		),

		array(
			'header'=>'Cedula',
			'name'=>'n_identificacion',
			//'filter'=>CHtml::listData(Paciente::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'n_identificacion\']',
			'htmlOptions'=>array('width'=>'250'),
		),
		/*array(
			'name'=>'estado',
			'filter' => array('Activo'=>'Activo','Completado'=>'Completado','Liquidado'=>'Liquidado'),
			'value'=>'$data->estado',
			'htmlOptions'=>array('width'=>'150'),
		),*/
		array(
			'header'=>'Saldo de deuda ($)',
			'name'=>'saldo',
			'value'=>'number_format($data->saldo,2)',
			'footer'=>"<h5>$ ".number_format($model->search()->itemCount===0 ? '' : $model->getTotal($model->search()),2).'</h5>',
		),
		array(
			'header'=>'Total de deuda ($)',
			'name'=>'total',
			'value'=>'number_format($data->total,2)',
			'footer'=>"<h5>$ ".number_format($model->search()->itemCount===0 ? '' : $model->getTotal2($model->search()),2).'</h5>',
			
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
        $('body').on('dblclick', '#contratos-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#contratos-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('contratos/view'); ?>&id=' + rowId;
        });
    });
</script>