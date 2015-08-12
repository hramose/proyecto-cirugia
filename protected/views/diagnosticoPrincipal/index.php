<?php
/* @var $this DiagnosticoPrincipalController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Diagnostico Principal', 'url'=>array('create')),
	array('label'=>'Buscar Diagnostico Principal', 'url'=>array('admin')),
);
?>

<h1>Diagnostico Principal</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
