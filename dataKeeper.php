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
	
	orderFood();
	/*if(isset($_GET["delete"])){
		echo "kustutame id ".$_GET["delete"];
		deleteCar($_GET["delete"]);
	}
	
	if(isset($_POST["save"])){
		updateCar($_POST["id"], $_POST["plate_number"], $_POST["color"]);
	}
	
	$car_array = getCarData();
	*/
	//echo $car_array[0]->id." ".$car_array[0]->plate;
?>
<p>Tere <?=$_SESSION["logged_in_user"];?>. <a href="?logout=1">Logi välja</a></p>
<!--<h2>Tabel</h2>
<table border="1">
	<tr>
		<th>id</th>
		<th>user id</th>
		<th>number plate</th>
		<th>color</th>
		<th>DELETE</th>
		<th>edit</th>
	</tr>

	<?php/*
	
		for($i = 0; $i < count($car_array); $i=$i+1){
			
			if(isset($_GET["edit"]) && $car_array[$i]->id == $_GET["edit"]){
				
				echo "<tr>";
				echo "<form action='table.php' method='post'>";
				echo "<input type='hidden' name='id' value='".$car_array[$i]->id."'>";
				echo "<td>".$car_array[$i]->id."</td>";
				echo "<td>".$car_array[$i]->user."</td>";
				echo "<td><input name='plate_number' value='".$car_array[$i]->plate."'></td>";
				echo "<td><input name='color' value='".$car_array[$i]->color."'></td>";
				echo "<td><a href='table.php'>cancel</a></td>";
				echo "<td><input type='submit' name='save' value='save'></td>";
				echo "</form>";
				echo "</tr>";
				
			}else{
				
				echo "<tr>";
				echo "<td>".$car_array[$i]->id."</td>";
				echo "<td>".$car_array[$i]->user."</td>";
				echo "<td>".$car_array[$i]->plate."</td>";
				echo "<td>".$car_array[$i]->color."</td>";
				echo "<td><a href='?delete=".$car_array[$i]->id."'>X</a></td>";
				echo "<td><a href='?edit=".$car_array[$i]->id."'>edit</a></td>";
				echo "</tr>";
				
			}
		}
	
	?>

</table>-->