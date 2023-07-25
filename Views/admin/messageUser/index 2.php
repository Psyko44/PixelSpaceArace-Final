<main>
    <div class="mainAdminUser">

        <section class="messageUser">
            <h1>Gestion des Messages Client</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nom de l'expediteur</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date et heure d'envoi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message) : ?>

                <tbody>
                    <td><?= $message->name ?></td>
                    <td><?= $message->email ?></td>
                    <td> <?= $message->message ?></td>
                    <td><?= $message->created_at ?></td>
                    <td>
                        <form action="/messageUser/deleteMessage/<?= $message->id ?>" method="post">
                            <button name="submit" type="submit">Supprimer le message</button>
                        </form>
                    </td>


                <?php endforeach; ?>
                </tbody>
            </table>

        </section>
    </div>
</main>