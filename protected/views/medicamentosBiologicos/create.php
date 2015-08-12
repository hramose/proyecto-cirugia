<?php
/* @var $this MedicamentosBiologicosController */
/* @var $model MedicamentosBiologicos */

$this->menu=array(
	array('label'=>'Listar Medicamentos Biológicos', 'url'=>array('index')),
	array('label'=>'Buscar Medicamentos Biológicos', 'url'=>array('admin')),
);
?>

<h1>Crear Medicamento Biológico</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>