<?php
/* @var $this HistorialExamenFisicoController */
/* @var $model HistorialExamenFisico */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historial-examen-fisico-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

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

		$paciente = Paciente::model()->find("id=$elPaciente"); 
			//Calculo de Edad
	$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$paciente->fecha_nacimiento);
	$edadpaciente = date("Y") - $anio_nacimiento;
	//array('name'=>'Edad', 'value'=>$edadpaciente, ''),

		//Historial y variables
		$cabeza_cuello = "";
		$cardiopulmonar = "";
		$abdomen = "";
		$extremidades = "";
		$sistema_nervioso = "";
		$piel_fanera = "";
		$otros = "";

		$elHistorial = HistorialExamenFisico::model()->findAll("paciente_id=$elPaciente");
		foreach ($elHistorial as $el_historial) 
		{
			$cabeza_cuello = $cabeza_cuello . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->cabeza_cuello."<br><br>";
			$cardiopulmonar = $cardiopulmonar . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->cardiopulmonar."<br><br>";
			$abdomen = $abdomen . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->abdomen."<br><br>";
			$extremidades = $extremidades . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->extremidades."<br><br>";
			$sistema_nervioso = $sistema_nervioso . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->sistema_nervioso."<br><br>";
			$piel_fanera = $piel_fanera . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->piel_fanera."<br><br>";
			$otros = $otros . date('d-m-Y',strtotime($el_historial->fecha))."<br>".$el_historial->personal->nombreCompleto."<br>---------------<br>".$el_historial->otros."<br><br>";
		}

	?>
				<p class="note">Campos con <span class="required">*</span> son requeridos.</p>		
	<div class="row">

		<div class="span1"></div>
		<div class="span5">
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
		<div class="span5">
			<!-- <h4>Diagnsoticos</h4>
			<div class="row">
				<?php //echo $form->labelEx($model,'diagnostico_principal_id'); ?>
				<?php //echo $form->dropDownList($model, 'diagnostico_principal_id',CHtml::listData(DiagnosticoPrincipal::model()->findAll(),'id','diagnostico'), array('class'=>'input-xlarge'));?>
				<?php //echo $form->error($model,'diagnostico_principal_id'); ?>
			</div>
			
			<div class="row">
				<?php //echo $form->labelEx($model,'diagnostico_relacionado_id'); ?>
				<?php //echo $form->dropDownList($model, 'diagnostico_relacionado_id',CHtml::listData(DiagnosticoRelacionado::model()->findAll(),'id','diagnostico'), array('class'=>'input-xlarge'));?>
				<?php //echo $form->error($model,'diagnostico_relacionado_id'); ?>
			</div> -->

		</div>
		<div class="span1"></div>
	</div>

	<div class="row">
		<div class="span12"></div>
	</div>
	
	<div class="row">
		<div class="span6">
			<?php //echo $form->labelEx($model,'personal_id'); ?>
			<?php //echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' and id_perfil = 1"),'id','nombreCompleto'), array('class'=>'input-xxlarge'));?>
			<?php //echo $form->error($model,'personal_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class = "span1"></div>
		<div class = "span8">
				<div class="row">
					<div class = "span1"></div>
						<div class = "span4">
							<div class="hero-unit">
								<h4 class="text-center">IMC</h4>
								<div class = "row">
									
									<div class="span7">
										<div class="row">
											<?php //echo $form->labelEx($model,'peso'); ?>
											<?php echo $form->textField($model,'peso',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini', 'placeholder'=>'Peso')); ?>
											<small>
											<?php //echo $form->error($model,'peso'); ?>
											</small>
										</div>
											
										<div class="row">
											<?php //echo $form->labelEx($model,'altura'); ?>
											<?php echo $form->textField($model,'altura',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini', 'placeholder'=>'Altura')); ?>
											<small>
											<?php //echo $form->error($model,'altura'); ?>
											</small>
										</div>
									</div>
									
									<div class="span3">
										<div class="row">
											<p></p><p></p>
											<?php //echo $form->labelEx($model,'imc'); ?>
											<?php echo $form->textField($model,'imc',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini', 'placeholder'=>'IMC', 'readonly'=>'readonly')); ?>
											<?php echo $form->error($model,'imc'); ?>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class = "span1"></div>
						<div class="span3">
							<?php echo $form->labelEx($model,'observaciones'); ?>
							<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
							<?php echo $form->error($model,'observaciones'); ?>
						</div>
				</div>
			
		</div>
		
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'cabeza_cuello'); ?>
			<?php echo $form->textArea($model,'cabeza_cuello',array('rows'=>5, 'cols'=>40, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'cabeza_cuello'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Cabeza y Cuello</span>
			<pre><?php echo trim($cabeza_cuello); ?></pre>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'cardiopulmonar'); ?>
			<?php echo $form->textArea($model,'cardiopulmonar',array('rows'=>5, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'cardiopulmonar'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Cardiopulmonar</span>
			<pre><?php echo trim($cardiopulmonar); ?></pre>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'abdomen'); ?>
			<?php echo $form->textArea($model,'abdomen',array('rows'=>5, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'abdomen'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Abdomen</span>
			<pre><?php echo trim($abdomen); ?></pre>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'extremidades'); ?>
			<?php echo $form->textArea($model,'extremidades',array('rows'=>5, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'extremidades'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Extremidades</span>
			<pre><?php echo trim($extremidades); ?></pre>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'sistema_nervioso'); ?>
			<?php echo $form->textArea($model,'sistema_nervioso',array('rows'=>5, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'sistema_nervioso'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Sistema Nervioso</span>
			<pre><?php echo trim($sistema_nervioso); ?></pre>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'piel_fanera'); ?>
			<?php echo $form->textArea($model,'piel_fanera',array('rows'=>5, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'piel_fanera'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Piel y Fanera</span>
			<pre><?php echo trim($piel_fanera); ?></pre>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'otros'); ?>
			<?php echo $form->textArea($model,'otros',array('rows'=>5, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'otros'); ?>
		</div>
		<div class="span6">
			<span class="label label-info">Anterior Otros</span>
			<pre><?php echo trim($otros); ?></pre>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	$("#HistorialExamenFisico_peso").keyup(function (){
		var porpeso = eval($("#HistorialExamenFisico_peso").val()) / (eval($("#HistorialExamenFisico_altura").val())*eval($("#HistorialExamenFisico_altura").val()));
		if (porpeso >= 0) {
			$("#HistorialExamenFisico_imc").val(porpeso);
		};
		if ($("#HistorialExamenFisico_peso").val() == "") {
			$("#HistorialExamenFisico_imc").val("");
		};
		
	});

	$("#HistorialExamenFisico_altura").keyup(function (){
		var poraltura = eval($("#HistorialExamenFisico_peso").val()) / (eval($("#HistorialExamenFisico_altura").val())*eval($("#HistorialExamenFisico_altura").val()));
		if (poraltura >= 0) {
			$("#HistorialExamenFisico_imc").val(poraltura);
		};

		if ($("#HistorialExamenFisico_altura").val() == "") {
			$("#HistorialExamenFisico_imc").val("");
		};
		
	});
</script>