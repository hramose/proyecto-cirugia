<?php
/* @var $this ProductoComprasController */
/* @var $model ProductoCompras */
/* @var $form CActiveForm */
?>

<script>
	
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-compras-form',
	'action'=>'index.php?r=productoCompras/create',
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

	<?php echo $form->errorSummary($model); ?>
<div class="row">
	<div class="span12">
		<!-- <form id="Formulacion" name="Formulacion" action="index.php?r=productosCompras/guardarFormulacion" method = "post" onsubmit="onEnviar()"> -->
			
		<!-- </form> -->
	</div>
</div>

<?php 
	$losProductos = ProductoInventario::model()->findAll("estado = 'Activo'");
?>


<div class="row">
	<div class="span6">
		<?php echo $form->labelEx($model,'producto_proveedor_id'); ?>
		<?php echo $form->dropDownList($model, 'producto_proveedor_id',CHtml::listData(ProductoProveedor::model()->findAll("id > 0 order by 'nombre'"),'id','nombre'), array('class'=>'input-xxlarge'));?>
		<?php echo $form->error($model,'producto_proveedor_id'); ?>
	</div>

	<div class="span6">
		<?php echo $form->labelEx($model,'factura_n'); ?>
		<?php echo $form->textField($model,'factura_n',array('size'=>25,'maxlength'=>25, 'class'=>'input-xlarge')); ?>
		<?php echo $form->error($model,'factura_n'); ?>
	</div>
</div>
	

<?php 
	echo "<h3 class='text-center'>Datos de Productos</h3>";
