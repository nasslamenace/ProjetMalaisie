<style type="text/css">

  @import url('https://fonts.googleapis.com/css?family=Montserrat:500');
  @import "https://use.fontawesome.com/releases/v5.5.0/css/all.css";

  body {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      
      background-size: cover;
  }

  li {
      font-family: "Montserrat", sans-serif;
      font-weight: 500;
      font-size: 16px;
      color: #edf0f1;
      text-decoration: none;
  }




  header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 30px 10%;    
  }

  .title a{
  	  font-family: "Montserrat", sans-serif;
      font-weight: 500;
      font-size: 16px;
      color: #edf0f1;
      text-decoration: none;
  }
  .logo {
      cursor: pointer;
      width: 15%;
      height: 70%;
  }

  .navlinks {
      list-style: none;
  }

  .navlinks li {
      display: inline-block;
      padding: 0px 20px;
  }

  .navlinks li a {
  	background-color: black;

      transition: all 0.3s ease 0s;
  }

  .navlinks li a:hover {
      color: #9bc6ca;
     
  }



  .menuBtn {
  	   font-family: "Montserrat", sans-serif;
      font-weight: 500;
      font-size: 16px;
      color: #edf0f1;
      text-decoration: none;
      padding: 9px 25px;
      background-color: #3e7075;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease 0s;
  }

  .menuBtn:hover {
      background-color: #9bc6ca;
  }
</style>

<?php 
      if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

 if($_SESSION['isAdmin']){

	?>

	            <header>
	            <img class="logo" src="logo.png" alt="logo">
	            <nav>
	                <ul class="navlinks">
	                	<div class= "title">
		                    <li><a href="AddInstrumentForm.php">Add new Instrument</a></li>
		                    <li><a href="WelcomeCustomer.php">Catalog</a></li>
		                    <li><a href="customerInformations.php">view customers Information</a></li>
	                    </div>
	                </ul>
	            </nav>
	            <a class="cta" href="ProfilePage.php"><button class = "menuBtn"><i class="fas fa-user"></i> My Profile</button></a>
            </header>


   <?php } 

    else{ ?>

    	            <header>
	            <img class="logo" src="logo.png" alt="logo">
	            <nav>
	                <ul class="navlinks">
	                	<div class= "title">
		                    <li><a href="WelcomeCustomer.php">Catalog</a></li>
		                    <li><a href="MyInstrumentsPage.php">my instruments</a></li>
	                    </div>
	                </ul>
	            </nav>
	            <a class="cta" href="ProfilePage.php"><button class = "menuBtn"> <i class="fas fa-user"></i> My Profile</button></a>
            </header>




    <?php  }

    ?>