<?php
/* @var $this ProductoComprasController */
/* @var $model ProductoCompras */

$this->menu=array(
	//array('label'=>'Listar Compras de Productos', 'url'=>array('index')),
	//array('label'=>'Crear Compra', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-compras-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Cuentas por Pagar - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cxp-grid',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePickerCxp', // (#1)
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
		array(
			'header'=>'Proveedor',
			'name'=>'producto_proveedor_id',
			'filter'=>CHtml::listData(ProductoProveedor::model()->findAll(array('order'=>'nombre ASC')), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'productoProveedor\'][\'nombre\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		'factura_n',
		array(
			'header'=>'Total de Compra',
			'name'=>'total_compra',
			'value'=>'number_format($data->total_compra,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->search()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal($model->search()),2).'</h5>',
		),
		'forma_pago',
		array(
			'header'=>'Término (días)',
			'name'=>'credito_dias',
			'value'=>'$data->credito_dias',
			'htmlOptions'=>array('width'=>'60'),
		),
		array(
			'header'=>'Saldo',
			'name'=>'saldo',
			'value'=>'number_format($data->saldo,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->search()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal2($model->search()),2).'</h5>',
		),
		array(
			'header'=>'Fecha',
			'name'=>'fecha_sola',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_sola',
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
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_sola\']);',
			'htmlOptions'=>array('width'=>'80'),
		),
		'credito_fecha',
		array(
			'header'=>'Estado',
			'name'=>'estado',
			'filter' => array('Activo'=>'Activo', 'Cancelada'=>'Cancelada', 'Pagada'=>'Pagada'),
			'value'=>'$data->estado',
			'htmlOptions'=>array('width'=>'60'),
		),
		/*
		'descuento',
		'descuento_tipo',
		'descuento_valor',
		'descuento_total',
		'iva',
		'iva_total',
		'retencion_id',
		'retencion_retener',
		'retencion_base',
		'retencion_porcentaje',
		'rte_iva',
		'rte_iva_valor',
		'rte_ica',
		'rte_ica_porcentaje',
		'rte_ica_valor',
		'cantidad_productos',
		'total_orden',
		'total',
		'total_compra',
		'centro_costo_id',
		'personal_id',
		'fecha',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerCxp(id, data) {
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
 	<form id="frmExportar" name="frmExportar" action="index.php?r=productoCompras/exportarCxp&idCompra=<?php echo $model->id;?>" method = "post">
  		<div class="span5">
			<label>Filtro:</label>
			<select name="filtro" id="filtro" class="input-normal">
				<option value="0">(Todos)</option>
				<option value="1">Rango de fecha</option>
			</select>
  		</div>
  		
  		<div class="span10" id="elFiltro" style="display: none">
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
  		<div class="span5">
  			<label>Clave:</label>
  			<div class="input-prepend">
  			<span class="add-on"><i class="icon-lock"></i></span>
	    	 	<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
  			</div>
  		</div>
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

<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#cxp-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#cxp-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('ProductoCompras/view'); ?>&id=' + rowId;
        });
    });
</script>

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