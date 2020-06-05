<html>
	<head>
		<title>Register</title>
	</head>
	<body>
		<h2>Registration Page</h2>
		<a href="index1.php">Click here to go back</a><br/><br/>
		<form action="register1.php" method="post">
			Enter Name: <input type="text" name="name" required="required"/> <br/>
			Enter Email: <input type="text" name="email" required="required" /> <br/>
			<input type="submit" value="Register"/>
		</form>
	</body>
</html>

<?php
 $db = mysqli_connect('localhost', 'root', '', 'register1');
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$name= mysqli_real_escape_string($db,$_POST['name']);
	$email= mysqli_real_escape_string($db,$_POST['email']);
	$bool = true;
	mysqli_connect("localhost", "root","") or die(mysqli_error()); 
	mysqli_select_db($db,"register1") or die("Cannot connect to database"); 
	$query = mysqli_query($db,"Select * from users"); 
	while($row = mysqli_fetch_array($query)) 
	{
		$table_users = $row['name'];
		if($name == $table_users) 
		{
			$bool = false; 
			Print '<script>alert("Name has been taken!");</script>';
			Print '<script>window.location.assign("register1.php");</script>';
		}
		$table_users = $row['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
   {
			$bool = false; 
			Print '<script>alert("Please enter a valid e-mail adress!");</script>';
			Print '<script>window.location.assign("register1.php");</script>';
		}
}
	if($bool) 
	{
		mysqli_query($db,"INSERT INTO users (name, email) VALUES ('$name','$email')"); 
		Print '<script>alert("Successfully Registered!");</script>'; 
		Print '<script>window.location.assign("register1.php");</script>'; 
	}
}
?>
