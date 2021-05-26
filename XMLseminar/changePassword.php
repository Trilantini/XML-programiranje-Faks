<?php
session_start();
if (!file_exists('users/'.$_SESSION["ime"].'.xml')){
    header("Location:index.php");
    exit;  
}
$errorsPass = array();
if (isset($_POST['change'])) {
    $oldPass = md5($_POST["oldpass"]);
    $newPass = md5($_POST["newpass"]);
    $CnewPass = md5($_POST["Cnewpass"]);
    $xml = new SimpleXMLElement('users/'.$_SESSION['ime'].'.xml',0,true);  
    if ($oldPass != $xml->password) {
        $errorsPass[] = "Make sure your entry is correct";
    }
    if ($newPass == $oldPass) {
        $errorsPass[] = "Your new password can't be same as old";
    }
    if ($newPass != $CnewPass) {
        $errorsPass[] = "New passwords don't match";
    }
    if (count($errorsPass)==0) {    
        $xml->password = $newPass;
        $xml->asXML('users/'.$_SESSION['ime'].'.xml');
        header("Location:adminIndex.php");
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
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
    <!-- Title -->
    <title>Change password</title>
    <!-- Custom CSS -->
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />    
  </head>
  <body>
        <div class="div-center">     
           <div class="content">     
              <h3>Change your password</h3>            
              <hr />
              <?php
                      if (count($errorsPass)>0) {
                        foreach($errorsPass as $ep){
                          echo "<p class='error'><b>$ep</b></p>";
                        }
                      }            
              ?>             
              <form action="" method="post" >            
                <div class="form-group">
                  <label for="OldPassword" class="form-label"><b>Enter your old password</b></label>
                  <input name ="oldpass" type="password" class="form-control" id="OldPassword" placeholder="Old password" required >
                </div>
                <div class="form-group">
                  <label for="NewPassword" class="form-label"><b>Enter your new password</b></label>
                  <input name ="newpass" type="password" class="form-control" id="NewPassword" placeholder="New password" required >
                </div>        
                <div class="form-group">
                  <label for="ConfirmNewPassword" class="form-label"><b>Confirm your new password</b></label>
                  <input name="Cnewpass" type="password" class="form-control" id="ConfirmNewPassword" required>                
                </div>
                <div class="down"></div>
                <button name="change" type="submit" class="btn btn-primary">Change password</button>                            
                <button type="reset" class="resbut btn btn-danger">Reset</button>
                <button type="button" class="goback btn btn-success"><a href="adminIndex.php">Go back</a></button>
              </form>              
            </div>
        </div>
  </body>
</html>
