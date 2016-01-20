<?php
/* @var $this PacienteController */
/* @var $model Paciente */

$this->menu=array(
	array('label'=>'Listar Pacientes', 'url'=>array('index')),
	array('label'=>'Ingresar Paciente', 'url'=>array('create')),
);



// Yii::app()->clientScript->registerScript('search', "
// 	// $('body').on('keyup','.filters > td > input', function() {
// 	//     $('#paciente-grid').yiiGridView('update', {
// 	//         data: $(this).serialize()  
// 	//     });
// 	//     return false; 
// 	// });

//   //Filters search on keyup rather than having to press enter
//     var timer;
//     $('#paciente-grid .filters input[type=text] ').live('keyup', function(e){
//         var focusedId = $(document.activeElement).attr('id');
//         clearTimeout(timer);
//         timer = setTimeout(function() {
//                     $.fn.yiiGridView.update('paciente-grid', {
//                         data: $('#grid-form').serialize(),
//                         complete: function(jqXHR, status) {
//                             if (status=='success'){
//                                 //refocus last filter input box.
//                                 $('#' + focusedId).focus();
//                                 tmpStr = $('#' + focusedId).val();
//                                 $('#' + focusedId).val('');
//                                 $('#' + focusedId).val(tmpStr);
//                             }
//                         }

//                     });
//                 }, 300);
//     });
// ");



?>

<h1>Buscar Pacientes - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'paciente-grid',
	'dataProvider'=>$model->search(),
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
		array(
			'header'=>'Estado',
			'name'=>'estado',
			'value'=>'$data->estado_texto',
			'filter' => array('0'=>'Inactivo', '1'=>'Activo'),
			),
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
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
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

<div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=paciente/exportar&tipo=<?php $elTipo;?>" method = "post">
  		<div class="span6">
			<label>Filtro:</label>
			<select name="filtro" id="filtro" class="input-normal">
				<option value="0">(Todos)</option>
				<option value="1">Rango de fecha ingreso</option>
			</select>
  		</div>
  		<div class="span6">
  			<label>Clave:</label>
  			<div class="input-prepend">
  			<span class="add-on"><i class="icon-lock"></i></span>
	    	 	<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
  			</div>
  		</div>
  		<div class="span12" id="elFiltro" style="display: none">
  			<div class="span5">
  				<label>Desde:</label>
  				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'fecha_desde',
						'language'=>'es',
						'model' => '',
						'attribute' => 'fecha_desde',
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'language' => 'es',
							'dateFormat' => 'dd-mm-yy',
							'changeMonth'=>true,
	        				'changeYear'=>true,
	        				'yearRange'=>'2015:2025',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;width:80px;',
						),
					));
				?>	
  			</div>

  			<div class="span5">
  				<label>Hasta:</label>
				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'name'=>'fecha_hasta',
						'language'=>'es',
						'model' => '',
						'attribute' => 'fecha_hasta',
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'language' => 'es',
							'dateFormat' => 'dd-mm-yy',
							'changeMonth'=>true,
	        				'changeYear'=>true,
	        				'yearRange'=>'2015:2025',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;width:80px;',
						),
					));
				?>	
  			</div>
  		</div>
  		<br>
  		
  		<br>
  		<div class="span12">
	  		<input type="submit" value="Exportar" name="exportar" id="exportar" class="btn btn-warning">
  		</div>
  	</form>	 	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


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

            location.href = '<?php echo Yii::app()->createUrl('paciente/view'); ?>&id=' + rowId;
        });
    });
</script>