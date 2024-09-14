<?php
session_start();
require "../db.php";

include "../helpers/path.php";
include "../middleware/isAuth.php";

$error = "";

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        var_dump("Login berhasil");
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["is_login"] = true;
        header("location: $basePath/dashboard/");
    } else {
        $error = "Username, Email or password is wrong!";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include "../layout/link.html" ?>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Login Form</h2>
                <div class="text-center mb-5 text-dark">Login Your Account </div>
                <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-5 rounded" method="post" action="login.php">

                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                width="200px" alt="profile">
                        </div>
                        <?php
                        if ($error) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error ?>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="Username" aria-describedby="emailHelp" name="username"
                                placeholder="Username or Email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-login px-5 mb-5 w-100" name="submit">Login</button>
                        </div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                            Registered? <a href="register.php" class="text-dark fw-bold"> Create an
                                Account</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
<?php include "../layout/link2.html" ?>

</html>