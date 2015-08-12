<?php
/* @var $this HistorialDescripcionQuirurgicaController */
/* @var $model HistorialDescripcionQuirurgica */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-descripcion-quirurgica-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php

	if(isset($_GET['idPaciente']))
{
	$elPaciente = $_GET['idPaciente'];
}
else
{
	$elPaciente = "0";
}

if(isset($_GET['idCita']))
{
	$laCita = $_GET['idCita'];
}
else
{
	$laCita = "0";
}

$paciente = Paciente::model()->find("id=$elPaciente");

//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),
?>

<div class="row">
		<h4 class="text-center">Datos de Paciente</h4>
		<div class="span1"></div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					array('name'=>'Edad', 'value'=>$edadpaciente, ''),
				),
			)); ?>
		</div>
		<div class="span5">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'email',
					'telefono1',
					'celular',
				),
			)); ?>
		</div>
		<div class="span1"></div>
	</div>


	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'servicio'); ?>
		<?php echo $form->textField($model,'servicio',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'servicio'); ?>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'diagnostico_preoperatorio'); ?>
			<?php echo $form->textArea($model,'diagnostico_preoperatorio',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'diagnostico_preoperatorio'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'diagnostico_posoperatorio'); ?>
			<?php echo $form->textArea($model,'diagnostico_posoperatorio',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'diagnostico_posoperatorio'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'cirujano_id'); ?>
			<?php echo $form->dropDownList($model, 'cirujano_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'"),'id','nombreCompleto'), array('class'=>'input-xxlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'cirujano_id'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'ayudante_id'); ?>
			<?php echo $form->dropDownList($model, 'ayudante_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'"),'id','nombreCompleto'), array('class'=>'input-xxlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'ayudante_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'anestesiologo_id'); ?>
			<?php echo $form->dropDownList($model, 'anestesiologo_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'"),'id','nombreCompleto'), array('class'=>'input-xxlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'anestesiologo_id'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'inst_quirurgico_id'); ?>
			<?php echo $form->dropDownList($model, 'inst_quirurgico_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'"),'id','nombreCompleto'), array('class'=>'input-xxlarge', 'empty'=>"(Seleccione)"));?>
			<?php echo $form->error($model,'inst_quirurgico_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<div class="row">
				<div class="span4">
					<?php echo $form->labelEx($model,'fecha_cirugia'); ?>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-calendar"></i></span>
						<?php 
						if ($model->fecha_cirugia == '') {
							$fecha_cirugia = '';
						}
						else
						{
							$fecha_cirugia = $model->fecha_cirugia=date('d-m-Y',strtotime($model->fecha_cirugia));	
						}
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'name'=>'fecha_cirugia',
							'language'=>'es',
							'model' => $model,
							'attribute' => 'fecha_cirugia',
							'value'=> $fecha_cirugia,
									
							
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'language' => 'es',
								'dateFormat' => 'dd-mm-yy',
								'changeMonth'=>true,
		        				'changeYear'=>true,
		        				'yearRange'=>'2015:2030',
							),
							'htmlOptions'=>array(
								'style'=>'height:20px;width:80px;'
							),
						));
						?>
					</div>
					<?php echo $form->error($model,'fecha_cirugia'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'hora_inicio'); ?>
					<?php echo $form->textField($model,'hora_inicio',array('size'=>7,'maxlength'=>7, 'class'=>'input-mini')); ?>
					<?php echo $form->error($model,'hora_inicio'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'hora_final'); ?>
					<?php echo $form->textField($model,'hora_final',array('size'=>7,'maxlength'=>7, 'class'=>'input-mini')); ?>
					<?php echo $form->error($model,'hora_final'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'codigo_cups'); ?>
					<?php echo $form->textField($model,'codigo_cups',array('size'=>25,'maxlength'=>25, 'class'=>'input-small')); ?>
					<?php echo $form->error($model,'codigo_cups'); ?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="row">
				<div class="span12">
					<?php echo $form->labelEx($model,'intervencion'); ?>
					<?php echo $form->textField($model,'intervencion',array('size'=>60,'maxlength'=>150, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($model,'intervencion'); ?>
				</div>
			</div>
		</div>
	</div>

	

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'control_compresas'); ?>
			<?php echo $form->textField($model,'control_compresas',array('size'=>25,'maxlength'=>25)); ?>
			<?php echo $form->error($model,'control_compresas'); ?>
		</div>

		<div class="span8">
			<?php echo $form->labelEx($model,'tipo_anestesia'); ?>
			<?php echo $form->textField($model,'tipo_anestesia',array('size'=>60,'maxlength'=>150, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'tipo_anestesia'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'descripcion_hallazgos'); ?>
			<?php echo $form->textArea($model,'descripcion_hallazgos',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'descripcion_hallazgos'); ?>
		</div>
		<div class="span6">
			<?php echo $form->labelEx($model,'observaciones'); ?>
			<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'observaciones'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->