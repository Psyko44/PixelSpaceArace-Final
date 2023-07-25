<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SpacePixelArcade</title>
    <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/admin/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/user">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">SpacePixelArcade </div>
            </a>
            <div class="sidebar-heading">
                Lien
            </div>
            <li class="nav-item">
                <a class="nav-link" href="/user">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Gestion des utilisateurs</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Gestion de produit</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestion des Produits</h6>
                        <a class="collapse-item" href="/adminProduct#updateG">Modifier/supprimer Jeux</a>
                        <a class="collapse-item" href="/adminProduct#updateC">Modifier/supprimer Cons</a>
                        <a class="collapse-item" href="/adminProduct#createG">Crée Jeux</a>
                        <a class="collapse-item" href="/adminProduct#createC">Crée Consoles</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Tables -->
            <li class=" nav-item">
                <a class="nav-link" href="/orderProduct">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Gestion de commandes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/messageUser">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Gestion des messages</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <a href="/deconnexion">Deconnexion</a>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $userAdmin ?></span>
                                <img class="img-profile rounded-circle" src="/ressources/svg/logoOnly.png">
                            </a>
                            <!-- Dropdown - User Information -->
                        </li>
                    </ul>
                </nav>
                <?php require_once($contentAdmin); ?>
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
                <!-- Bootstrap core JavaScript-->
                <script src="/admin/vendor/jquery/jquery.min.js"></script>
                <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- Core plugin JavaScript-->
                <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
                <!-- Custom scripts for all pages-->
                <script src="/admin/sb-admin-2.min.js"></script>
                <!-- Page level plugins -->
                <script src="/admin/vendor/chart.js/Chart.min.js"></script>
                <!-- Page level custom scripts -->
                <script src="/admin/js/demo/chart-area-demo.js"></script>
                <script src="/script.js"></script>
</body>

</html>