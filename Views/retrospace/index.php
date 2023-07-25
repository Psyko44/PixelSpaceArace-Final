<body>
    <main class="rayon">
        <div class="bgCapitaine"><img class="capi" src="/ressources/svg/capitaine.svg" alt="Capitaine-Flamme"></div>
        <div class="rayonTitle">
            <a href="/ControleBase.html"><img src="/ressources/svg/rayon-retro.svg" alt="Logo-Product"></a>
        </div>

        <section class="consoles">
            <h1 id="Consoles">Nos Consoles</h1>
            <div class="containerConsole">
                <?php foreach ($Consoles as $Console) : ?>
                    <article class="product">
                        <img class="productImage" src="/uploads/<?= $Console->picture ?>" alt="<?= $Console->name ?>">
                        <p>
                            <a href=" /product/product/<?= $Console->id ?>"><?= $Console->name ?></a>
                        </p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="videoGames">
            <h1 id="Games">Nos Jeux Video</h1>
            <div class="containerVideo">
                <?php foreach ($Games as $Game) : ?>
                    <article class="product">
                        <img class="productImage" src="/uploads/<?= $Game->picture ?>" alt="<?= $Game->name ?>">
                        <p><a href="/productGames/productGames/<?= $Game->id ?>"><?= $Game->name ?></a></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>