

<?php 


session_start(); 




try
{

	$page = (!empty($_GET['page']) ? $_GET['page'] : 1);


	$limit = 12;

    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    


    if($page == 0)
    	$begin = 0;
    else
    	$begin = ($page - 1) * $limit;


	$query = 'SELECT * FROM instruments WHERE type=\'woodwind\' LIMIT :limite OFFSET :start ';




	$query = $bdd->prepare($query);

	$query->bindValue(
	    'limite',         
	     $limit,         
	     PDO::PARAM_INT 
	);

	$query->bindValue('start', $begin, PDO::PARAM_INT);

	$query->execute();

	$count = $query->rowCount();


	$queryIdMax = 'SELECT * FROM instruments WHERE type=\'woodwind\' ORDER BY id DESC LIMIT 0, 1 ';

	$queryIdMax = $bdd->query($queryIdMax);

	$idData = $queryIdMax->fetch();



	for($i = $begin; $i <= $idData['id']; $i++){

		if(isset($_POST['deleteBtn' . (string) $i ])){

			$query = 'DELETE FROM instruments WHERE id = :id';

			$query = $bdd->prepare($query);
			$query->bindValue('id', $i, PDO::PARAM_INT);
			$query->execute();
			header('Location: '.$_SERVER['REQUEST_URI']);
		}

	}

	for($i = $begin; $i <= $idData['id']; $i++){

		if(isset($_POST['rentBtn' . (string) $i ])){
			
			header('Location: RentPage.php?id=' . $i);

		}

	}





	


}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="CatalogueStyle.css">
  </head>

  	<?php  include("customerMenu.php"); ?>



    <body>


    	<?php

    	// Partie "Boucle"
	/* Ce qui se trouvait avant dans $resultSet est désormais dans $query, donc on doit
	 * modifier ici aussi */
	while ($element = $query->fetch()) {


		?>

		<div class="card">

			<form method="post" action = "">
				<div class="image">
					<img src= <?php echo 'instruments/' . $element['picture']; ?> >
				</div>

				<div class="title">
					<h1> <?php  echo $element['name'];   ?> </h1>
				</div>

				<div class="des">
					<p> <?php  echo $element['type']  ?> instrument </p>
					<br>
					<p> <?php  echo $element['price']  ?>RM  </p>

					<?php 




				      echo ($_SESSION['isAdmin'] ? ('<input type="submit" name="deleteBtn' . $element['id'] . '" value="delete" >') : ('<input type="submit" name="rentBtn' . $element['id'] . '" value="Rent">'));  



					  ?>
				</div>
			</form>

		</div>
	

	    <?php
	}

	//si je veux mettre un bouton ajouter
	if($_SESSION['isAdmin'])
	{
		?>





    <?php
	}

	?>
	<br>
	<?php
    		if($page > 1){
	    		echo '<a class="previousPage" href="?page='. ($page - 1) . '">previous page</a>';
    		}
	    	if($count == $limit){
	   			echo '<a class="nextPage" href="?page=' . ($page + 1) . '">next page</a>';
	    	}
		?>
    </body>
</html>