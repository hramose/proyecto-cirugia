<?php
/* @var $this RelacionHojaGastosController */
/* @var $model RelacionHojaGastos */

$this->menu=array(
	array('label'=>'Buscar Relación Hoja de Gastos', 'url'=>array('admin')),
);
$titulo = $model->hoja;

//Los productos
if ($model->hoja == "Hoja de Gastos") 
{
	$lahoja = HojaGastos::model()->find("cita_id = $model->cita_id");
	$detalleHoja = HojaGastosDetalle::model()->findAll("hoja_gastos_id = $lahoja->id");
}

if ($model->hoja == "Hoja de Gastos Cirugia") 
{
	$lahoja = HojaGastosCirugia::model()->find("cita_id = $model->cita_id");
	$detalleHoja = HojaGastosCirugiaDetalle::model()->findAll("hoja_gastos_cirugia_id = $lahoja->id");
}


?>

<h1>Relación Hoja de Gastos #<?php echo $model->id; ?></h1>

<div class = "row">
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'paciente_id', 'value'=>$model->paciente->nombreCompleto,''),
				'hoja',
				array('name'=>'asistencial_id', 'value'=>$model->asistencial->nombreCompleto,''),
				'cita_id',
			),
		)); ?>
	</div>
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name'=>'linea_servicio_id', 'value'=>$model->lineaServicio->nombre,''),
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha)),
				array('name'=>'costo', 'value'=>"$ ".number_format($model->costo,2)),
				array('name'=>'personal_id', 'value'=>$model->personal->nombreCompleto,''),
			),
		)); ?>
	</div>
</div>

<div class="row">
	<h4 class="text-center">Detalles de <?php echo $titulo; ?></h4>
	<div class="span1"></div>
	<div class="span10">
		<table class="table">
			<tr>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>U. Medida</th>
				<th>Precio</th>
			</tr>
		<?php 
		foreach ($detalleHoja as $detalle_hoja) 
		{
			?>
			<tr>
				<td><?php echo $detalle_hoja->producto->nombre_producto; ?></td>
				<td><?php echo $detalle_hoja->cantidad; ?></td>
				<td><?php echo $detalle_hoja->producto->productoUnidadMedida->medida; ?></td>
				<td><?php echo $detalle_hoja->producto->precio_publico; ?></td>
			</tr>
			<?php
		}
		?>
		</table>
	</div>
	<div class="span1"></div>
</div>