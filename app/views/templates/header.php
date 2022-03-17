<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= BASEULR ?>/css/bootstrap.min.css">
    <!-- MDB -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" /> -->

    <title>POINT OF SALE</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-md-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEULR ?>/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEULR ?>/product">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEULR; ?>/pos">POS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEULR; ?>/transactions">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEULR; ?>/chart">Chart Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEULR; ?>/auth/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>