?>
<a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Producto </a>
<div class="form-actions">
	<div class="row">
		<div class="span12">
		<table class "table" width="100%">
			<tr>
				<th width="8%"><small>Codigo</small></th>
				<th width="25%"><small>Producto</small></th>
				<th width="5%"><small>Presentación</small></th>
				<th width="8%"><small>Cant.</small></th>
				<th width="8%"><small>Unidad Medida</small></th>
				<th width="8%"><small>Lote.</small></th>
				<th width="8%"><small>Vence</small></th>
				<th width="11%"><small>Valor</small></th>
				<th width="5%"><small>IVA</small></th>
				<th width="10%"><small>Total</small></th>
				<th width="10%"></th>
			</tr>
		</table>

	   <div id="contenedorcampos">
	   
	   </div>
	   </div>
	</div>

	<div class="row">
		<div class="span6"></div>
		<input id='variable' name='variable' type='hidden' />
		<div class="span1">
			<?php echo $form->labelEx($model,'descuento'); ?>
			<?php echo $form->dropDownList($model, 'descuento',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'descuento'); ?>
		</div>

		<div class="span1">
			<?php echo $form->labelEx($model,'descuento_tipo'); ?>
			<?php echo $form->dropDownList($model, 'descuento_tipo',array('0'=>'%','1'=>'$'), array('class'=>'input-mini', 'disabled'=>'disabled'));?>
			<?php echo $form->error($model,'descuento_tipo'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'descuento_valor'); ?>
			<?php echo $form->textField($model,'descuento_valor',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'descuento_valor'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'descuento_total'); ?>
			<?php echo $form->textField($model,'descuento_total',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'descuento_total'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6"></div>
		<div class="span2">
			<?php echo $form->labelEx($model,'cantidad_productos'); ?>
			<?php echo $form->textField($model,'cantidad_productos', array('class'=>'input-small', 'class'=>'input-mini', 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'cantidad_productos'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'total_orden'); ?>
			<?php echo $form->textField($model,'total_orden',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'total_orden'); ?>
		</div>

		<div class="span2">
			<?php echo $form->labelEx($model,'total'); ?>
			<?php echo $form->textField($model,'total',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'total'); ?>
		</div>
	</div>

</div>

<div class="row">
	<div class = "row">
		<div class="span6">
			<?php echo $form->labelEx($model,'forma_pago'); ?>
			<?php echo $form->dropDownList($model, 'forma_pago',array('Efectivo'=>'Efectivo','Crédito'=>'Crédito', 'Consignación'=>'Consignación'), array('class'=>'input-normal'));?>
			<?php echo $form->error($model,'forma_pago'); ?>
		</div>

		<div class="span6">
			<div id="credito" style="display: none">
				<div class="span3">
					<?php echo $form->labelEx($model,'credito_dias'); ?>
					<?php echo $form->textField($model,'credito_dias',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
					<?php echo $form->error($model,'credito_dias'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'credito_fecha'); ?>
					<?php echo $form->textField($model,'credito_fecha',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readonly'=>'readonly')); ?>
					<?php echo $form->error($model,'credito_fecha'); ?>
				</div>
			</div>

			<div id="consignacion" style="display: none">
				<div>
					<b>Cuenta Origen</b>
					<?php echo $form->labelEx($model,'banco_cuenta_id'); ?>
					<?php echo $form->dropDownList($model, 'banco_cuenta_id',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id'));?>
					<?php echo $form->error($model,'banco_cuenta_id'); ?>
				</div>
				<hr>
				<div>
					<b>Cuenta Destino</b>
					<?php echo $form->labelEx($model,'banco_destino'); ?>
					<?php echo $form->textField($model,'banco_destino',array('size'=>30,'maxlength'=>30, 'class'=>'input-normal')); ?>
					<?php echo $form->error($model,'banco_destino'); ?>
				</div>

				<div>
					<?php echo $form->labelEx($model,'cuenta_destino'); ?>
					<?php echo $form->textField($model,'cuenta_destino',array('size'=>30,'maxlength'=>30, 'class'=>'input-normal')); ?>
					<?php echo $form->error($model,'cuenta_destino'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'iva'); ?>
			<?php echo $form->textField($model,'iva',array('size'=>10,'maxlength'=>10)); ?>
			<?php echo $form->error($model,'iva'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'iva_total'); ?>
			<?php echo $form->textField($model,'iva_total',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'iva_total'); ?>
		</div>	
	</div>
	<hr>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'aplica_retencion'); ?>
			<?php echo $form->dropDownList($model, 'aplica_retencion',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>
			<?php echo $form->error($model,'aplica_retencion'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'retencion_retener'); ?>
			<?php echo $form->textField($model,'retencion_retener',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'retencion_retener'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'retencion_id'); ?>
			<?php echo $form->dropDownList($model, 'retencion_id',CHtml::listData(ProductoRetenciones::model()->findAll("id > 0 order by 'retencion'"),'id','retencion'), array('class'=>'input-xxlarge', 'disabled'=>'disabled','empty'=>'(Seleccionar)'));?>
			<?php echo $form->error($model,'retencion_id'); ?>
		</div>

		<div class="span3">
			<?php echo $form->labelEx($model,'retencion_base'); ?>
			<?php echo $form->textField($model,'retencion_base',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'retencion_base'); ?>
		</div>

		<div class="span3">
			<?php echo $form->labelEx($model,'retencion_porcentaje'); ?>
			<?php echo $form->textField($model,'retencion_porcentaje',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'retencion_porcentaje'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'rte_iva'); ?>
			<?php echo $form->dropDownList($model, 'rte_iva',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini', 'disabled'=>'disabled'));?>	
			<?php echo $form->error($model,'rte_iva'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'rte_iva_valor'); ?>
			<?php echo $form->textField($model,'rte_iva_valor',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'rte_iva_valor'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'rte_ica'); ?>
			<?php echo $form->dropDownList($model, 'rte_ica',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini', 'disabled'=>'disabled'));?>	
			<?php echo $form->error($model,'rte_ica'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'rte_ica_porcentaje'); ?>
			<?php echo $form->textField($model,'rte_ica_porcentaje',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'rte_ica_porcentaje'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'rte_ica_valor'); ?>
			<?php echo $form->textField($model,'rte_ica_valor',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'rte_ica_valor'); ?>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'centro_costo_id'); ?>
			<?php echo $form->dropDownList($model, 'centro_costo_id',CHtml::listData(CentroCosto::model()->findAll("id > 0 order by 'nombre'"),'id','nombre'), array('class'=>'input-xxlarge'));?>
			<?php echo $form->error($model,'centro_costo_id'); ?>
		</div>

		<div class="span6">
			
		</div>
	</div>

	<div class="row">
		<div class="row">
			<?php echo $form->labelEx($model,'total_compra'); ?>
			<?php echo $form->textField($model,'total_compra',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
			<?php echo $form->error($model,'total_compra'); ?>
		</div>
	</div>
</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary btn-small'/*, 'onclick'=>'return validar();'*/)); ?>
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
		"        <input type='text' class='input-mini' placeholder='' name='codigo_" + campos + "' id='codigo_" + campos + "'>" +
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
		"        <input type='text' readonly='readonly' class='input-mini' placeholder='' name='presentacion_" + campos + "' id='presentacion_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-mini' placeholder='' name='unidad_" + campos + "' id='unidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='lote_" + campos + "' id='lote_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='dd-mm-aaaa' name='vence_" + campos + "' id='vence_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='valor_" + campos + "' id='valor_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='iva_" + campos + "' id='iva_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-small' placeholder='' name='total_" + campos + "' id='total_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	
	$("#variable").val(variableJs);

	var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);
    hablilitarControlesDescuento();
    hablilitarControlesRetencion();
    hablilitarControlesRteICA();
    tipoPago();


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
    
    	superTotal();

});



jQuery(document).ready(function($) {       
	$("#producto_" + campos +"").change(function(e) {
		//Saber posición actual
        			var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=ProductoCompras/producto",
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
                          $("#unidad_" + posicion + "").val(variable.unidad);
                          $("#lote_" + posicion + "").val(0);
                          $("#valor_" + posicion + "").val(eval(variable.valor));
                          $("#iva_" + posicion + "").val(eval(variable.iva));
                          $("#total_" + posicion + "").val(eval(variable.valor));
                          superTotal();
                                                             
                    }
              });
        

    //$("#vu_" + campos + "").val(variable);

    });
	
	$("#codigo_" + campos +"").change(function(e) {
		//Saber posición actual
        var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=ProductoCompras/productoReferencia",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("Error petición ajax");
                    },
                    success: function(data){
                    
                         // $("#resultado").empty();

                          var variable_r = jQuery.parseJSON(data);
                          //alert(variable.presentacion);
                          $("#codigo_" + posicion + "").val(variable_r.referencia);
                          $("#producto_" + posicion + "").val(variable_r.id);
                          $("#presentacion_" + posicion + "").val(variable_r.presentacion);
                          $("#cantidad_" + posicion + "").val(1);
                          $("#unidad_" + posicion + "").val(variable_r.unidad);
                          $("#lote_" + posicion + "").val(0);
                          $("#valor_" + posicion + "").val(eval(variable_r.valor));
                          $("#iva_" + posicion + "").val(eval(variable_r.iva));
                          $("#total_" + posicion + "").val(eval(variable_r.valor));
                          superTotal();
                                                             
                    }
              });
        

    //$("#vu_" + campos + "").val(variable);

    });


	$("#ProductoCompras_retencion_id").change(function(e) {
		//Saber posición actual
        //var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=ProductoCompras/retenciones",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("Error petición ajax");
                    },
                    success: function(data){
                    
                         // $("#resultado").empty();

                          var variable = jQuery.parseJSON(data);
                          //alert(variable.presentacion);
                          if ($("#ProductoCompras_retencion_id").val() != "") {
	                          $("#ProductoCompras_retencion_retener").val(variable.a_retener);
	                          $("#ProductoCompras_retencion_base").val(variable.base);
	                          $("#ProductoCompras_retencion_porcentaje").val(variable.porcentaje);
	                          superTotal();
                          }
                          else
                          {
                          	$("#ProductoCompras_retencion_retener").val("");
	                        $("#ProductoCompras_retencion_base").val("");
	                        $("#ProductoCompras_retencion_porcentaje").val("");
	                        superTotal();
                          }
                          
                                                             
                    }
              });
        

    //$("#vu_" + campos + "").val(variable);

    });


	$("#ProductoCompras_iva").keyup(function (){
		var posicion = this.name.replace(/[^\d]/g, '');
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotal();

	});


	//Calcular dias de Crédito
	$("#ProductoCompras_credito_dias").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular fecha de pago
	    if ($("#ProductoCompras_credito_dias").val() !=0 || $("#ProductoCompras_credito_dias").val() != "")
	    	{
	    		var f = new Date();
	    		var Fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
	   
	    		Fecha + $("#ProductoCompras_credito_dias").val();
	    		$("#ProductoCompras_credito_fecha").val(sumaFecha($("#ProductoCompras_credito_dias").val(), Fecha));

	    	}
	    else
		    {
		    	$("#ProductoCompras_credito_fecha").val("");
		    }
	});

