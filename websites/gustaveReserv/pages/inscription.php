<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/inscription.css">
    <link rel="stylesheet" type="text/css" href="../styles/headerFooter.css">
    <title>Inscription</title>
    <link rel="icon" type="image/x-icon" href="../ressources/gustaveLogo.png">
</head>
<body>
    <header>
        <a href="../index.php"><img id="home" src="../ressources/gustaveBlanc.png" alt="LogoGustaveEiffel" title="Gustave Eiffel"/></a>
    </header>
    <section id="content">
        <div id="opacity">
            <article id="formContainer">
                <h2>Inscription</h2>
        <?php
        //Communication avec la base de donnée
        include "../includes/dataBase.php";
        $DBMail=array();
        $getMailSql = 'SELECT mail FROM user';
        $getMail = $db->prepare($getMailSql);
        $getMail->execute() or die($db->errorInfo());
        $results = $getMail->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $value){
            $DBMail[]=$value["mail"];
        }
        //Définition de la fonction pour détecter les erreurs
        function error($input){
            if(empty($_POST[$input])){
                echo "<p class='error'>*Veuillez remplir ce champ</p>";
                return true;
            }
        }
        //Définition de la fonction pour réécrire les valeurs entrées
        function success($input){
            if(!empty($_POST[$input])){
                echo $_POST["$input"];
            }
        }
        //Définition de la fonction pour mettre en norme l'email
        function mailCheck(){
            if(!error("mail")){
                if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
                    echo "<p class='error'>*Veuillez écrire une adresse mail correct (example@univ-eiffel.com)</p>";
                }else{
                    global $DBMail;     
                    if(in_array($_POST["mail"],$DBMail)){
                        echo "<p class='error'>*Cet e-mail est déjà associer à un compte</p>";
                    }
                }
            }
        }
        //Définition de la fonction pour mettre en norme le nom
        function nameCheck(){
            if(!error("name")){
                if(!filter_var($_POST["name"],FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/\b[A-Z]{1}[a-z]{1,}\b/")))){
                    echo "<p class='error'>*Écrivez un nom valide</p>";
                }
            }
        }
        //Définition de la fonction pour mettre en norme le prénom
        function firstnameCheck(){
            if(!error("firstname")){
                if(!filter_var($_POST["firstname"],FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/\b[A-Z]{1}[a-z]{1,}\b/")))){
                    echo "<p class='error'>*Écrivez un prénom valide</p>";
                }
            }
        }
        //Définition de la fonction pour mettre en norme la date
        function bornDateCheck(){
            if(!error("bornDate")){
                if (filter_var($_POST["bornDate"],FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9\/]/")))){
                    $bornDate= $_POST["bornDate"];
                    $bornDate= explode("/",$bornDate);
                    if (count($bornDate)!==3 or !checkdate($bornDate["1"], $bornDate["0"], $bornDate["2"])){
                        echo "<p class='error'>*Écriver sous la forme jj/mm/aaaa et une date valide</p>";
                    }
                }else{
                echo "<p class='error'>*Écrivez seulement des chiffres</p>";
                }
            }
        }
        //Définition de la fonction pour vérifier les deux mots de passes
        function mdpCheck(){
            if(!error("mdp")){
                if(strlen($_POST["mdp"])>=6){
                    if($_POST["mdp"]!==$_POST["Cmdp"]){
                        echo "<p class='error'>*Écrivez le même mot de passe</p>";
                        return true;
                    }
                }else{
                    echo "<p class='error'>*Le mot de passe doit comporter 6 caractères</p>";
                    return true;
                }
            }
        }
        //Test pour savoir si l'utilisateur est là pour la première fois
        if(array_key_exists("name",$_POST)){
            global $DBMail;
            $bornDate= $_POST["bornDate"];
            $bornDate= explode("/",$bornDate);
            //Test pour savoir si toutes les cases sont rempli
            if(empty($_POST["mail"]) or empty($_POST["name"]) or empty($_POST["firstname"]) or empty($_POST["bornDate"]) or empty($_POST["mdp"]) or empty($_POST["Cmdp"])){
                // Appel du code du formulaire
                include "../includes/formInscript.php";
            //Test pour savoir si l'email est valide
            }elseif(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
                include "../includes/formInscript.php";
            }elseif(in_array($_POST["mail"],$DBMail)){
                include "../includes/formInscript.php";
            //Test pour savoir si le nom est valide
            }elseif(!filter_var($_POST["name"],FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/\b[A-Z]{1}[a-z]{1,}\b/")))){
                include "../includes/formInscript.php";
            //Test pour savoir si le prénom est valide
            }elseif(!filter_var($_POST["firstname"],FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/\b[A-Z]{1}[a-z]{1,}\b/")))){
                include "../includes/formInscript.php";
            //Test pour savoir si la date de naissance est valide
            }elseif(!filter_var($_POST["bornDate"],FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9\/]/")))){
                include "../includes/formInscript.php";
            }elseif(count($bornDate)!==3 or !checkdate($bornDate["1"], $bornDate["0"], $bornDate["2"])){
                include "../includes/formInscript.php";
            //Test pour savoir si les mots de passes sont valides et égaux
            }elseif(strlen($_POST["mdp"])<6){
                include "../includes/formInscript.php";
            }elseif($_POST["mdp"]!==$_POST["Cmdp"]){
                include "../includes/formInscript.php";
            }else{
                //Chiffrage du mot de passe
                $hashed = hash("sha256",$_POST['mdp'],false);
                $insertUserSql = "INSERT INTO `user` (`prenom`, `nom`, `mail`, `naissance`, `mdp`, `role`) VALUES ('$_POST[firstname]','$_POST[name]','$_POST[mail]','$_POST[bornDate]','$hashed','utilisateur');";        
                $insertUser = $db->prepare($insertUserSql);
                $insertUser->execute() or die($db->errorInfo());
                //redirection vers la page d'accueil
                header("location: ../index.php");
                exit();
            }
        }else{?>
            <form action="inscription.php" method="post">
                <fieldset id="formContent">
                    <section id="formName">
                        <article>
                            <label for="firstname">Prénom<span>*</span></label>
                            <input id="firstname" type="text" name="firstname"/>
                        </article>
                        <article>
                            <label for="name">Nom<span>*</span></label>
                            <input id="name" type="text" name="name"/>
                        </article>
                    </section>

                    <section id="formMail">
                        <label for="mail">Adresse e-mail<span>*</span></label>
                        <input id="mail" type="text" name="mail"/>
                    </section>

                    <section id="formDate">
                        <label for="bornDate">Date de naissance<span>*</span></label>
                        <input id="bornDate" type="text" name="bornDate"/>
                    </section>

                    <section class="formPassword">
                        <label for="mdp">Mot de passe<span>*</span></label>
                        <div class="eyes">
                            <input id="mdp" type="password" name="mdp"/>
                            <img onCLick="view('img1','mdp')" id="img1" src="../ressources/visible.png" alt="visible"/>
                        </div>
                    </section>

                    <section class="formPassword">
                        <label for="Cmdp">Confirmation du mot de passe<span>*</span></label>
                        <div class="eyes">
                            <input id="Cmdp" type="password" name="Cmdp"/>
                            <img onCLick="view('img2','Cmdp')" id="img2" src="../ressources/visible.png" alt="visible"/>
                        </div>
                    </section>
                </fieldset>
                <fieldset id="submitForm">
                    <a href ="../index.php"><p id="connexion">Se connecter à un compte existant</p></a>
                    <input id="submit" type="submit" value="S'inscrire"/>
                </fieldset>
            </form> 
        <?php
        }
        ?>
            </article>
        </div>
    </section>
        <section id="prefooter"></section>
        <?php include "../includes/footer.php";?>
    <script src="../scripts/inscription.js"></script>
</body>
</html>