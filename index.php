<?php

// Ajout du code commun à toutes les pages du site
require_once 'include.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <title>UrbainPact</title>
</head>

<body>
    <header>
        <nav class="navbar bg-1 fg-2">
            <div class="container-fluid">
                <a class=" max-h-100" href="#"><img src="/images/logo_color_urbainpact.png" style="max-height: 100px;"></a>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active theme-primary btn-solid btn-styled" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn-outline theme-success" type="submit">Search</button>
                    </form>
            </div>
        </nav>
    </header>

    <main class="container">

    </main>
</body>

</html>