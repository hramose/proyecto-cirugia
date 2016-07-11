<?php
/* @var $this PacienteBaulController */
/* @var $model PacienteBaul */


$this->menu=array(
	array('label'=>'List PacienteBaul', 'url'=>array('index')),
	array('label'=>'Manage PacienteBaul', 'url'=>array('admin')),
);
?>

<h1>Agregar Elementos al Baúl de Paciente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>