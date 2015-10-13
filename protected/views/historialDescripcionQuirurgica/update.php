<?php
/* @var $this HistorialDescripcionQuirurgicaController */
/* @var $model HistorialDescripcionQuirurgica */
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
	//array('label'=>'Listar Descripción Quirurgica', 'url'=>array('index')),
	//array('label'=>'Crear Descripción Quirurgica', 'url'=>array('create')),
	//array('label'=>'Ver Descripción Quirurgica', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Buscar Descripción Quirurgica', 'url'=>array('admin')),
);
?>

<h1>Actualizar Descripción Quirurgica <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>