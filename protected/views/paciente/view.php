<?php
/* @var $this PacienteController */
/* @var $model Paciente */

if ($model->fecha_nacimiento!='') {
		$fecha_nacimiento=date('d-m-Y',strtotime($model->fecha_nacimiento));
}

if ($model->fecha_registro!='') {
		$fecha_registro=date('d-m-Y',strtotime($model->fecha_registro));
}

//Calculo de Edad
$anio_nacimiento = Yii::app()->dateformatter->format("yyyy",$model->fecha_nacimiento);
$edadpaciente = date("Y") - $anio_nacimiento;

//echo $edadpaciente;

$this->menu=array(
	array('label'=>'Listar Pacientes', 'url'=>array('index')),
	array('label'=>'Ingresar Paciente', 'url'=>array('create')),
	array('label'=>'Actualizar Paciente', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Paciente', 'url'=>array('admin')),
);

?>

<?php
	//Contadores Generales
	$Ganamnesis 		= HistorialAnamnesis::model()->count("paciente_id = $model->id");
	$Gexamen 			= HistorialExamenFisico::model()->count("paciente_id = $model->id");
	$Gformulacion 		= HistorialFormulacion::model()->count("paciente_id = $model->id");
	$Gevaluacion 		= HistorialEvaluacionMedica::model()->count("paciente_id = $model->id");
	$Gcosmetologica 	= HistorialEvaluacionCosmetologica::model()->count("paciente_id = $model->id");


	$examen 					= HistorialExamenFisico::model()->count("paciente_id = $model->id");
	$evaluacion 				= HistorialEvaluacionMedica::model()->count("paciente_id = $model->id");
	$evaluacionEnfermeria 		= HistorialEvaluacionEnfermeria::model()->count("paciente_id = $model->id");
	$evaluacionCosmetologica 	= HistorialEvaluacionCosmetologica::model()->count("paciente_id = $model->id");
	$formulacion 				= HistorialFormulacion::model()->count("paciente_id = $model->id");
	$laboratorio 				= HistorialLaboratorio::model()->count("paciente_id = $model->id");
	$sistemas 					= HistorialRevisionSistema::model()->count("paciente_id = $model->id");
	$tabla 						= HistorialTablaMedidas::model()->count("paciente_id = $model->id");
	$plan 						= HistorialPlanTratamiento::model()->count("paciente_id = $model->id");
	$diagnostico 				= HistorialDiagnostico::model()->count("paciente_id = $model->id");
	$medicina 					= HistorialMedicinaBiologica::model()->count("paciente_id = $model->id");
	$fotografias 				= PacienteFotografias::model()->count("paciente_id = $model->id");
	$archivoExamenes 			= PacienteResultadosLab::model()->count("paciente_id = $model->id");

	//Suma de Saldos
	$suma_saldo = Contratos::model()->findBySql("select sum('saldo') as 'total' from contratos where estado = 'Activo' and paciente_id = ".$model->id, array());
?>				
				
<h1>Paciente #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span2">
		  	<img class="img-polaroid" src="images/user.png"/>
		  	<h4 class="text-center">Saldo Pendiente</h4>
		  	<h3 class="text-center text-error">$ <?php echo $suma_saldo->total; ?></h3>


	</div>
	<div class="span5">
	<?php 
	if ($model->genero == 1) 
	{ $elgenero = "Indefinido"; } 
	if ($model->genero == 2) 
	{ $elgenero = "Femenino"; } 
	if($model->genero == 3) 
	{ $elgenero = "Masculino";}

	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(			
			'nombre',
			'apellido',
			'n_identificacion',
			array('name'=>'genero', 'value'=>$elgenero,''),
			array('name'=>'fecha_nacimiento', 'value'=>$fecha_nacimiento,''),
			array('name'=>'Edad', 'value'=>$edadpaciente,''),

			array('name'=>'fecha_registro', 'value'=>$fecha_registro,''),
			'email',
			'email2',
			'telefono1',
			'telefono2',
			'celular',
			'direccion',
		),
	)); ?>
	</div>
	
	<div class="span5">
		<?php 
		if ($model->tratamiento_interes_id == NULL) 
			{ $trata = ""; } else { $trata = $model->tratamientoInteres->name;}
		$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(			
			'ciudad',
			'pais',
			'estado_civil',
			'ocupacion',
			'tipo_vinculacion',
			'Aseguradora',
			'nombre_acompanante',
			'acompanante_telefono',
			'nombre_responsable',
			'relacion_responsable',
			'telefono_responsable',
			array('name'=>'Tratamiento de Interes', 'value'=>$trata),
			'observaciones',
		),
	)); ?>
	</div>
