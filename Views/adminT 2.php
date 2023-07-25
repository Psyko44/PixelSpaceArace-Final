<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/normalize.css">
    <link rel="stylesheet" href="/admin.css">
    <link rel="shortcut icon" type="image/ico" href="/ressources/favicon.ico" />
    <title>Administration</title>
</head>

<body>
    <main>
        <?php require_once($contentAdmin); ?>
        <div class="sidebarAdmin">
            <div>
                <div class="logoAdmin">
                    <img src="/ressources/svg/logo.svg" alt="">
                    <a class="decoAdmin" href="/deconnexion"><i class="fa-solid fa-circle-xmark" style="color: #ffffff;"></i>Deconnexion</a>
                </div>
                <div class="menuAdmin">
                    <a href="/user">Gérer les utilisateurs</a>
                    <select id="product_management" onchange="navigateTo(this)">
                        <option value="/adminProduct">Géstion des produits</option>
                        <option value="/adminProduct#updtG">Modification de jeux hhh</option>
                        <option value="/adminProduct#creaG">Création de jeux</option>
                        <option value="/adminProduct#updtC">Modification de consoles</option>
                        <option value="/adminProduct#creaC">Création de consoles</option>
                    </select>

                    <a href="/orderProduct">Gérer les commandes</a>
                    <a href="/messageUser">Gerer les messages des utilisateurs</a>
                    <a href="/adminProduct">Gestion</a>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/script.js"></script>
</body>


</html>