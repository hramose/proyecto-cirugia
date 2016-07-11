<?php
/* @var $this PacienteBaulController */
/* @var $model PacienteBaul */
if(isset($_GET['idPaciente']))
	{
		$elPaciente = $_GET['idPaciente'];
	}
	else
	{
		$elPaciente = "0";
	}
	
	$textoMenu = "Ver Ficha de Paciente";
	$laRuta = "index.php?r=paciente/view&id=$elPaciente";
	$urlComplemento = "&idPaciente=$model->paciente_id";

$this->menu=array(
	array('label'=>"<i class='icon-circle-arrow-left'></i> ".$textoMenu, 'url'=>$laRuta),
);
?>

<h1>Agregar elementos al baúl de paciente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>