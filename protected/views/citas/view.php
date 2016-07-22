<?php
/* @var $this CitasController */
/* @var $model Citas */

if ($model->estado == "Vencida" or $model->estado == "Programada") {
	if ($model->paciente->estado == 1) {
		$this->menu=array(
		array('label'=>'Listar Citas', 'url'=>array('index')),
		array('label'=>'Actualizar Cita', 'url'=>array('update', 'id'=>$model->id, 'idpaciente'=>$model->paciente_id)),
		array('label'=>'Buscar Cita', 'url'=>array('admin')),
	);
	}
	
}
else
{
	$this->menu=array(
		array('label'=>'Listar Citas', 'url'=>array('index')),
		array('label'=>'Buscar Cita', 'url'=>array('admin')),
	);
}

//Calculo de Edad
$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$model->paciente->fecha_nacimiento);
$edadpaciente = date("Y") - $anio_nacimiento;
?>

<script>
    var nCita = 0; //

    function miCita(nCitas, estados)
	{
		nCita = nCitas;
		estado = estados;
		$("#SeguimientoComercial_cita_id").val(nCita);
		$("#Citas_id").val(nCita);
		$("#Citas_contrato_id").val(nCita);


		$("#SeguimientoComercial_tipo").val(estado);
		
		if (estado=="Completada") 
			{
				document.getElementById('eltitulo').innerHTML = "Cita Completada";
				document.getElementById('omitir').style.display = 'block';
			};

		if (estado=="Vencida") 
			{
				document.getElementById('eltitulo').innerHTML = "Cita Vencida";
				document.getElementById('omitir').style.display = 'block';
			};

		if (estado=="Cancelada") 
			{
				document.getElementById('eltitulo').innerHTML = "Cita Cancelada";
				document.getElementById('omitir').style.display = 'block';
			};
		if (estado=="Fallida") 
			{
				document.getElementById('eltitulo').innerHTML = "Cita Fallida";
				document.getElementById('omitir').style.display = 'none';

			};
		if (estado=="Confirmada") 
			{
				document.getElementById('eltitulo').innerHTML = "Cita Programada";
				document.getElementById('omitir').style.display = 'block';
			};
	}

</script>

<h1>Cita #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php 

		if ($model->fecha_cita!='') {
				$fecha_cita=date('d-m-Y',strtotime($model->fecha_cita));
		}else{$fecha_cita=null;}

		if ($model->fecha_confirmacion!='') {
				$fecha_confirmacion=date('d-m-Y',strtotime($model->fecha_confirmacion));
		}else{$fecha_confirmacion=null;}

		$lahora = HorasServicio::model()->findByPK($model->hora_fin + 1);

		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Paciente', 'value'=>$model->paciente->nombreCompleto, ''),
				array('name'=>'Edad', 'value'=>$edadpaciente, ''),
				array('name'=>'Cedula', 'value'=>$model->paciente->n_identificacion, ''),
				array('name'=>'Dirección', 'value'=>$model->paciente->direccion, ''),
				array('name'=>'Celular', 'value'=>$model->paciente->celular, ''),
				array('name'=>'Personal', 'value'=>$model->personal->nombreCompleto, ''),
				'contrato_id',
				array('name'=>'Linea de Servicio', 'value'=>$model->lineaServicio->nombre,''),
			),
		)); ?>
	</div>

	<div class="span5">
		<?php
			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(

				'estado',
				array('name'=>'Agendado por', 'value'=>$model->usuario->nombreCompleto, ''),
				array('name'=>'Fecha de Cita', 'value'=>$fecha_cita,''),
				array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
				array('name'=>'Hora de Fin', 'value'=>$lahora->hora ,''),
				'correo',
				'comentario',
				'actualizacion',
			),
		));

		?>
	</div>
</div>

<!-- Los Equipos -->
<?php
$elEquipo = CitasEquipo::model()->findByPK($model->id);
if ($elEquipo) 
{
?>
<div class="text-center">
	<h5>Equipo que se usara en la cita: <span class="text-error"><?php echo $elEquipo->equipo->nombre . " - " .$elEquipo->equipo->numero; ?></span></h5>
</div>
<?php
}
?>

<?php if ($model->confirmacion != null): ?>
	<h4 class="text-center">La cita esta confirmada</h4>
	<div class="row">
		<div class="span1"></div>
		<div class = "span5">
			<?php
				$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'confirmacion',
					array('name'=>'Confirmado por:', 'value'=>$model->confirmado->nombreCompleto),
				),
			));

			?>
		</div>	
		<div class = "span5">
			<?php
				$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array('name'=>'Fecha de Confirmación', 'value'=>$fecha_confirmacion,''),
				),
			));

			?>
		</div>
	</div>
<?php endif ?>

<div class="row">
<div class="span1"></div>	
<div class="span10">
	<?php if ($model->estado == "Cancelada") {
	?>
	<h4 class="text-center">Motivo de Cancelación de Cita</h4>
	<p class="text-center"><?php echo $model->motivo_cancelacion; ?></p>
	<p class="text-center"><small><b>Fecha de Cancelación: </b><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha_accion); ?></small></p>	
	<?php
} ?>
</div>
</div>


<?php if ($model->usuario_estado_id != NULL): ?>
	<h4 class="text-center">Usuario que finalizo esta cita: <span class='text-info'><?php echo $model->usuarioEstado->nombreCompleto; ?> - <?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha_accion); ?></span></h4>	
<?php endif ?>

<?php 
	//Contadores
	$anamnesis 		= HistorialAnamnesis::model()->count("cita_id = $model->id");
	$examen 		= HistorialExamenFisico::model()->count("cita_id = $model->id");
	$evaluacion 	= HistorialEvaluacionMedica::model()->count("cita_id = $model->id");
	$evaluacionCosmetologica = HistorialEvaluacionCosmetologica::model()->count("cita_id = $model->id");
	$formulacion 	= HistorialFormulacion::model()->count("cita_id = $model->id");
	$laboratorio 	= HistorialLaboratorio::model()->count("cita_id = $model->id");
	$sistemas 		= HistorialRevisionSistema::model()->count("cita_id = $model->id");
	$tabla 			= HistorialTablaMedidas::model()->count("cita_id = $model->id");
	$plan 			= HistorialPlanTratamiento::model()->count("cita_id = $model->id");
	$diagnostico 	= HistorialDiagnostico::model()->count("cita_id = $model->id");
	$medicina 		= HistorialMedicinaBiologica::model()->count("cita_id = $model->id");
	$evolucionEnfermeria		= HistorialEvaluacionEnfermeria::model()->count("cita_id = $model->id");
	$hojadegastos	= HojaGastos::model()->count("cita_id = $model->id");
	$hojaCirugia	= HojaGastosCirugia::model()->count("cita_id = $model->id");
	$notaenfermeria	= HistorialNotasEnfermeria::model()->count("cita_id = $model->id");
	$fotografias 	= PacienteFotografias::model()->count("cita_id = $model->id");
	$archivoExamenes= PacienteResultadosLab::model()->count("cita_id = $model->id");
	$descripcionQuirurgica= HistorialDescripcionQuirurgica::model()->count("cita_id = $model->id");

	//IDs
	$paraformula = HistorialFormulacion::model()->find("cita_id = $model->id");
	$paraAnamnesis = HistorialAnamnesis::model()->find("cita_id = $model->id");
	$lafisica = HistorialExamenFisico::model()->find("cita_id = $model->id");
	$laMedica = HistorialEvaluacionMedica::model()->find("cita_id = $model->id");
	$laCosmetologica = HistorialEvaluacionCosmetologica::model()->find("cita_id = $model->id");
	$laEvolucionEnfermeria = HistorialEvaluacionEnfermeria::model()->find("cita_id = $model->id");
	$idDiagnostico = HistorialDiagnostico::model()->find("cita_id = $model->id");
	$idFormula = HistorialFormulacion::model()->find("cita_id = $model->id");
	$idMedicina = HistorialMedicinaBiologica::model()->find("cita_id = $model->id");
	$idNotas = HistorialNotasEnfermeria::model()->find("cita_id = $model->id");
	$idHojaGastos = HojaGastos::model()->find("cita_id = $model->id");
	$idHojaCirugia = HojaGastosCirugia::model()->find("cita_id = $model->id");
	$idDescripcionQuirurgica = HistorialDescripcionQuirurgica::model()->find("cita_id = $model->id");
	$idFotografias = PacienteFotografias::model()->find("cita_id = $model->id");
	$idResultados = PacienteResultadosLab::model()->find("cita_id = $model->id");
	$idLaboratorio = HistorialLaboratorio::model()->find("cita_id = $model->id");

	if ($formulacion >0) {
		$lasFormulas = HistorialFormulacionDetalle::model()->findAll("historial_formulacion_id = $idFormula->id");
	}else{
		$lasFormulas = HistorialFormulacionDetalle::model()->findAll("historial_formulacion_id = 0");
	}
	
	$losLaboratorios	= HistorialLaboratorio::model()->find("cita_id = $model->id");
	$idSistemas			= HistorialRevisionSistema::model()->find("cita_id = $model->id");
	$idTabla			= HistorialTablaMedidas::model()->find("cita_id = $model->id");
	$idPlan				= HistorialPlanTratamiento::model()->find("cita_id = $model->id");
	if ($plan > 0) {
		$lasLineas = HistorialPlanTratamientoDetalle::model()->findAll("historial_plan_tratamiento_id = $idPlan->id");
	}else{
		$lasLineas = HistorialPlanTratamientoDetalle::model()->findAll("historial_plan_tratamiento_id = 0");
	}
	$laRevision = HistorialRevisionSistema::model()->find("cita_id = $model->id");
	$latabla = HistorialTablaMedidas::model()->find("cita_id = $model->id");
	if ($diagnostico > 0) {
		$losDiagnosticos = HistorialDiagnosticoDetalle::model()->findAll("historial_diagnostico_id = $idDiagnostico->id");
	}else{
		$losDiagnosticos = HistorialDiagnosticoDetalle::model()->findAll("historial_diagnostico_id = 0");
	}

	if ($medicina > 0) {
		$losPlanes = HistorialMedicinaBiologicaDetalle::model()->findAll("historial_medicina_biologica_id = $idMedicina->id");
	}else{
		$losPlanes = HistorialMedicinaBiologicaDetalle::model()->findAll("historial_medicina_biologica_id = 0");
	}


	//Contadores Generales
	$Ganamnesis = HistorialAnamnesis::model()->count("paciente_id = $model->paciente_id");
	$Gexamen = HistorialExamenFisico::model()->count("paciente_id = $model->paciente_id");
	$Gformulacion = HistorialFormulacion::model()->count("paciente_id = $model->paciente_id");
	$Gevaluacion = HistorialEvaluacionMedica::model()->count("paciente_id = $model->paciente_id");
	$Gcosmetologica = HistorialEvaluacionCosmetologica::model()->count("paciente_id = $model->paciente_id");
	$Gnotas = HistorialNotasEnfermeria::model()->count("paciente_id = $model->paciente_id");
	$Glaboratorio = HistorialLaboratorio::model()->count("paciente_id = $model->paciente_id");
	$Gsistemas = HistorialRevisionSistema::model()->count("paciente_id = $model->paciente_id");
	$Gtabla = HistorialTablaMedidas::model()->count("paciente_id = $model->paciente_id");
	$Gplan = HistorialPlanTratamiento::model()->count("paciente_id = $model->paciente_id");
	$GevolucionEnfermeria = HistorialEvaluacionEnfermeria::model()->count("paciente_id = $model->paciente_id");
	$Gdiagnostico = HistorialDiagnostico::model()->count("paciente_id = $model->paciente_id");
	$GplanMedicina = HistorialMedicinaBiologica::model()->count("paciente_id = $model->paciente_id");
	$Gfotos = PacienteFotografias::model()->count("paciente_id = $model->paciente_id");
	$Gresultados = PacienteResultadosLab::model()->count("paciente_id = $model->paciente_id");
	

