<?php 

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    if(!empty($_POST['signInBtn'])){

        echo saluut;

        $statement = $bdd->prepare('SELECT * FROM users WHERE mail = :mail AND password = :password');

        $statement->execute(
            array(
                'mail' => $_POST['userMail'],
                'password' => $_POST['password']
            )
        );

        $count = $statement->rowCount();

        if($count >= 0){

            $_SESSION['userMail'] = $_POST['userMail'];
            header('Location:registerForm.php');
        }
        else{
            echo salut;
        }



    }


}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

 ?>


