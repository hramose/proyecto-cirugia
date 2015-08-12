<?php
/* @var $this PacienteResultadosLabController */
/* @var $model PacienteResultadosLab */
if(isset($_GET['idPaciente']))
	{
		$elPaciente = $_GET['idPaciente'];
	}
	else
	{
		$elPaciente = "0";
	}
		
if(isset($_GET['idCita']))
	{
		$idCita = $_GET['idCita'];
		$textoMenu = "Regresar a Cita";
		$laRuta = "index.php?r=citas/view&id=$idCita&idPaciente=$elPaciente";
		$urlComplemento = "&idCita=$idCita&idPaciente=$elPaciente";
	}
	else
	{
		$idCita = "0";
		$textoMenu = "Ver Ficha de Paciente";
		$laRuta = "index.php?r=paciente/view&id=$elPaciente";
		$urlComplemento = "id=$elPaciente";
	}

$this->menu=array(
	array('label'=>"<i class='icon-circle-arrow-left'></i> ".$textoMenu, 'url'=>$laRuta),
	//array('label'=>'Listar Resultados de Laboratorio', 'url'=>array('index')),
	//array('label'=>'Agregar Resultados de Laboratorio', 'url'=>array('create')),
	//array('label'=>'Ver Resultados de Laboratorio', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Buscar Resultados de Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Actualizar Resultados de Laboratorio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_formupdate', array('model'=>$model)); ?>