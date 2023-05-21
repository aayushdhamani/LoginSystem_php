<?php
$login=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
include 'partials/_dbconnect.php';
  $username=$_POST['username'];
  $password=$_POST['password'];
  $sql = "Select * from users where username='$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1){
      while($row=mysqli_fetch_assoc($result)){
          if (password_verify($password, $row['password'])){ 
              $login = true;
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $username;
              header("location: welcome.php");
          } 
          else{
              $showError = "Invalid Credentials";
          }
      }
      
  }
  else{
      $showError = "Invalid Credentials";
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
   <?php
   require 'partials/_nav.php';
   if ($login) {
     echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong>You have loggedin into your account
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
   }
   if ($showError) {
     echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '. $showError .'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
   }
     ?>

   <div class="container" >
   <h1 class="text-center">Login to your Account</h1>
   <form action="/loginSystem/login.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label col-md-6">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
    <label for="password" class="form-label col-md-6">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    </div>
   
 
  <button type="submit" class="btn btn-primary">Login</button>
</form>
   </div>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>