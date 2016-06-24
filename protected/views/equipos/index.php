<?php
/* @var $this EquiposController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Equipo', 'visible'=>Yii::app()->user->perfil <> 1,'url'=>array('create')),
	array('label'=>'Buscar Equipo', 'url'=>array('admin')),
);
?>

<h1>Equipos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
