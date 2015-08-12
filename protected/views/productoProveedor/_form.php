<?php
/* @var $this ProductoProveedorController */
/* @var $model ProductoProveedor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-proveedor-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'doc_nit'); ?>
			<?php echo $form->textField($model,'doc_nit',array('size'=>30,'maxlength'=>30)); ?>
			<?php echo $form->error($model,'doc_nit'); ?>
		</div>

		<div class="span8">
			<?php echo $form->labelEx($model,'nombre'); ?>
			<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>75, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'nombre'); ?>
		</div>
	</div>

	<div class="row">
	<div class="span12">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textArea($model,'direccion',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'ciudad'); ?>
			<?php echo $form->textField($model,'ciudad',array('size'=>25,'maxlength'=>25)); ?>
			<?php echo $form->error($model,'ciudad'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'telefono'); ?>
			<?php echo $form->textField($model,'telefono',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'telefono'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'nombre_contacto'); ?>
			<?php echo $form->textField($model,'nombre_contacto',array('size'=>60,'maxlength'=>60, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'nombre_contacto'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'email_contacto'); ?>
			<?php echo $form->textField($model,'email_contacto',array('size'=>60,'maxlength'=>60, 'class'=>'input-xlarge')); ?>
			<?php echo $form->error($model,'email_contacto'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'telefono_contacto'); ?>
			<?php echo $form->textField($model,'telefono_contacto',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'telefono_contacto'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'celular_contacto'); ?>
			<?php echo $form->textField($model,'celular_contacto',array('size'=>15,'maxlength'=>15)); ?>
			<?php echo $form->error($model,'celular_contacto'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->