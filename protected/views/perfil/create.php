<?php
/* @var $this PerfilController */
/* @var $model Perfil */

$this->menu=array(
	array('label'=>'Listar Perfiles', 'url'=>array('index')),
	array('label'=>'Buscar Perfil', 'url'=>array('admin')),
);
?>

<h1>Crear Perfil</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>