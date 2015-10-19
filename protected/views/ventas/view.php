<?php
/* @var $this VentasController */
/* @var $model Ventas */

$this->menu=array(
	//array('label'=>'Listar Ventas', 'url'=>array('index')),
	array('label'=>'Crear Ventas', 'url'=>array('create')),
	//array('label'=>'Actualizar Ventas', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Ventas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Ventas', 'url'=>array('admin')),
);
?>

<h1>Venta #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span4">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'paciente_id', 'value'=>$model->paciente->n_identificacion,''),
				array('name'=>'Nombre', 'value'=>$model->paciente->nombreCompleto,''),
				array('name'=>'Dirección', 'value'=>$model->paciente->direccion,''),
				array('name'=>'Ciudad', 'value'=>$model->paciente->ciudad,''),
				array('name'=>'Teléfono', 'value'=>$model->paciente->telefono1,''),
			),
		)); ?>

		<br>
		<table class="table">
			<tr>
				<th>Descripción del Egreso</th>
			</tr>
			<tr>
				<td><?php echo $model->descripcion; ?></td>
			</tr>
		</table>
		<br>
		<table class="table">
			<tr>
				<th>Venta creada por :</th>
			</tr>
			<tr>
				<td><?php echo $model->personal0->nombreCompleto; ?></td>
			</tr>
		</table>
		<div class="text-center">
			<?php 
				$this->widget('ext.popup.JPopupWindow', array( 
						'tagName'=>'button',
						'content'=> '<i class="icon-file icon-white"></i> Imprimir ', 
						'url'=>array('ventas/imprimirVentas', 'id'=>$model->id),
						/*'url'=>array('/site/contact'), */
						'htmlOptions'=>array('class'=>'btn btn-info btn-mini'),
						'options'=>array( 
						'height'=>700, 
						'width'=>800, 
						'top'=>50, 
						'left'=>50, 
						), 
						));

				//Boton de anulación de venta
				
			?>
		</div>
	</div>

	<!-- Otra parte -->
	<div class="span8">
		<h4 class="text-center">Detalles de la Venta</h4>
		<table class="table table-striped">
			<tr>
				<th>Producto</th>
				<th>Presentacion</th>
				<th>Cantidad</th>
				<th>Valor</th>
				<th>IVA</th>
				<th>Total</th>

			</tr>
			<?php $losProductos = VentasDetalle::model()->findAll("venta_id = $model->id"); ?>
			<?php 
				foreach ($losProductos as $los_productos) 
				{
					?>
					<tr>
						<td><?php echo $los_productos->producto->nombre_producto; ?></td>
						<td><?php echo $los_productos->producto->productoPresentacion->presentacion; ?></td>
						<td><?php echo $los_productos->cantidad; ?></td>
						<td><?php echo '$ '.number_format($los_productos->valor,2); ?></td>
						<td><?php echo $los_productos->iva; ?></td>
						<td><?php echo '$ '.number_format($los_productos->total,2); ?></td>
					</tr>
					<?php
				}
			?>
		</table>
		<br>
		<table class="table">
			<tr>
				<th>Cant. Productos</th>
				<th>Desc.</th>
				<th>V. Desc.</th>
				<th>Total Desc.</th>
				<th>Subtotal</th>
				<th>IVA</th>
			</tr>
			<tr>
				<td><?php echo $model->cant_productos; ?></td>
				<td><?php echo $model->descuento; ?></td>
				<td><?php echo '$ '.number_format($model->descuento_valor,2); ?></td>
				<td><?php echo '$ '.number_format($model->descuento_total,2); ?></td>
				<td><?php echo '$ '.number_format($model->sub_total,2); ?></td>
				<td><?php echo '$ '.number_format($model->total_iva,2); ?></td>
			</tr>
		</table>
		<br>
		<table class="table">
			<tr>
				<th>TOTAL VENTA</th>
				<th>RECIBIDO</th>
				<th>CAMBIO</th>
				<th>FORMA DE PAGO</th>
				<th>DIAS</th>
				<th>FECHA VENCIMIENTO</th>
			</tr>
			<tr>
				<td><?php echo '$ '.number_format($model->total_venta,2); ?></td>
				<td><?php echo '$ '.number_format($model->dinero_recibido,2); ?></td>
				<td><?php echo '$ '.number_format($model->dinero_cambio,2); ?></td>
				<td><?php echo $model->forma_pago; ?></td>
				<td><?php echo $model->credito_dias; ?></td>
				<?php 
					if ($model->credito_fecha == '0000-00-00') {
						$fechaCredito = "";
					}
					else
					{
						$fechaCredito = Yii::app()->dateformatter->format("dd-MM-yyyy",$model->credito_fecha);
					}
				?>
				<td><?php echo $fechaCredito; ?></td>
			</tr>
		</table>
		<?php if ($model->forma_pago != "Efectivo") {?> <h4 class="text-center">Detalles de Transacción</h4> <?php }	?>
		
		<?php if ($model->forma_pago == "Tarjeta") {
			?>
				<table class="table">
					<tr>
						<th>Tipo de Tarjeta</th>
						<th>N. Aprobación</th>
						<th>Entidad</th>
						<th>Banco Destino</th>
						<th>Cuenta Destino</th>
					</tr>
					<tr>
						<td><?php echo $model->tarjeta_tipo; ?></td>
						<td><?php echo $model->tarjeta_aprobacion; ?></td>
						<td><?php echo $model->tarjeta_entidad; ?></td>
						<td><?php echo $model->tarjetaCuentaBanco->idBanco->nombre; ?></td>
						<td><?php echo $model->tarjetaCuentaBanco->numero; ?></td>
					</tr>
				</table>
			<?php
		} ?>


		<?php if ($model->forma_pago == "Cheque") {
			?>
				<table class="table table-striped">
					<tr>
						<th>Cheque Número</th>
						<th>Entidad</th>
						<th>Valor</th>
						<th>F. Cobro</th>
						<th>Banco</th>
						<th>Cuenta</th>

					</tr>
					<?php $losCheques = VentasCheques::model()->findAll("ventas_id = $model->id"); ?>
					<?php 
						foreach ($losCheques as $los_cheques) 
						{
							?>
							<tr>
								<td><?php echo $los_cheques->numero; ?></td>
								<td><?php echo $los_cheques->entidad; ?></td>
								<td><?php echo '$ '. number_format($los_cheques->valor,2); ?></td>
								<td><?php echo $los_cheques->f_cobro; ?></td>
								<td><?php echo $model->chequesCuentaBanco->idBanco->nombre; ?></td>
								<td><?php echo $model->chequesCuentaBanco->numero; ?></td>
							</tr>
							<?php
						}
					?>
				</table>
			<?php
		} ?>
		
	</div>
</div>

<?php //$this->widget('zii.widgets.CDetailView', array(
// 	'data'=>$model,
// 	'attributes'=>array(
// 		'id',
// 		'paciente_id',
// 		'descripcion',
// 		'sub_total',
// 		'total_iva',
// 		'descuento',
// 		'descuento_tipo',
// 		'descuento_valor',
// 		'descuento_total',
// 		'cant_productos',
// 		'total_orden',
// 		'forma_pago',
// 		'dinero_recibido',
// 		'dinero_cambio',
// 		'total_venta',
// 		'credito_dias',
// 		'credito_fecha',
// 		'cheques_cantidad',
// 		'cheques_cuenta_banco',
// 		'tarjeta_tipo',
// 		'tarjeta_aprobacion',
// 		'tarjeta_entidad',
// 		'tarjeta_cuenta_banco',
// 		'consignacion_cuenta_banco',
// 		'consignacion_banco',
// 		'consignacion_cuenta',
// 		'personal',
// 		'fecha_hora',
// 		'fecha',
// 		'estado',
// 	),
// )); ?>
