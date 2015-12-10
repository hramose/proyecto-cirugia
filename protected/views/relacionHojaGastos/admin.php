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

<h1>Relación Hoja de Gastos - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'relacion-hoja-gastos-grid',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePickerVentas', // (#1)
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
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
			'header'=>'Cedula',
		   'name'=>'n_identificacion',
		   'value'=>'$data->paciente->n_identificacion',
		   'htmlOptions'=>array('width'=>'50'),
		   'headerHtmlOptions'=>array('style'=>'width:75px;text-align:center;'),
		),
		array(
			'name'=>'hoja',
			'filter' => array('Hoja de Gatos'=>'Hoja de Gatos','Hoja de Gatos Cirugia'=>'Hoja de Gatos Cirugia'),
			'value'=>'$data->hoja',
		),
		array(
			'header'=>'Asistencial:',
			'name'=>'asistencial_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
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
						'id' => 'datepicker_for_fecha',
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
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'personal\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'180'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerVentas(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha').datepicker({dateFormat: 'dd-mm-yy'});
}
");

?>


<!-- Ventanas Modales -->
<div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=RelacionHojaGastos/exportar" method = "post">
  		<div class="span5">
			<label>Filtro:</label>
			<select name="filtro" id="filtro" class="input-normal">
				<option value="0">(Todos)</option>
				<option value="1">Rango de fecha</option>
			</select>
  		</div>
  		<div class="span5">
  			<label>Clave:</label>
  			<div class="input-prepend">
  			<span class="add-on"><i class="icon-lock"></i></span>
	    	 	<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
  			</div>
  		</div>
  		<div class="span8" id="elFiltro" style="display: none">
  			<div class="span4">
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

  			<div class="span4">
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
  		<div class="span3">
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