<?php
	session_start();
	if(!$_SESSION['logged'])
	{
		header('Location: index.html');
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form action="" method="post">
		<table>
			<tr>
				<td><input type="text" name="name" autofocus="autofocus" placeholder="your name" required></td>
				<td><input type="text" name="age" placeholder="age" required></td>
				<td><input type="text" name="govtid" placeholder="govt.id" required></td>
				<td><input type="radio" name="gender" value="male" checked> Male<br>
					<input type="radio" name="gender" value="female"> Female<br></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Confirm Booking">
	</form>
	<?php
		if(isset($_POST['submit']))
		{
			$conn=mysqli_connect("localhost","root","dsrap7vrs75","db");
			if(!$conn)
			{
				die("connection error!");
			}
			$name=$_POST['name'];
			$age=$_POST['age'];
			$gid=$_POST['govtid'];
			$gender=$_POST['gender'];
			$bus_id=$_GET['bus_id'];
			$from=$_GET['from'];
			$to=$_GET['to'];
			$q="SELECT * FROM buses WHERE bus_id='$bus_id'";
			$r=mysqli_query($conn,$q);
			$row=mysqli_fetch_assoc($r);
			$bus_name=$row['bus_name'];
			$bus_num=$row['bus_num'];
			$capacity=$row['capacity'];
			$capacity--;
			$q1="INSERT INTO tickets (`username`,`name`,`date_of_travel`,`age`,`govt_id`,`gender`,`from`,`to`,`bus_name`,`bus_num`) VALUES ('{$_SESSION['username']}','$name','{$_SESSION['date']}','$age','$gid','$gender','$from','$to','$bus_name','$bus_num')";
			$r1=mysqli_query($conn,$q1);
			if(!$r1)
			{
				die(mysql_error());
			}
			$q2="UPDATE buses SET capacity='$capacity' WHERE bus_id='$bus_id'";
			$r2=mysqli_query($conn,$q2);
			if(!$r2)
			{
				echo mysqli_error($q2);
			}
			echo "Your ticket is being processed";
			exit;
		}
	?>