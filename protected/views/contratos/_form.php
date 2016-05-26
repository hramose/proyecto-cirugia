<?php
/* @var $this PresupuestoController */
/* @var $model Presupuesto */
/* @var $form CActiveForm */
?>

<?php

if(isset($_GET['idPaciente']))
{
	$elPaciente = $_GET['idPaciente'];
}
else
{
	$elPaciente = "0";
}

$model = Paciente::model()->find("id=$elPaciente");
$lineasdeservicio = LineaServicio::model()->findAll(array("condition" => "estado = 'activo'", 'order'=>'nombre asc'));
?>

<div class="row">
	<div class="span5">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'nombreCompleto',
		),
	)); ?>
	<a class="btn btn-warning" href='index.php?r=paciente/view&id=<?php echo $model->id;?>'><i class="icon-search icon-white"></i> Ficha de Paciente</a>
	</div>

	<div class='span5'>
		<h2>Total:</h2>
		<input id='total' type='text' name='total' class="input-medium" readonly='readonly'/>
	</div>
</div>

<div class="row">
	<div class="span10"></div>
</div>

<div class="row">
	<div class="span11">
		<form id="Contrato" onsubmit="return onEnviar()" name="Contrato" action="index.php?r=contratos/guardarContratos&idPaciente=<?php echo $elPaciente;?>" method = "post" >
		  

		    <a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Linea de Servicio </a>
			<hr>
			<table class "table">
				<tr>
					<th width="23%">Linea de Servicio</th>
					<th width="8%">Cantidad</th>
					<th width="12%">Valor Unitario</th>
					<th width="8%">Descuento</th>
					<th width="11%">V.U. con Descuento</th>
					<th width="11%">V.T. sin Descuento</th>
					<th width="11%">V.T. con Descuento</th>
					<th width="10%">Total</th>
					<th width="10%"></th>
				</tr>
			</table>

		   <div id="contenedorcampos">
		   
		   </div>
		  	
		  <div>
			<br>
			<label>Vendedor:</label>
			<select name='vendedor_id' id='vendedor_id'>
				<?php 
				$losVendedores = Personal::model()->findAll("activo = 'SI' and id > 0 order by 'nombres'");
				foreach($losVendedores as $los_vendedores){ ?>
				<option value='<?php echo $los_vendedores->id; ?>'><?php echo $los_vendedores->nombreCompleto; ?></option>
				<?php } ?>
			</select>
			
		  	<label>Observaciones:</label>
		  	<textarea rows="6" class = "input-xxlarge" name ="observaciones" id="observaciones"></textarea>
		  	<input id='variable' name='variable' hidden="hidden" />
		  	
		  </div>
		   <input type="submit" value="Guardar" name="Guardar" class="btn btn-warning">
		   <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</form>
	</div>
</div>