sumaFecha = function(d, fecha)
			{
			var Fecha = new Date();
			var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
			var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
			var aFecha = sFecha.split(sep);
			var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
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

	$("#ProductoCompras_descuento_valor").keyup(function (){
		var posicion = this.name.replace(/[^\d]/g, '');
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular descuento de la compra
	    superTotal();

	});

	$("#ProductoCompras_rte_ica_porcentaje").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular descuento de la compra
	    superTotal();

	});


	$("#ProductoCompras_rte_ica_porcentaje").keyup(function (){
		//var posicion = this.name.replace(/[^\d]/g, '');
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular descuento de la compra
	    superTotal();

	});


	$("#ProductoCompras_descuento_tipo").change(function (){
		var posicion = this.name.replace(/[^\d]/g, '');

		//Calcular descuento de la compra
		superTotal();
	});

});
}


//Calculo de Super total-----------------------------------------------
function superTotal()
{
	var total_principal = 0;
	var total_orden = 0;
	var total_compra = 0;
	var total_cantidad = 0;
	var iva = 0;
	var retencion_ica = 0;
	var descuento = 0;
	for (var i = 0; i < 20; i++) {
		if (typeof $("#total_"+ i + "").val() != 'undefined') {
			total_principal		= total_principal + eval($("#total_"+ i + "").val());
			total_cantidad 		= total_cantidad + eval($("#cantidad_"+ i + "").val());
			total_orden 		= total_orden + eval($("#total_"+ i + "").val());
			total_compra 		= total_compra + eval($("#total_"+ i + "").val());
		}
	};

	//Si hay iva
	if ($("#ProductoCompras_iva").val() >0 || $("#ProductoCompras_iva").val() != "")
		{
			iva = total_principal * ($("#ProductoCompras_iva").val()/100);
			$("#ProductoCompras_iva_total").val(iva);
			total_orden = total_principal + iva;
			total_compra = total_principal + iva;
		}
	else
		{
			$("#ProductoCompras_iva_total").val("");
		}

	//Si hay descuento
	if ($("#ProductoCompras_descuento_valor").val() >0 || $("#ProductoCompras_descuento_valor").val() != "")
		{
			//Ver tipo de descuento % o $
			if ($("#ProductoCompras_descuento_tipo").val() == 0)
				{
					descuento = total_principal * ($("#ProductoCompras_descuento_valor").val()/100);
					$("#ProductoCompras_descuento_total").val(descuento);
					total_orden = total_orden - descuento;
					total_compra = total_compra - descuento;
				};

			if ($("#ProductoCompras_descuento_tipo").val() == 1)
				{
					$("#ProductoCompras_descuento_total").val($("#ProductoCompras_descuento_valor").val());
					total_orden = total_orden - $("#ProductoCompras_descuento_valor").val();
					total_compra = total_compra - $("#ProductoCompras_descuento_valor").val();
				};


			//iva = total_principal * ($("#ProductoCompras_iva").val()/100);
			//$("#ProductoCompras_iva_total").val(iva);
			//total_orden = total_principal + iva;
		}
	else
		{
			$("#ProductoCompras_descuento_total").val("");
		}

	//Si hay Retención
	if ($("#ProductoCompras_retencion_retener").val() != "")
		{
			total_compra = total_orden - $("#ProductoCompras_retencion_retener").val();
		}
	

	//Si hay Retención ICA
	if ($("#ProductoCompras_rte_ica_porcentaje").val() != "" || $("#ProductoCompras_rte_ica_porcentaje").val() > 0)
		{
			retencion_ica = total_principal * ($("#ProductoCompras_rte_ica_porcentaje").val()/100);
			$("#ProductoCompras_rte_ica_valor").val(retencion_ica);
			total_compra = total_compra - $("#ProductoCompras_retencion_retener").val();
		}
	else
		{
			$("#ProductoCompras_rte_ica_valor").val("");
		}


	$("#ProductoCompras_total").val(total_orden);
	$("#ProductoCompras_total_orden").val(total_principal);
	$("#ProductoCompras_total_compra").val(total_compra);
	$("#ProductoCompras_cantidad_productos").val(total_cantidad);
}


