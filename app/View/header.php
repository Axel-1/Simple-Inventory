<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Simple Inventory</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav ps-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Logged in as <b>Axel</b></a>
        </li>
    </ul>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="btn btn-outline-danger" href="#">Sign out</a>
        </li>
    </ul>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= $this->activePage == "dashboard" ? "active" : "" ?>" aria-current="page"
                           href="?action=dashboard">
                            <i class="bi bi-house bi-sb me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->activePage == "productList" ? "active" : "" ?>"
                           href="?action=productList">
                            <i class="bi bi-laptop bi-sb me-1"></i>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->activePage == "siteList" ? "active" : "" ?>"
                           href="?action=siteList">
                            <i class="bi bi-geo-alt bi-sb me-1"></i>
                            Sites
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->activePage == "monitoringList" ? "active" : "" ?>"
                           href="?action=monitoringList">
                            <i class="bi bi-speedometer bi-sb me-1"></i>
                            Monitoring
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->activePage == "userList" ? "active" : "" ?>"
                           href="?action=userList">
                            <i class="bi bi-people bi-sb me-1"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->activePage == "settings" ? "active" : "" ?>"
                           href="?action=settings">
                            <i class="bi bi-gear bi-sb me-1"></i>
                            Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">