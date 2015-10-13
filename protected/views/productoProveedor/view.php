<?php
/* @var $this ProductoProveedorController */
/* @var $model ProductoProveedor */

$this->menu=array(
	array('label'=>'Listar Proveedor de Productos', 'url'=>array('index')),
	array('label'=>'Crear Proveedor de Productos', 'url'=>array('create')),
	array('label'=>'Actualizar Proveedor de Productos', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Proveedor de Productos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Proveedor de Productos', 'url'=>array('admin')),
);
?>

<h1>Proveedor de Productos #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span6">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'doc_nit',
				'nombre',
				'direccion',
				'ciudad',
				'telefono',
				'nombre_contacto',
				'email_contacto',
				'telefono_contacto',
				'celular_contacto',
			),
		)); ?>
	</div>
	<div class="span6">
		<a href="index.php?r=egresos/create" role="button" class="btn btn-small btn-warning" data-toggle="modal"><i class="icon-download-alt icon-white"></i> Registrar Egreso</a>
	</div>
</div>

