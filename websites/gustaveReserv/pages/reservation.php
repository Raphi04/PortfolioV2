<?php
    session_start(); 
    if(array_key_exists("logged",$_SESSION)){
        if($_SESSION["logged"]=="true"){
                ?>
                <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" type="text/css" href="../styles/reservation.css">
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
                            <p class="arriane">Demande de réservation</p>
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
                            <!--Détruire les variable de SESSION-->
                        </article>
                    </header>
                    <section id="content">
                    <?php
                        if(array_key_exists("item",$_POST)){
                            include "../includes/form.php";
                            include "../includes/dataBase.php";

                            //Si on a cliqué sur Réserver
                            if(array_key_exists("startDate",$_POST)){
                                ReservForm();
                                //Si il n'y a pas d'erreurs
                                if(!count($errors)>0){
                                    $newDebut = explode("/",$_POST["startDate"]);
                                    $newDebut = $newDebut[2]."-".$newDebut[1]."-".$newDebut[0];
                                    $newFin = explode("/",$_POST["endDate"]);
                                    $newFin = $newFin[2]."-".$newFin[1]."-".$newFin[0];

                                    //Si la date de fin est supérieur à la date de début
                                    if($newDebut<=$newFin){
                                        //Récupération des données de réservation
                                        $getReservationsSql = "SELECT debut,fin FROM reservation WHERE reference=(SELECT reference FROM article WHERE nom=:nom) AND statut='Accepté'";
                                        $getReservations = $db->prepare($getReservationsSql);
                                        $sqlParameter=[
                                            "nom"=>$_POST["item"]
                                        ];
                                        $getReservations->execute($sqlParameter) or die($db->errorInfo());
                                        $results = $getReservations->fetchAll(PDO::FETCH_ASSOC);
                                        $debut = array();
                                        $fin = array();
                                        foreach($results as $value){
                                            $debut[]=$value["debut"];
                                            $fin[]=$value["fin"];
                                        }

                                        //Si il n'y a pas de Réservation
                                        if(count($debut)==0){
                                            $bdReservSql = 'INSERT INTO reservation (debut, fin, reference, mail, statut) VALUES ("'.$newDebut.'", "'.$newFin.'", "'.$_POST["referenceInit"].'", "'.$_SESSION["mail"].'", "En attente de confirmation");';
                                            $bdReserv = $db->prepare($bdReservSql);
                                            $bdReserv->execute() or die($db->errorInfo());
                                            ?>
                                            <section id="pasConflit">
                                                <p>Votre réservation va être prise en charge par un administrateur</p>
                                            </section>
                                            <?php 
                                        }else{
                                            for($i=0; $i<count($debut); $i++){
                                                if($newDebut<$debut[$i] and $newFin<$debut[$i]){
                                                    $success++;
                                                }elseif($newDebut>$fin[$i]){
                                                    $success++;
                                                }else{
                                                    global $conflit;
                                                    $conflit++;
                                                }
                                            }
                                            if($conflit>0){
                                                ?>
                                                <section id="conflit">
                                                    <p>Il existe déjà une réservation pour ces dates</p>
                                                </section>
                                                <?php
                                            }else{
                                                $bdReservSql = 'INSERT INTO reservation (debut, fin, reference, mail, statut) VALUES ("'.$newDebut.'", "'.$newFin.'", "'.$_POST["referenceInit"].'", "'.$_SESSION["mail"].'", "En attente de confirmation");';
                                                $bdReserv = $db->prepare($bdReservSql);
                                                $bdReserv->execute() or die($db->errorInfo());
                                                ?>
                                                <section id="pasConflit">
                                                    <p>Votre réservation va être prise en charge par un administrateur</p>
                                                </section>
                                                <?php                                    
                                            }
                                        }                                
                                    }
                                }
                }else{
                    ReservForm();
                }
                ?>
                    </section>
                    <section id="prefooter">
                    </section>
                    <?php include "../includes/footer.php";?>
                    <script src="../scripts/header.js"></script>
                </body>
                </html>
                <?php
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