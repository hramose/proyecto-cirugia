<?php
/* @var $this ProductoInventarioController */
/* @var $model ProductoInventario */

$this->menu=array(
	//array('label'=>'Listar Productos', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Actualizar Producto', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Producto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Productos', 'url'=>array('admin')),
);
?>


<?php
//------------ add the CJuiDialog widget -----------------
if (!empty($asDialog)):
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
        'id'=>'dlg-address-view-'. $model->id,
        'options'=>array(
            'title'=>'Producto #'. $model->id,
            'autoOpen'=>true,
            'modal'=>false,
            'width'=>550,
            'height'=>550,
        ),
 ));
 
else:
//-------- default code starts here ------------------
?>

<h1>Producto #<?php echo $model->id; ?></h1>

<?php endif; ?>
<div class="row">
	<div class="span2"></div>
	<div class="span8">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'nombre_producto',
				'producto_referencia',
				'lote',
				'costo_iva',
				'precio_publico',
				'iva',
				'productoPresentacion.presentacion',
				'cantidad',
				array('name'=>'Unidad de Medida', 'value'=>$model->productoUnidadMedida->medida, ''),
				'stock_minimo',
				array('name'=>'Proveedor', 'value'=>$model->productoProveedor->nombre),
				'tipo_inventario',
				array('name'=>'Categoría', 'value'=>$model->productoCategoria->categoria),
				'estado',
				array('name'=>'Ingresado por', 'value'=>$model->personal->nombreCompleto),
				array('name'=>'fecha', 'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy H:mm:ss",$model->fecha),''),	
			),
		)); ?>
	</div>
	<div class="span2"></div>
</div>

<?php 
  //----------------------- close the CJuiDialog widget ------------
  if (!empty($asDialog)) $this->endWidget();
?>