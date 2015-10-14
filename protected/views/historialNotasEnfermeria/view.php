<?php
/* @var $this HistorialNotasEnfermeriaController */
/* @var $model HistorialNotasEnfermeria */

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
	/*array('label'=>'Listar Notas de Enfermería', 'url'=>array('index')),
	array('label'=>'Crear Notas de Enfermería', 'url'=>array('create')),
	array('label'=>'Actualizar Notas de Enfermería', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Notas de Enfermería', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Notas de Enfermería', 'url'=>array('admin')),*/
	array('label'=>'Actualizar', 'url'=>array('update', 'id'=>$model->id, 'idPaciente'=>$model->paciente_id)),
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

<h1>Notas de Enfermería #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Paciente', 'value'=>$model->paciente->nombreCompleto,''),
				array('name'=>'Lleno la hoja', 'value'=>$model->personal->nombreCompleto,''),
				array('name'=>'Fecha de Llenado', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$model->fecha),''),
				'hora',
				array('name'=>'Fecha de Nota', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha_nota),''),
				'observaciones',
			),
		)); ?>
	</div>
	<div class="span5 text-center">
		<?php 
						$this->widget('ext.popup.JPopupWindow', array( 
						'tagName'=>'button',
						'content'=> ' Imprimir ', 
						'url'=>array('HistorialNotasEnfermeria/notas', 'id'=>$model->cita_id),
						/*'url'=>array('/site/contact'), */
						'htmlOptions'=>array('class'=>'btn btn-large btn-primary'),
						'options'=>array( 
						'height'=>700, 
						'width'=>800, 
						'top'=>50, 
						'left'=>50, 
						), 
						)); 
					?>
	</div>
	<div class="span1"></div>
</div>
<h4>Nota de Enfermería</h4><br>
<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<?php echo $model->nota; ?>
	</div>
	<div class="span2"></div>
</div>
	
</div>