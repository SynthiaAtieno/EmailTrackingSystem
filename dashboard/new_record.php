<?php
session_start();
include 'sidebar.php';
include 'topbar.php';
include '../DatabaseConfig.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  if(isset($_POST['new_record'])){
   
      if($conn){
        $requestby = mysqli_real_escape_string($conn, $_POST['requestby']);
        $request = mysqli_real_escape_string($conn, $_POST['request']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);

        $query = "INSERT INTO requests (`requestby`, `request`, `body`, `user_id`) VALUES ('$requestby', '$request', '$body', '$_SESSION[user_id]');";
        $result = mysqli_query($conn, $query);
  
        if($result){
         echo "<script>alert('New record added successfully');</script>";
          //echo '<script> document.getElementById("alert_success").style.visibility = "visible";</script>';
        }
        else{
          echo '<script> alert("Failed to add new record")</script>';

        }
      
      
    }
    else{
      echo "Connection to the database failed";
      mysqli_close($conn);
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/register.css">
    <script src="../js/script.js"></script>
    <title>New Record</title>
</head>
<body>
<main class="mt-5 pt-3 ">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 fw-bold text-uppercase fs-4">New Records
    <!-- </div>
    <div class="alert alert-success alert-dismissible" id="alert_success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> New record added successfully.
  </div> -->
    <div class="row mt-5">
      <div class="col-md-12">
      <form action="new_record.php" method="post">
        <div>
          <label for="fname">Requestby:</label>
          <input type="text" id="requestby" placeholder="Who made the request" name="requestby" required>
        </div>
        <div>
            <label for="lname">Request:</label>
            <input type="text" id="request" name="request" placeholder="Write the subject of the mail..." required>
          </div>
        <div>
          <label for="email">Body:</label>
          <input type="text" id="body" name="body" placeholder="Write the body of your mail..." required>
        </div>
        <div>
          <button type="submit" name="new_record" onclick="myFunction()">Insert New Record</button>
        
      </div>

    </div>
</main>
    <script>
      function myFunction() {
    var requestby = document.getElementById("requestby");
    if(requestby.lenth == 0){
        document.getElementById("alert_danger").style.visibility="visible";
    }
    //document.getElementById("alert_success").style.visibility = "visible";
  }
    </script>
</body>
</html>
</body>
</html>