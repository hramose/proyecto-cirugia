<?php
/* @var $this CosmetologaOrdenController */
/* @var $model CosmetologaOrden */


$this->menu=array(
	array('label'=>'Listar Pagos a Cosmetologas', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cosmetologa-orden-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Pagos a Cosmetologas</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cosmetologa-orden-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),	
		array(
			'header'=>'Contrato',
			'name'=>'contrato_detalle_id',
			'value'=>'$data->contratoDetalle->contrato_id',
			'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Linea de Servicio',
			//'name'=>'contratoDetalle.lienaServicio.nombre',
			'value'=>'$data->contratoDetalle->lineaServicio->nombre',
			//'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Sesión',
			'name'=>'sesion',
			'value'=>'$data->sesion',
			'htmlOptions'=>array('width'=>'25'),
		),
		array(
			'header'=>'Cosmetologa',
			'name'=>'cosmetologa_id',
			'value'=>'$data->cosmetologa->nombreCompleto',
			//'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Valor de Servicio',
			//'name'=>'cosmetologa_id',
			'value'=>'$data->contratoDetalle->vu',
			//'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Precio de Pago',
			//'name'=>'cosmetologa_id',
			'value'=>'$data->contratoDetalle->lineaServicio->precio_pago',
			//'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Vendedor',
			//'name'=>'cosmetologa_id',
			'value'=>'$data->contratoDetalle->contrato->usuario->nombres',
			//'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Estado',
			'name'=>'estado',
			'value'=>'$data->estado',
			'htmlOptions'=>array('width'=>'50'),
		),
		array(
			'header'=>'Fecha',
			'name'=>'fecha_servicio',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_servicio',
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'2014:2025',
					),
					'htmlOptions'=>array(
						'id' => 'datepicker_for_fecha_cita',
						'style'=>'height:20px;width:80px;'
					),
					 'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
				),true),
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_servicio\']);',
			'htmlOptions'=>array('width'=>'80'),
		),
		/*
		'fecha_pago',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>


<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#cosmetologa-orden-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#cosmetologa-orden-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('cosmetologaOrden/view'); ?>&id=' + rowId;
        });
    });
</script>