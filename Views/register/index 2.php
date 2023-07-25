<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["error"])) {
    foreach ($_SESSION["error"] as $message) {
        echo "<p>$message</p>";
    }
    unset($_SESSION["error"]);
}
?>
<main class="signInForm">
    <div class="bgAlbator"><img src="/ressources/svg/albator.svg" alt=""></div>
    <div class="signPicture">
        <img class="signinPicture" src="/ressources/svg/inscription.svg" alt="">
    </div>
    <form class="sign-inF" method="POST" action=" /register/index">
        <label><b>Nom d'utilisateur</b></label>
        <input type=" text" placeholder="Entrer le nom d'utilisateur" name="username" required>
        <label><b>Email</b></label>
        <input type="email" placeholder="Entrer l'email" name="email" required>
        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="pass" required>
        <label class="confirm"><b>Confirmer le mot de passe</b></label>
        <input type="password" placeholder="Confirmer le mot de passe" name="confirm_pass" required>
        <label for="tel">Numéro de téléphone</label>
        <input type="tel" id="tel" placeholder="Numéro de téléphone" name="tel">
        <button class="btn" type="submit">Que le voyage commence !!</button>
    </form>
</main>