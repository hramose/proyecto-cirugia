<?php
/* @var $this IngresosController */
/* @var $model Ingresos */

$this->menu=array(
	//array('label'=>'Listar Ingresos', 'url'=>array('index')),
	//array('label'=>'Crear Ingreso', 'url'=>array('create')),
	//array('label'=>'Actualizar Ingreso', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Ingreso', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Ingresos', 'url'=>array('admin')),
	array('label'=>"Regresar a Ficha de Paciente", 'url'=>"index.php?r=paciente/view&id=$model->paciente_id"),
);
if ($model->vendedor_id == NULL) {
	$nombreVendedor = "";
}
else
{
	$nombreVendedor = $model->vendedor->nombreCompleto;
}
?>

<h1>Ingreso #<?php echo $model->id; ?></h1>

<div class="row">
<div class="row">
	<div class="span2"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'paciente_id', 'value'=>$model->paciente->nombreCompleto,''),
				array('name'=>'Cedula', 'value'=>$model->paciente->n_identificacion,''),
				array('name'=>'Dirección', 'value'=>$model->paciente->direccion, ''),
				array('name'=>'Celular', 'value'=>$model->paciente->celular, ''),
				'contrato_id',
				array('name'=>'valor', 'value'=>'$ '.number_format($model->valor,2),''),
			),
		)); ?>
	</div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'descripcion',
				'forma_pago',
				array('name'=>'centro_costo_id', 'value'=>$model->centroCosto->nombre,''),
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$model->fecha),''),			
				array('name'=>'personal_id', 'value'=>$model->personal->nombreCompleto,''),
				array('name'=>'vendedor_id', 'value'=>$nombreVendedor),
				'estado',
			),
		)); ?>
	</div>
</div>

<div class="row">
	<div class="span2"></div>
	<div class="span10 text-center">
		<?php if ($model->estado == "Anulado"): ?>
			<h4>Observaciones de Anulación</h4>
			<?php 
				echo $model->observacion_anular;
			?>
			<hr>
		<?php endif ?>
	</div>
</div>

<?php if ($model->contrato_id != NULL): ?>
	<div class="row">
		<h3 class="text-center">Detalle de Contrato</h3>
		<div class="span1"></div>
		<div class="span10">
			<?php 
				//Consultar Detalle de presupuesto
				$detalleContrato = ContratoDetalle::model()->findAll("contrato_id = $model->contrato_id");
				if (count($detalleContrato)>0) {
						?>						
						<div class="row">
							<div class="span12">
								<table class="table table-striped">
									<tr>
										<th><small>Cantidad</small></th>
										<th><small>Linea de Servicio</small></th>
										<th><small>Valor Unitario</small></th>
										<th><small>Descuento (%)</small></th>
										<th><small>Valor Unitario con descuento</small></th>
										<th><small>Valor Total sin descuento</small></th>
										<th><small>Valor Total con descuento</small></th>
										<th><small>Total</small></th>
										<th><small></small></th>
									</tr>
								<?php 
									foreach ($detalleContrato as $detalle_contrato) 
									{
								?>
									<tr>
										<td><?php echo $detalle_contrato->cantidad; ?></td>
										<td><?php echo $detalle_contrato->lineaServicio->nombre; ?></td>
										<td><?php echo '$ '.number_format($detalle_contrato->vu,2); ?></td>
										<td><?php echo $detalle_contrato->desc; ?></td>
										<td><?php echo '$ '.number_format($detalle_contrato->vu_desc,2); ?></td>
										<td><?php echo '$ '.number_format($detalle_contrato->vt_sin_desc,2); ?></td>
										<td><?php echo '$ '.number_format($detalle_contrato->vt_con_desc,2); ?></td>
										<td><?php echo '$ '.number_format($detalle_contrato->total,2); ?></td>
										<td>
									</tr>
								<?php
									}
								?>					
								</table>
							</div>
						</div>
						<?php
					} ?>
		</div>
		
	</div>

	<hr>
	<div class="row">

			<div class="span4"></div>
			<div class="span3">
				<h3 class="text-center">Total de Contrato</h3>
				<h3 class="text-center text-info">$ <?php echo number_format($model->contrato->total,2); ?></h3>
			</div>
			<div class="span3">
				<h3 class="text-center">Saldo Pendiente</h3>
				<h3 class="text-center text-error">$ <?php echo number_format($model->contrato->saldo,2); ?></h3>
			</div>
	</div>
