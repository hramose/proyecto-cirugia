<?php
/* @var $this ProductoComprasController */
/* @var $model ProductoCompras */

$this->menu=array(
	//array('label'=>'Listar Compras de Productos', 'url'=>array('index')),
	array('label'=>'Crear Compra', 'url'=>array('create')),
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

<h1>Buscar Compras de Productos - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-compras-grid',
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
			'header'=>'Proveedor',
			'name'=>'producto_proveedor_id',
			'filter'=>CHtml::listData(ProductoProveedor::model()->findAll(array('order'=>'nombre ASC')), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'productoProveedor\'][\'nombre\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'name'=>'nit',
			'value'=>'$data->nit',
			'htmlOptions'=>array('width'=>'100'),
		),
		'factura_n',
		'forma_pago',
		array(
			'name'=>'total_compra',
			'value'=>'number_format($data->total_compra,2)',
			'footer'=>"<h6>$ ".number_format($model->getTotal($model->search()),2).'</h6>',
		),
		'fecha',
		array(
			'header'=>'Realizado por:',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Usuarios::model()->findAll(), 'personal_id','personal.nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->personal->nombreCompleto',
			'htmlOptions'=>array('width'=>'180'),
		),
			array(
			'name'=>'estado',
			'filter' => array('Activo'=>'Activo','Anulada'=>'Anulada'),
			'value'=>'$data->estado',
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
			'template'=>'{view}',
		),
	),
)); 
?>

<div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=productoCompras/exportar&tipo=<?php $elTipo;?>" method = "post">
  		<div class="span12">
			<label>Filtro:</label>
			<select name="filtro" id="filtro" class="input-normal">
				<option value="0">(Todos)</option>
				<option value="1">Rango de fecha</option>
			</select>
  		</div>
  		<div class="span12" id="elFiltro" style="display: none">
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
        $('body').on('dblclick', '#producto-compras-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#producto-compras-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('ProductoCompras/view'); ?>&id=' + rowId;
        });
    });
</script>