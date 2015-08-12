<?php
/* @var $this CosmetologaOrdenController */
/* @var $model CosmetologaOrden */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cosmetologa-orden-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'contrato_detalle_id'); ?>
		<?php echo $form->textField($model,'contrato_detalle_id'); ?>
		<?php echo $form->error($model,'contrato_detalle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sesion'); ?>
		<?php echo $form->textField($model,'sesion',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'sesion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cosmetologa_id'); ?>
		<?php echo $form->textField($model,'cosmetologa_id'); ?>
		<?php echo $form->error($model,'cosmetologa_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_servicio'); ?>
		<?php echo $form->textField($model,'fecha_servicio'); ?>
		<?php echo $form->error($model,'fecha_servicio'); ?>
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