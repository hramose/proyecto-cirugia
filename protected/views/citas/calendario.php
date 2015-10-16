<style type="text/css">
	
</style>
<?php
/* @var $this CitasController */
/* @var $model Citas */


$this->menu=array(
	array('label'=>'Listar Citas', 'url'=>array('index')),
	array('label'=>'Buscar Citas', 'url'=>array('admin')),
);
?>
<script type="text/javascript">
	function capturar() {
		var lafecha=document.getElementsByName("fecha_cita")[0].value;
		//alert(lafecha);
	}
</script>

<!-- Numero de Cita para botones -->
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

	function onEnviar(){

       //Validar todos los controles
       var aplica = $("#aplica").val();
       if(aplica == "No")
       {
	       var fecha = $("#fecha_accion").val();
	       if(fecha == "")
	       {
	       		swal("Falta completar información", "Campo fecha esta vacio");
	 			return false
	       }

	       var observaciones = $("#SeguimientoComercial_observaciones").val();
	       if(observaciones == "")
	       {
	       		swal("Falta completar información", "Campo Observaciones esta vacio");
	 			return false
	       }
	    }
    }
</script>

<?php
$lafecha = "<script type='text/javascript'> document.write(variablejs) </script>";
?>
<div class="row">
	<div class="span8">
		<?php

		//Fecha de cita
		if(isset($_GET['fecha']))
		{
			$lafecha = $_GET['fecha'];
			$fechaBusqueda = Yii::app()->dateformatter->format("yyyy-MM-dd",$_GET['fecha']);
		}
		else
		{
			$lafecha = date("d-m-Y");
			$fechaBusqueda = date("Y-m-d");
		}

		if(isset($_GET['idpersonal']))
		{
			$npersonal = $_GET['idpersonal'];
			$elpersonal = Perfil::model()->find("id=$npersonal");
			echo "<h1>Crear Cita - $elpersonal->nombre [$lafecha]</h1>";	
		}
		else
		{
			echo "<h1>Crear Cita [$lafecha]</h1>";
		}

		?>

		<?php 

		if(isset($_GET['idpaciente']))
		{	
			$npaciente = $_GET['idpaciente'];
			if ($npaciente != "") {
				$paciente = Paciente::model()->find("id=$npaciente");
				$nombrePaciente = $paciente->nombre. ' ' .$paciente->apellido;
				echo "<h3>Paciente: <span class='text-error'><a href='index.php?r=paciente/view&id=$paciente->id'>$paciente->nombreCompleto</a></span></h3>";
				$ruta = "&idpaciente=$npaciente";
			}
			
		}
		else
		{
			$ruta = "";
			$npaciente="";
		}
		?>
	</div>

	<div class="span4">
	<h2>Fecha: 
	<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'fecha_cita',
					'language'=>'es',
					'model' => '',
					'attribute' => 'fecha_cita',
					'value'=> $lafecha,
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
						'style'=>'height:20px;width:80px;',
						'onchange'=>"document.links.enlace.href='index.php?r=citas/calendario&idpaciente=$npaciente&idpersonal=$npersonal&fecha='+this.value",
					),
				));

		//echo " ".CHtml::submitButton("Ir", array('submit'=>array('citas/calendario&idpaciente='.$_GET['idpaciente'].'&idpersonal='.$_GET['idpersonal'].'&fecha='.""), 'class'=>'btn btn-success','onclick'=>"capturar()"));
		

	?>	
	<a href="index.php?r=citas/calendario&idpaciente=<?php echo $npaciente; ?>&idpersonal=<?php echo $npersonal;?>" class="btn btn-success" name = "enlace">Ir</a>
	</h2>
	</div>
</div>

<?php 

	//Seleccionar todas las consultas de la fecha seleccionada
	//$citasProgramadas = Citas::model()->findAll("fecha_cita ='$fechaBusqueda'");


	if(isset($npersonal))
	{
		$losmedicos = Personal::model()->findAll("activo = 'si' and id_perfil= $npersonal and agenda = 'SI'"); 
	}
	else
	{
		$losmedicos = Personal::model()->findAll("activo = 'si' and agenda = 'SI'"); 
	}

