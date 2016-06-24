<?php
/* @var $this MedicamentosBiologicosController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Medicamento Biológico','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Buscar Medicamentos Biológicos', 'url'=>array('admin')),
);
?>

<h1>Medicamentos Biológicos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
