<?php
/* @var $this LineaServicioController */
/* @var $model LineaServicio */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'linea-servicio-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="text-info">Si va a vincular un equipo a esta línea de servicio asegúrese que este ya este creado.</p>
	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_id'); ?>
		<?php echo $form->dropDownList($model, 'tipo_id', CHtml::listData(TipoLineaServicio::model()->findAll(),'id','nombre'),array('class'=>'input-xlarge')); ?>
		<a href="index.php?r=TipoLineaServicio/create" class="btn btn-small btn-primary"><i class="icon-plus-sign icon-white"></i> Agregar</a>
		<?php echo $form->error($model,'tipo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>254, 'class'=>'input-xlarge')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<div class="span2">
			<div class="input-prepend input-append">
				<?php echo $form->labelEx($model,'precio'); ?>
				<span class="add-on">$</span>
				<?php echo $form->textField($model,'precio',array('size'=>10,'maxlength'=>10, 'class'=>'input-small')); ?>
				<?php echo $form->error($model,'precio'); ?>
			</div>
		</div>

		<div class="span2">
			<div class="input-prepend input-append">
				<?php echo $form->labelEx($model,'precio_pago'); ?>
				<span class="add-on">$</span>
				<?php echo $form->textField($model,'precio_pago',array('size'=>10,'maxlength'=>10, 'class'=>'input-small')); ?>
				<?php echo $form->error($model,'precio_pago'); ?>
			</div>
		</div>

		<div class="span2">
			<div class="input-prepend input-append">
				<?php echo $form->labelEx($model,'insumo'); ?>
				<span class="add-on">$</span>
				<?php echo $form->textField($model,'insumo',array('size'=>10,'maxlength'=>10, 'class'=>'input-small')); ?>
				<?php echo $form->error($model,'insumo'); ?>
			</div>
		</div>
	</div>

	
	<div class="row">
		<div class="span4">
			<div class="row">
				<?php echo $form->labelEx($model,'estado'); ?>
				<?php echo $form->dropDownList($model, 'estado',array('activo'=>'Activo','inactivo'=>'Inactivo'), array('class'=>'input-small'));?>
				<?php echo $form->error($model,'estado'); ?>
			</div>

			<div class="row">
				<div class="span6">
					<div class="input-prepend input-append">
						<?php echo $form->labelEx($model,'porcentaje'); ?>
						<span class="add-on">%</span>
						<?php echo $form->textField($model,'porcentaje', array('class'=>'input-small')); ?>
						<?php echo $form->error($model,'porcentaje'); ?>
					</div>
				</div>
				<div class="span6">
					<?php echo $form->labelEx($model,'tipo_hoja_gastos'); ?>
					<?php echo $form->dropDownList($model, 'tipo_hoja_gastos',array('Cirugía'=>'Cirugía','Standard'=>'Standard'), array('class'=>'input-normal'));?>
					<?php echo $form->error($model,'tipo_hoja_gastos'); ?>
				</div>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'restringido'); ?>
				<?php echo $form->dropDownList($model, 'restringido',array('SI'=>'SI','NO'=>'NO'), array('class'=>'input-small'));?>
				<?php echo $form->error($model,'restringido'); ?>
			</div>
		</div>

		<div class="span6">
			<div class="row">
				<?php echo $form->labelEx($model,'equipo_id'); ?>
				<?php echo $form->dropDownList($model, 'equipo_id', CHtml::listData(Equipos::model()->findAll(),'id','nombre'),array('class'=>'input-xlarge', 'empty'=>'')); ?>
				<a href="index.php?r=equipos/create" class="btn btn-small btn-primary"><i class="icon-plus-sign icon-white"></i> Agregar</a>
				<?php echo $form->error($model,'equipo_id'); ?>
			</div>
		</div>
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->