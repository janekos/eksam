<?php

	require_once("functions.php");
	
	if(isset($_POST["submit"])){
		
		addfood($_POST["food"], $_POST["amount_min"]);
		
		header("Location: dataPeasant.php");
		
	}

?>
<h2>Lisa veel toiduaineid.</h2>
<form method="post">

	<label>Toiduained:</label><br>
	<input type="text" name="food" placeholder="Toiduaine"><br><br>
	
	<label>Selle toiduaine vähim<br>nõutud kogus:</label><br>
	<input type="text" name="amount_min" placeholder="Selle vähim kogus"><br><br>
	
	<input type="submit" name="submit" value="Esita">
</form>

<p><a href="dataPeasant.php">Tagasi</a>.</p>