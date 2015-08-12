<?php
/* @var $this PacienteController */
/* @var $model Paciente */


$this->menu=array(
	array('label'=>'Listar Pacientes', 'url'=>array('index')),
	array('label'=>'Ingresar Paciente', 'url'=>array('create')),
	array('label'=>'Ver Paciente', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Paciente', 'url'=>array('admin')),
);
?>

<h1>Actualizar Datos de Paciente <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>