<?php
/* @var $this CitasReservadaController */
/* @var $model CitasReservada */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'citas-reservada-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

if(isset($_GET['hora']))
{$lahora = $_GET['hora'];}
else
{$lahora = 1;}

?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'personal_id'); ?>
			<?php echo $form->textField($model,'personal_id'); ?>
			<?php echo $form->error($model,'personal_id'); ?>
		</div>
	</div>
	
	<div class="row">
		<div class="span6">
			<label for="">Seleccione la opción de bloqueo</label>
			<select name="opciones" id="opciones">
				<option value="Horas">Horas</option>
				<option value="Dias">Dias</option>
			</select>
		</div>
	</div>

	<div class="row" id="horas">
		<div class="span3">
			<?php echo $form->labelEx($model,'hora_inicio'); ?>
			<?php echo $form->dropDownList($model, 'hora_inicio',CHtml::listData(HorasServicio::model()->findAll(),'id','hora'), array('options' => array($lahora=>array('selected'=>true)), 'class'=>'input-medium'));?>
			<?php echo $form->error($model,'hora_inicio'); ?>
		</div>

		<div class="span3">
			<?php echo $form->labelEx($model,'hora_fin'); ?>
			<?php echo $form->dropDownList($model, 'hora_fin',CHtml::listData(HorasServicio::model()->findAll(),'id','hora'), array('options' => array($lahora=>array('selected'=>true)), 'class'=>'input-medium'));?>
			<?php echo $form->error($model,'hora_fin'); ?>
		</div>
	</div>

	<div id="dias" style="display: none">
	<div class="row">
		<div class="span3">
			<?php echo $form->labelEx($model,'fecha_inicio'); ?>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<?php 

				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_inicio',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_inicio',
					'value'=> $model->fecha_inicio,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'2014:2025',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;width:80px;'
					),
				));


				?>
			</div>
			<?php echo $form->error($model,'fecha_inicio'); ?>
		</div>
		

		<div class="span3">
			<?php echo $form->labelEx($model,'fecha_fin'); ?>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<?php 

				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_fin',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_fin',
					'value'=> $model->fecha_fin,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'language' => 'es',
						'dateFormat' => 'dd-mm-yy',
						'changeMonth'=>true,
        				'changeYear'=>true,
        				'yearRange'=>'2014:2025',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;width:80px;'
					),
				));


				?>
			</div>
			<?php echo $form->error($model,'fecha_fin'); ?>
		</div>
	</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motivo'); ?>
		<?php echo $form->textArea($model,'motivo',array('rows'=>6, 'cols'=>50, 'class'=>"input-xxlarge")); ?>
		<?php echo $form->error($model,'motivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'observacon'); ?>
		<?php echo $form->textArea($model,'observacon',array('rows'=>6, 'cols'=>50, 'class'=>"input-xxlarge")); ?>
		<?php echo $form->error($model,'observacon'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array("class"=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->