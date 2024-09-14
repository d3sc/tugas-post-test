<?php
session_start();
require "../db.php";

include "../helpers/path.php";
include "../middleware/isGuest.php";

$userId = $_SESSION['user_id'];
$data = "";
if (isset($_SESSION['is_login']) && $userId) {
    $sql = "SELECT * FROM users INNER JOIN profile ON users.id = profile.userId WHERE users.id = $userId";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
}

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("location: $basePath/auth/login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <?php include "../layout/link.html" ?>

    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="./dashboard.js"></script>
    <script src="../data/country.js"></script>

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
                    <h1 class="h2"><?php echo $data['username'] ?></h1>
                </div>

                <div class="container dashboard-profile">
                    <form class="container my-4" method="post" action="">
                        <?php
                        if ($error) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error ?>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if ($success) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $success ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="">
                            <span>Type of Account</span>
                            <div class="ps-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accountType[]" value="individual" id="flexCheckDefault" <?php echo in_array('individual', array_map('trim', explode(',', $data['account_type']))) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Individual Account
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accountType[]" value="join" id="flexCheckChecked" <?php echo in_array('join', array_map('trim', explode(',', $data['account_type']))) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Join Account
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accountType[]" value="company" id="flexCheckDisabled" <?php echo in_array('company', array_map('trim', explode(',', $data['account_type']))) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexCheckDisabled">
                                        Company
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accountType[]" value="trust" id="flexCheckDisabledChecked" <?php echo in_array('trust', array_map('trim', explode(',', $data['account_type']))) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="flexCheckDisabledChecked">
                                        Trust
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="account-title">
                            <span>Account Title</span>
                            <select class="form-select" name="accountTitle" aria-label="Default select example">
                                <option value="Mr" <?php echo $data['account_title'] == 'Mr' ? 'selected' : ''; ?>>Mr</option>
                                <option value="One" <?php echo $data['account_title'] == 'One' ? 'selected' : ''; ?>>One</option>
                                <option value="Two" <?php echo $data['account_title'] == 'Two' ? 'selected' : ''; ?>>Two</option>
                                <option value="Three" <?php echo $data['account_title'] == 'Three' ? 'selected' : ''; ?>>Three</option>
                            </select>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col">
                                <label for="input1">First Name *</label>
                                <input type="text" class="form-control" id="input1" name="firstName" value="<?php echo htmlspecialchars($data['first_name']); ?>" required>
                            </div>
                            <div class="form-group col">
                                <label for="input2">Middle Name</label>
                                <input type="text" class="form-control" id="input2" name="middleName" value="<?php echo htmlspecialchars($data['middle_name']); ?>">
                            </div>
                            <div class="form-group col">
                                <label for="input3">Last Name *</label>
                                <input type="text" class="form-control" id="input3" name="lastName" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <label for="input-date1">Date of Birth *</label>
                                <input type="date" class="form-control" id="input-date1" name="dateOfBirth" value="<?php echo htmlspecialchars($data['date_of_birth']); ?>" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col">
                                <label for="input-nationality">Nationality *</label>
                                <input type="text" class="form-control" id="input-nationality" name="nationality" value="<?php echo htmlspecialchars($data['nationality']); ?>" required>
                            </div>
                            <div class="form-group col">
                                <label for="input-residence">Country of Residence *</label>
                                <input type="text" class="form-control" id="input-residence" name="countryOfResidence" value="<?php echo htmlspecialchars($data['country_of_residence']); ?>" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col">
                                <label for="input-address1">Address Line 1 *</label>
                                <input type="text" class="form-control" id="input-address1" name="address1" value="<?php echo htmlspecialchars($data['address1']); ?>" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col">
                                <label for="input-address2">Address Line 2</label>
                                <input type="text" class="form-control" id="input-address2" name="address2" value="<?php echo htmlspecialchars($data['address2']); ?>">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col">
                                <label for="input-city">City</label>
                                <input type="text" class="form-control" id="input-city" name="city" value="<?php echo htmlspecialchars($data['city']); ?>">
                            </div>
                            <div class="form-group col">
                                <label for="input-state">State</label>
                                <input type="text" class="form-control" id="input-state" name="state" value="<?php echo htmlspecialchars($data['state']); ?>">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col">
                                <label for="input-zip">Zip Code *</label>
                                <input type="text" class="form-control" id="input-zip" name="zipCode" value="<?php echo htmlspecialchars($data['zip_code']); ?>" required pattern="\d{5}">
                            </div>
                            <div class="form-group col">
                                <label for="input-country">Country</label>
                                <select class="form-select" id="input-country" name="country">
                                    <option value="<?php echo htmlspecialchars($data['country']); ?>" selected><?php echo htmlspecialchars($data['country']); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <label for="input-employment">Employment Status</label>
                                <input class="form-control" id="input-employment" name="employmentStatus" value="<?php echo htmlspecialchars($data['employment_status']); ?>" />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <label for="input-job">Job Title</label>
                                <input class="form-control" id="input-job" name="jobTitle" value="<?php echo htmlspecialchars($data['job_title']); ?>" />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-6">
                                <label for="input-phone-work">Phone Work</label>
                                <input type="tel" class="form-control" id="input-phone-work" name="phoneWork" value="<?php echo htmlspecialchars($data['phone_work']); ?>" />
                            </div>
                            <div class="form-group col-6">
                                <label for="input-phone-mobile">Phone Mobile</label>
                                <input type="tel" class="form-control" id="input-phone-mobile" name="phoneMobile" value="<?php echo htmlspecialchars($data['phone_mobile']); ?>" />
                            </div>
                            <div class="form-group col-6 mt-3">
                                <label for="input-phone-home">Phone Home</label>
                                <input type="tel" class="form-control" id="input-phone-home" name="phoneHome" value="<?php echo htmlspecialchars($data['phone_home']); ?>" />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-6 mt-3">
                                <label for="input-alt-email">Alternative Email</label>
                                <input class="form-control" id="input-alt-email" name="altEmail" value="<?php echo htmlspecialchars($data['alt_email']); ?>" />
                            </div>
                        </div>

                        <div class="mt-3">
                            <span class="fw-bold">Please provide a secure password below that you'll use to log in to your online research portal. The email address you have supplied on this form will be your username</span>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-5">
                                <label for="input-username">Username *</label>
                                <input type="text" class="form-control" id="input-username" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required />
                            </div>
                            <div class="form-group col-7">
                                <label for="input-email">Email *</label>
                                <input type="email" class="form-control" id="input-email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required />
                            </div>
                            <div class="form-group col-5 mt-3">
                                <label for="input-password">Password *</label>
                                <input type="password" class="form-control" id="input-password" name="password" required />
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-item-center mt-5">
                            <button class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
        </div>
        </main>
    </div>
    </div>

    <?php include "../layout/link2.html" ?>
    <script src="./js/dashboard.js"></script>
    <script>
        $(document).ready(function() {
            const countrySelect = $("#input-country");

            country.forEach((item) => {
                countrySelect.append(new Option(item.name, item.name))
            })
        })
    </script>
</body>

</html>