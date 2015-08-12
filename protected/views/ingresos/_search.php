<?php
/* @var $this IngresosController */
/* @var $model Ingresos */
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
		<?php echo $form->label($model,'paciente_id'); ?>
		<?php echo $form->textField($model,'paciente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contrato_id'); ?>
		<?php echo $form->textField($model,'contrato_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'centro_costo_id'); ?>
		<?php echo $form->textField($model,'centro_costo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forma_pago'); ?>
		<?php echo $form->textField($model,'forma_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cheques_cantidad'); ?>
		<?php echo $form->textField($model,'cheques_cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cheques_banco_cuenta_id'); ?>
		<?php echo $form->textField($model,'cheques_banco_cuenta_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cheques_total'); ?>
		<?php echo $form->textField($model,'cheques_total',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_tipo'); ?>
		<?php echo $form->textField($model,'tarjeta_tipo',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_aprobacion'); ?>
		<?php echo $form->textField($model,'tarjeta_aprobacion',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_entidad'); ?>
		<?php echo $form->textField($model,'tarjeta_entidad',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarjeta_banco_cuenta_id'); ?>
		<?php echo $form->textField($model,'tarjeta_banco_cuenta_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consigna_banco_o'); ?>
		<?php echo $form->textField($model,'consigna_banco_o',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consigna_cuenta_o'); ?>
		<?php echo $form->textField($model,'consigna_cuenta_o',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'consigna_banco_d_cuenta_id'); ?>
		<?php echo $form->textField($model,'consigna_banco_d_cuenta_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personal_id'); ?>
		<?php echo $form->textField($model,'personal_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->