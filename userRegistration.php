<html lang="en">
	<head>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
			crossorigin="anonymous" />
		<!-- <title>Document</title> -->
	</head>
	<body>
		<?php

$formName = $formEmail = $formGender =  "";
$mailstatus = false;

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="day4db";
$con = mysqli_connect($db_host, $db_user, $db_pass);

mysqli_select_db( $con,$db_name );
// $formName = $formEmail = $formGender =  "";
// $mailstatus = false;

if (isset($_GET['editData'])){
	$id = $_GET['editData'];
	// $con = mysqli_connect($db_host, $db_user, $db_pass);

	mysqli_select_db($con,$db_name);
	$newSql = "SELECT * FROM users WHERE user_id=$id";
	$result= mysqli_query($con,$newSql);
	$row = mysqli_fetch_assoc($result);
	$formName = $row['name'];
	$formEmail = $row['email'];
	$mailstatus = $row['mail_status'];
	$formGender = $row['gender'];
	
	mysqli_close($con);

}
?>
		<div class="container mt-3">
			<form action="<?php $_PHP_SELF ?>" method="POST">
				<p class="h1">User Registration Form</p>
				<hr />
				<p>
					Please fill this form and submit to add user record to the database
				</p>
				<div class="mb-3">
					<label for="formName" class="form-label">Name</label>
					<input type="text" class="form-control" id="formName" name="formName"
					value="<?php echo "$formName";  ?>" />
				</div>
				<div class="mb-3">
					<label for="formEmail" class="form-label">Email address</label>
					<input type="email" class="form-control" id="formEmail"
					name="formEmail" value="<?php echo "$formEmail";  ?>" />
				</div>
				<div>Gender</div>
				<?php ?>
				<div class="form-check">
					<input
						class="form-check-input"
						type="radio"
						name="formGender"
						id="formGender1"
						value="M" 
						<?php echo checkGenderMale($formGender);?>
						/>
					<label class="form-check-label" for="formGender1"> Male </label>
				</div>
				<div class="form-check">
					<input
						class="form-check-input"
						type="radio"
						name="formGender"
						id="formGender2"
						value="F" 
						<?php echo checkGenderFemale($formGender);?>
						<?php  ?>
						/>
					<label class="form-check-label" for="formGender2"> Female </label>
				</div>
				<div class="form-check">
	
					<input
						class="form-check-input"
						type="checkbox"
						<?php echo checkIfCheckOrNot($mailstatus);?>
						
						
						
						id="notifications"
						name="notifications" />
					<label class="form-check-label" for="notifications">
						Recieve emails from us
					</label>
				</div>
				<div class="mt-3">
					<button
						class="btn btn-primary"
						id="submit"
						name="submit"
						value="submit"
						type="submit">
						Submit
					</button>

					<button
						type="button"
						class="btn btn-light btn-outline-secondary"
						type="reset">
						Cancel
					</button>
				</div>
			</form>
		</div>
		<?php

// var_dump($_GLOBALS);

		// $db_host="localhost";
		// $db_user="root";
		// $db_pass="";
		// $db_name="day4db";
		$con = mysqli_connect($db_host, $db_user, $db_pass);

		mysqli_select_db( $con,$db_name );

		function checkIfCheckOrNot($mailstatus){
			if($mailstatus === "1"){
				return "checked";}else{
					return"";
				}
		}
		function checkGenderMale($formGender){
			if($formGender === "M"){
				return "checked";}else{
					return"";
				}
		}
		function checkGenderFemale($formGender){
			if($formGender === "F"){
				return "checked";}else{
					return"";
				}
		}
		if(!empty($_POST['submit']) && isset($_GET['editData'])){
			if( isset($_POST["formName"]) &&  isset($_POST["formEmail"]) && isset($_POST["formGender"])){
				$formName = $_POST['formName'];
				$formEmail = $_POST['formEmail'];
				$formGender = $_POST['formGender'];
				$mailstatus = isset($_POST['notifications']) == 1 ? 1 : 0;
				$updateSql = "UPDATE  users SET name ='$formName', email = '$formEmail', gender = '$formGender', mail_status= '$mailstatus' WHERE user_id= $id";
				
				 mysqli_query( $con,$updateSql );
				mysqli_close($con);
				header("Location: index.php");
			}
		}

	
		if(!empty($_POST['submit']) && !isset($_GET['editData'])){
			if( isset($_POST["formName"]) &&  isset($_POST["formEmail"]) && isset($_POST["formGender"])){
				$formName = $_POST['formName'];
				$formEmail = $_POST['formEmail'];
				$formGender = $_POST['formGender'];
				$mailstatus = isset($_POST['notifications']) == 1 ? 1 : 0;
				$sql = "INSERT INTO users(name,email,gender,mail_status) VALUES('$formName','$formEmail','$formGender',$mailstatus)";
				$retval = mysqli_query( $con,$sql );
				mysqli_close($con);
				header("Location: index.php");
			}
			}
 ?>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
			crossorigin="anonymous"></script>
	</body>
</html>
