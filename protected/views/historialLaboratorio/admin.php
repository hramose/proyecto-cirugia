<?php
/* @var $this HistorialLaboratorioController */
/* @var $model HistorialLaboratorio */

$this->menu=array(
	array('label'=>'Listar Examenes de Laboratorio', 'url'=>array('index')),
	array('label'=>'Crear Examenes de Laboratorio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-laboratorio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Examenes de Laboratorio</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-laboratorio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		'paciente_id',
		'cita_id',
		'comentarios',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