</div>
<div class="row">
	<div class="span12"></div>
</div>
<?php 
	$lasCitas = Citas::model()->findAll("paciente_id = $model->id");
	if (count($lasCitas)>0) 
	{
		?>
		
		<div class="row">
			<div class="span12">
				<h2 class="text-center">Historial de Citas</h2>
				<table class="table table-striped">
					<tr>
						<th>Fecha</th>
						<th>Hora Inicio</th>
						<th>Hora Fin</th>
						<th>Profesional</th>
						<th>Contrato</th>
						<th>Servicio</th>
						<th>Comentario</th>
						<th>Estado</th>
						<th></th>
					</tr>
				<?php 
					foreach ($lasCitas as $las_citas) 
					{
				?>
					<tr>
						<td><small><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_citas->fecha_cita); ?></small></td>
						<td><?php echo $las_citas->horaInicio->hora; ?></td>
						<td><?php echo $las_citas->horaFinMostrar->hora; ?></td>
						<td><?php echo $las_citas->personal->nombreCompleto; ?></td>
						<td><?php echo $las_citas->contrato_id; ?></td>
						<td><?php echo $las_citas->lineaServicio->nombre; ?></td>
						<td><small><?php echo $las_citas->comentario; ?></small></td>
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
	}
?>

<!-- Resumenes de Historial Clinico -->
		<div class="row">
			<div class="span12 text-center">
				<h4 class = "text-center">Resumenes de Historial Clinico</h4>
			
				
				<!-- <a href="#llamada" role="button" class="btn btn-small btn-warning" data-toggle="modal">Medicina Biológica</a>
				<a href="#llamada" role="button" class="btn btn-small btn-warning" data-toggle="modal">Fotos</a>
				<a href="#llamada" role="button" class="btn btn-small btn-warning" data-toggle="modal">Resultado Laboratorios</a> -->
		</div>
		</div>

		<div class="row">
			<div class="span2"></div>
			<div class="span8">
				<div class="tabbable tabs-left">
	              <ul class="nav nav-tabs">
	              	<?php if ($Ganamnesis > 0) {	?>	<li><a href="#anamnesis" data-toggle="tab"><b><small>Anamnesis</small></b></a></li> <?php } ?>
	              	<?php if ($sistemas > 0) {	?>	<li><a href="#sistemas" data-toggle="tab"><b><small>Evaluación por Sistemas</small></b></a></li> <?php } ?>
	              	<?php if ($examen > 0) {	?>	<li><a href="#examen" data-toggle="tab"><b><small>Examen Físico</small></b></a></li> <?php } ?>
	              	<?php if ($tabla > 0) {		?>	<li><a href="#tabla" data-toggle="tab"><b><small>Tabla de Medidas</small></b></a></li> <?php } ?>
	              	<?php if ($diagnostico > 0) {	?>	<li><a href="#diagnostico" data-toggle="tab"><b><small>Diagnostico Clínico</small></b></a></li> <?php } ?>
	              	<?php if ($plan > 0) {	?>	<li><a href="#plan" data-toggle="tab"><b><small>Plan de Tratamiento</small></b></a></li> <?php } ?>
	              	<?php if ($medicina > 0) {	?>	<li><a href="#medicina" data-toggle="tab"><b><small>Plan de Medicina Biológica</small></b></a></li> <?php } ?>
	              	<?php if ($laboratorio > 0) {	?>	<li><a href="#laboratorio" data-toggle="tab"><b><small>Examenes de Laboratorio</small></b></a></li> <?php } ?>
	              	<?php if ($evaluacion > 0) {	?>	<li><a href="#evaluacion" data-toggle="tab"><b><small>Evolución Médica</small></b></a></li> <?php } ?>
	              	<?php if ($evaluacionEnfermeria > 0) {	?>	<li><a href="#evaluacionEnfermeria" data-toggle="tab"><b><small>Evolución de Enfermería</small></b></a></li> <?php } ?>
	              	<?php if ($evaluacionCosmetologica > 0) {	?>	<li><a href="#cosmetologica" data-toggle="tab"><b><small>Evolución Cosmetológica</small></b></a></li> <?php } ?>
	              	<?php if ($formulacion > 0) {	?>	<li><a href="#formulacion" data-toggle="tab"><b><small>Formulación</small></b></a></li> <?php } ?>
	              	<?php if ($archivoExamenes > 0) {	?>	<li><a href="#archivoExamenes" data-toggle="tab"><b><small>Resultados de Laboratorio</small></b></a></li> <?php } ?>
	              	<?php if ($fotografias > 0) {	?>	<li><a href="#fotografias" data-toggle="tab"><b><small>Fotografías</small></b></a></li> <?php } ?>
	              </ul>
	              <div class="tab-content">
	              	<?php if ($Ganamnesis >0) {	?>
		                <div class="tab-pane" id="anamnesis">
		                	<h5>Historial de Anamnesis</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$Glasanamnesis = HistorialAnamnesis::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($Glasanamnesis as $Glas_anamnesis)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$Glas_anamnesis->fecha); ?></td>
						 				<td><?php echo $Glas_anamnesis->personal->nombreCompleto; ?></td>
						 				<td><a href="index.php?r=historialAnamnesis/view&id=<?php echo $Glas_anamnesis->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($sistemas >0) {	?>
		                <div class="tab-pane" id="sistemas">
		                	<h5>Historial de Revisión de Sistemas</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$losSistemas = HistorialRevisionSistema::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($losSistemas as $los_sistemas)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$los_sistemas->fecha); ?></td>
						 				<td><?php echo $los_sistemas->personal->nombreCompleto; ?></td>
						 				<td><a href="index.php?r=historialRevisionSistema/view&id=<?php echo $los_sistemas->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($examen >0) {	?>
		                <div class="tab-pane" id="examen">
		                	<h5>Historial de Examenes Fisicos</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th>IMC</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$losExamenes = HistorialExamenFisico::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($losExamenes as $los_examenes)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$los_examenes->fecha); ?></td>
						 				<td><?php echo $los_examenes->personal->nombreCompleto; ?></td>
						 				<td><?php echo $los_examenes->imc; ?></td>
						 				<td><a href="index.php?r=historialExamenFisico/view&id=<?php echo $los_examenes->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($tabla >0) {	?>
		                <div class="tab-pane" id="tabla">
		                	<h5>Historial de Tabla de Medidas</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th>IMC</th>
		                			<th>Peso</th>
		                			<th>Busto</th>
		                			<th>Contorno</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$lasTablas = HistorialTablaMedidas::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($lasTablas as $las_tablas)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_tablas->fecha); ?></td>
						 				<td><?php echo $las_tablas->personal->nombreCompleto; ?></td>
						 				<td><?php echo $las_tablas->imc; ?></td>
						 				<td><?php echo $las_tablas->peso; ?></td>
						 				<td><?php echo $las_tablas->busto; ?></td>
						 				<td><?php echo $las_tablas->contorno; ?></td>
						 				<td><a href="index.php?r=historialTablaMedidas/view&id=<?php echo $las_tablas->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($diagnostico >0) {	?>
		                <div class="tab-pane" id="diagnostico">
		                	<h5>Historial de Diagnostico Clínico</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$losDiagnosticos = HistorialDiagnostico::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($losDiagnosticos as $los_diagnosticos)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$los_diagnosticos->fecha); ?></td>
						 				<td><?php echo $los_diagnosticos->personal->nombreCompleto; ?></td>
						 				<td><a href="index.php?r=historialDiagnostico/view&id=<?php echo $los_diagnosticos->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

					<?php if ($plan >0) {	?>
		                <div class="tab-pane" id="plan">
		                	<h5>Historial de Plan de Tratamiento</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$losPlanes = HistorialPlanTratamiento::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($losPlanes as $los_planes)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$los_planes->fecha); ?></td>
						 				<td><?php echo $los_planes->personal->nombreCompleto; ?></td>
						 				<td><a href="index.php?r=historialPlanTratamiento/view&id=<?php echo $los_planes->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($medicina >0) {	?>
		                <div class="tab-pane" id="medicina">
		                	<h5>Historial de Plan de Medicina Biológica</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Ciclo</th>
		                			<th>Responsable</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$losBiologica = HistorialMedicinaBiologica::model()->findAll("paciente_id = $model->id"); 
		                		$i = 1;
						 		foreach ($losBiologica as $los_biologica)
						 		{

						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$los_biologica->fecha); ?></td>
						 				<td>Ciclo <?php echo $i; ?></td>
						 				<td><?php echo $los_biologica->personal->nombreCompleto; ?></td>
						 				<td><a href="index.php?r=historialMedicinaBiologica/view&id=<?php echo $los_biologica->id; ?>&idCiclo=<?php echo $i; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 			$i++;
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($laboratorio >0) {	?>
		                <div class="tab-pane" id="laboratorio">
		                	<h5>Historial de Examenes de Laboratorios</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$losLaboratorios = HistorialLaboratorio::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($losLaboratorios as $los_laboratorios)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$los_laboratorios->fecha); ?></td>
						 				<td><?php echo $los_laboratorios->personal->nombreCompleto; ?></td>
						 				<td>
						 					<a href="index.php?r=historialLaboratorio/view&id=<?php echo $los_laboratorios->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a>
											<a href="index.php?r=historialLaboratorio/update&id=<?php echo $los_laboratorios->id; ?>&idPaciente=<?php echo $model->id;?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Editar</a>
												<?php 
												$this->widget('ext.popup.JPopupWindow', array( 
												'tagName'=>'button',
												'content'=> ' Imprimir ', 
												'url'=>array('HistorialLaboratorio/laboratorio', 'id'=>$los_laboratorios->id),
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
	                <?php }?>

	                <?php if ($evaluacion >0) {	?>
		                <div class="tab-pane" id="evaluacion">
		                	<h5>Historial de Evolución Médica</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th>Evolución</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$lasMedicas = HistorialEvaluacionMedica::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($lasMedicas as $las_medicas)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_medicas->fecha); ?></td>
						 				<td><?php echo $las_medicas->personal->nombreCompleto; ?></td>
						 				<td><?php echo $las_medicas->evolucion; ?></td>
						 				<td><a href="index.php?r=historialEvaluacionMedica/view&id=<?php echo $las_medicas->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($evaluacionEnfermeria >0) {	?>
		                <div class="tab-pane" id="evaluacionEnfermeria">
		                	<h5>Historial de Evolución de Enfermería</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th>Evolución</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$lasEnfermeria = HistorialEvaluacionEnfermeria::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($lasEnfermeria as $las_enfermeria)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_enfermeria->fecha); ?></td>
						 				<td><?php echo $las_enfermeria->personal->nombreCompleto; ?></td>
						 				<td><?php echo $las_enfermeria->evaluacion; ?></td>
						 				<td><a href="index.php?r=historialEvaluacionEnfermeria/view&id=<?php echo $las_enfermeria->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($evaluacionCosmetologica >0) {	?>
		                <div class="tab-pane" id="cosmetologica">
		                	<h5>Historial de Evolución Cosmetológica</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th>Evolución</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$lasCosmetologicas = HistorialEvaluacionCosmetologica::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($lasCosmetologicas as $las_cosmetologicas)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_cosmetologicas->fecha); ?></td>
						 				<td><?php echo $las_cosmetologicas->personal->nombreCompleto; ?></td>
						 				<td><?php echo $las_cosmetologicas->evaluacion; ?></td>
						 				<td><a href="index.php?r=historialEvaluacionCosmetologica/view&id=<?php echo $las_cosmetologicas->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($formulacion >0) {	?>
		                <div class="tab-pane" id="formulacion">
		                	<h5>Historial de Formulaciones</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Responsable</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$lasFormulaciones = HistorialFormulacion::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($lasFormulaciones as $las_formulaciones)
						 		{
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_formulaciones->fecha); ?></td>
						 				<td><?php echo $las_formulaciones->personal->nombreCompleto; ?></td>
						 				<td><a href="index.php?r=historialFormulacion/view&id=<?php echo $las_formulaciones->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($fotografias >0) {	?>
		                <div class="tab-pane" id="fotografias">
		                	<h5>Historial de Fotografia de Pacientes</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Descripción</th>
		                			<th>Fotografias</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$lasFotografias = PacienteFotografias::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($lasFotografias as $las_fotografias)
						 		{
						 			$nFotografias 	= PacienteFotografiasDetalle::model()->count("paciente_fotografias_id = $las_fotografias->id");
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_fotografias->fecha); ?></td>
						 				<td><?php echo $las_fotografias->comentario; ?></td>
						 				<td><?php echo $nFotografias; ?></td>

						 				<td><a href="index.php?r=pacienteFotografias/view&id=<?php echo $las_fotografias->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>

	                <?php if ($archivoExamenes >0) {	?>
		                <div class="tab-pane" id="archivoExamenes">
		                	<h5>Historial de Resultados de Examenes</h5>
		                	<table class="table table-condensed">
		                		<tr>
		                			<th>Fecha</th>
		                			<th>Descripción</th>
		                			<th>Examenes</th>
		                			<th></th>
		                		</tr>
		                
		                	<?php 
		                		$losArchivosExamenes = PacienteResultadosLab::model()->findAll("paciente_id = $model->id"); 
						 		foreach ($losArchivosExamenes as $los_archivos_examenes)
						 		{
						 			$nArchivos 	= PacienteResultadosLabDetalle::model()->count("paciente_resultados_lab_id = $los_archivos_examenes->id");
						 			?>
						 			<tr>
						 				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$los_archivos_examenes->fecha); ?></td>
						 				<td><?php echo $los_archivos_examenes->descripcion; ?></td>
						 				<td><?php echo $nArchivos; ?></td>
						 				<td><a href="index.php?r=pacienteResultadosLab/view&id=<?php echo $los_archivos_examenes->id; ?>" class="btn btn-mini btn-info"><i class="icon-search icon-white"></i></a></td>
						 			</tr>
						 			<?php
						 		}
		                	?>
		                	</table>
		                </div>
	                <?php }?>
	               
	              </div>
	            </div>
			</div>
			<div class="span2"></div>
		</div>


