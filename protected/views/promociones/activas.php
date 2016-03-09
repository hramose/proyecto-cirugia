<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->menu=array(
	//array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Crear Promociones', 'url'=>array('create')),
	//array('label'=>'Actualizar Promociones', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Promociones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Promociones Activas', 'url'=>array('admin', 'estado'=>'Activa')),
	array('label'=>'Buscar Promociones Vencidas', 'url'=>array('admin', 'estado'=>'Vencida')),
);

$lasActivas = Promociones::model()->findAll("estado = 'Activa'");

?>


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
	<h2>Promociones Activas</h2>
	<hr>
	<?php

	if (!$lasActivas) 
	{
		echo "<h4 class='text-error'>No hay promociones activas</h4>";
	}

	foreach ($lasActivas as $las_activas) 
	{
		?>
		<div id="anuncios">
			<h4><?php echo $las_activas->titulo_promocion; ?> - <a href="index.php?r=Promociones/view&id=<?php echo $las_activas->id; ?>" role="button" class="btn btn-success"><i class="icon-eye-open icon-white"></i> Ver Completa</a></h4>
			<h4>Valida del: <?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_activas->fecha_inicio); ?> al <?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_activas->fecha_fin); ?></h4>
			<?php echo $las_activas->promocion; ?>
		</div>
		<br><br><hr>
		<?php
	}
	?>
	
		

