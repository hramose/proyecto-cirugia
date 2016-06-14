<?php
/* @var $this ContratosController */
/* @var $model Contratos */

$this->menu=array(
	//array('label'=>'Listar Contrato', 'url'=>array('index')),
	//array('label'=>'Actualizar Contrato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Contratos', 'url'=>array('admin')),
);
?>

<h1>Primera Vez que visitan y contratan servicio</h1>

<?php 
	$total = 0;
	foreach ($model as $el_Modelo) 
	{
		$total = $total + $el_Modelo["ctotal"];
	}
?>
<div class="row">
	<div class="span6 text-center">
		<h3 class="text-success">Pacientes que contrataron servicios</h3>
			<img  src="images/manos.png"/>
		<h2>
			<?php echo count($model); ?>
		</h2>
		<h4>Vrs.</h4>
		<h4 class="text-error">Evaluaciones Atendidas <?php echo count($lascitas); ?></h4>
		<a href="index.php?r=estadisticas/ExportarPrimeraVisita" class="btn btn-primary">Exportar</a>
	</div>
	<div class="span6 text-center">
		<h3 class="text-info">Total de ingreso por estos contratos</h3>
			<img  src="images/MoneyTransfer.png"/>
		<h2><?php echo "$".number_format($total,2); ?></h2>
	</div>
</div>