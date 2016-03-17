<?php
/* @var $this IngresosController */
/* @var $model Ingresos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingresos-form',
	'htmlOptions'=>array(
       'onsubmit'=>"return onEnviar();",/* Disable normal form submit */
       //'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
     ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	//'htmlOptions' => array('onsubmit'=>"return onEnviar()"),
	'enableAjaxValidation'=>false,
)); ?>

<?php 
$losValoresVendedor = 0;

if(isset($_GET['idPaciente']))
{
	$elPaciente = $_GET['idPaciente'];
}
else
{
	$elPaciente = "0";
}
$paciente = Paciente::model()->find("id=$elPaciente");

$laCita = "";

//Verificar si es liquidación de Contrato
$tipo = "";
if (isset($_GET['tipo'])) 
{
	$tipo=$_GET['tipo'] == "C";
	
}

if (isset($_GET['idCita']))
{
	$laCita = $_GET['idCita'];
	$tipo = "L";

	$saldoCita = CuentasXcDetalle::model()->find("cita_id = $laCita");
}

$idContrato = 0;
?>
<input id='cita_id' name='cita_id' value="<?php echo $laCita ?>" type="hidden"/>
<div class="row">
	<h4 class="text-center">Datos de Paciente</h4>
	<div class="span1"></div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$paciente,
			'attributes'=>array(			
				'nombreCompleto',
				'n_identificacion',
				'edad',
			),
		)); ?>
	</div>
	<div class="span5">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$paciente,
			'attributes'=>array(			
				'email',
				'telefono1',
				'celular',
			),
		)); ?>
	</div>
	<div class="span1"></div>
</div>
	<?php echo $form->errorSummary($model); ?>
