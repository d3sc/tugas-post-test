<?php

$currentPath = explode("/", $_SERVER['REQUEST_URI'])[3];
if (strpos($currentPath, 'profile.php') !== false) {
    $profilePath = 'profile.php';
}

?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3" style="height: 100%;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?php echo $currentPath == "" || $currentPath == "index.php" ? "active" : ""; ?>" aria-current="page" href="index.php">
                    <box-icon type='solid' name='dashboard' size="sm" color="<?php echo $currentPath == "" || $currentPath == "index.php" ? "blue" : ""; ?>""></box-icon>
                    portofolio
                </a>
            </li>
            <li class=" nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 <?php echo $profilePath == "profile.php" ? "active" : ""; ?>" href="profile.php">
                            <box-icon name='user' type='solid' size="sm" color="<?php echo $profilePath == "profile.php" ? "blue" : ""; ?>"></box-icon>
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