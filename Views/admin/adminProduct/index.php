<?php if (isset($_SESSION['success_message'])) : ?>
    <div id="successMessage" class="taskDone"><?php echo $_SESSION['success_message']; ?></div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<div class="container-fluid d-flex flex-column">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des produits</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="d-flex flex-column">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 id="updateG" class="m-0 font-weight-bold text-primary">Modification & Suprresion de Jeux</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
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
                                    <td class="w-25"><?= $game->description ?></td>
                                    <td class="w-10"><?= $game->price ?> €</td>
                                    <td>
                                        <form class="userCreateF d-flex flex-column align-items-center m-auto text-center " method="post" action="/adminProduct/updateGame/<?= $game->id ?>" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name<?= $game->id ?>">Nom :</label>
                                                    <input type="text" name="name" class="form-control " id="name<?= $game->id ?>" value="<?= $game->name ?>" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="description<?= $game->id ?>">Description :</label>
                                                    <textarea class="description form-control" name="description" rows="10" cols="100" id="description<?= $game->id ?>" required><?= $game->description ?></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="price<?= $game->id ?>">Prix :</label>
                                                    <input type="number" class="form-control  " name="price" id="price<?= $game->id ?>" value="<?= $game->price ?>" required>
                                                </div>
                                                <div class="">
                                                    <div class="form-group col-md-6">
                                                        <button class="" name="submit" type="submit">Modifier le jeu</button>
                                                    </div>
                                                </div>
                                        </form>
                                        <form action="/adminProduct/deleteGame/<?= $game->id ?>" method="post">
                                            <button name="submit" type="submit">Supprimer le jeu</button>
                                        </form>
                </div>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            <h2 id="createG">Create New Game</h2>
            <form class="userCreateF  w-90 d-flex flex-column align-items-center m-auto" method="post" action="/adminProduct/createGame/" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="description">Description :</label>
                        <textarea type="text" class="form-control" id="inputDescription" name="description" placeholder="Description"> </textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="number">Prix :</label>
                        <input name="price" type="numer" class="form-control" id="inputPrice" placeholder="Prix">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="etat">Etat</label>
                        <input name="etat" type="text" class="form-control" id="inputEtat" placeholder="Etat">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pegi">Pegi</label>
                        <input name="pegi" type="text" class="form-control" id="inputPegi" placeholder="Pegi">
                    </div>
                    <div class="form-group col-md-4 ">
                        <label for="picture">Image</label>
                        <input name="fileUpload" type="file" class="form-control p-3 pb-5" id="inputPicture" placeholder="Image">
                    </div>
                    <div class="">
                        <button name="submit" type="submit" class="mt-5 mb-5 btn-primary">Create new
                            game</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- /.container-fluid -->
    </div>
</div>
</div>
<div class="updateConsole">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 id="updateC" class="m-0 font-weight-bold text-primary">Modification & Suprresion de Consoles
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="3">
                    <thead>
                        <tr>
                            <th>Nom de la console</th>
                            <th class="w-50">Description</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consoles as $console) : ?>
                            <tr>
                                <td class="nameF">
                                    <?= $console->name ?>
                                </td>
                                <td>
                                    <?= $console->description ?>
                                </td>
                                <td>
                                    <?= $console->price ?>
                                </td>
                                <td>
                                    <form class="userCreateF d-flex flex-column align-items-center m-auto" method="post" action="/adminProduct/updateConsole/<?= $console->id ?>" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name<?= $console->id ?>">Nom :</label>
                                                <input type="text" name="name" class="form-control" id="name<?= $console->id ?>" value="<?= $console->name ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="description<?= $console->id ?>">Description
                                                    :</label>
                                                <textarea class="description form-control" name="description" rows="5" cols="30" id="description<?= $console->id ?>" required><?= $console->description ?></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="price<?= $console->id ?>">Prix :</label>
                                                <input type="number" class="form-control" name="price" id="price<?= $console->id ?>" value="<?= $console->price ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <button name="submit" type="submit">Modifier le jeu</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="/adminProduct/deleteConsole/<?= $console->id ?>" method="post">
                                        <button name="submit" type="submit">Supprimer le jeu</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <h2 id="createC">Create New Console</h2>
            <form class="userCreateF d-flex flex-column align-items-center m-auto" method="post" action="/adminProduct/createConsole/" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Description :</label>
                        <textarea type="text" class="form-control" id="inputDescription" name="description" placeholder="Description"> </textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number">Prix :</label>
                        <input name="price" type="number" class="form-control" id="inputPrice" placeholder="Prix">
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="picture">Image</label>
                        <input name="fileUpload" type="file" class="form-control p-3 pb-5" id="inputPicture" placeholder="Image">
                    </div>
                    <div class="">
                        <button name="submit" type="submit" class="mt-5 mb-5 btn-primary">Create new
                            Console</button>
                    </div>
                </div>
        </div>
    </div>
    </form>