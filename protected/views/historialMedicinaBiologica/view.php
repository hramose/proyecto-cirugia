<?php
/* @var $this HistorialMedicinaBiologicaController */
/* @var $model HistorialMedicinaBiologica */

if ($model->cita_id == NULL or $model->cita_id == 0) {
	$textoMenu = "Ver Ficha de Paciente";
	$laRuta = "index.php?r=paciente/view&id=$model->paciente_id";
	$urlComplemento = "&idPaciente=$model->paciente_id";
}else{
	$textoMenu = "Regresar a Cita";
	$laRuta = "index.php?r=citas/view&id=$model->cita_id&idPaciente=$model->paciente_id";
	$urlComplemento = "&idCita=$model->cita_id&idPaciente=$model->paciente_id";
}

$this->menu=array(
	// array('label'=>'Listar Planes de Medicina Biologica', 'url'=>array('index')),
	// array('label'=>'Crear Plan de Medicina Biologica', 'url'=>array('create')),
	//array('label'=>'Actualizar Plan de Medicina Biologica', 'url'=>array('update', 'id'=>$model->id)),
	// array('label'=>'Borrar Plan de Medicina Biologica', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	// array('label'=>'Buscar Plan de Medicina Biologica', 'url'=>array('admin')),
	array('label'=>"<i class='icon-circle-arrow-left'></i> ".$textoMenu, 'url'=>$laRuta),
	/*Botones de Historia Clinica*/
	array('label'=>"<i class='icon-plus-sign'> </i> Anamnesis", 'url'=>'index.php?r=HistorialAnamnesis/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Revisión de Sistemas", 'url'=>'index.php?r=HistorialRevisionSistema/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Examen Físico", 'url'=>'index.php?r=HistorialExamenFisico/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Tabla de Medidas", 'url'=>'index.php?r=HistorialTablaMedidas/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Diagnostico", 'url'=>'index.php?r=HistorialDiagnostico/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Plan de Tratamiento", 'url'=>'index.php?r=HistorialPlanTratamiento/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Plan de Medicina Biológica", 'url'=>'index.php?r=HistorialMedicinaBiologica/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Orden de Exa. de Lab.", 'url'=>'index.php?r=HistorialLaboratorio/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Evolución Médica", 'url'=>'index.php?r=HistorialEvaluacionMedica/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Evolución Cosmetológica", 'url'=>'index.php?r=HistorialEvaluacionCosmetologica/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Evolución Enfermería", 'url'=>'index.php?r=HistorialEvaluacionEnfermeria/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Formulación", 'url'=>'index.php?r=HistorialFormulacion/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Hoja de Gastos", 'url'=>'index.php?r=HojaGastos/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Hoja de Gastos de Cirugía", 'url'=>'index.php?r=HojaGastosCirugia/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Notas de Enfermería", 'url'=>'index.php?r=HistorialNotasEnfermeria/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Descripción Quirurgica", 'url'=>'index.php?r=HistorialDescripcionQuirurgica/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Fotografías", 'url'=>'index.php?r=PacienteFotografias/create'.$urlComplemento),
	array('label'=>"<i class='icon-plus-sign'> </i> Resultados de Laboratorio", 'url'=>'index.php?r=PacienteResultadosLab/create'.$urlComplemento),
);

//conteo de ciclos
$losCiclos = HistorialMedicinaBiologica::model()->count("paciente_id = $model->paciente_id");

if (isset($_GET['idCiclo'])) 
{
	$nCiclo = $_GET['idCiclo'];
}
else
{
	if ($losCiclos == 0) {
		$nCiclo = 1;
	}
	else
	{
		if ($losCiclos == 1) {
			$nCiclo = 1;
		}

		if ($losCiclos > 1) {
			$nCiclo = $losCiclos;
		}
	}
}



?>

<h1>Plan de Medicina Biologica #<?php echo $model->id; ?></h1>


<div class="row">
	<div class="span1"></div>
	<div class="span5">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			array('name'=>'Paciente', 'value'=>$model->paciente->nombreCompleto,''),
			'personal.nombreCompleto',
		),
	)); ?>
	</div>
	<div class="span5">
		<a href="index.php?r=historialMedicinaBiologica/update&id=<?php echo $model->id; ?>&idPaciente=<?php echo $model->paciente_id; ?>&idCita=<?php echo $model->cita_id; ?>&idCiclo=<?php echo $nCiclo; ?>" role="button" class="btn btn-small btn-primary" data-toggle="modal">Agregar Sesión</a>
	</div>
	<div class="span1"></div>
</div>

<h3 class="text-center">Medicamentos Biológicos</h3>
<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<table class="table table-striped">
			<tr>
				<th>Ciclo</th>
				<th>Sesión</th>
				<th>Medicamento</th>
			</tr>
		<?php $losMedicamentos = HistorialMedicinaBiologicaDetalle::model()->findAll("historial_medicina_biologica_id = $model->id") ?>
		<?php 
			foreach ($losMedicamentos as $los_medicamentos) 
			{
				?>
				<tr>
					<td>Ciclo <?php echo $nCiclo; ?></td>
					<td>Sesión <?php echo $los_medicamentos->ciclo; ?></td>
					<td><?php echo $los_medicamentos->medicamentosBiologicos->medicamento; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
	</div>
	<div class="span2"></div>
	
</div>

<div class="row">
	<div class="span1"></div>
</div>

