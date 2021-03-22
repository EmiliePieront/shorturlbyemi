<?php include "components/header.php";?>


<section id="pub">
    <h2 class="text-center pt-5 title">They trust in us</h2>
    <div class="container pb-5 pt-5">
        <a href="https://github.com/EmiliePieront" target="_blank"><img class="pubLogo" src="img/github1.png" alt="github logo"></a>
        <a href="https://becode.org/fr/" target="_blank"><img class="pubLogo" src="img/becode1.png" alt="becode logo"></a>
        <a href="https://codepen.io/emiliepieront" target="_blank"><img class="pubLogo" src="img/codepen1.png" alt="codepen logo"></a>
        <a href="http://mveuz.com" target="_blank"><img class="pubLogo"src="img/mvz1.png" alt="logo de Ma vie est un zapping"></a>
    </div>
</section>
<?php 
    if(isset($_POST['user']) && isset($_POST['submit'])){
        $prenom = $_POST['user'];
        //Prepare la requête
        $req = $bdd->prepare('INSERT INTO users(username) VALUES(?)');
        //Execute la requête
        $req->execute(array($prenom));
        header('location: https://zutzutzut.herokuapp.com/');
        exit();
    }

?>
<h1>HELLOOOOO I'M LINDSAY LOHAAAAAAN</h1>
<form method="post" action="index.php">
    <input name='user' type='text' placeholder="Enter your username">
    <label for="user">What's your name?</label><br/>
    <button type="submit" name="submit">Envoyer</button>
</form>


<?php include "components/footer.php"?>
