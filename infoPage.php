<html lang="en">
<head>
	<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
			crossorigin="anonymous" />
</head>
<body>
    <?php
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="day4db";
    $con = mysqli_connect($db_host, $db_user, $db_pass);
    			if (isset($_GET['getData'])) {
                    $id = $_GET['getData'];
                    $con = mysqli_connect($db_host, $db_user, $db_pass);
    
                    mysqli_select_db( $con,$db_name );
                    $newSql = "SELECT * FROM users WHERE user_id=$id";
            $result= mysqli_query( $con,$newSql );
            $row = mysqli_fetch_assoc($result);

                    mysqli_close($con);
          
                }



    ?>
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <span class="h2">User Details</span>
            <a class="btn btn-success h-75" href="userRegistration.php"
                >View Record</a
            >
        </div>
        <hr />
  <h4>Name</h4>
  <p><?php echo "{$row['name']}"; ?></p>
  <h4>Email</h4>
  <p><?php echo"{$row['email']}";  ?></p>
  <h4>Gender</h4>
  <p><?php echo "{$row['gender']}";  ?></p>
<p><?php
$newMailStatus = $row['mail_status'] == 1 ?  "You will recieve e-mails from us" : "You will Not recieve e-mails from us";
  echo "$newMailStatus";

?></p>
<a  class="btn btn-primary" href="index.php">
    Back
</a>
</body>
</html>