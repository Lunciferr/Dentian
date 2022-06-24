<?php
ob_start();
include 'db_connection.php';
include 'Navbar.php';

if (!isset($_SESSION['Role']) && empty($_SESSION['Role'])) {
	header("Location: index.php");
} else {
	if (!isset($_SESSION['temp']) && empty($_SESSION['temp'])) {
		$db = new DB_Connect();
		// unset($users);

		$stmt = $db->connect()->prepare("SELECT * FROM user_table");
		$stmt->execute();
		$errormsg = '';
		$rowCount = '';


		if ($stmt->rowCount() > 0) {
			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	} else {
		$users = $_SESSION['temp'];
		$errormsg = $_SESSION['errorMsg'];
		$rowCount = $_SESSION['rowCount'];
	}
}

if (isset($_POST["allUsers"])) {
	unset($_SESSION['temp']);
	$db = new DB_Connect();

	$stmt = $db->connect()->prepare("SELECT * FROM user_table");
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$errormsg = '';
		$rowCount = '';
	}
}

if (isset($_POST["createBtn"])) {
	$db = new DB_Connect();
	$stmt = $db->connect()->prepare("SELECT MAX(Emp_ID) from user_table where Role='Dentist'");
	$stmt->execute();
	$empID = $stmt->fetch()[0] + 1;

	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	$username = $_POST['add_username'];
	$password = $_POST['add_password'];
	$nric = $_POST['add_nric'];
	$gender = $_POST['add_gender'];
	$dob = $_POST['add_dob'];
	$address = $_POST['add_address'];
	$mobileNum = $_POST['add_mobileNum'];
	$email = $_POST['add_email'];
	$role = $_POST['add_role'];
	$specialization = $_POST['add_special'];

	if ($role == "System Admin") {
		$stmt = $db->connect()->prepare("SELECT MAX(Emp_ID) from user_table where Role='System Admin'");
		$stmt->execute();
		$maxempID = $stmt->fetch()[0];
		if ($maxempID == 0) {
			$empID = '4001';
		} else {
			$empID = $maxempID + 1;
		}
	} elseif ($role == "Dentist") {
		$stmt = $db->connect()->prepare("SELECT MAX(Emp_ID) from user_table where Role='Dentist'");
		$stmt->execute();
		$maxempID = $stmt->fetch()[0];
		if ($maxempID == 0) {
			$empID = '1001';
		} else {
			$empID = $maxempID + 1;
		}
	} elseif ($role == "Dentist Assistant") {
		$stmt = $db->connect()->prepare("SELECT MAX(Emp_ID) from user_table where Role='Dentist Assistant'");
		$stmt->execute();
		$maxempID = $stmt->fetch()[0];
		if ($maxempID == 0) {
			$empID = '2001';
		} else {
			$empID = $maxempID + 1;
		}
	} elseif ($role == "Receptionist") {
		$stmt = $db->connect()->prepare("SELECT MAX(Emp_ID) from user_table where Role='Receptionist'");
		$stmt->execute();
		$maxempID = $stmt->fetch()[0];
		if ($maxempID == 0) {
			$empID = '3001';
		} else {
			$empID = $maxempID + 1;
		}
	}

	$stmt = $db->connect()->prepare("INSERT INTO `user_table`(`Emp_ID`, `First_Name`, `Last_Name`, `username`, `password`, `NRIC_PNum`, `Gender`, `Birth_Date`, `Address`, `Phone_Num`, `Email`, `Role`, `Specialization`) VALUES ('$empID','$firstname','$lastname',
	'$username','$password','$nric','$gender','$dob','$address','$mobileNum','$email','$role','$specialization')");
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo '<meta http-equiv="refresh" content="1">';
		echo "<span class='d-block p-2 bg-success text-white text-center'>New record successfully added!</span>";
		header("Location: AdminDashboard.php");
		return true;
	} else {
		echo "<span class='d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center' role='alert'> Record couldnt be added!</span>";
		return false;
	}
}

