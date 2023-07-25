<div class="mainAdminUser">

    <section class="messageUser">
        <h1>Gestion des Commandes clients</h1>
        <table>
            <thead>
                <tr>
                    <th>Numéro de commande</th>
                    <th>Id User</th>
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
                        <td><?= $order->id ?></td>
                        <td><?= $order->user_id ?></td>
                        <td><?= $order->name ?></td>
                        <td><?= $order->quantity ?></td>
                        <td><?= $order->price ?></td>
                        <td><?= $order->created_at ?></td>

                        <td>
                            <form action="/orderProduct/deleteOrder/<?= $order->id ?>" method="post">
                                <button name="submit" type="submit">Supprimer la commande</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </section>
</div>