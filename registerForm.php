
<?php



try
{
  $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


  if(isset($_POST['registerBtn'])){

    $name = htmlspecialchars_decode($_POST['name']);
    $userMail = htmlspecialchars_decode($_POST['userMail']);
    $password = htmlspecialchars_decode($_POST['password']);

     // Hach
    $pass_hache = password_hash($password, PASSWORD_DEFAULT);

    $statement = $bdd->prepare('SELECT mail FROM users WHERE mail = :mail');

    $statement->execute(array(

      'mail' => $userMail

    ));

    $count = $statement->rowCount();

    if($count > 0){
      $error = "This email already exist !";
    }
    else{
    // Insertion
      $req = $bdd->prepare('INSERT INTO users(username, mail, password) VALUES(:username, :mail, :password)');
      $req->execute(array(
        'username' => $name,
        'mail' => $userMail,
        'password' => $pass_hache
      ));
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
  <title>Register</title>
  <link rel="stylesheet" href="registerFormStyle.css">
</head>
<body>

  <video autoplay muted loop id="myVideo">
   <source src="logInVideo.mp4" type="video/mp4">
   </video>

   <form method = 'post' action="">
    <div class="register-box">
      <h1>Register</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>



      <label><b>Full name :</b></label>
      <input type="text" placeholder="Enter full name" name="name" required>

      <br/>

      <label for="email"><b>Email :</b></label>
      <input type="email" placeholder="Enter Email" name="userMail" required>

      <br/>

      <label for="psw"><b>Password :</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <br/>
      <hr>

      <button type="submit" class="btn" name = "registerBtn">Register</button>
      <p>Already have an account? <a href="index.php">Sign in</a>.</p>
      <?php 
      if(isset($error))
        echo '<font color = "red", background-color: "black">'.$error.'</font>'; 
      ?>
    </div>


    <div class="container signin">

    </div>
  </form>
</body>
</html>


