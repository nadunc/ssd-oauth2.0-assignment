<?php
session_start();

include 'OAuth.php';

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>OAuth 2.0 Example with Facebook</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">WGSAY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <span class="navbar-text text-white">
                        <img src='https://graph.facebook.com/<?php echo $_SESSION['user_id']; ?>/picture?width=25&height=25' class='rounded mr-1'>
                      <?php echo $_SESSION['name']; ?>
                    </span>
                    <li class="nav-item my-auto ml-5">
                        <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">

    <h1 class="text-center mt-5">What Google Suggests About You</h1>
    <div class="text-center mt-5">

        <?php

        if (!isset($_SESSION['user_id'])) {
            $oauth = new OAuth();
            echo "<h4>Connect with Facebook to continue.</h4><br>";
            echo "<a href='" . $oauth->getAuthorizationEndpointURI() . "'>
                    <img src='login_btn.png' alt='Login with Facebook' class='img-fluid'>
                    </a>";
        } else {
            echo "<img src='getsearchimg.php?name=" . $_SESSION['name'] . "' class='img-fluid' alt='Search Suggestions Image'>";
        }
        ?>

    </div>
</div><!--container-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>