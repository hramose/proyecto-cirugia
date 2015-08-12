<?php
/* @var $this EgresosController */
/* @var $model Egresos */

$this->menu=array(
	//array('label'=>'Listar Egresos', 'url'=>array('index')),
	array('label'=>'Crear Egresos', 'url'=>array('create')),
	//array('label'=>'Actualizar Egresos', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Borrar Egresos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Buscar Egresos', 'url'=>array('admin')),
);
?>

<h1>Egreso #<?php echo $model->id; ?></h1>

<div class="row">
	<div class="span4">
		<h4 class="text-center">Datos de Proveedor</h4>
		<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name'=>'proveedor_id', 'value'=>$model->proveedor->doc_nit,''),
		array('name'=>'Nombre', 'value'=>$model->proveedor->nombre,''),
		array('name'=>'Dirección', 'value'=>$model->proveedor->direccion,''),
		array('name'=>'Ciudad', 'value'=>$model->proveedor->ciudad,''),
		array('name'=>'Teléfono', 'value'=>$model->proveedor->telefono,''),
		'estado',
	),
)); ?>
<br>
<div class="text-center">
	<a href="#cancelar" class="btn btn-mini btn-danger" role="button" data-toggle="modal"><i class="icon-remove icon-white"></i> Cancelar Egresos</a>
</div>
<br>

<table class="table">
	<tr>
		<th>Descripción del Egreso</th>
	</tr>
	<tr>
		<td><?php echo $model->observaciones; ?></td>
	</tr>
</table>
<br>
<table class="table">
	<tr>
		<th>Egreso creado por :</th>
	</tr>
	<tr>
		<td><?php echo $model->personal->nombreCompleto; ?></td>
	</tr>
</table>
<div class="text-center">
	<?php 
		$this->widget('ext.popup.JPopupWindow', array( 
				'tagName'=>'button',
				'content'=> '<i class="icon-file icon-white"></i> Imprimir ', 
				'url'=>array('egresos/imprimirEgresos', 'id'=>$model->id),
				/*'url'=>array('/site/contact'), */
				'htmlOptions'=>array('class'=>'btn btn-info btn-mini'),
				'options'=>array( 
				'height'=>700, 
				'width'=>800, 
				'top'=>50, 
				'left'=>50, 
				), 
				));
	?>
