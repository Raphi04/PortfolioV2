<?php
function generateFooter(){
    global $page;
    if($page=="Accueil"){
        ?>
        <footer>
            <section>
                <section class="footContent">
                    <h2>À propos</h2>
                    <a href="pages/aPropos.php"><p>XSpace</p></a>
                    <a href="pages/actualite.php"><p>News</p></a> 
                </section>
            </section>

            <section>
                <section class="footContent">
                    <h2>Contact</h2>
                    <p>4 Silver West California 90250</p>
                    <p>+18 42 17 70 13 69 </p>
                    <p>contact@xspace.com</p>
                    <a href="pages/contact.php"><p>Support</p></a>
                </section>
            </section>

            <section>
                <section class="footContent">
                    <h2>Nous suivre</h2>
                    <article>
                        <a href=""><img src="ressources/youtubeBlanc.png" alt="Youtube" title="Youtube"></a>
                        <a href=""><img class="footSocial" src="ressources/twitterBlanc" alt="Twitter" title="Twitter"></a>
                        <a href=""><img class="footSocial" src="ressources/instagramBlanc" alt="Instagram" title="Instagram"></a>
                    </article>
                </section>
            </section>
        </footer>
    <?php
    }else{
        ?>
        <footer>
            <section>
                <section class="footContent">
                    <h2>A propos</h2>
                    <a href="aPropos.php"><p>XSpace</p></a>
                    <a href="actualite.php"><p>News</p></a> 
                </section>
            </section>

            <section>
                <section class="footContent">
                    <h2>Contact</h2>
                    <p>4 Silver West California 90250</p>
                    <p>+18 42 17 70 13 69 </p>
                    <p>contact@xspace.com</p>
                    <a href="contact.php"><p>Support</p></a>
                </section>
            </section>

            <section>
                <section class="footContent">
                    <h2>Nous suivre</h2>
                    <article>
                        <a href=""><img src="../ressources/youtubeBlanc.png" alt="Youtube" title="Youtube"></a>
                        <a href=""><img class="footSocial" src="../ressources/twitterBlanc" alt="Twitter" title="Twitter"></a>
                        <a href=""><img class="footSocial" src="../ressources/instagramBlanc" alt="Instagram" title="Instagram"></a>
                    </article>
                </section>
            </section>
        </footer>
        <?php
    }
}
?>