if (isset($_POST["updateBtn"])) {
	$empID = $_POST['userID'];
	$first = $_POST['firstName'];
	$last = $_POST['lastName'];
	$username = $_POST['edit_username'];
	$password = $_POST['password'];
	$nric = $_POST['edit_nric'];
	$gender = $_POST['gender'];
	$bday = $_POST['edit_dob'];
	$hpNum = $_POST['mobileNum'];
	$email = $_POST['emailAdd'];
	$addr = $_POST['address'];
	//$role= $_POST['role'];
	$special = $_POST['e_special'];


	$stmt = $db->connect()->prepare("UPDATE `user_table` SET `First_Name`='$first',`Last_Name`='$last',`username`='$username',`password`='$password',
	`NRIC_PNum`='$nric',`Gender`='$gender',`Birth_Date`='$bday',`Address`='$addr',`Phone_Num`='$hpNum',`Email`='$email',`Specialization`='$special' WHERE `Emp_ID`=$empID");
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo '<meta http-equiv="refresh" content="1">';
		echo "<span class='d-block p-2 bg-success text-white text-center'>Record successfully updated!</span>";
		header("Location: AdminDashboard.php");
		return true;
	} else {
		echo "<span class='d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center' role='alert'> Record couldnt be updated!</span>";
		return false;
	}
}

if (isset($_POST["deleteBtn"])) {
	$empID = $_POST['dUserID'];

	$stmt = $db->connect()->prepare("DELETE FROM `user_table` WHERE `Emp_ID`= $empID");
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		echo '<meta http-equiv="refresh" content="1">';
		echo "<span class='d-block p-2 bg-success text-white text-center'>Record successfully deleted!</span>";
		header("Location: AdminDashboard.php");
		return true;
	} else {
		echo "<span class='d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center' role='alert'> Record couldnt be deleted!</span>";
		return false;
	}
}
?>

<html>

<head>
	<title> Administrator Page </title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<style>
		p,
		td {
			font-family: garamond;
			font-size: 14pt;
		}

		td,
		th {
			border: 1px solid #ddd;
		}

		table {
			width: 50%;
			background-color: white;
			text-align: left;
		}

		.center {
			text-align: center;
		}

		.errorMsg {
			color: red;
		}

		.button {
			position: absolute;
			left: 100px;
			top: 100px;
			background-color: #9E989B;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
		}

		.button {
			border-radius: 12px;
		}

		body {
			background-image: url('img/AdminBackground.png');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}

		.form-outline {
			background-color: white;

		}

		.topnav input[type=text] {
			border: 5px solid #ccc;
		}
	</style>
</head>