</div>
	</div>
	<div class="span8">
		<h4 class="text-center">Detalles de Egreso</h4>
		<table class="table">
			<tr>
				<th>Fecha</th>
				<th>Factura</th>
				<th>Forma de Pago</th>
				<th>Valor Egreso</th>
				<th>%IVA</th>
				<th>$IVA</th>
			</tr>
			<tr>
				<td><?php echo Yii::app()->dateformatter->format("dd-MM-yyyy HH:mm:ss",$model->fecha); ?></td>
				<td><?php if($model->factura_id != NULL){ echo $model->factura->factura_n; }?></td>
				<td><?php echo $model->forma_pago; ?></td>
				<td><?php echo '$ '.number_format($model->valor_egreso,2); ?></td>
				<td><?php echo $model->iva_porcentace; ?></td>
				<td><?php echo '$ '.number_format($model->iva_valor,2); ?></td>
			</tr>
		</table>
		
		<!-- Descuento por Pronto Pago -->
		<h4 class="text-center">Descuento por Pronto Pago</h4>
		<table class="table">
			<tr>
				<th>Aplica Descuento</th>
				<th>En</th>
				<th>Valor</th>
				<th>Total Descuento</th>
			</tr>
			<tr>
				<td><?php echo $model->desc_pronto_pago; ?></td>
				<td><?php echo $model->desc_pronto_pago_tipo; ?></td>
				<td><?php echo $model->desc_pronto_pago_valor; ?></td>
				<td><?php echo '$ '.number_format($model->total_descuento,2); ?></td>
			</tr>
		</table>

		<!-- Retenciones -->
		<h4 class="text-center">Retenciones</h4>
		<table class="table">
			<tr>
				<th>Rte Fuente</th>
				<th>Motivo</th>
				<th>Base</th>
				<th>%</th>
				<th>Valor a Retener</th>
			</tr>
			<tr>
				<td><?php echo $model->rte_aplica; ?></td>
				<td><?php if($model->retencion_id !=NULL)echo $model->retencion->retencion; ?></td>
				<td><?php echo '$ '.number_format($model->rte_base,2); ?></td>
				<td><?php echo $model->rte_porcenaje; ?></td>
				<td><?php echo '$ '.number_format($model->rte_base,2); ?></td>
			</tr>
		</table>
		<div class="row">
			<div class="span4">
				<!-- Retenciones IVA -->
				<table class="table">
					<tr>
						<th>Rte IVA</th>
						<th>% Rte IVA</th>
						<th>Valor Rte IVA</th>
					</tr>
					<tr>
						<td><?php echo $model->rte_iva; ?></td>
						<td><?php echo $model->rte_iva_porcentaje; ?></td>
						<td><?php echo '$ '.number_format($model->rte_iva_valor,2); ?></td>
					</tr>
				</table>
			</div>

			<div class="span4">
				<!-- Retenciones ICA -->
				<table class="table">
					<tr>
						<th>Rte ICA</th>
						<th>% Rte ICA</th>
						<th>Valor Rte ICA</th>
					</tr>
					<tr>
						<td><?php echo $model->rte_ica; ?></td>
						<td><?php echo $model->rte_ica_porcentaje; ?></td>
						<td><?php echo '$ '.number_format($model->rte_ica_valor,2); ?></td>
					</tr>
				</table>
			</div>

			<div class="span4">
				<!-- Retenciones CREE -->
				<table class="table">
					<tr>
						<th>Rte Cree</th>
						<th>% Rte Cree</th>
						<th>Valor Rte Cree</th>
					</tr>
					<tr>
						<td><?php echo $model->rte_cree; ?></td>
						<td><?php echo $model->rte_cree_porcentaje; ?></td>
						<td><?php echo '$ '.number_format($model->rte_cree_valor,2); ?></td>
					</tr>
				</table>
			</div>
		</div>
		

		

		

		<!-- Centro de Costo -->
		<table class="table">
			<tr>
				<th>Centro de Costo</th>
				<th></th>
				<th>Total Egreso</th>
			</tr>
			<tr>
				<td><?php echo $model->centroCosto->nombre; ?></td>
				<td></td>
				<td><?php echo '$ '.number_format($model->total_egreso,2); ?></td>
			</tr>
		</table>
 		<?php //$this->widget('zii.widgets.CDetailView', array(
// 	'data'=>$model,
// 	'attributes'=>array(
// 		array('name'=>'factura_id', 'value'=>$model->factura->factura_n,''),
// 		'fecha',
// 		'forma_pago',
// 		'desc_pronto_pago',
// 		'desc_pronto_pago_tipo',
// 		'desc_pronto_pago_valor',
// 		'iva_porcentace',
// 		'valor_egreso',
// 		'total_descuento',
// 		'iva_valor',
// 		'rte_aplica',
// 		'retencion_id',
// 		'a_retener',
// 		'rte_base',
// 		'rte_porcenaje',
// 		'rte_iva',
// 		'rte_iva_valor',
// 		'rte_ica',
// 		'rte_ica_porcentaje',
// 		'rte_ica_valor',
// 		'rte_cree',
// 		'rte_cree_porcentaje',
// 		'rte_cree_valor',
// 		'centro_costo_id',
// 		'total_egreso',
// 	),
// )); ?>
	</div>
</div>


<!-- Cancelar Egresos -->
<div id="cancelar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel2">Cancelar Ingreso</h3>
  </div>
	<div class="modal-body text-center">
    	 	<h4>Para esta acción es necesario la clave de autorización</h4>
    	 	<?php 
			 	$form=$this->beginWidget('CActiveForm', array(
				'id'=>'seguimiento-comercial-form',
				'action'=>'/smadia/index.php?r=egresos/anular&id='.$model->id,
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>true,
			)); ?>
	    	 	<div class="input-prepend">
	    	 	<span class="controls">
	    	 		<span class="add-on"><i class="icon-lock"></i></span>
	    	 		<input type="password" id="clave" name="clave" placeholder="Clave SuperUsuario">
	    	 	</span>
	    	 		<br><br>
	    	 		<button class="btn btn-primary" type="submit">Proceder</button>
	    	 	</div>
    	 	<?php $this->endWidget(); ?>
    </div>
 	
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>