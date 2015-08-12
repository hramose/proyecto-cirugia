<?php
/* @var $this HistorialRevisionSistemaController */
/* @var $model HistorialRevisionSistema */


$this->menu=array(
	array('label'=>'Listar Revisión por Sistema', 'url'=>array('index')),
	array('label'=>'Crear Revisión por Sistema', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-revision-sistema-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Revisión por Sistemas</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-revision-sistema-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'cita_id',
		'personal_id',
		'c_c_c',
		'cardio_respiratorio',
		/*
		'sistema_digestivo',
		'sistema_genitoUrinario',
		'sistema_locomotor',
		'sistema_nervioso',
		'sistema_tegumentario',
		'observaciones',
		'fecha',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
