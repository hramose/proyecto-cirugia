<?php
/* @var $this PresupuestoController */
/* @var $model Presupuesto */

$elPaciente = $_GET['idPaciente'];
$textoMenu = "Ver Ficha de Paciente";
$laRuta = "index.php?r=paciente/view&id=$elPaciente";

$this->menu=array(
	// array('label'=>'Listar Presupuestos', 'url'=>array('index')),
	// array('label'=>'Buscar Presupuesto', 'url'=>array('admin')),
	array('label'=>$textoMenu, 'url'=>$laRuta),
);
?>

<h1>Crear Presupuesto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>