<?php
/* @var $this OrdenPedidoController */
/* @var $model OrdenPedido */
/* @var $form CActiveForm */
?>

<?php 
	$losTipos = TipoOrdenPedido::model()->findAll();
	$losProductos = ProductoInventario::model()->findAll("tipo_inventario='Consumibles'");
	$elPersonal = Personal::model()->findAll("activo = 'SI'");
?>


<div class="form">


<div class="row">
	<div class="span1"></div>
	<div class="span11">
		<form id="Formulacion" name="Formulacion" action="index.php?r=OrdenPedido/guardarOrden" method = "post" onsubmit="onEnviar()">
			<label for="">Personal que Recibe:</label>
			<select name='personalRecibe' id='personalRecibe' class='input-xxlarge'>
				<?php foreach($elPersonal as $el_personal){ ?>
				<option value='<?php echo $el_personal->id; ?>'><?php echo $el_personal->nombreCompleto; ?></option>
				<?php } ?>
			</select>
			<br>
		    <a href='JavaScript:agregarCampo();' class="btn btn-primary"> Agregar Consumible </a>
			<hr>
			<table class "table table-condence" width="100%">
				<tr>
					<th width="10%">Tipo</th>
					<th width="50%">Detalle</th>
					<th width="25%">Area</th>
					<th width="10%">Cantidad</th>
					<th width="5%"></th>
				</tr>
			</table>

		   <div id="contenedorcampos">
		   
		   </div>
		  <textarea rows='4' class = 'input-xxlarge' placeholder='Observaciones' name ='observacion' id='observacion'></textarea>
		  <div>
		  	<input id='variable' name='variable' type='hidden' />
		  	
		  </div>
		   <input type="submit" value="Guardar" name="Guardar" class="btn btn-warning">
		   <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</form>
	</div>
</div>


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
			"		 <select name='tipo_" + campos + "' id='tipo_" + campos + "' class='input-small'>" +
			"			<?php foreach($losTipos as $los_tipos){ ?>"+
			"			<option value='<?php echo $los_tipos->id; ?>'><?php echo $los_tipos->tipo_corto; ?></option>"+
			"			<?php } ?>"+
			"		 </select>"+
			"     </td>" +
			"     <td nowrap='nowrap'>" +
			"		 <select name='productos_" + campos + "' id='productos_" + campos + "' class='input-xxlarge'>" +
			"			<?php foreach($losProductos as $los_productos){ ?>"+
			"			<option value='<?php echo $los_productos->id; ?>'><?php echo $los_productos->nombre_producto; ?></option>"+
			"			<?php } ?>"+
			"		 </select>"+
			"     </td>" +
			"     <td nowrap='nowrap'>" +
			"        <input type='text' class='input-large' placeholder='Area' name='area_" + campos + "' id='area_" + campos + "'>" +
			"     </td>" +
			"     <td nowrap='nowrap'>" +
			"        <input type='text' class='input-mini' placeholder='Cantidad' name='cantidad_" + campos + "' id='cantidad_" + campos + "'>" +
			"     </td>" +
			"     <td nowrap='nowrap'>" +
			"        <a href='JavaScript:quitarCampo(" + campos +");' class='btn btn-mini btn-danger'> [x] </a>" +
			"     </td>" +
			"   </tr>" +
			"</table>";
		var contenedor= document.getElementById("contenedorcampos");
	    contenedor.appendChild(NvoCampo);
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
	</script>



