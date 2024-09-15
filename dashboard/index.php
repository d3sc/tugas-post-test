<?php
session_start();
require "../db.php";

include "../helpers/path.php";
include "../middleware/isGuest.php";

if (isset($_GET['success'])) {
  $success = htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8');
}

if (isset($_SESSION['is_login'])) {
  $userId = $_SESSION['user_id'];
  $sql = "SELECT * FROM users INNER JOIN portofolio ON users.id = portofolio.userId WHERE users.id = $userId";
  $query = mysqli_query($conn, $sql);
  $data = mysqli_fetch_all($query);
}

if (isset($_POST["delete"])) {
  var_dump("masuk");
  exit;
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

  <!-- dataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
  <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script defer src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
  <script defer src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>

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
          <h1 class="h2">Portofolio</h1>
        </div>
        <?php
        if ($success) {
        ?>
          <div class="alert alert-success" role="alert">
            <?php echo $success ?>
          </div>
        <?php
        }
        ?>
        <div class="container mb-5">
          <div class="mb-2">
            <a href="<?php echo $basePath . "/dashboard/create.php" ?>" class="btn btn-primary">Add New Invest</a>
          </div>
          <table id="example" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $index = 1;
              foreach ($data as $row): ?>
                <tr>
                  <td><?php echo htmlspecialchars($index); ?></td>
                  <td><?php echo htmlspecialchars($row[1]); ?></td>
                  <td><?php echo htmlspecialchars($row[6]); ?></td>
                  <td><?php echo htmlspecialchars($row[7]); ?></td>
                  <td><?php echo htmlspecialchars($row[8]); ?></td>
                  <td class="d-flex gap-3">
                    <!-- Contoh action, bisa disesuaikan -->
                    <a href="edit.php?id=<?php echo $row[4]; ?>" class="btn btn-warning">Edit</a>
                    <form method="post" action="action.php?action=delete&id=<?php echo $row[4] ?>" class="delete-form">
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php $index++;
              endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>
    </main>
  </div>
  </div>

</body>
<script>
  $(document).ready(() => {
    $(".delete-form").submit((event) => {
      event.preventDefault();

      const form = $(event.currentTarget);
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            success: (response) => {
              let result = JSON.parse(response)

              window.location.href = result.url;
            },
          })
        }
      });
    });
  });
</script>

<?php include "./layouts/footer.php" ?>