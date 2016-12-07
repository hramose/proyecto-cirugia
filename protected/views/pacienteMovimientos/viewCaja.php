<?php
/* @var $this PacienteMovimientosController */
/* @var $model PacienteMovimientos */

$this->menu=array(
	//array('label'=>'List PacienteMovimientos', 'url'=>array('index')),
	//array('label'=>'Create PacienteMovimientos', 'url'=>array('create')),
	//array('label'=>'Update PacienteMovimientos', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete PacienteMovimientos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Caja', 'url'=>'index.php?r=paciente/cajas'),
);

//Consultas

$detalleMovimientos = PacienteMovimientos::model()->findAll("paciente_id = $model->id");

?>

<h1>Caja de Paciente #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span5 text-center">
		<img class="img" src="images/MoneyTransfer.png"/>
		<h2 class = "text-center"><div class="text-info">Saldo $ <?php echo number_format($model->saldo,2); ?></div></h2>
		<a href="index.php?r=paciente/depositoPaciente&idPaciente=<?php echo $model->id;?>" class="btn btn-small btn-warning"><i class="icon-random icon-white"></i> Transferir Saldo a Paciente</a>
	</div>
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'paciente_id', 'value'=>$model->nombreCompleto,''),
				array('name'=>'Cedula', 'value'=>$model->n_identificacion,''),
				array('name'=>'Dirección', 'value'=>$model->direccion, ''),
				array('name'=>'Celular', 'value'=>$model->celular, ''),
			),
		)); ?>
		<a href="index.php?r=paciente/view&id=<?php echo $model->id;?>" class="btn btn-mini btn-success"><i class="icon-user icon-white"></i> Ver Paciente</a>
		<!-- Contratos -->
		<?php 
			$losContratos = Contratos::model()->findAll("paciente_id = $model->id and saldo > 0");
			if ($losContratos) 
			{
				echo "<h5 class='text-center'>Contratos con Saldo Pendiente</h5>";
				?>
				<table class="table">
					<tr>
						<th>No.</th>
						<th>Saldo.</th>
						<th></th>
					</tr>
					<?php 
						foreach ($losContratos as $los_contratos) 
						{
							?>
							<tr>
								<td><?php echo $los_contratos->id; ?></td>
								<td><?php echo "$ ".number_format($los_contratos->saldo,2); ?></td>
								<td><a href="index.php?r=contratos/view&id=<?php echo $los_contratos->id; ?>">[Ver]</a></td>
							</tr>
							<?php
						}
					?>
				</table>
				<?php
			}
		?>
	</div>
</div>

<div class="row">
	<div class="span11">
		<h2 class="text-center">Historial de movimientos</h2>
	</div>
	
	<div class="span11">
		<table class="table table-striped">
			<tr>
				<th width="10%">Monto</th>
				<th width="5%">Tipo</th>
				<th width="15%">Sub Tipo</th>
				<th width="40%">Descripción</th>
				<th>Fecha</th>
				<th>Usuario</th>
				<th></th>
			</tr>
			<?php
				foreach ($detalleMovimientos as $detalle_movimientos) 
				{
					if ($detalle_movimientos->tipo == "Ingreso") {
						?>
					<tr class="success">
						<td><?php echo "$ ".number_format($detalle_movimientos->valor,2); ?></td>
						<td><?php echo $detalle_movimientos->tipo; ?></td>
						<td><?php echo $detalle_movimientos->sub_tipo; ?></td>
						<td><?php echo $detalle_movimientos->descripcion; ?></td>
						<td><small><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$detalle_movimientos->fecha); ?></small></td>
						<td><?php echo $detalle_movimientos->personal->nombreCompleto; ?></td>
						<td><a href="index.php?r=pacienteMovimientos/view&id=<?php echo $detalle_movimientos->id;?>">[Ver]</a></td>
					</tr>
					<?php
					}

					if ($detalle_movimientos->tipo == "Egreso") {
						?>
					<tr class="error">
						<td><?php echo "$ ".number_format($detalle_movimientos->valor,2); ?></td>
						<td><?php echo $detalle_movimientos->tipo; ?></td>
						<td><?php echo $detalle_movimientos->sub_tipo; ?></td>
						<td><?php echo $detalle_movimientos->descripcion; ?></td>
						<td><small><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$detalle_movimientos->fecha); ?></small></td>
						<td><?php echo $detalle_movimientos->personal->nombreCompleto; ?></td>
						<td><a href="index.php?r=pacienteMovimientos/view&id=<?php echo $detalle_movimientos->id;?>">[Ver]</a></td>
					</tr>
					<?php
					}
					if ($detalle_movimientos->tipo == "Anulado") {
						?>
					<tr class="error">
						<td><?php echo "$ ".number_format($detalle_movimientos->valor,2); ?></td>
						<td><?php echo $detalle_movimientos->tipo; ?></td>
						<td><?php echo $detalle_movimientos->sub_tipo; ?></td>
						<td><?php echo $detalle_movimientos->descripcion; ?></td>
						<td><small><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$detalle_movimientos->fecha); ?></small></td>
						<td><?php echo $detalle_movimientos->personal->nombreCompleto; ?></td>
						<td><a href="index.php?r=pacienteMovimientos/view&id=<?php echo $detalle_movimientos->id;?>">[Ver]</a></td>
					</tr>
					<?php
					}
				}
			?>
		</table>
	</div>
</div>

