<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php 
	$elId = $_GET['id'];
	$datosEmpleado = Personal::model()->findByPk("$elId");	
?>

<div class="row">
	<div class="span4"></div>
	<div class="span4">
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$datosEmpleado,
			'attributes'=>array(
				'idPerfil.nombre',
				'nombres',
				'apellidos',
			),
		));
		
		?>

	</div>
	<div class="span4"></div>
</div>


	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="row">
	<div class="form-actions">
		<div class="row">
			<?php echo $form->labelEx($model,'usuario'); ?>
			<?php echo $form->textField($model,'usuario',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'usuario'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'clave'); ?>
			<?php echo $form->passwordField($model,'clave',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'clave'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'perfil_sistema_id'); ?>
			<?php echo $form->dropDownList($model, 'perfil_sistema_id',CHtml::listData(PerfilSistema::model()->findAll("estado = 'Activo'"),'id','perfil'), array('class'=>'input-large'));?>
			<?php echo $form->error($model,'perfil_sistema_id'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'estado'); ?>
			<?php echo $form->dropDownList($model, 'estado',array('Activo'=>'Activo','Inactivo'=>'Inactivo'));?>	
			<?php echo $form->error($model,'estado'); ?>
		</div>
	</div>
</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->