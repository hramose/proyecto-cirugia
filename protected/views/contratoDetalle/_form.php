<?php
/* @var $this ContratoDetalleController */
/* @var $model ContratoDetalle */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contrato-detalle-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'contrato_id'); ?>
		<?php echo $form->textField($model,'contrato_id'); ?>
		<?php echo $form->error($model,'contrato_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'linea_servicio_id'); ?>
		<?php echo $form->textField($model,'linea_servicio_id'); ?>
		<?php echo $form->error($model,'linea_servicio_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vu'); ?>
		<?php echo $form->textField($model,'vu',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'vu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textField($model,'desc'); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vu_desc'); ?>
		<?php echo $form->textField($model,'vu_desc',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'vu_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vt_sin_desc'); ?>
		<?php echo $form->textField($model,'vt_sin_desc',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'vt_sin_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vt_con_desc'); ?>
		<?php echo $form->textField($model,'vt_con_desc',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'vt_con_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->