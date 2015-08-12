<?php
/* @var $this PerfilController */
/* @var $model Perfil */

$this->menu=array(
	array('label'=>'Listar Perfiles', 'url'=>array('index')),
	array('label'=>'Crear Perfil', 'url'=>array('create')),
	array('label'=>'Actualizar Perfil', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Buscar Perfil', 'url'=>array('admin')),
);
?>

<h1>Perfil #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span4">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'nombre',
				'estado',
				'agenda',
			),
		)); ?>
	</div>

	<div class="span4">
		<a href="index.php?r=Personal/create" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i> Ingresar Personal</a>
	</div>
</div>
