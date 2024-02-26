<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styles/index.css">
        <link rel="stylesheet" type="text/css" href="styles/headerFooter.css">
        <title>Connexion</title>
        <link rel="icon" type="image/x-icon" href="ressources/gustaveLogo.png">
    </head>
    <body>
    <header>
        <a href="index.php"><img id="home" src="ressources/gustaveBlanc.png" alt="LogoGustaveEiffel" title="Gustave Eiffel"/></a>
    </header>
    <section id="content">
        <div id="opacity">
            <article id="formContainer1">
                <h2>Connexion</h2>
        <?php
        //Communication avec la base de donnée
        include "includes/dataBase.php";
        //Récupérer les mails
        $DBMail=array();
        $getMailSql = 'SELECT mail FROM user';
        $getMail = $db->prepare($getMailSql);
        $getMail->execute() or die($db->errorInfo());
        $results = $getMail->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $value){
            $DBMail[]=$value["mail"];
        }
         //Définition de la fonction pour vérifier les cookies
         function CookieCheck($cat){
            if(array_key_exists($cat, $_COOKIE)){
                return true;
            }
         }

        function CookieMail(){
            if(CookieCheck("mail")){
                echo $_COOKIE["mail"];
            }
        }
        function CookieMDP(){
            if(CookieCheck("mdp")){
                echo $_COOKIE["mdp"];
            }
        }

        function Checkbox(){
            if(CookieCheck("mail")){
                echo '<input type="checkbox" name="Validation" value="QCB" id="checkbox" checked>';
            }else{
                echo '<input type="checkbox" name="Validation" value="QCB" id="checkbox">';
            }
        }
        //Définition de la fonction pour détecter les erreurs
        function error($input){
            if(empty($_POST[$input])){
                echo "<p class='error'>*L'identifiant ou le mot de passe est incorrect</p>";
                return true;
            }
        }
        //Définition de la fonction pour mettre en norme l'email
        function Check(){
            if(!error("mail") and !error("mdp")){
                global $DBMail;     
                if(!in_array($_POST["mail"],$DBMail)){
                    echo "<p class='error'>*L'identifiant ou le mot de passe est incorrect</p>";
                }else{
                    global $db;
                    $getMDPSql="SELECT mdp FROM user WHERE mail='".$_POST["mail"]."';";
                    $getMDP=$db->prepare($getMDPSql);
                    $getMDP->execute() or die($db->errorInfo());
                    $result2 = $getMDP->fetchAll(PDO::FETCH_ASSOC);
                    if(hash("sha256",$_POST["mdp"],false)!==$result2){
                        echo "<p class='error'>*L'identifiant ou le mot de passe est incorrect</p>";
                    }
                }
            }
        }
        //Définition de la fonction pour vérifier le mot de passe
        //Test pour savoir si toutes les cases sont rempli
        if(array_key_exists("mail" , $_POST)){
            //Récuper les mdp et mail de la DB
            if(empty($_POST["mail"])  or empty($_POST["mdp"])){
                // Appel du code du formulaire
                include "includes/connexion.php";
            }
            elseif(in_array($_POST["mail"],$DBMail)){
                $getMDPSql="SELECT mdp FROM user WHERE mail='".$_POST["mail"]."';";
                $getMDP=$db->prepare($getMDPSql);
                $getMDP->execute() or die($db->errorInfo());
                $result2 = $getMDP->fetchAll(PDO::FETCH_ASSOC);
                $DBMDP = $result2[0]["mdp"];
                if(hash("sha256",$_POST["mdp"],false)!==$DBMDP){
                    include "includes/connexion.php";
                }else{
                    session_start();
                    $getInfoSql = "SELECT mail, role, prenom, nom FROM user WHERE mail=:mail";
                    $getInfo=$db->prepare($getInfoSql);
                    $sqlParameter=[
                        "mail"=>$_POST["mail"]
                    ];
                    $getInfo->execute($sqlParameter) or die($db->errorInfo());
                    $result3= $getInfo->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION["mail"] = $result3[0]["mail"];
                    $_SESSION["role"] = $result3[0]["role"];
                    $_SESSION["nom"] = $result3[0]["nom"];
                    $_SESSION["prenom"] = $result3[0]["prenom"];
                    $_SESSION["logged"]="true";
                    setcookie('mail', $_SESSION['mail'], time() + 365*24*3600, true);
                    setcookie('mdp', $_POST['mdp'], time() + 365*24*3600, true);
                    header("location: pages/materiel.php");
                    exit();
                }
            }else{
                include "includes/connexion.php";
            }
        }else{
            ?>
            <form action="index.php" method="post">
                <section id="formMail">
                    <input id="mail" type="text" name="mail" placeholder="E-Mail" value="<?php CookieMail();?>"/>
                </section>

                <section id="formPassword">
                    <div id="eyes">
                        <input id="mdp" type="password" name="mdp" placeholder="Mot de passe" value="<?php CookieMDP();?>"/>
                        <img onCLick="view('img1','mdp')" id="img1" src="ressources/visible.png" alt="visible"/>
                    </div>
                </section>
                <section id="formCheckbox">
                    <?php Checkbox();?>
                    <label for='checkbox'>Se souvenir de moi</label>
                </section>
                <input id="submit" type="submit" value="Connexion"/>
                </form>
            </form>
        <?php
        }
        ?>
            </article>
            <article id="inscription">
                <a id="Button" href="pages/inscription.php">Se créer un compte</a>
            </article>
        </div>
    </section>
        <section id="prefooter"></section>
        <footer>
            <section id="footer1">
                <article class="footerContent">
                    <h3>À propos</h3>
                    <a href="https://www.univ-gustave-eiffel.fr/">Université Gustave Eiffel</a>
                    <a href="http://www.u-pem.fr/universite/presentation/plans-dacces/iut-a-meaux/">IUT De Marne-la-Vallée - Site de Meaux(UPEM)</a>
                </article>
                <article class="footerContent">
                    <h3>Informations légales</h3>
                    <a href="http://www.u-pem.fr/universite/mentions-legales/">Mentions Légales</a>
                </article>
                <article class="footerContent">
                    <h3>Contact</h3>
                    <p>5 boulevard Descartes Champs-sur-Marne 77454 Marne-la-Vallée cedex 2</p>
                    <p>Téléphone : +33 (0)1 60 95 75 00</p>
                </article>
                <article class="footerContent">
                    <h3>Nous suivre</h3>
                    <article id="socialMedia">
                        <a class="socialMedia" href="https://www.facebook.com/UniversiteGustaveEiffel/"><img src="ressources/facebookBlanc.png" alt="Facebook" title="Facebook"/></a>
                        <a class="socialMedia" href="https://twitter.com/UGustaveEiffel"><img src="ressources/twitterBlanc.png" alt="Twitter" title="Twitter"/></a>
                        <a class="socialMedia" href="https://www.linkedin.com/company/universit%C3%A9-gustave-eiffel/"><img src="ressources/instagramBlanc.png" alt="Instagram" title="Instagram"/></a>
                        <a class="socialMedia" href="https://www.youtube.com/channel/UCNMF04xs6lEAeFZ8TO6s2dw"><img src="ressources/youtubeBlanc.png" alt="Youtube" title="Youtube"/></a>
                        <a class="socialMedia" href="https://www.instagram.com/universitegustaveeiffel/"><img src=" ressources/linkedinBlanc.png" alt="LinkedIn" title="LinkedIn"/></a>
                    </article>
                </article>
            </section>
            <hr>
            <section id="footer2">
                <p>Autres sites du groupe :</p>
                <a href="https://ent.univ-eiffel.fr/>"> ENT Univ-eiffel</a>
                <a href="http://www.u-pem.fr/">UPEM</a>
                <a href="https://www.univ-gustave-eiffel.fr/">Université Gustave Eiffel</a>
            </section>
        </footer>
        <script src="scripts/connexion.js"></script>
       </body>
</html>