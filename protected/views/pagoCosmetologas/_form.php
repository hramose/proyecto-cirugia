<?php
/* @var $this PagoCosmetologasController */
/* @var $model PagoCosmetologas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pago-cosmetologas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cita_id'); ?>
		<?php echo $form->textField($model,'cita_id'); ?>
		<?php echo $form->error($model,'cita_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'misma_persona'); ?>
		<?php echo $form->textField($model,'misma_persona',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'misma_persona'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor_comision'); ?>
		<?php echo $form->textField($model,'valor_comision',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valor_comision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor_tratamiento'); ?>
		<?php echo $form->textField($model,'valor_tratamiento',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valor_tratamiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descarga'); ?>
		<?php echo $form->textField($model,'descarga',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'descarga'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'personal_id'); ?>
		<?php echo $form->textField($model,'personal_id'); ?>
		<?php echo $form->error($model,'personal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_pago'); ?>
		<?php echo $form->textField($model,'total_pago',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'total_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sesion'); ?>
		<?php echo $form->textField($model,'sesion',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'sesion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_pago'); ?>
		<?php echo $form->textField($model,'fecha_pago'); ?>
		<?php echo $form->error($model,'fecha_pago'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->