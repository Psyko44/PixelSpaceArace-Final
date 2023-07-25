<?php
// START A SESSION 
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
<main class="login">
    <div class="bg"><img class="goldo" src="/ressources/goldorak.png" alt=""></div>
    <div class="logPicture"><img src="/ressources/svg/connexion.svg" alt=""></div>
    <form method="post">
        <input type="email" name="email" id="email" required placeholder="Email">
        <input type="password" name="pass" id="pass" required placeholder="Mot de passe">
        <button class="btn" type="submit">Connexion</button>
    </form>
    <div class="lostpass">
        <p>Mot de passe Oublié</p>
        <div class="sign">
            <p class="signIn"><a href="/register/index">Inscription</a></p>
        </div>
    </div>
</main>