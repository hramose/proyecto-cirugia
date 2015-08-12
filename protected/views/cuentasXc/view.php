<?php
/* @var $this CuentasXcController */
/* @var $model CuentasXc */

$this->menu=array(
	//array('label'=>'List CuentasXc', 'url'=>array('index')),
	//array('label'=>'Create CuentasXc', 'url'=>array('create')),
	//array('label'=>'Update CuentasXc', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete CuentasXc', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Cuentas por Cobrar', 'url'=>array('admin')),
);
?>

<h1>Cuenta por Cobrar - <?php echo $model->paciente->nombreCompleto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name'=>'Nombre', 'value'=>$model->paciente->nombreCompleto,''),
		'n_identificacion',
		array('name'=>'saldo', 'value'=>'$ '.number_format($model->saldo,2)),
	),
)); ?>

<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<h2 class="text-center">Detalle de Cuentas por Cobrar</h2>
		<table class="table table-striped">
			<tr>
				<th>Contrato</th>
				<th>Linea de Servicio</th>
				<th>Saldo</th>
				<th></th>
			</tr>
			<?php $lasCuentas = CuentasXcDetalle::model()->findAll("cuentas_xc_id = $model->id and saldo > 0"); ?>
			<?php 
				foreach ($lasCuentas as $las_cuentas) 
				{
					?>
					<tr>
						<td><?php echo $las_cuentas->contrato_id; ?></td>
						<?php 
							if ($las_cuentas->linea_servicio_id == null) {
							?>
							<td><?php echo ""; ?></td>		
							<?php
							}
							else
							{
							?>
							<td><?php echo $las_cuentas->linea->nombre; ?></td>		
							<?php
							}
						 ?>
						
						<td><?php echo "$ ".number_format($las_cuentas->saldo,2); ?></td>
						<td>
							<?php 
							if ($las_cuentas->linea_servicio_id == null) {
								?>
									<a href="index.php?r=contratos/view&id=<?php echo $las_cuentas->contrato_id; ?>" role="button" class="btn btn-small btn-success" data-toggle="modal">Ver</a>	
								<?php
							}
							?>

							<?php 
							if ($las_cuentas->contrato_id == null) {
								?>
									<a href="index.php?r=citas/view&id=<?php echo $las_cuentas->cita_id; ?>" role="button" class="btn btn-small btn-success" data-toggle="modal">Ver</a>	
								<?php
							}
							?>
							
						</td>
					</tr>
					<?php
				}
			?>
		</table>		
	</div>
	<div class="span2"></div>
	
</div>
