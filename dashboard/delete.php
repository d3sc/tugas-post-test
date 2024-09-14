<?php
session_start();
require "../db.php";

include "../middleware/isGuest.php";

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $sql = "DELETE from portofolio WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    header("Location: index.php?success=Investment has been successfully deleted!");
}
