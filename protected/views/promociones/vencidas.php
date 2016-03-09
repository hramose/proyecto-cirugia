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

$lasVencidas = Promociones::model()->findAll("estado = 'Vencida'");

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
	<h2>Promociones Vencidas</h2>
	<hr>

	<?php

	if (!$lasVencidas) 
	{
		echo "<h4 class='text-error'>No hay promociones vencidas</h4>";
	}

	foreach ($lasVencidas as $las_vencidas) 
	{
		?>
		<div id="anuncios">
			<h4><?php echo $las_vencidas->titulo_promocion; ?> - <a href="index.php?r=Promociones/view&id=<?php echo $las_vencidas->id; ?>" role="button" class="btn btn-success">Ver Completa</a></h4>
			<h4>Valida del: <?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_vencidas->fecha_inicio); ?> al <?php echo Yii::app()->dateformatter->format("dd-MM-yyyy",$las_vencidas->fecha_fin); ?></h4>
			<?php echo $las_vencidas->promocion; ?>
		</div>
		<br><br><hr>
		<?php
	}
	?>
	
		

