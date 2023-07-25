<main class="user">
    <div class="mainAdminUser">
        <section class="userRoles">
            <?php if (isset($_SESSION['success_message'])) : ?>
                <div id="successMessage" class="taskDone"><?php echo $_SESSION['success_message']; ?></div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>
            <h1>Gestion des Utilisateurs</h1>
            <h2>Role Utilisateur</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user->getid(); ?></td>
                            <td><?= $user->getUsername(); ?></td>
                            <td><?= $user->getEmail(); ?></td>
                            <td><?= $user->getRoleId(); ?></td>
                            <td>
                                <form action="/user/changeRole" method="post">
                                    <input type="hidden" name="userId" value="<?= $user->getId(); ?>">
                                    <select name="newRole">
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                    <button type="submit" name="submit">Change Role</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h2>Suppression de compte </h2>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <form action="/user/updateUser" method="post">
                            <tr>
                                <td>
                                    <input type="text" name="username" value="<?= $user->getUsername(); ?>">
                                </td>
                                <td>
                                    <input type="email" name="email" value="<?= $user->getEmail(); ?>">
                                </td>
                                <td>
                        </form>
                        <form action="/user/delete" method="post">
                            <input type="hidden" name="id" value="<?= $user->getId(); ?>">
                            <button type="submit" name="submit">Delete</button>
                        </form>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <section class="userCreate">
            <h2>Création de Compte</h2>
            <form class="userCreateF" method="POST" action="/user/create">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
                <label for="role_id">Role:</label>
                <input type="text" id="role_id" name="role_id" required>
                <button type="submit" name="submit">Create User</button>
            </form>
        </section>