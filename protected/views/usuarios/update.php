<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

if (isset($_GET['id'])) {
	$elId = $_GET['id'];
}

$this->menu=array(
	// array('label'=>'Listar Usuarios', 'url'=>array('index')),
	// array('label'=>'Crear Usuario', 'url'=>array('create')),
	// array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->personal_id)),
	// array('label'=>'Buscar Usuario', 'url'=>array('admin')),
	array('label'=>'Regresar a Personal', 'url'=>array('personal/view&id='.$elId)),
);
?>

<h1>Acualizar Usuario <?php echo $model->personal_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>