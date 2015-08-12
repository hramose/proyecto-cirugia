<?php
/* @var $this CitasController */
/* @var $model Citas */


$this->menu=array(
	array('label'=>'Listar Citas', 'url'=>array('index')),
	array('label'=>'Buscar Citas', 'url'=>array('admin')),
);
?>

<?php 
if(isset($_GET['idpersonal']))
{
	$npersonal = $_GET['idpersonal'];
	$elpersonal = Perfil::model()->find("id=$npersonal");
	echo "<h1>Crear Cita - $elpersonal->nombre</h1>";	
}
else
{
	echo "<h1>Crear Cita</h1>";
}
?>

<?php 

if(isset($_GET['idpaciente']))
{
	$npaciente = $_GET['idpaciente'];
	$paciente = Paciente::model()->find("id=$npaciente");
	$nombrePaciente = $paciente->nombre. ' ' .$paciente->apellido;
	echo "<h3>Paciente: <span class='text-error'>$nombrePaciente</span></h3>";
	$ruta = "&idpaciente=$npaciente";
}
else
{
	$ruta = "";
}


?>


<?php 

	//Fecha de cita
	$lafecha = date("d-m-Y");
	$fechaBusqueda = date("Y-m-d");

	//Seleccionar todas las consultas de la fecha seleccionada
	//$citasProgramadas = Citas::model()->findAll("fecha_cita ='$fechaBusqueda'");


	if(isset($npersonal))
	{
		$losmedicos = Personal::model()->findAll("activo = 'si' and id_perfil= $npersonal"); 
	}
	else
	{
		$losmedicos = Personal::model()->findAll("activo = 'si'"); 
	}

?>

	<DIV style='height:650px; width:100%; overflow:scroll;'>
		<div style="width:300%;"><!-- Ancho de columnas de personal-->
	<table class="table">
		<tr>
			<?php
				foreach ($losmedicos as $los_medicos) 
				{
					$nombreMedico = $los_medicos->nombres .' '. $los_medicos->apellidos;
			?>
					<td style="width: 300px;">
						<?php
							$this->beginWidget('zii.widgets.CPortlet', array(
								'title'=>"<small class='ultra_mini'>".$nombreMedico."</small>",
							));
						?>  

						<?php 
							$lashoras = HorasServicio::model()->findAll();
							foreach ($lashoras as $las_horas)
							{
								 //Buscar si hay Citas
						?>

						<?php
							$color = 0;
							$citasProgramadas = Citas::model()->findAll("fecha_cita ='$fechaBusqueda' and personal_id = '$los_medicos->id' and (hora_inicio <= '$las_horas->id' and hora_fin >='$las_horas->id')");
							if(count($citasProgramadas) > 0)
							{
							foreach ($citasProgramadas as $citas_programadas)
							{
								$color++;
								if ($color%2==0) {
									$elcolor = "success";
								}
								else
								{
									$elcolor = "error";
								}
								//if ($citas_programadas->personal_id == $los_medicos->id and ($citas_programadas->hora_inicio <= $las_horas->id and $citas_programadas->hora_fin >=$las_horas->id)) {
									?>
									<table width=100% class="table table-bordered">
											<tr class="<?php echo $elcolor; ?>">
												<td colspan="3"><small><b><?php echo $nombreMedico; ?></b></small></td>
											</tr>
											
											<tr class='<?php echo $elcolor; ?>'>
												<td colspan='2'><small><?php echo $citas_programadas->paciente->nombreCompleto; ?></small></td>
												<td><small>OCUPADA</small></td>
											</tr>

											<tr class='<?php echo $elcolor; ?>'>
												<td colspan="2">
													<?php echo $lafecha; ?>
												</td>
												<td>
													<small><?php echo $las_horas->hora; ?></small>
												</td>
											</tr>
									</table>	
									
								
									<?php
								}
								//break;
							}else{
?>
								<table width=100% class="table table-bordered">
											<tr class="">
												<td colspan="3"><small><b><?php echo $nombreMedico; ?></b></small></td>
											</tr>
											
											<tr class=''>
												<td colspan='2'></td>
												<td><small><a href='index.php?r=citas/create&hora=<?php echo $las_horas->id; ?>&medico=<?php echo $los_medicos->id; ?>&fecha=<?php echo $lafecha; ?><?php echo $ruta;?>'>[Agregar]</a></small></td>												
											</tr>

											<tr>
												<td colspan="2">
													<?php echo $lafecha; ?>
												</td>
												<td>
													<small><?php echo $las_horas->hora; ?></small>
												</td>
											</tr>
									</table>
									<?php	
						}
					}
					 $this->endWidget();
					}
						?>
						
						   
					</td>
			<?php 
				
			?>
		</tr>
	</table>
	</div>
</div>