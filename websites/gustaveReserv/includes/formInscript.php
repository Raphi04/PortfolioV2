<form action="inscription.php" method="post">
    <fieldset id="formContent">
        <section id="formName">
            <article>
                <label for="firstname">Prénom<span>*</span></label>
                <input id="firstname" value="<?php success("firstname");?>" type="text" name="firstname"/>
                <?php firstnameCheck();?>
            </article>
            <article>
                <label for="name">Nom<span>*</span></label>
                <input id="name" value="<?php success("name");?>" type="text" name="name"/>
                <?php nameCheck();?>
            </article>
        </section>

        <section id="formMail">
            <label for="mail">Adresse e-mail<span>*</span></label>
            <input id="mail" value="<?php success("mail");?>" type="text" name="mail"/><?php mailCheck();?>
        </section>

        <section id="formDate">
            <label for="bornDate">Date de naissance<span>*</span></label>
            <input id="bornDate" value="<?php success("bornDate");?>" type="text" name="bornDate"/><?php bornDateCheck();?>
        </section>

        <section class="formPassword" id="formMdp">
            <label for="mdp">Mot de passe<span>*</span></label>
            <div class="eyes">
                <input id="mdp" value="<?php success("mdp");?>" type="password" name="mdp"/>
                <img onCLick="view('img1','mdp')" id="img1" src="../ressources/visible.png" alt="visible"/>
            </div>
            <?php mdpCheck("mdp");?>
        </section>

        <section class="formPassword">
            <label for="Cmdp">Confirmation du mot de passe<span>*</span></label>
            <div class="eyes">
                <input id="Cmdp" value="<?php success("Cmdp");?>" type="password" name="Cmdp"/>
                <img onCLick="view('img2','Cmdp')" id="img2" src="../ressources/visible.png" alt="visible"/>
            </div>
            <?php error("Cmdp");?>
        </section>
    </fieldset>
    <fieldset id="submitForm">
        <a href ="../index.php"><p id="connexion">Se connecter à un compte existant</p></a>
        <input id="submit" type="submit" value="S'inscrire"/>
    </fieldset>
</form> 