<?php endif ?>
<hr>

<div class="row text-center">

		<a href="index.php?r=paciente/view&id=<?php echo $model->paciente->id ?>" role="button" class="btn btn-mini btn-warning" data-toggle="modal"><i class="icon-file icon-white"></i> Ficha de Paciente</a>
		<?php if ($model->contrato_id != NULL): ?>
		<a href="#historial" class="btn btn-mini btn-primary" role="button" data-toggle="modal"><i class="icon-screenshot icon-white"></i> Historial de Ingresos</a>	
		<?php endif ?>
		
		<?php 
			if ($model->estado =="Activo")
			{
				?>
					<a href="#cancelar" class="btn btn-mini btn-danger" role="button" data-toggle="modal"><i class="icon-remove icon-white"></i> Cancelar Ingreso</a>
				<?php
			}

			$this->widget('ext.popup.JPopupWindow', array( 
				'tagName'=>'button',
				'content'=> '<i class="icon-print icon-white"></i> Imprimir ', 
				'url'=>array('ingresos/imprimirIngresos', 'id'=>$model->id),
				/*'url'=>array('/site/contact'), */
				'htmlOptions'=>array('class'=>'btn btn-info btn-mini'),
				'options'=>array( 
				'height'=>700, 
				'width'=>800, 
				'top'=>50, 
				'left'=>50, 
				), 
				));
		?>
		<?php if ($model->contrato != Null): ?>
			<a href="index.php?r=contratos/view&id=<?php echo $model->contrato_id; ?>" class="btn btn-mini btn-inverse"><i class="icon-file icon-white"></i> Ir a Contrato</a>	
		<?php endif ?>
		<?php if ($model->cita_id != Null): ?>
			<a href="index.php?r=citas/view&id=<?php echo $model->cita_id; ?>" class="btn btn-mini btn-inverse"><i class="icon-file icon-white"></i> Ir a Cita</a>	
		<?php endif ?>	
</div>
<?php 
	//Cheques
	if ($model->forma_pago == "Cheque") {
		?>
		<h3 class="text-center">Detalle de Cheques</h3>
		<div class="row">
			<div class="span2"></div>
			<div class="span4">
				<?php $this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'cheques_cantidad',
						array('name'=>'Banco', 'value'=>$model->chequesBancoCuenta->idBanco->nombre,''),
						array('name'=>'Cuenta', 'value'=>$model->chequesBancoCuenta->numero,''),
						'cheques_total',
					),
				)); ?>
			</div>
			<div class="span1"></div>
			<div class="span4">
				<?php 
					//Consultar Cheques
					$detalleCheque = IngresosCheques::model()->findAll("ingresos_id = $model->id");
					if (count($detalleCheque)>0) {
							?>
							
							<div class="row">
								<div class="span12">
									<table class="table table-striped">
										<tr>
											<th><small>Número</small></th>
											<th><small>Entidad</small></th>
											<th><small>Valor</small></th>
											<th><small>Fecha de Cobro</small></th>
										</tr>
									<?php 
										foreach ($detalleCheque as $detalle_cheque) 
										{
									?>
										<tr>
											<td><?php echo $detalle_cheque->numero; ?></td>
											<td><?php echo $detalle_cheque->entidad; ?></td>
											<td><?php echo number_format($detalle_cheque->valor,2); ?></td>
											<td><?php echo $detalle_cheque->f_cobro; ?></td>
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
		</div>
		<?php
	}
?>

<?php 
	//Tarjeta
	if ($model->forma_pago == "Tarjeta") {
		if ($model->tarjeta_banco_cuenta_id == NULL) 
		{
			$tarjetaBanco = "No Asignado";
			$tarjetaBancoNumero = "No Asignado";
		}
		else
		{
			$tarjetaBanco = $model->tarjetaBancoCuenta->idBanco->nombre;
			$tarjetaBancoNumero = $model->tarjetaBancoCuenta->numero;
		}
		?>
		<h3 class="text-center">Detalle de Tarjeta</h3>
		<div class="row">
			<div class="span4"></div>
			<div class="span4">
				<?php $this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'tarjeta_tipo',
						'tarjeta_aprobacion',
						'tarjeta_entidad',
						array('name'=>'Banco', 'value'=>$tarjetaBanco),
						array('name'=>'Cuenta', 'value'=>$tarjetaBancoNumero),
					),
				)); ?>
			</div>
			<div class="span4"></div>
		</div>
		<?php
	}
