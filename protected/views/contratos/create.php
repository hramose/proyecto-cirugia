<?php
/* @var $this ContratosController */
/* @var $model Contratos */

$elPaciente = $_GET['idPaciente'];
$textoMenu = "Ver Ficha de Paciente";
$laRuta = "index.php?r=paciente/view&id=$elPaciente";

$this->menu=array(
	// array('label'=>'Listar Contratos', 'url'=>array('index')),
	array('label'=>'Buscar Contratos', 'url'=>array('admin')),
	array('label'=>$textoMenu, 'url'=>$laRuta),
);
?>

<h1>Crear Contratos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>