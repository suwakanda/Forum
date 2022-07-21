<?php
// Start the session
session_start();
  include("config.php");
  include("functions.php");
  

  $user_data = check_login($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>forum</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../project/style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
    
          <h1 style="text-align: center;">Forum</h1>
          <br>
          <div class="container">
          <div style="border-style: groove; 
          border: 2px solid #5198b1;
          border-radius: 20px; 
          
          padding: 10px 50px; 
          height: auto;
          ">
          
  <?php 
	$sql="select * from blogs";
	$result=mysqli_query($conn,$sql);
	
	
	while($data=mysqli_fetch_array($result))
	{?>
            <a href="forum-detail.php?blogid=<?php echo $data['id'];?>"><?php echo $data['title'];?></a><span style="float:right;">Post by <?php echo $data['addeddate'];?></span>
            <p>by <?php echo $data['author'];?></p>
            <hr>       
            <?php } ?> 
  <?php 
  if(isset($_SESSION['user_id'])){
?>
    <a href="createpost.php" class="btn btn-primary mt-2"><b>Create post</b></a>
    <?php } ?> 
          </div>
          </div>

        <br>
        
    </main>
        
  <?php
  include 'footer.php';

  ?>   