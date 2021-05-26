<?php
session_start();
if (!file_exists('users/'.$_SESSION["ime"].'.xml')){
    header("Location:index.php");
    exit;  
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
    <title>User Page</title>
    <!-- Custom CSS -->
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />    
  </head>
  <body>       
              <div class="container title">
                <h1>User page</h1>
              </div>
              <div class="container welcomeUser">
                <p>Welcome, <?php echo $_SESSION["ime"];?></p>
              </div>
              <div class="container">              
              <button type="submit" class="btn btn-danger"><a href="signout.php">Log out</a></button>              
              <button type="submit" class="btn btn-success"><a href="changePassword.php">Change your password</a></button>
              <button type="submit" class="create btn btn-info"><a href="createArticle.php">Create article</a></button>
              </div>    
              
              <main class="results">
                <section class='row'>
              
              <?php                
                foreach(glob("articles/*.xml") as $fileIme){      
                      $xml = new SimpleXMLElement ("$fileIme",0,true);
                      if ($_SESSION["ime"]==$xml->author) {                                           
                        echo"
                              <article class='col-md-3'>
                                <h3 class='article-headline'>$xml->headline</h3>
                                <p>Uploaded: $xml->date</p>
                                <p class='tagline'>Tags:";
                                foreach($xml->children() as $child)
                                {
                                  foreach($child->children() as $grand_child){
                                    echo "<p class='tags'>- $grand_child</p>";
                                  }                                
                                }          
                               echo "</p>
                                <div class='short'>
                                  <h4>Abstract</h4>
                                  <p>$xml->abstract</p>
                                </div>
                                <div class='begin'>
                                  <h4>Introduction</h4>
                                  <p>$xml->Intro</p>
                                </div>
                                <div class='main'>
                                  <h4>Main paragraph</h4>
                                  <p>$xml->Main</p>
                                </div>
                                <div class='conclusion'>
                                  <h4>Conclusion</h4>
                                  <p>$xml->Conclusion</p>
                                </div>
                                
                              </article>
                            ";  
                      }
                }             
              ?>
              </section>
            </main>
   </body>
</html>
