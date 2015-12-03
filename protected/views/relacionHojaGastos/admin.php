<?php
/* @var $this RelacionHojaGastosController */
/* @var $model RelacionHojaGastos */

$this->menu=array(
	//array('label'=>'List RelacionHojaGastos', 'url'=>array('index')),
	//array('label'=>'Create RelacionHojaGastos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#relacion-hoja-gastos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Relación Hoja de Gastos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'relacion-hoja-gastos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
		array(
			'header'=>'Paciente',
			'name'=>'paciente_id',
			'filter'=>CHtml::listData(Paciente::model()->findAll(array('order'=>'nombre ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'paciente\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		'n_identificacion',
		array(
			'name'=>'hoja',
			'filter' => array('Hoja de Gatos'=>'Hoja de Gatos','Hoja de Gatos Cirugia'=>'Hoja de Gatos Cirugia'),
			'value'=>'$data->hoja',
		),
		array(
			'header'=>'Asistencial:',
			'name'=>'asistencial_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->asistencial->nombreCompleto',
			'htmlOptions'=>array('width'=>'180'),
		),
		//'cita_id',
		array(
			'name'=>'linea_servicio_id',
			'htmlOptions'=>array('width'=>'180'),
			'filter'=>CHtml::listData(LineaServicio::model()->findAll("estado = 'activo' order by nombre"), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'lineaServicio\'][\'nombre\']',
		),
		
		array(
			'header'=>'Fecha',
			'name'=>'fecha',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha',
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
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha\']);',
			'htmlOptions'=>array('width'=>'80'),
		),
		//'fecha_hora',
		array(
			'name'=>'costo',
			'value'=>'number_format($data->costo,2)',
			'footer'=>"<h6>$ ".number_format($model->getTotal($model->searchSuma()),2).'</h6>',
		),		
		array(
			'header'=>'Registrada por:',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Usuarios::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'personal\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'180'),
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
        $('body').on('dblclick', '#relacion-hoja-gastos-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#relacion-hoja-gastos-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('relacionHojaGastos/view'); ?>&id=' + rowId;
        });
    });
</script>