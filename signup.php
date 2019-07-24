<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form method='post'>
			<label for='fname'>First Name:</label><br>
			<input type="text" name="fname" placeholder="First Name" autofocus="autofocus" required><br><br>
			<label for='lname'>Second Name:</label><br>
			<input type="text" name="lname" placeholder="Last Name" required><br><br>
			<label for='user'>Username:</label><br>
			<input type="text" name="user" placeholder="Username" required><br><br>
			<label for='pass'>Password:</label><br>
			<input type="password" name="pass"placeholder="Password" required><br><br>
			<label for='mobnum'>Mobile Number:</label><br>
			<input type="text" name="mobnum"  placeholder="Mobile Number" required><br><br>
			<input type="submit" name="submit" >

			<?php
				if(isset($_POST['submit']))
				{
					$dbhost="localhost";
					$dbuser="root";
					$dbpass="dsrap7vrs75";
					$dbname="db";
					$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
					if(!$conn)
					{
						die("connection error");
					}
					$fname=$_POST['fname'];
					$lname=$_POST['lname'];
					$user=$_POST['user'];
					$pass=hash('md5',$_POST['pass']);
					$mobnum=$_POST['mobnum'];
					$sql="INSERT INTO userdetails(`fname`,`lname`,`username`,`password`,`mobnum`) VALUES('$fname','$lname','$user','$pass','$mobnum') ";
					if ($insert = mysqli_query($conn, $sql)) {
    					header("Location: index.html");
   						exit;
					} 
					else {
    				echo 'MySQL Error: ' . mysqli_error($conn);
					}
				}
			?>
