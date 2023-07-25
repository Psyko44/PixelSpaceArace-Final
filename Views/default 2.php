<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/normalize.css">
    <link rel="stylesheet" href="/style.css">
    <link id="theme-link" rel="stylesheet" href="/light-theme.css">
    <link rel="shortcut icon" type="image/ico" href="/ressources/favicon.ico" />
    <title>Poste de Controle</title>
</head>

<body id="blight">
    <header>
        <div class="nav">
            <div class="logoLigh">
                <a href="/main"><img src="/ressources/svg/logo.svg" alt=""></a>
                <div class="light"><i id="themeIcon" class=" fa-solid fa-toggle-off"></i>Light Mode On </div>
            </div>


            <nav>
                <ul>


                    <?php if (isset($_SESSION["user"])) : ?>
                        <li><a class="menue" href="/deconnexion"><i class="fa-solid fa-circle-xmark" style="color: #ffffff;"></i> Deconnexion</a></li>
                    <?php else : ?>
                        <li><a class="menue" href="/login"> <i class="fa-solid fa-user" style="color: #ffffff;"></i> Connexion</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION["user"])) : ?>
                        <li><a class="menue" href="/cart"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i> Panier</a></li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION["user"])) : ?>

                        <li><a class="menue" href="/useraccount"> <i class="fa-solid fa-user" style="color: #ffffff;"></i> Mon Compte</a></li>

                    <?php else : ?>
                        <li><a class="menue" href="/main"><i class="fa-brands fa-space-awesome" style="color: #ffffff;"></i> Poste de Controle</a></li>
                    <?php endif; ?>
                    <li><a class="menue" href="/retrospace"><i class="fa-solid fa-gamepad" style="color: #ffffff;"></i> Rayon Retro</a></li>
                    <li><a class="menue" href="/soscontact"><i class="fa-solid fa-star-of-life" style="color: #ffffff;"></i> Sos Contact</a></li>


                </ul>
            </nav>
        </div>
    </header>
    <?= $content ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/script.js"></script>
</body>
<footer>
    <div class="subscribe">
        <p>Abonnez vous pour avoir accès à toutes les nouveautées </p>
        <form method="get"><input type="email" name="email" id="email" placeholder="Email"><button class="btn" type="submit">Rejoignez la force !</button></form>
    </div>
    <div class="logoFooter">
        <img src="/ressources/svg/logo.svg" alt="">
        <a href="/condition">Condition général de vente</a>
        <a href="/mention">Mention légale</a>
    </div>
    <div class="socialIcone">
        <div class="social">
            <p>Retrouvez nous sur les réseaux </p>
            <p>Competition,
                Actu,
                Likes</p>
        </div>
        <div class="icones"><i class="fa-brands fa-facebook" style="color: #ffffff;"></i><i class="fa-brands fa-twitch" style="color: #ffffff;"></i><i class="fa-brands fa-reddit" style="color: #ffffff;"></i><i class="fa-brands fa-discord" style="color: #ffffff;"></i></div>
    </div>
</footer>

</html>