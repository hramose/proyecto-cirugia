<h1>Cita #<?php echo $model->id; ?></h1>

<div class="row">
		<?php 

		if ($model->fecha_cita!='') {
				$fecha_cita=date('d-m-Y',strtotime($model->fecha_cita));
		}else{$fecha_cita=null;}
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'paciente.nombreCompleto',
				'personal.nombreCompleto',
				'paciente_orden_id',
				'lineaServicio.nombre',
				'estado',
				array('name'=>'Fecha de Cita', 'value'=>$fecha_cita,''),
				array('name'=>'Hora de Inicio', 'value'=>$model->horaInicio->hora,''),
				array('name'=>'Hora de Fin', 'value'=>$model->horaFin->hora,''),
				'correo',
				'comentario',
			),
		)); ?>
</div>
