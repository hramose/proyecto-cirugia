<?php

//Datos de Contrato e Ingreso
$elContrato = Contratos::model()->findByPk($_GET['idContrato']);
if (isset($_GET['idIngreso'])) 
{
	$elIngreso = Ingresos::model()->findByPk($_GET['idIngreso']);
}
if (isset($_GET['idNota'])) 
{
	$elIngreso = NotaCredito::model()->findByPk($_GET['idNota']);
}



$this->menu=array(
	//array('label'=>'Listar Contrato', 'url'=>array('index')),
	//array('label'=>'Actualizar Contrato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Contratos', 'url'=>array('admin')),
);
?>
<h1>Vincular Ingreso a Contrato</h1>
<div class="row">
	<div class="span12"></div>
</div>

<h5>Se dispone a vincular el ingreso de <span class="text-info">$ <?php echo number_format($elIngreso->valor,2); ?></span> a contrato con un saldo de <span class="text-error">$ <?php echo number_format($elContrato->saldo,2); ?></span>.</h5>
<h3>Nuevo saldo despues de la vinculación: <span class="text-warning">$ <?php echo number_format(($elContrato->saldo - $elIngreso->valor),2) ?></span></h3>

<div class="row">
	<div class="span2"></div>
	<div class="span4 text-center">
		<?php 
			if (isset($_GET['idIngreso'])) 
			{
				?>
					<a href="index.php?r=contratos/vincular&idIngreso=<?php echo $elIngreso->id; ?>&idContrato=<?php echo $elContrato->id; ?>&confirmado=1" class="btn btn-large btn-primary"><i class="icon-thumbs-up icon-white"></i> Aprobar</a>
				<?php
			}
			if (isset($_GET['idNota'])) 
			{
				?>
					<a href="index.php?r=contratos/vincularNota&idNota=<?php echo $elIngreso->id; ?>&idContrato=<?php echo $elContrato->id; ?>&confirmado=1" class="btn btn-large btn-primary"><i class="icon-thumbs-up icon-white"></i> Aprobar</a>
				<?php
			}
		?>
		
	</div>
	<div class="span4 text-center">
		<a href="index.php?r=contratos/view&id=<?php echo $elContrato->id; ?>" class="btn btn-large btn-inverse"><i class="icon-thumbs-down icon-white"></i> Cancelar</a>
	</div>
	<div class="span2"></div>
</div>
