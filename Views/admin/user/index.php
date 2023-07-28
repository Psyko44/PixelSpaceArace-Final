<?php if (isset($_SESSION['success_message'])) : ?>
    <div id="successMessage" class="taskDone"><?php echo $_SESSION['success_message']; ?></div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<main>
    <div class="container-fluid d-flex flex-column">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gestion d'utilisateur</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="listUsers">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>

                                    <tr>
                                        <td>
                                            <?= $user->getid(); ?>
                                        </td>
                                        <td>
                                            <?= $user->getUsername(); ?>
                                        </td>
                                        <td>
                                            <?= $user->getEmail(); ?>
                                        </td>
                                        <td>
                                            <?= $user->getPhone(); ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="d-flex flex-column">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Role</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
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
                                        <td>
                                            <?= $user->getid(); ?>
                                        </td>
                                        <td>
                                            <?= $user->getUsername(); ?>
                                        </td>
                                        <td>
                                            <?= $user->getEmail(); ?>
                                        </td>
                                        <td>
                                            <?= $user->getRoleId(); ?>
                                        </td>
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
                        <!-- /.container-fluid -->
                    </div>
                </div>
            </div>
            <div class="userDelete">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Delete User</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <form class="text-center" action="/user/updateUser" method="post">
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
                        </div>
                    </div>
                </div>
            </div>
            <h2>Création de Compte</h2>
            <form class="userCreateF d-flex flex-column align-items-center  mb-6" method="post" action="/user/create">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone</label>
                        <input name="phone" type="text" class="form-control" id="inputPhone" placeholder="Phone Number">
                    </div>
                    <div class="d-flex ">
                        <legend class="mt-5 col-md-8 pt-0">User Role</legend>
                        <div class="col-sm-10">
                            <div class="mt-5 form-check">
                                <input class="form-check-input" type="radio" name="role_id" id="gridRadios1" value="1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    1 Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role_id" id="gridRadios2" value="2">
                                <label class="form-check-label" for="gridRadios2">
                                    2 User
                                </label>
                            </div>
                            <div class="">
                                <button name="submit" type="submit" class="mt-5 mb-5 btn-primary">Create User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>
    </div>
</main>