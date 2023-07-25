<?php error_reporting(E_ALL);
ini_set('display_errors', 1); ?>

<div class="mainAdminProduct">
    <section>
        <?php if (isset($_SESSION['success_message'])) : ?>
            <div id="successMessage" class="taskDone"><?php echo $_SESSION['success_message']; ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <h1>Gestion des Produits</h1>
        <h2 id="updtG">Modification des jeux</h2>
        <table class="gameT">
            <thead>
                <tr>
                    <th>Nom du jeu</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $game) : ?>
                    <tr>
                        <td class="nameF"><?= $game->name ?></td>
                        <td><?= $game->description ?></td>
                        <td><?= $game->price ?></td>
                        <td>
                            <form action="/adminProduct/updateGame/<?= $game->id ?>" method="post">
                                <label for="name<?= $game->id ?>">Nom :</label>
                                <input type="text" name="name" id="name<?= $game->id ?>" value="<?= $game->name ?>" required>
                                <label for="description<?= $game->id ?>">Description :</label>
                                <textarea class="description" name="description" id="description<?= $game->id ?>" required><?= $game->description ?></textarea>
                                <label for="price<?= $game->id ?>">Prix :</label>
                                <input type="number" name="price" id="price<?= $game->id ?>" value="<?= $game->price ?>" required>
                                <button name="submit" type="submit">Modifier le jeu</button>
                            </form>
                            <form action="/adminProduct/deleteGame/<?= $game->id ?>" method="post">
                                <button name="submit" type="submit">Supprimer le jeu</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form id="creaG" action="/adminProduct/createGame/" method="post" enctype="multipart/form-data">
            <h3>Création de Jeux</h3>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" required>
            <label for="description">Description :</label>
            <textarea name="description" id="description" required></textarea>
            <label for="price">Prix :</label>
            <input type="number" name="price" id="price" required>
            <label for="etat">Etat</label>
            <input type="text" name="etat" id="etat">
            <label for="pegi">Pegi</label>
            <input type="number" name="pegi" id="pegi" required>
            <label for="picture">Image produit</label>
            <input type="file" name="fileUpload" id="fileUpload" required>
            <button name="submit" type="submit">Ajouter le jeu</button>
        </form>
    </section>
    <section>
        <h2 id="updtC">Modification de Consoles</h2>
        <table class="consoleT">
            <thead>
                <tr>
                    <th>Nom de la console</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consoles as $console) : ?>
                    <tr>
                        <td class="nameF"><?= $console->name ?></td>
                        <td><?= $console->description ?></td>
                        <td><?= $console->price ?></td>
                        <td>
                            <form action="/adminProduct/updateConsole/<?= $console->id ?>" method="post">
                                <label for="name<?= $console->id ?>">Nom :</label>
                                <input type="text" name="name" id="name<?= $console->id ?>" value="<?= $console->name ?>" required>
                                <label for="description<?= $console->id ?>">Description :</label>
                                <textarea class="description" name="description" id="description<?= $console->id ?>" required><?= $console->description ?></textarea>
                                <label for="price<?= $console->id ?>">Prix :</label>
                                <input type="number" name="price" id="price<?= $console->id ?>" value="<?= $console->price ?>" required>
                                <button name="submit" type="submit">Modifier la console</button>
                            </form>
                            <form action="/adminProduct/deleteConsole/<?= $console->id ?>" method="post">
                                <button name="submit" type="submit">Supprimer la console</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Formulaire pour la création d'une nouvelle console -->
        <form id="creaC" action="/adminProduct/createConsole/" method="post" enctype="multipart/form-data">
            <h3>Création de Console</h3>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" required>
            <label for="description">Description :</label>
            <textarea name="description" id="description" required></textarea>
            <label for="price">Prix :</label>
            <input type="number" name="price" id="price" required>
            <label for="picture">Image produit</label>
            <input type="file" name="fileUpload" id="fileUpload" required>
            <button name="submit" type="submit">Ajouter la console</button>
        </form>
    </section>
</div>