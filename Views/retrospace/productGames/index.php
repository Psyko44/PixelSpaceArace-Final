<main class="productShop">

    <h1> <?= $Games->name; ?></h1>
    <img src="/uploads/<?= $Games->picture ?>" alt="<?= $Games->name ?>">
    <p><?= $Games->created_at ?></p>
    <div class="priceShipping">
        <?php if (isset($_SESSION["user"])) : ?>
            <div class="price"><?= $Games->price ?> €</div>
        <?php else : ?>
            <a class="menue read" href="/login"> <i class="fa-solid fa-user" style="color: #ffffff;"></i> Veuillez vous connecter pour voir les prix</a>
        <?php endif; ?>
        <div class="pegi">
            <p>PEGI <?= $Games->pegi ?></p>
            <p></p>
        </div>
        <div class="etat">
            <p><?= $Games->etat ?></p>
        </div>
        <div class="ship">
            <p>Envoi en 7 jours EU / Delai allongé hors EU</p>
        </div>
        <div class="priceShip">
            <p>Frais de port</p>
            <p> <?= $Games->shipping ?> €</p>
        </div>
        <!-- IF THE USER IS CONNECT BUTTON CART VISIBLE IF ITS NOT CONNEXION BUTTON VISIBLE  -->
        <?php if (isset($_SESSION["user"])) : ?>
            <form action="/productGames/addToCartById/<?= $Games->id ?>" class="shopNow" method="post">
                <button class="addToCartButton" data-id="<?= $Games->id ?>" type="submit">Ajouter au panier</button>

            <?php else : ?>
                <a class="menue read" href="/login"> <i class="fa-solid fa-user" style="color: #ffffff;"></i> Veuillez vous connecter pour ajoutez un article</a>
            <?php endif; ?>
    </div>
    <div class="descriptions">
        ​
        <p><?= $Games->description ?></p>
    </div>
</main>