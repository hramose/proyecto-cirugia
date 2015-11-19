<?php
/* @var $this EgresosController */
/* @var $model Egresos */

$this->menu=array(
	//array('label'=>'List Egresos', 'url'=>array('index')),
	array('label'=>'Crear Egresos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#egresos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Egresos - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a> - <a href="index.php?r=egresos/create" class="btn btn-success" role="button" ><i class="icon-plus icon-white"></i> Crear Egreso</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'egresos-grid',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePickerEgreso', // (#1)
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30'),
		),
		// array(
		// 	'header'=>'Proveedor',
		// 	'name'=>'proveedor_id',
		// 	'filter'=>CHtml::listData(ProductoProveedor::model()->findAll(), 'id','nombre'), // Colocamos un combo en el filtro
		// 	'value'=>'$data[\'proveedor\'][\'nombre\']',
		// 	'htmlOptions'=>array('width'=>'220'),
		// ),

		array(
		   'header'=>'Proveedor',
		   'name'=>'proveedor_id',
		   'value'=>'$data->proveedor->nombre',
		   'htmlOptions'=>array('width'=>'220'),
		   'headerHtmlOptions'=>array('style'=>'width:150px;text-align:center;'),
		),
		array(
			'name'=>'n_identificacion',
			'value'=>'$data[\'n_identificacion\']',
			'htmlOptions'=>array('width'=>'150'),
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
						'id' => 'datepicker_for_fecha_sola',
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
		array(
			'header'=>'Factura',
			'name'=>'factura_id',
			//'filter'=>CHtml::listData(ProductoProveedor::model()->findAll(), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'factura\'][\'factura_n\']',
			'htmlOptions'=>array('width'=>'80'),
		),
		array(
			'name'=>'forma_pago',
			'filter' => array('Efectivo'=>'Efectivo','Consignación'=>'Consignación'),
			'value'=>'$data->forma_pago',
			'htmlOptions'=>array('width'=>'100'),
		),
		array(
			'name'=>'valor_egreso',
			'value'=>'number_format($data->valor_egreso,2)',
			'htmlOptions'=>array('width'=>'100'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h6>$ ".number_format($model->getTotal3($model->searchSuma()),2).'</h6>',
		),
		array(
			'name'=>'iva_valor',
			'value'=>'number_format($data->iva_valor,2)',
			'htmlOptions'=>array('width'=>'100'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h6>$ ".number_format($model->getTotal2($model->searchSuma()),2).'</h6>',
		),
		
		array(
			'header'=>'Centro de Costo',
			'name'=>'centro_costo_id',
			'filter'=>CHtml::listData(CentroCosto::model()->findAll(array('order'=>'nombre ASC')), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'centroCosto\'][\'nombre\']',
			'htmlOptions'=>array('width'=>'200'),
		),
		array(
			'name'=>'total_egreso',
			'value'=>'number_format($data->total_egreso,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h6>$ ".number_format($model->getTotal($model->searchSuma()),2).'</h6>',
		),
		array(
			'header'=>'Realizado por:',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->personal->nombreCompleto',
			'htmlOptions'=>array('width'=>'180'),
		),
		
		array(
			'name'=>'estado',
			'filter' => array('Activo'=>'Activo','Anulado'=>'Anulado'),
			'value'=>'$data->estado',
			
		),
		/*
		'desc_pronto_pago',
		'desc_pronto_pago_tipo',
		'desc_pronto_pago_valor',
		'iva_porcentace',
		'valor_egreso',
		'total_descuento',
		'iva_valor',
		'rte_aplica',
		'retencion_id',
		'a_retener',
		'rte_base',
		'rte_porcenaje',
		'rte_iva',
		'rte_iva_valor',
		'rte_ica',
		'rte_ica_porcentaje',
		'rte_ica_valor',
		'rte_cree',
		'rte_cree_porcentaje',
		'rte_cree_valor',
		'centro_costo_id',
		'total_egreso',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerEgreso(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha_sola').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha_sola').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha_sola').datepicker({dateFormat: 'dd-mm-yy'});
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
 	<form id="frmExportar" name="frmExportar" action="index.php?r=Egresos/exportar&tipo=<?php $elTipo;?>" method = "post">
  		<div class="span4">
			<label>Filtro:</label>
			<select name="filtro" id="filtro" class="input-normal">
				<option value="0">(Todos)</option>
				<option value="1">Rango de fecha</option>
			</select>
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
  		<div class="span4">
  			<label>Clave:</label>
  			<div class="input-prepend">
  			<span class="add-on"><i class="icon-lock"></i></span>
	    	 	<input type="password" class="input-normal" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
  			</div>
  		</div>
  		<br>
  		<div class="span8">
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
        $('body').on('dblclick', '#egresos-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#egresos-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('egresos/view'); ?>&id=' + rowId;
        });
    });
</script>