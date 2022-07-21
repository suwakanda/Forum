<?php 
include('config.php');
include("functions.php");
session_start();
$blogid=$_GET['blogid'];
$user_data = check_login($conn);

if(isset($_POST['submit']))
{
	
  if(empty($_POST['commentid']))
	{
		$commentid='0';
    
	}
	else 
	{
		$commentid=$_POST['commentid'];
	}
	
	$sql="insert into comments (blog_id,comment_id,name,description) values ('".$blogid."','".$commentid."','".$_POST['name']."','".$_POST['description']."')";
	
	$result=mysqli_query($conn,$sql);


	if($result)
	{
		echo '<script>alert("comment added successfully, we will published after verify your comment.")</script>';
	}
	
	else 
	{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Detail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../project/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

<div class="container">
<div class="col-lg-12">
<?php 
$sql="select * from blogs where id=$blogid";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_array($result);
?>

<h2><?php echo $data['title'];?></h2>
<p><?php echo $data['description'];?></p>
</div>

<div class="col-lg-12">
<h4>Comments</h4>
  
	<?php showComments($data['id']); 
  
  ?>
	
</div>
<?php 
  if(isset($_SESSION['user_id'])){?>
    
    <div class="col-lg-12" id="postcomment">
<h4 class="mt-4">Post Your Comment</h4>

<form method="post">
<input type="hidden" name="commentid" id="commentid">
<label>Name: <?php echo $user_data['name']; ?></label>
<input type="hidden" class="form-control" value="<?php echo $user_data['name']; ?>" name="name" >
<br>
<label>Comment</label>
<textarea class="form-control" name="description"></textarea>
<input type="submit" name="submit" class="btn btn-primary mt-2">
</form>
</div>
<?php
  }else
    echo"<h4 class='mt-4'>After log in you can comment and reply!</h4>";
  ?>

</div>


<script>
function reply(commentid)
{
	//alert(commentid);
	$("#commentid").val(commentid);
}
</script>

<?php
  include 'footer.php';

  ?>  
