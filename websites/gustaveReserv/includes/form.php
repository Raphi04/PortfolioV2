<?php
$errors=array();
$conflit=0;
$success=0;
function null(){
    global $errors;
    foreach($_POST as $key=>$value){
        if(empty($value)){
            $errors[]=$key;
        }
    }
}


function reservCheck($when){
    global $errors;
    if(array_key_exists($when,$_POST)){
        null();
        if(in_array($when, $errors)){
            echo '<p class="red errors">*Veuillez remplir ce champ</p>';
            $errors[]=$when;
        }else{
            if (filter_var($_POST[$when],FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9\/]/")))){
                $date = $_POST[$when];
                $date= explode("/",$date);
                if (count($date)!==3 or empty($date[0]) or empty($date[1]) or empty($date[2]) or !checkdate($date["1"], $date["0"], $date["2"])){
                    echo '<p class="red errors">*Veuillez écrire une date valide</p>';
                    $errors[]=$when;
                }
            }else{
                echo '<p class="red errors">*Veuillez écrire une date valide</p>';
                $errors[]=$when;
            }
        }
    }
}


function valueBack($variable){
    if(array_key_exists("startDate",$_POST)){
        echo $_POST[$variable];
    }
}   


function ReservForm(){
        ?>
        <form action="reservation.php" method="post">
            <p id="title">Demande de réservation</p>
            <section id="materielInfo">
                <label for="materiel">Matériel</label>
                <input id="materiel" name="nomReserv" type="text" value="<?php echo $_POST["item"];?>" disabled/>
            </section>
            <section id="materielReservation">
                <section class="reservPeriod">
                    <p class="titleDate">Date de début<span class="red">*</span></p>
                    <article class="date">
                        <label for="startDate">Du</label>
                        <input id="startDate" type="text" name="startDate" placeholder="jj/mm/aaaa" value="<?php valueBack("startDate");?>"/>
                    </article>
                    <?php reservCheck("startDate"); logicalCheck();?>
                </section>
                <section class="reservPeriod">
                    <p class="titleDate">Date de fin<span class="red">*</span></p>
                    <article class="date">
                        <label for="endDate">au</label>
                        <input id="endDate" type="text" name="endDate" placeholder="jj/mm/aaaa" value="<?php valueBack("endDate");?>"/>
                    </article>
                    <?php reservCheck("endDate");?>
                </section>
            </section>
            <input name="referenceInit" type="hidden" value="<?php echo $_POST["referenceInit"];?>"/>
            <input name="item" type="hidden" value="<?php echo $_POST["item"];?>"/>
            <section id="formButtons">
                <a href="materiel.php"><p id="back">Retour à la liste de matériel</p></a>
                <input class="button" type="submit" value="Réserver"/>
            </section>
        </form>
        <?php
    }
?>
<?php 

function logicalCheck(){
    global $errors;
    if(!count($errors)>0 and array_key_exists("startDate", $_POST)){
        $debut = explode("/",$_POST["startDate"]);
        $debut = $debut[2]."-".$debut[1]."-".$debut[0];
        $fin = explode("/",$_POST["endDate"]);
        $fin = $fin[2]."-".$fin[1]."-".$fin[0];
        if($debut>$fin){
            echo '<p class="red errors">*Les dates ne sont pas cohérentes</p>';
            $errors[]="startDate";
        }
    }
}


