<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->menu=array(
	//array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Crear Promociones', 'url'=>array('create')),
	array('label'=>'Actualizar Promociones', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Promociones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Promociones', 'url'=>array('admin')),
);
?>

<h2>Promoción: <?php echo $model->titulo_promocion; ?></h2>

<div class="row">
	<div class="span1"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'titulo_promocion',
				array('name'=>'fecha_inicio', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha_inicio),''),
				array('name'=>'fecha_fin', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->fecha_fin),''),
			),
		)); ?>
	</div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'estado',
				array('name'=>'Usuario que la creo', 'value'=>$model->usuario->nombreCompleto),
				array('name'=>'fecha_creacion', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$model->fecha_creacion),''),
			),
		)); ?>
	</div>
</div>

<style>
	#anuncios table{
    width:90%;
    border-collapse: collapse; 
    border:black 1px solid;  
	}

	#anuncios tr {
  	border: black 1px solid;
	}

	#anuncios td {
  	border: black 1px solid;
	}
</style>
	<h3>Detalle de Promoción</h3>
	<p><small>Comienza vista de promoción</small></p>
	<hr>
	<div id="anuncios">
		<?php echo $model->promocion; ?>
	</div>
		

