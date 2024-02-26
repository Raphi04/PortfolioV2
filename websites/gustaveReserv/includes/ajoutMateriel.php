<form action="ajoutMateriel.php" method="post" enctype="multipart/form-data">
    <section id="itemPresentation">
        <label for="file">Seul les fichiers ".jpg" sont autorisés</label>
        <input id="file" type="file" name="file" accept=".jpg"/>
        <?php $_FILES["file"]["name"]=""; if(empty($_FILES["file"]["name"])){echo '<p class="error">*Veuillez mettre une image</p>';}?>
        <section id="itemNom">
            <article>
                <label for="nom">Nom : </label>
                <input id="nom" type="text" name="nom" value="<?php success('nom');?>" onKeyUp="autoCaps()"/>
            </article>
            <?php error1("nom") ?>
        </section>
        <article id="itemType">
            <label for="type">Type :</label>
            <select id="type" type="text" name="type">
            <?php select();?>
            </select>
        </article>
    </section>
    <section id="itemInfos">
        <p id="advice">Pour revenir à la ligne rajoutez une balise "br"</p>
        <textarea name="description"><?php success("description");?></textarea>
        <?php error1("description") ?>
        <input id="save" type="submit" value="Sauvegarder"/>
    </section>
</form>
