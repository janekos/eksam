<?php
	require_once("functions.php");
	
	$food_array = getFood();
?>
<p><a href="login.php">Tagasi</a> sisselogimis lehele.</p>

<h2>Laos leiduvad toiduained</h2>
<table border="1">
	<tr>
		<th>Id</th>
		<th>Toiduaine</th>
		<th>Lao kogus</th>
		<th>Vähim kogus</th>
	</tr>
	
	<?php
		for($i = 0; $i < count($food_array); $i=$i+1){
			echo "<tr>";
			echo "<td>".$food_array[$i]->id."</td>";
			echo "<td>".$food_array[$i]->food."</td>";
			echo "<td>".$food_array[$i]->amount."</td>";
			echo "<td>".$food_array[$i]->amount_min."</td>";
			echo "</tr>";
		}
	?>
</table>
<br>
<p><a href="addFood.php">Lisa</a> veel toiduaineid.</p>