<?php
/* @var $this CuentasXcDetalleController */
/* @var $model CuentasXcDetalle */

$this->breadcrumbs=array(
	'Cuentas Xc Detalles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CuentasXcDetalle', 'url'=>array('index')),
	array('label'=>'Create CuentasXcDetalle', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cuentas-xc-detalle-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cuentas Xc Detalles</h1>

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
	'id'=>'cuentas-xc-detalle-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cuentas_xc_id',
		'paciente_id',
		'n_identificacion',
		'cita_id',
		'contrato_id',
		/*
		'saldo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
