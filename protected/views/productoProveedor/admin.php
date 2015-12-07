<?php
/* @var $this ProductoProveedorController */
/* @var $model ProductoProveedor */

$this->menu=array(
	array('label'=>'Listar Proveedor de Productos', 'url'=>array('index')),
	array('label'=>'Crear Proveedor de Productos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#producto-proveedor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscar Proveedor de Productos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-proveedor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'ID.',
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'20'),
		),
		'doc_nit',
		'nombre',
		'direccion',
		'ciudad',
		'telefono',
		/*
		'nombre_contacto',
		'email_contacto',
		'telefono_contacto',
		'celular_contacto',
		*/
		// array(
		// 	'class'=>'CButtonColumn',
		// ),
	),
)); ?>

<script>
    $(document).ready(function()
    {
        $('body').on('dblclick', '#producto-proveedor-grid tbody tr', function(event)
        {
            var
                rowNum = $(this).index(),
                keys = $('#producto-proveedor-grid > div.keys > span'),
                rowId = keys.eq(rowNum).text();

            location.href = '<?php echo Yii::app()->createUrl('ProductoProveedor/view'); ?>&id=' + rowId;
        });
    });
</script>