<?php 
$elSeguimiento = SeguimientoComercial::model()->findAll("paciente_id = $model->id");
if (count($elSeguimiento)>0) {
	
?>
	<div class="row">
		<div class="span1"></div>
		<div class="span10">
			<h2 class="text-center">Seguimiento Comercial</h2>
			<table class="table table-striped">
					<tr>
						<th>Registrado</th>
						<th>Programada</th>
						<th>Estado</th>
						<th>Tema</th>
						<th>Responsable</th>
						<th>Registrado por:</th>
						<th></th>
					</tr>
				<?php 
					foreach ($elSeguimiento as $el_seguimiento) 
					{
				?>
					<tr>
						<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$el_seguimiento->fecha_registro); ?></td>
						<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$el_seguimiento->fecha_accion); ?></td>
						<td><?php echo $el_seguimiento->estado; ?></td>
						<td><?php echo $el_seguimiento->tema->nombre; ?></td>
						<td><?php echo $el_seguimiento->responsable->nombreCompleto; ?></td>
						<td><?php echo $el_seguimiento->idPersonal->nombreCompleto; ?></td>
						<td><small><a href='index.php?r=seguimientoComercial/view&id=<?php echo $el_seguimiento->id;?>'>[Ver]</a></small></td>
					</tr>
				<?php
					}
				?>					
				</table>
		</div>
	</div>

