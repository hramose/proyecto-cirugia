<?php
/* @var $this CitasController */
/* @var $model Citas */
?>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<!DOCTYPE html>
<html>
<body>
	<head>
	<h2>Bloquear Agenda a Personal</h2>
	<p>Seleccione el personal al que desea bloquear la agenda.</p>	
	</head>
	<div class="container">
		<div class="well">
		<form action="">
			<label for="">Persona:</label>
			<select name="personal" id="personal" class='input-xxlarge'>
				<option value="">(Seleccione)</option>
				<?php 

					$elPersonal = Personal::model()->findAll("activo ='Si' and agenda='Si'");
					foreach ($elPersonal as $el_personal) 
					{
						?>
							<option value=<?php echo $el_personal->id; ?>><?php echo $el_personal->nombreCompleto; ?></option>
						<?php
					}

				?>
			</select>
		</form>
		</div>
	</div>
</body>
</html>