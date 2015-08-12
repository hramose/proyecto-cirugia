<?php
/* @var $this HistorialRevisionSistemaController */
/* @var $model HistorialRevisionSistema */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-revision-sistema-form',
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

			//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

	//Variables de Historial
	$ccc = "";
	$cardio_respiratorio = "";
	$sistema_digestivo = "";
	$sistema_genitoUrinario = "";
	$sistema_locomotor = "";
	$sistema_nervioso = "";
	$sistema_tegumentario = "";
	$observaciones_paciente = "";

	$elHistorial = HistorialRevisionSistema::model()->findAll("paciente_id=$elPaciente");
	foreach ($elHistorial as $el_historial) {
		$ccc = $ccc. date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->c_c_c."<br><br>";
		$cardio_respiratorio = $cardio_respiratorio. date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->cardio_respiratorio."<br><br>";
		$sistema_digestivo = $sistema_digestivo. date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->sistema_digestivo."<br><br>";
		$sistema_genitoUrinario = $sistema_genitoUrinario. date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->sistema_genitoUrinario."<br><br>";
		$sistema_locomotor = $sistema_locomotor. date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->sistema_locomotor."<br><br>";
		$sistema_nervioso = $sistema_nervioso. date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->sistema_nervioso."<br><br>";
		$sistema_tegumentario = $sistema_tegumentario. date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->sistema_tegumentario."<br><br>";
		$observaciones_paciente = $observaciones_paciente . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->observaciones."<br><br>";
	}
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
			<?php echo $form->labelEx($model,'c_c_c'); ?>
			<?php echo $form->textArea($model,'c_c_c',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'c_c_c'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Cabeza, Cara y Cuello</span>
			<pre><?php echo trim($ccc); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'cardio_respiratorio'); ?>
			<?php echo $form->textArea($model,'cardio_respiratorio',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'cardio_respiratorio'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Cardio Respiratorio</span>
			<pre><?php echo trim($cardio_respiratorio); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'sistema_digestivo'); ?>
			<?php echo $form->textArea($model,'sistema_digestivo',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'sistema_digestivo'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Sistema Digestivo</span>
			<pre><?php echo trim($sistema_digestivo); ?></pre>
		</div>
	</div>


	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'sistema_genitoUrinario'); ?>
			<?php echo $form->textArea($model,'sistema_genitoUrinario',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'sistema_genitoUrinario'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Sistema Genito Urinario</span>
			<pre><?php echo trim($sistema_genitoUrinario); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'sistema_locomotor'); ?>
			<?php echo $form->textArea($model,'sistema_locomotor',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'sistema_locomotor'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Sistema Locomotor</span>
			<pre><?php echo trim($sistema_locomotor); ?></pre>
		</div>
	</div>
	

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'sistema_nervioso'); ?>
			<?php echo $form->textArea($model,'sistema_nervioso',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'sistema_nervioso'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Sistema Nervioso</span>
			<pre><?php echo trim($sistema_nervioso); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'sistema_tegumentario'); ?>
			<?php echo $form->textArea($model,'sistema_tegumentario',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'sistema_tegumentario'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Sistema Tegumentario</span>
			<pre><?php echo trim($sistema_tegumentario); ?></pre>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span7">
			<?php echo $form->labelEx($model,'observaciones'); ?>
			<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'observaciones'); ?>
		</div>
		<div class="span5">
			<span class="label label-info">Sistema Tegumentario</span>
			<pre><?php echo trim($observaciones_paciente); ?></pre>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->