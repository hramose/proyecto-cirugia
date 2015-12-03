<?php
/* @var $this CitasReservadaController */
/* @var $model CitasReservada */

$this->breadcrumbs=array(
	'Citas Reservadas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CitasReservada', 'url'=>array('index')),
	array('label'=>'Create CitasReservada', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#citas-reservada-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Citas Reservadas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'citas-reservada-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'personal_id',
		'cita_id',
		'hora_inicio',
		'hora_fin',
		'fecha_inicio',
		/*
		'fecha_fin',
		'motivo',
		'observacon',
		'usuario_id',
		'fecha_creado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
