<?php
		//loon andmebaasi ühenduse
	require_once("functions.php");
	
	if(isset($_SESSION["logged_in_user_id"])){
		header("Location: data.php");
	}

  // muuutujad errorite jaoks
	$user_error = "";
	$password_error = "";
	$create_user_error = "";
	$create_password_error = "";

  // muutujad väärtuste jaoks
	$user = "";
	$password = "";
	$create_user = "";
	$create_password = "";


	if($_SERVER["REQUEST_METHOD"] == "POST") {

    // *********************
    // **** LOGI SISSE *****
    // *********************
		if(isset($_POST["login"])){

			if ( empty($_POST["user"]) ) {
				$user_error = "See väli on kohustuslik";
			}else{

				$user = cleanInput($_POST["user"]);
			}

			if ( empty($_POST["password"]) ) {
				$password_error = "See väli on kohustuslik";
			}else{
				$password = cleanInput($_POST["password"]);
			}

			if($password_error == "" && $user_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$user." ja parool on ".$password.". ";
				
				loginUser($user, $password);
				
			}

		}

    // *********************
    // ** LOO KASUTAJA *****
    // *********************
		if(isset($_POST["create"])){

			if ( empty($_POST["create_user"]) ) {
				$create_user_error = "See väli on kohustuslik";
			}else{
				$create_user = cleanInput($_POST["create_user"]);
			}

			if ( empty($_POST["create_password"]) ) {
				$create_password_error = "See väli on kohustuslik";
			} else {
				if(strlen($_POST["create_password"]) < 8) {
					$create_password_error = "Peab olema vähemalt 8 tähemärki pikk!";
				}else{
					$create_password = cleanInput($_POST["create_password"]);
				}
			}

			if(	$create_user_error == "" && $create_password_error == ""){
				
				echo "Võib kasutajat luua! Kasutajanimi on ".$create_user." ja parool on ".$create_password.".";
				
				createUser($create_user, $create_password);
			}

		}

	}

  // funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
  function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
</head>
<body>

  <h2>Log in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="user" type="text" placeholder="Laohoidja kasutaja" value="<?php echo $user; ?>"> <?php echo $user_error; ?><br><br>
  	<input name="password" type="password" placeholder="Parool" value="<?php echo $password; ?>"> <?php echo $password_error; ?><br><br>
  	<input type="submit" name="login" value="Log in">
  </form>

  <h2>Create user</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="create_user" type="text" placeholder="Uus laohoidja" value="<?php echo $create_user; ?>"> <?php echo $create_user_error; ?><br><br>
  	<input name="create_password" type="password" placeholder="Parool"> <?php echo $create_password_error; ?> <br><br>
  	<input type="submit" name="create" value="Create user">
  </form>
  <br>
  <p><a href="dataPeasant.php">Sisene</a> külastajana.</p>
</body>
</html>
