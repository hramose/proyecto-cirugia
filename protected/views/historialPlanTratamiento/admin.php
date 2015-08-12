<?php
/* @var $this HistorialPlanTratamientoController */
/* @var $model HistorialPlanTratamiento */


$this->menu=array(
	// array('label'=>'Listar Planes de Tratamiento', 'url'=>array('index')),
	// array('label'=>'Crer Plan de Tratamiento', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-plan-tratamiento-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Plan de Tratamientos</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-plan-tratamiento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'cita_id',
		'observaciones',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
