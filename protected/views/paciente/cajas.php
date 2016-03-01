<?php
/* @var $this PacienteController */
/* @var $model Paciente */

$this->menu=array(
	array('label'=>'Listar Pacientes', 'url'=>array('index')),
	array('label'=>'Ingresar Paciente', 'url'=>array('create')),
);
?>

<h1>Cajas de Pacientes</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'paciente-grid',
	'dataProvider'=>$model->searchCajas(),
	'afterAjaxUpdate' => 'reinstallDatePickerNacimiento', // (#1)

	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		'nombre',
		'apellido',
		'n_identificacion',
		'email',
		'telefono1',
		'celular',
		/*'genero',*/
		array(
			'header'=>'Fecha Nacimiento',
			'name'=>'fecha_nacimiento',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_nacimiento',
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'1900:2000',
					),
					'htmlOptions'=>array(
						'id' => 'datepicker_for_fecha_nacimiento',
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
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_nacimiento\']);',
			'htmlOptions'=>array('width'=>'80'),
		),
		'saldo',
		/*
		'fecha_registro',
		'email2',
		'telefono2',
		'direccion',
		'ciudad',
		'pais',
		'referer_contact',
		'estado_civil',
		'ocupacion',
		'tipo_vinculacion',
		'Aseguradora',
		'nombre_acompanante',
		'acompanante_telefono',
		'nombre_responsable',
		'relacion_responsable',
		'telefono_responsable',
		'responsable',
		'historia_id',
		'tratamiento_interes_id',
		*/
		// array(
		// 	'class'=>'CButtonColumn',
		// 	'template'=>'{view}{update}',
		// ),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerNacimiento(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha_nacimiento').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha_nacimiento').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha_nacimiento').datepicker({dateFormat: 'dd-mm-yy'});
}
");

?>



<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#filtro").change(function (){
	    
	    if($("#filtro").val() == 1)
	    	{
	    		$("#elFiltro").toggle("slow");
	    	}
	    else
	    	{
	    		$("#elFiltro").hide();
	    	}
	});
	});
</script>

<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#paciente-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#paciente-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();
            location.href = '<?php echo Yii::app()->createUrl('pacienteMovimientos/viewCaja'); ?>&id=' + rowId;
        });
    });
</script>