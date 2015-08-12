<?php
/* @var $this HojaGastosController */
/* @var $model HojaGastos */

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
/*	array('label'=>'Listar Hoja de Gastos', 'url'=>array('index')),
	array('label'=>'Crear Hoja de Gastos', 'url'=>array('create')),
	array('label'=>'Actualizar Hoja de Gastos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Hoja de Gastos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Hoja de Gastos', 'url'=>array('admin')),*/
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

<h1>Hoja de Gastos #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'paciente_id', 'value'=>$model->paciente->nombreCompleto,''),
				array('name'=>'Cedula', 'value'=>$model->paciente->n_identificacion,''),
				array('name'=>'cita_id', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->cita->fecha_cita). '  de  '.$model->cita->horaInicio->hora.'  a  '.$model->cita->horaFin->hora,''),
				array('name'=>'Linea de Servicio', 'value'=>$model->cita->lineaServicio->nombre,''),
			),
		)); ?>		
	</div>
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(				
				array('name'=>'Llenado por', 'value'=>$model->personal->nombreCompleto,''),
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$model->fecha),''),
				'observaciones',
			),
		)); ?>
	</div>
</div>

<hr>

<h4 class="text-center">Detalle de Gastos</h4>
<div class="row">
	<div class="span3"></div>
	<div class="span7">
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
			$losGastos = HojaGastosDetalle::model()->findAll("hoja_gastos_id = $model->id");
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
</div>