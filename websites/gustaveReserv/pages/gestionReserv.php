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
                    <link rel="stylesheet" type="text/css" href="../styles/gestionReserv.css">
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
                            <a href="gestionReserv.php"><p class="arriane">Gestion des réservations</p></a>
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
                    if(array_key_exists("cat",$_POST)){?>
                        <?php
                            echo '<section id="content2">';
                            include "../includes/dataBase.php";
                            
                            //On affiche les cas traités
                            if($_POST["cat"]=="traité"){
                                //Pagination (aidé par une vidéo: youtube.com/watch?v=1fMPD2dzmPQ&ab_channel=MohamedChiny)
                                //Nombre d'entrée dans la base de donnée
                                $getCountSQL = "SELECT count(debut) as count FROM reservation WHERE statut='Accepté' OR statut='Refusé';";
                                $getCount = $db->prepare($getCountSQL);
                                $getCount->execute() or die($db->errorInfo());
                                $result=$getCount->fetchAll(PDO::FETCH_ASSOC);

                                if($result[0]["count"]==0){
                                    echo "<p id='notFound'>Il n'y a aucune demande de réservation traitée</p>";
                                }else{
                                    //Définition de la pagination
                                    if(array_key_exists("page",$_POST)){
                                        $page=$_POST["page"];
                                    }else{
                                        $page=1;
                                    }
                                    $nbItems = $result[0]["count"];
                                    $itemsPP=5;
                                    $nbPages=ceil($nbItems/$itemsPP);
                                    $init=($page-1)*$itemsPP;


                                    //Récupération des infos de réservation
                                    $getReservSql = "SELECT * FROM reservation WHERE statut='Accepté' OR statut='Refusé' ORDER BY debut DESC, statut ASC limit $init, $itemsPP";
                                    $getReserv = $db->prepare($getReservSql);
                                    $getReserv->execute() or die($db->errorInfo());
                                    $results=$getReserv->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($results as $value){
                                        $debut[]=$value["debut"];
                                        $fin[]=$value["fin"];
                                        $reference[]=$value["reference"];
                                        $mail[]=$value["mail"];
                                        $statut[]=$value["statut"];
                                        $numero[]=$value["numero"];
                                    }
                                    foreach($reference as $key=>$value){
                                        $getNameSql = "SELECT nom FROM article WHERE reference=:reference";
                                        $getName = $db->prepare($getNameSql);
                                        $sqlParameter=[
                                            "reference" => $value
                                        ];
                                        $getName->execute($sqlParameter) or die($db->errorInfo());
                                        $result=$getName->fetchAll(PDO::FETCH_ASSOC);
                                        $nom[]=$result[0]["nom"];
                                    }
                                    if(count($debut)==0){
                                        echo "<p id='notFound'>Il n'y a aucune réservation traité pour le moment</p>";
                                    }else{
                                        ?>
                                            <section id="tabHead">
                                                <article id="nomHead">
                                                    <p>Nom du matériel</p>
                                                </article>
                                                <article id="referenceHead">
                                                    <p>Référence</p>
                                                </article>
                                                <article class="dateHead">
                                                    <p>Date de début</p>
                                                </article>
                                                <article class="dateHead">
                                                    <p>Date de fin</p>
                                                </article>
                                                <article id="numeroHead">
                                                    <p>N° réservation</p>
                                                </article>
                                                <article id="statutHead">
                                                    <p>Statut</p>
                                                </article>
                                            </section>
                                        <?php
                                        for($i=0; $i<count($debut); $i++){
                                            $recompD=explode("-", $debut[$i]);
                                            $debut[$i]=$recompD[2]."/".$recompD[1]."/".$recompD[0];
                                            $recompF=explode("-", $fin[$i]);
                                            $fin[$i]=$recompF[2]."/".$recompF[1]."/".$recompF[0];

                                            ?>
                                            <section class="reservationContainer">
                                                <section class="reservation">
                                                    <article id="nom">
                                                        <p><?php echo $nom[$i]; ?></p>
                                                    </article>
                                                    <article id="reference">
                                                        <p><?php echo $reference[$i]?></p>
                                                    </article>
                                                    <article class="date">
                                                        <p><?php echo $debut[$i]?></p>
                                                    </article>
                                                    <article class="date">
                                                        <p><?php echo $fin[$i]?></p>
                                                    </article>
                                                    <article id="numero">
                                                        <p><?php echo $numero[$i]?></p>
                                                    </article>
                                                    <article id="statut">
                                                        <p><?php echo $statut[$i]?></p>
                                                    </article>
                                                </section>
                                                <form action="détailsReserv" method="post">
                                                    <input type="hidden" value="traité" name="where">
                                                    <input type="hidden" value="<?php echo $numero[$i]?>" name="numero">
                                                    <input type="submit" class="details" value="Détails"/>
                                                </form>
                                            </section>
                                            <?php
                                        }
                                    //Affichage de la pagination
                                        echo '<section id="pagination">';
                                        for($i=1; $i<=$nbPages;$i++){
                                            echo '<form action="gestionReserv.php" method=post>';
                                                echo '<input name="cat" type="hidden" value="traité">';
                                                echo '<input name="page" type="hidden" value="'.$i.'">';
                                                echo '<input class="pagiButton" type="submit" value="'.$i.'">';
                                            echo '</form>';
                                        }
                                        echo '</section>';
                                    }
                                }
                            //On affiche les cas non traités
                            }else{
                                //Pagination (aidé par une vidéo: youtube.com/watch?v=1fMPD2dzmPQ&ab_channel=MohamedChiny)
                                //Nombre d'entrée dans la base de donnée
                                $getCountSQL = "SELECT count(debut) as count FROM reservation WHERE statut='En attente de confirmation';";
                                $getCount = $db->prepare($getCountSQL);
                                $getCount->execute() or die($db->errorInfo());
                                $result=$getCount->fetchAll(PDO::FETCH_ASSOC);

                                if($result[0]["count"]==0){
                                    echo "<p id='notFound'>Il n'y a aucune demande de réservation pour le moment</p>";
                                }else{
                                    //Définition de la pagination
                                    if(array_key_exists("page",$_POST)){
                                        $page=$_POST["page"];
                                    }else{
                                        $page=1;
                                    }
                                    $nbItems = $result[0]["count"];
                                    $itemsPP=5;
                                    $nbPages=ceil($nbItems/$itemsPP);
                                    $init=($page-1)*$itemsPP;


                                    //Récupération des infos de réservation
                                    $getReservSql = "SELECT * FROM reservation WHERE statut='En attente de confirmation' ORDER BY debut DESC, statut ASC limit $init, $itemsPP";
                                    $getReserv = $db->prepare($getReservSql);
                                    $getReserv->execute() or die($db->errorInfo());
                                    $results=$getReserv->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($results as $value){
                                        $debut[]=$value["debut"];
                                        $fin[]=$value["fin"];
                                        $reference[]=$value["reference"];
                                        $mail[]=$value["mail"];
                                        $statut[]=$value["statut"];
                                        $numero[]=$value["numero"];
                                    }
                                    foreach($reference as $key=>$value){
                                        $getNameSql = "SELECT nom FROM article WHERE reference=:reference";
                                        $getName = $db->prepare($getNameSql);
                                        $sqlParameter=[
                                            "reference" => $value
                                        ];
                                        $getName->execute($sqlParameter) or die($db->errorInfo());
                                        $result=$getName->fetchAll(PDO::FETCH_ASSOC);
                                        $nom[]=$result[0]["nom"];
                                    }
                                    if(count($debut)==0){
                                        ?>
                                        <p class="notFound">Il n'y a aucune réservation traité pour le moment</p>
                                        <?php
                                    }else{
                                        ?>
                                            <section id="tabHead">
                                                <article id="nomHead">
                                                    <p>Nom du matériel</p>
                                                </article>
                                                <article id="referenceHead">
                                                    <p>Référence</p>
                                                </article>
                                                <article class="dateHead">
                                                    <p>Date de début</p>
                                                </article>
                                                <article class="dateHead">
                                                    <p>Date de fin</p>
                                                </article>
                                                <article id="numeroHead">
                                                    <p>N° réservation</p>
                                                </article>
                                                <article id="statutHead">
                                                    <p>Statut</p>
                                                </article>
                                            </section>
                                        <?php
                                        for($i=0; $i<count($debut); $i++){
                                            $recompD=explode("-", $debut[$i]);
                                            $debut[$i]=$recompD[2]."/".$recompD[1]."/".$recompD[0];
                                            $recompF=explode("-", $fin[$i]);
                                            $fin[$i]=$recompF[2]."/".$recompF[1]."/".$recompF[0];

                                            ?>
                                            <section class="reservationContainer">
                                                <section class="reservation">
                                                    <article id="nom">
                                                        <p><?php echo $nom[$i]; ?></p>
                                                    </article>
                                                    <article id="reference">
                                                        <p><?php echo $reference[$i]?></p>
                                                    </article>
                                                    <article class="date">
                                                        <p><?php echo $debut[$i]?></p>
                                                    </article>
                                                    <article class="date">
                                                        <p><?php echo $fin[$i]?></p>
                                                    </article>
                                                    <article id="numero">
                                                        <p><?php echo $numero[$i]?></p>
                                                    </article>
                                                    <article id="statut">
                                                        <p><?php echo $statut[$i]?></p>
                                                    </article>
                                                </section>
                                            <form action="détailsReserv" method="post">
                                                <input type="hidden" value="nonTraité" name="where">
                                                <input type="hidden" value="<?php echo $numero[$i]?>" name="numero">
                                                <input type="submit" class="details" value="Détails"/>
                                            </form>
                                        </section>
                                            <?php
                                        }
                                    //Affichage de la pagination
                                        echo '<section id="pagination">';
                                        for($i=1; $i<=$nbPages;$i++){
                                            echo '<form action="gestionReserv.php" method=post>';
                                                echo '<input name="cat" type="hidden" value="nonTraité">';
                                                echo '<input name="page" type="hidden" value="'.$i.'">';
                                                echo '<input class="pagiButton" type="submit" value="'.$i.'">';
                                            echo '</form>';
                                        }
                                        echo '</section>';
                                    }
                                }
                                echo '</section>';
                            }
                        }else{
                            ?>
                            <section id="content">
                                <form action="gestionReserv.php" method="post">
                                    <input type="hidden" value="traité" name="cat">
                                    <input type="submit" value="Traité" class="submitButton">
                                </form>
                                <form action="gestionReserv.php" method="post">
                                    <input type="hidden" value="nonTraité" name="cat">
                                    <input type="submit" value="Non traité" class="submitButton">
                                </form>
                            </section>
                            <?php 
                        }
                        ?>
                        <section id="prefooter">
                        </section>
                        <?php include "../includes/footer.php";?>
                        <script src="../scripts/header.js"></script>
                    </body>
                    </html>
                    <?php
        }else{
            header("location:../index.php");
            exit();
        }
    }else{
        header("location:../index.php");
        exit();
    }
?>