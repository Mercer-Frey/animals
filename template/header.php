<?php 
if(isset($_COOKIE['user']) AND $_COOKIE['user'] != ''){
  $user_login = json_decode($_COOKIE['user']);
  $time = time();
  $status = '';

  $conn2 = connect(); 
  mysqli_query($conn2, "UPDATE users SET time_last_online='".$time."'  WHERE id='" . $user_login->{'id'} . "'");
  $result = mysqli_query($conn2, "SELECT time_last_online FROM users WHERE id='" . $user_login->{'id'} . "'");
  $user_last_time = mysqli_fetch_assoc($result);
  close($conn2);
  ($user_last_time['time_last_online'] < time() - 30 OR $user_last_time['time_last_online'] === '') ? $status = 'Offline' : $status = 'Online';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css" >
    <title>Animal Planet</title>
  </head>
  <body>
    <div class="wrap">
      <div class="content">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
          <a class="navbar-brand" href="/">Animal</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>

              <?php
                if(isset($_COOKIE['user']) AND $_COOKIE['user'] != ''){
                  $user_login = json_decode($_COOKIE['user']);
              ?>
                  <li class="nav-item"> <a href="/logout" class="nav-link">Logout</a></li>
                  <li class="nav-item active"> <a href="/profile/<?php echo $user_login->{'id'}?>" class="nav-link"><?php echo $user_login->{'login'}?></a></li>
                  <li class="nav-item"> <a href="/" class="nav-link disabled"><?php echo $status?></a></li>
              <?php    
                }
                else{
              ?>
                  <li class="nav-item"> <a href="/signup" class="nav-link">Sign Up</a></li>
                  <li class="nav-item"> <a href="/login" class="nav-link">Login</a> </li>
              <?php
                }
              ?>

              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
              </li>
            </ul>
          </div>
        </nav>
