<?php
/* @var $this CosmetologaOrdenController */
/* @var $model CosmetologaOrden */


$this->menu=array(
	array('label'=>'Listar Pagos a Cosmetologas', 'url'=>array('index')),
	array('label'=>'Buscar Pagos a Cosmetologas', 'url'=>array('admin')),
);
?>

<h1>Pago a Cosmetologa #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'contrato_detalle_id',
			'sesion',
			'cosmetologa_id',
			'estado',
			'fecha_servicio',
		),
		)); ?>
	</div>
</div>

<div class="row"><div class="span12"></div></div>

<div class="row">
	<div class="span12 text-center">
		<h2>Sesiones Anteriores</h2>
		<p>Aca apareceran las sesiones realizadas con anterioridad</p>
	</div>
</div>

<div class="row"><div class="span12"></div></div>

<div class="row text-center">
	<a href="#pago" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-ok-sign icon-white"></i> Realizar Pago</a>
</div>