<?php } ?>


<div clas = "row">
	<div class="span6">
		<!-- Presupuestos-->

		<?php 
			$elPresupuesto = Presupuesto::model()->findAll("paciente_id = $model->id");
			if (count($elPresupuesto)>0) {
				?>
				
				<div class="row">
					<div class="span1"></div>
					<div class="span10">
						<h3 class="text-center">Presupuestos generados</h3>
						<table class="table table-striped">
							<tr>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Total</th>
								<th></th>
							</tr>
						<?php 
							foreach ($elPresupuesto as $el_presupuesto) 
							{
						?>
							<tr>
								<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$el_presupuesto->fecha); ?></td>
								<td><?php echo $el_presupuesto->estado; ?></td>
								<td><?php echo number_format($el_presupuesto->total,2); ?></td>
								<td><small><a href='index.php?r=presupuesto/view&id=<?php echo $el_presupuesto->id;?>'>[Ver]</a></small></td>
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
	</div>

	<div class="span6">
		<!-- Contratos-->
		<?php 
			$elContrato = Contratos::model()->findAll("paciente_id = $model->id and estado != 'Anulado'");
			if (count($elContrato)>0) {
				?>
				
				<div class="row">
					<div class="span1"></div>
					<div class="span10">
						<h3 class="text-center">Contratos generados</h3>
						<table class="table table-striped">
							<tr>
								<th>N°</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Total</th>
								<th>Saldo</th>
								<th></th>
							</tr>
						<?php 
							foreach ($elContrato as $el_contrato) 
							{
						?>
							<tr>
								<td><?php echo $el_contrato->id; ?></td>
								<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$el_contrato->fecha); ?></td>
								<td><?php echo $el_contrato->estado; ?></td>
								<td><?php echo number_format($el_contrato->total,2); ?></td>
								<td><?php echo number_format($el_contrato->saldo,2); ?></td>
								<td><small><a href='index.php?r=contratos/view&id=<?php echo $el_contrato->id;?>'>[Ver]</a></small></td>
							</tr>
						<?php
							}
						?>					
						</table>
					</div>
					<div class="span1"></div>
				</div>

				<?php
			}
		?>

	</div>
