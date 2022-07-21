<?php

include 'config.php';

if(isset($_POST['submit'])){
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $pass = mysqli_real_escape_string($conn, sha1($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, sha1($_POST['cpassword']));
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE name = '$name' AND password = '$pass' ") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{

         $insert = mysqli_query($conn, "INSERT INTO `tbl_users`(user_name,name, email, password,phone,address, image) VALUES('$user_name','$name', '$email','$pass', '$phonenumber','$address', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header("location:home.php");
         }else{
            $message[] = 'registeration failed!';
         }
      }
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
	
	
		<h1 style="text-align: center;">Sign Up</h1>
    
		<form action="" method="post" enctype="multipart/form-data">
		<table width="300" align="center">
		<tr>
			<td><label>User Name</label></td>
			<td><input type="text" name="user_name" autofocus />
		</tr>
    <tr>
			<td><label>Nick Name</label></td>
			<td><input type="text" name="name" autofocus />
		</tr>
		<tr>
			<td><label>Password</label></td>
			<td><input type="password" name="password" />
		</tr>
    <tr>
			<td><label>Comfrim Password</label></td>
			<td><input type="password" name="cpassword" />
		</tr>
		<tr>
			<td><label>Email</label></td>
			<td><input type="email" name="email"  />
		</tr>
    <tr>
			<td><label>Address</label></td>
			<td><input type="text" name="address"  />
		</tr>
    <tr>
			<td><label>Phone number</label></td>
			<td><input type="text" name="phonenumber"  />
		</tr>

    <tr>
    <td><label>Avatar</label></td>
		<td><input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
		</tr>
        
                
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Sign Up" style="width: auto; margin-left: 50%;">
		</tr>
		</table>
	<p>Already have an account? <a href="login.php">Login here!</a></p>
	
</form>

<?php
  include 'footer.php';

  ?>  