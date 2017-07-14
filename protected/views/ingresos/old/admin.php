<?php
/* @var $this IngresosController */
/* @var $model Ingresos */

// $this->menu=array(
// 	//array('label'=>'Listar Ingresos', 'url'=>array('index')),
// 	//array('label'=>'Crear Ingreso', 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ingresos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Buscar Ingresos - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<DIV style='width:150%; overflow:scroll;'>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ingresos-grid',
	'template'=>'{items}{summary}{pager}',
	//'template'=>"{summary}\n{items}\n{pager}",
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'reinstallDatePickerIngresos', // (#1)
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
		// 	'htmlOptions'=>array('width'=>'220'),
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
		'n_identificacion',
		array(
			'name'=>'valor',
			'value'=>'number_format($data->valor,2)',
			'htmlOptions'=>array('width'=>'100'),
			'footer'=>$model->searchSuma()->itemCount===0 ? '' : "<h6>$ ".number_format($model->getTotal($model->searchSuma()),2).'</h6>',

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
		'descripcion',
		array(
			'header'=>'Centro de Costo',
			'name'=>'centro_costo_id',
			'filter'=>CHtml::listData(CentroCosto::model()->findAll(array('order'=>'nombre ASC')), 'id','nombre'), // Colocamos un combo en el filtro
			'value'=>'$data[\'centroCosto\'][\'nombre\']',
			'htmlOptions'=>array('width'=>'200'),
		),
		'forma_pago',
		array(
			'header'=>'Vendido por:',
			'name'=>'vendedor_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->vendedor->nombreCompleto',
			'htmlOptions'=>array('width'=>'150'),
		),
		array(
			'header'=>'Contrato',
			'name'=>'contrato_id',
			'value'=>'$data->contrato_id',
			'htmlOptions'=>array('width'=>'40'),
		),
		array(
			'name'=>'estado',
			'filter' => array('Activo'=>'Activo','Anulado'=>'Anulado'),
			'value'=>'$data->estado',
		),
		array(
			'name'=>'tarjeta_tipo',
			'filter' => array('American Express'=>'American Express', 'Debito Maestro'=>'Debito Maestro','Diners Club'=>'Diners Club', 'Mastercard'=>'Mastercard','VISA'=>'VISA'),
			'value'=>'$data->tarjeta_tipo',
		),
		array(
			'header'=>'Número de Autorización',
			'name'=>'tarjeta_aprobacion',
			'value'=>'$data->tarjeta_aprobacion',
		),
		
		array(
			'header'=>'Cuenta de Ingreso',
			'name'=>'tarjeta_banco_cuenta_id',
			'filter'=>CHtml::listData(BancosCuentas::model()->findAll(array('order'=>'numero ASC')), 'id','numero'), // Colocamos un combo en el filtro
			//'value'=>'$data->tarjetaBancoCuenta->numero',
			'value'=>'$data[\'tarjetaBancoCuenta\'][\'numero\']',
			'htmlOptions'=>array('width'=>'150'),
		),
		array(
			'header'=>'Realizado por:',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->personal->nombreCompleto',
			'htmlOptions'=>array('width'=>'150'),
		),

		array(
			'header'=>'Seguimiento:',
			'name'=>'personal_seguimiento',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data->personalSeguimiento->nombreCompleto',
			'htmlOptions'=>array('width'=>'150'),
		),
		/*
		'cheques_cantidad',
		'cheques_banco_cuenta_id',
		'cheques_total',
		
		'consigna_banco_o',
		'consigna_cuenta_o',
		'consigna_banco_d_cuenta_id',
		'personal_id',
		*/
		array(
			//'summaryText' => '', // 1st way
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerIngresos(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha_sola').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha_sola').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha_sola').datepicker({dateFormat: 'dd-mm-yy'});
}
");


// $countData = $model->search();

// $elTotal = 0;
// foreach ($countData->data as $count_data) 
// {
// 	$elTotal = $elTotal + $count_data->valor;
// }

// echo "La suma: ".$elTotal;

?>
</div>

<div id="exportar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Exportar a un archivo de Excel </h3>
  </div>
  <div class="modal-body">
  	<p>Seleccione las opciones de Exportar</p>
 	<form id="frmExportar" name="frmExportar" action="index.php?r=Ingresos/exportar&tipo=<?php $elTipo;?>" method = "post">
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
  		<div class="span5">
  			<label>Clave:</label>
  			<div class="input-prepend">
  			<span class="add-on"><i class="icon-lock"></i></span>
	    	 	<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
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
        $('body').on('dblclick', '#ingresos-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#ingresos-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('ingresos/view'); ?>&id=' + rowId;
        });
    });
</script>