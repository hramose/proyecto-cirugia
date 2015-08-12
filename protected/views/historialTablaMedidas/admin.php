<?php
/* @var $this HistorialTablaMedidasController */
/* @var $model HistorialTablaMedidas */

$this->menu=array(
	// array('label'=>'List HistorialTablaMedidas', 'url'=>array('index')),
	// array('label'=>'Create HistorialTablaMedidas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#historial-tabla-medidas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Tabla de Medidas</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'historial-tabla-medidas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cita_id',
		'paciente_id',
		'imc',
		'peso',
		'busto',
		/*
		'contorno',
		'cintura',
		'umbilical',
		'abd_inferior',
		'abd_superior',
		'cadera',
		'piernas',
		'muslo_derecho',
		'muslo_izquierdo',
		'brazo_derecho',
		'brazo_izquierdo',
		'fecha',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
