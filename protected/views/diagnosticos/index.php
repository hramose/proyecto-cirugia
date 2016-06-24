<?php
/* @var $this DiagnosticosController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Diagnostico','visible'=>Yii::app()->user->perfil <> 1, 'url'=>array('create')),
	array('label'=>'Buscar Diagnostico', 'url'=>array('admin')),
);
?>

<h1>Diagnosticos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
