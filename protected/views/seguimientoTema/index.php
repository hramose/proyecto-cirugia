<?php
/* @var $this SeguimientoTemaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Tema de Seguimiento','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Buscar Tema de Seguimiento', 'url'=>array('admin')),
);
?>

<h1>Temas de Seguimiento</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
