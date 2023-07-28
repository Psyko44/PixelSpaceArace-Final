<?php if (isset($_SESSION["user"]) && $_SESSION["user"] !== null) : ?>
    <main class="signInForm">
        <div class="userPic">
            <img class="userPicture" src="/ressources/svg/moncompte.svg" alt="">
        </div>
        <div class="navUseraccount">
            <h2 class="helloUser">Bienvenue, <?php echo $_SESSION["user"]["username"];
                                                ?> </h2>
            <ul>
                <li><a href="#mInfo">- Modifier vos information -</a></li>
                <li><a href="#mHist">- Historique de vos commandes -</a></li>
            </ul>
        </div>
        <section class="uploadInfo">
            <h1 id="mInfo">Modifier vos informations</h1>
            <form class="sign-inF" method="POST" action="/useraccount/update">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <label><b>Email</b></label>
                <input type="email" placeholder="Entrer l'email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <label><b>Ancien Mot de passe</b></label>
                <input type="password" placeholder="Entrer l'ancien mot de passe" name="old_pass" required>
                <label><b>Nouveau Mot de passe</b></label>
                <input type="password" placeholder="Entrer le nouveau mot de passe" name="pass">
                <label class="confirm"><b>Confirmer le nouveau mot de passe</b></label>
                <input type="password" placeholder="Confirmer le nouveau mot de passe" name="confirm_pass">
                <label for="tel">Numéro de téléphone</label>
                <input type="tel" id="tel" placeholder="Numéro de téléphone" name="tel" value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>">
                <button name="submit" class="btn" type="submit">Mettre à jour mes informations !!</button>
            </form>
        </section>
        <section class="hSec">
            <h1 id="mHist">Historique de vos commandes</h1>
            <table class="history">
                <thead>
                    <tr>
                        <th>Référence produit</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Date et heure d'achat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $orders = $orders ?? []; ?>
                    <?php $totalGeneral = 0; ?>
                    <?php foreach ($orders as $order) : ?>
                        <?php
                        $total = $order->order_quantity * $order->price; // Changed here
                        $totalGeneral += $total;
                        ?>
                        <tr>
                            <td><?= $order->id ?></td>
                            <td><?= $order->name ?></td>
                            <td><?= $order->order_quantity ?></td> <!-- Changed here -->
                            <td><?= $order->price ?> €</td>
                            <td><?php
                                $datetime = new \DateTime($order->created_at);
                                $datetime->setTimezone(new \DateTimeZone('Europe/Paris'));
                                echo $datetime->format('d-m-Y H:i:s');
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Montant total général :</strong></td>
                        <td><?= $totalGeneral ?> €</td>
                    </tr>
                </tfoot>
            </table>

        </section>
    </main>
<?php else : ?>
    <p>Vous n'êtes pas connecté.</p>
<?php endif; ?>