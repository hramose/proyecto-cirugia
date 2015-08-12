<?php
/* @var $this BancosController */
/* @var $model Bancos */

$this->menu=array(
	array('label'=>'Listar Bancos', 'url'=>array('index')),
	array('label'=>'Crear Banco', 'url'=>array('create')),
	array('label'=>'Actualizar Banco', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Bancos', 'url'=>array('admin')),
);
?>

<h1>Banco #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'nombre',
			),
		)); ?>
	</div>
	<div class="span2"></div>
</div>

<div class="row">
	<div class="span12"></div>
	<div class="span12 text-center">
		<h3>Cuentas de Banco</h3>		
	</div>
	<div class="span12">
		<div class="span4"></div>
		<div class="span4">
			<table class="table table-striped">
			<tr>
				<th>Cuenta</th>
				<th>Estado</th>
			</tr>
		<?php $lasCuentas = BancosCuentas::model()->findAll("id_banco = $model->id"); ?>
		<?php 
			foreach ($lasCuentas as $las_cuentas) 
			{
				?>
				<tr>
					<td><a href="index.php?r=BancosCuentas/view&id=<?php echo $las_cuentas->id; ?>"><?php echo $las_cuentas->numero; ?></a></td>
					<td><?php echo $las_cuentas->estado; ?></td>
				</tr>
				<?php
			}
		?>
		</table>
		</div>
		<div class="span4"></div>
	</div>
	<div class="span12 text-center">
		<a href="index.php?r=BancosCuentas/create&idBanco=<?php echo $model->id; ?>" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i> Ingresar N° de Cuenta</a>
	</div>
</div>