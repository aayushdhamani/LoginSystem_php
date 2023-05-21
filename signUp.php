<?php
$showAlert=false;
$showError=false;
include 'partials/_dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];
  // $exist=false;

  $existsql="SELECT * FROM `users` WHERE username='$username'";
  $result=mysqli_query($conn,$existsql);
  $numexistrows=mysqli_num_rows($result);
  if ($numexistrows>0) {
    $showError="Username already exist";
  }
  else{

    if(($password==$cpassword)) {
      $hash=password_hash($password , PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        if ($result) {
         $showAlert=true;
      }
    }
      else{
        $showError="Password do not match";
      }
  }

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
   <?php
   require 'partials/_nav.php';
   if ($showAlert) {
     echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your account has been created and now you can login 
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
   <h1 class="text-center">Welcome to sign Up</h1>
   <form action="/loginSystem/SignUp.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label col-md-6">Username</label>
    <input type="text" class="form-control" maxLength=11 id="username" name="username" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
    <label for="password" class="form-label col-md-6">Password</label>
    <input type="password" class="form-control"  maxLength=23 id="password" name="password">
    </div>
    <div class="mb-3">
    <label for="cpassword" class="form-label col-md-6">confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure your password is correct</div>
    </div>
 
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
   </div>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>