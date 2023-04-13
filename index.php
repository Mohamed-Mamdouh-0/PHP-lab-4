<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
			crossorigin="anonymous" />
		<link rel="stylesheet" href="style.css" />
		

		<title>Document</title>
	</head>
	<body>
		<div class="container mt-3">
			<div class="d-flex justify-content-between">
				<span class="h2">User Details</span>
				<a class="btn btn-success h-75" href="userRegistration.php"
					>Add New User</a
				>
			</div>
			<hr />
			<table class="table table-striped table-hover">
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Gender</th>
					<th>Mail Status</th>
					<th>Action</th>
				</tr>
				<?php
		$db_host="localhost";
		$db_user="root";
		$db_pass="";
		$db_name="day4db";
		$con = mysqli_connect($db_host, $db_user, $db_pass);
		
		mysqli_select_db( $con,$db_name );
				$sql = "SELECT * FROM users";
				$result = mysqli_query( $con,$sql );
				
				if(! $result ) {
					die('Could not get data: ' . mysqli_error($con));
				 }
				 if (mysqli_num_rows($result) >
				0) { while($row = mysqli_fetch_assoc($result)) { $newMailStatus =
				$row['mail_status'] == 0 ? "no" : "yes"; echo "
				<tr>
					<td>{$row['user_id']}</td>
					<td>{$row['name']}</td>
					<td>{$row['email']}</td>
					<td>{$row['gender']}</td>
					<td>$newMailStatus</td>
					<td >
					<div style='display:flex; justify-content: space-around; color:#7386e2;'>
					<a  href='infoPage.php?getData={$row['user_id']}'><i class='fa-solid fa-eye '></i></a>
					<a  href='userRegistration.php?editData={$row['user_id']}'><i class='fa-solid fa-pen '></i></a>
					 <a href='index.php?del={$row['user_id']}'><i class='fa-solid fa-trash '></i></a>
					</div>
					</td>
				</tr>
				"; 
			
				
		

			
				} } else { echo "0 results"; } mysqli_close($con);
				
					//   }
					if (isset($_GET['del'])) {
						$id = $_GET['del'];
						echo "delete".$id;
						$con = mysqli_connect($db_host, $db_user, $db_pass);
		
						mysqli_select_db( $con,$db_name );
						$newSql = "DELETE FROM users WHERE user_id=$id";
				 mysqli_query( $con,$newSql );
					
						mysqli_close($con);
						header('location: index.php');
					}
					
				
				?>
			</table>
		</div>
		<!-- <script>
function deleteUserFunction(ID) {

console.log("hi")
   // create an AJAX request to call the PHP function
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
   
		 console.log(ID)
      }
   };
   xhttp.open("GET", "deleteUserFromTable.php?function=deleteUser&$userID="+ID , true);
   xhttp.send();
}
</script> -->
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
			crossorigin="anonymous"></script>
			<script src="https://kit.fontawesome.com/2ed7666daf.js" crossorigin="anonymous"></script>
	</body>
</html>
