<?php
/* @var $this HistorialDescripcionQuirurgicaController */
/* @var $model HistorialDescripcionQuirurgica */


if ($model->cita_id == NULL) {
	$textoMenu = "Ver Ficha de Paciente";
	$laRuta = "index.php?r=paciente/view&id=$model->paciente_id";
	$urlComplemento = "&idPaciente=$model->paciente_id";
}else{
	$textoMenu = "Regresar a Cita";
	$laRuta = "index.php?r=citas/view&id=$model->cita_id&idPaciente=$model->paciente_id";
	$urlComplemento = "&idCita=$model->cita_id&idPaciente=$model->paciente_id";
}

$this->menu=array(
/*	array('label'=>'Listar Descripción Quirurgica', 'url'=>array('index')),
	array('label'=>'Crear Descripción Quirurgica', 'url'=>array('create')),
	array('label'=>'Actualizar Descripción Quirurgica', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Descripción Quirurgica', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Descripción Quirurgica', 'url'=>array('admin')),*/
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

<h1>Descripción Quirurgica #<?php echo $model->id; ?></h1>

<?php 

if ($model->ayudante_id == NULL) {
	$nombreAyudante = "";
}
else
{
	$nombreAyudante = $model->ayudante->nombreCompleto;
}

if ($model->anestesiologo_id == NULL) {
	$nombreAnesteciologo = "";
}
else
{
	$nombreAnesteciologo = $model->anestesiologo->nombreCompleto;
}

	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'paciente.nombreCompleto',
		'servicio',
		'diagnostico_preoperatorio',
		'diagnostico_posoperatorio',
		array('name'=>'Cirujano', 'value'=>$model->cirujano->nombreCompleto,''),
		array('name'=>'Ayudante', 'value'=>$nombreAyudante,''),
		array('name'=>'Anestesiologo', 'value'=>$nombreAnesteciologo,''),
		array('name'=>'Instrumentista', 'value'=>$model->instQuirurgico->nombreCompleto,''),
		array('name'=>'fecha_cirugia', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha_cirugia)),
		'hora_inicio',
		'hora_final',
		'codigo_cups',
		'intervencion',
		'control_compresas',
		'tipo_anestesia',
		'descripcion_hallazgos',
		array('name'=>'LLeno la Hoja:', 'value'=>$model->personal->nombreCompleto,''),
		'observaciones',
		array('name'=>'Fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$model->fecha)),
	),
)); ?>
