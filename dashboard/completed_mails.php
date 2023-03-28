<?php
session_start();
include 'sidebar.php';
include 'topbar.php';
include '../DatabaseConfig.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $query = "SELECT requests.requestby,requests.id, requests.request, requests.body, status.status FROM requests 
    JOIN status 
    ON status.status_id=requests.status_id 
    WHERE status='completed'
    AND requests.user_id = $_SESSION[user_id]";
    $results1 = mysqli_query($conn, $query); 
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
        <link rel="stylesheet" href="../css/dashboard.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Completed Mails</title>
</head>
<body>

<main class="mt-5 pt-5 ">
<div class="container-fluid">
  <!--Cards-->
    <div class="row mb-3">
      <div class="col-md-12 fw-bold text-uppercase fs-4">Completed Emails
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
      <div class="card text-white bg-danger h-100">
        <div class="card-header fw-bold fs-3 text-center">Pending</div>
        <div class="card-body">
          <h5 class="card-title fw-bold fs-5 text-center" id="pending"><?php
          $sql = "SELECT count(status_id) as status FROM requests WHERE user_id LIKE $_SESSION[user_id] AND status_id LIKE 2";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0){
              $row = mysqli_fetch_assoc($result);
              $total = $row['status'];
              echo "You have ". $total;
          }
          ?></h5>
          <p class="card-text fw-bold text-center">Pending Emails</p>
        </div>
      </div>
      </div>
      <div class="col-md-4 mb-3">
      <div class="card text-white bg-warning h-100">
        <div class="card-header fw-bold fs-3 text-center">Replied</div>
        <div class="card-body">
          <h5 class="card-title fw-bold fs-5 text-center"><?php
          $sql = "SELECT count(status_id) as status FROM requests WHERE user_id LIKE $_SESSION[user_id] AND status_id LIKE 5";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0){
              $row = mysqli_fetch_assoc($result);
              $total = $row['status'];
              echo  "You have ".$total;
          }
          ?></h5>
          <p class="card-text fw-bold text-center">Replied Emails</p>
        </div>
      </div>
      </div>
      <div class="col-md-4 mb-3">
      <div class="card text-white bg-success h-100">
        <div class="card-header fw-bold fs-3 text-center">Completed</div>
        <div class="card-body d-block align-items-center">
          <h5 class="card-title fw-bold fs-5 text-center" ><?php
          $sql = "SELECT count(status_id) as status FROM requests WHERE user_id LIKE $_SESSION[user_id] AND status_id LIKE 1";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0){
              $row = mysqli_fetch_assoc($result);
              $total = $row['status'];
              echo "You have ". $total;
          }
          ?></h5>
          <p class="card-text fw-bold text-center">Completed Emails</p>
        </div>
      </div>
      </div>
    </div>
  </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5 border-0">
                    <div class="card-header">
                        <h1 class="display-6 text-center fw-bold fs-4">Completed Mails</h1>
                    </div>
                    <div class="card-body">
                      Search:&nbsp;<input class="mb-4" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for requests..">
                        <table class="table text-center table-striped" id="myTable">
                            <tr>
                                <td class="fw-bold">Id</td>
                                <td class="fw-bold">Request</td>
                                <td class="fw-bold">Request By</td>
                                <td class="fw-bold">Body</td>
                                <td class="fw-bold">Status</td>
                               
                            </tr>
                            <tr>
                               <?php
                               while($row = mysqli_fetch_assoc($results1))
                               {
                                ?>
                                <th><?php echo $row['id']?></th>
                                <td><?php echo $row['requestby']?></td>
                                <td><?php echo $row['request']?></td>
                                <td><?php echo $row['body']?></td>
                                <td><?php echo $row['status']?></td>
                                </tr>
                                <?php
                               }
                               ?>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>