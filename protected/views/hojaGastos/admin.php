<?php
/* @var $this HojaGastosController */
/* @var $model HojaGastos */

$this->menu=array(
	//array('label'=>'Listar Hoja de Gastos', 'url'=>array('index')),
	//array('label'=>'Crear Hoja de Gastos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#hoja-gastos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Hoja de Gastos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'hoja-gastos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'cita_id',
		'personal_id',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
