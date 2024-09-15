<?php
session_start();
include "../db.php";
include "../helpers/path.php";
include "../middleware/isGuest.php";

$action = "";

if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

if ($action == "delete") {
    $output = array();
    $id = $_GET['id'];
    $sql = "DELETE from portofolio WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $output["url"] = "index.php?success=Investment has been successfully deleted!";
    echo json_encode($output, JSON_UNESCAPED_SLASHES);
}

if ($action == "logout") {
    $output = array();
    session_unset();
    session_destroy();
    $output["url"] = $basePath . "/auth/login.php";
    echo json_encode($output, JSON_UNESCAPED_SLASHES);
}
