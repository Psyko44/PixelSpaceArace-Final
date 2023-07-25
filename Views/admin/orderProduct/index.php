<div class="d-flex flex-column">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Gestion des commandes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Numéro de commande</th>
                            <th>Id User</th>
                            <th>Username</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Date et heure d'achat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($orders as $order) : ?>
                            <tr>
                                <td>
                                    <?= $order['order_id'] ?>

                                </td>
                                <td>
                                    <?= $order['user_id'] ?>
                                </td>
                                <td>
                                    <?= $order['username'] ?>
                                </td>
                                <td>
                                    <?= $order['name'] ?>
                                </td>
                                <td>
                                    <?= $order['quantity'] ?>
                                </td>
                                <td>
                                    <?= $order['price'] ?>
                                </td>
                                <td>
                                    <?= $order['created_at'] ?>
                                </td>
                                <td>
                                    <form action="/orderProduct/deleteOrder/<?= $order['order_id'] ?>" method="post">
                                        <button name="submit" type="submit">Supprimer la
                                            commande</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>