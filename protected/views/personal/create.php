<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->menu=array(
	array('label'=>'Listar Personal', 'url'=>array('index')),
	array('label'=>'Buscar Personal', 'url'=>array('admin')),
);
?>

<h1>Ingresar Personal</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>