<?php
/* @var $this OrdenPedidoController */
/* @var $model OrdenPedido */


$this->menu=array(
	//array('label'=>'Listar Orden de Pedido', 'url'=>array('index')),
	array('label'=>'Crear Orden de Pedido', 'url'=>array('create')),
	array('label'=>'Actualizar Orden de Pedido', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Orden de Pedido', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Orden de Pedido', 'url'=>array('admin')),
);
?>

<h1>Orden de Pedido #<?php echo $model->id; ?></h1>

<div class="row">
<div class="span2"></div>
<div class="span8">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			array('name'=>"Personal que Entrega", 'value'=>$model->personalEntrega->nombreCompleto),
			array('name'=>"Personal que Recibe", 'value'=>$model->personalRecibe->nombreCompleto),
			'fecha',
			'observacion',
		),
	)); ?>
</div>
<div class="span2"></div>
</div>

<h3 class="text-center">Detalle de Pedido</h3>
<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<table class="table table-striped">
			<tr>
				<th>Tipo</th>
				<th>Detalle</th>
				<th>Area</th>
				<th>Cantidad</th>
			</tr>
		<?php $elPedido = OrdenPedidoDetalle::model()->findAll("orden_pedido_id = $model->id"); ?>
		<?php 
			foreach ($elPedido as $el_pedido) 
			{
				?>
				<tr>
					
					<td><?php echo $el_pedido->tipoOrdenPedido->tipo_corto; ?></td>
			
					<td><?php echo $el_pedido->producto->nombre_producto; ?></td>

					<td><?php echo $el_pedido->area; ?></td>

					<td><?php echo $el_pedido->cantidad; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
	</div>
	<div class="span2"></div>
	
</div>
