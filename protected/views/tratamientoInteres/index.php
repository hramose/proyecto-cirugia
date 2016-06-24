<?php
/* @var $this TratamientoInteresController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Tratamiento de Interes','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Buscar Tratamientos de Interes', 'url'=>array('admin')),
);
?>

<h1>Tratamiento de Interes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
