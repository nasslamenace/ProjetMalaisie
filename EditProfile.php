
<?php

session_start();

$error = array();

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

 

    if(isset($_POST['updateName']))
    {
        $statement = $bdd->prepare('UPDATE users SET username = :name WHERE mail = :mail');
        
        $name = htmlspecialchars($_POST['name']);

        $statement->execute(array(
            'name' => $name,
            'mail' => $_SESSION['userMail']
          ));
    }

    if(isset($_POST['updateMail']))
    {

      $query = $bdd->prepare('SELECT * FROM users WHERE mail = :usermail');

      $query->execute(array(
        'usermail' => $_POST['userMail']
      ));

      $count = $query->rowCount();

      echo "azert" . $count;

      if($count > 0)
        $error[] = "this email is alreay registered !"; 
      else{
        $statement = $bdd->prepare('UPDATE users SET mail = :usermail WHERE mail = :mail');
        
        $mail = htmlspecialchars($_POST['userMail']);

        $statement->execute(array(
          'usermail' => $mail,
          'mail' => $_SESSION['userMail']
        ));

      }

        


    }

    if(isset($_POST['updatePassword']))
    {
        $statement = $bdd->prepare('UPDATE users SET password = :password WHERE mail = :mail');
        
        $password = htmlspecialchars($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $statement->execute(array(
            'password' => $password,
            'mail' => $_SESSION['userMail']
          ));
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
    <title>Edit profile</title>
    <link rel="stylesheet" href="RegisterFormStyle.css">
  </head>



  <body>

    <?php include("customerMenu.php") ?>

    
  <body>
    
      <div class="register-box">
        <h1>Edit your profile</h1>
        <hr>


        <form method = 'post' action="">
          <label><b>Full name :</b></label>
          <input type="text" placeholder="Enter full name" name="name" required>
          <button type="submit" class="btn" name = "updateName">Update your name</button>
        </form>


        <form method = 'post' action="">
          <label><b>Email :</b></label>
          <input type="email" placeholder="Enter Email" name="userMail" required>
          <button type="submit" class="btn" name = "updateMail">Update your email </button>
        </form>


        <form method = 'post' action="">
          <label for="psw"><b>Password :</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
          <button type="submit" class="btn" name = "updatePassword">Update password</button>
          <hr>
        </form>

        <font color="red" ><?php for($i = 0 ; $i < sizeof($error); $i++) echo "$error[$i]\n";  ?></font>


      </div>
      
      <div class="container signin">
        
      </div>
    
    
  </body>
</html>