function hablilitarControlesDescuento()
{
	//Habilitar conroles 
	$("#ProductoCompras_descuento").change(function (){
		var posicion = this.name.replace(/[^\d]/g, '');
		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#ProductoCompras_descuento_tipo").prop('disabled', false);  		
	    		$("#ProductoCompras_descuento_valor").prop('readonly', false);  		
	    	}
	    	else
	    	{
	    		$("#ProductoCompras_descuento_tipo").prop('disabled', true);	
	    		$("#ProductoCompras_descuento_valor").val("");	
	    		$("#ProductoCompras_descuento_total").val("");
	    		$("#ProductoCompras_descuento_valor").keyup();
	    		$("#ProductoCompras_descuento_valor").prop('readonly', true);

	    	}
	});
}


function hablilitarControlesRetencion()
{
	//Habilitar conroles 
	$("#ProductoCompras_aplica_retencion").change(function (){
		var posicion = this.name.replace(/[^\d]/g, '');
		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#ProductoCompras_retencion_id").prop('disabled', false);  		
	    		$("#ProductoCompras_rte_iva").prop('disabled', false);  		
	    		$("#ProductoCompras_rte_ica").prop('disabled', false);  		
	    	}
	    	else
	    	{
	    		$("#ProductoCompras_retencion_id").val(0);
	    		$("#ProductoCompras_retencion_id").change();
	    		$("#ProductoCompras_rte_iva").val("No");
	    		$("#ProductoCompras_rte_iva").change();
	    		$("#ProductoCompras_rte_ica").val("No");
	    		$("#ProductoCompras_rte_ica").change();

	    		$("#ProductoCompras_retencion_id").prop('disabled', true);  		
	    		$("#ProductoCompras_rte_iva").prop('disabled', true);  		
	    		$("#ProductoCompras_rte_ica").prop('disabled', true);  
	    	}
	    
	    	

	});
}