?>

<?php 
	//Consignación





	if ($model->forma_pago == "Consignación") {
		?>
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'consigna_banco_o',
				'consigna_cuenta_o',
				//'consigna_banco_d_cuenta_id',
				array('name'=>'Banco', 'value'=>$model->consignaBancoDCuenta->nombre,''),
				//array('name'=>'Cuenta', 'value'=>$model->consignaBancoDCuenta->bancosCuentases->numero,''),
			),
		)); ?>
		<?php
	}
?>


</div>

<?php if ($model->contrato_id != NULL): ?>
	
	<!-- Historial de Ingresos -->

	<div id="historial" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h3 id="myModalLabel2">Historial de Ingresos a Contrato </h3>
	   
	    	<table class="table table-striped">
				<tr>
					<th>Valor</th>
					<th>Descripción</th>
					<th>Forma de Pago</th>
					<th>Usuario</th>
					<th>Fecha</th>
				</tr>
			<?php $losPagos = Ingresos::model()->findAll("contrato_id = $model->contrato_id"); ?>
			<?php 
				$elTotal = 0;
				foreach ($losPagos as $los_pagos) 
				{
					?>
					<tr>
						<td><?php echo '$ '.number_format($los_pagos->valor,2); ?></td>
						<td><?php echo $los_pagos->descripcion; ?></td>
						<td><?php echo $los_pagos->forma_pago; ?></td>
						<td><?php echo $los_pagos->personal->nombreCompleto; ?></td>
						<td><?php echo $los_pagos->fecha; ?></td>
					</tr>
					<?php
					$elTotal = $elTotal + $los_pagos->valor;
				}
			?>
			</table>    	
	    
	    <div class="text-center"><h4>Total de Ingresos $ <?php echo number_format($elTotal,2); ?></h4></div>
	  </div>
	  <div class="modal-body">
	 	<!-- Evaluar politicas de cancelación -->
	 	
	  </div>
	  	
	   <div class="modal-footer">
	    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
	  </div>
	</div>
<?php endif ?>


<!-- Cancelar Ingreso -->
<div id="cancelar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel2">Cancelar Ingreso</h3>
  </div>
	<div class="modal-body text-center">
    	 	<h4>Para esta acción es necesario la clave de autorización</h4>
    	 	<?php 
			 	$form=$this->beginWidget('CActiveForm', array(
				'id'=>'seguimiento-comercial-form',
				'action'=>'index.php?r=ingresos/anular&id='.$model->id,
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>true,
			)); ?>
	    	 	<div class="input-prepend">
	    	 	<span class="controls">
					<label><b>Observación de Anulación</b></label>
	    	 		<textarea name="observacion_anular" id="observacion_anular" cols="60" rows="5"></textarea>
	    	 		<br><br>

	    	 		<span class="add-on"><i class="icon-lock"></i></span>
	    	 		<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
					<br><br>
	    	 	</span>
	    	 		<button class="btn btn-primary" type="submit">Proceder</button>
	    	 	</div>
    	 	<?php $this->endWidget(); ?>
    </div>
 	
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>