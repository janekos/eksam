<?php
	require_once("functions.php");
	
	$gary="0";
	
	if(isset($_SESSION["logged_in_user"])){
		
		$gary = "1";
		
	}
	
	if(isset($_GET["logout"])){
		
		session_destroy();
		
		header("Location: login.php");
		
	}
	
	$food_array = getFood();
	
	if(isset($_GET["counter"])){
		
		$food = $_GET["food_id"];
		foodCount($food);
		
	}
	
	
?>
<p><a href="index.html">Tagasi</a> pealehele.</p>

<?php
if($gary == "1"){
	echo "<p><a href='dataKeeper.php'>Tagasi</a> laohoidja lehele.</p>";
	echo "<a href='?logout=1'>Logi välja</a>";
}
?>

<h2>Laos leiduvad toiduained</h2>

<table border="1">
	<tr>
		<th>Id</th>
		<th>Toiduaine</th>
		<th>Lao kogus</th>
		<th>Vähim kogus</th>
		<th>Võta</th>
		<th>Vaja rohkem</th>
	</tr>
	
	<?php
		for($i = 0; $i < count($food_array); $i=$i+1){
			echo "<tr>";
			echo "<td>".$food_array[$i]->id."</td>";
			echo "<td>".$food_array[$i]->food."</td>";
			echo "<td>".$food_array[$i]->amount."</td>";
			echo "<td>".$food_array[$i]->amount_min."</td>";
			echo "<td><a href='registerFood.php?food_id=".$food_array[$i]->id."'>Võta</a></td>";
			echo "<td><a href='dataPeasant.php?food_id=".$food_array[$i]->id."&counter=1'>Rohkem seda</a></td>";
			echo "</tr>";
		}
	?>
</table>

<p><a href="addFood.php">Lisa</a> veel toiduaineid.</p>