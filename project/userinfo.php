<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
include("functions.php");

$user_data = check_login($conn);

if(isset($_POST['reset_password'])){

  $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, sha1($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, sha1($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, sha1($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `tbl_users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }
}

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);
   

   $updated=mysqli_query($conn, "UPDATE `tbl_users` SET name = '$update_name', email = '$update_email',mobile = '$update_phone' WHERE id = '$user_id'") or die('query failed');

   if($updated){
    $message[] = 'profile updated';
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `tbl_users` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

   

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>forum</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../project/style.css">
    </head>

    <body>

    <header>
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

  <?php 
  if(isset($_SESSION['user_id'])){
    
    echo"<span>Welcome <a class='justify-content' href='../project/userinfo.php' >$user_data[name]</a></span>";
    if($_SESSION['roleid']=='1'){    
      echo"<a class='justify-content' href='../project/Admin/index.php'><i class='fa-solid fa-user-gear' ; font-size: 15px; margin:5px'></i></a>";
      }
    echo"<a class='justify-content' href='../project/logout.php' ><i class='fas fa-sign-out-alt' style='color: #000075; font-size: 25px; margin:10px'></i></a>";
  }else
    echo"<a class='justify-content' href='../project/login.php' ><i class='far fa-user' style='color: #000075; font-size: 35px; margin:10px'></i>Login</a>";
  ?>
 
  </div>

</nav>
 <main>
	<h1 style="text-align: center;">User info</h1>
  <section class="features-icons  text-center">
<div class="update-profile">

<?php
   $select = mysqli_query($conn, "SELECT * FROM `tbl_users` WHERE id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select) > 0){
      $fetch = mysqli_fetch_assoc($select);
   }
?>

<form action="" method="post" enctype="multipart/form-data">
   <?php
      if($fetch['image'] == ''){
         echo '<img src="images/default-avatar.png">';
      }else{
         echo '<img src="uploaded_img/'.$fetch['image'].'">';
      }
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
   ?>
   <div class="flex">
      <div class="inputBox">
         <span>Nickname :</span>
         <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box" required>
         <span>your email :</span>
         <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box" required>
         <span>your phone :</span>
         <input type="text" name="update_phone" value="<?php echo $fetch['mobile']; ?>" class="box" required>

      </div>
      <div class="inputBox">
         <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
         <span>old password :</span>
         <input type="password" name="update_pass" placeholder="enter your previous password" class="box" >
         <span>new password :</span>
         <input type="password" name="new_pass" placeholder="enter new password" class="box"  >
         <span>confirm password :</span>
         <input type="password" name="confirm_pass" placeholder="confirm new password" class="box" >
         <span>update your pic :</span>
         <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
      </div>
   </div>
   <input type="submit" value="update profile" name="update_profile" class="btn">
   <input type="submit" value="change password" name="reset_password" class="btn">
   
</form>

</div>  
        </section>
    
			
</main>
<?php
  include 'footer.php';

  ?>  


