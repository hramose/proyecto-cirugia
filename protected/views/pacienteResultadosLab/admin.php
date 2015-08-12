<?php
/* @var $this PacienteResultadosLabController */
/* @var $model PacienteResultadosLab */


$this->menu=array(
	array('label'=>'Listar Resultados de Laboratorio', 'url'=>array('index')),
	array('label'=>'Agregar Resultados de Laboratorio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paciente-resultados-lab-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Resultados de Laboratorio</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'paciente-resultados-lab-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'descripcion',
		'fecha',
		'personal_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
