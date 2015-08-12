<?php
/* @var $this RelacionHojaGastosController */
/* @var $model RelacionHojaGastos */

$this->menu=array(
	array('label'=>'Buscar Relación Hoja de Gastos', 'url'=>array('admin')),
);
$titulo = $model->hoja;
?>

<h1>Relación Hoja de Gastos #<?php echo $model->id; ?></h1>

<div class = "row">
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'paciente_id', 'value'=>$model->paciente->nombreCompleto,''),
				'hoja',
				array('name'=>'asistencial_id', 'value'=>$model->asistencial->nombreCompleto,''),
				'cita_id',
			),
		)); ?>
	</div>
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'linea_servicio_id', 'value'=>$model->lineaServicio->nombre,''),
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha)),
				array('name'=>'costo', 'value'=>"$ ".number_format($model->costo,2)),
				array('name'=>'personal_id', 'value'=>$model->personal->nombreCompleto,''),
			),
		)); ?>
	</div>
</div>

<div class="row">
	<h4 class="text-center">Detalles de <?php echo $titulo; ?></h4>
	<div class="span1"></div>
	<div class="span10">
		
	</div>
	<div class="span1"></div>
</div>