<?php

include_once 'DatabaseConfig.php';

  if(isset($_POST['register'])){
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));
    $confirmPassword = mysqli_real_escape_string($conn, base64_encode($_POST['conpassword']));


    if($password != $confirmPassword){
    
      echo '<script> alert("Password mismatch")</script>';
    }
    else{
      if($conn){

      
      $sql = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
      $result1 = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result1)>0){
        echo '<script> alert("User with that email address already exist")</script>';
      }
      else{
        $query = "INSERT INTO users (`firstname`, `lastname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$password');";
        $result = mysqli_query($conn, $query);
  
        if($result){
          echo '<script> alert("Registration successful")</script>';
        }
      }
      
    }
    else{
      echo "Connection to the database failed";
      mysqli_close($conn);
    }
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
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Register</title>
</head>
<body>
<div class="card">
    <form action="login.php" method="post">
      <img class="card-img-top" src="dashboard/tracks.png" alt="logo">
    <form action="registerform.php" method="post">
        <div>
          <label for="fname">First Name:</label>
          <input type="text" id="fname" name="fname" required>
        </div>
        <div>
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>
          </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password">Confirm Password:</label>
            <input type="password" id="conpassword" name="conpassword" required>
          </div>
        <div>
          <button type="submit" name="register">Register</button>
        </div>
        <p style="text-align: end; font-size:large; padding:20px;">Already have an account? <a href="login.php" style="text-decoration: none; color:green; font-weight:bold;"><span">Login</span></a></p>
      </form>
      </div>
</body>
</html>