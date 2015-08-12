<?php
/* @var $this TipoLineaServicioController */
/* @var $model TipoLineaServicio */

$this->menu=array(
	array('label'=>'Listar Tipo de Linea de Servicio', 'url'=>array('index')),
	array('label'=>'Crear Tipo de Linea de Servicio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tipo-linea-servicio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Tipo de Linea de Servicios</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tipo-linea-servicio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'estado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
