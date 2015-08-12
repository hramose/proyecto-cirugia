<?php
/* @var $this DiagnosticoRelacionadoController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Diagnostico Relacionado', 'url'=>array('create')),
	array('label'=>'Buscar Diagnosticos Relacionados', 'url'=>array('admin')),
);
?>

<h1>Diagnostico Relacionado</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
