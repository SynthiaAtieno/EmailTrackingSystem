<?php
//session_start();
include '../DatabaseConfig.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $sql = "SELECT count(status_id) as status FROM requests WHERE user_id LIKE $_SESSION[user_id] AND status_id LIKE 2";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_assoc($result);
      $total = $row['status'];
      
  }
}
else{
    echo "Please log in first to see this page.";
    session_destroy();
    header('Location:../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../form.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
     <!--offcanvas trigers-->
     <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
     <span class="navbar-toggler-icon"></span></button>
    <!--offcanvas trigers-->  
    <a class="navbar-brand fw-bold text-uppercase me-auto" href="userdashboard.php">Email<span>&nbsp;Tracking&nbsp;System&nbsp;</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <div class="d-flex ms-auto">
       
    </p>
      </div>
      <ul class="navbar-nav mb-2 mb-lg-0">
      <button type="button" class="btn btn-primary position-relative">
      <i class="bi bi-bell-fill"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo $total; ?>
            <span class="visually-hidden">unread messages</span>
          </span>
        </button>&nbsp;&nbsp;
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Hello&nbsp;<?php echo $_SESSION['fullname']?>&nbsp;<i class="bi bi-person-fill"></i>
         
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>