?>

<?php 
	$elSaldo = 0;
	//Verificar si hay cuentas por cobrar
	$DetalleCxC = CuentasXcDetalle::model()->find("cita_id = $model->id and contrato_id is NULL");

	if ($DetalleCxC and $DetalleCxC->saldo > 0) {
		$elSaldo = $DetalleCxC->saldo;
		?>
	<div class = "row">
		<div class="span12 text-center">
			<h4>Esta cita posee saldo pendiente de cancelar por un valor de: <span class="text-error">$ <?php echo number_format($DetalleCxC->saldo,2); ?></span> 
			<a href="index.php?r=ingresos/create&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id; ?>" role="button" class="btn btn-small btn-success" data-toggle="modal"><i class="icon-hdd icon-white"></i> Liquidar</a>
			</h4>
		</div>
	</div>
		<?php
	}

?>

<?php
	if ($model->estado == "Completada" and $model->linea_servicio_id == 5 and $model->contrato_id == NULL and $elSaldo > 0) 
	{
		?>
		<div class="well well-large">
			<h4 class="text-center">Descuento por llegada oportuna</h4>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'descuento-form',
					'action'=>'index.php?r=citas/descuento&idCita='.$model->id,
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>true,
				)); ?>
				<h4 class="text-center">Establezca el nuevo valor de esta valoración inicial:
					<div class="input-prepend">
  						<span class="add-on">$</span>
							<input type="text" name="valoracion" id = "valoracion" class="input-small" value = <?php echo $DetalleCxC->saldo ?>>
					</div>
				</h4>

				<div class="text-center">
					<?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-info')); ?>
				</div>
				<?php $this->endWidget(); ?>
		</div>
		<?php
	}
?>


