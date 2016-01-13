<?php
/* @var $this CitasReservadaController */
/* @var $model CitasReservada */

$this->menu=array(
	array('label'=>'Crear Reserva de Agenda', 'url'=>array('create')),
);

?>

<h1>Buscar Reserva de Cita</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'citas-reservada-grid',
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
			'header'=>'Personal',
			'name'=>'personal_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'personal\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'name'=>'hora_inicio',
			'filter'=>CHtml::listData(HorasServicio::model()->findAll(), 'id','hora'), // Colocamos un combo en el filtro
			'value'=>'$data[\'horaInicio\'][\'hora\']',
			'htmlOptions'=>array('width'=>'85'),
		),
		array(
			'name'=>'hora_fin',
			'filter'=>CHtml::listData(HorasServicio::model()->findAll(), 'id','hora'), // Colocamos un combo en el filtro
			'value'=>'$data[\'horaFin\'][\'hora\']',
			'htmlOptions'=>array('width'=>'85'),
		),
		array(
			'header'=>'Fecha de Inicio',
			'name'=>'fecha_inicio',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_inicio',
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
						'id' => 'datepicker_for_fecha_cita',
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
			'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data[\'fecha_inicio\']);',
			'htmlOptions'=>array('width'=>'80'),
		),
		'motivo',
		'observacion',
		array(
			'header'=>'Registrada por:',
			'name'=>'usuario_id',
			'filter'=>CHtml::listData(Personal::model()->findAll(array('order'=>'nombres ASC', 'condition' =>"activo = 'SI'")), 'id','nombreCompleto'), // Colocamos un combo en el filtro
			'value'=>'$data[\'usuario\'][\'nombreCompleto\']',
			'htmlOptions'=>array('width'=>'220'),
		),
		array(
			'name'=>'estado',
			'filter' => array('Activa'=>'Activa','Cancelada'=>'Cancelada'),
			'value'=>'$data->estado',
		),
		/*
		'fecha_fin',
		
		'usuario_id',
		'fecha_creado',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>

<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#citas-reservada-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#citas-reservada-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('CitasReservada/view'); ?>&id=' + rowId;
        });
    });
</script>
