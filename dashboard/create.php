<?php

session_start();
require "../db.php";

include "../helpers/path.php";
include "../middleware/isGuest.php";

$error = "";

if (isset($_SESSION["is_login"])) {
    $userId = $_SESSION["user_id"];
}

if (isset($_POST["submit"])) {
    $type_investment = $_POST["type_investment"];
    $investment_amount = $_POST["investment_amount"];
    $investment_date = $_POST["investment_date"];

    if (empty($type_investment) || empty($investment_amount) || empty($investment_date)) {
        $error = "All input fields must be filled!";
    }

    if (!is_numeric($investment_amount)) {
        $error = "Investment amount must be a valid number!";
    }

    if (empty($error)) {
        $investment_amount = "$" . number_format($investment_amount, 2, '.', ',');
        $sql = "INSERT INTO portofolio (userId, type_of_investment, investment_amount, investment_date) VALUES ($userId, '$type_investment', '$investment_amount', '$investment_date')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?success=Investment has been successfully added!");
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}

?>

<?php include "./layouts/heading.php" ?>

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
                    <h1 class="h2">Create Investment</h1>
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

                <div class="container">
                    <div class="mt-4">
                        <div class="container">
                            <div class="mt-4">
                                <!-- Form sederhana untuk create -->
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="type_investment" class="form-label">Type of Investment</label>
                                        <select class="form-control" id="type_investment" name="type_investment" required>
                                            <option value="stocks">Stocks</option>
                                            <option value="bonds">Bonds</option>
                                            <option value="mutual funds">Mutual Funds</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="investment_amount" class="form-label">Investment Amount</label>
                                        <input type="number" class="form-control" id="investment_amount" name="investment_amount" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="investment_date" class="form-label">Investment Date</label>
                                        <input type="date" class="form-control" id="investment_date" name="investment_date" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>

</body>
<?php include "./layouts/footer.php" ?>