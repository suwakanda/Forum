<?php
// Start the session
session_start();
  include("config.php");
  include("functions.php");

  $user_data = check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>forum</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet"/>
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
		
	<h1 style="text-align: center;">About Us </h1>
    <p><center>A forum is an online discussion board where people can ask question, share their experiences, and discuss topics of mutual interest. Forums are an excellent way to create social connections and a sense of community. They can also help you to cultivate an interest group about a particular subject. Use the forums application to start discussions about a specific topic or to debate solutions to share problems. By participating in a forum, you can exchange ideas and ask questions.</center></p>
	<br><hr style="border: 1px solid black;">

  
  <section class="features-icons  text-center">
            <div class="container">
            <h1 style="text-align: center;">Site rule </h1>
                <div class="row" style=" background-color:#2874A6">
                    <div class="col-lg-4" style="padding:20px">
                      <div class="row row-cols-auto">
                        <div class="col" ><i class="fa-solid fa-0 fa-3x"></i><i class="fa-solid fa-1 fa-3x" ></i></div>
                        <div class="col" ><h3>No offensive content</h3></div>
                      </div>    
                    </div>

                    <div class="col-lg-4 " style="padding:20px">
                      <div class="row row-cols-auto">
                        <div class="col" ><i class="fa-solid fa-0 fa-3x"></i><i class="fa-solid fa-2 fa-3x" ></i></div>
                        <div class="col" ><h3>No Trolling</h3></div>
                      </div>    
                    </div>

                    <div class="col-lg-4" style="padding:15px">
                      <div class="row row-cols-auto">
                        <div class="col" ><i class="fa-solid fa-0 fa-3x"></i><i class="fa-solid fa-3 fa-3x" ></i></div>
                        <div class="col-sm-8" ><h3>No spreading of any copyrighted material</h3></div>
                      </div>    
                    </div>

                    <div class="col-lg-4" style="padding:20px">
                      <div class="row row-cols-auto">
                        <div class="col" ><i class="fa-solid fa-0 fa-3x"></i><i class="fa-solid fa-4 fa-3x" ></i></div>
                        <div class="col" ><h3>No spamming</h3></div>
                      </div>    
                    </div>

                    <div class="col-lg-4" style="padding:20px">
                      <div class="row row-cols-auto">
                        <div class="col" ><i class="fa-solid fa-0 fa-3x"></i><i class="fa-solid fa-5 fa-3x" ></i></div>
                        <div class="col" ><h3>No advertising</h3></div>
                      </div>    
                    </div>

                    <div class="col-lg-4" style="padding:20px">
                      <div class="row row-cols-auto">
                        <div class="col" ><i class="fa-solid fa-0 fa-3x"></i><i class="fa-solid fa-6 fa-3x" ></i></div>
                        <div class="col" ><h3>Please be nice</h3></div>
                      </div>    
                    </div>

                </div>
            </div>
        </section>
    
			
</main>
<?php
  include 'footer.php';

  ?>  
