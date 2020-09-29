
<?php

session_start();



try
{
    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $statement = $bdd->prepare('SELECT * FROM users WHERE mail = :mail');
        

    $statement->execute(array('mail' => $_SESSION['userMail']));

    $currentUserData = $statement->fetch();



}


catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

?>



<!DOCTYPE html>
<html>


<head>
<link rel="stylesheet" href="ProfilePageStyle.css">
</head>


<body>

  <?php include("customerMenu.php");  ?>

<h2 style="text-align:center">Your Profile </h2>

<div class="profile-card">
  <?php echo '<h1>' . $currentUserData['username'] . '</h1>';  ?>
  <p> Mail : <?php echo $currentUserData['mail']; ?> </p>
  <?php  if(!$currentUserData['isAdmin']){?>  <p> Your loan : <?php echo $currentUserData['loan']; ?> RM</p> <?php ; } ?>
  <a href="EditProfile.php"><button>Edit</button></a>

  <br><br>

  <a href="index.php?logOut=true"><button>Log out</button></a>

</div>


</body>
</html>