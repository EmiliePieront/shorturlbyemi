<?php
if (isset($_GET['q'])){
    $shortcut = htmlspecialchars($_GET['q']);


    include "dbconnect.php";
    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE shortcut = ?');
    $req->execute(array($shortcut));
    while ($result = $req->fetch()){
        if ($result['x'] != 1){
            header('location: ../?error=true&message=Unknown URL');
        }
    }

    //REDIRECTION : 
    include "dbconnect.php";
    $req = $bdd->prepare('SELECT * FROM links WHERE shortcut = ?');
    $req->execute(array($shortcut));

    while ($result = $req->fetch()){
        header('location: '.$result['url']);
        exit();
    }
}
// Créer le raccourcis
if (isset($_POST["url"])){
    $url = $_POST["url"];
    //Verif si pas un lien : 
    if(!filter_var($url, FILTER_VALIDATE_URL)){
        header('location: ../?error=true&message=Wrong url');
        exit();
    }
    $shortcut = crypt($url, rand());

    include "dbconnect.php";

    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE url = ?');
    $req->execute(array($url));

    while ($result = $req->fetch()){
        if($result['x'] != 0) {
            header('location: ../?error=true&message=Adress already shortened');
            exit();
        }
    }

    $req = $bdd->prepare('INSERT INTO links(url, shortcut) VALUES(?,?)');
    $req->execute(array($url, $shortcut));

    header('location: ./?short='.$shortcut);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="design/main.css">
        <link rel="icon" type="image/png" href="img/redo.png">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <title>Url Shortener</title>
        <!-- Favicon créé par Pixel Perfect : Icons made by Pixel perfect"https://www.flaticon.com/authors/pixel-perfect"  from www.flaticon.com -->
    </head>
    <body>

        <section id="hello">
            <!-- Photo by Lorenzo Herrera on Unsplash -->
            <div class="container">
                <header>
                    <img src="./img/logo-blue.png" alt="logo" id="logo">
                </header>

                <h1 class="h2 title">Your URL is too long? Use me, I'll make it shorter</h1>
                <h2 class="h3 title">A shorter URL, for a better World</h2>

                <form action="index.php" method="post">
                    <div class="row form">
                        <input type="url" name="url" placeholder="Insert your URL here" id="inputUrl">
                        <button class="btn btn-success" id="inputUrl" type="submit">Shorten</button>
                    </div>
                </form>
                <?php 
                    if(isset($_GET['error']) && isset($_GET['message'])) { ?>
                        <div class="center"> 
                            <div id="result">
                                <p><?php echo htmlspecialchars($_GET["message"]);?></p>
                            </div>
                        </div>

                    <?php  } else if (isset($_GET["short"])) {?>
                        <div class="center"> 
                            <div id="result">
                                <p>Your short Url : <a href="https://shorturlbyemi.herokuapp.com/index.php/?q=<?php echo htmlspecialchars($_GET["short"]);?>">https://shorturlbyemi.herokuapp.com/index.php/?q=<?php echo htmlspecialchars($_GET["short"]);?></a></p>
                            </div>
                        </div>
                   <?php } 

                ?>
            </div>
        </section>
        
