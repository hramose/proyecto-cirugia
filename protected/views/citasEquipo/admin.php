<?php
/* @var $this CitasEquipoController */
/* @var $model CitasEquipo */

$this->menu=array(
	//array('label'=>'List CitasEquipo', 'url'=>array('index')),
	//array('label'=>'Create CitasEquipo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#citas-equipo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Agenda de Equipos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'citas-equipo-grid',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Cita',
			'name'=>'cita_id',
			'value'=>'$data->cita_id',
			'htmlOptions'=>array('width'=>'50'),
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
		array(
			'name'=>'hora_inicio',
			'filter'=>CHtml::listData(HorasServicio::model()->findAll(), 'id','hora'), // Colocamos un combo en el filtro
			'value'=>'$data[\'horaInicio\'][\'hora\']',
			'htmlOptions'=>array('width'=>'85'),
		),
		array(
			'name'=>'hora_fin_mostrar',
			'filter'=>CHtml::listData(HorasServicio::model()->findAll(), 'id','hora'), // Colocamos un combo en el filtro
			'value'=>'$data[\'horaFinMostrar\'][\'hora\']',
			'htmlOptions'=>array('width'=>'85'),
		),
		array(
			'name'=>'equipo_id',
			'filter'=>CHtml::listData(Equipos::model()->findAll(array('order'=>'nombre ASC')), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'equipo\'][\'nombre\']',
			'htmlOptions'=>array('width'=>'210'),
		),
		'equipo.numero',
		array(
			'name'=>'linea_servicio_id',
			'filter'=>CHtml::listData(LineaServicio::model()->findAll(array('order'=>'nombre ASC')), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'lineaServicio\'][\'nombre\']',
			'htmlOptions'=>array('width'=>'210'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha_cita').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
}
");

?>

<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#citas-equipo-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#citas-equipo-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('citasEquipo/view'); ?>&id=' + rowId;
        });
    });
</script>