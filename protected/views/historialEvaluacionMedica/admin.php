<?php
/* @var $this HistorialEvaluacionMedicaController */
/* @var $model HistorialEvaluacionMedica */

$this->menu=array(
	//array('label'=>'Listar Evaluaciones Medicas', 'url'=>array('index')),
	//array('label'=>'Crear Evaluación Médica', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-evaluacion-medica-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Evolución Médica</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-evaluacion-medica-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'cita_id',
		'personal_id',
		'diagnostico_principal_id',
		'diagnostico_relacional_id',
		/*
		'evolucion',
		'fecha',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
