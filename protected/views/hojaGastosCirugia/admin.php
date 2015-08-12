<?php
/* @var $this HojaGastosCirugiaController */
/* @var $model HojaGastosCirugia */

$this->menu=array(
	array('label'=>'Listar Hoja de Gastos de Cirugia', 'url'=>array('index')),
	array('label'=>'Crear Hoja de Gastos de Cirugia', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#hoja-gastos-cirugia-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Hoja de Gastos de Cirugía</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'hoja-gastos-cirugia-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'cita_id',
		'fecha_cirugia',
		'sala',
		'peso',
		/*
		'tipo_paciente',
		'tipo_anestesia',
		'tipo_cirugia',
		'cirugia',
		'cirugia_codigo',
		'hora_ingreso',
		'hora_inicio_cirugia',
		'hora_final_cirugia',
		'cirujano_id',
		'ayudante_id',
		'anestesiologo_id',
		'rotadora_id',
		'instrumentadora_id',
		'cantidad_productos',
		'fecha',
		'personal_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
