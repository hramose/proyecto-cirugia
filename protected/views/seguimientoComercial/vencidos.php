<h2>Seguimientos Comerciales Vencidos por Personal de Servicio</h2>
<?php

$connection = Yii::app()->db;
//$sql = "SELECT personal_id, personal.nombres, personal.apellidos, count(*) as conteo FROM citas  left join personal  on citas.personal_id = personal.id WHERE estado = 'Vencida' GROUP by personal_id order by Conteo DESC";
$sql = "SELECT responsable_id, personal.nombres, personal.apellidos, count(*) as conteo FROM seguimiento_comercial  left join personal  on seguimiento_comercial.responsable_id = personal.id WHERE estado = 'Vencido' GROUP by responsable_id order by Conteo DESC";
$command = $connection->createCommand($sql);
$dataReader = $command->query();
//$rows = $dataReader->readAll();

?>
<div class="row">
	<div class="span8">
		<table class="table table-striped">
			<tr>
				<th>Personal</th>
				<th>Seguimientos Vencidos</th>
				<th></th>
			</tr>

		<?php

		foreach($dataReader as $row) 
		{
			?>

			<tr>
				<td><?php echo $row['nombres'] . " " .$row['apellidos'] ?></td>
				<td><?php echo $row['conteo']; ?></td>
				<td><a href="index.php?r=seguimientoComercial/vencidosDetalle&idPersonal=<?php echo $row['responsable_id']; ?>">[Ver]</a></td>
			</tr>

			<?php
		}
			
		?>
		</table>
		</div>
</div>