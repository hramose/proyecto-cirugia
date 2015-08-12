<?php
/* @var $this CuentasXcDetalleController */
/* @var $model CuentasXcDetalle */

$this->breadcrumbs=array(
	'Cuentas Xc Detalles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CuentasXcDetalle', 'url'=>array('index')),
	array('label'=>'Create CuentasXcDetalle', 'url'=>array('create')),
	array('label'=>'Update CuentasXcDetalle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CuentasXcDetalle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CuentasXcDetalle', 'url'=>array('admin')),
);
?>

<h1>View CuentasXcDetalle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cuentas_xc_id',
		'paciente_id',
		'n_identificacion',
		'cita_id',
		'contrato_id',
		'saldo',
	),
)); ?>
