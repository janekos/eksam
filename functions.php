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
			
			header("Location: dataKeeper.php");
			
		}else{
			echo "Email või parool valed.";
		}
		$stmt->close();
		$mysqli->close();
	}
	
	function getFood(){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, food, amount, amount_min FROM v_stock");
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
	
	function addFood($food, $amount_min){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO v_stock (food, amount_min) VALUES (?,?)");
		$stmt->bind_param("si", $food, $amount_min);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();
	}
	
	function orderFood($telli, $amount1){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		if(empty($telli)){
			
			$stmt = $mysqli->prepare("SELECT id, food, amount, amount_min, need FROM v_stock WHERE (amount < amount_min) OR (need > 0) ORDER BY need DESC");
			$stmt->bind_result($id, $food, $amount, $amount_min, $need);
			$stmt->execute();
			$food_array = array();
			while($stmt->fetch()){
				$foods = new StdClass();
				$foods->id = $id;
				$foods->food = $food;
				$foods->amount = $amount;
				$foods->amount_min = $amount_min;
				$foods->need = $need;
				array_push($food_array, $foods);
			}
			return $food_array;
			$stmt->close();
			
		}else{
			
			$stmt = $mysqli->prepare("UPDATE v_stock SET amount = ?, need = 0 WHERE id = ?");
			$stmt->bind_param("ii", $amount1, $telli);
			$stmt->execute();
			$stmt->close();
			
		}
		
		$mysqli->close();
		
	}
	
	function registerFood($id1, $amount1){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		if(empty($amount1)){
			$stmt = $mysqli->prepare("SELECT id, food, amount FROM v_stock WHERE id = ?");
			$stmt->bind_param("i", $id1);
			$stmt->bind_result($id, $food, $amount);
			$stmt->execute();
			$food_array = array();
			while($stmt->fetch()){
				$foods = new StdClass();
				$foods->id = $id;
				$foods->food = $food;
				$foods->amount = $amount;
				array_push($food_array, $foods);
			}
			return $food_array;
			$stmt->close();
			
		}else{
			
			$stmt = $mysqli->prepare("UPDATE v_stock SET amount = (amount - ?) WHERE id = ?");
			$stmt->bind_param("ii", $amount1, $id1);
			$stmt->execute();
			$stmt->close();
			
		}
		
		$mysqli->close();
		
	}
	
	function foodCount($id){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE v_stock SET need = (need + 1) WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();
		
	}
	
?>