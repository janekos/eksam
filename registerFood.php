<?php

	require_once("functions.php");
	$amount="";
	$food_id=$_GET["food_id"];
	
	$food_array = registerFood($food_id, $amount);
	
	if(isset($_GET["submit"])){
		
		$food_id = $_GET["food_id"];
		$amount = $_GET["amount"];
		
		registerFood($food_id, $amount);
		
		header("Location: dataPeasant.php");
		
	}

?>
<p>Hetkel võtad <?=$food_array[0]->food;?>. Laos on hetkel <?=$food_array[0]->amount;?> ühikut</p>
<form method="get">
	<input type="hidden" name="food_id" value="<?=$food_array[0]->id;?>">
	<input type="number" name="amount" max="<?=$food_array[0]->amount;?>">
	<input type="submit" name="submit" value="Registreeri.">
</form>
<p><a href="dataPeasant.php">Tagasi</a> toiduühikute tabeli lehele.</p>