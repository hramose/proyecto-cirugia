<?php
/* @var $this HistorialAnamnesisController */
/* @var $model HistorialAnamnesis */


$this->menu=array(
	array('label'=>'Listar Anamnesis', 'url'=>array('index')),
	//array('label'=>'Crear HistorialAnamnesis', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-anamnesis-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Anamnesis</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-anamnesis-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'personal_id',
		'motivo_consulta',
		'enfermedad_actual',
		'antecedente_patologico',
		/*
		'antecedente_quirurgico',
		'antecedente_alergico',
		'antecedente_traumatico',
		'antecedente_medicamento',
		'antecedente_ginecologico',
		'antecedente_fum',
		'antecedente_habitos',
		'antecedente_familiares',
		'antecedente_nutricionales',
		'observaciones_paciente',
		'fecha',
		'estado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
