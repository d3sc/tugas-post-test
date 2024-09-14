<?php

$currentPath = explode("/", $_SERVER['REQUEST_URI'])[3];
if (strpos($currentPath, 'profile.php') !== false) {
    $profilePath = 'profile.php';
}

?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3" style="height: 80vh;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPath == "" || $currentPath == "index.php" ? "active" : ""; ?>" aria-current="page" href="index.php">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $profilePath == "profile.php" ? "active" : ""; ?>" href="profile.php">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
        </ul>
    </div>
    <div class="logout">
        <form method="post" class="nav-link d-flex justify-content-start align-items-center">
            <span data-feather="log-out" class="text-white"></span>
            <button class="nav-link px-3 text-white" name="logout">logout</button>
        </form>
    </div>
</nav>