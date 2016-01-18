<?php
/* @var $this InventarioPersonalController */
/* @var $model InventarioPersonal */

if (Yii::app()->user->perfil != 2) {
	$this->menu=array(
		//array('label'=>'Listar Inventario Personal', 'url'=>array('index')),
		array('label'=>'Crear Inventario Personal', 'url'=>array('create')),
		array('label'=>'Actualizar', 'url'=>array('update', 'id'=>$model->personal_id)),
		//array('label'=>'Borrar Inventario Personal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->personal_id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Buscar Inventario Personal', 'url'=>array('admin')),
	);

}

?>

<h1>Inventario Personal #<?php echo $model->personal_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'personal.nombreCompleto',
		//'comentario',
	),
)); ?>

<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<h4 class="text-center">Productos en el inventario</h4>
		<table class="table table-striped">
			<tr>
				<th>Producto</th>
				<th>Presentacion</th>
				<th>Cantidad</th>
			</tr>
			<?php $losProductos = InventarioPersonalDetalle::model()->findAll("inventario_personal_id = $model->personal_id"); ?>
			<?php 
				foreach ($losProductos as $los_productos) 
				{
					?>
					<tr>
						<td><?php echo $los_productos->producto->nombre_producto; ?></td>
						<td><?php echo $los_productos->producto->productoPresentacion->presentacion; ?></td>
						<td><?php echo $los_productos->cantidad; ?></td>
					</tr>
					<?php
				}
			?>
		</table>
	</div>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'comentario',
	),
)); ?>