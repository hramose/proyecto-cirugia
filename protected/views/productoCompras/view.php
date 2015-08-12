<?php
/* @var $this ProductoComprasController */
/* @var $model ProductoCompras */

$this->menu=array(
	//array('label'=>'Listar Compras', 'url'=>array('index')),
	array('label'=>'Crear Compra', 'url'=>array('create')),
	//array('label'=>'Actualizar Compra', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Compra', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Compras', 'url'=>array('admin')),
);

//Para validar anular Compra
$bandera = 0;

?>

<h1>Compra #<?php echo $model->id; ?> - <?php echo $model->estado; ?></h1>

<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'producto_proveedor_id', 'value'=>$model->productoProveedor->nombre),
				array('name'=>'NIT', 'value'=>$model->productoProveedor->doc_nit),
				array('name'=>'Dirección', 'value'=>$model->productoProveedor->direccion),
				array('name'=>'Ciudad', 'value'=>$model->productoProveedor->ciudad),
				array('name'=>'Teléfono', 'value'=>$model->productoProveedor->telefono),
				'factura_n',
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy H:m:s",$model->fecha)),
			),
		)); ?>		
	</div>
	<div class="span6 text-center">
		<h4>Opciones</h4>
		<a href="#pagar" class="btn btn-warning" role="button" data-toggle="modal"><i class="icon-check icon-white"></i> Pagar/Abonar</a>
		<?php if ($bandera == 0): ?>
			<a href="#anular" class="btn btn-danger" role="button" data-toggle="modal"><i class="icon-remove icon-white"></i> Anular</a>
		<?php endif ?>
		<?php 
			$this->widget('ext.popup.JPopupWindow', array( 
					'tagName'=>'button',
					'content'=> '<i class="icon-file icon-white"></i> Imprimir ', 
					'url'=>array('productoCompras/imprimirCompra', 'id'=>$model->id),
					/*'url'=>array('/site/contact'), */
					'htmlOptions'=>array('class'=>'btn btn-info'),
					'options'=>array( 
					'height'=>700, 
					'width'=>800, 
					'top'=>50, 
					'left'=>50, 
					), 
					));
		?>
		<hr>
		
			<a href="#historial" class="btn btn-mini btn-primary" role="button" data-toggle="modal"><i class="icon-screenshot icon-white"></i> Historial de Abonos</a>
		
	</div>
	
</div>




<h3 class="text-center">Productos de Compra</h3>
<div class="row">
	<div class="span12">
		<table class="table table-striped">
			<tr>
				<th width="8%"><small>Codigo</small></th>
				<th width="25%"><small>Producto</small></th>
				<th width="12%"><small>Presentación</small></th>
				<th width="6%"><small>Cant.</small></th>
				<th width="8%"><small>Unidad Medida</small></th>
				<th width="7%"><small>Lote.</small></th>
				<th width="8%"><small>Vence</small></th>
				<th width="7%"><small>Valor</small></th>
				<th width="9%"><small>IVA</small></th>
				<th width="15%"><small>Total</small></th>
			</tr>
		<?php $losProductos = ProductoCompraDetalle::model()->findAll("producto_compra_id = $model->id"); ?>
		<?php 
			foreach ($losProductos as $los_productos) 
			{


				if ($los_productos->fecha_vencimiento == '0000-00-00') {
					$fecha_vencimiento = '--------';
				}
				else
				{
					$fecha_vencimiento = $los_productos->fecha_vencimiento=date('d-m-Y',strtotime($los_productos->fecha_vencimiento));	
				}

				?>
				<tr>
					<td><?php echo $los_productos->producto->producto_referencia; ?></td>
					<td><?php echo $los_productos->producto->nombre_producto; ?></td>
					<td><?php echo $los_productos->producto->productoPresentacion->presentacion; ?></td>
					<td><?php echo $los_productos->cantidad; ?></td>
					<td><?php echo $los_productos->producto->productoUnidadMedida->medida; ?></td>
					<td><?php echo $los_productos->lote; ?></td>
					<td><?php echo $fecha_vencimiento; ?></td>
					<td><?php echo '$ '.number_format($los_productos->valor,2); ?></td>
					<td><?php echo $los_productos->iva; ?></td>
					<td><?php echo '$ '.number_format($los_productos->total,2); ?></td>
				</tr>
				<?php
			//Comprobar Existencia en Inventario
				if ($los_productos->cantidad > $los_productos->producto->cantidad) 
				{
					$bandera = 1;
				}

			}
		?>
		</table>
	</div>
	<div class="span12">
		<div class="span2"></div>
		<div class="span4">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'descuento',
					'descuento_tipo',
					array('name'=>'descuento_valor', 'value'=>'$ '.number_format($model->descuento_valor,2)),
					array('name'=>'descuento_total', 'value'=>'$ '.number_format($model->descuento_total,2)),
				),
			)); ?>
		</div>
		<div class="span4">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'cantidad_productos',
					array('name'=>'total_orden', 'value'=>'$ '.number_format($model->total_orden,2)),
					array('name'=>'total', 'value'=>'$ '.number_format($model->total,2)),
					array('name'=>'total_compra', 'value'=>'$ '.number_format($model->total_compra,2)),
					array('name'=>'saldo', 'value'=>'$ '.number_format($model->saldo,2)),
				),
			)); ?>
		</div>
		<div class="span2"></div>
	</div>	
</div>

