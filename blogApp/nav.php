<?php
    session_start();
    // echo $_SESSION['user'] ?? 'Not logged in';
    // print_r($_SESSION);
    $id = $_SESSION['user'] ?? null;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <style>
        .blog-card {
            min-height: 40dvh;
        }
    </style>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">MyBlog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/phpclass/blogApp/index.php">Home</a>
                        </li>
                        <?php if($id){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/phpclass/blogApp/create_blog.php">Create Blog</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="/phpclass/blogApp/<?php echo $id ? 'logout.php': 'login.php'  ?> " class="btn btn-primary"> <?php echo $id ? 'Logout' : 'Login' ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>