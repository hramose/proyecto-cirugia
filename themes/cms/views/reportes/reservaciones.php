<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<!DOCTYPE html>
<html>
<body>
	<head>
		
	</head>
<div class="container">
	<div class="row-fluid">
		
			<div class="span4"></div>
			<div class="span4">
				<h1 class="text-center">Reportes de Reservaciones</h1>
				<br>
				<center>
				<img src="images/impresor_grande.png">
				</center>
				<br>
				
<?php 
$laurl = "index.php?r=imprimir/reservaciones&pdf=T";
?>
				<div class="well">
					<form method="post" action="<?php echo $laurl;?>" target="_blank" name="frm">
						<label>Tipo de reporte:</label>
						<select name="mi_reporte"> 
							<option value="1">Reservaciones Activas</option> 
							<option value="2">Reservaciones en Espera</option> 
							<option value="3">Reservaciones Cerradas</option> 
							<option value="4">Reservaciones Canceladas</option> 
						</select> 
						<label>Filtradas:</label>
						<select name="mi_filtro" id="mi_filtro" onChange="comprobarOption()">
							<option value="1">(Todas)</option> 
							<option value="2">Por Fecha</option> 
						</select>
						<label><b>Fecha de entrada:</b></label>
						<label>Desde:</label>
						<input type="date" name="mifecha_desde" id="mifecha_desde" step="1" disabled>
						<label>Hasta:</label>
						<input type="date" name="mifecha_hasta" id="mifecha_hasta" step="1" disabled>
						<br>
						<input type="submit" value="Imprimir" class="btn btn-primary">
					</form>
				</div>

			</div>
			<div class="span4">
				
			</div>
	</div>
</div>

<script>
	function comprobarOption(){
    var opcion_s = document.getElementById("mi_filtro").value;

    if(opcion_s == 1) 
    	{
    		document.frm.mifecha_desde.disabled = true;
     		document.frm.mifecha_hasta.disabled = true;

     	}
    else 
    	{
    		document.frm.mifecha_desde.disabled = false;
    		document.frm.mifecha_hasta.disabled = false;
    	}


}
</script>
</body>
</html>