<hr>
<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'forma_pago',
				'iva',
				array('name'=>'iva_total', 'value'=>'$ '.number_format($model->iva_total,2)),
			),
		)); ?>
	</div>
	<div class="span5">
		<?php
		if($model->retencion_id != NULL)
		{
			$nombreRetencion = $model->laRetencion->retencion;
		}
		else
		{
			$nombreRetencion = "";
		}
			$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'retencion_id', 'value'=>$nombreRetencion),
				array('name'=>'retencion_retener', 'value'=>'$ '.number_format($model->retencion_retener,2)),
				array('name'=>'retencion_base', 'value'=>'$ '.number_format($model->retencion_base,2)),
				'retencion_porcentaje',

			),
		)); ?>
	</div>
	<div class="span1"></div>
</div>

<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'rte_iva_valor', 'value'=>'$ '.number_format($model->rte_iva_valor,2)),
				'rte_ica_porcentaje',
				array('name'=>'rte_ica_valor', 'value'=>'$ '.number_format($model->rte_ica_valor,2)),
				array('name'=>'total_compra', 'value'=>'$ '.number_format($model->total_compra,2)),
				array('name'=>'centro_costo_id', 'value'=>$model->centroCosto->nombre),
				array('name'=>'personal_id', 'value'=>$model->personal->nombreCompleto),
			),
		)); ?>
	</div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'total_compra',
				array('name'=>'centro_costo_id', 'value'=>$model->centroCosto->nombre),
				array('name'=>'personal_id', 'value'=>$model->personal->nombreCompleto),
			),
		)); ?>
	</div>
	<div class="span1"></div>
</div>


<!-- Ventanas Modales -->
<div id="anular" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Anular Compra </h3>
  </div>
  <div class="modal-body">
  	<?php if ($bandera == 0){ ?>
  		
 	 <form id="frmAnular" name="frmAnular" action="index.php?r=productoCompras/anular&idCompra=<?php echo $model->id;?>" method = "post">
  		<div class="span12">
			<label>Motivo:</label>
			  	<textarea rows='4' class = 'input-xxlarge' placeholder='Detalle el motivo de anular compra' name ='observaciones' id='observaciones'></textarea>
  		</div>
  		<div class="span12">
	  		<h4>Ingrese clave de autorización para anular esta compra</h4>
	  		<div class="input-prepend">
		 	<span class="add-on"><i class="icon-lock"></i></span>
	 		<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario" autocomplete="off">
	 	</div>
			<br><br>

	 		<button class="btn btn-primary" type="submit">Proceder</button>
  		</div>
  	</form>	
  	<?php }else{ ?>
		<h3>Se ha afectado el inventario de esta compra, no sera posible anularla.</h3>
  	<?php } ?>

 	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<div id="pagar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel1">Pagar / Abonar Cuenta</h3>
  </div>
  <div class="modal-body">
  	<form id="pagoCxp" name="pagoCxp" action="index.php?r=productoCompras/pago&idCompra=<?php echo $model->id;?>" method = "post">
  		<div class="span12">
			<label>Saldo (actual):</label>
			<input type="text" name="saldo" id="saldo" class="input-small" readOnly = "true" value = "<?php echo $model->saldo; ?>">
  		</div>

  		<div class="span5">
  			<label>Valor a Pagar:</label>
			<input type="text" name="pago" id="pago" class="input-small">
			<p class="text-error" id="error_saldo" style="display: none">Pago supera el saldo</p>
  		</div>

  		<div class="span5">
  			<label>Resta por Pagar:</label>
			<input type="text" name="resto" id="resto" class="input-small" readOnly = "true">
  		</div>

  		<div class="span12">
			<label>Comentario:</label>
			  	<textarea rows='4' class = 'input-xxlarge' placeholder='Comentario' name ='comentario' id='comentario'></textarea>
  		</div>
  		<div class="span12">
  			<input type="submit" value="Guardar" name="guardar" id="guardar" class="btn btn-warning">
  		 </div>
  	</form>	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>

<div id="historial" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel2">Historial de Abonos a Cuenta </h3>
    <div class="span12">
    	<table class="table table-striped">
			<tr>
				<th>Pago</th>
				<th>Comentario</th>
				<th>Ingresado por</th>
				<th>Fecha</th>
			</tr>
		<?php $losPagos = PagosCxp::model()->findAll("producto_compra_id = $model->id"); ?>
		<?php 
			foreach ($losPagos as $los_pagos) 
			{
				?>
				<tr>
					<td><?php echo $los_pagos->pago; ?></td>
					<td><?php echo $los_pagos->comentario; ?></td>
					<td><?php echo $los_pagos->personal->nombreCompleto; ?></td>
					<td><?php echo $los_pagos->fecha; ?></td>
				</tr>
				<?php
			}
		?>
		</table>    	
    </div>
  </div>
  <div class="modal-body">
 	<!-- Evaluar politicas de cancelación -->
 	
  </div>
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#pago").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    var elPago = parseFloat($("#pago").val());
	    var elSaldo = parseFloat($("#saldo").val());
	    if(elPago > elSaldo)
	    	{
	    		$("#guardar").prop('disabled', true);
	    		$("#error_saldo").toggle();
	    	}
	    else
	    	{
	    		$("#resto").val(elSaldo-elPago);
	    		$("#guardar").prop('disabled', false);
	    		$("#error_saldo").hide();
	    	}
	});
	});
</script>