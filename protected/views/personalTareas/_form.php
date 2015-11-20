<?php
/* @var $this PersonalTareasController */
/* @var $model PersonalTareas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personal-tareas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span12">
			<?php echo $form->labelEx($model,'personal_id'); ?>
			<?php echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' ORDER BY nombres"),'id','NombreCompleto'), array('class'=>'input-xxlarge'));?>
			<?php echo $form->error($model,'personal_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<?php echo $form->labelEx($model,'tarea'); ?>
			<?php echo $form->textArea($model,'tarea',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'tarea'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span3">
			<?php echo $form->labelEx($model,'fecha_cumplir'); ?>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<?php 

				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_cumplir',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_cumplir',
					'value'=> $model->fecha_cumplir,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'2015:2025',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;width:80px;'
					),
				));


				?>
			</div>
			<?php echo $form->error($model,'fecha_cumplir'); ?>
		</div>

		</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->