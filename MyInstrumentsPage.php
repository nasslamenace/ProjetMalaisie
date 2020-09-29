

<?php 


session_start(); 




try
{



    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    



	$query = 'SELECT * FROM instruments WHERE currentUser = :id';

	$instrumentsReq = $bdd->prepare($query);

  $instrumentsReq->execute(array('id' => $_SESSION['userId']));












	


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

h1{

  color: white;
}



tr:nth-child(even) {
  background-color: #3e7075;;
  color: black;
}

tr:nth-child(odd) {
  color: white;
}

</style>
<link rel="stylesheet" href="CustomerInformationStyle.css">
</head>
<body>

	<?php include("customerMenu.php"); ?>

<h1>Your instruments</h1>

<table>

  <tr>
    <th>name</th>
    <th>type</th>
    <th>price per day</th>
    <th>end date</th>
  </tr>


<?php while($instrumentsData = $instrumentsReq->fetch()){ ?>


  <tr>
    <td> <?php echo $instrumentsData['name'];  ?> </td>
    <td>  <?php echo $instrumentsData['type'];  ?> </td>
    <td> <?php echo $instrumentsData['price'];  ?>   </td>
    <td> <?php echo $instrumentsData['availabilityDate'] . '(' . ceil(abs(strtotime($instrumentsData['availabilityDate']) - time()) / 86400) . ' days left)' ;  ?>   </td>


          
  </tr>




	<?php } ?>
  </td>
  </tr>
</table>

</body>
</html>