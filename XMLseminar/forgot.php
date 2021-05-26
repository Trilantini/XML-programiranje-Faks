<?php

  $greska = false;
  if (isset($_POST["Send"])) {
      $ime = preg_replace('/[^A-Za-z]/','',$_POST["ime"]);
    if (file_exists('users/'.$ime.'.xml')){
        session_start();
        $_SESSION["ime"]=$ime;
        header("Location:newPassword.php");
        exit;
    }
    $greska = true;
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
    <title>Forgot password</title>   
  </head>
  <body>
        <div class="div-center">     
           <div class="content">     
              <h3>Forgot your password?</h3>            
              <hr />
              <?php
                      if ($greska) {
                        echo "<p class='error'><b>This user doesn't exist</b></p>";
                      }            
              ?>
              <form action="" method="post"  class="needs-validation" novalidate>
                <div class="form-group">
                  <label for="UnosIme" class="form-label"><b>Username</b></label>
                  <input name ="ime" type="text" maxlength="10" class="form-control" id="UnosIme" placeholder="Type your username" required >
                </div>               
                <button name="Send" type="submit" class="login btn btn-primary">SEND IT</button>                
                <br /> <br />
                <hr />
                <button type="button" class="goback2 btn btn-success"><a href="index.php">GO BACK</a></button>
              </form>
              <script>
                $(function() {    
                  $('#UnosIme').on('keypress', function(greška) {
                      if (greška.which == 32)
                          return false;
                  });
              });
              </script>
            </div>    
        </div>
  </body>
</html>
