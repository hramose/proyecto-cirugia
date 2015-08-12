<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

if (isset($_GET['id'])) {
	$elId = $_GET['id'];
}


$this->menu=array(
	//array('label'=>'List Usuarios', 'url'=>array('index')),
	//array('label'=>'Manage Usuarios', 'url'=>array('admin')),
	array('label'=>'Regresar a Personal', 'url'=>array('personal/view&id='.$elId)),
);
?>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>