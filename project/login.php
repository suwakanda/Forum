<?php
include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
   $pass = mysqli_real_escape_string($conn, sha1($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE username = '$user_name' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['roleid'] = $row['roleid'];
      
      $isActive = $row['isActive'];
      
      if($isActive=='1'){
        $message[] ='Sorry, Your account is Diactivated, Contact with Admin !';
        unset($_SESSION['user_id']);
	      session_destroy();
      }else{
      header('location: home.php');}
   }else{
      $message[] = 'incorrect username or password!';
   }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<title>Forum</title>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../project/style.css">
</head>
<body>

	<header style="text-align: center;">
		<h1>Forum</h1>
	</header>
	<nav>
    <div class="nav1 navbar navbar-expand-lg">
    <div class="container">
  <a class="navbar-brand" href="home.php" style="color: #000000;">Forum</a>
  <button class="navbar-toggler navbar-toggler-right" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fa fa-bars"></i>
    </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php" >Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forum.php">Forum</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contactus.php">Contact</a>
      </li>
    </ul>
    
  </div>
  </div>
  <a class="justify-content" href="../project/login.php" ><i class="far fa-user" style="color: #000075; font-size: 35px; margin:10px"></i>Log in</a>
  </div>

</nav>
	
    <form action="" method="post" enctype="multipart/form-data">
	<table width="300" align="center">
    <tr>
		<th><h1>Login</h1>
	</tr>
  <?php
  if(isset($message)){
         foreach($message as $message){
          
            echo '<div class="alert alert-danger alert-dismissible mt-3">'.$message.'</div>';
         }
      }

  ?>
	<tr>
		<td><input type="text" name="user_name" autofocus placeholder="User name"/></td>
	</tr>
	<tr>
		
		<td><input type="password" name="password" placeholder="Password"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="submit" value="Login" style="width: auto; margin-left: auto;"></td>
	</tr>
    <tr>
    <td><p>Do not have a account yet? <a href="signup.php">Sign up now!</a></p></td>
	</tr>
	</table>
    </form>

</br></br></br></br></br></br></br></br></br></br></br></br>

<?php
  include 'footer.php';

  ?>  