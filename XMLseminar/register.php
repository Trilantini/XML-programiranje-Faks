<?php
  $greske = array();
  if (isset($_POST["registracija"])) {
    $mail = $_POST["mail"];
    $ime = preg_replace('/[^A-Za-z0-9]/','',$_POST["ime"]);
    $sifra =$_POST["šifra"];
    $potv_sifra = $_POST["potvšifra"];
    if (file_exists('users/'.$ime.'.xml')) {
        $greske[] = "Username already exists";
    }
    if ($ime == "test") {
      $greske[] = "Choose anything other than 'test'";
    } 
    if ($sifra != $potv_sifra) {
        $greske[] = "Passwords don't match";
    }
    if (count($greske)==0) {
        $xml = new SimpleXMLElement ('<user></user>');
        $xml->addChild("name",$ime);
        $xml->addChild("email",$mail);
        $xml->addChild("password",md5($sifra));
        $xml->asXML("users/".$ime.".xml");
        header("Location: index.php");
        die;
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
    <title>Register</title>   
  </head>
  <body>
        <div class="div-center">     
           <div class="content">     
              <h3>Register yourself</h3>            
              <hr />
              <?php
                      if (count($greske)>0) {
                        foreach($greske as $greska){
                          echo "<p class='error'><b>$greska</b></p>";
                        }
                      }            
              ?>
              <form action="" method="post" >            
                <div class="form-group">
                  <label for="UnosEmail" class="form-label"><b>Email address</b></label>
                  <input name ="mail" type="email" maxlength="35" class="form-control" id="UnosEmail" placeholder="Email" required >
                </div>
                <div class="form-group">
                  <label for="UnosIme" class="form-label"><b>Username</b></label>
                  <input name ="ime" type="text" maxlength="10" class="form-control" id="UnosIme" onkeypress="return /[0-9a-zA-Z]/.test(event.key);" placeholder="Username" required >
                </div>              
                <div class="form-group">
                  <label for="UnosŠifra" class="form-label"><b>Password</b></label>
                  <input name="šifra" type="password" class="form-control" id="UnosŠifra" placeholder="Password" required >                
                </div>
                <div class="form-group">
                  <label for="PotvŠifra" class="form-label"><b>Confirm your password</b></label>
                  <input name="potvšifra" type="password" class="form-control" id="PotvŠifra" required>                
                </div>
                <div class="down"></div>
                <button name="registracija" type="submit" class="btn btn-primary">Register</button>                            
                <button type="reset" class="resbut btn btn-danger">Reset</button>
                <button type="button" class="goback btn btn-success"><a href="index.php">Go back</a></button>
              </form>
              <script>
                $(function() {
                  
                  $('#UnosEmail').on('keypress', function(mail) {
                      if (mail.which == 32){
                        mail.preventDefault();
                      }
                  }),
                  $('#UnosIme').on('keypress', function(ime) {
                      if (ime.which == 32){
                        ime.preventDefault();
                      }
                  });
              });
              </script>
            </div>
        </div>
  </body>
</html>
