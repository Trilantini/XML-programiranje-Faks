<?php 
session_start(); 

if (!file_exists('users/'.$_SESSION["ime"].'.xml')){
    header("Location:index.php");
    exit;  
}

if (isset($_POST["AddArticle"]) and isset($_POST["id"]) and isset($_POST["headline"]) and isset($_POST["date"]) and isset($_POST["keyword1"]) and isset($_POST["keyword2"]) and isset($_POST["keyword3"])
    and isset($_POST["abstract"]) and isset($_POST["body-intro"]) and isset($_POST["body-main"]) and isset($_POST["body-conclusion"])  ) {
        $xml= new SimpleXMLElement('<article></article>');
        $xmluser = new SimpleXMLElement('users/'.$_SESSION["ime"].'.xml',0,true);

        $xml->addAttribute('id',$_POST['id']);
        $headline=$xml->addChild('headline', $_POST['headline']);
        $xml->addChild('author', $_SESSION["ime"]);
        $xml->addChild('date', date('d.m.Y',strtotime($_POST["date"])));
        $xml->addChild('email', $xmluser->email);
        $keywords = $xml->addChild('keywords');
        $keyword1 = $keywords->addChild('keyword', $_POST['keyword1']);
        $keyword1->addAttribute('number','1');
        $keyword2 = $keywords->addChild('keyword', $_POST['keyword2']);
        $keyword2->addAttribute('number','2');
        $keyword3 = $keywords->addChild('keyword', $_POST['keyword3']);
        $keyword3->addAttribute('number','3');
        $xml->addChild('abstract', $_POST['abstract']);
        $xml->addChild('Intro', $_POST['body-intro']);
        $xml->addChild('Main', $_POST['body-main']);
        $xml->addChild('Conclusion', $_POST['body-conclusion']);
        
        $xml->asXML('articles/'.$headline.'.xml');
        
        header("Location:adminIndex.php");
}

?>   

<!DOCTYPE html>
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
        <title>Create an Article</title>  
    </head>    
    <body class="createArticle">
        <main>
            <h1>Create an XML Article</h1>
            
            
            <div class="cancel">
            <a href="adminIndex.php">Cancel </a>
            </div>
            
            
            <br><br>
            <section>
            <form name="createArticle" action="" method="post" class="row g-">   

                <div class="col-md-6">
                    <label for="id" class="form-label">Article ID:</label>
                    <input type="number" class="form-control" name="id" id="id" min="1" max="100" required> 
                </div>

                <div class="col-md-6">
                    <label for="headline" class="form-label">Headline:</label>
                    <input type="text" maxlength="25"  class="form-control" name="headline" id="headline" required>
                </div>

                <div class="down"></div>
                <div class="down"></div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Author name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $_SESSION['ime']?>" disabled>
                </div>

                <div class="col-md-6">
                    <label for="date" class="form-label">Date:</label>
                    <input required type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date" max="2099-12-31" id="date" placeholder="DateExample"/>
                </div>                
                <script>
                   date.min = new Date().toISOString().slice(0, -14);
                </script>
                
                <div class="down"></div>
                <div class="down"></div>
                <label for="email" class="form-label">Contact:</label>
                <input type="email"  class="form-control" name="email" id="email" value="<?php                
                $xmlusers = new SimpleXMLElement('users/'.$_SESSION["ime"].'.xml',0,true);
                echo $xmlusers->email;
                ?>" disabled>
                <div class="down"></div>
                <div class="down"></div>
                <fieldset>
                    <legend>Keywords:</legend>
                    <label for="keyword1" class="form-label">Keyword 1:</label>
                    <input type="text" name="keyword1"  class="form-control" id="keyword1" required><br>
                    <label for="keyword2" class="form-label">Keyword 2:</label>
                    <input type="text" name="keyword2"  class="form-control" id="keyword2" required><br>
                    <label for="keyword3" class="form-label">Keyword 3:</label>
                    <input type="text" name="keyword3"  class="form-control" id="keyword3" required>
                </fieldset>
                
                
                <div class="down"></div>
                <div class="down"></div>

                <div class="col-md-12">
                <label for="abstract" class="form-label">Abstract:</label>
                <textarea name="abstract" cols="50" rows="5"  class="form-control" id="abstract" required></textarea>
                </div>
                
                
                <div class="down"></div>

                <div class="col-md-12">
                <label for="body-intro" class="form-label">Intro:</label>
                <textarea name="body-intro"  class="form-control" cols="70" rows="10" wrap="soft" required></textarea>
                </div>
                
                
                <div class="down"></div>
                <div class="col-md-12">
                <label for="body-main" class="form-label">Main:</label>
                <textarea name="body-main" cols="70" rows="10"  class="form-control" wrap="soft" required ></textarea>
                </div>
                
                            
                <div class="down"></div>
                <div class="col-md-12">
                <label for="body-conclusion" class="form-label">Conclusion:</label>
                <textarea name="body-conclusion" cols="70" rows="10"  class="form-control" wrap="soft" required></textarea>   
                </div>
                

                <div class="down"></div>
                <div class="down"></div>
                
                <button type="submit" name="AddArticle">CREATE</button>
                
                
            </form>
            </section>
        </main>
    </body>
</html>