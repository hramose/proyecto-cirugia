<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->menu=array(
	// array('label'=>'Listar Usuarios', 'url'=>array('index')),
	// array('label'=>'Crear Usuario', 'url'=>array('create')),
	 array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->personal_id)),
	// array('label'=>'Borrar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->personal_id),'confirm'=>'Are you sure you want to delete this item?')),
	// array('label'=>'Buscar Usuario', 'url'=>array('admin')),
	array('label'=>"Regresar a Ficha de Personal", 'url'=>"index.php?r=personal/view&id=$model->personal_id"),
);
?>

<h1>Usuario #<?php echo $model->personal_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'personal_id',
		'usuario',
		'clave',
		'estado',
		'perfilSistema.perfil',
	),
)); ?>
