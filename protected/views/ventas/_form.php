<?php
/* @var $this VentasController */
/* @var $model Ventas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ventas-form',
	'htmlOptions'=>array(
       'onsubmit'=>"return validar();",/* Disable normal form submit */
       //'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
     ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php 
	$losProductos = ProductoInventario::model()->findAll("cantidad > 0 and estado = 'Activo' and tipo_inventario = 'Productos' ORDER BY nombre_producto ASC");
?>
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<div class="span6">
			<div clas="row">
				<div class="span6">
					<?php echo $form->labelEx($model,'paciente_id'); ?>
					<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					    //'model'=>$model,
					    //'attribute'=>'name',
					    'id'=>'paciente_id',
					    //'id'=>'country-chain',
					    'name'=>'paciente_id',
					    //'name'=>'country_chain',
					    'source'=>$this->createUrl('pacienteBuscar/buscarPaciente'),
					    'options'=>array(
					        'delay'=>300,
					        'minLength'=>2,
					        'showAnim'=>'fold',
					        'select'=>"js:function(event, ui) {
					            $('#nombre_proveedor').val(ui.item.nombre);
					            $('#direccion_proveedor').val(ui.item.direccion);
					            $('#ciudad_proveedor').val(ui.item.ciudad);
					            $('#telefono_proveedor').val(ui.item.telefono);
					            $('#elpaciente_id').val(ui.item.paciente_id);
					        }"
					    ),
					    'htmlOptions'=>array(
					        'size'=>'40',
					    ),
					));
					?>
				</div>
				<div class="span6">
					<label>Nombre:</label>
					<input type="text"name="nombre_proveedor" id="nombre_proveedor" readOnly="readonly">
				</div>
			</div>

			<div class="row">
				<div class="span6">
					<label for="Nombre">Dirección:</label>
					<textarea name="direccion_proveedor" id="direccion_proveedor" cols="30" rows="3" readOnly="readonly"></textarea>		
				</div>

				<div class="span6">
					<label for="Nombre">Ciudad:</label>
					<input type="text"name="ciudad_proveedor" id="ciudad_proveedor" readOnly="readonly">		

					<label for="Nombre">Teléfono:</label>
					<input type="text"name="telefono_proveedor" id="telefono_proveedor" readOnly="readonly">
					<input name="elpaciente_id" id = "elpaciente_id" type='hidden'>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<?php echo $form->labelEx($model,'descripcion'); ?>
					<?php echo $form->textArea($model,'descripcion',array('rows'=>3, 'class'=>'input-xlarge')); ?>
					<?php echo $form->error($model,'descripcion'); ?>	
				</div>
			</div>
		</div>
		<div class="span6">
			<!-- Complementarios -->
			<div id="cheque" style="display: none">
				<div class="span12">
					<div class="span5">
						<?php echo $form->labelEx($model,'cheques_cantidad'); ?>
						<?php echo $form->textField($model,'cheques_cantidad', array('class'=>'input-mini', 'readOnly'=>'readOnly')); ?>
						<?php echo $form->error($model,'cheques_cantidad'); ?>
					</div>

					<div class="span5">
						<?php echo $form->labelEx($model,'cheques_total'); ?>
						<?php echo $form->textField($model,'cheques_total',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
						<?php echo $form->error($model,'cheques_total'); ?>
					</div>
				</div>
				 <a href='JavaScript:agregarCampoc();' class="btn btn-primary btn-mini"> Agregar Cheque </a>
					<div class="form-actions">
						<div class="row">
							<div class="span12">
							<table class "table" width="100%">
								<tr>
									<th width="15%"><small>Número</small></th>
									<th width="15%"><small>Entidad</small></th>
									<th width="18%"><small>Valor</small></th>
									<th width="10%"><small>Fecha de Cobro</small></th>
									<th width="10%"></th>
								</tr>
							</table>

						   <div id="contenedorcamposcheques">
						   
						   </div>
						   </div>
						</div>
					</div>

				<div class="row">
					<?php echo $form->labelEx($model,'cheques_cuenta_banco'); ?>
					<?php echo $form->dropDownList($model, 'cheques_cuenta_banco',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
					<?php echo $form->error($model,'cheques_cuenta_banco'); ?>
				</div>
			</div>

			<div id="tarjeta" style="display: none">
				<div class="row">
				<h4 class="text-center">Tarjeta 1</h4>
					<?php echo $form->labelEx($model,'tarjeta_tipo'); ?>
					<?php echo $form->dropDownList($model, 'tarjeta_tipo',array('Debito Maestro'=>'Debito Maestro','Mastercard'=>'Mastercard','VISA'=>'VISA','American Express'=>'American Express','Diners Club'=>'Diners Club'), array('class'=>'input-large','empty'=>'(Seleccionar)'));?>	
					<?php echo $form->error($model,'tarjeta_tipo'); ?>
				</div>

				<div class="row">
					<div class="span6">
						<?php echo $form->labelEx($model,'tarjeta_aprobacion'); ?>
						<?php echo $form->textField($model,'tarjeta_aprobacion',array('size'=>25,'maxlength'=>25)); ?>
						<?php echo $form->error($model,'tarjeta_aprobacion'); ?>
					</div>

					<div class="span6">
						<?php echo $form->labelEx($model,'tarjeta_entidad'); ?>
						<?php echo $form->textField($model,'tarjeta_entidad',array('size'=>25,'maxlength'=>25)); ?>
						<?php echo $form->error($model,'tarjeta_entidad'); ?>
					</div>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'tarjeta_cuenta_banco'); ?>
					<?php echo $form->dropDownList($model, 'tarjeta_cuenta_banco',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
					<?php echo $form->error($model,'tarjeta_cuenta_banco'); ?>
				</div>
			</div>

			<div id="tarjeta2" style="display: none">
				<div class="row">
				<h4 class="text-center">Tarjeta 2</h4>
					<?php echo $form->labelEx($model,'tarjeta_tipo2'); ?>
					<?php echo $form->dropDownList($model, 'tarjeta_tipo2',array('Debito Maestro'=>'Debito Maestro','Mastercard'=>'Mastercard','VISA'=>'VISA','American Express'=>'American Express','Diners Club'=>'Diners Club'), array('class'=>'input-large','empty'=>'(Seleccionar)'));?>	
					<?php echo $form->error($model,'tarjeta_tipo2'); ?>
				</div>

				<div class="row">
					<div class="span6">
						<?php echo $form->labelEx($model,'tarjeta_aprobacion2'); ?>
						<?php echo $form->textField($model,'tarjeta_aprobacion2',array('size'=>25,'maxlength'=>25)); ?>
						<?php echo $form->error($model,'tarjeta_aprobacion2'); ?>
					</div>

					<div class="span6">
						<?php echo $form->labelEx($model,'tarjeta_entidad2'); ?>
						<?php echo $form->textField($model,'tarjeta_entidad2',array('size'=>25,'maxlength'=>25)); ?>
						<?php echo $form->error($model,'tarjeta_entidad2'); ?>
					</div>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'tarjeta_cuenta_banco2'); ?>
					<?php echo $form->dropDownList($model, 'tarjeta_cuenta_banco2',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
					<?php echo $form->error($model,'tarjeta_cuenta_banco2'); ?>
				</div>
			</div>

			<div id="consignacion" style="display: none">
				<div class="row">
					<h4 class="text-center">Consignación 1</h4>
					<?php echo $form->labelEx($model,'consignacion_cuenta_banco'); ?>
					<?php echo $form->textField($model,'consignacion_cuenta_banco',array('size'=>25,'maxlength'=>25)); ?>
					<?php echo $form->error($model,'consignacion_cuenta_banco'); ?>
				</div>
				<hr>
				<div class="row">
					<div class="span6">
						<?php echo $form->labelEx($model,'consignacion_banco'); ?>
						<?php echo $form->dropDownList($model, 'consignacion_banco',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
						<?php echo $form->error($model,'consignacion_banco'); ?>
					</div>

					<div class="span6">
						<?php echo $form->labelEx($model,'consignacion_cuenta'); ?>
						<?php echo $form->textField($model,'consignacion_cuenta',array('size'=>25,'maxlength'=>25)); ?>
						<?php echo $form->error($model,'consignacion_cuenta'); ?>
					</div>
				</div>
			</div>


		

		<div id="consignacion2" style="display: none">
				<div class="row">
					<h4 class="text-center">Consignación 2</h4>
					<?php echo $form->labelEx($model,'consignacion_cuenta_banco2'); ?>
					<?php echo $form->textField($model,'consignacion_cuenta_banco2',array('size'=>25,'maxlength'=>25)); ?>
					<?php echo $form->error($model,'consignacion_cuenta_banco2'); ?>
				</div>
				<hr>
				<div class="row">
					<div class="span6">
						<?php echo $form->labelEx($model,'consignacion_banco2'); ?>
						<?php echo $form->dropDownList($model, 'consignacion_banco2',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
						<?php echo $form->error($model,'consignacion_banco2'); ?>
					</div>

					<div class="span6">
						<?php echo $form->labelEx($model,'consignacion_cuenta2'); ?>
						<?php echo $form->textField($model,'consignacion_cuenta2',array('size'=>25,'maxlength'=>25)); ?>
						<?php echo $form->error($model,'consignacion_cuenta2'); ?>
					</div>
				</div>
			</div>


		</div>
		
	</div>
	<input id='variable' name='variable' type='hidden' />
	<input id='variablec' name='variablec' type='hidden' />

	<a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Producto </a>
		<hr>
		<div class="row">

		<div class="span12">

		<table class "table" width="100%">
			<tr>
				<th width="8%"><small>Codigo</small></th>
				<th width="32%"><small>Producto</small></th>
				<th width="12%"><small>Presentación</small></th>
				<th width="9%"><small>Cant.</small></th>
				<th width="10%"><small>Valor</small></th>
				<th width="10%"><small>IVA</small></th>
				<th width="10%"><small>Total</small></th>
				<th width="10%"></th>
			</tr>
		</table>

	   <div id="contenedorcampos">
	   
	   </div>
	   </div>
	</div>
		<div class="row">
		<div class="span10"></div>
		<div class="span2">
			<?php echo $form->labelEx($model,'sub_total'); ?>
			<?php echo $form->textField($model,'sub_total',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'sub_total'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span10"></div>
		<div class="span2">
			<?php echo $form->labelEx($model,'total_iva'); ?>
			<?php echo $form->textField($model,'total_iva',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'total_iva'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'descuento'); ?>
			<?php echo $form->dropDownList($model, 'descuento',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'descuento'); ?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'descuento_tipo'); ?>
			<?php echo $form->dropDownList($model, 'descuento_tipo',array('%'=>'%','$'=>'$'), array('class'=>'input-mini', 'disabled'=>'disabled'));?>
			<?php echo $form->error($model,'descuento_tipo'); ?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'descuento_valor'); ?>
			<?php echo $form->textField($model,'descuento_valor',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'descuento_valor'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'descuento_total'); ?>
			<?php echo $form->textField($model,'descuento_total',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'descuento_total'); ?>
		</div>
	</div>

	

	<div class="row">
		<div class="span8"></div>
		<div class="span2">
			<?php echo $form->labelEx($model,'cant_productos'); ?>
			<?php echo $form->textField($model,'cant_productos', array('class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'cant_productos'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'total_orden'); ?>
			<?php echo $form->textField($model,'total_orden',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'total_orden'); ?>
		</div>
	</div>

<hr>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'forma_pago'); ?>
			<?php echo $form->dropDownList($model, 'forma_pago',array('Ninguna'=>'Ninguna', 'Efectivo'=>'Efectivo', 'Crédito'=>'Crédito', 'Cheque'=>'Cheque', 'Tarjeta'=>'Tarjeta', 'Consignación'=>'Consignación'), array('class'=>'input-medium'));?>	
			<?php echo $form->error($model,'forma_pago'); ?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'total1'); ?>
			<?php echo $form->textField($model,'total1', array('class'=>'input-medium')); ?>
			<?php echo $form->error($model,'total1'); ?>
		</div>
		<div class="span8">
			<div id="credito" style="display: none">
				<div class="row">
					<div class="span3">
						<?php echo $form->labelEx($model,'credito_dias'); ?>
						<?php echo $form->textField($model,'credito_dias', array('size'=>2,'maxlength'=>2, 'class'=>'input-mini')); ?>
						<?php echo $form->error($model,'credito_dias'); ?>
					</div>

					<div class="span3">
						<?php echo $form->labelEx($model,'credito_fecha'); ?>
						<?php echo $form->textField($model,'credito_fecha', array('class'=>'input-normal', 'readOnly'=>'readOnly')); ?>
						<?php echo $form->error($model,'credito_fecha'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'forma_pago2'); ?>
			<?php echo $form->dropDownList($model, 'forma_pago2',array('Ninguna'=>'Ninguna', 'Crédito'=>'Crédito', 'Tarjeta'=>'Tarjeta', 'Consignación'=>'Consignación'), array('class'=>'input-medium'));?>	
			<?php echo $form->error($model,'forma_pago2'); ?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'total2'); ?>
			<?php echo $form->textField($model,'total2', array('class'=>'input-medium')); ?>
			<?php echo $form->error($model,'total2'); ?>
		</div>
		<div class="span8">
			<div id="credito2" style="display: none">
				<div class="row">
					<div class="span3">
						<?php echo $form->labelEx($model,'credito_dias2'); ?>
						<?php echo $form->textField($model,'credito_dias2', array('size'=>2,'maxlength'=>2, 'class'=>'input-mini')); ?>
						<?php echo $form->error($model,'credito_dias2'); ?>
					</div>

					<div class="span3">
						<?php echo $form->labelEx($model,'credito_fecha2'); ?>
						<?php echo $form->textField($model,'credito_fecha2', array('class'=>'input-normal', 'readOnly'=>'readOnly')); ?>
						<?php echo $form->error($model,'credito_fecha2'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="span12">
			<?php echo $form->labelEx($model,'vendedor_id'); ?>
			<?php echo $form->dropDownList($model, 'vendedor_id',CHtml::listData(Personal::model()->findAll("activo = 'SI'"),'id','nombreCompleto'), array('class'=>'input-xxlarge','empty'=>'(Seleccionar)'));?>
			<?php echo $form->error($model,'vendedor_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="form-actions">
		<div class="span6 text-center">
			<?php echo $form->labelEx($model,'dinero_recibido'); ?>
			<?php echo $form->textField($model,'dinero_recibido',array('size'=>10,'maxlength'=>10, 'class'=>'input-small')); ?>
			<?php echo $form->error($model,'dinero_recibido'); ?>
		</div>

		<div class="span6 text-center">
			<?php echo $form->labelEx($model,'dinero_cambio'); ?>
			<?php echo $form->textField($model,'dinero_cambio',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'dinero_cambio'); ?>
		</div>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_venta'); ?>
		<?php echo $form->textField($model,'total_venta',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'total_venta'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">


$(document).ready( agregarCampo );

	var variableJs = 0
	var campos = 1;
	var eltotal = 0;

function agregarCampo(){

	campos = campos + 1;
	variableJs = campos;
	var NvoCampo= document.createElement("div");
	NvoCampo.id= "divcampo_"+(campos);
	NvoCampo.innerHTML= 
		"<table class='table'>" +
		"   <tr>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text'  readonly='readonly' class='input-mini' placeholder='' name='codigo_" + campos + "' id='codigo_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"		 <select class='input-xlarge' name='producto_" + campos + "' id='producto_" + campos + "'>" +
		"			<option value='0'></option>"+
		"			<?php foreach($losProductos as $los_productos){ ?>"+
		"			<option value='<?php echo $los_productos->id; ?>'><?php echo $los_productos->nombre_producto; ?></option>"+
		"			<?php } ?>"+
		"		 </select>"+
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-small' placeholder='' name='presentacion_" + campos + "' id='presentacion_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-mini' placeholder='' name='valor_" + campos + "' id='valor_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-mini' placeholder='' name='iva_" + campos + "' id='iva_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-small' placeholder='' name='total_" + campos + "' id='total_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='hidden' class='input-small' placeholder='' name='existencia_" + campos + "' id='existencia_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	
	$("#variable").val(variableJs);

	var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);
    

	//Busqueda de productos
	jQuery(document).ready(function($) {       
	$("#producto_" + campos +"").change(function(e) {
		//Saber posición actual
        			var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=ventas/producto",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("Error petición ajax");
                    },
                    success: function(data){
                    
                         // $("#resultado").empty();

                          var variable = jQuery.parseJSON(data);
                          //alert(variable.presentacion);
                          $("#codigo_" + posicion + "").val(variable.referencia);
                          $("#presentacion_" + posicion + "").val(variable.presentacion);
                          $("#cantidad_" + posicion + "").val(1);
                          $("#valor_" + posicion + "").val(eval(variable.valor));
                          $("#iva_" + posicion + "").val(eval(variable.iva));
                          $("#total_" + posicion + "").val(eval(variable.valor));
                          $("#existencia_" + posicion + "").val(eval(variable.stock));
                          superTotal();
                                                             
                    }
              });
        

    //$("#vu_" + campos + "").val(variable);

    });
    });




$("#cantidad_"+ campos + "").keyup(function (){
	var posicion = this.name.replace(/[^\d]/g, '');
	//alert("Hola");
    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
    //superTotal();
    //si la cantidad es cero no hacer nada
     if ($(this).val() == "" || $(this).val() == "0") 
    	{
    		$("#total_"+ posicion + "").val(0);		
    		
    	}
    	else
    	{
    		//Calcular el total de cada producto
    		var eltotal = eval($("#valor_"+ posicion + "").val()) * eval($(this).val());
    		$("#total_"+ posicion + "").val(eltotal);		
    	}
    	
    	//Verificar existencias
    	if ($(this).val() > eval($("#existencia_"+ posicion + "").val())) 
    	{
    		sweetAlert("Oops...", "No hay más producto del requerido. Solo hay "+$("#existencia_"+ posicion + "").val()+" en existencia", "error");
    		$(this).val(eval($("#existencia_"+ posicion + "").val()));
    	}

    	superTotal();

});


}


	var variableJsc = 0
	var camposc = 1;
	var eltotalc = 0;
	var nCheques = 0;
//Cheques
function agregarCampoc(){
	camposc = camposc + 1;
	nCheques = nCheques + 1;
	variableJsc = camposc;
	var NvoCampoc= document.createElement("div");
	NvoCampoc.id= "divcampo_"+(camposc);
	NvoCampoc.innerHTML= 
		"<table class='table'>" +
		"   <tr>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text'  class='input-small' placeholder='' name='numero_" + camposc + "' id='numero_" + camposc + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='' name='entidad_" + camposc + "' id='entidad_" + camposc + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='' name='valor_" + camposc + "' id='valor_" + camposc + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='' name='fecha_cobro_" + camposc + "' id='fecha_cobro_" + camposc + "' onkeyup='mascara(this,\"/\",patron,true)' maxlength='10'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampoc(" + camposc +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	
	$("#variablec").val(variableJsc);

	var contenedorc= document.getElementById("contenedorcamposcheques");
    contenedorc.appendChild(NvoCampoc);

    $("#Ventas_cheques_cantidad").val(nCheques);

    $("#valor_" + camposc +"").keyup(function(e) {
		var posicion = this.name.replace(/[^\d]/g, '');
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotalCheques();

	});

    }

function superTotalCheques()
{
	var total_principal_cheques = 0;
	
	for (var i = 0; i < 20; i++) {
		if (typeof $("#valor_"+ i + "").val() != 'undefined') {
			total_principal_cheques		= total_principal_cheques + eval($("#valor_"+ i + "").val());
		}
	};
	$("#Ventas_cheques_total").val(total_principal_cheques);
}

//Calculo de Super total-----------------------------------------------
function superTotal()
{
	var total_principal = 0;//Sub total
	var total_orden = 0;//Total Orden
	var total_venta = 0;//Total Venta
	var total_iva = 0;
	var total_cantidad = 0;
	var iva = 0;
	var retencion_ica = 0;
	var descuento = 0;
	for (var i = 0; i < 20; i++) {
		if (typeof $("#total_"+ i + "").val() != 'undefined') {
			total_principal		= total_principal + eval($("#total_"+ i + "").val());
			total_cantidad 		= total_cantidad + eval($("#cantidad_"+ i + "").val());
			total_orden 		= total_orden + eval($("#total_"+ i + "").val());
			total_venta 		= total_venta + eval($("#total_"+ i + "").val());
			if ($("#iva_"+ i +"").val() != "" || $("#iva_"+ i +"").val() > 0)
				{
					total_iva = total_iva + (eval($("#total_"+ i + "").val()) * (eval($("#iva_"+ i +"").val())/100))
					//total_iva = total_iva + eval($("#iva_"+ i +"").val())
				}
		}
	};

	total_principal = total_principal - total_iva;
	
	//Si hay descuento
	if ($("#Ventas_descuento_valor").val() != "" || $("#Ventas_descuento_valor").val() > 0)
		{
			//Ver tipo de descuento % o $
			if ($("#Ventas_descuento_tipo").val() == "%")
				{
					descuento = total_principal * ($("#Ventas_descuento_valor").val()/100);
					$("#Ventas_descuento_total").val(descuento);
					total_orden = total_orden - descuento;
					total_venta = total_venta - descuento;
				};

			if ($("#Ventas_descuento_tipo").val() == "$")
				{
					$("#Ventas_descuento_total").val($("#Ventas_descuento_valor").val());
					total_orden = total_orden - $("#Ventas_descuento_valor").val();
					total_venta = total_venta - $("#Ventas_descuento_valor").val();
				};


			//iva = total_principal * ($("#ProductoCompras_iva").val()/100);
			//$("#ProductoCompras_iva_total").val(iva);
			//total_orden = total_principal + iva;
		}
	else
		{
			$("#Ventas_descuento_total").val("");
		}

	
	$("#Ventas_sub_total").val(total_principal);
	if ($("#Ventas_descuento_total").val() != "")
		{
			//$("#Ventas_total_orden").val((total_orden-eval($("#Ventas_descuento_total").val())));
			$("#Ventas_total_orden").val(total_orden);
		}
	else
	{
		$("#Ventas_total_orden").val(total_orden);	
	}
	
	$("#Ventas_total_compra").val(total_venta);
	$("#Ventas_cant_productos").val(total_cantidad);
	$("#Ventas_total_iva").val(total_iva);
	$("#Ventas_total_venta").val(total_venta);
}


$("#Ventas_descuento_valor").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    superTotal();

	});

