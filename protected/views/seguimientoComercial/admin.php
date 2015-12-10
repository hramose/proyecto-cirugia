<?php
/* @var $this SeguimientoComercialController */
/* @var $model SeguimientoComercial */

$this->menu=array(
	// array('label'=>'Listar Seguimiento Comercial', 'url'=>array('index')),
	// array('label'=>'Crear Seguimiento Comercial', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seguimiento-comercial-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php 
	if(isset($_GET['filtro']))
	{
		if ($_GET['filtro'] == 1) {
			$titulo = "Seguimiento Comercial Abierto";
		}
		if ($_GET['filtro'] == 2) {
			$titulo = "Seguimiento Comercial Cerrado";
		}	
		if ($_GET['filtro'] == 3) {
			$titulo = "Seguimiento Comercial Vencidos";
		}
	}
?>
<h1><?php echo $titulo; ?></h1>

<div class="search-form" style="display:none">
<?php 

$this->renderPartial('_search',array(
	'model'=>$model,

)); ?>
</div><!-- search-form -->

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'seguimiento-comercial-abiertos-grid',
			'dataProvider'=>$model->search(),
			'afterAjaxUpdate' => 'reinstallDatePickerSeguimiento', // (#1)
			'filter'=>$model,
			'columns'=>array(
				array(
					'header'=>'ID.',
					'name'=>'id',
					'value'=>'$data->id',
					'htmlOptions'=>array('width'=>'25'),
				),
				array(
						'header'=>'Fecha de acción',
						'name'=>'fecha_accion',
						'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'language'=>'es',
								'model' => $model,
								'attribute' => 'fecha_accion',
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
									'id' => 'datepicker_for_fecha_accion',
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
						'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_accion\']);',
						'htmlOptions'=>array('width'=>'80'),
					),
				array(
						'header'=>'Paciente',
						'name'=>'paciente_id',
						'filter'=>CHtml::listData(Paciente::model()->findAll(array('order'=>'nombre ASC')), 'id','nombreCompleto'), // Colocamos un combo en el filtro
						'value'=>'$data->paciente->nombreCompleto',
						'htmlOptions'=>array('width'=>'220'),
					),
				'n_identificacion',
				array(
					'header'=>'Tema',
					'name'=>'tema_id',
					'filter'=>CHtml::listData(SeguimientoTema::model()->findAll(array('order'=>'nombre ASC')), 'id','nombre'), // Colocamos un combo en el filtro
					'value'=>'$data[\'tema\'][\'nombre\']',
					//'htmlOptions'=>array('width'=>'220'),
				),
				array(
					'header'=>'Observaciones',
					'name'=>'observaciones',
					'value'=>'$data->observaciones',
				),
				array(
					'header'=>'Ultimo Seguimiento',
					'name'=>'ultimo_seguimiento',
					'value'=>'$data->ultimo_seguimiento',
				),
				array(
					'header'=>'Responsable de Seguimiento',
					'name'=>'responsable_id',
					'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
					'value'=>'$data[\'responsable\'][\'nombreCompleto\']',
					//'htmlOptions'=>array('width'=>'220'),
				),
				array(
					'header'=>'Registrado por:',
					'name'=>'id_personal',
					'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
					'value'=>'$data[\'idPersonal\'][\'nombreCompleto\']',
					'htmlOptions'=>array('width'=>'220'),
				),
				/*
				'observaciones',
				'estado',
				*/
				// array(
				// 	'class'=>'CButtonColumn',
				// ),
			),
		)); ?>


	<?php 
	Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePickerSeguimiento(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_fecha_accion').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'}));
    //$('#datepicker_for_fecha_accion').datepicker($.datepicker.regional[ 'es' ]);
  //$('#datepicker_for_fecha_accion').datepicker({dateFormat: 'dd-mm-yy'});
}
");

	?>

<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#seguimiento-comercial-abiertos-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#seguimiento-comercial-abiertos-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('seguimientoComercial/view'); ?>&id=' + rowId;
        });
    });
</script>