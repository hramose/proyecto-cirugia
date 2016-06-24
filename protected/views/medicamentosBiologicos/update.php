<?php
/* @var $this MedicamentosBiologicosController */
/* @var $model MedicamentosBiologicos */

$this->menu=array(
	array('label'=>'Listar Medicamentos Biológicos', 'url'=>array('index')),
	array('label'=>'Crear Medicamento Biológico','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Ver Medicamento Biológico', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Buscar Medicamentos Biológicos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Medicamento Biológico <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>