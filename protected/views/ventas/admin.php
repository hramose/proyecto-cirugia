<?php
/* @var $this VentasController */
/* @var $model Ventas */

$this->menu=array(
	//array('label'=>'Listar Ventas', 'url'=>array('index')),
	array('label'=>'Crear Venta', 'url'=>array('create')),
);
?>

<h1>Buscar Ventas - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a> - <a href="index.php?r=ventas/create" class="btn btn-success" role="button" ><i class="icon-plus icon-white"></i> Crear Venta</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ventas-grid',
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
			'header'=>'Paciente',
			'name'=>'paciente_id',
			'filter'=>CHtml::listData(Paciente::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'paciente\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'name'=>'n_identificacion',
			'value'=>'$data->n_identificacion',
			'htmlOptions'=>array('width'=>'100'),
		),
		'descripcion',
		array(
			'name'=>'forma_pago',
			'value'=>'$data->forma_pago',
			'filter' => array('Efectivo'=>'Efectivo', 'Crédito'=>'Crédito', 'Cheque'=>'Cheque', 'Tarjeta'=>'Tarjeta', 'Consignación'=>'Consignación'),
		),
		array(
			'name'=>'sub_total',
			'value'=>'number_format($data->sub_total,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->search()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal5($model->search()),2).'</h5>',
		),
		array(
			'name'=>'total_iva',
			'value'=>'number_format($data->total_iva,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->search()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal4($model->search()),2).'</h5>',
		),
		array(
			'name'=>'descuento',
			'filter' => array('Si'=>'Si','No'=>'No'),
			'value'=>'$data->descuento',
		),
		array(
			'name'=>'descuento_valor',
			'value'=>'number_format($data->descuento_valor,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->search()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal3($model->search()),2).'</h5>',
		),
		array(
			'name'=>'descuento_total',
			'value'=>'number_format($data->descuento_total,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->search()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal2($model->search()),2).'</h5>',
		),
		array(
			'name'=>'total_venta',
			'value'=>'number_format($data->total_venta,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->search()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal($model->search()),2).'</h5>',
		),
		array(
			'header'=>'Vendido por:',
			'name'=>'vendedor_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(), 'vendedor_id','personal.nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->vendedor->nombreCompleto',
			'htmlOptions'=>array('width'=>'180'),
		),
		array(
			'header'=>'Realizado por:',
			'name'=>'personal',
			'filter'=>CHtml::listData(Usuarios::model()->findAll(), 'personal_id','personal.nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->personal0->nombreCompleto',
			'htmlOptions'=>array('width'=>'180'),
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


<div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=Ventas/exportar&tipo=<?php $elTipo;?>" method = "post">
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
        $('body').on('dblclick', '#ventas-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#ventas-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('ventas/view'); ?>&id=' + rowId;
        });
    });
</script>

<?php 

/*
		'descuento_tipo',
		'descuento_valor',
		'descuento_total',
		'cant_productos',
		'total_orden',
		'forma_pago',
		'dinero_recibido',
		'dinero_cambio',
		'total_venta',
		'credito_dias',
		'credito_fecha',
		'cheques_cantidad',
		'cheques_cuenta_banco',
		'tarjeta_tipo',
		'tarjeta_aprobacion',
		'tarjeta_entidad',
		'tarjeta_cuenta_banco',
		'consignacion_cuenta_banco',
		'consignacion_banco',
		'consignacion_cuenta',
		'personal',
		'fecha_hora',
		'fecha',
		'estado',
		*/

?>