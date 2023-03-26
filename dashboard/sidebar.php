<?php
include '../DatabaseConfig.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

}
else{
    echo "Please log in first to see this page.";
    session_destroy();
    header('Location:../login.php');
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<div class="offcanvas offcanvas-start sidebar-nav bg-dark text-white " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li>
          <a href="userdashboard.php" class="nav-link px-3 mt-3"><span class="me-3">
          <i class="bi bi-speedometer2"></i>
          </span>
        <span>Dashboard</span></a>
        </li>
        <li class="my-4">
          <hr class="dropdown-divider">
        </li>
        <li>
          <a href="new_record.php" class="nav-link px-3 "><span class="me-3">
          <i class="bi bi-plus-circle"></i>
          </span>
        <span>New Record</span></a>
        </li>
        <li class="my-2">
        <li>
          <hr class="dropdown-divider">
        </li>
        </li>
        <li>
          <a href="pending_mails.php" class="nav-link px-3 "><span class="me-3">
          <i class="bi bi-slash-circle"></i>
          </span>
        <span>Pending</span></a>
        </li>
        <li class="my-2">
        <li>
          <hr class="dropdown-divider">
        </li>
        </li>

        <li>
          <a href="completed_mails.php" class="nav-link px-3 "><span class="me-3"> 
          <i class="bi bi-check-circle-fill"></i></span>
        <span>Completed</span></a>
        </li>
        <li class="my-2">
        <li>
          <hr class="dropdown-divider">
        </li>
        </li>
        <li>
          <a href="replied-mails.php" class="nav-link px-3 "><span class="me-3">
          <i class="bi bi-speedometer"></i>
          </span>
        <span>Replied</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
      </ul>
    </nav>
 
  </div>
</div>
