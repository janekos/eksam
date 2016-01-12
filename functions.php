<?php
	require_once("../config_global.php");
	$database = "if15_janekos_3";
	
	session_start();
	
	function createUser($create_user, $password){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO v_user (user, password) VALUES (?,?)");
		echo $mysqli->error;
		$stmt->bind_param("ss", $create_user, $password);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();
	}
	
	function loginUser($user, $password){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, user FROM v_user WHERE user=? AND password=?");
		$stmt->bind_param("ss", $user, $password);
		$stmt->bind_result($id_from_db, $user_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			echo "Email ja parool õiged, kasutaja id=".$id_from_db;
			
			$_SESSION["logged_in_user_id"] = $id_from_db;
			$_SESSION["logged_in_user"] = $user_from_db;
			
			header("Location: data.php");
			
		}else{
			echo "Email või parool valed.";
		}
		$stmt->close();
		$mysqli->close();
	}
	
	function getFood(){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, food, amount, amount_min FROM v_ladu");
		$stmt->bind_result($id, $food, $amount, $amount_min);
		$stmt->execute();
		$food_array = array();
		while($stmt->fetch()){
			$foods = new StdClass();
			$foods->id = $id;
			$foods->food = $food;
			$foods->amount = $amount;
			$foods->amount_min = $amount_min;
			array_push($food_array, $foods);
		}
		return $food_array;
		$stmt->close();
		$mysqli->close();
	}
	
	/*function deleteCar($id){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE car_plates SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id);
		if ($stmt->execute()){
			header("Location: table.php");
		}
		$stmt->close();
		$mysqli->close();
	}
	
	function updateCAR($id, $number_plate, $color){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE car_plates SET number_plate=?, color=? WHERE id=?");
		$stmt->bind_param("ssi", $number_plate, $color, $id);
		if ($stmt->execute()){
			header("Location: table.php");
		}
		$stmt->close();
		$mysqli->close();
	}*/
	
?>