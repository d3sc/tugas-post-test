<?php
session_start();
require "../db.php";

$success = "";
$error = "";

include "../middleware/isAuth.php";

if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $nationality = $_POST["nationality"];
    $countryOfResidence = $_POST["countryOfResidence"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zipCode = $_POST["zipCode"];
    $country = $_POST["country"];
    $employmentStatus = $_POST["employmentStatus"];
    $jobTitle = $_POST["jobTitle"];
    $phoneWork = $_POST["phoneWork"];
    $phoneMobile = $_POST["phoneMobile"];
    $phoneHome = $_POST["phoneHome"];
    $altEmail = $_POST["altEmail"];
    $accountTitle = $_POST["accountTitle"];

    $checkbox = $_POST["accountType"] ?? "";
    if ($checkbox) {
        $accountType = implode(", ", $checkbox);
    }

    $dateOfBirth = empty($dateOfBirth) ? null : $dateOfBirth;


    if (empty($username) || empty($email) || empty($password) || empty($firstName) || empty($lastName) || empty($nationality) || empty($countryOfResidence) || empty($address1) || empty($zipCode) || empty($accountTitle) || empty($country)) {
        $error = "all input required must be fill!";
    }

    if (($dateOfBirth < 1 || $dateOfBirth > 31) && $dateOfBirth) {
        $error = "input date must filled 1 - 31";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email is invalid!";
    }

    if (strlen($password) < 8) {
        $error = "Password is must have at least 8 character!";
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (empty($error)) {
        $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
        $result = mysqli_query($conn, $sql);

        $userId = mysqli_insert_id($conn);
        $sql1 = "INSERT INTO profile (userId, first_name, middle_name, last_name, date_of_birth, nationality, country_of_residence, address1, address2, city, state, zip_code, country, employment_status, job_title, phone_work, phone_mobile, phone_home, alt_email, account_title, account_type)
     VALUES ($userId, '$firstName', '$middleName', '$lastName', '$dateOfBirth', '$nationality', '$countryOfResidence', '$address1', '$address2', '$city', '$state', '$zipCode', '$country', '$employmentStatus', '$jobTitle', '$phoneWork', '$phoneMobile', '$phoneHome', '$altEmail', '$accountTitle', '$accountType')";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            $success = "Data has been successfuly stored!";
            header("refresh:2;url=login.php");
        } else {
            $error = "Error : " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Latest compiled and minified CSS -->
    <?php include "../layout/link.html" ?>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../data/country.js"></script>
</head>

<body>

    <form class="container my-4" method="post" action="">
        <div class="mb-4">
            <a href="login.php"> back </a>
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
                    <input class="form-check-input" type="checkbox" name="accountType[]" value="individual" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Individual Account
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accountType[]" value="join" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Join Account
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accountType[]" value="company" id="flexCheckDisabled">
                    <label class="form-check-label" for="flexCheckDisabled">
                        Company
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accountType[]" value="trust" id="flexCheckDisabledChecked">
                    <label class="form-check-label" for="flexCheckDisabledChecked">
                        Trust
                    </label>
                </div>
            </div>
        </div>
        <div class="account-title">
            <span>Account Title</span>
            <select class="form-select" name="accountTitle" aria-label="Default select example">
                <option selected value="Mr">Mr</option>
                <option value="One">One</option>
                <option value="Two">Two</option>
                <option value="Three">Three</option>
            </select>
        </div>

        <div class="row mt-3">
            <div class="form-group col">
                <label for="input1">First Name *</label>
                <input type="text" class="form-control" id="input1" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
            </div>
            <div class="form-group col">
                <label for="input2">Middle Name</label>
                <input type="text" class="form-control" id="input2" name="middleName" value="<?php echo htmlspecialchars($middleName); ?>">
            </div>
            <div class="form-group col">
                <label for="input3">Last Name *</label>
                <input type="text" class="form-control" id="input3" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col-6">
                <label for="input-date1">Date of Birth *</label>
                <input type="date" class="form-control" id="input-date1" name="dateOfBirth" value="<?php echo htmlspecialchars($dateOfBirth); ?>" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col">
                <label for="input-nationality">Nationality *</label>
                <input type="text" class="form-control" id="input-nationality" name="nationality" value="<?php echo htmlspecialchars($nationality); ?>" required>
            </div>
            <div class="form-group col">
                <label for="input-residence">Country of Residence *</label>
                <input type="text" class="form-control" id="input-residence" name="countryOfResidence" value="<?php echo htmlspecialchars($countryOfResidence); ?>" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col">
                <label for="input-address1">Address Line 1 *</label>
                <input type="text" class="form-control" id="input-address1" name="address1" value="<?php echo htmlspecialchars($address1); ?>" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col">
                <label for="input-address2">Address Line 2</label>
                <input type="text" class="form-control" id="input-address2" name="address2" value="<?php echo htmlspecialchars($address2); ?>">
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col">
                <label for="input-city">City</label>
                <input type="text" class="form-control" id="input-city" name="city" value="<?php echo htmlspecialchars($city); ?>">
            </div>
            <div class="form-group col">
                <label for="input-state">State</label>
                <input type="text" class="form-control" id="input-state" name="state" value="<?php echo htmlspecialchars($state); ?>">
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col">
                <label for="input-zip">Zip Code *</label>
                <input type="text" class="form-control" id="input-zip" name="zipCode" value="<?php echo htmlspecialchars($zipCode); ?>" required pattern="\d{5}">
            </div>
            <div class="form-group col">
                <label for="input-country">Country</label>
                <select class="form-select" id="input-country" name="country"></select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col-6">
                <label for="input-employment">Employment Status</label>
                <input class="form-control" id="input-employment" name="employmentStatus" value="<?php echo htmlspecialchars($employmentStatus); ?>" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col-6">
                <label for="input-job">Job Title</label>
                <input class="form-control" id="input-job" name="jobTitle" value="<?php echo htmlspecialchars($jobTitle); ?>" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col-6">
                <label for="input-phone-work">Phone Work</label>
                <input type="tel" class="form-control" id="input-phone-work" name="phoneWork" value="<?php echo htmlspecialchars($phoneWork); ?>" />
            </div>
            <div class="form-group col-6">
                <label for="input-phone-mobile">Phone Mobile</label>
                <input type="tel" class="form-control" id="input-phone-mobile" name="phoneMobile" value="<?php echo htmlspecialchars($phoneMobile); ?>" />
            </div>
            <div class="form-group col-6 mt-3">
                <label for="input-phone-home">Phone Home</label>
                <input type="tel" class="form-control" id="input-phone-home" name="phoneHome" value="<?php echo htmlspecialchars($phoneHome); ?>" />
            </div>
        </div>

        <div class="row mt-3">
            <div class="form-group col-6 mt-3">
                <label for="input-alt-email">Alternative Email</label>
                <input class="form-control" id="input-alt-email" name="altEmail" value="<?php echo htmlspecialchars($altEmail); ?>" />
            </div>
        </div>

        <div class="mt-3">
            <span class="fw-bold">Please provide a secure password below that you'll use to log in to your online research portal. The email address you have supplied on this form will be your username</span>
        </div>

        <div class="row mt-3">
            <div class="form-group col-5">
                <label for="input-username">Username *</label>
                <input type="text" class="form-control" id="input-username" name="username" value="<?php echo htmlspecialchars($username); ?>" required />
            </div>
            <div class="form-group col-7">
                <label for="input-email">Email *</label>
                <input type="email" class="form-control" id="input-email" name="email" value="<?php echo htmlspecialchars($email); ?>" required />
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

</body>
<!-- Latest compiled JavaScript -->
<?php include "../layout/link2.html" ?>
<script>
    $(document).ready(function() {
        const countrySelect = $("#input-country");

        country.forEach((item) => {
            countrySelect.append(new Option(item.name, item.name))
        })
    })
</script>

</html>