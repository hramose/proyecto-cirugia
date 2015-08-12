<?php
/* @var $this CuentasXcController */
/* @var $model CuentasXc */

$this->menu=array(
	//array('label'=>'List CuentasXc', 'url'=>array('index')),
	//array('label'=>'Create CuentasXc', 'url'=>array('create')),
	array('label'=>'Cuentas por Paciente', 'url'=>"index.php?r=cuentasXc/admin"),
	array('label'=>'Cuentas por Contrato', 'url'=>"index.php?r=cuentasXcDetalle/contratos"),
	array('label'=>'Cuentas por Servicio', 'url'=>"index.php?r=cuentasXcDetalle/servicio"),
);

?>

<h1>Cuentas por Cobrar por Paciente - <a href="#exportar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-share-alt icon-white"></i> Exportar</a></h1>
<p>Para detalles de la cuenta ingrese al perfil del paciente.</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cuentas-xc-grid',
	'dataProvider'=>$model->search(),
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
			'name'=>'saldo',
			'value'=>'number_format($data->saldo,2)',
			'htmlOptions'=>array('width'=>'120'),
			//'footer'=>"<h5>$ ".number_format($model->search()->itemCount===0 ? '' : $model->getTotal($model->search()),2).'</h5>',
			'footer'=>"<h6>$ ".number_format($model->getTotal($model->searchSuma()),2).'</h6>',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
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
 	<form id="frmExportar" name="frmExportar" action="index.php?r=cuentasXc/exportar&tipo=<?php $elTipo;?>" method = "post">
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
        $('body').on('dblclick', '#cuentas-xc-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#cuentas-xc-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('cuentasXc/view'); ?>&id=' + rowId;
        });
    });
</script>