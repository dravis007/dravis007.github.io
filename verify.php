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
		$user=mysqli_real_escape_string($conn,$_POST['username']);
		$pass=hash('md5',mysqli_real_escape_string($conn,$_POST['password']));

		$sql="SELECT * FROM userdetails WHERE username='$user' AND  password='$pass'";
		$res=mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_assoc($res);
			session_start();
			$_SESSION['username']=$row['username'];
			$_SESSION['logged']=TRUE;
			header("Location: user_page.php");
			exit;
		}
		else
		{
			echo '<script type="text/javascript"> alert("Incorrect username or password") </script>';
			echo "<script>setTimeout(\"location.href = 'index.html';\",1000);</script>";
			exit;
		}
	}
	else
	{
		header('Location: index.html');
		exit;
	}
?>