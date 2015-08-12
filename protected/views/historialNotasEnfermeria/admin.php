<?php
/* @var $this HistorialNotasEnfermeriaController */
/* @var $model HistorialNotasEnfermeria */


$this->menu=array(
	array('label'=>'Listar Notas de Enfermería', 'url'=>array('index')),
	array('label'=>'Crear Notas de Enfermería', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-notas-enfermeria-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Notas de Enfermería</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-notas-enfermeria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'cita_id',
		'fecha',
		'observaciones',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