$("#Ventas_dinero_recibido").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    //Calculo de cambio
	    $("#Ventas_dinero_cambio").val($(this).val() - $("#Ventas_total_venta").val());
});

$("#Ventas_forma_pago").change(function (){
     if ($(this).val() == "Efectivo") 
    	{
    		$("#credito").hide();	
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").hide();
    	}

    if ($(this).val() == "Ninguna") 
    	{
    		$("#credito").hide();	
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").hide();
    	}

    if ($(this).val() == "Crédito") 
    	{
    		$("#credito").toggle("slow");
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").hide();
    	}

    if ($(this).val() == "Cheque") 
    	{
    		$("#credito").hide();
    		$("#cheque").toggle("slow");
    		$("#tarjeta").hide();
    		$("#consignacion").hide();
    	}

    if ($(this).val() == "Tarjeta") 
    	{
    		$("#credito").hide();
	   		$("#cheque").hide();
    		$("#tarjeta").toggle("slow");
    		$("#consignacion").hide();
    	}

    if ($(this).val() == "Consignación") 
    	{
    		$("#credito").hide();
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").toggle("slow");
    	}
});

$("#Ventas_forma_pago2").change(function (){
    if ($(this).val() == "Ninguna") 
    	{
    		$("#credito2").hide();	
    		$("#tarjeta2").hide();
    		$("#consignacion2").hide();
    	}

    if ($(this).val() == "Crédito") 
    	{
    		$("#credito2").toggle("slow");
    		$("#tarjeta2").hide();
    		$("#consignacion2").hide();
    	}
    if ($(this).val() == "Tarjeta") 
    	{
    		$("#credito2").hide();
    		$("#tarjeta2").toggle("slow");
    		$("#consignacion2").hide();
    	}

    if ($(this).val() == "Consignación") 
    	{
    		$("#credito2").hide();
    		$("#tarjeta2").hide();
    		$("#consignacion2").toggle("slow");
    	}
});




