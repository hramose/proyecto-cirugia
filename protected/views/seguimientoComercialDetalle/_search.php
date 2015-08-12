<?php
/* @var $this SeguimientoComercialDetalleController */
/* @var $model SeguimientoComercialDetalle */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_seguimiento'); ?>
		<?php echo $form->textField($model,'fecha_seguimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seguimiento'); ?>
		<?php echo $form->textArea($model,'seguimiento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsable_id'); ?>
		<?php echo $form->textField($model,'responsable_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->