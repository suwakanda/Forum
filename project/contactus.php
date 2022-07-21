<?php
// Start the session
session_start();
  include("config.php");
  include("functions.php");
  $user_data = check_login($conn);
  

  
// Start the session
  if(isset($_POST['btn-send'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $fmessage = mysqli_real_escape_string($conn, $_POST['message']);

    $insert = mysqli_query($conn, "INSERT INTO `contact_form`(name, email, subject,message) VALUES('$name', '$email','$subject', '$fmessage')") or die('query failed');

     if($insert){
        $message[] = 'message send successful';
       header("location:contactus.php?success");
      }else{
        $message[] = 'message send failed!';
        header("location:contactus.php?error");
      }
    }


  
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
        <link rel="stylesheet" href="../project/style.css?v=<%= DateTime.Now.Ticks %>">
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
                <h1 style="text-align: center;">Contact Us </h1>
                <?php 
                            $Msg = "";
                            if(isset($_GET['error']))
                            {
                                $Msg = " you message fail to send ";
                                echo '<div class="alert alert-danger">'.$Msg.'</div>';
                            }

                            if(isset($_GET['success']))
                            {
                                $Msg = " Your Message Has Been Sent ";
                                echo '<div class="alert alert-success">'.$Msg.'</div>';
                            }
                        
                        ?>
                <br><hr style="border: 1px solid black;">

                
                <div class="row" data-aos="fade-in">
                  <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info" style="padding-left: 100px;">
                      <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>A108 Adam Street, New York, NY 535022</p>
                      </div>
        
                      <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>info@example.com</p>
                      </div>
        
                      <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>+1 5589 55488 55s</p>
                      </div>

                      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 180%; height: 290px;" allowfullscreen></iframe>
                    </div>
        
                  </div>
        
                  <?php 
  if(isset($_SESSION['user_id'])){?>
    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" style="padding-left: 150px;">
                    <form action="" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="name">Your Name : <?php echo $user_data['name']; ?></label>
                          <input type="hidden" name="name" class="form-control" id="name" value ="<?php $user_data['name'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="name">Your Email : <?php echo $user_data['email'] ?></label>
                          <input type="hidden"  name="email" class="form-control" id="email" value ="<?php $user_data['email'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Message</label>
                        <textarea class="form-control" name="message" rows="10" required></textarea>
                      </div>
                    </br>
                      <div class="text-center"><button type="submit" name="btn-send">Send Message</button></div>
                    </form>
                  </div>

                <?php 
                }else{
                ?>
                  <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" style="padding-left: 150px;">
                    <form action="" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="name">Your Name</label>
                          <input type="text" name="name" class="form-control" id="name"  required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="name">Your Email</label>
                          <input type="email" class="form-control" name="email" id="email"  required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Message</label>
                        <textarea class="form-control" name="message" rows="10" required></textarea>
                      </div>
                    </br>
                      <div class="text-center"><button type="submit" name="btn-send">Send Message</button></div>
                    </form>
                  </div>
        <?php } ?>

                </div>
              </div>
                <br><br><br><br><br>
                <p><center>Contact Us by Email: <a href="mailto:info@mysite.com">info@mysite.com</a></p></center> 
	
                <br><br><hr style="border: 1px solid black;">
    </main>
    <?php
  include 'footer.php';

  ?>  
