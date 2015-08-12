<?php
/* @var $this PacienteOrdenController */
/* @var $model PacienteOrden */

$this->menu=array(
	array('label'=>'Listar Ordenes de Pacientes', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paciente-orden-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Orden de Paciente</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'paciente-orden-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'observaciones',
		'vendedor',
		'estado',
		'abierto_cerrado',
		/*
		'fecha',
		'responsable',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
