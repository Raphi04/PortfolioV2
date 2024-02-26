<form action="index.php" method="post">
    <section id="formMail">
        <input id="mail" type="text" name="mail" placeholder="E-Mail"/>
    </section>

    <section id="formPassword">
        <div id="eyes">
            <input id="mdp" type="password" name="mdp" placeholder="Mot de passe"/>
            <img onCLick="view('img1','mdp')" id="img1" src="ressources/visible.png" alt="visible"/>
        </div>
        <?php Check();?>
    </section>
    <section id="formCheckbox">
        <input type="checkbox" name="Validation" value='QCB' id="checkbox">
        <label for='checkbox'>Se souvenir de moi</label>
    </section>
    <input id="submit" type="submit" value="Connexion"/>
 </form>