</div>





<div class="row">
	<div class = "span12">
		<div class="hero-unit">
		<h2 class="text-center">Opciones de Paciente</h2>
		<div class="text-center">
			<a href="index.php?r=Presupuesto/create&idPaciente=<?php echo $model->id; ?>" class="btn btn-small btn-info"><i class="icon-file icon-white"></i> Crear Presupuesto</a>
			<a href="#contrato" role="button" class="btn btn-small btn-primary" data-toggle="modal"><i class="icon-folder-close icon-white"></i> Crear Contrato de Servicio</a>
			<a href="#llamada" role="button" class="btn btn-small btn-warning" data-toggle="modal"><i class="icon-folder-close icon-white"></i> Crear Seguimiento</a>
			<?php 
				if (!isset($_GET['idCita'])) {
			?>
				<a href="#cita" role="button" class="btn btn-small btn-success" data-toggle="modal"><i class="icon-calendar icon-white"></i> Agendar Cita</a>
			<?php } ?>
			<?php 
				//Verificar que ya haya recibido evaluación inicial
			?>		

			<div class="btn-group">
				<a class="btn btn-small btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
				  <i class="icon-folder-open icon-white"></i> Historia Clinica
				  <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="index.php?r=HistorialAnamnesis/create&idPaciente=<?php echo $model->id; ?>">Anamnesis</a></li>
					<li><a href="index.php?r=HistorialRevisionSistema/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Revisión por Sistemas</a></li>
					<li><a href="index.php?r=HistorialExamenFisico/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Examen Físico</a></li>
					<li><a href="index.php?r=HistorialTablaMedidas/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Tabla de Medidas</a></li>
					<li><a href="index.php?r=HistorialDiagnostico/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Diagnostico</a></li>
					<li><a href="index.php?r=HistorialPlanTratamiento/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Plan de Tratamiento</a></li>
					<li><a href="index.php?r=HistorialMedicinaBiologica/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Plan de Medicina Biológica</a></li>
					<li><a href="index.php?r=HistorialLaboratorio/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Orden de Examanes de Laboratorio</a></li>
					<li><a href="index.php?r=HistorialEvaluacionMedica/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Evolución Medica</a></li>
					<li><a href="index.php?r=HistorialEvaluacionEnfermeria/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Evolución de Enfermería</a></li>
					<li><a href="index.php?r=HistorialEvaluacionCosmetologica/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Evolución Cosmetológica</a></li>
					<li><a href="index.php?r=HistorialFormulacion/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Formulación</a></li>
					<li><a href="index.php?r=PacienteFotografias/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Fotos</a></li>
					<li><a href="index.php?r=PacienteResultadosLab/create&idPaciente=<?php echo $model->id; ?>" data-toggle="modal">Resultado Laboratorios</a></li>
				</ul>
			</div>
			<a href="index.php?r=Ingresos/create&idPaciente=<?php echo $model->id; ?>" class="btn btn-small btn-inverse"><i class="icon-hdd icon-white"></i> Generar Ingreso</a>
		</div>
		</div>
	</div>
