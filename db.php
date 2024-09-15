<?php
define("servername", "localhost");
define("username", "root");
define("password", "");
define("database", "investment");

$conn = mysqli_connect(servername, username, password, database);

if (!$conn) {
    die("Connection Lost = " . mysqli_connect_error());
}
