<main>
    <div class="mainAdminUser">
        <section class="messageUser">
            <div class="container-fluid d-flex flex-column">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestion des messages users</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <!-- Content Row -->
                <div class="d-flex flex-column">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gestion des messages users</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                        <td>
                                            <?= $message->name ?>
                                        </td>
                                        <td>
                                            <?= $message->email ?>
                                        </td>
                                        <td>
                                            <?= $message->message ?>
                                        </td>
                                        <td>
                                            <?= $message->created_at ?>
                                        </td>
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