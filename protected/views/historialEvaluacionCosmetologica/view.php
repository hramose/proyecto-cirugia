<?php
/* @var $this HistorialEvaluacionCosmetologicaController */
/* @var $model HistorialEvaluacionCosmetologica */

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
	//array('label'=>'Listar Evaluaciones Cosmetologicas', 'url'=>array('index')),
	//array('label'=>'Crear Evaluación Cosmetológica', 'url'=>array('create')),
	//array('label'=>'Actualizar Evaluación Cosmetológica', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete HistorialEvaluacionCosmetologica', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Buscar Evaluación Cosmetológica', 'url'=>array('admin')),
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
?>

<h1>Evolución Cosmetológica #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span1"></div>
	<div class="span7">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'paciente_id', 'value'=>$model->paciente->nombreCompleto,''),
				'evaluacion',
				array('name'=>'fecha', 'value'=>date('d-m-Y',strtotime($model->fecha))),
			),
		)); ?>
	</div>
	<div class="span3">
		
	</div>
	<div class="span1"></div>
</div>
	
</div>