<input id='variable' name='variable' type='hidden' />
<?php if ($tipo != "L") { ?>
	<div class="row">
		<div class="span3">
			<div class="row">
				<?php echo $form->labelEx($model,'contrato_id'); ?>
				<?php 
				
					if (isset($_GET['idContrato'])) {
						echo $form->textField($model,'contrato_id',array('size'=>20,'maxlength'=>20, 'value'=>$_GET['idContrato'], 'readOnly'=>'readOnly'));
						$idContrato = $_GET['idContrato'];
						$losValores = Contratos::model()->find("id=$idContrato");
						$losValoresVendedor = $losValores->vendedor_id;
					}
					else
					{
						echo $form->dropDownList($model, 'contrato_id',CHtml::listData(Contratos::model()->findAll("paciente_id = $elPaciente and estado = 'Activo' order by 'id'"),'id','id'), array('class'=>'input-normal','empty'=>'(Seleccionar)'));
						$losValoresVendedor = 0;
					}
				?>
				<?php echo $form->error($model,'contrato_id'); ?>
				<!-- Ver Contrato -->
				<!-- <a href="#verContrato" class="btn btn-small btn-info" role="button" data-toggle="modal"><i class="icon-cog icon-white"></i> Ver Contrato</a> -->

			</div>
		</div>
		<div class="span3">
			<?php 
				$cuentaXC = CuentasXcDetalle::model()->find("contrato_id = $idContrato");
				if ($cuentaXC) 
				{
					echo "<label>Saldo Tratamientos Realizados:</label>";
					echo "<h5 class='text-error'>$ ".number_format($cuentaXC->saldo,2)."</h5>";
				}
			?>
		</div>
		<div class="span6">
			<div class="span5">
				<label>Total de Contrato</label>
				<?php 
					if (isset($_GET['idContrato'])) {
						?>
						<div class="input-prepend">
  							<span class="add-on">$</span>
							<input type="text" id="elTotal" readOnly="readOnly" class="input-normal" value="<?php echo $losValores->total; ?>">
						</div>
						<?php
					}
					else
					{
						?>
						<div class="input-prepend">
  							<span class="add-on">$</span>
							<input type="text" id="elTotal" readOnly="readOnly" class="input-normal">
						</div>
						<?php
					}
				?>
				
			</div>
			<div class="span5">
				<label>Saldo</label>
				<?php 
					if (isset($_GET['idContrato'])) {
						?>
						<div class="input-prepend">
  							<span class="add-on">$</span>
							<input type="text" id="elSaldo" readOnly="readOnly" class="input-normal" value="<?php echo $losValores->saldo; ?>">
						</div>
						<?php
					}
					else
					{
						if ($tipo == "L") {
						?>
						<div class="input-prepend">
  							<span class="add-on">$</span>
							<input type="text" id="elSaldo" readOnly="readOnly" class="input-normal" value="<?php echo number_format($saldoCita->saldo,2);?>">
						</div>
						<?php
						}
						else
						{
						?>
						<div class="input-prepend">
  							<span class="add-on">$</span>
							<input type="text" id="elSaldo" readOnly="readOnly" class="input-normal">
						</div>
						<?php
						}
					}
				?>
			</div>

			<div class="span5">
				<label>Saldo en Caja Personal</label>
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input type="text" id="saldoCaja" readOnly="readOnly" class="input-normal" value="<?php echo $paciente->saldo ?>">
				</div>
			</div>

		</div>
	</div>
<?php } ?>
	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'valor'); ?>
			<div class="input-prepend">
  				<span class="add-on">$</span>
			<?php 
				if ($tipo == "C") {
					echo $form->textField($model,'valor',array('size'=>20,'maxlength'=>20, 'value'=>$losValores->saldo, 'readOnly'=>'readOnly', 'autocomplete'=>"off"));
				}
				else
				{
					if ($tipo == "L") 
					{
						echo $form->textField($model,'valor',array('size'=>20,'maxlength'=>20, 'value'=>$saldoCita->saldo, 'readOnly'=>'readOnly', 'autocomplete'=>"off"));
					}
					else
					{
						echo $form->textField($model,'valor',array('size'=>20,'maxlength'=>20, 'autocomplete'=>"off"));
					}
				}
			?>
			</div>
			<?php echo $form->error($model,'valor'); ?>

			<?php echo $form->labelEx($model,'centro_costo_id'); ?>
			<?php echo $form->dropDownList($model, 'centro_costo_id',CHtml::listData(CentroCosto::model()->findAll(array('condition'=>"tipo = 'Ingreso' and id > 0", 'order' => "nombre ASC")),'id','nombre'), array('class'=>'input-xxlarge', 'empty'=>'Ninguno'));?>
			<?php echo $form->error($model,'centro_costo_id'); ?>

			<div class="row">
				<?php echo $form->labelEx($model,'vendedor_id'); ?>
				<?php //if ($losValores){ ?>
					<?php echo $form->dropDownList($model, 'vendedor_id',CHtml::listData(Personal::model()->findAll(array('condition'=>"activo = 'SI' and id > 0", 'order'=>'nombres ASC')),'id','nombreCompleto'), array('class'=>'input-xxlarge', 'options' => array($losValoresVendedor=>array('selected'=>true))));?>	
				<?php /*}
					else
					{
						?>
					<?php echo $form->dropDownList($model, 'vendedor_id',CHtml::listData(Personal::model()->findAll("activo = 'SI' and id > 0 order by 'nombre'"),'id','nombreCompleto'), array('class'=>'input-xxlarge'));?>
						<?php
					}*/
				?>
				
				
				<?php echo $form->error($model,'vendedor_id'); ?>
			</div>
		</div>

		<div class="span6">
			<?php echo $form->labelEx($model,'descripcion'); ?>
			<?php 
				if ($tipo == "C") 
				{
					echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge', 'value'=>'Liquidación de Contrato'));
				}
				else
				{
					echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge'));
				}
			?>
			<?php echo $form->error($model,'descripcion'); ?>

			<?php echo $form->labelEx($model,'personal_seguimiento'); ?>
				<?php //if ($losValores){ ?>
					<?php echo $form->dropDownList($model, 'personal_seguimiento',CHtml::listData(Personal::model()->findAll(array('condition'=>"activo = 'SI' and id > 0" ,'order'=> 'nombres ASC')),'id','nombreCompleto'), array('class'=>'input-xxlarge', 'empty'=>'Ninguno'));?>	
		</div>
	</div>

	<div class="row">
		<div class="span6">
			<?php echo $form->labelEx($model,'forma_pago'); ?>
			<?php echo $form->dropDownList($model, 'forma_pago',array('Ninguna'=>'Ninguna', 'Efectivo'=>'Efectivo','Cheque'=>'Cheque','Tarjeta'=>'Tarjeta','Consignación'=>'Consignación','Transferencia'=>'Transferencia','Tarjeta Recargable'=>'Tarjeta Recargable', 'Unificación de Software'=>'Unificación de Software'), array('class'=>'input-large'));?>	
			<?php echo $form->error($model,'forma_pago'); ?>
		</div>
		<div class="span6">

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
				 <a href='JavaScript:agregarCampo();' class="btn btn-primary btn-mini"> Agregar Cheque </a>
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

						   <div id="contenedorcampos">
						   
						   </div>
						   </div>
						</div>
					</div>

				<div class="row">
					<?php echo $form->labelEx($model,'cheques_banco_cuenta_id'); ?>
					<?php echo $form->dropDownList($model, 'cheques_banco_cuenta_id',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
					<?php echo $form->error($model,'cheques_banco_cuenta_id'); ?>
				</div>
			</div>

			<div id="tarjeta" style="display: none">
				<div class="row">
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
					<?php echo $form->labelEx($model,'tarjeta_banco_cuenta_id'); ?>
					<?php echo $form->dropDownList($model, 'tarjeta_banco_cuenta_id',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
					<?php echo $form->error($model,'tarjeta_banco_cuenta_id'); ?>
				</div>
			</div>

			<div id="consignacion" style="display: none">
				<div class="row">
					<?php echo $form->labelEx($model,'consigna_banco_o'); ?>
					<?php echo $form->textField($model,'consigna_banco_o',array('size'=>25,'maxlength'=>25)); ?>
					<?php echo $form->error($model,'consigna_banco_o'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'consigna_cuenta_o'); ?>
					<?php echo $form->textField($model,'consigna_cuenta_o',array('size'=>25,'maxlength'=>25)); ?>
					<?php echo $form->error($model,'consigna_cuenta_o'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'consigna_banco_d_cuenta_id'); ?>
					<?php echo $form->dropDownList($model, 'consigna_banco_d_cuenta_id',CHtml::listData(BancosCuentas::model()->findAll("estado = 'Activo'"),'id','numero', 'idBanco.nombre'), array('class'=>'input-normal', 'id'=>'id','empty'=>'(Seleccionar)'));?>
					<?php echo $form->error($model,'consigna_banco_d_cuenta_id'); ?>
				</div>
			</div>
		</div>
	</div>

<div style="display: none">
	

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'personal_id'); ?>
		<?php echo $form->textField($model,'personal_id'); ?>
		<?php echo $form->error($model,'personal_id'); ?>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary', 'id'=>'guardar', 'name'=>'guardar', 'onclick'=>'js:antesdeEnviar();')); ?>
		</div>
	</div>
</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->




<!-- Ver Detalle de Contrato -->
<div id="verContrato" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel2">Detalle de Contrato</h3>
  </div>
	<div class="modal-body text-center">
    	
    	 	
    </div>
 	
  	
   <div class="modal-footer">
    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
  </div>
</div>



<script type="text/javascript">
//$(document).ready( agregarCampo );
	var variableJs = 0
	var campos = 1;
	var eltotal = 0;
	var nCheques = 0;

function agregarCampo(){
	campos = campos + 1;
	nCheques = nCheques + 1;
	variableJs = campos;
	var NvoCampo= document.createElement("div");
	NvoCampo.id= "divcampo_"+(campos);
	NvoCampo.innerHTML= 
		"<table class='table'>" +
		"   <tr>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text'  class='input-small' placeholder='' name='numero_" + campos + "' id='numero_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='' name='entidad_" + campos + "' id='entidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='' name='valor_" + campos + "' id='valor_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='' name='fecha_cobro_" + campos + "' id='fecha_cobro_" + campos + "' onkeyup='mascara(this,\"/\",patron,true)' maxlength='10'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	
	$("#variable").val(variableJs);

	var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);

    $("#Ingresos_cheques_cantidad").val(nCheques);

   $("#valor_" + campos +"").keyup(function(e) {
		var posicion = this.name.replace(/[^\d]/g, '');
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    superTotal();

	});
}