</div>




<!-- Modal Contrato de Servicio -->
<div id="contrato" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Se dispone a realizar un Contrato de Servicio</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Desea generar un Contrato de Servicio sin generar Presupuesto?</p>
 	<center>
	 	<?php echo CHtml::submitButton('SI', array('submit'=>array('contratos/create&idPaciente='.$model->id), 'class'=>'btn btn-large btn-primary')); ?>
	 	<button class="btn btn-large" data-dismiss="modal" aria-hidden="true">No</button>
	</center>
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>




<!-- Modal Preguntar con quien -->
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
 			echo CHtml::submitButton($el_personal->nombre, array('submit'=>array('citas/calendario&idpaciente='.$model->id.'&idpersonal='.$el_personal->id), 'class'=>'btn btn-success'));

			}	 		
	 	?>

	</center>
  </div>  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>





<!-- SEGUIMIENTOS COMERCIALES -->
<!-- Llamada -->
<div id="llamada" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Seguimiento Comercial - Llamada</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Complete los datos de la llamada</p>
 	
 	 	<?php 
	 	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'seguimiento-comercial-form',
		//'action'=>'/smadia/index.php?r=citas/calendario&idpersonal='.$los_medicos->id_perfil.'&fecha=24-01-2015',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		)); ?>
	 	<?php 
	 		echo isset($_GET['i']);
	 		$lasfecha = date("d-m-Y");
	 		$tabla_seguimiento = new SeguimientoComercial;
	 		echo $form->errorSummary($tabla_seguimiento); 
	 		
	 		
	 	?>
				<div class = 'span6'>
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
								'style'=>'height:20px;width:80px;'
							),
						));
					?>
					</div>
					<?php echo $form->error($tabla_seguimiento,'fecha_accion'); ?>
				</div>

				<div class='span7'>
					<?php echo $form->labelEx($tabla_seguimiento,'tema_id'); ?>
					<?php echo $form->dropDownList($tabla_seguimiento, 'tema_id',CHtml::listData(SeguimientoTema::model()->findAll("estado = 'Activo' order by 'nombre'"),'id','nombre'), array('class'=>'input-xlarge'));?>
					<?php echo $form->error($tabla_seguimiento,'tema_id'); ?>
				</div>

				<div class = 'span7'>
					<?php echo $form->labelEx($tabla_seguimiento,'responsable_id'); ?>
					<?php echo $form->dropDownList($tabla_seguimiento, 'responsable_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' order by 'nombreCompleto'"),'id','nombreCompleto'), array('class'=>'input-xlarge'));?>
					<?php echo $form->error($tabla_seguimiento,'responsable_id'); ?>
				</div>

				<div class = 'span10'>
					<?php echo $form->labelEx($tabla_seguimiento,'observaciones'); ?>
					<?php echo $form->textArea($tabla_seguimiento,'observaciones',array('rows'=>4, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
					<?php echo $form->error($tabla_seguimiento,'observaciones'); ?>
				</div>

				<div class="span10" style="display:none;">
					<?php echo $form->textField($tabla_seguimiento,'paciente_id', array('value'=>$model->id)); ?>
					<?php echo $form->textField($tabla_seguimiento,'tipo'); ?>
				</div>
	
				<div class = 'span6' >
					<?php echo CHtml::submitButton($tabla_seguimiento->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'onclick'=>'enviarCita()', 'id'=>'btn_enviar')); ?>
				</div>

		<?php $this->endWidget(); ?>
			   
			<!-- Cierra el formulario -->  
			<?php echo CHtml::endForm(); ?>
		</div>

  
  
   <div class="modal-footer">
    <?php 
   		 	echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
  </div>
</div>


<!-- Evento -->
<div id="evento" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Seguimiento Comercial - Evento</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Complete los datos del evento</p>
 	
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Correo Electónico -->
<div id="correo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Seguimiento Comercial - Correo Electónico</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Complete los datos del correo</p>
 	
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<!-- Correo Físico -->
<div id="correofisico" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Seguimiento Comercial - Correo Físico</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<p>Complete los datos del correo</p>
 	
  </div>
  
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>



<!-- RESUMENES -->

<!-- Anamnesis -->
<?php if ($Ganamnesis > 0) { ?>
<div id="Ganamnesis" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Anamnesis</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glasanamnesis = HistorialAnamnesis::model()->findAll("paciente_id = $model->id"); 
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
 		$Glosexamenes = HistorialExamenFisico::model()->findAll("paciente_id = $model->id"); 
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
 		$Glaformulacion = HistorialFormulacion::model()->findAll("paciente_id = $model->id"); 
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



<!-- Historial de Evaluación Medica -->
<?php if ($Gevaluacion > 0) { ?>
<div id="Gevaluacion" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Evaluación Médica</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glasevaluaciones = HistorialEvaluacionMedica::model()->findAll("paciente_id = $model->id"); 
 		foreach ($Glasevaluaciones as $Glas_evaluaciones) 
 		{
 			$fecha=date('d-m-Y',strtotime($Glas_evaluaciones->fecha));
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$Glas_evaluaciones,
			'attributes'=>array(
				array('name'=>'fecha', 'value'=>$fecha,''),
				'personal.nombreCompleto',
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

<!-- Historial de Evaluación Cosmetológica -->
<?php if ($Gcosmetologica > 0) { ?>
<div id="Gcosmetologica" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Historial de Evaluación Cosmetológica</h3>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	<?php 
 		$Glascosmetologicas = HistorialEvaluacionCosmetologica::model()->findAll("paciente_id = $model->id"); 
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