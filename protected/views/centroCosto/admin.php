<?php
/* @var $this CentroCostoController */
/* @var $model CentroCosto */


$this->menu=array(
	array('label'=>'Listar Centros de Costo', 'url'=>array('index')),
	array('label'=>'Crear Centro de Costo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#centro-costo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Centro de Costo - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'centro-costo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		'nombre',
		'tipo',
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=centroCosto/exportar&tipo=<?php $elTipo;?>" method = "post">
  		<div class="span12">
			<label>Filtro:</label>
			<select name="filtro" id="filtro" class="input-normal">
				<option value="0">(Todos)</option>
				<!--<option value="1">Rango de fecha</option>-->
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
        $('body').on('dblclick', '#centro-costo-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#centro-costo-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('tratamientoInteres/view'); ?>&id=' + rowId;
        });
    });
</script>
