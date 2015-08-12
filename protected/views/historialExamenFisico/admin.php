<?php
/* @var $this HistorialExamenFisicoController */
/* @var $model HistorialExamenFisico */

$this->menu=array(
	array('label'=>'Listar Examenes Fisicos', 'url'=>array('index')),
	array('label'=>'Crear Examen Físico', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-examen-fisico-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Examen Físico</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-examen-fisico-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'diagnostico_principal_id',
		'diagnostico_relacionado_id',
		'peso',
		'altura',
		/*
		'imc',
		'observaciones',
		'fecha',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
