<?php
/* @var $this HistorialDiagnosticoController */
/* @var $model HistorialDiagnostico */


$this->menu=array(
	array('label'=>'Listar Diagnosticos Clinicos', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico Clinico', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-diagnostico-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Diagnosticos Clinicos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-diagnostico-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cita_id',
		'paciente_id',
		'observaciones',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
