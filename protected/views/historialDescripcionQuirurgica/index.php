<?php
/* @var $this HistorialDescripcionQuirurgicaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Crear Descripción Quirurgica', 'url'=>array('create')),
	array('label'=>'Buscar Descripción Quirurgica', 'url'=>array('admin')),
);
?>

<h1>Descripción Quirurgicas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