<script language='JavaScript' type='text/javascript'>
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
		"		 <select name='linea_" + campos + "' id='linea_" + campos + "'>" +
		"			<option value=''></option>"+
		"			<?php foreach($lineasdeservicio as $linea_servicio){ ?>"+
		"			<option value='<?php echo $linea_servicio->id; ?>'><?php echo $linea_servicio->nombre; ?></option>"+
		"			<?php } ?>"+
		"		 </select>"+
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' maxlength = 2 placeholder='Cantidad' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='V. Unitario' name='vu_" + campos + "' id='vu_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' maxlength = 5 placeholder='Descuento' autocomplete='off' name='desc_" + campos + "' id='desc_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='V.U Descuento' autocomplete='off' name='vu_desc_" + campos + "' id='vu_desc_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='Total sin Descuento' name='vt_sin_desc_" + campos + "' id='vt_sin_desc_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='Total con Descuento' name='vt_con_desc_" + campos + "' id='vt_con_desc_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-small' placeholder='Total' name='total_" + campos + "' id='total_" + campos + "' readonly='readonly'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
		"     </td>" +
		"   </tr>" +
		"</table>";
	

	var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);

    //Numero de campos
 document.getElementById("variable").value=variableJs;

    //Impedir ingresar letras
    $("#cantidad_"+ campos + "").keyup(function (){

        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
                
        //var total_sin_descuento = (eval($("#vu_"+ campos + "").val()) * eval($(this).val()));

        //Evaluar si descuento es diferente de cero
        if(eval($("#descuento_"+ campos + "").val()) == "0")
        {
        	//Saber posición actual
        	var posicion = this.name.replace(/[^\d]/g, '');
        	
         	var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($("#descuento_"+ posicion + "").val())/ 100));
			 var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());        		
			var totalfila = ((eval($("#vu_"+ posicion + "").val())) * $("#cantidad_"+ posicion + "").val());        		
	         $("#vu_desc_"+ posicion + "").val(0);
	         $("#vt_con_desc_"+ posicion + "").val(0);
	         $("#total_"+ posicion + "").val(totalfila);
        }
        else
        {
        	// var importe_total = ((eval($("#vu_"+ campos + "").val()) * eval($(this).val())));
        	// //importe_total = importe_total + eval($("vu_"+ campos + "").val());
        	//  $("#total_"+ campos + "").val(importe_total);

        	var posicion = this.name.replace(/[^\d]/g, '');
       

	        //importe_total = importe_total + eval($("vu_"+ campos + "").val());
	        var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($("#desc_"+ posicion + "").val())/ 100));
	        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());
	        
	        //$("#total_"+ campos + "").val(importe_total);
	        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
	        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
	        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
	        $("#total_"+ posicion + "").val(total_con_descuento);

        }
        
        superTotal();
        
        //$("#vt_sin_desc_"+ campos + "").val(total_sin_descuento);
       

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#total_"+ posicion + "").val(0);		
	    	}

    });

	function mensaje()
	{
		alert("Buenale");
	}

    //DESCUENTO
    $("#desc_"+ campos + "").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
        
        //Saber posición actual
        var posicion = this.name.replace(/[^\d]/g, '');
       

        //importe_total = importe_total + eval($("vu_"+ campos + "").val());
        var total_descuento = (eval($("#vu_"+ posicion + "").val()) * (eval($(this).val())/ 100));
        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());

        total_descuento = total_descuento.toFixed(2);
        total_con_descuento = total_con_descuento.toFixed(2);
        
        //$("#total_"+ campos + "").val(importe_total);
        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
        $("#total_"+ posicion + "").val(total_con_descuento);
        
        superTotal();

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#vu_desc_"+ campos + "").val(0);		
	    	}

    });


	//DESCUENTO INVERSA
    $("#vu_desc_"+ campos + "").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
        
        //Saber posición actual
        var posicion = this.name.replace(/[^\d]/g, '');
       

        var resta_valores = (eval($("#vu_"+ posicion + "").val()) - (eval($(this).val())));
        var porcentaje = ((resta_valores*100) / eval($("#vu_"+ posicion + "").val()));
        var total_descuento = (eval($("#vu_"+ posicion + "").val()) - eval($("#vu_desc_"+ posicion + "").val()));
        var total_con_descuento = ((eval($("#vu_"+ posicion + "").val()) - total_descuento) * $("#cantidad_"+ posicion + "").val());
        
        //$("#total_"+ campos + "").val(importe_total);
        $("#vu_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) - total_descuento);
        $("#desc_"+ posicion + "").val(porcentaje);
        $("#vt_con_desc_"+ posicion + "").val(total_con_descuento);
        $("#vt_sin_desc_"+ posicion + "").val(eval($("#vu_"+ posicion + "").val()) * $("#cantidad_"+ posicion + "").val());
        $("#total_"+ posicion + "").val(total_con_descuento);

        superTotal();

        //si la cantidad es cero no hacer nada
	     if ($(this).val() == "") 
	    	{
	    		$("#vu_desc_"+ campos + "").val(0);		
	    	}

    });




    //Cargar Valores en el formulario
    jQuery(document).ready(function($) {       
	$("#linea_" + campos +"").change(function(e) {
		//Saber posición actual
        			var posicion = this.name.replace(/[^\d]/g, '');                                                   
		//Tratar de hacer una consulta
		 $.ajax({
                    type: "POST",
                    url: "index.php?r=Presupuesto/precio",
                    data: "b="+$(this).val(),
                    dataType: "html",
                    
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){ 
                    

                          $("#resultado").empty();
                          //alert(data);
                          var variable = data;
                          $("#vu_" + posicion + "").val(variable);
                          $("#cantidad_" + posicion + "").val(1);
                          $("#desc_" + posicion + "").val(0);
                          $("#vu_desc_" + posicion + "").val(0);
                          $("#vt_sin_desc_" + posicion + "").val(variable);
                          $("#vt_con_desc_" + posicion + "").val(0);
                          $("#total_" + posicion + "").val(variable);
                          superTotal();
                                                             
                    }
              });
        
    //$("#vu_" + campos + "").val($(this).val());
    $("#vu_" + campos + "").val(variable);

    });

  	}
  	);
  }


//Calculo de Super total
function superTotal()
{
	var total_principal = 0;
	for (var i = 0; i < 20; i++) {
		if (typeof $("#total_"+ i + "").val() != 'undefined') {
			total_principal = total_principal + eval($("#total_"+ i + "").val());
		}
	};
	$("#total").val(total_principal);
}

function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
  superTotal();
  //variableJs = variableJs-1;
}

 function onEnviar(){
 	
 	//alert("No se envía el formulario");
 	
       document.getElementById("variable").value=variableJs;
       //document.getElementById("total").value=variableJs;

       //Validar todos los controles

       if($("#total").val() == "")
       {
       		swal("Falta completar información", "No ha seleccionado ninguna Linea de Servicio");
 			return false
       }

       var observaciones = $("#observaciones").val();
       if(observaciones == "")
       {
       		swal("Falta completar información", "Campo Observaciones esta vacio");
 			return false
       }
    }

function antesdeEnviar()
{
	swal({   title: "Estamos agendando la cita!",   text: "Solo tomara unos segundos.",   timer: 15000,   showConfirmButton: false });

}
</script>