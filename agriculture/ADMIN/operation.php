<?php
	session_start();
	include('db_connection.php');
   // header('Content-Type: application/json');
	$result = array();
	switch($_POST['functionname']) {
		case 'register':
			$username = mysqli_real_escape_string($conn, $_POST['name']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			$user_check_query = "SELECT * FROM admin WHERE username='$username' OR email='$email' LIMIT 1";
			$results = mysqli_query($conn, $user_check_query);
			$user = mysqli_fetch_assoc($results);

			if ($user['username'] === $username) {
				$result["code"] = 0;
				$result["message"] = "Username already exists";
			}
			if ($user['email'] === $email) {
				$result["code"] = 0;
				$result["message"] = "Email already exists";
			}

			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO ADMIN (username, email, password) VALUES('$username', '$email', '$password')";
			mysqli_query($conn, $query);
			$_SESSION['username'] = $username;
			$result["code"] = 1;
			$result["message"] = "Success";
			echo json_encode($result);
			die;
		break;
		case 'login':
			$username = mysqli_real_escape_string($conn, $_POST['name']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$password = md5($password);
			$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$result["code"] = 1;
				$result["message"] = "Success";
			}else {
				$result["code"] = 0;
				$result["message"] = "Wrong credentials";
			}
			echo json_encode($result);
			die;
		break;
		case 'add_combo':
			$id1 = $_POST['id1'];
			$id2 = $_POST['id2'];
			$val1 = $_POST['val1'];
			$val2 = $_POST['val2'];
			$table = $_POST['table'];
			$success = mysqli_query($conn,"INSERT INTO ".$table." ($id1, $id2) VALUES ('$val1', '$val2')");
			if (!$success)
			{
				echo("Error description: " . mysqli_error($conn));
			}
			else
			{
				echo $success;
			}
			mysqli_close($conn);
		break;
		case 'add_1':
			$name = $_POST['name'];
			$table = $_POST['table'];
			echo $success = mysqli_query($conn,"INSERT INTO ".$table." (`name`) VALUES ('$name')");
			mysqli_close($conn);
		break;
		case 'addpest':
			$name = $_POST['name'];
			$disease = $_POST['disease'];
			echo $success = mysqli_query($conn,"INSERT INTO pesticide (`pest_name`, `disease_name`) VALUES ('$name', '$disease')");
			mysqli_close($conn);
		break;
		case 'addplough':
			$name = $_POST['name'];
			$tool = $_POST['tool'];
			echo $success = mysqli_query($conn,"INSERT INTO plough (`plough_name`, `tool_name`) VALUES ('$name', '$tool')");
			mysqli_close($conn);
		break;
		case 'delete':
			$id = $_POST['id'];
			$table = $_POST['table'];
			$column = $_POST['column'];
			echo $success = mysqli_query($conn,"Delete from ".$table."  WHERE ".$column."=".$id."");
			mysqli_close($conn);
		break;
		default:
		   $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
		break;
	}
?>
