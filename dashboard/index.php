<?php
session_start();
require "../db.php";

include "../helpers/path.php";
include "../middleware/isGuest.php";

$username = "";

if (isset($_SESSION['is_login'])) {
  $username = $_SESSION['username'];
}

if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("location: $basePath/auth/login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Dashboard Template · Bootstrap v5.0</title>

  <?php include "../layout/link.html" ?>

  <link rel="stylesheet" href="./css/dashboard.css">
  <script src="./dashboard.js"></script>

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
</head>

<body>

  <!-- header layouts -->
  <?php include "./layouts/header.php" ?>

  <div class="container-fluid">
    <div class="row">

      <!-- sidebar layouts -->
      <?php include "./layouts/sidebar.php" ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>

        <div class="container">
          <h3>Welcome Back, <?php echo $username ?></h3>
        </div>
    </div>
    </main>
  </div>
  </div>

  <?php include "../layout/link2.html" ?>
  <script src="./js/dashboard.js"></script>
</body>

</html>