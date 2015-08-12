<?php
/* @var $this PacienteFotografiasController */
/* @var $model PacienteFotografias */

$this->menu=array(
	//array('label'=>'Listar Fotografias de Pacientes', 'url'=>array('index')),
	//array('label'=>'Crear Fotografias de Pacientes', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#paciente-fotografias-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Fotografías de Pacientes</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'paciente-fotografias-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paciente_id',
		'comentario',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
