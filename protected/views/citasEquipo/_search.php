<?php
/* @var $this CitasEquipoController */
/* @var $model CitasEquipo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cita_id'); ?>
		<?php echo $form->textField($model,'cita_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_inicio'); ?>
		<?php echo $form->textField($model,'hora_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hora_fin'); ?>
		<?php echo $form->textField($model,'hora_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'equipo_id'); ?>
		<?php echo $form->textField($model,'equipo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'linea_servicio_id'); ?>
		<?php echo $form->textField($model,'linea_servicio_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->