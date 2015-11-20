<?php
/* @var $this PersonalTareasController */
/* @var $model PersonalTareas */

$this->menu=array(
	array('label'=>'Crear Tareas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#personal-tareas-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Tareas</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'personal-tareas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'personal_id',
		'tarea',
		'fecha_cumplir',
		'estado',
		'fecha',
		/*
		'usuario_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