function détailsReservForm(){
    include "../includes/dataBase.php";
    //Récupération des infos de réservation
    $getReservInfoSql = "SELECT debut, fin, reference, mail FROM reservation WHERE numero=:numero";
    $getReservInfo = $db->prepare($getReservInfoSql);
    $sqlParameter=[
        "numero" => $_POST["numero"]
    ];
    $getReservInfo->execute($sqlParameter) or die($db->errorInfo());
    $results = $getReservInfo->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $value){
        $debut=$value["debut"];
        $fin=$value["fin"];
        $reference=$value["reference"];
        $mail=$value["mail"];
    }
    $explode = explode("-",$debut);
    $debutText = $explode[2]."/".$explode[1]."/".$explode[0];
    $explode = explode("-",$fin);
    $finText = $explode[2]."/".$explode[1]."/".$explode[0];

    //Récupération des infos de l'utilisateur
    $getUserInfoSql = "SELECT nom, prenom FROM user WHERE mail=:mail";
    $getUserInfo = $db->prepare($getUserInfoSql);
    $sqlParameter=[
        "mail" => $mail
    ];
    $getUserInfo->execute($sqlParameter) or die($db->errorInfo());
    $results = $getUserInfo->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $value){
        $nom=$value["nom"];
        $prenom=$value["prenom"];
    }
    //Récupération du nom du produit
    $getItemNameSql = "SELECT nom,type FROM article WHERE reference=:reference";
    $getItemName = $db->prepare($getItemNameSql);
    $sqlParameter = [
        "reference" => $reference
    ];
    $getItemName->execute($sqlParameter) or die($db->errorInfo());
    $results=$getItemName->fetchAll(PDO::FETCH_ASSOC);
    $itemName=$results[0]["nom"];
    $type=$results[0]["type"];

    ?>
    <?php 
    global $error;
    if($error>0){
        ?>
        <section id="conflit">
            <p>Il existe déjà une réservation pour ces dates</p>
        </section>
        <?php
    }
    ?>
    <section id="info">
        <section id="up">
            <section id="generalInfo">
                <article id="userInfo">
                    <p class="userName"><span class="blue">Nom : </span> <?php echo $nom;?></p>
                    <p class="userName"><span class="blue">Prénom : </span><?php echo $prenom;?></p>
                </article>
                <article id="userMail">
                    <p><span class="blue">E-mail : </span><?php echo $mail;?></p>
                </article>
            </section>
            <section id="itemImage">
                <img src="../ressources/materiel/<?php echo $itemName ?>.jpg" alt="<?php echo $itemName?>" title="<?php echo $itemName?>" id="item">
            </section>
        </section>
        <section id="down">
            <section id="dateContainer">
                <article id="reservDate">
                    <p class="date"><span class="blue">Début : </span><?php echo $debutText;?></p>
                    <p class="date"><span class="blue">Fin : </span><?php echo $finText;?></p>
                </article>
            </section>
            <section id="itemInfo">
                <article id="itemName">
                    <p><span class="blue">Nom : </span><?php echo $itemName;?></p>
                </article>
                <article id="itemCara">
                    <p class="cara"><span class="blue">Type : </span><?php echo $type;?></p>
                    <p class="cara"><span class="blue">Référence : </span><?php echo $reference;?></p>
                </article>
            </section>
        </section>
        <?php
        if($_SESSION["role"]=="admin" and $_POST["where"]=="nonTraité"){?>
            <section id="traitement">
                <article id="formContainer">
                    <form action="détailsReserv.php" method="post">
                        <input type="hidden" value="<?php echo $_POST["where"]?>" name="where">
                        <input type="hidden" value="<?php echo $_POST["numero"]?>" name="numero">
                        <input type="hidden" value="<?php echo $reference?>" name="reference">
                        <input type="hidden" value="<?php echo $debut?>" name="debut">
                        <input type="hidden" value="<?php echo $fin?>" name="fin">
                        <input type="hidden" value="Accepter" name="traitement">
                        <input type="submit" value="Accepter" class="traitButton" id="accepted">
                    </form>
                    <form action="détailsReserv.php" method="post">
                        <input type="hidden" value="<?php echo $_POST["where"]?>" name="where">
                        <input type="hidden" value="<?php echo $_POST["numero"]?>" name="numero">
                        <input type="hidden" value="<?php echo $reference?>" name="reference">
                        <input type="hidden" value="Refuser" name="traitement">
                        <input type="submit" value="Refuser" class="traitButton" id="refused">
                    </form>
                </article>
            </section>
            <?php
        }elseif($_POST["where"]=="mesReserv"){?>
            <section id="traitement">
                <form action="détailsReserv.php" method="post">
                    <input type="hidden" value="<?php echo $_POST["where"]?>" name="where">
                    <input type="hidden" value="<?php echo $_POST["numero"]?>" name="numero">
                    <input type="hidden" value="Annuler" name="traitement">
                    <input type="submit" value="Annuler" class="traitButton" id="refused">
                </form>
            </section>
           <?php
        }
    echo "</section>";  
}
?>
