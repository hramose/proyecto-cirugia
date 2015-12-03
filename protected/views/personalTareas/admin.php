<?php
/* @var $this PersonalTareasController */
/* @var $model PersonalTareas */

$this->menu=array(
	array('label'=>'Crear Tareas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#personal-tareas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

if(isset($_GET['filtro']))
{
	if ($_GET['filtro'] == 1) {
		$titulo = " - Activas";
	}

	if ($_GET['filtro'] == 2) {
		$titulo = " - Vencidas";
	}
}
else
{
	$titulo = "";
}

?>

<h1>Buscar Tareas <?php echo $titulo; ?></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'personal-tareas-grid',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePickerTareas', // (#1)
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
		array(
			'header'=>'Personal Asignado:',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'personal\'][\'nombreCompleto\']',
		),
		array(
			'name'=>'tarea',
			'value'=>'$data->tarea',
			'htmlOptions'=>array('width'=>'500'),
		),
		array(
			'header'=>'Fecha a Cumplir',
			'name'=>'fecha_cumplir',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_cumplir',
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
						'id' => 'datepicker_for_fecha_cumplir',
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
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_cumplir\']);',
			'htmlOptions'=>array('width'=>'80'),
		),
		array(
			'name'=>'estado',
			'filter' => array('Activa' => 'Activa', 'Completada' => 'Completada', 'Vencida' => 'Vencida'),
			'value'=>'$data->estado',
		),
		array(
			'header'=>'Personal que Asigno:',
			'name'=>'usuario_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'usuario\'][\'nombreCompleto\']',
		),
		//'fecha',
		/*
		
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerTareas(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha_cumplir').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha_cumplir').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha_cumplir').datepicker({dateFormat: 'dd-mm-yy'});
}
");

?>
<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#personal-tareas-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#personal-tareas-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('personalTareas/view'); ?>&id=' + rowId;
        });
    });
</script>