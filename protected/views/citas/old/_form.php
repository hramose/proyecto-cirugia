<?php
/* @var $this CitasController */
/* @var $model Citas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'citas-form',
	'htmlOptions'=>array(
       'onsubmit'=>"return validar();",/* Disable normal form submit */
       //'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
     ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>


<?php

//Variables por GEt

if(isset($_GET['hora']))
{$lahora = $_GET['hora'];}
else
{$lahora = 1;}

if(isset($_GET['medico']))
{$elmedico = $_GET['medico'];}
else
{$elmedico = 1;}

if(isset($_GET['idpaciente']))
{$elpaciente = $_GET['idpaciente'];}
else
{$elpaciente = 1;}

if(isset($_GET['fecha']))
{$lafecha = $_GET['fecha'];}
else
{$lafecha = "";}

?>
<div class="alert alert-info">
 <b>Atención:</b> Si al presionar el botón de Crear no sucede nada es debido a que no hay equipo disponible a la fecha y hora indicada.
</div>
	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'paciente_id'); ?>
		<?php echo $form->dropDownList($model, 'paciente_id',CHtml::listData(Paciente::model()->findAll("id = $elpaciente"),'id','NombreCompleto'), array('class'=>'input-xxlarge'));?>
		<?php echo $form->error($model,'paciente_id'); ?>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'personal_id'); ?>
			<?php echo $form->dropDownList($model, 'personal_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'"),'id','NombreCompleto'), array('options' => array($elmedico=>array('selected'=>true)),'class'=>'input-xlarge'));?>
			<?php echo $form->error($model,'personal_id'); ?>
		</div>

		<div class="span4">
			<?php //echo $form->labelEx($model,'contrato_id'); ?>
			<?php //echo $form->dropDownList($model, 'contrato_id',CHtml::listData(Contratos::model()->findAll("paciente_id = $elpaciente and estado = 'Activo'"),'id','id'), array('class'=>'input-small', 'empty'=>'---'));?>
			<?php //echo $form->error($model,'contrato_id'); ?>

			<?php echo $form->labelEx($model,'contrato_id'); ?>
			
			<?php 
			if ($model->contrato_id) 
			{
				echo CHtml::dropDownList('elContrato','', CHtml::listData(Contratos::model()->findAll("paciente_id = $elpaciente and estado = 'Activo'"),'id','id'),array('class'=>'input-xlarge', 'empty'=>'---', 'options' => array($model->contrato_id=>array('selected'=>true)),
				'ajax' => array(
				'type'=>'POST', //request type
				'url'=>CController::createUrl('citas/filtroContrato'), 
				'update'=>'#Citas_linea_servicio_id', 
				)));  
			}
			else
			{
				echo CHtml::dropDownList('elContrato','', CHtml::listData(Contratos::model()->findAll("paciente_id = $elpaciente and estado = 'Activo'"),'id','id'),array('class'=>'input-xlarge', 'empty'=>'---',
				'ajax' => array(
				'type'=>'POST', //request type
				'url'=>CController::createUrl('citas/filtroContrato'), 
				'update'=>'#Citas_linea_servicio_id', 
				)));  	
			}

			?>
			<?php echo $form->error($model,'contrato_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'linea_servicio_id'); ?>
			<?php //echo $form->dropDownList($model, 'linea_servicio_id',CHtml::listData(LineaServicio::model()->findAll("estado = 'activo'"),'id','nombre', 'tipo.nombre'), array('class'=>'input-xlarge', 'id'=>'id'));?>
			<?php echo $form->dropDownList($model, 'linea_servicio_id',CHtml::listData(LineaServicio::model()->findAll("estado = 'activo'"),'id','nombre', 'tipo.nombre'), array('class'=>'input-xlarge'));?>
			<?php echo $form->error($model,'linea_servicio_id'); ?>
		</div>

		<div class="span4">
			<?php //echo $form->labelEx($model,'estado'); ?>
			<?php //echo $form->dropDownList($model, 'estado',array('Programada'=>'Programada','Atendida'=>'Atendida', 'Cancelada'=>'Cancelada', 'Fallida'=>'Fallida'), array('readonly'));?>	
			<?php //echo $form->error($model,'estado'); ?>
		</div>
	</div>

<?php 
	if ($model->fecha_cita == '') {
		$model->fecha_cita = date('d-m-Y',strtotime($lafecha));
		
	}
	else
	{
		$fecha_cita = $model->fecha_cita=date('d-m-Y',strtotime($model->fecha_cita));	
	}
?>

	<div class="row">
		<div class="span3">
			<?php echo $form->labelEx($model,'fecha_cita'); ?>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<?php 

				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_cita',
					'language'=>'es',
					'model' => $model,
					'attribute' => 'fecha_cita',
					'value'=> $model->fecha_cita,
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
			<?php echo $form->error($model,'fecha_cita'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'hora_inicio'); ?>
			<?php echo $form->dropDownList($model, 'hora_inicio',CHtml::listData(HorasServicio::model()->findAll(),'id','hora'), array('options' => array($lahora=>array('selected'=>true)), 'class'=>'input-medium'));?>
			<?php echo $form->error($model,'hora_inicio'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'hora_fin'); ?>
			<?php echo $form->dropDownList($model, 'hora_fin',CHtml::listData(HorasServicio::model()->findAll(),'id','hora'), array('options' => array($lahora+1=>array('selected'=>true)), 'class'=>'input-medium'));?>
			<?php echo $form->error($model,'hora_fin'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php //echo $form->labelEx($model,'equipo_adicional'); ?>
			<?php //echo $form->dropDownList($model, 'equipo_adicional'	, CHtml::listData(Equipos::model()->findAll("Estado = 'Activo'"),'id','nombre'), array('empty'=>'(ninguno)'), array('class'=>'input-xlarge', 'id'=>'id'));?>
			<?php //echo $form->error($model,'equipo_adicional'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'correo'); ?>
			<?php echo $form->dropDownList($model, 'correo',array('Si'=>'Si','No'=>'No'), array('class'=>'input-small'));?>
			<?php echo $form->error($model,'correo'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'comentario'); ?>
			<?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'comentario'); ?>
		</div>
		<div class="span6">
			<h4>Tratamientos Pendientes</h4>
			<?php 
				$losContratos = Contratos::model()->findAll("paciente_id = $elpaciente and estado = 'Activo'");
				foreach ($losContratos as $los_contratos) 
				{
					echo "<b>Contrato: ".$los_contratos->id."</b><br>";
					?>
					<div id="<?php echo $los_contratos->id; ?>">
						
						<?php 
							$elDetalle = ContratoDetalle::model()->findAll("contrato_id = $los_contratos->id and estado != 'Completada'");
							foreach ($elDetalle as $el_detalle) 
							{
								echo "<b class='text-info'>".$el_detalle->lineaServicio->nombre." (".$el_detalle->realizadas." de ".$el_detalle->cantidad.")</b>";
								if ($el_detalle->estado == "Programada") 
								{
									echo " - <b class='text-warning'>1 Agendado</b><br>";
								}
								else
								{
									echo "<br>";
								}						
							}
						?>
						<br>
					</div>
					<?php
				}
			?>
		</div>
	</div>

<?php if ($model->id) 
{
?>


	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'actualizacion'); ?>
			<?php echo $form->textArea($model,'actualizacion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'actualizacion'); ?>
		</div>

		<div class="span6">

		</div>
	</div>

<?php
	# code...
} ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-info', 'id'=>'guardar', 'name'=>'guardar', 'onclick'=>'js:antesdeEnviar();')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	 function validar() 
	 {

	 	if($("#Citas_linea_servicio_id").val() == null)
		{
			swal("Este contrato esta agotado seleccione otro.");
			return false;
		}

		if($("#Citas_actualizacion").val() == "")
		{
			swal("Debe de agregar un comentario a la actualización.");
			return false;
		}	 	

		if($("#elContrato").val() == "") 
			{ 
				if (confirm('¿Desea crear esta cita sin vincular un contrato?')){ 
			       //document.tuformulario.submit() 
			    	return true; 
			    } 
			    else
			    {  	
			 		return false;
			    }
			} 
			else
			{
				return true; 
			}
	}

	$("#Citas_linea_servicio_id").change(
	function ()
	{
			//Regrsar a cero los id de hora_inicio y hora_fin
			//$("#Citas_hora_inicio").val(1);
			//$("#Citas_hora_fin").val(2);
	}
	)


	$("#Citas_hora_inicio").change(
		function ()
		{
			var linea = eval($("#Citas_linea_servicio_id").val());
			$("#Citas_linea_servicio_id").val($("#Citas_linea_servicio_id").val()+1);
			$("#Citas_linea_servicio_id").change();
			$("#Citas_linea_servicio_id").val(linea);
		}
	)


function antesdeEnviar()
{
	swal({   title: "Estamos agendando la cita!",   text: "Solo tomara unos segundos.",   timer: 15000,   showConfirmButton: false });
}
</script>
