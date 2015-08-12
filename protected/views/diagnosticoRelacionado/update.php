<?php
/* @var $this DiagnosticoRelacionadoController */
/* @var $model DiagnosticoRelacionado */

$this->menu=array(
	array('label'=>'Listar Diagnosticos Relacionados', 'url'=>array('index')),
	array('label'=>'Crear Diagnostico Relacionado', 'url'=>array('create')),
	array('label'=>'Ver Diagnostico Relacionado', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Diagnostico Relacionado', 'url'=>array('admin')),
);
?>

<h1>Actulizar Diagnostico Relacionado <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>