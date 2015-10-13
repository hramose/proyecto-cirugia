<?php
/* @var $this CorreosController */
/* @var $model Correos */


$this->menu=array(
//	array('label'=>'List Correos', 'url'=>array('index')),
//	array('label'=>'Manage Correos', 'url'=>array('admin')),
);
?>

<h1>Editor de Correo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>