$("#Ingresos_forma_pago").change(function (){
	var posicion = this.name.replace(/[^\d]/g, '');

     if ($(this).val() == "Efectivo") 
    	{
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").hide();	
    	}

      if ($(this).val() == "Ninguna") 
    	{
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").hide();	
    	}

    if ($(this).val() == "Cheque") 
    	{
    		$("#cheque").toggle("slow");
    		$("#tarjeta").hide();
    		$("#consignacion").hide();	
    	}

    if ($(this).val() == "Tarjeta") 
    	{
    		$("#cheque").hide();
    		$("#tarjeta").toggle("slow");
    		$("#consignacion").hide();	
    	}

    if ($(this).val() == "Consignación") 
    	{
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").toggle("slow");	
    	}

    if ($(this).val() == "Transferencia") 
    	{
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").hide();	
    	}
    
     if ($(this).val() == "Tarjeta Recargable") 
    	{
    		$("#cheque").hide();
    		$("#tarjeta").hide();
    		$("#consignacion").hide();	
    	}	
});

$("#Ingresos_valor").keyup(function(e) {
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    
	    //Calcular iva de la compra
	    if (parseFloat($(this).val()) > parseFloat($("#elSaldo").val()))
	    {
	    	$("#guardar").attr("disabled", true);
	    	sweetAlert("Oops...", "El ingreso supera al saldo pendiente. Saldo $"+$("#elSaldo").val()+" ", "error");
	    	$("#Ingresos_valor").val($("#elSaldo").val());
	    }
	    else
	    {
	    	$("#guardar").attr("disabled", false);
	    }

	});

