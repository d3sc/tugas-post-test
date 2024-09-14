<?php
include "../helpers/path.php";

// checking is guest
if (empty($_SESSION["is_login"])) {
    header("location: $basePath/auth/login.php");
}
