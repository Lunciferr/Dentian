<?php
include 'db_connection.php';
session_start();
$errorMessage = "";

if (isset($_POST["login"])) {
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPass'];

	$db = new DB_Connect();
	$stmt = $db->connect()->prepare("SELECT * FROM user_table WHERE username = ? and password = ?");
	$stmt->execute([$username, $password]);

	if ($stmt->rowCount() > 0) {
		$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$_SESSION['Role'] = $user[0]["Role"];
		$_SESSION['Name'] = $user[0]["First_Name"] . " " . $user[0]["Last_Name"];

		header("Location: Session.php");
	} else {
		$errorMessage = '<div class="alert alert-danger bi-exclamation-triangle-fill" role="alert"> Incorrect credentials. Please try again!</div>';
	}
}
if (isset($_POST["login"])) {
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPass'];

	$db = new DB_Connect();
	$stmt = $db->connect()->prepare("SELECT * FROM patient_profile WHERE Patient_ID = ? and NRIC_PNum = ?");
	$stmt->execute([$username, $password]);

	if ($stmt->rowCount() > 0) {
		$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$_SESSION['Status'] = $user[0]["Status"];
		$_SESSION['Patient_ID'] = $user[0]["Patient_ID"];
		$_SESSION['Name'] = $user[0]["First_Name"] . " " . $user[0]["Last_Name"];

		header("Location: Session.php");
	} else {
		$errorMessage = '<div class="alert alert-danger bi-exclamation-triangle-fill" role="alert"> Incorrect credentials. Please try again!</div>';
	}
}
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<title>Login</title>
</head>
<style>
	#top-bg {
		position: absolute;
		width: 1500px;
		height: 550px;
		left: -520px;
		top: -120px;
		transform: rotate(-45deg);
	}

	#bot-bg {
		position: fixed;
		width: 1500px;
		height: 550px;
		right: -480px;
		bottom: -200px;
		transform: rotate(135deg);
	}

	#dentian-logo {
		margin-top: 150px;
	}
</style>

<body style="background-color:#C6A98F;">
	<div class="container text-center mb-5">
		<img id="top-bg" src="img/bg.png" alt="bgtop" width="300" height="300">
		<img id="bot-bg" src="img/bg.png" alt="bgbot" width="300" height="300">
		<img id="dentian-logo" src="img/Logo1.png" alt="logo" width="300" height="100">
		<form class="" method="POST" style="max-width: 480px; margin:auto;">
			<h1 class="text-nowrap mt-5">Dental Record Management</h1>
			<div class="tab-content" id="login-tab">
				<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
					<h3 class="mt-4">Sign In</h3>
					<?php
					echo "$errorMessage";
					?>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" placeholder="Username" name="loginUsername" autofocus>
						<label for="floatingInput">Username</label>
					</div>
					<div class="form-floating">
						<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="loginPass" autofocus>
						<label for="floatingPassword">Password</label>

						<div class="text-end">
							<a href="#!">Forgot password?</a>
						</div>
					</div>
					<div class="mt-3">
						<button class="btn btn-lg btn-primary btn-block" name="login">Login</button>
					</div>
				</div>
		</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>