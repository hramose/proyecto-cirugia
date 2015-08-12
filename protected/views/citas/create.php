<?php
/* @var $this CitasController */
/* @var $model Citas */

if(isset($_GET['idpaciente']))
{
	$idpaciente = $_GET['idpaciente'];
	$idPersonal = $_GET['medico'];
	$elPersonal = Personal::model()->findByPk($idPersonal);
	$this->menu=array(
		array('label'=>'Listar Citas', 'url'=>array('index')),
		array('label'=>'Buscar Citas', 'url'=>array('admin')),
		array('label'=>'Regresar a Calendario', 'url'=>array('calendario&idpaciente='.$idpaciente.'&idpersonal='.$elPersonal->id_perfil)),
	);
}
else
{
	$this->menu=array(
		array('label'=>'Listar Citas', 'url'=>array('index')),
		array('label'=>'Buscar Citas', 'url'=>array('admin')),
		array('label'=>'Regresar a Calendario', 'url'=>array('calendario')),
	);	
}
?>

<h1>Crear Cita</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>