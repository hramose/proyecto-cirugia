<?php
/* @var $this BancosCuentasController */
/* @var $model BancosCuentas */

$this->menu=array(
	//array('label'=>'Listar Cuentas de Banco', 'url'=>array('index')),
	//array('label'=>'Crear Cuentas de Banco', 'url'=>array('create')),
	array('label'=>'Actualizar Cuentas de Banco', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Cuentas de Banco', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Buscar Cuentas de Banco', 'url'=>array('admin')),
);
?>

<h1>Cuentas de Banco #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name'=>'Banco', 'value'=>$model->idBanco->nombre),
		'numero',
		'estado',
	),
)); ?>

<div class="row">
	<div class="span12"></div>
	<div class="span12 text-center">
		<a href="index.php?r=Bancos/view&id=<?php echo $model->id_banco; ?>" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i> Regresar a Banco</a>
	</div>
</div>