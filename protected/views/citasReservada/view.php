<?php
	/* @var $this CitasReservadaController */
	/* @var $model CitasReservada */

	$this->menu=array(
		array('label'=>'Crear Citas Reservada', 'url'=>array('create')),
		//array('label'=>'Actualizar Citas Reservada', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Buscar Citas Reservada', 'url'=>array('admin')),
	);
?>

<h1>Cita Reservada #<?php echo $model->id; ?></h1>

<div class="rows">
	<div class="span6">
		<?php 

	if ($model->fecha_fin == NULL) 
	{
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Personal', 'value'=>$model->personal->nombreCompleto, ''),
				array('name'=>'Fecha', 'value'=>date('d-m-Y',strtotime($model->fecha_inicio)),''),
				array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
				array('name'=>'Hora de Fin', 'value'=>$model->horaFin->hora ,''),
				'motivo',
				'observacion',
				array('name'=>'Creado por', 'value'=>$model->usuario->nombreCompleto, ''),
				array('name'=>'Fecha de Registro', 'value'=>date('d-m-Y h:m:s',strtotime($model->fecha_creado)),''),
				'estado',
			),
		)); 	
	}



	if ($model->fecha_fin != NULL) 
	{
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Personal', 'value'=>$model->personal->nombreCompleto, ''),
				array('name'=>'Fecha de Inicio', 'value'=>date('d-m-Y',strtotime($model->fecha_inicio)),''),
				array('name'=>'Fecha de Fin', 'value'=>date('d-m-Y',strtotime($model->fecha_fin)),''),
				array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
				array('name'=>'Hora de Fin', 'value'=>$model->horaFin->hora ,''),
				'motivo',
				'observacion',
				array('name'=>'Creado por', 'value'=>$model->usuario->nombreCompleto, ''),
				array('name'=>'Fecha de Registro', 'value'=>date('d-m-Y h:m:s',strtotime($model->fecha_creado)),''),
				'estado',
			),
		));	
	}

	//echo date('Y-m-d');

	// $lafecha = strtotime ('+2 day', strtotime(date('Y-m-j')));
	// //echo date ('Y-m-d', $lafecha); 

	// //Para calcular el numero de dias
	// $datetime1 = date_create('2009-10-11');
	// $datetime2 = date_create('2009-10-13');
	// $interval = date_diff($datetime1, $datetime2);
	// $ndias = $interval->format('%a')  + 1;
	// echo $ndias;


?>		
	</div>
	<div class="span5 text-center">
	<?php 
		if ($model->estado == "Activa") 
		{
	?>
		<h2 class="text-center">Opciones</h2>
		
			<a href="#cancelar" role="button" class="btn btn-warning" data-toggle="modal"><i class="icon-remove icon-white"></i> Desbloquear Agenda</a>
		<a href="index.php?r=citas/calendario&idpersonal=<?php echo $model->personal->id_perfil.'&fecha='.$model->fecha_inicio ?>" role="button" class="btn btn-primary" data-toggle="modal"><i class="icon-zoom-in icon-white"></i> Ver Agenda</a>
	<?php
		}
		else
		{
			?>
		<h2 class="text-center">Datos de Desbloqueo</h2>
			<?php
			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'Desbloqueada por', 'value'=>$model->usuarioDesbloqueo->nombreCompleto, ''),
				array('name'=>'Fecha Desbloqueo', 'value'=>date('d-m-Y H:m:s',strtotime($model->fecha_cancela)),''),
				array('name'=>'Motivo Desbloqueo', 'value'=>$model->comentario_cancela,''),
			),
		));
		}
	?>
	</div>
</div>



<!-- Cancelar Reserva -->
<div id="cancelar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel2">Desbloquear Agenda</h3>
    <p>Se dispone a desbloquear la agenda.</p>
  </div>
	<div class="modal-body text-center">
    	 	<?php 
			 	$form=$this->beginWidget('CActiveForm', array(
				'id'=>'desbloquear-form',
				'action'=>'index.php?r=citasReservada/desbloquear&idReserva='.$model->id,
				// Please note: When you enable ajax validation, make sure the corresponding			
				// controller action is handling ajax validation correctly.								
				// There is a call to performAjaxValidation() commented in generated controller code.	
				// See class documentation of CActiveForm for details on this.							
				'enableAjaxValidation'=>true,
			)); ?>
	    	 	<div class="input-prepend">
	    	 	<span class="controls">
					<label><b>Detalle el motivo del desbloqueo:</b></label>
	    	 		<textarea name="comentario_cancela" id="comentario_cancela" cols="60" rows="5" class="input-xxlarge"></textarea>
					<br>
	    	 	</span>
	    	 		<button class="btn btn-primary" type="submit">Proceder</button>
	    	 	</div>
    	 	<?php $this->endWidget(); ?>
    </div>  	
   <div class="modal-footer">
    <?php 
   		 	echo "<b>Registrado por:</b> ".Yii::app()->user->name;
   	?>
  </div>
</div>