<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php 
		if ($model->llego_clinica > '2005-01-01') 
			{
		?>
			<h4 class="text-center"><span class="label label-important">Paciente ya esta aqui: <?php echo Yii::app()->dateformatter->format("dd-MM-yyyy H:m:ss", $model->llego_clinica); ?></span></h4>
			<?php } ?>
		<h4 class="text-center">Para Esta Cita</h4>
		<table class="table table-condensed">
			<?php
				if ($anamnesis >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Anamnesis</td>
					<td><a href="#verAnamnesis" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialAnamnesis/update&id=<?php echo $paraAnamnesis->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>
			<?php
				if ($examen >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Examen Físico</td>
					<td><a href="#verFisico" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialExamenFisico/update&id=<?php echo $lafisica->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>
			<?php
				if ($evaluacion >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Evolución Médica</td>
					<td><a href="#verMedica" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a> 
						<a href="index.php?r=historialEvaluacionMedica/update&id=<?php echo $laMedica->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>
			<?php
				if ($evaluacionCosmetologica >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Evolución Cosmetológica</td>
					<td><a href="#verCosmetologica" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialEvaluacionCosmetologica/update&id=<?php echo $laCosmetologica->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($evolucionEnfermeria >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Evolución de Enfermería</td>
					<td><a href="#verEnfermeria" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialEvaluacionEnfermeria/update&id=<?php echo $laEvolucionEnfermeria->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($formulacion >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Formulaciones</td>
					<td><a href="#verFormulacion" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialFormulacion/update&id=<?php echo $idFormula->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($laboratorio >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Examenes de Laboratorio</td>
					<td><a href="#verExamenes" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialLaboratorio/update&id=<?php echo $idLaboratorio->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
						<?php 
						$this->widget('ext.popup.JPopupWindow', array( 
						'tagName'=>'button',
						'content'=> ' Imprimir ', 
						'url'=>array('HistorialLaboratorio/laboratorio', 'id'=>$idLaboratorio->id),
						/*'url'=>array('/site/contact'), */
						'htmlOptions'=>array('class'=>'btn btn-mini btn-primary'),
						'options'=>array( 
						'height'=>700, 
						'width'=>800, 
						'top'=>50, 
						'left'=>50, 
						), 
						)); 
					?>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($sistemas >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Revisión por Sistemas </td>
					<td><a href="#verSistemas" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialRevisionSistema/update&id=<?php echo $laRevision->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($tabla >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Tabla de Medidas </td>
					<td><a href="#verTabla" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialTablaMedidas/update&id=<?php echo $latabla->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($plan >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Plan de Tratamiento </td>
					<td><a href="#verPlan" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialPlanTratamiento/update&id=<?php echo $idPlan->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($diagnostico >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Diagnostico Clínico </td>
					<td><a href="#verDiagnostico" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialDiagnostico/update&id=<?php echo $idDiagnostico->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($fotografias >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Fotografías </td>
					<td><a href="#verFotografias" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=pacienteFotografias/update&id=<?php echo $idFotografias->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($archivoExamenes >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Resultados de Laboratorio </td>
					<td><a href="#verResultados" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=pacienteResultadosLab/update&id=<?php echo $idResultados->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($medicina >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Plan de Medicina Biologica </td>
					<td><a href="#verPlanMedicina" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=HistorialMedicinaBiologica/update&id=<?php echo $idMedicina->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					</td>
				</tr>
			<?php
				}
			?>
			<?php
				if ($notaenfermeria >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Notas de Enfermeria </td>
					<td><a href="#verNotas" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialNotasEnfermeria/update&id=<?php echo $idNotas->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					<?php 
						$this->widget('ext.popup.JPopupWindow', array( 
						'tagName'=>'button',
						'content'=> ' Imprimir ', 
						'url'=>array('HistorialNotasEnfermeria/notas', 'id'=>$model->id),
						/*'url'=>array('/site/contact'), */
						'htmlOptions'=>array('class'=>'btn btn-mini btn-primary'),
						'options'=>array( 
						'height'=>700, 
						'width'=>800, 
						'top'=>50, 
						'left'=>50, 
						), 
						)); 
					?>
					</td>
				</tr>
			<?php
				}
			?>
			<?php
				if ($hojadegastos >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Hoja de Gastos </td>
					<td><a href="#verHojaGastos" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=hojaGastos/update&id=<?php echo $idHojaGastos->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					<?php 
						$this->widget('ext.popup.JPopupWindow', array( 
						'tagName'=>'button',
						'content'=> ' Imprimir ', 
						'url'=>array('hojaGastos/hoja', 'id'=>$model->id),
						/*'url'=>array('/site/contact'), */
						'htmlOptions'=>array('class'=>'btn btn-mini btn-primary'),
						'options'=>array( 
						'height'=>700, 
						'width'=>800, 
						'top'=>50, 
						'left'=>50, 
						), 
						)); 
					?>
					</td>
				</tr>
			<?php
				}
			?>

			<?php
				if ($hojaCirugia >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Hoja de Gastos de Cirugía</td>
					<td><a href="#verHojaCirugia" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=hojaGastos/update&id=<?php echo $idHojaCirugia->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					<?php 
						// $this->widget('ext.popup.JPopupWindow', array( 
						// 'tagName'=>'button',
						// 'content'=> ' Imprimir ', 
						// 'url'=>array('hojaGastos/hoja', 'id'=>$model->id),
						// 'url'=>array('/site/contact'), 
						// 'htmlOptions'=>array('class'=>'btn btn-mini btn-primary'),
						// 'options'=>array( 
						// 'height'=>700, 
						// 'width'=>800, 
						// 'top'=>50, 
						// 'left'=>50, 
						// ), 
						// )); 
					?>
					</td>
				</tr>
			<?php
				}
			?>
			<?php
				if ($descripcionQuirurgica >0) {
			?>
				<tr>
					<td><i class="icon-book"></i>  Descripción Quirurjica </td>
					<td><a href="#verDescripcion" role="button" class="btn btn-mini btn-warning" data-toggle="modal">Ver</a>
						<a href="index.php?r=historialDescripcionQuirurgica/update&id=<?php echo $idDescripcionQuirurgica->id; ?>&idPaciente=<?php echo $model->paciente_id;?>&idCita=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
					<?php 
						$this->widget('ext.popup.JPopupWindow', array( 
						'tagName'=>'button',
						'content'=> ' Imprimir ', 
						'url'=>array('HistorialDescripcionQuirurgica/descripcion', 'id'=>$model->id),
						/*'url'=>array('/site/contact'), */
						'htmlOptions'=>array('class'=>'btn btn-mini btn-primary'),
						'options'=>array( 
						'height'=>700, 
						'width'=>800, 
						'top'=>50, 
						'left'=>50, 
						), 
						)); 
					?>
					</td>
				</tr>
			<?php
				}
			?>
		</table>
	</div>
	<div class="span5 text-center">
		<?php 
			//Verificar que paciente este activo
		if ($model->paciente->estado == 1): ?>
		<?php if($model->estado == "Programada" or $model->estado == "Vencida"){ ?>
		<b class="text-center">Opciones de la Cita</b>
		<br>
		<br>
		<?php 
			if ($model->llego_clinica < '2005-01-01') 
			{
				?>
				<a href="#aqui" role="button" class="btn btn-mini btn-info" data-toggle="modal"><i class="icon-hand-down icon-white"></i> Esta aqui</a>
				<?php
			}
		?>
		<?php
			if ($model->confirmacion == null) {
				?>
				<a href="#confirmar" role="button" class="btn btn-mini btn-warning" data-toggle="modal"><i class="icon-thumbs-up icon-white"></i> Confirmar</a>
			<?php
			}
		?>
		<small><button onclick="miCita(<?php echo $model->id; ?>, 'Fallida')" type="button" data-toggle="modal" data-target="#completar" class="btn btn-mini btn-inverse" title="Cita Fallida"><i class="icon-thumbs-down icon-white"></i> Fallida</button></small>
		<small><button onclick="miCita(<?php echo $model->id; ?>, 'Completada')" type="button" data-toggle="modal" data-target="#completar" class="btn btn-mini btn-success" title="Cita Completada"><i class="icon-ok icon-white"></i> Completada</button></small>
		<a href="#cancelar" role="button" class="btn btn-mini btn-danger" data-toggle="modal"><i class="icon-ban-circle icon-white"></i> Cancelada</a>
		<?php } ?>
		<br><br>
		<a href="index.php?r=paciente/view&id=<?php echo $model->paciente->id ?>" role="button" class="btn btn-mini btn-primary" data-toggle="modal"><i class="icon-file icon-white"></i> Ver Ficha de Paciente</a>
		<a href="index.php?r=citas/calendario&idpersonal=<?php echo $model->personal->id_perfil.'&fecha='.$fecha_cita ?>" role="button" class="btn btn-mini btn-warning" data-toggle="modal"><i class="icon-zoom-in icon-white"></i> Ver Agenda</a>
		<a href="#cita" role="button" class="btn btn-mini btn-success" data-toggle="modal"><i class="icon-calendar icon-white"></i> Agendar Cita</a>
		<br><br>

		<?php endif ?>
	
	

		<div class="btn-group">
			<a class="btn btn-small btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
			  <i class="icon-folder-open icon-white"></i> Historia Clinica
			  <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
			<?php if ($anamnesis ==0) {?>
			  <li><a href="index.php?r=HistorialAnamnesis/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>">Anamnesis</a></li>
			<?php } ?>
			<?php if ($sistemas ==0) {?>
				<li><a href="index.php?r=HistorialRevisionSistema/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Revisión por Sistemas</a></li>
			<?php } ?>
			<?php if ($examen ==0) {?>
			  <li><a href="index.php?r=HistorialExamenFisico/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Examen Físico</a></li>
			<?php } ?>
			<?php if ($tabla ==0) {?>
			  <li><a href="index.php?r=HistorialTablaMedidas/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Tabla de Medidas</a></li>
			<?php } ?>
			<?php if ($diagnostico ==0) {?>
			  <li><a href="index.php?r=HistorialDiagnostico/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Diagnostico</a></li>
			<?php } ?>
			<?php if ($plan ==0) {?>
			  <li><a href="index.php?r=HistorialPlanTratamiento/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Plan de Tratamiento</a></li>
			<?php } ?>
			<?php if ($medicina ==0) {?>
			  <li><a href="index.php?r=HistorialMedicinaBiologica/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Plan de Medicina Biológica</a></li>
			<?php } ?>
			<?php if ($laboratorio ==0) {?>
			  <li><a href="index.php?r=HistorialLaboratorio/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Orden de Examanes de Laboratorio</a></li>
			<?php } ?>
			<?php if ($evaluacion ==0) {?>
			  <li><a href="index.php?r=HistorialEvaluacionMedica/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Evolución Medica</a></li>
			<?php } ?>
			<?php if ($evolucionEnfermeria ==0) {?>
			  <li><a href="index.php?r=HistorialEvaluacionEnfermeria/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Evolución de Enfermería</a></li>
			<?php } ?>
			<?php if ($evaluacionCosmetologica ==0) {?>
			  <li><a href="index.php?r=HistorialEvaluacionCosmetologica/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Evolución Cosmetológica</a></li>
			<?php } ?>
			<?php if ($formulacion ==0) {?>
			  <li><a href="index.php?r=HistorialFormulacion/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Formulación</a></li>
			<?php } ?>
			<?php if ($hojadegastos ==0) {?>
			  <li><a href="index.php?r=HojaGastos/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Hoja de Gastos</a></li>
			<?php } ?>
			<?php if ($hojaCirugia ==0) {?>
			  <li><a href="index.php?r=HojaGastosCirugia/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Hoja de Gastos de Cirugía</a></li>
			<?php } ?>
			<?php if ($notaenfermeria ==0) {?>
			  <li><a href="index.php?r=HistorialNotasEnfermeria/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Notas de Enfermería</a>
			  </li>
			<?php } ?>
			<?php if ($descripcionQuirurgica ==0) {?>
			  <li><a href="index.php?r=HistorialDescripcionQuirurgica/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Descripción Quirurjica</a>
			  </li>
			<?php } ?>
			<?php if ($fotografias ==0) {?>
			  <li><a href="index.php?r=PacienteFotografias/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Fotografías</a>
			  </li>
			<?php } ?>
			<?php if ($archivoExamenes ==0) {?>
			  <li><a href="index.php?r=PacienteResultadosLab/create&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->id; ?>" data-toggle="modal">Resultados de Laboratorio</a>
			  </li>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>


<?php 
	$lasCitas = Citas::model()->findAll("paciente_id = $model->paciente_id");
	if (count($lasCitas)>0) 
	{
		?>
		
		<div class="row">
			<div class="span12">
				<h2 class="text-center">Historial de Citas</h2>
				<table class="table table-striped">
					<tr>
						<th>Fecha</th>
						<th>Profesional</th>
						<th>Contrato</th>
						<th>Servicio</th>
						<th>Comentario</th>
						<th>Inicio</th>
						<th>Fin</th>
						<th>Estado</th>
						<th></th>
					</tr>
				<?php 
					foreach ($lasCitas as $las_citas) 
					{
				?>
					<tr>
						<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_citas->fecha_cita); ?></td>
						<td><?php echo $las_citas->personal->nombreCompleto; ?></td>
						<td><?php echo $las_citas->contrato_id; ?></td>
						<td><?php echo $las_citas->lineaServicio->nombre; ?></td>
						<td><?php echo $las_citas->comentario; ?></td>
						<td><?php echo $las_citas->horaInicio->hora; ?></td>
						<td><?php echo $las_citas->horaFinMostrar->hora; ?></td>
						<td><?php echo $las_citas->estado; ?></td>
						<td><small><a href='index.php?r=citas/view&id=<?php echo $las_citas->id;?>'>[Ver]</a></small></td>
					</tr>
				<?php
					}
				?>					
				</table>
			</div>
		</div>

		<?php
			//Buscar Historial de actualizaciones
			$historialActualizacion = CitasActualizacion::model()->findAll("cita_id = $model->id");
			if ($historialActualizacion) 
			{
				?>
				<div class="row">
				<div class="span12">
					<h3 class="text-center">Historial de Actualizaciones</h3>
					<table class="table table-striped">
						<tr>
							<th>Fecha</th>
							<th>Profesional</th>
							<th>Contrato</th>
							<th>Servicio</th>
							<th>Comentario</th>
							<th>Inicio</th>
							<th>Fin</th>
							<th>Comentario Actualizacion</th>
							<th>Personal Actualizo</th>
						</tr>
						<?php 
							foreach ($historialActualizacion as $historial_actualizacion) 
							{
						?>
							<tr>
								<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$historial_actualizacion->fecha); ?></td>
								<td><?php echo $historial_actualizacion->personal; ?></td>
								<td><?php echo $historial_actualizacion->contrato; ?></td>
								<td><?php echo $historial_actualizacion->servicio; ?></td>
								<td><?php echo $historial_actualizacion->comentario; ?></td>
								<td><?php echo $historial_actualizacion->inicio0->hora; ?></td>
								<td><?php echo $historial_actualizacion->fin0->hora; ?></td>
								<td><?php echo $historial_actualizacion->actualizacion; ?></td>
								<td><?php echo $historial_actualizacion->usuario; ?></td>
							</tr>
						<?php
							}
						?>					
						</table>
					</div>
				</div>
		
				<?php


			}
		?>


		<!-- Resumenes de Historial Clinico -->
		<div class="row">
			<div class="span12 text-center">
				<h4 class = "text-center">Resumenes de Historial Clinico</h4>
				<?php if ($Ganamnesis >0) {	?>
					<a href="#Ganamnesis" role="button" class="btn btn-mini btn-info" data-toggle="modal">Anamnesis</a>
				<?php }	?>
				
				<?php if ($Gexamen >0) { ?>
					<a href="#Gexamen" role="button" class="btn btn-mini btn-info" data-toggle="modal">Examen Físico</a>
				<?php }	?>
				
				<?php if ($Gevaluacion >0) { ?>
					<a href="#Gevaluacion" role="button" class="btn btn-mini btn-info" data-toggle="modal">Evolución Medica</a>
				<?php }	?>

				<?php if ($Gevaluacion >0) { ?>
					<a href="#Gcosmetologica" role="button" class="btn btn-mini btn-info" data-toggle="modal">Evolución Cosmetológica</a>
				<?php }	?>

				<?php if ($GevolucionEnfermeria >0) { ?>
					<a href="#GevolucionEnfermeria" role="button" class="btn btn-mini btn-info" data-toggle="modal">Evolución de Enfermería</a>
				<?php }	?>
				
				<?php if ($Gformulacion >0) { ?>
					<a href="#Gformulacion" role="button" class="btn btn-mini btn-info" data-toggle="modal">Formulación</a>
				<?php }	?>

				<?php if ($Glaboratorio >0) { ?>
					<a href="#Glaboratorio" role="button" class="btn btn-mini btn-info" data-toggle="modal">Examenes de Laboratorio</a>
				<?php }	?>

				<?php if ($Gsistemas >0) { ?>
					<a href="#Gsistemas" role="button" class="btn btn-mini btn-info" data-toggle="modal">Revisión por Sistemas</a>
				<?php }	?>

				<?php if ($Gtabla >0) {	?>
					<a href="#Gtabla" role="button" class="btn btn-mini btn-info" data-toggle="modal">Tabla de Medidas</a>
				<?php }	?>

				<?php if ($Gplan >0) { ?>
					<a href="#Gplan" role="button" class="btn btn-mini btn-info" data-toggle="modal">Plan de Tratamiento</a>
				<?php }	?>

				<?php if ($Gdiagnostico >0) { ?>
					<a href="#Gdiagnostico" role="button" class="btn btn-mini btn-info" data-toggle="modal">Diagnostico Clínico</a>
				<?php }	?>

				<?php if ($GplanMedicina >0) { ?>
					<a href="#GplanMedicina" role="button" class="btn btn-mini btn-info" data-toggle="modal">Medicina Biológica</a>
				<?php }	?>

				<?php if ($GevolucionEnfermeria >0) { ?>
					<a href="#GevolucionEnfermeria" role="button" class="btn btn-mini btn-info" data-toggle="modal">Evolución de Enfermería</a>
				<?php }	?>

				<?php if ($Gfotos >0) { ?>
					<a href="#Gfotos" role="button" class="btn btn-mini btn-info" data-toggle="modal">Fotografías</a>
				<?php }	?>

				<?php if ($Gresultados >0) { ?>
					<a href="#Gresultados" role="button" class="btn btn-mini btn-info" data-toggle="modal">Resultados de Laboratorio</a>
				<?php }	?>
				
		</div>


		<?php
	}
?>

<!-- Modales -->

<?php if ($formulacion >0) { ?>
<!-- Formulaciones -->
<div id="verFormulacion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Formulaciones</h3>
  </div>
  <div class="modal-body">
 	<p>Lista de Formulaciones para esta Cita</p>
 	<table class="table table-striped">
			<tr>
				<th>Formula</th>
				<th>Formulación</th>
			</tr>
		
		<?php 
			foreach ($lasFormulas as $las_formulas) 
			{
				?>
				<tr>
					<?php if($las_formulas->formulacion_id != "")
					{
						?>
					<td><?php echo $las_formulas->laformulacion->nombre; ?></td>
						<?php
					}
					else
					{
						?>
					<td><?php echo $las_formulas->otra_formulacion; ?></td>
						<?php	
					}
					?>
					
					<td><?php echo $las_formulas->formulacion; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
    <?php 
				$this->widget('ext.popup.JPopupWindow', array( 
						'tagName'=>'button',
						'content'=> '<i class="icon-file icon-white"></i> Imprimir ', 
						'url'=>array('historialFormulacion/imprimirFormulacion', 'id'=>$las_formulas->historial_formulacion_id),
						/*'url'=>array('/site/contact'), */
						'htmlOptions'=>array('class'=>'btn btn-info'),
						'options'=>array( 
						'height'=>700, 
						'width'=>800, 
						'top'=>50, 
						'left'=>50, 
						), 
						));
			?>
  </div>
</div>
<?php } ?>


<?php if ($plan >0) { ?>
<!-- Plan de tratamiento -->
<div id="verPlan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Plan de Tratamiento</h3>
  </div>
  <div class="modal-body">
 	<p></p>
 	<table class="table table-striped">
			<tr>
				<th>Linea</th>
				<th>Observaciones</th>
			</tr>
		
		<?php 
			foreach ($lasLineas as $las_lineas) 
			{
				?>
				<tr>
					
					<td><?php echo $las_lineas->lineaServicio->nombre; ?></td>				
					<td><?php echo $las_lineas->observacion; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>
<?php } ?>

<!-- Diagnostico Clinico -->
<?php if ($diagnostico >0) { ?>
<div id="verDiagnostico" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Diagnostico Clínico</h3>
  </div>
  <div class="modal-body">
 	<p></p>
 	<table class="table table-striped">
			<tr>
				<th>Diagnotico</th>
				<th>Tipo</th>
				<th>Observaciones</th>
			</tr>
		
		<?php 
			foreach ($losDiagnosticos as $los_diagnosticos) 
			{
				?>
				<tr>
					
					<td><?php echo $los_diagnosticos->diagnostico->diagnostico; ?></td>
					<td><?php echo $los_diagnosticos->diagnostico->tipo; ?></td>
					<td><?php echo $los_diagnosticos->observaciones; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>
<?php } ?>


<!-- Anamnesis -->
<?php if ($anamnesis >0) { ?>
<div id="verAnamnesis" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Anamnesis</h3>
  </div>
  <div class="modal-body">
 	<p>Anamnesis para esta Cita</p>
 	<table class="table table-striped">
		<tr>
			<td>Motivo Consulta</td>
			<td><?php echo $paraAnamnesis->motivo_consulta; ?></td>
		</tr>			
		<tr>
			<td>Enfermedad Actual</td>
			<td><?php echo $paraAnamnesis->enfermedad_actual; ?></td>
		</tr>
		<tr>
			<td>Antecedente Patologico</td>
			<td><?php echo $paraAnamnesis->antecedente_patologico; ?></td>
		</tr>	
		<tr>
			<td>Antecedente Quirurgico</td>
			<td><?php echo $paraAnamnesis->antecedente_quirurgico; ?></td>
		</tr>	
		<tr>
			<td>Antecedente Alergico</td>
			<td><?php echo $paraAnamnesis->antecedente_alergico; ?></td>
		</tr>			
		<tr>
			<td>Antecedente Traumatico</td>
			<td><?php echo $paraAnamnesis->antecedente_traumatico; ?></td>
		</tr>	
		<tr>
			<td>Antecedente Medicamento</td>
			<td><?php echo $paraAnamnesis->antecedente_medicamento; ?></td>
		</tr>			
		<tr>
			<td>Antecedente Ginecologico</td>
			<td><?php echo $paraAnamnesis->antecedente_ginecologico; ?></td>
		</tr>		
		<tr>
			<td>Antecedente Fum</td>
			<td><?php echo $paraAnamnesis->antecedente_fum; ?></td>
		</tr>
		<tr>
			<td>Antecedente Habitos</td>
			<td><?php echo $paraAnamnesis->antecedente_habitos; ?></td>
		</tr>
		<tr>
			<td>Antecedente Familiares</td>
			<td><?php echo $paraAnamnesis->antecedente_familiares; ?></td>
		</tr>
		<tr>
			<td>Antecedente Nutricionales</td>
			<td><?php echo $paraAnamnesis->antecedente_nutricionales; ?></td>
		</tr>
		<tr>
			<td>Observaciones Paciente</td>
			<td><?php echo $paraAnamnesis->observaciones_paciente; ?></td>
		</tr>
	</table>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>
<?php } ?>


<!-- Evolución Costemológica -->
<?php if ($evaluacionCosmetologica > 0) { ?>
<div id="verCosmetologica" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Evolución Cosmetológica</h3>
  </div>
  <div class="modal-body">
 	<p>Evolución Cosmetológica para esta Cita</p>
 	<?php $evaCosmetologica = HistorialEvaluacionCosmetologica::model()->find("cita_id = $model->id"); ?>
 	<b><?php echo $evaCosmetologica->evaluacion; ?></b>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>

<!-- Examen Fisico -->
<?php if ($examen > 0) { ?>
<div id="verFisico" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Examen Físico</h3>
  </div>
  <div class="modal-body">
 	<p>Examen Físico para esta cita</p>
 	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$lafisica,
		'attributes'=>array(
			'peso',
			'altura',
			'imc',
			'cabeza_cuello',
			'cardiopulmonar',
			'abdomen',
			'extremidades',
			'sistema_nervioso',
			'piel_fanera',
			'otros',
			'observaciones',
		),
	)); ?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Evolución Costemológica -->
<?php if ($evolucionEnfermeria > 0) { ?>
<div id="verEnfermeria" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Evolución de Enfermería</h3>
  </div>
  <div class="modal-body">
 	<p>Evolución de Enfermería para esta Cita</p>
 	<?php $evaEnfermeria = HistorialEvaluacionEnfermeria::model()->find("cita_id = $model->id"); ?>
 	<b><?php echo $evaEnfermeria->evaluacion; ?></b>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>

<!-- Examen Fisico -->
<?php if ($examen > 0) { ?>
<div id="verFisico" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Examen Físico</h3>
  </div>
  <div class="modal-body">
 	<p>Examen Físico para esta cita</p>
 	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$lafisica,
		'attributes'=>array(
			'peso',
			'altura',
			'imc',
			'cabeza_cuello',
			'cardiopulmonar',
			'abdomen',
			'extremidades',
			'sistema_nervioso',
			'piel_fanera',
			'otros',
			'observaciones',
		),
	)); ?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Plan de Medicina Biologica -->
<?php if ($medicina > 0) { ?>
<div id="verPlanMedicina" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Plan de Medicina Biologica</h3>
  </div>
  <div class="modal-body">
 	<table class="table table-striped">
			<tr>
				<th>Ciclo</th>
				<th>Sesión</th>
				<th>Medicamento</th>
			</tr>
		<?php $losMedicamentos = HistorialMedicinaBiologicaDetalle::model()->findAll("historial_medicina_biologica_id = $idMedicina->id"); 
			  $losCiclos = HistorialMedicinaBiologica::model()->findAll(array("condition" => "paciente_id = $model->paciente_id", 'order'=>'id asc'));
			  $i = 1;
			  $nCita = 0;
			  foreach ($losCiclos as $los_ciclos) 
			  {
			  	if ($los_ciclos->cita_id = $model->id) {
			  		$nCita = $i;
			  	}
			  	$i++;
			  }

		?>
		<?php 
			foreach ($losMedicamentos as $los_medicamentos) 
			{
				?>
				<tr>
					<td>Ciclo <?php echo $nCita; ?></td>
					<td>Sesión <?php echo $los_medicamentos->ciclo; ?></td>
					<td><?php echo $los_medicamentos->medicamentosBiologicos->medicamento; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Evolución Médica -->
<?php if ($evaluacion > 0) { ?>
<div id="verMedica" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Evolución Médica</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Evolución Médica para esta cita</p>
 	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$laMedica,
		'attributes'=>array(
			'evolucion',
		),
	)); ?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Evolución Médica -->
<?php if ($laboratorio > 0) { ?>
<div id="verExamenes" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Examenes de Laboratorio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Examenes Ordenados en esta Cita</p>
 	<table class="table table-striped">
			<tr>
				<th>Laboratorio</th>
				<th>Descripción</th>
			</tr>
		<?php $losExamenes = HistorialLaboratorioDetalle::model()->findAll("historial_laboratorio_id = $losLaboratorios->id") ?>
		<?php 
			foreach ($losExamenes as $los_examenes) 
			{
				?>
				<tr>
					<td><?php 
					if($los_examenes->laboratorio_id)
					{
						echo $los_examenes->laboratorio->nombre;
					}
					else
					{
						echo "Otro";
					}
					 ?></td>
					<td><?php echo $los_examenes->examen; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>

<!-- Tabla de medidas -->
<?php if ($tabla > 0) { ?>
<div id="verTabla" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tabla de Medidas</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$latabla = HistorialTablaMedidas::model()->find("cita_id = $model->id"); 
 		
 		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$latabla,
			'attributes'=>array(
				'imc',
				'peso',
				'busto',
				'contorno',
				'cintura',
				'umbilical',
				'abd_inferior',
				'abd_superior',
				'cadera',
				'piernas',
				'muslo_derecho',
				'muslo_izquierdo',
				'brazo_derecho',
				'brazo_izquierdo',
			),
		)); 
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>

<!-- Notas de Enfermería -->
<?php if ($notaenfermeria > 0) { ?>
<div id="verNotas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Notas de Enfermería</h3>
  </div>
  <div class="modal-body">
 	
 	<table class="table table-striped">
			<tr>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Nota</th>
			</tr>

				<tr>
					<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$idNotas->fecha_nota); ?></td>
					<td><?php echo $idNotas->hora; ?></td>
					<td><?php echo $idNotas->nota; ?></td>
				</tr>
			
		</table>
 	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Hoja de Gastos -->
<?php if ($hojadegastos > 0) { ?>
<div id="verHojaGastos" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Hoja de Gastos</h3>
  </div>
  <div class="modal-body">
 	
 	<table class="table" width="100%">
			<tr>
				<th><small>Codigo</small></th>
				<th><small>Producto</small></th>
				<th><small>Lote</small></th>
				<th><small>Presentación</small></th>
				<th><small>Unidad de Medida</small></th>
				<th><small>Cant.</small></th>
			</tr>
			<?php 
			$losGastos = HojaGastosDetalle::model()->findAll("hoja_gastos_id = $idHojaGastos->id");
			foreach ($losGastos as $los_gastos) 
			{
				?>
				<tr>
					<td><?php echo $los_gastos->producto->producto_referencia; ?></td>
					<td><?php echo $los_gastos->producto->nombre_producto; ?></td>
					<td><?php echo $los_gastos->producto->lote; ?></td>
					<td><?php echo $los_gastos->producto->productoPresentacion->presentacion; ?></td>
					<td><?php echo $los_gastos->producto->productoUnidadMedida->corto; ?></td>
					<td><?php echo $los_gastos->cantidad; ?></td>
				</tr>
				<?php
			}
			?>
		</table>
 	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Fotografias -->
<?php if ($fotografias > 0) { ?>
<div id="verFotografias" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Fotografias</h3>
  </div>
  <div class="modal-body">
 	
 	<table class="table" width="100%">
			<tr>
				<th><small>Archivos</small></th>
			</tr>
			<?php 
			$lasFotos = PacienteFotografiasDetalle::model()->findAll("paciente_fotografias_id = $idFotografias->id");
			foreach ($lasFotos as $las_fotos) 
			{
				?>
				<tr>
					<td>
						<center>
							<img src=<?php echo yii::app()->baseUrl."/adjuntos/".$las_fotos->archivo ; ?>  height="300px" width="300px">
						</center>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
 	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>

<!-- Resultados de Laboratorio -->
<?php if ($archivoExamenes > 0) { ?>
<div id="verResultados" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Resultados de Laboratorio</h3>
  </div>
  <div class="modal-body">
 	
 	<table class="table" width="100%">
			<tr>
				<th><small>Archivos</small></th>
			</tr>
			<?php 
			$losArchivos = PacienteResultadosLabDetalle::model()->findAll("paciente_resultados_lab_id = $idResultados->id");
			foreach ($losArchivos as $los_archivos) 
			{
				?>
				<tr>
					<td>
						<center>
							<a target="blank" href="<?php echo yii::app()->baseUrl.'/adjuntos/'.$los_archivos->archivo ; ?>"><?php echo $los_archivos->archivo; ?></a>
						</center>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
 	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Hoja de Gastos de Cirugía -->
<?php if ($hojaCirugia > 0) { ?>
<div id="verHojaCirugia" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Hoja de Gastos de Cirugía</h3>
  </div>
  <div class="modal-body">
	
	<div>
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$idHojaCirugia,
			'attributes'=>array(
				array('name'=>'Paciente', 'value'=>$idHojaCirugia->paciente->nombreCompleto, ''),
				array('name'=>'Fecha de Cirugía', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$idHojaCirugia->fecha_cirugia), ''),
				'sala',
				'peso',
				'tipo_paciente',
				'tipo_anestesia',
				'tipo_cirugia',
				'cirugia',
				'cirugia_codigo',
			),
		)); ?>
	</div>
	<div>
		<?php 
			if ($idHojaCirugia->cirujano_id) 
			{
				$nombreCirujano = $idHojaCirugia->cirujano->nombreCompleto;
			}
			else
			{
				$nombreCirujano = null;
			}

			if ($idHojaCirugia->ayudante_id) 
			{
				$nombreAyudante = $idHojaCirugia->ayudante->nombreCompleto;
			}
			else
			{
				$nombreAyudante = null;
			}

			if ($idHojaCirugia->anestesiologo_id) 
			{
				$nombreAnestesia = $idHojaCirugia->anestesiologo->nombreCompleto;
			}
			else
			{
				$nombreAnestesia = null;
			}

			if ($idHojaCirugia->rotadora_id) {
				$nombreRotadora = $idHojaCirugia->rotadora->nombreCompleto;
			}
			else
			{
				$nombreRotadora = null;
			}

			if ($idHojaCirugia->instrumentadora_id) 
			{
				$nombreInstrumento = $idHojaCirugia->instrumentadora->nombreCompleto;
			}
			else
			{
				$nombreInstrumento = null;
			}

		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$idHojaCirugia,
			'attributes'=>array(
				'hora_ingreso',
				'hora_inicio_cirugia',
				'hora_final_cirugia',
				array('name'=>'Cirujano', 'value'=>$nombreCirujano, ''),
				array('name'=>'Ayudante', 'value'=>$nombreAyudante, ''),
				array('name'=>'Anestesiologo', 'value'=>$nombreAnestesia, ''),
				array('name'=>'Rotadora', 'value'=>$nombreRotadora, ''),
				array('name'=>'Instrumentadora', 'value'=>$nombreInstrumento, ''),
				//'cantidad_productos',
				array('name'=>'Fecha de Ingreso', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$idHojaCirugia->fecha), ''),
				array('name'=>'Ingresado por', 'value'=>$idHojaCirugia->personal->nombreCompleto, ''),
			),
		)); ?>
	</div>
 	<h4>Productos Utilizados</h4>
 	<table class="table" width="100%">
		<tr>
			<th><small>Codigo</small></th>
			<th><small>Producto</small></th>
			<th><small>Unidad de Medida</small></th>				
			<th><small>Cant.</small></th>
		</tr>
		<?php 
		$losGastos = HojaGastosCirugiaDetalle::model()->findAll("hoja_gastos_cirugia_id = $idHojaCirugia->id");
		foreach ($losGastos as $los_gastos) 
		{
			?>
			<tr>
				<td><?php echo $los_gastos->producto->producto_referencia; ?></td>
				<td><?php echo $los_gastos->producto->nombre_producto; ?></td>
				<td><?php echo $los_gastos->producto->productoUnidadMedida->medida; ?></td>
				<td><?php echo $los_gastos->cantidad; ?></td>
			</tr>
			<?php
		}
		?>
	</table>

  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Revisión de Sistemas -->
<?php if ($sistemas > 0) { ?>
<div id="verSistemas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Revisión por Sistemas</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$losSistemas = HistorialRevisionSistema::model()->find("cita_id = $model->id"); 
 		
 		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$losSistemas,
			'attributes'=>array(
				'c_c_c',
				'cardio_respiratorio',
				'sistema_digestivo',
				'sistema_genitoUrinario',
				'sistema_locomotor',
				'sistema_nervioso',
				'sistema_tegumentario',
				'observaciones',
			),
		)); 
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Descripción Quirurgica -->
<?php if ($descripcionQuirurgica > 0) { ?>
<div id="verDescripcion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Descripción Quirúrgica</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$lasDescripciones = HistorialDescripcionQuirurgica::model()->find("cita_id = $model->id"); 

 		if ($lasDescripciones->ayudante_id == NULL) {
			$nombreAyudante = "";
		}
		else
		{
			$nombreAyudante = $lasDescripciones->ayudante->nombreCompleto;
		}

		if ($lasDescripciones->anestesiologo_id == NULL) {
			$nombreAnesteciologo = "";
		}
		else
		{
			$nombreAnesteciologo = $lasDescripciones->anestesiologo->nombreCompleto;
		}
 		
 		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$lasDescripciones,
			'attributes'=>array(
				'paciente.nombreCompleto',
				'servicio',
				'diagnostico_preoperatorio',
				'diagnostico_posoperatorio',
				array('name'=>'Cirujano', 'value'=>$lasDescripciones->cirujano->nombreCompleto,''),
				array('name'=>'Ayudante', 'value'=>$nombreAyudante,''),
				array('name'=>'Anestesiologo', 'value'=>$nombreAnesteciologo,''),
				array('name'=>'Instrumentista', 'value'=>$lasDescripciones->instQuirurgico->nombreCompleto,''),
				array('name'=>'fecha_cirugia', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$lasDescripciones->fecha_cirugia)),
				'hora_inicio',
				'hora_final',
				'codigo_cups',
				'intervencion',
				'control_compresas',
				'tipo_anestesia',
				'descripcion_hallazgos',
				array('name'=>'LLeno la Hoja:', 'value'=>$lasDescripciones->personal->nombreCompleto,''),
				'observaciones',
				array('name'=>'Fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$lasDescripciones->fecha)),
			),
		));																		 
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>





<!-- RESUMENES -->

<!-- Anamnesis -->
<?php if ($Ganamnesis > 0) { ?>
<div id="Ganamnesis" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Anamnesis</h3>
  </div>
  <div class="modal-body">
 	<?php 
 		$Glasanamnesis = HistorialAnamnesis::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Glasanamnesis as $Glas_anamnesis) 
 		{
 			$fecha=date('d-m-Y',strtotime($Glas_anamnesis->fecha));
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glas_anamnesis,
			'attributes'=>array(
				array('name'=>'Fecha', 'value'=>$fecha),
				'motivo_consulta',
				'enfermedad_actual',
				'antecedente_patologico',
				'antecedente_quirurgico',
				'antecedente_alergico',
				'antecedente_traumatico',
				'antecedente_medicamento',
				'antecedente_ginecologico',
				'antecedente_fum',
				'antecedente_habitos',
				'antecedente_familiares',
				'antecedente_nutricionales',
				'observaciones_paciente',
			),
		)); 
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Historial de Examen Fisico -->
<?php if ($Gexamen > 0) { ?>
<div id="Gexamen" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Examenes Fisicos</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glosexamenes = HistorialExamenFisico::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Glosexamenes as $Glos_examenes) 
 		{
 			$fecha=date('d-m-Y',strtotime($Glos_examenes->fecha));
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glos_examenes,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>$fecha,''),
				'diagnosticoPrincipal.diagnostico',
				'diagnosticoRelacionado.diagnostico',
				'peso',
				'altura',
				'imc',
				'cabeza_cuello',
				'cardiopulmonar',
				'abdomen',
				'extremidades',
				'sistema_nervioso',
				'piel_fanera',
				'otros',
				'observaciones',
			),
		)); 
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Historial de Formulaciones -->
<?php if ($Gformulacion > 0) { ?>
<div id="Gformulacion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Formulaciones</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glaformulacion = HistorialFormulacion::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Glaformulacion as $Gla_formulacion) 
 		{
 			echo "<b>Fecha: </b><span class='label label-info'>".Yii::app()->dateformatter->format("yyyy-MM-dd",$Gla_formulacion->fecha)."</span>";

 		?>
 		<table class="table table-striped">
			<tr>
				<th>Formula</th>
				<th>Formulación</th>
			</tr>
		
		<?php 
			$GlasFormulas = HistorialFormulacionDetalle::model()->findAll("historial_formulacion_id = $Gla_formulacion->id");
			foreach ($GlasFormulas as $Glas_formulas) 
			{
				?>
				<tr>
					<?php if($Glas_formulas->formulacion_id != "")
					{
						?>
					<td><?php echo $Glas_formulas->laformulacion->nombre; ?></td>
						<?php
					}
					else
					{
						?>
					<td><?php echo $Glas_formulas->otra_formulacion; ?></td>
						<?php	
					}
					?>
					
					<td><?php echo $Glas_formulas->formulacion; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
		<?php
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>



<!-- Historial de Evolución Medica -->
<?php if ($Gevaluacion > 0) { ?>
<div id="Gevaluacion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Evolución Médica</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glasevaluaciones = HistorialEvaluacionMedica::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Glasevaluaciones as $Glas_evaluaciones) 
 		{
 			$fecha=date('d-m-Y',strtotime($Glas_evaluaciones->fecha));
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glas_evaluaciones,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>$fecha,''),
				'personal.nombreCompleto',
				//array('name'=>'diagnostico_principal_id', 'value'=>$Glas_evaluaciones->diagnosticoPrincipal->diagnostico,''),
				//array('name'=>'diagnostico_relacional_id', 'value'=>$Glas_evaluaciones->diagnosticoRelacional->diagnostico,''),
				'evolucion',
			),
		)); 
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Historial de Evolución Enfermería -->
<?php if ($GevolucionEnfermeria > 0) { ?>
<div id="GevolucionEnfermeria" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Evolución de Enfermería</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$GlasevaluacionesEnfermeria = HistorialEvaluacionEnfermeria::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($GlasevaluacionesEnfermeria as $Glas_evaluaciones_enfermeria) 
 		{
 			$fecha=date('d-m-Y',strtotime($Glas_evaluaciones_enfermeria->fecha));
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glas_evaluaciones_enfermeria,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>$fecha,''),
				'personal.nombreCompleto',
				//array('name'=>'diagnostico_principal_id', 'value'=>$Glas_evaluaciones->diagnosticoPrincipal->diagnostico,''),
				//array('name'=>'diagnostico_relacional_id', 'value'=>$Glas_evaluaciones->diagnosticoRelacional->diagnostico,''),
				'evaluacion',
			),
		)); 
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>



<!-- Historial de Evolución Cosmetológica -->
<?php if ($Gcosmetologica > 0) { ?>
<div id="Gcosmetologica" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Evolución Cosmetológica</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glascosmetologicas = HistorialEvaluacionCosmetologica::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Glascosmetologicas as $Glas_cosmetologicas) 
 		{
 			$fecha=date('d-m-Y',strtotime($Glas_cosmetologicas->fecha));
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glas_cosmetologicas,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>$fecha,''),
				'evaluacion',
			),
		)); 
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Historial de Examenes de laboratorio -->
<?php if ($Glaboratorio > 0) { ?>
<div id="Glaboratorio" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Examenes de Laboratorio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Gloslaboratorios = HistorialLaboratorio::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Gloslaboratorios as $Glos_examenes) 
 		{
 			?>
 			<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glos_examenes,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Glos_examenes->fecha),''),
			),
		)); ?>
 			<table class="table table-striped">
			<tr>
				<th>Laboratorio</th>
				<th>Descripción</th>
			</tr>
		<?php $losExamenes = HistorialLaboratorioDetalle::model()->findAll("historial_laboratorio_id = $Glos_examenes->id") ?>
		<?php 
			foreach ($losExamenes as $los_examenes) 
			{
				if ($los_examenes->laboratorio_id == null) {
					$nombreExamen = "";
				}
				else
				{
					$nombreExamen = $los_examenes->laboratorio->nombre;
				}
				?>
				<tr>
					<td><?php echo $nombreExamen; ?></td>
					<td><?php echo $los_examenes->examen; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
		<?php
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Historial de Revisión por Sistemas -->
<?php if ($Gsistemas > 0) { ?>
<div id="Gsistemas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Revisión por Sistemas</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glossistemas = HistorialRevisionSistema::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Glossistemas as $Glos_sistemas) 
 		{
 		$this->widget('zii.widgets.CDetailView', array(
	'data'=>$Glos_sistemas,
	'attributes'=>array(
		//array('name'=>'Paciente', 'value'=>$model->paciente->nombreCompleto),
		//array('name'=>'Médico', 'value'=>$model->personal->nombreCompleto),
		'c_c_c',
		'cardio_respiratorio',
		'sistema_digestivo',
		'sistema_genitoUrinario',
		'sistema_locomotor',
		'sistema_nervioso',
		'sistema_tegumentario',
		'observaciones',
		array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Glos_sistemas->fecha),''),
	),
));
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>



<!-- Historial de Tabla de Medidas -->
<?php if ($Gtabla > 0) { ?>
<div id="Gtabla" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Tabla de Medidas</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$GlasTablas = HistorialTablaMedidas::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($GlasTablas as $Glas_tablas) 
 		{
 		//$latabla = HistorialTablaMedidas::model()->find("cita_id = $model->id"); 
 		
 		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glas_tablas,
			'attributes'=>array(
				'imc',
				'peso',
				'busto',
				'contorno',
				'cintura',
				'umbilical',
				'abd_inferior',
				'abd_superior',
				'cadera',
				'piernas',
				'muslo_derecho',
				'muslo_izquierdo',
				'brazo_derecho',
				'brazo_izquierdo',
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Glas_tablas->fecha),''),
			),
		)); 
 
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>



<!-- Historial de Plan de Tratamiento -->
<?php if ($Gplan > 0) { ?>
<div id="Gplan" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Plan de Tratamiento</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Gplantratamiento = HistorialPlanTratamiento::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Gplantratamiento as $Gplan_tratamiento) 
 		{
 		//$latabla = HistorialTablaMedidas::model()->find("cita_id = $model->id"); 
 		?> 
 		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$Gplan_tratamiento,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Gplan_tratamiento->fecha),''),
				'observaciones',
			),
		)); ?>
 		<table class="table table-striped">
			<tr>
				<th>Linea</th>
				<th>Observaciones</th>
			</tr>
		
		<?php 
			$Gplanlineas = HistorialPlanTratamientoDetalle::model()->findAll("historial_plan_tratamiento_id = $Gplan_tratamiento->id");
			foreach ($Gplanlineas as $Gplan_lineas) 
			{
				?>
				<tr>
					
					<td><?php echo $Gplan_lineas->lineaServicio->nombre; ?></td>				
					<td><?php echo $Gplan_lineas->observacion; ?></td>
				</tr>
				<?php
			}
		?>
		</table>

 		<?php
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Historial de Diagnostico Clínico -->
<?php if ($Gdiagnostico > 0) { ?>
<div id="Gdiagnostico" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Diagnostico Clínico</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Geldiagnostico = HistorialDiagnostico::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Geldiagnostico as $Gel_diagnostico) 
 		{
 		
 		?>
 		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$Gel_diagnostico,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Gel_diagnostico->fecha),''),
				'observaciones',
			),
		)); ?>
 		<table class="table table-striped">
			<tr>
				<th>Diagnotico</th>
				<th>Tipo</th>
				<th>Observaciones</th>
			</tr>
		
		<?php 
			$GlosDiagnosticos = HistorialDiagnosticoDetalle::model()->findAll("historial_diagnostico_id = $Gel_diagnostico->id"); 
			foreach ($GlosDiagnosticos as $Glos_diagnosticos) 
			{
				?>
				<tr>
					<td><?php echo $Glos_diagnosticos->diagnostico->diagnostico; ?></td>
					<td><?php echo $Glos_diagnosticos->diagnostico->tipo; ?></td>
					<td><?php echo $Glos_diagnosticos->observaciones; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
 
 		<?php
		echo "<hr>";
		}
 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>

