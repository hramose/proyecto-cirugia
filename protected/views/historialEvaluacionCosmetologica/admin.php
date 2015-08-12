<?php
/* @var $this HistorialEvaluacionCosmetologicaController */
/* @var $model HistorialEvaluacionCosmetologica */

$this->menu=array(
	//array('label'=>'Listar Evaluaciones Cosmetologicas', 'url'=>array('index')),
	//array('label'=>'Crear Evaluación Cosmetológica', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-evaluacion-cosmetologica-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Evolución Cosmetológica</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-evaluacion-cosmetologica-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'cita_id',
		'evaluacion',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
