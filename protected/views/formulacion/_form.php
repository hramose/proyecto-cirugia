<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formulacion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span10">
			<?php echo $form->labelEx($model,'nombre'); ?>
			<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>75, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'nombre'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'presentacion'); ?>
			<?php echo $form->textField($model,'presentacion',array('size'=>60,'maxlength'=>75)); ?>
			<?php echo $form->error($model,'presentacion'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'unidad_medida'); ?>
			<?php echo $form->textField($model,'unidad_medida',array('size'=>60,'maxlength'=>75)); ?>
			<?php echo $form->error($model,'unidad_medida'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->