//Habilitar conroles 
$("#Ventas_descuento").change(function (){	
     if ($(this).val() == "Si") 
    	{
    		
    		$("#Ventas_descuento_tipo").prop('disabled', false);  		
    		$("#Ventas_descuento_valor").prop('readonly', false);  		
    	}
    	else
    	{
    		$("#Ventas_descuento_tipo").prop('disabled', true);	
    		$("#Ventas_descuento_valor").val("");	
    		$("#Ventas_descuento_total").val("");
    		$("#Ventas_descuento_valor").keyup();
    		$("#Ventas_descuento_valor").prop('readonly', true);

    	}
    	superTotal();
});


//Calcular dias de Crédito
	$("#Ventas_credito_dias").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular fecha de pago
	    if ($("#Ventas_credito_dias").val() !=0 || $("#Ventas_credito_dias").val() != "")
	    	{
	    		var f = new Date();
	    		var Fecha = f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear();
	   
	    		Fecha + $("#Ventas_credito_dias").val();
	    		$("#Ventas_credito_fecha").val(sumaFecha($("#Ventas_credito_dias").val(), Fecha));

	    	}
	    else
		    {
		    	$("#Ventas_credito_fecha").val("");
		    }
	});

	$("#Ventas_credito_dias2").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular fecha de pago
	    if ($("#Ventas_credito_dias2").val() !=0 || $("#Ventas_credito_dias2").val() != "")
	    	{
	    		var f = new Date();
	    		var Fecha = f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear();
	   
	    		Fecha + $("#Ventas_credito_dias2").val();
	    		$("#Ventas_credito_fecha2").val(sumaFecha2($("#Ventas_credito_dias2").val(), Fecha));

	    	}
	    else
		    {
		    	$("#Ventas_credito_fecha2").val("");
		    }
	});

