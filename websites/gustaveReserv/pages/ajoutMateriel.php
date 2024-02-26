<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" text="text/css" href="../styles/ajoutMateriel.css">
    <link rel="stylesheet" text="text/css" href="../styles/headerFooter.css">
    <title>Ajout de matériel</title>
</head>
<body>
    <header>
        <a href="materiel.php"><img id="home" src="../ressources/gustaveBlanc.png" alt="LogoGustaveEiffel" title="Gustave Eiffel"/></a>
        <nav>
            <a href="materiel.php"><img src="../ressources/homeblanc.png" alt="Accueil" title="Accueil" class="arriane" id="homeBlanc"></a>
            <p class="arriane">></p>
            <p class="arriane">Ajout de matériel</p>
            <article id="compte" onClick="menu()">
                <p id="nameHeader"><?php session_start(); echo $_SESSION["prenom"]." ".$_SESSION["nom"];?></p>
                <img id="user" src="../ressources/utilisateur.png" alt="Mon compte" title="Mon compte">
            </article>
        </nav>
        <article id="menu">
            <!--SI ON A LE TEMPS: MON COMPTE (POUR MODIF LES INFOS)-->
            <?php 
            
            if($_SESSION["role"]=="admin"){
                echo '<a href="gestionReserv.php"><p id="menuStart">Gestion des réservations</p></a>';
                echo '<a href="mesReserv.php"><p class="menuContent">Mes réservations</p></a>';
            }else{
                echo '<a href="mesReserv.php"><p id="menuStart">Mes réservations</p></a>';
            }?>
            <a href="logOut.php"><p id="logout">Se déconnecter</p></a>
        </article>
    </header>
    
    <section id="content">
        <?php
         function error(){
            if(array_key_exists("nom",$_POST)){
                global $dbRef;                                
                if(!is_numeric($_POST["reference"])){
                    echo '<p class="error">*Veuillez entrer un numéro</p>';
                }elseif(in_array($_POST["reference"]) and $_POST["reference"]!==$_POST["referenceInit"]){
                    echo '<p class="error">*Ce numéro de référence ('.$_POST["reference"].') est déjà attribué</p>';
                }
            }
        }
        
        function select(){
            $types=array("Audio", "Vidéo", "Équipement");
            echo '<option value="'.$_POST['type'].'">'.$_POST['type'].'</option>';
            foreach($types as $cat){
                if($_POST['type']!==$cat){
                    echo '<option value="'.$cat.'">'.$cat.'</option>';
                }
            }
        }

        function success($input){
            if(!empty($_POST[$input])){
                echo $_POST["$input"];
            }
        }

        function error1($input){
            if(empty($_POST[$input])){
                echo "<p class='error'>*Veuillez remplir ce champ</p>";
                return true;
            }
        }

        function error2($input){
            if(!error1($input)){
                if(!filter_var($_POST["reference"], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9\/]/")))){
                    echo "<p class='error'>*Veuillez entrer des numéros</p>";
                
                }
            }
        }

        if(array_key_exists("logged",$_SESSION)){
            if($_SESSION["logged"]=="true"){
                if($_SESSION["role"]=="admin"){
                    if(array_key_exists("nom",$_POST)){
                        if(empty($_POST["nom"]) or empty($_FILES["file"]["name"]) or empty($_POST["type"]) or empty($_POST["description"])){
                            // Appel du code du formulaire
                            include "../includes/ajoutMateriel.php";
                        }else{
                            include "../includes/dataBase.php";
                            move_uploaded_file($_FILES["file"]["tmp_name"], "../ressources/materiel/".$_POST["nom"].".jpg");
                            $getReferenceSql = "SELECT reference FROM article;";
                            $getReference = $db->prepare($getReferenceSql);
                            $getReference->execute() or die($db->errorInfo());
                            $results=$getReference->fetchAll(PDO::FETCH_ASSOC);
                            $referenceDB = array();
                            foreach($results as $value){
                                $referenceDB[]=$value["reference"];
                            }
                            $newRef=1;
                            while(in_array($newRef,$referenceDB)){
                                $newRef++;
                            }
                            $setArticleSql ='INSERT INTO article (nom, type, reference, description) VALUES ("'.$_POST['nom'].'", "'.$_POST['type'].'", "'.$newRef.'", "'.$_POST['description'].'");';
                            $setArticle = $db->prepare($setArticleSql);
                            echo $setArticleSql;
                            $setArticle->execute() or die($db->errorInfo());
                            header ("location:materiel.php");
                            exit();
                        }
                    }else{
                        ?>
                        <form action="ajoutMateriel.php" method="post" enctype="multipart/form-data">
                            <section id="itemPresentation">
                                <label for="file">Seul les fichiers ".jpg" sont autorisés</label>
                                <input id="file" type="file" name="file" accept=".jpg"/>
                                <section id="itemNom">
                                    <article>
                                        <label for="nom">Nom : </label>
                                        <input id="nom" type="text" name="nom" onKeyUp="autoCaps()">
                                    </article>
                                </section>
                                <article id="itemType">
                                    <label for="type">Type :</label>
                                    <select id="type" type="text" name="type">
                                    <option value="Audio">Audio</option>
                                    <option value="Équipement">Équipement</option>
                                    <option value="Vidéo">Vidéo</option>
                                    </select>
                                </article>
                            </section>                                    
                            <section id="itemInfos">
                                <p id="advice">Pour revenir à la ligne rajoutez une balise "br"</p>
                                <textarea name="description"></textarea>
                                <input id="save" type="submit"/>
                            </section>
                        </form>
                        <?php
                    }
                }else{
                    header("location:materiel.php");
                    exit();
                }
                      
                    /*Le code de toutes ta page est ici
                */
            }else{
                header("location:../index.php");
                exit();
            }
        }else{
            header("location:../index.php");
            exit();
        }
        ?>

    </section>
    <section id="prefooter">
    </section>
    <?php include "../includes/footer.php";?>
    <script src="../scripts/header.js"></script>
    <script src="../scripts/modifMateriel.js"></script>
</body>
</html>