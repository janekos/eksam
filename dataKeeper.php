<?php
	require_once("functions.php");
	
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
		
		exit();
	}
	
	if(isset($_GET["logout"])){
		
		session_destroy();
		
		header("Location: login.php");
		
	}
	
	$telli = "";
	$amount= "";
	$food_array = orderFood($telli, $amount);
	
	/*if(isset($_GET["telli_id"])){
		
		$telli = $_GET["telli_id"];
		
	}*/
	
	if(isset($_GET["telli_id"]) && isset($_GET["amount"])){
		
		$amount = $_GET["amount"];
		$telli = $_GET["telli_id"];
		
		orderFood($telli, $amount);
		
		header("Location: dataKeeper.php?telli_id=");
		
	}
	
?>
<p>Tere <?=$_SESSION["logged_in_user"];?>. <a href="?logout=1">Logi välja</a></p>
<p><a href="dataPeasant.php">Suundu</a> töötajate tabeli lehele.</p>
<h2>Toiduained mida tarvis tellida.</h2>
<table border="1">
	<?php

	if(!empty($food_array)){
			
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Toiduaine</th>";
		echo "<th>Lao kogus</th>";
		echo "<th>Vähim kogus</th>";
		echo "<th>Vajadus</th>";
		echo "<th>Telli juurde</th>";
		echo "</tr>";
		
		
		for($i = 0; $i < count($food_array); $i=$i+1){
				
			echo "<tr>";
			echo "<td>".$food_array[$i]->id."</td>";
			echo "<td>".$food_array[$i]->food."</td>";
			echo "<td>".$food_array[$i]->amount."</td>";
			echo "<td>".$food_array[$i]->amount_min."</td>";
			echo "<td>".$food_array[$i]->need."</td>";
			echo "<td><a href='dataKeeper.php?telli_id=".$food_array[$i]->id."'>Telli</a></td>";
			echo "</tr>";
				
		}
		
		if(!empty($_GET["telli_id"])){
			
			echo "<form method='get'>";
			echo "<input type='hidden' name='telli_id' value=".$_GET["telli_id"].">";
			echo "<input type='text' name='amount' placeholder='Toidu ühikuid'>";
			echo "<input type='submit' name='submit' value='Toiduaine nr".$_GET["telli_id"]."'>";
			echo "</form>";
			
		}
		
	}else{
		
		echo "Kõiki aineid on piisavas koguses!";
		
	}	
	?>
</table>