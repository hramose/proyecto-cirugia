<?php
/* @var $this HistorialMedicinaBiologicaController */
/* @var $model HistorialMedicinaBiologica */

$this->menu=array(
	array('label'=>'Listar Plan de Medicina Biologica', 'url'=>array('index')),
	array('label'=>'Crear Plan de Medicina Biologica', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-medicina-biologica-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Plan de Medicina Biologica</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-medicina-biologica-grid',
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