<!-- Historial de Plan de Medicina Biologica -->
<?php if ($GplanMedicina > 0) { ?>
<div id="GplanMedicina" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Plan de Medicina Biológica</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$GplanMedicinabio = HistorialMedicinaBiologica::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($GplanMedicinabio as $Gplan_medicina) 
 		{
 			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$Gplan_medicina,
				'attributes'=>array(
					array('name'=>'Fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Gplan_medicina->fecha),''),
				),
			));
 		?> 
			<table class="table table-striped">
			<tr>
				<th>Ciclo</th>
				<th>Sesión</th>
				<th>Medicamento</th>
			</tr>
			<?php $losMedicamentos = HistorialMedicinaBiologicaDetalle::model()->findAll("historial_medicina_biologica_id = $Gplan_medicina->id") ?>
			<?php 
				foreach ($losMedicamentos as $los_medicamentos) 
				{
					?>
					<tr>
						<td><b>Ciclo <?php echo $los_medicamentos->ciclo; ?></b></td>
						<td>Sesión <?php echo $los_medicamentos->sesion; ?></td>
						<td><?php echo $los_medicamentos->medicamentosBiologicos->medicamento; ?></td>
					</tr>
					<?php
				}
			?>
			</table>
 		<?php
 		echo "<hr>";
		}

 	?>
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>

