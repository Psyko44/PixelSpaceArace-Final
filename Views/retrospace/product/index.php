<main class="productShop">
    <h1> <?= $Consoles->name ?></h1>
    <img src="/uploads/<?= $Consoles->picture ?>" alt="<?= $Consoles->name ?>">
    <p><?= $Consoles->created_at ?></p>
    <div class=" priceShipping">
        <?php if (isset($_SESSION["user"])) : ?>
            <div class="price"><?= $Consoles->price ?> €</div>
        <?php else : ?>
            <a class="menue read" href="/login"> <i class="fa-solid fa-user" style="color: #ffffff;"></i> Veuillez vous connecter pour voir les prix</a>
        <?php endif; ?>
        <div class="etat">
            <p><?= $Consoles->etat ?></p>
        </div>
        <div class="ship">
            <p>Envoi en 7 jours EU / Delai allongé hors EU</p>
        </div>
        <div class="priceShip">
            <p>Frais de port</p>
            <p> <?= $Consoles->shipping ?> €</p>
        </div>
        <!-- IF THE USER IS CONNECT BUTTON CART VISIBLE IF ITS NOT CONNEXION BUTTON VISIBLE  -->
        <?php if (isset($_SESSION["user"])) : ?>
            <form action="/product/addToCartById/<?= $Consoles->id ?>" class="shopNow" method="post">
                <button class="addToCartButton" data-id="<?= $Consoles->id ?>" type="submit">Ajouter au panier</button>
            <?php else : ?>
                <a class="menue read" href="/login"> <i class="fa-solid fa-user" style="color: #ffffff;"></i>Veuillez vous connecter pour ajoutez un article</a>
            <?php endif; ?>
            </form>
    </div>
    <div class="descriptions">
        ​
        <p><?= $Consoles->description ?></p>
    </div>
</main>