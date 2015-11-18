<h2>Control de Citas Vencidas por Personal de Servicio</h2>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<DIV style='width:175%; overflow:scroll;'>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'citas-grid',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
		// array(
		// 	'header'=>'Paciente',
		// 	'name'=>'paciente_id',
		// 	'filter'=>CHtml::listData(Paciente::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
		// 	'value'=>'$data[\'paciente\'][\'nombreCompleto\']',
		// 	'htmlOptions'=>array('width'=>'250'),
		// ),
		array(
		   'name'=>'nombre_paciente',
		   'value'=>'$data->paciente->nombre',
		   'htmlOptions'=>array('width'=>'100'),
		   'headerHtmlOptions'=>array('style'=>'width:150px;text-align:center;'),
		),
		array(
		   'name'=>'apellido_paciente',
		   'value'=>'$data->paciente->apellido',
		   'htmlOptions'=>array('width'=>'100'),
		   'headerHtmlOptions'=>array('style'=>'width:150px;text-align:center;'),
		),
		array(
		   'name'=>'cedula_paciente',
		   'value'=>'$data->paciente->n_identificacion',
		   //'htmlOptions'=>array('width'=>'100'),
		   'headerHtmlOptions'=>array('style'=>'width:150px;text-align:center;'),
		),
		// array(
		// 	'name'=>'n_identificacion',
		// 	'value'=>'$data[\'n_identificacion\']',
		// 	'htmlOptions'=>array('width'=>'100'),
		// ),
		array(
			'header'=>'Celular',
			'value'=>'$data[\'paciente\'][\'celular\']',
			'htmlOptions'=>array('width'=>'100'),
		),
		array(
			'header'=>'Personal',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'personal\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'name'=>'linea_servicio_id',
			'htmlOptions'=>array('width'=>'180'),
			'filter'=>CHtml::listData(LineaServicio::model()->findAll(array('order'=>'nombre ASC', 'condition' =>"estado = 'activo'")), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'lineaServicio\'][\'nombre\']',

		),
		array(
			'header'=>'Contrato',
			'name'=>'contrato_id',
			'value'=>'$data->contrato_id',
			'htmlOptions'=>array('width'=>'30'),
		),
		array(
			'name'=>'estado',
			'filter' => array('Cancelada'=>'Cancelada', 'Completada'=>'Completada', 'Fallida'=>'Fallida', 'Programada'=>'Programada', 'Vencida'=>'Vencida'),
			'value'=>'$data->estado',
		),
		array(
			'header'=>'Fecha',
			'name'=>'fecha_cita',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_cita',
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
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_cita\']);',
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
			'header'=>'Registrada por:',
			'name'=>'usuario_id',
			'filter'=>CHtml::listData(Usuarios::model()->findAll(), 'personal_id','personal.nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'usuario\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'name'=>'fecha_creacion',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_creacion',
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
						'id' => 'datepicker_for_fecha_creacion',
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
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_creacion\']);',
			'htmlOptions'=>array('width'=>'80'),
		),
		array(
			'header'=>'Confirmación',
			'name'=>'confirmacion',
			'value'=>'$data[\'confirmacion\']',
		),
		array(
			'header'=>'Comentario de Seguimiento',
			'name'=>'comentario_cierre',
			'value'=>'$data[\'comentario_cierre\']',
			'htmlOptions'=>array('width'=>'500'),
		),
		array(
			'header'=>'Comentario',
			'name'=>'comentario',
			'value'=>'$data[\'comentario\']',
			'htmlOptions'=>array('width'=>'500'),
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
    $('#datepicker_for_fecha_creacion').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha_cita').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha_cita').datepicker({dateFormat: 'dd-mm-yy'});
}
");

 ?>
</div>

 <div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=Citas/exportar&tipo=<?php $elTipo;?>" method = "post">
  		<div class="span5">
			<label>Filtro:</label>
			<select name="filtro" id="filtro" class="input-normal">
				<option value="0">(Todos)</option>
				<option value="1">Rango de fecha</option>
			</select>
  		</div>
  		<div class="span5" id="elFiltro" style="display: none">
  			<div class="span2">
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

  			<div class="span2">
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
  		<div class="span5">
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
        $('body').on('dblclick', '#citas-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#citas-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('citas/view'); ?>&id=' + rowId;
        });
    });
</script>