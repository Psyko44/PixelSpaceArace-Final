<main class="base">
    <div class="mainTop">

        <div class="titleProfil"><img class="picProfil" src="/ressources/svg/panier.svg" alt=""></div>
        <form action="/cart" method="POST">
            <section>
                <div class="cart">
                    <?php
                    $Total = 0;
                    if (isset($cartItems) && is_array($cartItems)) {
                        foreach ($cartItems as $item) :
                            $Total += $item['quantity'] * $item['price'];
                    ?>
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="/uploads/<?= $item['picture'] ?>" alt="Product Image">
                                </div>
                                <div class="cart-item-details">
                                    <h2 class="product-name"><?= isset($item['name']) ? $item['name'] : '' ?></h2>
                                    <p class="product-price"><?= isset($item['price']) ? $item['price'] : '0' ?> €</p>
                                    <label for="quantity">Quantité</label>
                                    <input type="number" id="quantity" name="quantity" min="1" value="<?= $item['quantity'] ?>" required>
                                    <p class="product-total"><?= $item['price'] * $item['quantity'] ?> €</p>
                                </div>
                                <div class="cart-item-actions">
                                    <a href="/cart/remove/<?= $item['id'] ?>"><button type="button" class="remove-item">Supprimer</button></a>
                                </div>
                            </div>
                    <?php endforeach;
                    } else {
                        echo "<p> Votre panier est vide .</p>";
                    } ?>
                </div>
                <div class="cart-summary">
                    <h2>Total: <span class="total"> <?= $Total ?> €</span></h2>
                    <button name="submit" type="submit" class="checkout">Commander</button>
                </div>
            </section>
        </form>
</main>