<body>
	<div class="w-100 p-3">
		<nav class="navbar navbar-light bg-transparent">
			<div class="container-fluid mb-3">
				<!-- Create Account Button -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAcc">Create New User Account <i class="bi bi-plus-square"></i></button>
			</div>
		</nav>
		<table class="table">
			<thead class="table-dark">
				<tr>
					<th scope="col" style="width: 100px">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Username</th>
					<th scope="col" style="display:none">Password</th>
					<th scope="col">NRIC/Passport No.</th>
					<th scope="col" style="display:none">Gender</th>
					<th scope="col" style="width: 200px">DOB</th>
					<th scope="col" style="display:none">Address</th>
					<th scope="col" style="width: 400px">Phone Number</th>
					<th scope="col" style="width: 400px">Email</th>
					<th scope="col" style="width: 200px">Roles</th>
					<th scope="col" style="display:none">Specialization</th>
					<th scope="col" style="width: 100px">View/Edit</th>
					<th scope="col" style="width: 120px">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($users as $user) {
					echo
					'<tr>' .
						'<th scope="row">' . $user['Emp_ID'] . '</th>' .
						'<td class="firstName">' . $user['First_Name'] . ' ' . $user['Last_Name'] . '</td>' .
						'<td>' . $user['username'] . '</td>' .
						'<td style=display:none>' . $user['password'] . '</td>' .
						'<td>' . $user['NRIC_PNum'] .
						'<td style=display:none>' . $user['Gender'] . '</td>' .
						'<td>' . $user['Birth_Date'] . '</td>' .
						'<td style=display:none>' . $user['Address'] . '</td>' .
						'<td>' . $user['Phone_Num'] . '</td>' .
						'<td>' . $user['Email'] . '</td>' .
						'<td>' . $user['Role'] . '</td>' .
						'<td style=display:none>' . $user['Specialization'] . '</td>' .
						'<td><button type="button" class="btn btn-secondary editBtn" data-bs-toggle="modal" data-bs-target="#editAcc">Edit <i class="bi bi-pencil-square"></i></button></td>' .
						'<td><button type="button" class="btn btn-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteAcc">Delete <i class="bi bi-trash"></i></button></td>' .
						'</tr>';
				}

				?>
			</tbody>
		</table>
		<?php
		echo "$errormsg";

		if ($rowCount == 1) {
			echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount result found!</span>";
		} else if ($rowCount > 1) {
			echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount results found!</span>";
		}
		?>
	</div>
	<!-- Create Account Form Modal -->
	<div class="modal fade" id="createAcc" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Enter User details</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="needs-validation" method="POST" novalidate>
						<div class="mb-3">
							<label class="form-label">First Name</label>
							<input type="text" class="form-control" name="fname" id="fname" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required>
							<div class="invalid-feedback">
								Please enter first name.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Last Name</label>
							<input type="text" class="form-control" name="lname" id="lname" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required>
							<div class="invalid-feedback">
								Please enter last name.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Username</label>
							<input type="text" class="form-control" name="add_username" id="add_username" required>
							<div class="invalid-feedback">
								Please enter a username.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="password" class="form-control" name="add_password" id="add_password" required>
							<div class="invalid-feedback">
								Please enter a password.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">NRIC/Passport No.</label>
							<input type="text" class="form-control" name="add_nric" id="add_nric" pattern="[A-Za-z][0-9]{7}[A-Za-z]" required>
							<div class="invalid-feedback">
								Please enter a valid NRIC/Passport No.
							</div>
						</div>
						<div class="mb-2">
							<label class="form-label">Gender</label><br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="add_gender" id="add_genderM" value="M" required>
								<label class="form-check-label" for="inlineRadio1">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="add_gender" id="add_genderF" value="F" required>
								<label class="form-check-label" for="inlineRadio2">Female</label>
							</div>
							<div class="form-check p-0">
								<input type="radio" name="add_gender" style="display: none;" required>
								<div class="invalid-feedback">
									Please choose a gender.
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Birth date</label>
							<input type="date" class="form-control" name="add_dob" id="add_dob" required>
							<div class="invalid-feedback">
								Please select a date.
							</div>
						</div>
						<div class="mb-3">
							<div class="form-outline mb-3">
								<label class="form-label">Address</label>
								<textarea class="form-control" rows="5" name="add_address" id="add_address" required></textarea>
								<div class="invalid-feedback">
									Please enter a residential address.
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Phone Number</label>
							<input type="text" class="form-control" pattern="[8-9]{1}[0-9]{7}" name="add_mobileNum" id="add_mobileNum" required>
							<div class="invalid-feedback">
								Please enter a valid singapore mobile number.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Email Address</label>
							<input type="email" class="form-control" name="add_email" id="add_email" required>
							<div class="invalid-feedback">
								Please enter a valid email address.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Role</label>
							<select class="form-select" aria-label="Default select example" name="add_role" id="add_role" onchange="showDiv('special_add', this)" required>
								<option value="">Choose a role</option>
								<option value="System Admin">System Admin</option>
								<option value="Dentist">Dentist</option>
								<option value="Dentist Assistant">Dentist Assistant</option>
								<option value="Receptionist">Receptionist</option>
							</select>
							<div class="invalid-feedback">
								Please select a role.
							</div>
						</div>
						<div class="mb-3" style="display: none" id='special_add'>
							<label class="form-label">Specialization</label>
							<select class="form-select" aria-label="Default select example" name="add_special" id="add_special" required>
								<option selected="selected" value="NULL">Choose a specialization</option>
								<option value="General Dentist">General Dentist</option>
								<option value="Pedodontist">Pedodontist</option>
								<option value="Orthodontist">Orthodontist</option>
								<option value="Periodontist">Periodontist</option>
								<option value="Endodontist">Endodontist</option>
								<option value="Oral Pathologist">Oral Pathologist</option>
								<option value="Prosthodontist">Prosthodontist</option>
							</select>
							<div class="invalid-feedback">
								Please choose a specialization.
							</div>
						</div>
						<button type="submit" class="btn btn-primary" name="createBtn">Create Account</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Edit Account Modal -->
	<div class="modal fade" id="editAcc" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Update User details</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="needs-validation" method="POST" novalidate>
						<div class="mb-3">
							<label class="form-label">User ID</label>
							<input type="text" class="form-control" name="userID" id="userID" readonly>
						</div>
						<div class="mb-3">
							<label class="form-label">First Name</label>
							<input type="text" class="form-control" name="firstName" id="firstName" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required>
							<div class="invalid-feedback">
								Please enter first name.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Last Name</label>
							<input type="text" class="form-control" name="lastName" id="lastName" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required>
							<div class="invalid-feedback">
								Please enter last name.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Username</label>
							<input type="text" class="form-control" name="edit_username" id="edit_username" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="password" class="form-control" name="password" id="password" required>
						</div>
						<div class="mb-3">
							<label class="form-label">NRIC/Passport No.</label>
							<input type="text" class="form-control" name="edit_nric" id="edit_nric" pattern="[A-Za-z][0-9]{7}[A-Za-z]" required>
							<div class="invalid-feedback">
								Please enter a valid NRIC/Passport No.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Phone Number</label>
							<input type="text" class="form-control" name="mobileNum" id="mobileNum" pattern="[8-9]{1}[0-9]{7}" required>
							<div class="invalid-feedback">
								Please enter a valid singapore mobile number.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Email Address</label>
							<input type="email" class="form-control" name="emailAdd" id="emailAdd" required>
							<div class="invalid-feedback">
								Please enter a valid email address.
							</div>
						</div>
						<div class="mb-3">
							<div class="form-outline mb-3">
								<label class="form-label">Address</label>
								<textarea class="form-control" rows="5" name="address" id="address" required></textarea>
								<div class="invalid-feedback">
									Please enter a residential address.
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Gender</label><br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="male" value="M" required>
								<label class="form-check-label" for="inlineRadio1">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="female" value="F" required>
								<label class="form-check-label" for="inlineRadio2">Female</label>
							</div>
							<div class="form-check p-0">
								<input type="radio" name="gender" style="display: none;" required>
								<div class="invalid-feedback">
									Please choose a gender.
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Birth date</label>
							<input type="date" class="form-control" name="edit_dob" id="edit_dob" required>
							<div class="invalid-feedback">
								Please select a date.
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Role</label>
							<select class="form-select" aria-label="Default select example" name="role" id="edit_role" disabled>
								<option selected>Choose a role</option>
								<option value="System Admin">System Admin</option>
								<option value="Dentist">Dentist</option>
								<option value="Dentist Assistant">Dentist Assistant</option>
								<option value="Receptionist">Receptionist</option>
							</select>
						</div>
						<div class="mb-3" id='edit_special'>
							<label class="form-label">Specialization</label>
							<select class="form-select" aria-label="Default select example" name="e_special" id="e_special" required>
								<option selected="selected" value="NULL">Choose a specialization</option>
								<option value="General Dentist">General Dentist</option>
								<option value="Pedodontist">Pedodontist</option>
								<option value="Orthodontist">Orthodontist</option>
								<option value="Periodontist">Periodontist</option>
								<option value="Endodontist">Endodontist</option>
								<option value="Oral Pathologist">Oral Pathologist</option>
								<option value="Prosthodontist">Prosthodontist</option>
							</select>
							<div class="invalid-feedback">
								Please choose a specialization.
							</div>
						</div>
						<button type="submit" class="btn btn-danger float-start" name="deleteBtn">Delete Account</button>
						<button type="submit" class="btn btn-primary float-end" name="updateBtn">Update Account</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete Account Confirmation Modal -->
	<div class="modal fade" id="deleteAcc" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog col-6">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST">
					<div class="modal-body">
						Are you sure you want to delete this account?
						<div class="form-group row mt-3">
							<label for="staticID" class="col-4 col-form-label"><b>Employee ID:</b></label>
							<div class="col-sm-2">
								<input type="text" class="form-control-plaintext" name="dUserID" id="dUserID" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="staticID" class="col-4 col-form-label"><b>Name:</b></label>
							<div class="col-sm-5">
								<input type="text" class="form-control-plaintext" id="dName" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="staticID" class="col-4 col-form-label text-nowrap"><b>NRIC/Passport No.:</b></label>
							<div class="col-sm-5">
								<input type="text" class="form-control-plaintext" id="dNRIC" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="staticID" class="col-4 col-form-label text-nowrap"><b>Email:</b></label>
							<div class="col-sm-5">
								<input type="text" class="form-control-plaintext" id="dEmail" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="staticID" class="col-4 col-form-label text-nowrap"><b>Role:</b></label>
							<div class="col-sm-5">
								<input type="text" class="form-control-plaintext" id="dRole" readonly>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger" name="deleteBtn">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script>
	$('document').ready(function() {
		$('.editBtn').click(function() {
			$eID = $(this).closest('tr').find('th:nth-child(1)').text().trim();
			$name = $(this).closest('tr').find('td:nth-child(2)').text().trim();
			$splitName = $name.split(" ");
			$first = $splitName[0];
			$last = $splitName[1];
			$username = $(this).closest('tr').find('td:nth-child(3)').text().trim();
			$password = $(this).closest('tr').find('td:nth-child(4)').text().trim();
			$nric = $(this).closest('tr').find('td:nth-child(5)').text().trim();
			$mobileNum = $(this).closest('tr').find('td:nth-child(9)').text().trim();
			$gender = $(this).closest('tr').find('td:nth-child(6)').text().trim();
			$dob = $(this).closest('tr').find('td:nth-child(7)').text().trim();
			$address = $(this).closest('tr').find('td:nth-child(8)').text().trim();
			$email = $(this).closest('tr').find('td:nth-child(10)').text().trim();
			$role = $(this).closest('tr').find('td:nth-child(11)').text().trim();
			$special = $(this).closest('tr').find('td:nth-child(12)').text().trim();

			$('#userID').val($eID);
			$('#firstName').val($first);
			$('#lastName').val($last);
			$('#edit_username').val($username);
			$('#password').val($password);
			$('#edit_nric').val($nric);
			$('#mobileNum').val($mobileNum);
			$('#emailAdd').val($email);
			$('#address').val($address);
			$('#edit_dob').val($dob);
			$('#edit_role').val($role);
			$('#e_special').val($special);


			if ($gender == "M") {
				$("#male").prop("checked", true);
			} else {
				$("#female").prop("checked", true);
			}

			$('#role').on('change', checkPattern);
			checkPattern();
			// alert($eID);
			//$("#radio_1").prop("checked", true);
			//alert("You want to edit: Category with ID " + $('.category-id', $tr).text() + " & Name: " + $('.category-name', $tr).text());
			//You can use this info and set it to the inputs with javascript: $("edit_category_modal input[type='text']").val($('.category-name', $tr).text()) for example;
		});

		$('.deleteBtn').click(function() {
			$eID = $(this).closest('tr').find('th:nth-child(1)').text().trim();
			$name = $(this).closest('tr').find('td:nth-child(2)').text().trim();
			$nric = $(this).closest('tr').find('td:nth-child(5)').text().trim();
			$email = $(this).closest('tr').find('td:nth-child(10)').text().trim();
			$role = $(this).closest('tr').find('td:nth-child(11)').text().trim();

			$('#dUserID').val($eID);
			$('#dName').val($name);
			$('#dNRIC').val($nric);
			$('#dEmail').val($email);
			$('#dRole').val($role);
		});
	});

	function showDiv(divId, element) {
		document.getElementById(divId).style.display = element.value == 'Dentist' ? 'block' : 'none';
	}
	var checkPattern = function() {
		if ($('#edit_role').val() == 'Dentist') {
			$('#edit_special').show();
		} else $('#edit_special').hide();
	}

	function refreshPage() {
		window.location.reload();
	}
	(function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})();
</script>

</html>