sumaFecha = function(d, fecha)
			{
			var Fecha = new Date();
			var sFecha = fecha || (Fecha.getDate() + "-" + (Fecha.getMonth() +1) + "-" + Fecha.getFullYear());
			var sep = sFecha.indexOf('-') != -1 ? '-' : '-'; 
			var aFecha = sFecha.split(sep);
			var fecha = aFecha[2]+'-'+aFecha[1]+'-'+aFecha[0];
			fecha= new Date(fecha);
			fecha.setDate(fecha.getDate()+parseInt(d));
			var anno=fecha.getFullYear();
			var mes= fecha.getMonth()+1;
			var dia= fecha.getDate();
			mes = (mes < 10) ? ("0" + mes) : mes;
			dia = (dia < 10) ? ("0" + dia) : dia;
			var fechaFinal = dia+sep+mes+sep+anno;
			return (fechaFinal);
			}

sumaFecha2 = function(d, fecha)
			{
			var Fecha = new Date();
			var sFecha = fecha || (Fecha.getDate() + "-" + (Fecha.getMonth() +1) + "-" + Fecha.getFullYear());
			var sep = sFecha.indexOf('-') != -1 ? '-' : '-'; 
			var aFecha = sFecha.split(sep);
			var fecha = aFecha[2]+'-'+aFecha[1]+'-'+aFecha[0];
			fecha= new Date(fecha);
			fecha.setDate(fecha.getDate()+parseInt(d));
			var anno=fecha.getFullYear();
			var mes= fecha.getMonth()+1;
			var dia= fecha.getDate();
			mes = (mes < 10) ? ("0" + mes) : mes;
			dia = (dia < 10) ? ("0" + dia) : dia;
			var fechaFinal = dia+sep+mes+sep+anno;
			return (fechaFinal);
			}

var patron = new Array(2,2,4);
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}

function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
  superTotal();
  //variableJs = variableJs-1;
}

function quitarCampoc(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcamposcheques");
  contenedor.removeChild(eliminar);
   nCheques = nCheques - 1;
  $("#Ventas_cheques_cantidad").val(nCheques);
  //variableJs = variableJs-1;
}



 function onEnviar(){
       document.getElementById("variable").value=variableJs;
       //document.getElementById("total").value=variableJs;
}

function validar() { 
	if($("#Ventas_forma_pago").val() == "Ninguna") 
		{ 
			swal({   title: "No ha seleccionado metodo de pago",   text: "Seleccione una opción",   timer: 2000,   showConfirmButton: false });	
		 	return false
		} 	
}
</script>