<!-- Historial de Fotografías -->
<?php if ($Gfotos > 0) { ?>
<div id="Gfotos" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Fotografías</h3>
  </div>
  <div class="modal-body">
 	<?php 
 	$Gfotografias = PacienteFotografias::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($Gfotografias as $Glas_fotografias) 
 		{
 			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glas_fotografias,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Glas_fotografias->fecha),''),
				'comentario',
			),
		));
 	?>
 	<table class="table" width="100%">
		<tr>
			<th><small>Archivos</small></th>
		</tr>
		<?php 
		$lasFotos = PacienteFotografiasDetalle::model()->findAll("paciente_fotografias_id = $Glas_fotografias->id");
		foreach ($lasFotos as $las_fotos) 
		{
			?>
			<tr>
				<td>
					<center>
						<img src=<?php echo yii::app()->baseUrl."/adjuntos/".$las_fotos->archivo ; ?>  height="300px" width="300px">
					</center>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
 	<?php
 		echo "<hr>";
		}

 	?>
  </div>
  	
  <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Modal Cita Preguntar con quien -->
<div id="cita" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Profesional que Atenderá</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Seleccione el Profesional</p>
 	<center>
 		<?php
 		$elPersonal = Perfil::model()->findAll("Estado = 'Activo' and agenda = 'Si'");
 			foreach ($elPersonal as $el_personal) 
 			{
 			echo CHtml::submitButton($el_personal->nombre, array('submit'=>array('citas/calendario&idpaciente='.$model->paciente_id.'&idpersonal='.$el_personal->id), 'class'=>'btn btn-success'));

			}	 		
	 	?>

	</center>
  </div>  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Historial de Resultados de Laboratorio -->