function hablilitarControlesRteICA()
{
	//Habilitar conroles 
	$("#ProductoCompras_rte_ica").change(function (){
		var posicion = this.name.replace(/[^\d]/g, '');
		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#ProductoCompras_rte_ica_porcentaje").prop('readonly', false);
	    	}
	    	else
	    	{
	    		$("#ProductoCompras_rte_ica_porcentaje").prop('readonly', true);
	    		$("#ProductoCompras_rte_ica_porcentaje").val("");
	    		$("#ProductoCompras_rte_ica_valor").val("");
	    	}
	    
	    	

	});
}

function tipoPago()
{
	//Habilitar conroles 
	$("#ProductoCompras_forma_pago").change(function (){
				
	     if ($(this).val() == "Efectivo") 
	    	{
	    		$("#credito").hide();
	    		$("#consignacion").hide();
	    	}

	    if ($(this).val() == "Crédito") 
	    	{
	    		$("#credito").toggle();
	    		$("#consignacion").hide();
	    	}

	    if ($(this).val() == "Consignación") 
	    	{
	    		$("#consignacion").toggle();
	    		$("#credito").hide();
	    	}
	});
}


function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
  superTotal();
  //variableJs = variableJs-1;
}


 function onEnviar(){
       document.getElementById("variable").value=variableJs;
       //document.getElementById("total").value=variableJs;
}

 function validar() { 
		if($("#ProductoCompras_factura_n").val() == "") 
			{ 
				//alert('Debes poner el nombre'); 
				swal({   title: "Falta Número de Factura!",   text: "Complete esta información.",   timer: 2000,   showConfirmButton: false });
				return false; 
			} else
			{
				return true; 
			}
		}


</script>