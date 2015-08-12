<?php
/* @var $this PerfilController */
/* @var $model Perfil */


$this->menu=array(
	array('label'=>'Listar Perfiles', 'url'=>array('index')),
	array('label'=>'Crear Perfil', 'url'=>array('create')),
	array('label'=>'Ver Perfil', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Perfil', 'url'=>array('admin')),
);
?>

<h1>Actualizar Perfil <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>