<?php
/* @var $this ProductoInventarioController */
/* @var $model ProductoInventario */

$this->menu=array(
	//array('label'=>'Listar Productos', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Listar Todos', 'url'=>"index.php?r=productoInventario/admin&tipo=0"),
	array('label'=>'Listar Productos', 'url'=>"index.php?r=productoInventario/admin&tipo=1"),
	array('label'=>'Listar Insumos', 'url'=>"index.php?r=productoInventario/admin&tipo=2"),
	array('label'=>'Listar Consumibles', 'url'=>"index.php?r=productoInventario/admin&tipo=3"),
	array('label'=>'Listar Inactivos', 'url'=>"index.php?r=productoInventario/admin&tipo=4"),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-inventario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php 

	if (isset($_GET['tipo'])) {
		$elTipo = $_GET['tipo'];
		if ($elTipo == 0) {
			$subtitulo = "(Todos)";
		}

		if ($elTipo == 1) {
			$subtitulo = "";
		}

		if ($elTipo == 2) {
			$subtitulo = "Insumos";
		}

		if ($elTipo == 3) {
			$subtitulo = "Consumibles";
		}

		if ($elTipo == 4) {
			$subtitulo = "Inactivos";
		}
	}
	else
	{
		$subtitulo = "(Todos)";
		$elTipo = 0;
	}

?>

<h1>Buscar Productos <?php echo $subtitulo; ?> - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-inventario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		array(
			'header'=>'Producto',
			'name'=>'id',
			'filter'=>CHtml::listData(ProductoInventario::model()->findAll(), 'id','nombre_producto'), // Colocamos un combo en el filtro
			'value'=>'$data->nombre_producto',
			'htmlOptions'=>array('width'=>'220'),
		),
		'producto_referencia',
		'lote',
		'cantidad',
		array(
			'name'=>'costo_iva',
			'value'=>'number_format($data->costo_iva,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>"<h6>$ ".number_format($model->getTotal($model->search()),2).'</h6>',
		),
		array(
			'name'=>'precio_publico',
			'value'=>'number_format($data->precio_publico,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>"<h6>$ ".number_format($model->getTotal2($model->search()),2).'</h6>',
		
		),

		'iva',
		array(
			'name'=>'tipo_inventario',
			'filter' => array('Consumibles'=>'Consumibles','Insumos'=>'Insumos','Productos'=>'Productos'),
			'value'=>'$data->tipo_inventario',
			),
		array(
			'name'=>'estado',
			'filter' => array('Activo'=>'Activo','Inactivo'=>'Inactivo'),
			'value'=>'$data->estado',
			),
		/*
		'producto_presentacion_id',
		'cantidad',
		'producto_unidad_medida_id',
		'stock_minimo',
		'producto_proveedor_id',
		'producto_categoria_id',
		'estado',
		'personal_id',
		'fecha',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		'buttons'=>array('view'=>
array(
    'url'=>'Yii::app()->createUrl("productoInventario/view", array("id"=>$data->id,"asDialog"=>1))',
    'options'=>array(  
    'ajax'=>array(
            'type'=>'POST',
                // ajax post will use 'url' specified above 
            'url'=>"js:$(this).attr('href')", 
            'update'=>'#id_view',
           ),
     ),
     ),
   ),
//--------------------- end added --------------------------
  ),
  ),
)); ?>

<div id="id_view"></div>

<!-- Ventanas Modales -->
<div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=ProductoInventario/exportar&tipo=<?php echo $elTipo;?>" method = "post">
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
        $('body').on('dblclick', '#producto-inventario-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#producto-inventario-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('productoInventario/view'); ?>&id=' + rowId;
        });
    });
</script>