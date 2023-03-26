<?php
session_start();
include 'topbar.php';
include 'sidebar.php';
include '../DatabaseConfig.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
 $query = $conn->query("SELECT s.status, COUNT(*) as total_count 
 FROM status s 
 JOIN requests r 
 ON s.status_id = r.status_id 
 WHERE r.user_id=$_SESSION[user_id] GROUP BY s.status
 ");
 foreach($query as $data){
  $count[]['label'] = $data['status'];
  $count[]['y'] = $data['total_count'];
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
    <script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Emails Report"
	},
	axisY: {
		title: "Number of Emails"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($count, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/dashboard.css">
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
      
        <title>Dashboard</title>
    </head>
    
    <body>

   
<main class="pt-5 ">
<div class="container-fluid">
  <!--Cards-->
  <div class="row mt-5">
    <div class="col-md-12 fw-bold text-uppercase fs-4">Dashboard
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
  <!--end of firstt cards-->
  <!--Charts-->
  <div class="row mt-5">
    <div class="col-md-8">
      <div class="card" style="border: none;">
        <!-- <div class="card-header bg bg-dark text-white ">
          <h1 style="text-align: center;" >Email Tracking Chart</h1>
        </div> -->
        <div class="card-body">
          <div id="chartContainer" style="height: 370px; width: 100%;"></div>
          </canvas>
        </div>
      </div>
    </div>
  </div>
  <!--Chart-->
 
</div>
</main>
</body>
</html>