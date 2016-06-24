<?php
/* @var $this LineaServicioController */
/* @var $model LineaServicio */

$this->menu=array(
	array('label'=>'Listar Linea de Servicio', 'url'=>array('index')),
	array('label'=>'Crear Linea de Servicio', 'visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Actualizar Linea de Servicio', 'visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Linea de Servicio', 'url'=>array('admin')),
);
?>

<h1>Linea de Servicio #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'nombre',
				'tipo.nombre',
				'precio',
				'precio_pago',
				'insumo',
				'estado',
				'porcentaje',
				'restringido',
			),
		)); ?>
	</div>
	<div class="span6">
		<h4 class="text-center">Equipo Vinculado a Linea de Servicio</h4>
		<?php 
			if ($model->equipo_id == null) {
				echo "<p class='text-center'>Ninguno</p>";
			}
			else
			{
				$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					array('name'=>'equipo_id', 'value'=>$model->equipos->nombre),
				),
				)); 
			}
			
		?>
	</div>
</div>