$("#Ingresos_contrato_id").change(function(e) {
		//Saber posición actual
        //var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=Ingresos/contratos",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("Error petición ajax");
                    },
                    success: function(data){
                    
                        // $("#resultado").empty();

						var variable = jQuery.parseJSON(data);
						//alert(variable.total);
						$("#elTotal").val(variable.total);
						$("#elSaldo").val(variable.saldo);
						var nContrato = $(this).val();

						// if ($("#elTotal").val() != "") {
						// $("#elTotal").val(variable.elTotal);
						// $("#elSaldo").val(variable.elSaldo);
						//  // superTotal();
						// }
						// else
						// {
						// $("#elTotal").val("");
						// $("#elSaldo").val("");
						// //superTotal();
						// }
                          
                                                             
                    }
              });
        

    //$("#vu_" + campos + "").val(variable);

    });

function superTotal()
{
	var total_principal = 0;
	
	for (var i = 0; i < 20; i++) {
		if (typeof $("#valor_"+ i + "").val() != 'undefined') {
			total_principal		= total_principal + eval($("#valor_"+ i + "").val());
		}
	};
	$("#Ingresos_cheques_total").val(total_principal);
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
  //variableJs = variableJs-1;
  superTotal();
  nCheques = nCheques - 1;
  $("#Ingresos_cheques_cantidad").val(nCheques);
}


function antesdeEnviar()
{
	
	swal({   title: "Estamos procesando el ingreso!",   text: "Solo tomara unos segundos.",   timer: 15000,   showConfirmButton: false });
}



function onEnviar(){

	if($("#Ingresos_centro_costo_id").val() == "") 
			{ 
				swal("No ha seleccionado Centro de Costo", "Seleccione una opción");
			 	return false
			    
			} 	

	if($("#Ingresos_forma_pago").val() == "Caja Personal") 
			{

			if($("#Ingresos_contrato_id").val() == "") 
			{
				swal("No puede hacer un ingreso de caja personal a usted mismo.", "Atención");
			 	return false	
			}


			if($("#Ingresos_valor").val() > $("#saldoCaja").val()) 
			{ 
				swal("Valor de ingreso supera saldo de caja personal.", "Atención");
			 	return false
			    
			} 
		} 
	
	if($("#Ingresos_forma_pago").val() == "Ninguna") 
			{ 
				swal("No ha seleccionado metodo de pago", "Seleccione una opción");  	
			 	return false
			    
			} 

	}

</script>