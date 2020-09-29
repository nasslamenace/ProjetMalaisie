
<?php

session_start();

date_default_timezone_set(date_default_timezone_get());



try
{
    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $statement = $bdd->prepare('SELECT * FROM instruments WHERE id = :id');
        

    $statement->execute(array('id' => $_GET['id']));

    $currentInstrumentData = $statement->fetch();

    $getIdReq = $bdd->prepare('SELECT id FROM users WHERE mail = :mail');
   	$getIdReq->execute(array(
		'mail' => $_SESSION['userMail']
		));
	$userId = $getIdReq->fetch();

    if(isset($_POST['confirmBtn'])){


		$date = date('Y-m-d', strtotime($_POST['availabilityDate']));
		$updateInstrumentReq = $bdd->prepare('UPDATE instruments SET availabilityDate = :availabilityDate, currentUser = :user WHERE id = :id');

        $updateInstrumentReq->execute(array(
            'availabilityDate' => $date,
            'user' => $userId['id'],
            'id' => $_GET['id']
          ));


        header('location:RentPage.php?id=' . $_GET['id']);

        $price = (ceil(abs(strtotime($date) - time()) / 86400)) * $currentInstrumentData['price'];

        $updateUserReq = $bdd->prepare('UPDATE users SET loan = loan + :loan WHERE id = :id');

        $updateUserReq->execute(array(
            'loan' => $price,
            'id' => $userId['id']
          ));




    }


}


catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

?>



<!DOCTYPE html>
<html>


<head>
<link rel="stylesheet" href="RentPageStyle.css">
</head>


<body>

  <?php include("customerMenu.php");  ?>

<?php





    	if(strtotime($currentInstrumentData['availabilityDate']) <= time() OR !isset($currentInstrumentData['availabilityDate'])){ ?>
    		<h2 style="text-align:center">Your Instrument</h2>
    		<div class="profile-card">
    			<form method="post" action = "">
    				<?php echo '<h1>' . $currentInstrumentData['name'] . '</h1>';  ?>
    				<img class = "image" src= <?php echo 'instruments/' . $currentInstrumentData['picture']; ?> >
    				<p> price per day : <?php echo $currentInstrumentData['price']; ?> RM</p>

    				<label> chose the end date :</label>

    				<input type="date" name="availabilityDate" placeholder="select Birth date" min= <?php echo '"' . date('Y-m-d', time()) . '"'; ?> max= <?php echo '"' . date('Y-m-d', time() + (1000 * 60 * 60 * 24 * 365)) . '"'; ?> required>
    				<br> <br>
    				<input type="submit" class="btn" value="Confirm" name = "confirmBtn">
    			</form>
    		</div>
    		

    		<<?php  
    	}
    	elseif ($currentInstrumentData['currentUser'] == $userId['id']) {?>


    		<div class="profile-card">
    		<h2 style="text-align:center; color:red; background: black; ">This instrument is yours</h2>
    		<?php echo '<h1>' . $currentInstrumentData['name'] . '</h1>';  ?>
    		<img class = "image" src= <?php echo 'instruments/' . $currentInstrumentData['picture']; ?> >
    		<p> price per day : <?php echo $currentInstrumentData['price']; ?> RM</p>

    		<label style="text-align:center; color:red; background: black; "> It is yours until  <?php echo $currentInstrumentData['availabilityDate']  ?> </label>
    	</div>

    	<?php
    	}
    else{ ?>
    		
    		<div class="profile-card">
    			<h2 style="text-align:center; color:red; background: black; ">Your Instrument is not available</h2>
    			<?php echo '<h1>' . $currentInstrumentData['name'] . '</h1>';  ?>
    			<img class = "image" src= <?php echo 'instruments/' . $currentInstrumentData['picture']; ?> >
    			<p> price per day : <?php echo $currentInstrumentData['price']; ?> RM</p>

    			<label style="text-align:center; color:red; background: black; "> It will be available on  <?php echo $currentInstrumentData['availabilityDate']  ?> </label>
    		</div>



    	<?php  }

    	?>




</body>
</html>