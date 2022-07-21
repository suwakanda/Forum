<?php
include 'inc/header.php';
Session::CheckSession();


$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);

?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeBlog = $users->deleteBlogById($remove);
}

if (isset($removeBlog)) {
  echo $removeBlog;
}


$conn = mysqli_connect('localhost','root','','forum') or die('connection failed');
$sql="select * from blogs";
$result=mysqli_query($conn,$sql);


 ?>


 <div class="card ">
   <div class="card-header">
          <h3>User Profile <span class="float-right"> <a href="index.php" class="btn btn-primary">Back</a> </h3>
        </div>
        <div class="card-body pr-2 pl-2">

          <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center">Title id</th>
                      <th  class="text-center">Title</th>
                      <th  class="text-center">Author</th>
                      <th  class="text-center">Created</th> 
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $data=mysqli_fetch_array($result);

                  $allBlog = $blogs->selectAllBlog();
                    if ($allBlog) {
                      $i=0;
                      foreach ($allBlog as  $blog) {
                        $i++;
                     ?>
                  
                  <tr class="text-center">
                  
                    <td><?php echo $blog->id;?></td>
                    <td><a href="acomment.php?blogid=<?php echo $blog->id;?>"><?php echo $blog->title;?></a></td>
                    
                    <td><?php echo $blog->author; ?></td>
                    <td><?php echo $blog->addeddate; ?></td>
                    <td><a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger btn-sm " href="?remove=<?php echo $blog->id;?>">Remove</a>
                  
                  <?php }?>
                  <?php }?>
                  
                  
                  </tr>
                  </tbody>

                  
          </table>
        </div>
        </div>
      
    </div>


  <?php
  include 'inc/footer.php';

  ?>
