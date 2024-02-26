<?php
    function sayError($variable){
        if(empty($_POST[$variable])){
            echo '<p class="error">*Veuillez remplir ce champ</p>';
        }
    }
    function recup($variable){
        if(array_key_exists($variable, $_POST)){
            echo $_POST[$variable];
        }
    }
    function generateForm() {
            if(array_key_exists("nom", $_POST)){
                $error = 0;
                if(count($_POST)==3){
                    foreach($_POST as $value){
                        if(empty($value)){
                            $error++;
                        }
                    }
                }else{
                    $error=1;
                }
                if ($error>0){
                    ?>
                    <article id="formInput">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" value="<?php recup("nom");?>"/>
                        <?php sayError("nom"); ?>
                        
                        <label class="marginInput" for="email">E-mail</label>
                        <input type="text" name="email" id="email" value="<?php recup("email");?>"/>
                        <?php sayError("email"); ?>

                        <label class="marginInput" for="message">Message</label>
                        <input type="text" name="message" id="message" value="<?php recup("message");?>"/>
                        <?php sayError("message"); ?>
                    </article>
                    <?php
                }else{
                    ?>
                    <article id="formInput">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom"/>
                        
                        <label class="marginInput" for="email">E-mail</label>
                        <input type="text" name="email" id="email"/>

                        <label class="marginInput" for="message">Message</label>
                        <input type="text" name="message" id="message"/>
                        <p id="success">Votre message a bien été envoyé !</p>
                    </article>
                    <?php
                    unset($_POST);
                }
        }else{
            ?>
            <article id="formInput">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom"/>
                
                <label class="marginInput" for="email">E-mail</label>
                <input type="text" name="email" id="email"/>

                <label class="marginInput" for="message">Message</label>
                <input type="text" name="message" id="message"/>
            </article>
            <?php
        }
    }
?>