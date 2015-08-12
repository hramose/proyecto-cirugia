<?php
/* @var $this HistorialTablaMedidasController */
/* @var $model HistorialTablaMedidas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-tabla-medidas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<!-- <p class="note">Campos con <span class="required">*</span> son requeridos.</p> -->

	<?php echo $form->errorSummary($model); ?>

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

		//Datos de Paciente
		$paciente = Paciente::model()->find("id=$elPaciente");

					//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

		//Variables
		$peso = "";
		$busto = "";
		$contorno = "";
		$cintura = "";
		$umbilical = "";
		$abd_inferior = "";
		$abd_superior = "";
		$cadera = "";
		$piernas = "";
		$muslo_derecho = "";
		$muslo_izquierdo = "";
		$brazo_derecho = "";
		$brazo_izquierdo = "";
		$fecha = "";
		$observaciones = "";

		//Datos Anteriores
		$elHistorial = HistorialTablaMedidas::model()->findAll("paciente_id=$elPaciente");
		foreach ($elHistorial as $el_historial) 
		{
			$peso = $peso . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->peso."<br>";
			$busto = $busto . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->busto."<br>";
			$contorno = $contorno . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->contorno."<br>";
			$cintura = $cintura . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->cintura."<br>";
			$umbilical = $umbilical . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->umbilical."<br>";
			$abd_inferior = $abd_inferior . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->abd_inferior."<br>";
			$abd_superior = $abd_superior . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->abd_superior."<br>";
			$cadera = $cadera . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->cadera."<br>";
			$piernas = $piernas . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->piernas."<br>";
			$muslo_derecho = $muslo_derecho . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->muslo_derecho."<br>";
			$muslo_izquierdo = $muslo_izquierdo . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->muslo_izquierdo."<br>";
			$brazo_derecho = $brazo_derecho . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->brazo_derecho."<br>";
			$brazo_izquierdo = $brazo_izquierdo . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->brazo_izquierdo."<br>";
			$observaciones = $observaciones . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->observaciones."<br>";
		}

		//IMC mas reciente
		$cImc = HistorialExamenFisico::model()->count("paciente_id = $elPaciente");
		$elImc = HistorialExamenFisico::model()->find("paciente_id = $elPaciente");
		if ($cImc > 0) {
			$otroImc = $elImc->imc;
		}else{
			$otroImc = 0;
		}



	?>
				<p class="note">Campos con <span class="required">*</span> son requeridos.</p>		
	<div class="row">

		<div class="span1"></div>
		<div class="span10">
			<h4 class="text-center">Datos de Paciente</h4>

			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$paciente,
				'attributes'=>array(			
					'nombreCompleto',
					'n_identificacion',
					array('name'=>'Edad', 'value'=>$edadpaciente, ''),
					'email',
					'telefono1',
					'celular',
				),
			)); ?>
		</div>
		</div>
<div class="row">
		<div class="span6">
			<?php //echo $form->labelEx($model,'personal_id'); ?>
			<?php //echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' and id_perfil = 1"),'id','nombreCompleto'), array('class'=>'input-xxlarge'));?>
			<?php //echo $form->error($model,'personal_id'); ?>
		</div>
	</div>	
	
	<div class="row hero-unit">
		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'imc'); ?>
				<?php echo $form->textField($model,'imc',array('value'=>$otroImc,'size'=>10,'maxlength'=>10, 'class'=>'input-mini', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'imc'); ?>
			</div>
			<div class="span3">
				
			</div>
		</div>

		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'peso'); ?>
				<?php echo $form->textField($model,'peso',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'peso'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Peso Anterior</span>
				<pre><?php echo trim($peso); ?></pre>
			</div>
			
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'busto'); ?>
				<?php echo $form->textField($model,'busto',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'busto'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Busto Anterior</span>
				<pre><?php echo trim($busto); ?></pre>
			</div>
			
		</div>

		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'contorno'); ?>
				<?php echo $form->textField($model,'contorno',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'contorno'); ?></small>
			</div>

			<div class="span8">
				<span class="label label-info">Contorno Anterior</span>
				<pre><?php echo trim($contorno); ?></pre>
			</div>
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'cintura'); ?>
				<?php echo $form->textField($model,'cintura',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'cintura'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Cintura Anterior</span>
				<pre><?php echo trim($cintura); ?></pre>
			</div>
			
		</div>

		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'umbilical'); ?>
				<?php echo $form->textField($model,'umbilical',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'umbilical'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Umbilical Anterior</span>
				<pre><?php echo trim($umbilical); ?></pre>
			</div>
			
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'abd_inferior'); ?>
				<?php echo $form->textField($model,'abd_inferior',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'abd_inferior'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">ABD Inferior Anterior</span>
				<pre><?php echo trim($abd_inferior); ?></pre>
			</div>

		</div>

		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'abd_superior'); ?>
				<?php echo $form->textField($model,'abd_superior',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'abd_superior'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">ABD Superior Anterior</span>
				<pre><?php echo trim($abd_superior); ?></pre>
			</div>

		</div>
	</div>

	<div class="row hero-unit">
		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'cadera'); ?>
				<?php echo $form->textField($model,'cadera',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'cadera'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Cadera Anterior</span>
				<pre><?php echo trim($cadera); ?></pre>
			</div>

		</div>

		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'piernas'); ?>
				<?php echo $form->textField($model,'piernas',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'piernas'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Piernas Anterior</span>
				<pre><?php echo trim($piernas); ?></pre>
			</div>
			
		</div>
	</div>

	<div class="row hero-unit">
		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'muslo_derecho'); ?>
				<?php echo $form->textField($model,'muslo_derecho',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'muslo_derecho'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Muslo Derecho Anterior</span>
				<pre><?php echo trim($muslo_derecho); ?></pre>
			</div>

		</div>

		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'muslo_izquierdo'); ?>
				<?php echo $form->textField($model,'muslo_izquierdo',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'muslo_izquierdo'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Muslo Izquierdo Anterior</span>
				<pre><?php echo trim($muslo_izquierdo); ?></pre>
			</div>

		</div>
	</div>

	<div class="row hero-unit">
		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'brazo_derecho'); ?>
				<?php echo $form->textField($model,'brazo_derecho',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'brazo_derecho'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Brazo Derecho Anterior</span>
				<pre><?php echo trim($brazo_derecho); ?></pre>
			</div>
		</div>

		<div class="span6">
			<div class="span4">
				<?php echo $form->labelEx($model,'brazo_izquierdo'); ?>
				<?php echo $form->textField($model,'brazo_izquierdo',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
				<small><?php echo $form->error($model,'brazo_izquierdo'); ?></small>
			</div>
			<div class="span8">
				<span class="label label-info">Brazo Izquierdo Anterior</span>
				<pre><?php echo trim($brazo_izquierdo); ?></pre>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="span12">
		<div class="span6">
			<?php echo $form->labelEx($model,'observaciones'); ?>
			<?php echo $form->textArea($model,'observaciones',array('class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'observaciones'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Observaciones</span>
			<pre><?php echo trim($observaciones); ?></pre>
		</div>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->