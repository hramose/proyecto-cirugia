<?php
/* @var $this HistorialFormulacionController */
/* @var $model HistorialFormulacion */

$this->menu=array(
	array('label'=>'Listar Formulaciones', 'url'=>array('index')),
	array('label'=>'Crear Formulación', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-formulacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Formulaciones</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-formulacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cita_id',
		'paciente_id',
		'personal_id',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
