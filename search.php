<!DOCTYPE html>
<html>
<head>
	<style>
		table{
			width:100%;
		}
	table, th, td {
  	border: 1px solid black;
  	border-collapse: collapse;
	}
</style>
</head>
<body>
<?php
	session_start();
	if(!$_SESSION['logged'])
	{
		header('Location: index.html');
		exit;
	}
			$conn = mysqli_connect("localhost","root","dsrap7vrs75","db");
			if(!$conn)
			{
				die("connection error");
			}
			$from=$_SESSION['from'];
			$to=$_SESSION['to'];
			$bus_available=0;
			$is_available=true;
			$date=$_SESSION['date'];
			$q1="SELECT city_id FROM cities WHERE city='$from'";
			$r1=mysqli_query($conn,$q1);
			$row1=mysqli_fetch_assoc($r1);
			$fid=$row1['city_id'];
			$q2="SELECT city_id FROM cities WHERE city='$to'";
			$r2=mysqli_query($conn,$q2);
			$row2=mysqli_fetch_assoc($r2);
			$tid=$row2['city_id'];
			echo "<table>
					<tr>
						<th>Bus</th>
						<th>Bus Number</th>
						<th>From</th>
						<th>Departure Time</th>
						<th>To</th>
						<th>Arrival Time</th>
						<th>Seats Avaiable</th>
						<th>Book Now</th>
					</tr>";
			$bus_id_f=array();
			$time_f=array();
			$q3="SELECT * FROM route WHERE city_id='$fid'";
			$r3=mysqli_query($conn,$q3);
			if(mysqli_num_rows($r3)>0)
			{
				$i=0;
				while($row3=mysqli_fetch_assoc($r3))
				{
					$bus_id_f[$i]=$row3['bus_id'];
					$time_f[$i]=($row3['time']);
					$i++;
				}
			}
			else
			{
				$is_available=false;
			}
			$q4="SELECT * FROM route WHERE city_id='$tid'";
			$r4=mysqli_query($conn,$q4);
			if(mysqli_num_rows($r4)>0)
			{
				while($row4=mysqli_fetch_assoc($r4))
				{
					for($i=0;$i<sizeof($bus_id_f);$i++)
					{
						if($bus_id_f[$i]==$row4['bus_id'] && strtotime($time_f[$i])<strtotime($row4['time']))
						{
							$q5="SELECT * FROM buses WHERE bus_id='".$row4['bus_id']."'";
							$r5=mysqli_query($conn,$q5);
							$row5=mysqli_fetch_assoc($r5);
							if($row5['capacity']>0)
							{
								echo "<tr>
										<td>".$row5['bus_name']."</td>
										<td>".$row5['bus_num']."</td>
										<td>".$from."</td>
										<td>".$time_f[$i]."</td>
										<td>".$to."</td>
										<td>".$row4['time']."</td>
										<td>".$row5['capacity']."</td>
										<td><a href=\"book.php?bus_id=".$row4['bus_id']."&from=".$from."&to=".$to."\">Book</a></td>
									</tr>";
									$bus_available++;
							}	
						}
					}
				}
			}
			else
			{
				$is_available=false;
			}
			echo "</table>";
			if($is_available)
			{
				if($bus_available==1)
					echo "One bus is available";
				else
					echo "$bus_available"." are available";
			}
			else
				echo '<script type="text/javascript"> alert("No buses found") </script>';;
		
?>
</body>
</html>