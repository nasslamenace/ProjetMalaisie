
<?php

$error = array();

// Check if image file is a actual image or fake image
if(isset($_POST["addBtn"])) {


  $target_dir = "instruments/";

  if(file_exists($target_dir . basename($_FILES["instrumentPic"]["name"])))
    $target_file = $target_dir . basename($_FILES["instrumentPic"]["name"]);
  else
    $target_file = $target_dir . basename($_FILES["instrumentPic"]["name"]);

  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


  $check = getimagesize($_FILES["instrumentPic"]["tmp_name"]);
  if($check !== false)
    $uploadOk = 1;
  else {
    $error[] = "File is not an image.";
    $uploadOk = 0;
  }

    // Check if file already exists
  /*if (file_exists($target_file)) {
    $error = "Sorry, image already exists.";
    $uploadOk = 0;
  }*/

     // Check file size
  if ($_FILES["instrumentPic"]["size"] > 500000) {
    $error[] = "Sorry, your file is too large.";
    $uploadOk = 0;
  }

// Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $error[] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["instrumentPic"]["tmp_name"], $target_file)) {
    


    try
    {

      echo "azer";
      $bdd = new PDO('mysql:host=localhost;dbname=instrumentRental;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));



      $name = htmlspecialchars($_POST['instrumentName']);
      $type = htmlspecialchars($_POST['type']);
      $price = htmlspecialchars($_POST['instrumentPrice']);





      if(filter_var($price, FILTER_VALIDATE_FLOAT) !== false){
        $success = "The file ". basename( $_FILES["instrumentPic"]["name"]). " has been uploaded.";
    // Insertion
        $req = $bdd->prepare('INSERT INTO instruments(name, price, picture, type) VALUES(:name, :price, :picture, :type)');
        $req->execute(array(
          'name' => $name,
          'price' => $price,
          'picture' => basename($_FILES["instrumentPic"]["name"]),
          'type' => $type
        ));
      }
      else
        $error[] = "you have to input a number !";



    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }




  }
  else {
    $error[] = "Sorry, there was an error uploading your file.";
  }
}
}



?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Add an instrument</title>
  <link rel="stylesheet" href="AddInstrumentStyle.css">
</head>


<body>

  <?php include("customerMenu.php") ?>

  <form method = "post" action = "" enctype="multipart/form-data">
    <div class="add-box">

      <h1>add an instrument to the catalog</h1>

      <div class="textbox">
        <input type="text" placeholder="instrument name" name = "instrumentName" required>
      </div>

      <br>

      <select name = "type">
        <option value="woodwind">woodwind</option>
        <option value="string">string</option>
        <option value="brass">brass</option>
        <option value="percussion">percussion</option>
      </select>

      <br>
      <br>





      <div class="textbox">
        <input type="text" placeholder="Price" name = "instrumentPrice" required>
      </div>

      <br>

      <input type="file" name="instrumentPic"  class="file" required="required" value=""/>



      <input type="submit" class="btn" value="Add to the catalog" name = "addBtn">


      <hr>
      <font color="red"><?php for($i = 0; $i < sizeof($error); $i++) echo "$error[$i]\n"; ?></font>
      <font  color = #816aaf> <?php if(isset($success)) echo $success;?></font>

    </div>



  </form>


</body>
</html>