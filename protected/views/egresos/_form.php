<?php
/* @var $this EgresosController */
/* @var $model Egresos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
	//Verificar que tenga caja de efectivo
	$hayCaja = CajaEfectivo::model()->find("personal_id = ".Yii::app()->user->usuarioId);

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'egresos-form',
	'htmlOptions' => array('onsubmit'=>"return onEnviar()"),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span6">
			

			<!-- Campos Ocultos -->
			<div class="row">
				<div class="span6">
					<?php echo $form->labelEx($model,'proveedor_id'); ?>
					<?php 
					
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					    //'model'=>$model,
					    //'attribute'=>'name',
					    'id'=>'proveedor_id',
					    //'id'=>'country-chain',
					    'name'=>'proveedor_id',
					    //'name'=>'country_chain',
					    'source'=>$this->createUrl('proveedor/buscarProveedor'),
					    'options'=>array(
					        'delay'=>300,
					        'minLength'=>2,
					        'showAnim'=>'fold',
					        'select'=>"js:function(event, ui) {
					            $('#nombre_proveedor').val(ui.item.nombre);
					            $('#direccion_proveedor').val(ui.item.direccion);
					            $('#ciudad_proveedor').val(ui.item.ciudad);
					            $('#telefono_proveedor').val(ui.item.telefono);
					            $('#id_proveedor').val(ui.item.id_proveedor);
					        }"
					    ),
					    'htmlOptions'=>array(
					        'size'=>'40',
					        'onblur'=>'cargarFacturas()'
					    ),
					));
					?>
					<a href="index.php?r=productoProveedor/create" role="button" class="btn btn-small btn-primary" data-toggle="modal"><i class="icon-plus icon-white"></i> Agregar Proveedor</a>
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
					<input name="id_proveedor" id = "id_proveedor" type='hidden'>
				</div>
			</div>
		</div>
		<div class ="span6">
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
<hr>
	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'observaciones'); ?>
			<?php echo $form->textArea($model,'observaciones',array('rows'=>5, 'class'=>'input-xxlarge')); ?>
			<?php echo $form->error($model,'observaciones'); ?>	
		</div>
		<div class="span6">
				<div class="row">
					<?php echo $form->labelEx($model,'valor_egreso'); ?>
					<?php echo $form->textField($model,'valor_egreso',array('size'=>10,'maxlength'=>10)); ?>
					<?php echo $form->error($model,'valor_egreso'); ?>
					<div id="error_egreso" style="display: none">
						<p class="text-error">Valor supera el saldo de la factura</p>
					</div>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'total_descuento'); ?>
					<?php echo $form->textField($model,'total_descuento',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
					<?php echo $form->error($model,'total_descuento'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'iva_valor'); ?>
					<?php echo $form->textField($model,'iva_valor',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
					<?php echo $form->error($model,'iva_valor'); ?>
				</div>
		</div>
		
	</div>

	<hr>
	<div class="row">
		<?php echo $form->labelEx($model,'iva_porcentace'); ?>
		<?php echo $form->textField($model,'iva_porcentace',array('size'=>10,'maxlength'=>10, 'class'=>'input-mini')); ?>
		<?php echo $form->error($model,'iva_porcentace'); ?>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'aplica_factura'); ?>
			<?php echo $form->dropDownList($model, 'aplica_factura',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'aplica_factura'); ?>
		</div>
		
		<!-- Este control sera de busqueda -->
		<div class="span4">
			<?php echo $form->labelEx($model,'factura_id'); ?>
			<?php echo $form->dropDownList($model, 'factura_id',array(), array('class'=>'input-normal', 'disabled'=>'disabled', 'onChange'=>'saldoFactura()'));?>	
			<?php echo $form->error($model,'factura_id'); ?>
		</div>

		<div class="span4">
			<label for="">Saldo Pendiente</label>
			<input type="text" name="saldo" id="saldo" value = "0" readOnly="readOnly">
		</div>
	</div>

	<div class="row">
		<div class="span12">
			<?php echo $form->labelEx($model,'forma_pago'); ?>
			<?php 
			if ($hayCaja) 
			{
				echo $form->dropDownList($model, 'forma_pago',array('Efectivo'=>'Efectivo','Consignación'=>'Consignación'), array('class'=>'input-large'));
			}
			else
			{
				echo $form->dropDownList($model, 'forma_pago',array('Consignación'=>'Consignación'), array('class'=>'input-large')) . "  ". "<span class='text-warning'>Egreso en Efectivo no permitido no dispone de Caja de Efectivo</span>";				
			}
			?>					
			<?php echo $form->error($model,'forma_pago'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'desc_pronto_pago'); ?>
			<?php echo $form->dropDownList($model, 'desc_pronto_pago',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'desc_pronto_pago'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'desc_pronto_pago_tipo'); ?>
			<?php echo $form->dropDownList($model, 'desc_pronto_pago_tipo',array('%'=>'%','$'=>'$'), array('class'=>'input-mini', 'disabled'=>'disabled'));?>
			<?php echo $form->error($model,'desc_pronto_pago_tipo'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'desc_pronto_pago_valor'); ?>
			<?php echo $form->textField($model,'desc_pronto_pago_valor',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'desc_pronto_pago_valor'); ?>
		</div>
	</div>

	

	<hr>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'rte_aplica'); ?>
			<?php echo $form->dropDownList($model, 'rte_aplica',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'rte_aplica'); ?>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'a_retener'); ?>
			<?php echo $form->textField($model,'a_retener',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'a_retener'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'retencion_id'); ?>
			<?php echo $form->dropDownList($model, 'retencion_id',CHtml::listData(ProductoRetenciones::model()->findAll("id > 0 order by 'retencion'"),'id','retencion'), array('class'=>'input-xxlarge', 'disabled'=>'disabled','empty'=>'(Seleccionar)'));?>
			<?php echo $form->error($model,'retencion_id'); ?>
		</div>

		<div class="span3">
			<?php echo $form->labelEx($model,'rte_base'); ?>
			<?php echo $form->textField($model,'rte_base',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_base'); ?>
		</div>

		<div class="span3">
			<?php echo $form->labelEx($model,'rte_porcenaje'); ?>
			<?php echo $form->textField($model,'rte_porcenaje',array('size'=>10,'maxlength'=>10, 'class'=>'input-small', 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_porcenaje'); ?>
		</div>		
	</div>

	

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'rte_iva'); ?>
			<?php echo $form->dropDownList($model, 'rte_iva',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'rte_iva'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'rte_iva_porcentaje'); ?>
			<?php echo $form->textField($model,'rte_iva_porcentaje',array('size'=>5,'maxlength'=>5, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_iva_porcentaje'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'rte_iva_valor'); ?>
			<?php echo $form->textField($model,'rte_iva_valor',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_iva_valor'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'rte_ica'); ?>
			<?php echo $form->dropDownList($model, 'rte_ica',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'rte_ica'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'rte_ica_porcentaje'); ?>
			<?php echo $form->textField($model,'rte_ica_porcentaje',array('size'=>5,'maxlength'=>5, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_ica_porcentaje'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'rte_ica_valor'); ?>
			<?php echo $form->textField($model,'rte_ica_valor',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_ica_valor'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span2">
			<?php echo $form->labelEx($model,'rte_cree'); ?>
			<?php echo $form->dropDownList($model, 'rte_cree',array('No'=>'No','Si'=>'Si'), array('class'=>'input-mini'));?>	
			<?php echo $form->error($model,'rte_cree'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'rte_cree_porcentaje'); ?>
			<?php echo $form->textField($model,'rte_cree_porcentaje',array('size'=>5,'maxlength'=>5, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_cree_porcentaje'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'rte_cree_valor'); ?>
			<?php echo $form->textField($model,'rte_cree_valor',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
			<?php echo $form->error($model,'rte_cree_valor'); ?>
		</div>
	</div>

	<hr>

	<div class="row">
		<?php echo $form->labelEx($model,'centro_costo_id'); ?>
		<?php echo $form->dropDownList($model, 'centro_costo_id',CHtml::listData(CentroCosto::model()->findAll("tipo = 'Egreso' and id > 0 order by 'nombre'"),'id','nombre'), array('class'=>'input-xxlarge', 'empty'=>'Ninguno'));?>
		<?php echo $form->error($model,'centro_costo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_egreso'); ?>
		<?php echo $form->textField($model,'total_egreso',array('size'=>10,'maxlength'=>10, 'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'total_egreso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary','onclick'=>'js:antesdeEnviar();')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">


$("#Egresos_valor_egreso").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    compararEgreso();
	    superTotal();

});

//Rte. IVA porcentaje
$("#Egresos_rte_iva_porcentaje").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotal();
});

//Rte. ICA porcentaje
$("#Egresos_rte_ica_porcentaje").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotal();
});


//Rte. CREE porcentaje
$("#Egresos_rte_cree_porcentaje").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotal();
});

$("#proveedor_id").change(function(){
	//alert("aja");
});

$("#provincias").change(function() {
    $("#poblaciones").empty();
    $.getJSON('http://localhost/getPoblacionesJson.php?pr='+$("#provincias").val(),function(data){
        console.log(JSON.stringify(data));
        $.each(data, function(k,v){
            $("#poblaciones").append("<option value=\""+k+"\">"+v+"</option>");
        }).removeAttr("disabled");
    });
});

function cargarFacturas()
{
	$("#Egresos_factura_id").empty();
    $.getJSON('<?php echo Yii::app()->baseurl; ?>/index.php?r=egresos/consultaFacturas&pr='+$("#id_proveedor").val(),function(data){
        console.log(JSON.stringify(data));
        $("#Egresos_factura_id").append("<option value=0>Seleccione Factura</option>");
        $.each(data, function(k,v){
            $("#Egresos_factura_id").append("<option value=\""+k+"\">"+v+"</option>");
        }).removeAttr("disabled");
    });
    //cargarSaldo();
}

//Calculo de total general
function superTotal()
{
	var iva = 0;
	var desc_pronto = 0;
	var total_principal = 0;
	var monto_egreso = 0;
	var a_retener = 0;
	var porcentaje_iva = 0;
	var porcentaje_ica = 0;
	var porcentaje_cree = 0;


	//Establecer monto de Egreso
	if ($("#Egresos_valor_egreso").val() >0 || $("#Egresos_valor_egreso").val() != "")
		{
			total_principal = $("#Egresos_valor_egreso").val();
			monto_egreso = $("#Egresos_valor_egreso").val();
		}
	else
		{
			$("#Egresos_iva_valor").val("");
			total_principal = 0;
			monto_egreso = 0;
		}
	
	//Si hay iva
	if ($("#Egresos_iva_porcentace").val() >0 || $("#Egresos_iva_porcentace").val() != "")
		{
			iva = $("#Egresos_valor_egreso").val() * ($("#Egresos_iva_porcentace").val()/100);
			$("#Egresos_iva_valor").val(iva);
			//total_compra = total_principal + iva;
			total_principal = eval(total_principal) + eval(iva);
		}
	else
		{
			$("#Egresos_iva_valor").val("");
		}

	//Descuento por Pronto Pago
	if ($("#Egresos_desc_pronto_pago_valor").val() >0 || $("#Egresos_desc_pronto_pago_valor").val() != "")
		{
			desc_pronto = $("#Egresos_desc_pronto_pago_valor").val();
			
			
			//Calculo de descuento por % o $
			if ($("#Egresos_desc_pronto_pago_tipo").val()=="%") //%
			{
				desc_pronto = eval(monto_egreso) * eval(desc_pronto/100);
				total_principal = total_principal - desc_pronto;

				$("#Egresos_total_descuento").val(desc_pronto);
			}

			if ($("#Egresos_desc_pronto_pago_tipo").val()=="$") //$
			{
				total_principal = eval(total_principal) - eval(desc_pronto);
			}

			//Descuento
			$("#Egresos_total_descuento").val(desc_pronto);
			
		}
	else
		{
			total_principal = eval(total_principal) + eval(desc_pronto);
			$("#Egresos_total_descuento").val("");
		}

	//Calculo de Retenciones
	if (eval($("#Egresos_rte_base").val()) > 0 || $("#Egresos_rte_base").val() != "") 
	{
		if (eval($("#Egresos_rte_base").val()) < eval(monto_egreso)) 
		{
			a_retener = monto_egreso * ($("#Egresos_rte_porcenaje").val()/100);
			$("#Egresos_a_retener").val(eval(a_retener));
		}
		else
		{
			if(eval($("#Egresos_rte_base").val())==0)
			{
				a_retener = monto_egreso * ($("#Egresos_rte_porcenaje").val()/100);
				$("#Egresos_a_retener").val(eval(a_retener));	
			}
			else
			{
				$("#Egresos_a_retener").val(0);	
			}
			
		}

	//Hacer Calculo
		total_principal = total_principal - a_retener

	}

	//Rte. IVA. Porcentaje
	if ($("#Egresos_rte_iva_porcentaje").val() >0 || $("#Egresos_rte_iva_porcentaje").val() != "")
		{
			porcentaje_iva = monto_egreso * ($("#Egresos_rte_iva_porcentaje").val()/100);
			$("#Egresos_rte_iva_valor").val(porcentaje_iva);
			//total_compra = total_principal + iva;
			total_principal = eval(total_principal) - eval(porcentaje_iva);
		}
	else
		{
			$("#Egresos_rte_ica_valor").val("");
		}

	//Rte. Ica. Porcentaje
	if ($("#Egresos_rte_ica_porcentaje").val() >0 || $("#Egresos_rte_ica_porcentaje").val() != "")
		{
			porcentaje_ica = monto_egreso * ($("#Egresos_rte_ica_porcentaje").val()/100);
			$("#Egresos_rte_ica_valor").val(porcentaje_ica);
			//total_compra = total_principal + iva;
			total_principal = eval(total_principal) - eval(porcentaje_ica);
		}
	else
		{
			$("#Egresos_rte_ica_valor").val("");
		}

	//Rte. Cree. Porcentaje
	if ($("#Egresos_rte_cree_porcentaje").val() >0 || $("#Egresos_rte_cree_porcentaje").val() != "")
		{
			porcentaje_cree = monto_egreso * ($("#Egresos_rte_cree_porcentaje").val()/100);
			$("#Egresos_rte_cree_valor").val(porcentaje_cree);
			//total_compra = total_principal + iva;
			total_principal = eval(total_principal) - eval(porcentaje_cree);
		}
	else
		{
			$("#Egresos_rte_cree_valor").val("");
		}
	



	//Super Total
	$("#Egresos_total_egreso").val(total_principal);
}
//Fin de SuperTotal



//Porcentaje de Iva
$("#Egresos_iva_porcentace").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotal();

	});

//Valor de egreso no supere a saldo
$("#Egresos_valor_egreso").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	   if ($("#Egresos_aplica_factura").val() == "Si") 
	   { 
		   if ($("#Egresos_valor_egreso").val() > $("#saldo").val()) 
		   {
		   		sweetAlert("Oops...", "No puede realizar un egreso mayor al saldo de la factura $"+$("#saldo").val(), "error");
		   		$("#Egresos_valor_egreso").val($("#saldo").val());
		   };
	   };

	});

$("#Egresos_desc_pronto_pago_valor").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotal();

	});


$("#Egresos_aplica_factura").change(function (){		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#Egresos_factura_id").prop('disabled', false);
	    	}
	    	else
	    	{
	    		$("#Egresos_factura_id").prop('disabled', true);
	    		$("#saldo").val(0);
	    	}
	});

//Descueno por pronto pago
$("#Egresos_desc_pronto_pago").change(function (){		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#Egresos_desc_pronto_pago_tipo").prop('disabled', false);
	    		$("#Egresos_desc_pronto_pago_valor").prop('readonly', false);
	    	}
	    	else
	    	{
	    		$("#Egresos_desc_pronto_pago_tipo").prop('disabled', true);
	    		$("#Egresos_desc_pronto_pago_valor").prop('readonly', true);
	    		$("#Egresos_desc_pronto_pago_valor").val("");
	    	}
	    	superTotal();
	});

$("#Egresos_desc_pronto_pago_tipo").change(function (){
	superTotal();
});

//Rte Aplica
$("#Egresos_rte_aplica").change(function (){		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#Egresos_retencion_id").prop('disabled', false);
	    	}
	    	else
	    	{
	    		$("#Egresos_retencion_id").prop('disabled', true);
	    		$("#Egresos_retencion_id").val(0);
	    		$("#Egresos_a_retener").val("");
	    		$("#Egresos_rte_base").val("");
	    		$("#Egresos_rte_porcenaje").val("");
	    	}
	    	superTotal();
	});


//Retencion ica
$("#Egresos_rte_ica").change(function (){		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#Egresos_rte_ica_porcentaje").prop('readonly', false);
	    	}
	    	else
	    	{
	    		$("#Egresos_rte_ica_porcentaje").prop('readonly', true);
	    		$("#Egresos_rte_ica_porcentaje").val("");
	    		$("#Egresos_rte_ica_valor").val("");
	    	}
	    	superTotal();
	});

//Retencion IVA
$("#Egresos_rte_iva").change(function (){		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#Egresos_rte_iva_porcentaje").prop('readonly', false);
	    	}
	    	else
	    	{
	    		$("#Egresos_rte_iva_porcentaje").prop('readonly', true);
	    		$("#Egresos_rte_iva_porcentaje").val("");
	    		$("#Egresos_rte_iva_valor").val("");
	    	}
	    	superTotal();
	});

$("#Egresos_rte_cree").change(function (){		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#Egresos_rte_cree_porcentaje").prop('readonly', false);
	    	}
	    	else
	    	{
	    		$("#Egresos_rte_cree_porcentaje").prop('readonly', true);
	    		$("#Egresos_rte_cree_porcentaje").val("");
	    		$("#Egresos_rte_cree_valor").val("");
	    	}
	    	superTotal();
	});

$("#Egresos_rte_cree").change(function (){		
	     if ($(this).val() == "Si") 
	    	{
	    		$("#Egresos_rte_cree_porcentaje").prop('readonly', false);
	    	}
	    	else
	    	{
	    		$("#Egresos_rte_cree_porcentaje").prop('readonly', true);
	    		$("#Egresos_rte_cree_porcentaje").val("");
	    		$("#Egresos_rte_cree_valor").val("");
	    	}
	});


$("#Egresos_forma_pago").change(function (){
     if ($(this).val() == "Efectivo") 
    	{
    		$("#consignacion").hide();	
    	}

    if ($(this).val() == "Consignación") 
    	{
    		$("#consignacion").toggle("slow");	
    	}
});


	jQuery(document).ready(function($) {       
	$("#Egresos_factura_id").change(function(e) {
		//Saber posición actual
		//Tratar de hacer una consulta
		if ($(this).val() != 0) {
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=Egresos/saldoFactura",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("Error petición ajax");
                    },
                    success: function(data){
                    
                         // $("#resultado").empty();

                          var variable = jQuery.parseJSON(data);
                          //alert(variable.presentacion);
                          $("#saldo").val(eval(variable.saldo));
                          $("#Egresos_valor_egreso").val(eval(variable.saldo));
                          superTotal();
                          compararEgreso();
                                                             
                    }
              });
		}else
		{
			$("#saldo").val(eval(0));
			compararEgreso();
		}
        
		//Verificar montos de egreso y saldo pendiente de factura
		


    }); 
	
     });

function compararEgreso()
{

	//Comparar si egreso supera saldo de factura
	if (eval($("#saldo").val()) > 0) 
	{
		if (eval($("#Egresos_valor_egreso").val()) > eval($("#saldo").val()))
			{
				$("#error_egreso").show();
			}
		else
			{
				$("#error_egreso").hide();
			}
	}
}

$("#Egresos_retencion_id").change(function(e) {
	//Saber posición actual
    //var posicion = this.name.replace(/[^\d]/g, '');                                                   
	//Tratar de hacer una consulta
	 $.ajax({
                type: "POST",
                url: "index.php?r=Egresos/retenciones",
                data: "b="+$(this).val(),
                dataType: "html",
                
                error: function(){
                      alert("Error petición ajax");
                },
                success: function(data){
                
                     // $("#resultado").empty();

                      var variable = jQuery.parseJSON(data);
                      //alert(variable.presentacion);
                      if ($("#Egresos_retencion_id").val() != "") {
                          //$("#Egresos_a_retener").val(variable.a_retener);
                          $("#Egresos_rte_base").val(variable.base);
                          $("#Egresos_rte_porcenaje").val(variable.porcentaje);
                          superTotal();
                      }
                      else
                      {
                      	$("#Egresos_a_retener").val("");
                        $("#Egresos_rte_base").val("");
                        $("#Egresos_rte_porcenaje").val("");
                        superTotal();
                      }                                     
                }
          });
	// if ($("#Egresos_retencion_id").val() == 0) 
	// {
	// 	$("#ProductoCompras_retencion_retener").val("");
 //        $("#ProductoCompras_retencion_base").val("");
 //        $("#ProductoCompras_retencion_porcentaje").val("");
	// }
	superTotal();
});

function onEnviar(){
	if($("#Egresos_centro_costo_id").val() == "") 
			{ 
				swal("No ha seleccionado Centro de Costo", "Seleccione una opción");  	
			 	return false
			    
			} 
	}

function antesdeEnviar()
{
	swal({   title: "Estamos procesando el egreso!",   text: "Solo tomara unos segundos.",   timer: 15000,   showConfirmButton: false });
}



</script>