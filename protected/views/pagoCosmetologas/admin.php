
<?php
/* @var $this PagoCosmetologasController */
/* @var $model PagoCosmetologas */

$this->menu=array(
	//array('label'=>'List PagoCosmetologas', 'url'=>array('index')),
	//array('label'=>'Create PagoCosmetologas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pago-cosmetologas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Pago a Asistenciales - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<DIV style='width:150%; overflow:scroll;'>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pago-cosmetologas-grid',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePickerPagoCosmetologa', // (#1)
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		// array(
		// 	'header'=>'<small>Paciente</small>',
		// 	'name'=>'paciente_id',
		// 	'filter'=>CHtml::listData(Paciente::model()->findAll(), 'id','nombreCompleto'), // Colocamos un combo en el filtro
		// 	'value'=>'$data[\'paciente\'][\'nombreCompleto\']',
		// 	'htmlOptions'=>array('width'=>'220'),
		// ),
		array(
		   'header'=>'<small>Nombre Paciente</small>',
		   'name'=>'nombre_paciente',
		   'value'=>'$data->paciente->nombre',
		   'htmlOptions'=>array('width'=>'100'),
		   'headerHtmlOptions'=>array('style'=>'width:150px;text-align:center;'),
		),
		array(
		   'header'=>'<small>Apellido Paciente</small>',
		   'name'=>'apellido_paciente',
		   'value'=>'$data->paciente->apellido',
		   'htmlOptions'=>array('width'=>'100'),
		   'headerHtmlOptions'=>array('style'=>'width:150px;text-align:center;'),
		),
		'n_identificacion',
		array(
			'header'=>'<small>Asistencial</small>',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'personal\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'header'=>'<small>Tratamiento Realizado</small>',
			'name'=>'linea_servicio_id',
			'filter'=>CHtml::listData(LineaServicio::model()->findAll(array('order'=>'nombre ASC', 'condition' =>"estado = 'activo'")), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'lineaServicio\'][\'nombre\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		'sesion',
		array(
			'header'=>'<small>Fecha de acción</small>',
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
			'htmlOptions'=>array('width'=>'120'),
		),
		'contrato_id',
		array(
			'name'=>'valor_tratamiento',
			'value'=>'number_format($data->valor_tratamiento,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal($model->searchSuma()),2).'</h5>',
		),
		array(
			'header'=>'<small>Tratamiento con Descuento</small>',
			'name'=>'valor_tratamiento_desc',
			'value'=>'number_format($data->valor_tratamiento_desc,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal5($model->searchSuma()),2).'</h5>',
		),
		array(
			'name'=>'valor_comision',
			'value'=>'number_format($data->valor_comision,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal2($model->searchSuma()),2).'</h5>',
		),
		array(
			'header'=>'Vendedor',
			'name'=>'vendedor_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'vendedor\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'header'=>'Establecio estado',
			'name'=>'aprobo_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'aprobo\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'header'=>'Total de Pago',
			'name'=>'total_pago',
			'value'=>'number_format($data->total_pago,2)',
			'htmlOptions'=>array('width'=>'120'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h5>$ ".number_format($model->getTotal4($model->searchSuma()),2).'</h5>',
		),

		array(
			'header'=>'Saldo a Favor',
			'name'=>'saldo',
			'value'=>'number_format($data->saldo,2)',
			'htmlOptions'=>array('width'=>'120'),
			//'footer'=>"<h5>$ ".number_format($model->search()->itemCount===0 ? '' : $model->getTotal4($model->search()),2).'</h5>',
		),
		/*
		'estado',
		'fecha_pago',
		*/
		// array(
		// 	'class'=>'CButtonColumn',
		// ),
	),
)); 

	Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerPagoCosmetologa(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha').datepicker({dateFormat: 'dd-mm-yy'});
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
 	<form id="frmExportar" name="frmExportar" action="index.php?r=PagoCosmetologas/exportar&tipo=<?php $elTipo;?>" method = "post">
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
        $('body').on('dblclick', '#pago-cosmetologas-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#pago-cosmetologas-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('PagoCosmetologas/view'); ?>&id=' + rowId;
        });
    });
</script>