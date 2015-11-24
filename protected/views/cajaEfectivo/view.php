<?php
/* @var $this CajaEfectivoController */
/* @var $model CajaEfectivo */

$this->menu=array(
	array('label'=>'Listar Saldos', 'url'=>array('index')),
	//array('label'=>'Create CajaEfectivo', 'url'=>array('create')),
	//array('label'=>'Update CajaEfectivo', 'url'=>array('update', 'id'=>$model->personal_id)),
	//array('label'=>'Delete CajaEfectivo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->personal_id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage CajaEfectivo', 'url'=>array('admin')),
);
?>

<h1>Saldo de Caja: <span class="text-error"><?php echo $model->personal->nombreCompleto; ?></span></h1>

<div class="row">
	<div class="span12">
		<div class="text-center">
			<h2>Total ($): <span class="text-info"><?php echo number_format($model->total,2); ?></span></h2>
			<small>Esta información corresponde al balance generado hasta el día:</small>
			<p><b><?php echo date("d-m-Y"); ?></b></p>
			<small>a las:</small>
			<p><b><?php echo date("H:i:s"); ?></b></p>
		</div>
	</div>
</div>
<hr>

<h3 class="text-center">Detalle de Movimientos</h3>

<div class="row">
	<div class="span6">
		<h4 class="text-center">Ingresos</h4>
		<table class="table table-striped">
			<tr>
				<th>Monto</th>
				<th>Tipo</th>
				<th>Paciente</th>
				<th>Contrato</th>
				<th>Fecha</th>
			</tr>
		<?php $losMovimientos = CajaEfectivoDetalle::model()->findAll("caja_efectivo_id = $model->personal_id and (ingreso_id is not Null or (tipo = 'Venta' or tipo = 'Venta Anulada'))") ?>
		<?php 
			foreach ($losMovimientos as $los_movimientos)
			{
				?>
				<tr>
					<?php
						if ($los_movimientos->ingreso_id != "") {
							?>
							<td><small><a href="index.php?r=ingresos/view&id=<?php echo $los_movimientos->ingreso->id;?>"><?php echo '$ '.number_format($los_movimientos->monto,2); ?></a></small></td>
							<?php
						}
						if ($los_movimientos->venta_id != "") {
							?>
							<td><small><a href="index.php?r=ventas/view&id=<?php echo $los_movimientos->venta->id;?>"><?php echo '$ '.number_format($los_movimientos->monto,2); ?></a></small></td>
							<?php
						}
					?>
					
					<td><small><?php echo $los_movimientos->tipo; ?></small></td>
					<?php
					if ($los_movimientos->egreso_id != "") {
							?>
								<td><small><?php echo $los_movimientos->ingreso->paciente->nombreCompleto; ?></small></td>
								<td><small><?php echo $los_movimientos->ingreso->contrato_id; ?></small></td>
							<?php
						}

						if ($los_movimientos->venta_id != "") {
							?>
								<td><small><?php echo $los_movimientos->venta->paciente->nombreCompleto; ?></small></td>
								<td><small></small></td>
							<?php
						}
					?>
					
					<td><small><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy H:m:s", $los_movimientos->fecha); ?></small></td>
					<!-- <td>[Ver]</td> -->
				</tr>
				<?php
			}
		?>
		</table>
	</div>
	<div class="span6">
		<h4 class="text-center">Egresos</h4>
		<table class="table table-striped">
			<tr>
				<th>Monto</th>
				<th>Tipo</th>
				<th>N°</th>
				<th>Fecha</th>
			</tr>
		<?php $losMovimientos = CajaEfectivoDetalle::model()->findAll("caja_efectivo_id = $model->personal_id and egreso_id != ''") ?>
		<?php 
			foreach ($losMovimientos as $los_movimientos)
			{
				?>
				<tr>
					<td><small><a href="index.php?r=egresos/view&id=<?php echo $los_movimientos->egreso->id;?>"><?php echo '$ '.number_format($los_movimientos->monto,2); ?></a></small></td>
					<td><small><?php echo $los_movimientos->tipo; ?></small></td>
					<td><small><?php echo $los_movimientos->egreso->id; ?></small></td>
					<td><small><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy H:m:s", $los_movimientos->fecha); ?></small></td>
					<!-- <td>[Ver]</td> -->
				</tr>
				<?php
			}
		?>
		</table>
	</div>	
</div>