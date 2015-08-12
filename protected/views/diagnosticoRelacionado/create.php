<?php
/* @var $this DiagnosticoRelacionadoController */
/* @var $model DiagnosticoRelacionado */

$this->menu=array(
	array('label'=>'Listar Diagnosticos Relacionados', 'url'=>array('index')),
	array('label'=>'Buscar Diagnostico Relacionado', 'url'=>array('admin')),
);
?>

<h1>Crear Diagnostico Relacionado</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>