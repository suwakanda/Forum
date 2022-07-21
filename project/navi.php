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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Navbar with Logo Image</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../project/style.css">
</head>
<body>
<header>
        <h1>FORUM</h1>
    </header>
<div class="m-4">
    <nav class="nav1 navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a href="navi.php" class="navbar-brand">Forum
            
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="#" class="nav-item nav-link ">Home</a>
                    <a href="#" class="nav-item nav-link">conta</a>
                    <a href="#" class="nav-item nav-link">Messages</a>
                    <a href="#" class="nav-item nav-link " >Reports</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-item nav-link">Login</a>
                    
                </div>
            </div>
        </div>
    </nav>
</div>

<main>
    <div class="div1">
        <b>Forum</b>
        
        <div class="col-md-12 text-center">
        <a href="forum.php" class="btn btn-outline-light mt-2 ">Explore the forum</a>
        </div>
        
    </div>
</main>

    <?php 
    include 'footer.php';
    ?>  