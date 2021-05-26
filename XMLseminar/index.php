<?php
  $error = false;
  if (isset($_POST["Login"])) {
    $ime = preg_replace('/[^A-Za-z]/','',$_POST["ime"]);
    $šif = md5($_POST["šifra"]);
    if (file_exists('users/'.$ime.'.xml')) {
      $xml = new SimpleXMLElement('users/'.$ime.'.xml',0,true);
      if ($šif==$xml->password) {
          session_start();
          $_SESSION["ime"] = $ime;
          header("Location: adminIndex.php");
          die;
      }else {
        $error = true;
      } 
    } else {
      $error = true;
    }

  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />    
    <!-- Custom CSS -->
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>

    <!-- JQuery -->    
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>

    <!-- Title -->
    <title>Log in</title>   
  </head>
  <body>      
        <div class="div-center">     
           <div class="content">     
              <h3>Login</h3>            
              <hr />
              <?php
                      if ($error) {
                        echo "<p class='error'><b>Invalid username or password</b></p>";
                      }            
              ?>
              <form action="" method="post"  class="needs-validation" novalidate>
                <div class="form-group">
                  <label for="UnosIme" class="form-label"><b>Username</b></label>
                  <input name ="ime" type="text" maxlength="10" class="form-control" id="UnosIme" placeholder="Type your username" required >
                </div>
                <div class="form-group">
                  <label for="UnosŠifra" class="form-label"><b>Password</b></label>
                  <input name="šifra" type="password" class="form-control" id="UnosŠifra" placeholder="Type your password" required >                
                </div>
                <div class="forgot">
                    <a href="forgot.php">Forgot password?</a>
                </div>
                <button name="Login" type="submit" class="login btn btn-primary">LOGIN</button>                
                <br /> <br />
                <hr />
                <p class="signup">Or Sign up:</p>
                <div class="signup">
                  <a href="register.php">SIGN UP</a>
                </div>               
              </form>
              <script>
                $(function() {    
                  $('#UnosIme').on('keypress', function(user) {
                      if (user.which == 32)
                      {
                        user.preventDefault();
                      }
                  });
              });
              </script>
            </div>    
        </div>
  </body>
</html>
