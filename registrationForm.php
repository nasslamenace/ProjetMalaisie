<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="registerFormStyle.css">
  </head>
  <body>
    <form action="action_page.php">
      <div class="register-box">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>



        <label for="email"><b>Full name :</b></label>
        <input type="text" placeholder="Enter full name" name="name" required>

        <label for="email"><b>Email :</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password ytrez:</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <hr>

        <button type="submit" class="registerbtn">Register</button>

      </div>

      <div class="container signin">
        
      </div>
    </form>
  </body>
</html>