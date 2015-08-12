<?php
/* @var $this ActivoInventarioController */
/* @var $model ActivoInventario */

$this->menu=array(
	//array('label'=>'Listar Activos', 'url'=>array('index')),
	array('label'=>'Crear Activo', 'url'=>array('create')),
	//array('label'=>'Borrar Activo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Activos', 'url'=>array('admin')),
);
?>

<?php
	$losTipos = ActivosTipo::model()->findAll();
?>

<h1>Exportar registros</h1>

<form id="ExportarActivo" name="ExportarActivo" action="index.php?r=ActivoInventario/exportar" method = "post" onsubmit="onEnviar()" class="form">
<div class="row">
	<div class="span1"></div>
	<div class="span4">
		<label>Seleccione el tipo de activo:</label>
		<select name='tipo_activo' id='tipo_activo'>
			<option value=0>(Todos)</option>
			<?php foreach($losTipos as $los_tipos){ ?>
			<option value='<?php echo $los_tipos->id; ?>'><?php echo $los_tipos->tipo; ?></option>"+
			<?php } ?>
		</select>
	</div>
	<div class="span1"><img  src="images/exportar.png"/></div>
</div>
<div class="row">
	<div class="span12">
		
	</div>
</div>
<div class="row">
	<div class="span1"></div>
	<div class="span2">
		<label>Filtrado por fecha:</label>
		<select name='filtrar_por' id='filtrar_por' class="input-mini">
			<option value=0>No</option>
			<option value=1>Si</option>
		</select>
	</div>

	<div class="span2">
		<label>Fecha desde:</label>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'fecha_desde',
				'language'=>'es',
				'attribute' => 'fecha_desde',
				'value'=> '',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'language' => 'es',
					'dateFormat' => 'dd-mm-yy',
					'changeMonth'=>true,
    				'changeYear'=>true,
    				'yearRange'=>'2014:2025',
    				'readonly'=>'readonly'
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;width:80px;'
				),
			));
		?>
	</div>

	<div class="span2">
		<label>Fecha hasta:</label>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'fecha_hasta',
				'language'=>'es',
				'attribute' => 'fecha_hasta',
				'value'=> '',
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'fold',
					'language' => 'es',
					'dateFormat' => 'dd-mm-yy',
					'changeMonth'=>true,
    				'changeYear'=>true,
    				'yearRange'=>'2014:2025',
    				'readonly'=>'readonly'
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;width:80px;'

				),
			));
		?>
	</div>

</div>
<div class="row">
	<div class="span1"></div>
	<div class="span11">
		<input type="submit" value="Exportar" name="Exportar" class="btn btn-warning">
	</div>	
</div>
</form>