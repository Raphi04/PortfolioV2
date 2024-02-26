<?php
    session_start(); 
    if(array_key_exists("logged",$_SESSION)){
        if($_SESSION["logged"]=="true"){
            if(array_key_exists("referenceInit", $_POST)){
                ?>
                <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" type="text/css" href="../styles/modifMateriel.css">
                        <link rel="stylesheet" text="text/css" href="../styles/headerFooter.css">
                        <title>Mes réservations</title>
                        <link rel="icon" type="image/x-icon" href="../ressources/gustaveLogo.png">
                    </head>
                    <body>
                    <header>
                            <a href="materiel.php"><img id="home" src="../ressources/gustaveBlanc.png" alt="LogoGustaveEiffel" title="Gustave Eiffel"/></a>
                            <nav>
                                <a href="materiel.php"><img src="../ressources/homeblanc.png" alt="Accueil" title="Accueil" class="arriane" id="homeBlanc"></a>
                                <p class="arriane">></p>
                                <p class="arriane">Modification du matériel</p>
                                <article id="compte" onClick="menu()">
                                    <p id="nameHeader"><?php echo $_SESSION["prenom"]." ".$_SESSION["nom"];?></p>
                                    <img id="user" src="../ressources/utilisateur.png" alt="Mon compte" title="Mon compte">
                                </article>
                            </nav>
                            <article id="menu">
                                <!--SI ON A LE TEMPS: MON COMPTE (POUR MODIF LES INFOS)-->
                                <?php if($_SESSION["role"]=="admin"){
                                    echo '<a href="gestionReserv.php"><p id="menuStart">Gestion des réservations</p></a>';
                                    echo '<a href="mesReserv.php"><p class="menuContent">Mes réservations</p></a>';
                                }else{
                                    echo '<a href="mesReserv.php"><p id="menuStart">Mes réservations</p></a>';
                                }?>
                                <a href="logOut.php"><p id="logout">Se déconnecter</p></a>
                            </article>
                        </header>
                        <?php
                        function select(){
                            global $type;
                            $types=array("Audio", "Vidéo", "Équipement");
                            echo '<option value="'.$type.'">'.$type.'</option>';
                            foreach($types as $cat){
                                if($type!==$cat){
                                    echo '<option value="'.$cat.'">'.$cat.'</option>';
                                }
                            }
                        }

                        function error(){
                            if(array_key_exists("nom",$_POST)){
                                global $dbRef;
                                if(!is_numeric($_POST["reference"])){
                                    echo '<p id="error">*Veuillez entrer un numéro</p>';
                                }elseif(in_array($_POST["reference"],$dbRef) and $_POST["reference"]!==$_POST["referenceInit"]){
                                    echo '<p id="error">*Ce numéro de référence ('.$_POST["reference"].') est déjà attribué</p>';
                                }
                            }
                        }

                        include "../includes/dataBase.php";
                        //Si sauvegarder a été cliqué
                        if(array_key_exists("nom",$_POST)){
                            rename("../ressources/materiel/".$_POST["nomInit"].".jpg","../ressources/materiel/".$_POST["nom"].".jpg");
                            $getReferenceSQL = "SELECT reference FROM article";
                            $getReference = $db->prepare($getReferenceSQL);
                            $getReference->execute() or die($db->errorInfo());
                            $refResult=$getReference->fetchAll(PDO::FETCH_ASSOC);
                            foreach($refResult as $value){
                                $dbRef[]=$value["reference"];
                            }

                            //Changement d'image si il y a
                            if(array_key_exists("file",$_FILES)){
                                move_uploaded_file($_FILES["file"]["tmp_name"], "../ressources/materiel/".$_POST["nom"].".jpg");
                            }
                            //Si la nouvelle référence est différentes de celles existantes ou égale à l'initial
                            if(is_numeric($_POST["reference"])){
                                if(!in_array($_POST["reference"],$dbRef) or $_POST["reference"]==$_POST["referenceInit"]){
                                    $modifItemSQL = "UPDATE article SET nom = :nom, type = :type, reference = :reference, description = :description WHERE article.reference = :referenceInit;";
                                    $modifItem = $db->prepare($modifItemSQL);
                                    $sqlParameters=[
                                        "nom" => $_POST["nom"],
                                        "type" => $_POST["type"],
                                        "reference" => $_POST["reference"],
                                        "description" => $_POST["description"],
                                        "referenceInit"=> $_POST["referenceInit"]
                                    ];
                                    $modifItem->execute($sqlParameters) or die($db->errorInfo());
                                    header("location:materiel.php");
                                    exit();     
                                }
                            }
                        }
                        //Récupération des informations
                        $getItemSQL = "SELECT * FROM article WHERE reference=:reference";
                        $getItem = $db->prepare($getItemSQL);
                        $sqlParameter=[
                            "reference"=>$_POST["referenceInit"]
                        ];
                        $getItem->execute($sqlParameter) or die($db->errorInfo());
                        $results = $getItem->fetchAll(PDO::FETCH_ASSOC);
                        foreach($results as $value){
                            $nom = $value["nom"];
                            $type = $value["type"];
                            $reference = $value["reference"];
                            $description = $value["description"];
                        }
            }else{
                header("location:materiel.php");
                exit();
            }
        }else{
            header("location:../index.php");
            exit();
        }
    }else{
        header("location:../index.php");
        exit();
    }
    ?>
    <form action="modifMateriel" method="post" enctype="multipart/form-data">
        <section id="content">
            <section id="itemPresentation">
                <label for="file">Seul les fichiers ".jpg" sont autorisés</label>
                <input id="file" type="file" name="file" accept=".jpg">
                <img src="../ressources/materiel/<?php echo $nom;?>.jpg" alt="<?php echo $nom;?>" title="<?php echo $nom;?>"/>
                <input id="nom" type="text" name="nom" value="<?php echo $nom;?>" onKeyUp="autoCaps()">
            </section>
            <section id="itemInfos">
                <section id="itemSpe">
                    <article id="itemType">
                        <label for="type">Type :</label>
                        <select id="type" type="text" name="type">
                            <?php select();?>
                        </select>
                    </article>
                    <article id="itemReference">
                        <label for="reference">Référence :</label>
                        <input id="reference" type="text" name="reference" value="<?php echo $reference;?>">
                        <?php error();?>
                    </article>
                </section>
                <p id="advice">Pour revenir à la ligne rajoutez une balise "br"</p>
                <textarea name="description"><?php echo $description;?></textarea>
                <input name="nomInit" type="hidden" value="<?php echo $nom;?>">
                <input name="referenceInit" type="hidden" value="<?php echo $reference;?>">
                <input id="save" type="submit" value="Sauvegarder"/>
            </section>
        </section>
    </form>
    <section id="prefooter"></section>
    <?php include "../includes/footer.php";?>
    <script src="../scripts/modifMateriel.js"></script>
    <script src="../scripts/header.js"></script>
</body>
</html>