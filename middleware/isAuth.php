<?php
include "../helpers/path.php";

// checking is auth
if (isset($_SESSION["is_login"])) {
    header("location: $basePath/dashboard/");
}
