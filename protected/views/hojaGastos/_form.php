<?php
/* @var $this HojaGastosController */
/* @var $model HojaGastos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hoja-gastos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 

	if(isset($_GET['idCita']))
	{
		$laCita = $_GET['idCita'];
	}
	else
	{
		$laCita = "0";
	}

	if(isset($_GET['idPaciente']))
	{
		$idPaciente = $_GET['idPaciente'];
		//$idPaciente = $datosCita->paciente_id;
		$paciente = Paciente::model()->findByPk($idPaciente); 
	}
	else
	{
		$idPaciente = "0";
	}

	$datosCita = Citas::model()->findByPk($laCita);
	
?>
<?php if ($laCita!=0): ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<div class="span1"></div>
		<div class="span5">
			<h4 class="text-center">Datos de Paciente</h4>
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
			<h4 class="text-center">Datos de Cita</h4>
			<?php 
				if ($datosCita->fecha_cita!='') {
						$fecha_cita=date('d-m-Y',strtotime($datosCita->fecha_cita));
				}else{$fecha_cita=null;}

				$lahora = HorasServicio::model()->findByPK($datosCita->hora_fin + 1);

			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$datosCita,
				'attributes'=>array(			
					array('name'=>'Linea de Servicio', 'value'=>$datosCita->lineaServicio->nombre,''),
					array('name'=>'Fecha de Cita', 'value'=>$fecha_cita,''),
					array('name'=>'Hora de Inicio', 'value'=>$datosCita->horaInicio->hora,''),
					array('name'=>'Hora de Fin', 'value'=>$lahora->hora ,''),
					array('name'=>'Personal', 'value'=>$datosCita->personal->nombreCompleto ,''),
				),
			)); ?>
		</div>
		<div class="span1"></div>
	</div>
<hr>

<!-- Datos de Insumos -->
<a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Producto </a>
		<hr>
		<div class="row">
		<input id='variable' name='variable' type='hidden' />
		<div class="span12">

		<table class "table" width="100%">
			<tr>
				<th width="8%"><small>Codigo</small></th>
				<th width="25%"><small>Producto</small></th>
				<th width="12%"><small>Lote</small></th>
				<th width="21%"><small>Presentación</small></th>
				<th width="21%"><small>Unidad de Medida</small></th>
				<th width="10%"><small>Cant.</small></th>
				<th width="0%"></th>
			</tr>
		</table>

	   <div id="contenedorcampos">
	   
	   </div>
	   </div>
	</div>


<hr>
	<div class="row">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge'));?>			
		<?php echo $form->error($model,'observaciones'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
	$losProductos = InventarioPersonalDetalle::model()->findAll("cantidad > 0 and inventario_personal_id = ".Yii::app()->user->usuarioId);
?>

	
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
		"			<option value='<?php echo $los_productos->id; ?>'><?php echo $los_productos->producto->nombre_producto; ?></option>"+
		"			<?php } ?>"+
		"		 </select>"+
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-small' placeholder='' name='lote_" + campos + "' id='lote_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input' placeholder='' name='presentacion_" + campos + "' id='presentacion_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' readonly='readonly' class='input-normal' placeholder='' name='unidad_" + campos + "' id='unidad_" + campos + "'>" +
		"     </td>" +
		"     <td nowrap='nowrap'>" +
		"        <input type='text' class='input-mini' placeholder='' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
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


	$("#cantidad_"+ campos + "").keyup(function (){
		var posicion = this.name.replace(/[^\d]/g, '');
		//alert("Hola");
	    this.value = (this.value + '').replace(/[^0-9+\-Ee.]/g, '');
	    	
	    	//Verificar existencias
	    	if ($(this).val() > eval($("#existencia_"+ posicion + "").val())) 
	    	{
	    		sweetAlert("Oops...", "No hay más producto del requerido. Solo hay "+$("#existencia_"+ posicion + "").val()+" en existencia", "error");
	    		$(this).val(eval($("#existencia_"+ posicion + "").val()));
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
	            url: "index.php?r=hojaGastos/producto",
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
	                  $("#lote_" + posicion + "").val(variable.lote);
	                  $("#unidad_" + posicion + "").val(variable.unidad);
	                  $("#cantidad_" + posicion + "").val(1);
	                  $("#existencia_" + posicion + "").val(eval(variable.stock));
	                                                     
	            }
	      });
        

    //$("#vu_" + campos + "").val(variable);

    });
    });

}








function quitarCampo(iddiv){
  var eliminar = document.getElementById("divcampo_" + iddiv);
  var contenedor= document.getElementById("contenedorcampos");
  contenedor.removeChild(eliminar);
  //variableJs = variableJs-1;
}

</script>

<?php else: ?>
	<br>
	<div class="well">
	<h3>Debe estar dentro de una cita para llenar una hoja de gastos.</h3>
	<?php $this->endWidget(); ?>
	</div>
<?php endif ?>