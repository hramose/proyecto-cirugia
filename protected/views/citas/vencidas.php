<h2>Control de Citas Vencidas por Personal de Servicio</h2>
<?php

$connection = Yii::app()->db;
$sql = "SELECT Personal.nombres, Personal.apellidos, count(*) as conteo FROM Citas  left join Personal  on Citas.personal_id = Personal.id WHERE estado = 'Vencida' GROUP by personal_id order by Conteo DESC";
$command = $connection->createCommand($sql);
$dataReader = $command->query();
//$rows = $dataReader->readAll();

?>
<div class="row">
	<div class="span10">
		<table class="table table-striped">
			<tr>
				<th>Personal</th>
				<th>Citas Vencidas</th>
				<th></th>
			</tr>

		<?php

		foreach($dataReader as $row) 
		{
			?>

			<tr>
				<td><?php echo $row['nombres'] . " " .$row['apellidos'] ?></td>
				<td><?php echo $row['conteo']; ?></td>
				<td>[Ver]</td>
			</tr>

			<?php
		}
			
		?>
		</table>
		</div>
</div>