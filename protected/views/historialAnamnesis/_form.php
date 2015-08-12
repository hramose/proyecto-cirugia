<?php
/* @var $this HistorialAnamnesisController */
/* @var $model HistorialAnamnesis */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-anamnesis-form',
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

	$paciente = Paciente::model()->find("id=$elPaciente"); 

	//Historial e variables
	$motivo_consulta = "";
	$enfermedad_actual = "";
	$antecedente_patologico = "";
	$antecedente_quirurgico = "";
	$antecedente_alergico = "";
	$antecedente_traumatico = "";
	$antecedente_medicamento = "";
	$antecedente_ginecologico = "";
	$antecedente_fum = "";
	$antecedente_habitos = "";
	$antecedente_familiares = "";
	$antecedente_nutricionales = "";
	$observaciones_paciente = "";

	$elHistorial = HistorialAnamnesis::model()->findAll("paciente_id=$elPaciente");
	foreach ($elHistorial as $el_historial) 
	{
		$motivo_consulta = $motivo_consulta . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->motivo_consulta."<br><br>";
		$enfermedad_actual = $enfermedad_actual . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->enfermedad_actual."<br><br>";
		$antecedente_patologico = $antecedente_patologico . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_patologico."<br><br>";
		$antecedente_quirurgico = $antecedente_quirurgico . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_quirurgico."<br><br>";
		$antecedente_alergico = $antecedente_alergico . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_alergico."<br><br>";
		$antecedente_traumatico = $antecedente_traumatico . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_traumatico."<br><br>";
		$antecedente_medicamento = $antecedente_medicamento . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_medicamento."<br><br>";
		$antecedente_ginecologico = $antecedente_ginecologico . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_ginecologico."<br><br>";
		$antecedente_fum = $antecedente_fum . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_fum."<br><br>";
		$antecedente_habitos = $antecedente_habitos . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_habitos."<br><br>";
		$antecedente_familiares = $antecedente_familiares . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_familiares."<br><br>";
		$antecedente_nutricionales = $antecedente_nutricionales . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->antecedente_nutricionales."<br><br>";
		$observaciones_paciente = $observaciones_paciente . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->observaciones_paciente."<br><br>";
	}

	//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),
?>

	<?php echo $form->errorSummary($model); ?>

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
	
	<div class="row">
		<div class="span6">
			<?php //echo $form->labelEx($model,'personal_id'); ?>
			<?php //echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' and id_perfil = 1"),'id','nombreCompleto'), array('class'=>'input-xxlarge'));?>
			<?php //echo $form->error($model,'personal_id'); ?>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'motivo_consulta'); ?>
			<?php echo $form->textArea($model,'motivo_consulta',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'motivo_consulta'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($motivo_consulta); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'enfermedad_actual'); ?>
			<?php echo $form->textArea($model,'enfermedad_actual',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'enfermedad_actual'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($enfermedad_actual); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_patologico'); ?>
			<?php echo $form->textArea($model,'antecedente_patologico',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_patologico'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_patologico); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_quirurgico'); ?>
			<?php echo $form->textArea($model,'antecedente_quirurgico',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_quirurgico'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_quirurgico); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_alergico'); ?>
			<?php echo $form->textArea($model,'antecedente_alergico',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_alergico'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_alergico); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_traumatico'); ?>
			<?php echo $form->textArea($model,'antecedente_traumatico',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_traumatico'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_traumatico); ?></pre>
		</div>				
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_medicamento'); ?>
			<?php echo $form->textArea($model,'antecedente_medicamento',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_medicamento'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_medicamento); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_ginecologico'); ?>
			<?php echo $form->textArea($model,'antecedente_ginecologico',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_ginecologico'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_ginecologico); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_fum'); ?>
			<?php echo $form->textArea($model,'antecedente_fum',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_fum'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_fum); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_habitos'); ?>
			<?php echo $form->textArea($model,'antecedente_habitos',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_habitos'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_habitos); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_familiares'); ?>
			<?php echo $form->textArea($model,'antecedente_familiares',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_familiares'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_familiares); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'antecedente_nutricionales'); ?>
			<?php echo $form->textArea($model,'antecedente_nutricionales',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'antecedente_nutricionales'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($antecedente_nutricionales); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'observaciones_paciente'); ?>
			<?php echo $form->textArea($model,'observaciones_paciente',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'observaciones_paciente'); ?>
		</div>

		<div class="span5">
			<span class="label label-info">Consulta Anterior</span>
			<pre><?php echo trim($observaciones_paciente); ?></pre>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-info')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->