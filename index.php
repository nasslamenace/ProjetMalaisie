






<?php 

session_start(); 




try
{
    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    if(isset($_POST['signInBtn'])){

        $statement = $bdd->prepare('SELECT * FROM users WHERE mail = :mail');
      
        $statement->execute(array('mail' => $_POST['userMail']));

        $data = $statement->fetch();
        
        $count = $statement->rowCount();

        if($count > 0){
          
            $verify = password_verify($_POST['password'], $data['password'] );

            if($verify){


            $_SESSION['userMail'] = $_POST['userMail'];
            $_SESSION['isLogIn'] = true;
            $_SESSION['isAdmin'] = $data['isAdmin'];
            $_SESSION['userId'] = $data['id'];


            (header('Location:WelcomeCustomer.php'));
            }   
            else
                $error = "Wrong password";
        }
        else{
            $error = "Wrong email";
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
    <title>Sign in</title>
    <link rel="stylesheet" href="logInStyle.css">
  </head>

    <body>


        <video autoplay muted loop id="myVideo">
             <source src="logInVideo.mp4" type="video/mp4">
        </video>

        <form method = "post" action = "">

            <div class="login-box">
              <h1>Log in</h1>
              <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="email" placeholder="Usermail" name = "userMail" required>
              </div>



              <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" name = "password" required>
              </div>

             <input type="submit" class="btn" value="Sign in" name = "signInBtn">


              <hr>

              <div class="register-box">
                <p>Don't have an account yet ? <a href="registerForm.php">Register</a>.</p>
              </div>

                <?php 
                    if(isset($error))
                        echo '<font color = "red">'.$error.'</font>'; 
                ?>

            </div>



        </form>



    </body>
</html>
 



