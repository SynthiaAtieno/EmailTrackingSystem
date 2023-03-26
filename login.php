
<?php
session_start();
include_once 'DatabaseConfig.php';

if(isset($_POST['login'])){
  
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));

$query = "SELECT `user_id`, `email`,`firstname`, `lastname`, `password` FROM `users` WHERE `password` LIKE '$password' AND `email` LIKE '$email'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
      $user_id = $row['user_id'];
      $email = $row['email'];
      $fullname = $row['firstname']." ".$row['lastname'];
      $_SESSION['loggedin'] = true;
      $_SESSION['user_id'] = $user_id;
      $_SESSION['fullname'] = $fullname;
      $_SESSION['email'] = $email;
      

      header('Location:dashboard/userdashboard.php');
    }
}else{
  echo '<script> alert("Email or password is incorrect")</script>';
    //echo '<script> alert("User does not exist")</script>';
}
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
    <link rel="stylesheet" href="css/form.css">
    <title>Login</title>
</head>
<body>

  <div class="card">
    
    <form action="login.php" method="post">
      <img class="card-img-top" src="dashboard/tracks.png" alt="logo" height="300px" width="200px">
      
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>

          <button id="submit" type="submit" name="login">Login</button>
          
        <p style="text-align: end; font-size:large; padding:20px;">Do not have an account? <a href="registerform.php"  style="text-decoration: none; color:green; font-weight:bold;"><span>Register</span></a></p>
      </form>
  </div>
</body>
</html>