<?php
define("servername", "localhost");
define("username", "root");
define("password", "");
define("database", "post_test");

$conn = mysqli_connect(servername, username, password, database);

if (!$conn) {
    die("koneksi tidak berhasil = " . mysqli_connect_error());
}
