<?php
/* @var $this IngresosController */
/* @var $model Ingresos */

$elPaciente = $_GET['idPaciente'];
$textoMenu = "Ver Ficha de Paciente";
$laRuta = "index.php?r=paciente/view&id=$elPaciente";

$this->menu=array(
//	array('label'=>'Listar Ingresos', 'url'=>array('index')),
//	array('label'=>'Buscar Ingresos', 'url'=>array('admin')),
	array('label'=>$textoMenu, 'url'=>$laRuta),
);
?>

<?php 
	//Calcular proximo numero de compra
	$proxima = new Ingresos;
	$criteria=new CDbCriteria;
	$criteria->select='max(id) AS id';
	$row = $proxima->model()->find($criteria);
	$elid = $row['id'] +1;
?>

<h1>Crear Ingreso #<?php echo $elid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>