<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="logInStyle.css">
  </head>

    <body>
        <form method = "post" action = "">
            <div class="login-box">
              <h1>Log in</h1>
              <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Usermail" name = "userMail" required>
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

            </div>
        </form>

    </body>
</html>