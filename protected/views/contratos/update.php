<?php
/* @var $this ContratosController */
/* @var $model Contratos */


$this->menu=array(
	array('label'=>'Listar Contratos', 'url'=>array('index')),
	array('label'=>'Ver Contrato', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Contrato', 'url'=>array('admin')),
);
?>

<h1>Actualizar Contrato <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_formupdate', array('model'=>$model)); ?>