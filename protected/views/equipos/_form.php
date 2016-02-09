<?php
/* @var $this EquiposController */
/* @var $model Equipos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'equipos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'nombre'); ?>
			<?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'nombre'); ?>
		</div>

		<div class="span4">
			<?php //echo $form->labelEx($model,'linea_servicio_id'); ?>
			<?php //echo $form->dropDownList($model, 'linea_servicio_id',CHtml::listData(LineaServicio::model()->findAll("estado = 'activo'"),'id','nombre', 'tipo.nombre'), array('class'=>'input-xlarge', 'id'=>'id', 'empty'=>''));?>
			<?php //echo $form->error($model,'linea_servicio_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'numero'); ?>
			<?php echo $form->textField($model,'numero'); ?>
			<?php echo $form->error($model,'numero'); ?>
		</div>

		<div class="span4">
			<?php //echo $form->labelEx($model,'Estado'); ?>
			<?php //echo $form->dropDownList($model, 'Estado',array('Activo'=>'Activo','Inactivo'=>'Inactivo'));?>	
			<?php //echo $form->error($model,'Estado'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'marca'); ?>
			<?php echo $form->textField($model,'marca'); ?>
			<?php echo $form->error($model,'marca'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'modelo'); ?>
			<?php echo $form->textField($model,'modelo'); ?>	
			<?php echo $form->error($model,'modelo'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'serial'); ?>
			<?php echo $form->textField($model,'serial'); ?>
			<?php echo $form->error($model,'serial'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'voltaje'); ?>
			<?php echo $form->textField($model,'voltaje'); ?>	
			<?php echo $form->error($model,'voltaje'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'ubicacion'); ?>
			<?php echo $form->textField($model,'ubicacion', array('class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'ubicacion'); ?>
		</div>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->