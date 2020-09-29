

<?php 


session_start(); 




try
{
    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));



	$query = 'SELECT * FROM users LEFT JOIN instruments ON users.id = instruments.currentUser';

	$usersReq = $bdd->query($query);


}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}



 ?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;

}




tr:nth-child(even) {
  background-color: #3e7075;
  color: black;
}

tr:nth-child(odd) {
  color: white;
}

h2{
	color: white;
	text-align: center;
}

</style>
<link rel="stylesheet" href="CustomerInformationStyle.css">
</head>
<body>

	<?php include("customerMenu.php"); ?>

<h2>Customer information</h2>

<table>

  <tr>
    <th>name</th>
    <th>mail</th>
    <th>loan</th>
    <th>on-loan items</th>
  </tr>


<?php while($usersData = $usersReq->fetch()){?>


  <tr>
    <td> <?php echo $usersData['username'];  ?> </td>
    <td>  <?php echo $usersData['mail'];  ?> </td>
    <td> <?php echo $usersData['loan'];  ?>   </td>
    <td> <?php  

    	if(isset($usersData['availabilityDate'])  AND strtotime($usersData['availabilityDate']) >= time() ){?>

    		is renting a <?php echo $usersData['name'];  ?> until <?php echo $usersData['availabilityDate'];  ?>
    <?php  }
    	else
    	{?>
    		is not renting instrument for the moment
    	<?php }


    ?>      </td>
  </tr>




	<?php } ?>
  </td>
  </tr>
</table>

</body>
</html>