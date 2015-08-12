<?php
/* @var $this HistorialDescripcionQuirurgicaController */
/* @var $model HistorialDescripcionQuirurgica */

$this->menu=array(
	array('label'=>'Listar Descripción Quirurgica', 'url'=>array('index')),
	array('label'=>'Crear Descripción Quirurgica', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-descripcion-quirurgica-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Descripción Quirurgica</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-descripcion-quirurgica-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'servicio',
		'diagnostico_preoperatorio',
		'diagnostico_posoperatorio',
		'cirujano_id',
		/*
		'ayudante_id',
		'anestesiologo_id',
		'inst_quirurgico_id',
		'fecha_cirugia',
		'hora_inicio',
		'hora_final',
		'codigo_cups',
		'intervencion',
		'control_compresas',
		'tipo_anestesia',
		'descripcion_hallazgos',
		'personal_id',
		'fecha',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
