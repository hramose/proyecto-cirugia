<?php
/* @var $this DiagnosticoRelacionadoController */
/* @var $model DiagnosticoRelacionado */

$this->menu=array(
	array('label'=>'Listar Diagnosticos Relacionados', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico Relacionado', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#diagnostico-relacionado-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Diagnosticos Relacionados</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'diagnostico-relacionado-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'diagnostico',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
