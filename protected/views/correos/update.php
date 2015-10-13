<?php
/* @var $this CorreosController */
/* @var $model Correos */

$this->menu=array(
	// array('label'=>'List Correos', 'url'=>array('index')),
	// array('label'=>'Create Correos', 'url'=>array('create')),
	// array('label'=>'View Correos', 'url'=>array('view', 'id'=>$model->id)),
	// array('label'=>'Manage Correos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Correo - <?php echo $model->tipo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>