?>
	
	<DIV style='height:650px; width:100%; overflow:scroll;'>
		<!-- <div style="width:300%;">Ancho de columnas de personal-->
	<table class="table">
		<thead>
		<tr>
			<?php 
				foreach ($losmedicos as $los_medicostitulo) 
				{
					?>
						<th>						
								<?php echo "<b>".$los_medicostitulo->nombreCompleto."</b> - <a href='index.php?r=citas/exportarAgenda&lafecha=$lafecha&elpersonal=$los_medicostitulo->id'>[Exportar]</a>"; ?>
						</th>
					<?php
				}
			?>
		</tr>
		</thead>
		<tbody>
		<tr>
		<?php
				foreach ($losmedicos as $los_medicos) 
				{
		?>
		
		
			<td>
				<?php /*echo "<b>".$los_medicos->nombreCompleto."</b> - <a href='index.php?r=citas/exportar&lafecha=$lafecha&elpersonal=$los_medicos->id'>[Exportar]</a>"; */?>
				<table class="table table-bordered">
					
				<?php 
					$color = 0;
					$elidpaciente = 0;
					$elidpaciente_interno = 0;
					$la_cita = 0;
					$lashoras = HorasServicio::model()->findAll();
					foreach ($lashoras as $las_horas)
					{
						$citasProgramadas = Citas::model()->findAll("fecha_cita ='$fechaBusqueda' and estado != 'Cancelada' and personal_id = '$los_medicos->id' and (hora_inicio <= '$las_horas->id' and hora_fin >='$las_horas->id')");


						if(count($citasProgramadas) > 0)
							{
							foreach ($citasProgramadas as $citas_programadas)
							{
						
								$elidpaciente = $citas_programadas->paciente_id;
								$lacita = $citas_programadas->id;
								if($elidpaciente != $elidpaciente_interno )
								{
									$la_cita = $citas_programadas->id;
									$color = 0;
									$elidpaciente_interno = $citas_programadas->paciente_id;
									
								}
								else
								{
									if ($lacita != $la_cita) {
										$la_cita = $citas_programadas->id;
										$color = 0;
										$elidpaciente_interno = $citas_programadas->paciente_id;
									}

								}

								if ($color == 0)
								{
									$color = rand(1,8);
									if ($color == 1) { $elcolor = "success";}
									if ($color == 2) { $elcolor = "error";}
									if ($color == 3) { $elcolor = "warning";}
									if ($color == 4) { $elcolor = "info";}
									if ($color == 5) { $elcolor = "otro1";}
									if ($color == 6) { $elcolor = "otro2";}
									if ($color == 7) { $elcolor = "otro3";}
									if ($color == 8) { $elcolor = "info";}
								}
						?>
						<tr class='<?php echo $elcolor; ?>'>
							<td width=10%>
								<?php
									echo trim($las_horas->hora)."<br>";
									if ($citas_programadas->confirmacion_personal_id  != Null){ ?>
										<span class="label label-warning"><i class="icon-ok-circle icon-white"></i></span>
									<?php }
								?>
							</td>
							<td width=80%>
								<small><b>Paciente: </b><?php echo $citas_programadas->paciente->nombreCompleto;  
								?></small><br>
								<small><b>Atiende:</b> <?php echo $citas_programadas->personal->nombreCompleto; ?></small>
								<?php 
									$lahorafin = HorasServicio::model()->findByPK($citas_programadas->hora_fin + 1);

								?>
								<table class="table">
									<tr>
										<td><small><b>Inicio:</b> <?php echo $citas_programadas->horaInicio->hora; ?></small></td>
										<td><small><b>Fin:</b> <?php echo $lahorafin->hora; ?></small></td>
									</tr>
									<tr>
										<td>
											<small><b>Linea de Servicio:</b><br><?php echo $citas_programadas->lineaServicio->nombre; ?></small><br>
											<small><b>Contrato Asociado:</b><br><?php 
											if ($citas_programadas->contrato_id == NULL) 
											{
												echo "<span class='text-error'>No Asignado</span>";
											}
											else
											{
												echo $citas_programadas->contrato_id;
											}
											 ?></small>
										</td>
										<td>
											<?php
												if (strtotime($lahorafin->hora) < strtotime(date('h:ia'))) 
												{
													echo "<i class='icon-warning-sign'></i>";
												} 
											?>
										</td>
										<?php 
											//Valoración Inicial
											if ($citas_programadas->linea_servicio_id == 29) 
											{
												$eltratamientointeres = Paciente::model()->find("id=$citas_programadas->paciente_id");
												if ($eltratamientointeres->tratamiento_interes_id != "") 
												{
													echo "<td><small><b>Tratamiento de Interes:</b><br>".$eltratamientointeres->tratamientoInteres->name."</small></td>";
												}
												else
												{
													echo "<td><small><b>Tratamiento de Interes:</b><br>NINGUNO</small></td>";	
												}
											}
										?>
									</tr>
									<tr>
										<td><small><b>Observaciones: </b><?php echo $citas_programadas->comentario; ?></small></td>
									</tr>
								</table>
								
							</td>
							<td width=10%>
								<!-- Ver Detalle de Cita -->
								<!-- <small><a class="btn btn-mini btn-success" href='index.php?r=citas/view&id=<?php echo $citas_programadas->id;?>'><i class="icon-calendar icon-white"></i></a></small> -->
								<?php
								$i = 0;
									$this->widget('ext.popup.JPopupWindow', array( 
									'tagName'=>'button',
									'content'=> '<i class="icon-calendar icon-white"></i>', 
									'url'=>array('imprimir/verCita', 'id'=>$citas_programadas->id),
									/*'url'=>array('/site/contact'), */
									'htmlOptions'=>array('class'=>'btn btn-primary btn-mini', 'title'=>'Vista Ampliada'),
									'options'=>array( 
									'height'=>600, 
									'width'=>800, 
									'top'=>50, 
									'left'=>50,
									), 
									)); 
								?>
								
								<?php 
								if ($citas_programadas->estado == "Programada" or  $citas_programadas->estado == "Vencida") 
								{
								?>
								<br>
								<small><button onclick="miCita(<?php echo $citas_programadas->id; ?>, 'Completada')" type="button" data-toggle="modal" data-target="#completar" class="btn btn-mini btn-success" title="Cita Completada"><i class="icon-ok icon-white"></i></button></small>
								<br>
								<small><button onclick="miCita(<?php echo $citas_programadas->id; ?>, 'Cancelada')" type="button" data-toggle="modal" data-target="#cancelar" class="btn btn-mini btn-danger" title="Cita Cancelada"><i class="icon-ban-circle icon-white"></i></button></small>
								<br>
								<small>
									<?php if ($citas_programadas->confirmacion_personal_id  == Null){ ?>
										<button onclick="miCita(<?php echo $citas_programadas->id; ?>, 'Confirmada')" type="button" data-toggle="modal" data-target="#confirmar" class="btn btn-mini btn-warning" title="Confirmar Cita"><i class="icon-thumbs-up icon-white"></i></button>	
									<?php }else{ ?>
										
									<?php } ?>
									
								</small>
								<br>
								<small><button onclick="miCita(<?php echo $citas_programadas->id; ?>, 'Fallida')" type="button" data-toggle="modal" data-target="#completar" class="btn btn-mini btn-inverse" title="Cita Fallida"><i class="icon-thumbs-down icon-white"></i></button></small>
								<br>
								<br>
								<br>
								<small><a href="index.php?r=citas/view&id=<?php echo $citas_programadas->id;?>" role="button" class="btn btn-mini btn-info" data-toggle="modal" title="Atender Cita"><i class="icon-flag icon-white"></i></a></small>
								<?php 
								}
								else
								{
									if ($citas_programadas->estado == "Completada") 
									{
									?>
										<small><a href="index.php?r=citas/view&id=<?php echo $citas_programadas->id;?>" role="button" class="btn btn-mini btn-primary" data-toggle="modal" title="Ver Cita"><i class="icon-star icon-white"></i></a></small>
									<?php
									}
									if ($citas_programadas->estado == "Fallida") 
									{
									?>
										<small><a href="index.php?r=citas/view&id=<?php echo $citas_programadas->id;?>" role="button" class="btn btn-mini btn-primary" data-toggle="modal" title="Ver Cita"><i class="icon-star icon-white"></i></a></small>
									<?php
									}
									if ($citas_programadas->estado == "Vencida") 
									{
									?>
										<small><a href="index.php?r=citas/view&id=<?php echo $citas_programadas->id;?>" role="button" class="btn btn-mini btn-primary" data-toggle="modal" title="Ver Cita Vencida"><i class="icon-bell icon-white"></i></a></small>
									<?php
									}
									//if (($citas_programadas->estado != "Cancelada" or $citas_programadas->estado != "Vencida") and $citas_programadas->omitir_seguimiento != "Si") 
									if ($citas_programadas->omitir_seguimiento == "No")
									{
										//Para seguimiento
										$losseguimientos = SeguimientoComercial::model()->find("cita_id = $citas_programadas->id");
										?>
										<small><a href="index.php?r=seguimientoComercial/view&id=<?php echo $losseguimientos->id;?>" role="button" class="btn btn-mini btn-warning" data-toggle="modal" title="Ver Seguimiento"><i class="icon-flag icon-white"></i></a></small>
									<?php
									}
								}
								?>
							</td>
						</tr>
						<?php
							}
							}
							else //Los que no tienen Citas
							{
								$color = 0;
								$elidpaciente = 0;
								?>
								<tr>
									<td width=10%>
										<?php
											echo trim($las_horas->hora);
										?>
									</td>
									<td width=80%>
										<small class="muted"><?php echo $los_medicos->nombreCompleto; ?></small>
									</td>
									<td width=10%>
										<?php 
											if ($npaciente != "") {
												?>
												<small><a data-toggle="tooltip" title="<?php echo $los_medicos->nombreCompleto; ?>" href='index.php?r=citas/create&hora=<?php echo $las_horas->id; ?>&medico=<?php echo $los_medicos->id; ?>&fecha=<?php echo $lafecha; ?><?php echo $ruta;?>'>[Agregar]</a></small>
												<?php
											}
										?>
										
									</td>
								</tr>
								<?php
							}
					}
				?>
				
				</table>
			</td>

		
		<?php 
				}
			?>
		</tr>
		</tbody>
	</table>
	</div>
</div>

<table>



<!-- VENTANAS MODALES -->
<!-- Modal Completar Cita -->
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
		//'action'=>'/smadia/index.php?r=citas/calendario&idpersonal='.$los_medicos->id_perfil.'&fecha=24-01-2015',
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
								'style'=>'height:20px;width:80px;'
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



<!-- Confirmar Cita -->
<?php if ($losmedicos): ?>
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
		'action'=>Yii::app()->baseUrl.'/index.php?r=citas/confirmar&idpersonal='.$los_medicos->id_perfil,
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
					<?php echo $form->textField($tabla_confirma,'contrato_id'); ?>
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
<?php endif ?>



<!-- Cancelar Cita -->
<?php if ($losmedicos): ?>
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
		'action'=>Yii::app()->baseUrl.'/index.php?r=citas/cancelar&idpersonal='.$los_medicos->id_perfil,
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
					<?php echo $form->textField($tabla_citas,'id'); ?>
					<?php echo $form->textField($tabla_citas,'estado'); ?>
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
<?php endif ?>