<?php if ($Gresultados > 0) { ?>
<div id="Gresultados" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Resultados de Laboratorio</h3>
  </div>
  <div class="modal-body">
 	<?php 
 	$GlosResultados = PacienteResultadosLab::model()->findAll("paciente_id = $model->paciente_id"); 
 		foreach ($GlosResultados as $Glos_resultados) 
 		{
 			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glos_resultados,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$Glos_resultados->fecha),''),
				'comentario',
			),
		));
 	?>
 	
 	<table class="table" width="100%">
		<tr>
			<th><small>Archivos</small></th>
		</tr>
		<?php 
		$losArchivos = PacienteResultadosLabDetalle::model()->findAll("paciente_resultados_lab_id = $Glos_resultados->id");
		foreach ($losArchivos as $los_archivos) 
		{
			?>
			<tr>
				<td>
					<center>
						<a target="blank" href="<?php echo yii::app()->baseUrl.'/adjuntos/'.$los_archivos->archivo ; ?>"><?php echo $los_archivos->archivo; ?></a>
					</center>
				</td>
			</tr>
			<?php
		}
		?>
	</table>

 	<?php
 		echo "<hr>";
		}

 	?>
  </div>
  	
  <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<?php } ?>


<!-- Confirmar Cita -->
<?php //if ($losmedicos): ?>
<div id="confirmar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelaa" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Confirmar Cita</h3>
  </div>
  <div class="modal-body">
 	<p>Complete el siguiente formulario</p>
 	
	 	<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'confirmar-form',
		'action'=>Yii::app()->baseUrl.'/index.php?r=citas/confirmar&irCita=1&idpersonal='.$model->personal_id,
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
		)); ?>
	 	<?php 
	 		$tabla_confirma = new Citas;	 		
	 	?>
				<div class = 'span10'>
					<?php echo $form->labelEx($tabla_confirma,'confirmacion'); ?>
					<?php echo $form->textArea($tabla_confirma,'confirmacion',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($tabla_confirma,'confirmacion'); ?>
				</div>

				<div class="span10" style="display:none;">
					<?php echo $form->textField($tabla_confirma, 'contrato_id', array('value'=>$model->id)); ?>
					<?php echo $form->textField($tabla_confirma,'estado'); ?>
				</div>
	
				<div class = 'span6' >
					<?php echo CHtml::submitButton($tabla_confirma->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
				</div>

		<?php $this->endWidget(); ?>
  </div>
  
   <div class="modal-footer">
	<?php 
   		 	echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>
<?php //endif ?>


<!-- Cancelar Cita -->
<?php //if ($losmedicos): ?>
<div id="cancelar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Cita Cancelada</h3>
  </div>
  <div class="modal-body">
 	<p>Complete el siguiente formulario</p>
 	
	 	<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'cancelar-form',
		'action'=>Yii::app()->baseUrl.'/index.php?r=citas/cancelar&irCita=1&idpersonal='.$model->personal_id,
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
		)); ?>
	 	<?php 
	 		
	 		$tabla_citas = new Citas;
	 				
	 		
	 	?>
				<div class = 'span10'>
					<?php echo $form->labelEx($tabla_citas,'motivo_cancelacion'); ?>
					<?php echo $form->textArea($tabla_citas,'motivo_cancelacion',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($tabla_citas,'motivo_cancelacion'); ?>
				</div>

				<div class="span10" style="display:none;">
					<?php echo $form->textField($tabla_citas,'id', array('value'=>$model->id)); ?>
					<?php echo $form->textField($tabla_citas,'estado', array('value'=>$model->estado)); ?>
				</div>
	
				<div class = 'span6' >
					<?php echo CHtml::submitButton($tabla_citas->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
				</div>

		<?php $this->endWidget(); ?>
  </div>
  
   <div class="modal-footer">
	<?php 
   		 	echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>
<?php //endif ?>


<?php //Completar Cita ?>
<div id="completar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><div id="eltitulo"></div></h3>
  </div>
  <div class="modal-body">
 	<p>Complete el siguiente formulario</p>
 	
	 	<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'seguimiento-comercial-form',
		'action'=>Yii::app()->baseUrl.'/index.php?r=citas/calendario&irCita=1',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		//'onsubmit'=>"return onEnviar()",
		'htmlOptions' => array('onsubmit'=>"return onEnviar()"),
		'enableAjaxValidation'=>false,
		)); ?>
	 	<?php 
	 		echo isset($_GET['i']);
	 		$lasfecha = date("dd-mm-yy");
	 		$tabla_seguimiento = new SeguimientoComercial;
	 		echo $form->errorSummary($tabla_seguimiento); 
	 	?>
				<div class = 'span5'>
					<?php echo $form->labelEx($tabla_seguimiento,'fecha_accion'); ?>
					<div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
					<?php 			
								//$lafecha = '';
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'name'=>'fecha_accion',
							'language'=>'es',
							'model' => $tabla_seguimiento,
							'attribute' => 'fecha_accion',
							'value'=> $lasfecha,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'language' => 'es',
								'dateFormat' => 'dd-mm-yy',
							),
							'htmlOptions'=>array(
								'style'=>'height:20px;width:80px;z-index:1151 !important;'
							),
						));
					?>
					</div>
					<?php echo $form->error($tabla_seguimiento,'fecha_accion'); ?>
				</div>

				<div class="span5" id="omitir">
					<label for="">Omitir Seguimiento Comercial</label>
					<select class="input-mini" id="aplica" name ="aplica">
					  <option value="No">No</option>
					  <option value="Si">Si</option>
					</select>
				</div>

				<div class='span7'>
					<?php echo $form->labelEx($tabla_seguimiento,'tema_id'); ?>
					<?php echo $form->dropDownList($tabla_seguimiento, 'tema_id',CHtml::listData(SeguimientoTema::model()->findAll("estado = 'Activo' order by 'nombre'"),'id','nombre'), array('class'=>'input-xlarge'));?>
					<?php echo $form->error($tabla_seguimiento,'tema_id'); ?>
				</div>

				<div class='span7'>
					<?php echo $form->labelEx($tabla_seguimiento,'responsable_id'); ?>
					<?php echo $form->dropDownList($tabla_seguimiento, 'responsable_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'"),'id','nombreCompleto'), array('class'=>'input-xxlarge',  'options' => array(Yii::app()->user->usuarioId=>array('selected'=>true)),));?>
					<?php echo $form->error($tabla_seguimiento,'responsable_id'); ?>
				</div>	
								
				<div class = 'span10'>
					<?php echo $form->labelEx($tabla_seguimiento,'observaciones'); ?>
					<?php echo $form->textArea($tabla_seguimiento,'observaciones',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($tabla_seguimiento,'observaciones'); ?>
				</div>

				<div class="span10" style="display:none;">
					<?php echo $form->textField($tabla_seguimiento,'cita_id'); ?>
					<?php echo $form->textField($tabla_seguimiento,'tipo'); ?>
				</div>
	
				<div class = 'span6' >
					<?php echo CHtml::submitButton($tabla_seguimiento->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
				</div>

		<?php $this->endWidget(); ?>
  </div>
  
   <div class="modal-footer">
	<?php 
   		 echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<?php //Completar Cita ?>
<div id="aqui" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Paciente esta en la clínica</h3>
  </div>
  <div class="modal-body">
 	<p>¿El paciente ya se hizo presente a la cita?</p>
 	
	 	<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'seguimiento-comercial-form',
		'action'=>Yii::app()->baseUrl.'/index.php?r=citas/estaAqui&id='.$model->id,
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		//'onsubmit'=>"return onEnviar()",
		'htmlOptions' => array('onsubmit'=>"return onEnviar()"),
		'enableAjaxValidation'=>false,
		)); ?>
				<div class = 'span6' >
					<?php echo CHtml::submitButton($tabla_seguimiento->isNewRecord ? 'Confirmar' : 'Confirmar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
				</div>

		<?php $this->endWidget(); ?>
  </div>
  
   <div class="modal-footer">
	<?php 
   		 echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>



<script>
	$("#valoracion").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	});
</script>


