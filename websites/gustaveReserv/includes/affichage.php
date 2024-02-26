<?php
$nom = array();
$type = array();
$reference = array();
$description = array();
foreach($results as $value){
    $nom[] = $value["nom"];
    $type[] = $value["type"];
    $reference[] = $value["reference"];
    $description[] = $value["description"];
}

//Affichage des produits
for($i=0; $i<count($nom);$i++){
    echo '<section class="itemContainer">';
        echo '<article class="item">';
            echo '<img src="../ressources/materiel/'.$nom[$i].'.jpg" class="img" alt="'.$nom[$i].'" title="'.$nom[$i].'"/>';
            echo '<p class="itemName">'.$nom[$i].'</p>';
        echo '</article>';
        echo '<article class="itemInfo">';
            echo '<p>Type: '.$type[$i].'</p>';
            echo '<p>Réference: '.$reference[$i].'</p>';
        echo '</article>';
        echo '<article class="itemDescription">';
            echo '<p>'.$description[$i].'</p>';
            echo '<div class="itemInteract">';
                echo '<form class="itemInteraction itemReserv" action="reservation.php" method="post">';
                    echo '<input type="hidden" value="'.$reference[$i].'" name="referenceInit">';
                    echo '<input type="hidden" value="'.$nom[$i].'" name="item">';
                    echo '<input type="submit" value="Réserver">';
                echo'</form>';
                if($_SESSION["role"]=="admin"){
                    echo '<form class="itemInteraction" action="modifMateriel.php" method="post">';
                        echo '<input type="hidden" value="'.$reference[$i].'" name="referenceInit">';
                        echo '<input type="submit" value="Modifier">';
                    echo'</form>';
                }
            echo '</div>';
        echo '</article>';
    echo '</section>';
}
?>