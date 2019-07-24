<?php
	session_start();
	if(!$_SESSION['logged'])
	{
		header('Location: index.html');
		exit;
	}
 	echo 'Welcome , '.$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<a href="myprofile.php">myprofile</a>
	<a href="logout.php">logout</a>
	<form action="" method="post">
	<br><br><br>
	<input list="places" name="from" placeholder="From" autofocus="autofocus" required>
	<datalist id="places">
		<option value="Hyderabad">Hyderabad</option>
		<option value="Vijayawada">Vijayawada</option>
		<option value="Ongole">Ongole</option>
		<option value="Guntur">Guntur</option>
		<option value="Nellore">Nellore</option>
		<option value="Tirupati">Tirupati</option>
		<option value="Bengaluru">Bengaluru</option>
		<option value="Anantapur">Anantapur</option>
		<option value="Trichy">Trichy</option>
		<option value="Chennai">Chennai</option>
	</datalist>
	<input list="places" name="to" placeholder="To" required>
	<datalist id="places">
		<option value="Hyderabad">Hyderabad</option>
		<option value="Vijayawada">Vijayawada</option>
		<option value="Ongole">Ongole</option>
		<option value="Guntur">Guntur</option>
		<option value="Nellore">Nellore</option>
		<option value="Tirupati">Tirupati</option>
		<option value="Bengaluru">Bengaluru</option>
		<option value="Anantapur">Anantapur</option>
		<option value="Trichy">Trichy</option>
		<option value="Chennai">Chennai</option>
	</datalist>
	<input type="date" name="date" min= <?php $date = date('Y-m-d'); echo $date;?>  required>
	<input type="submit" name="submit" value="search">
</form>
<?php
	if(isset($_POST['submit']))
	{
		$from=$_POST['from'];
		$to=$_POST['to'];
		if($from == $to)
		{
			echo '<script type="text/javascript"> alert("Arrival and Departure cannot be same") </script>';
			echo "<script>setTimeout(\"location.href = 'user_page.php';\",1000);</script>";
			exit;
		}
		else
		{
			$_SESSION['from']=$from;
			$_SESSION['to']=$to;
			$_SESSION['date']=$_POST['date'];
			header('Location: search.php');
			exit;
		}
	}
?>
</body>
</html>