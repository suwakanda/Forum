<?php
include 'inc/header.php';
Session::CheckSession();

$blogid=$_GET['blogid'];

$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);

?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeComment = $users->deletecommentById($remove);
}

if (isset($removeComment)) {
  echo $removeComment;
}



 ?>


 <div class="card ">
   <div class="card-header">
          <h3>User Profile <span class="float-right"> <a href="index.php" class="btn btn-primary">Back</a> </h3>
        </div>
        <div class="card-body pr-2 pl-2">

          <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center">NO</th>
                      <th  class="text-center">Name </th>
                      <th  class="text-center">description</th>
                      <th  class="text-center">Created</th> 
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $Comment = $blogs->selectCommentByid($blogid);
                    if ($Comment) {
                      $i=0;
                      foreach ($Comment as  $data) {
                        $i++;
                     ?>
                  
                  <tr class="text-center">
                    <td><?php echo $i?></td>
                    <td><?php echo $data->name; ?></td>
                    <td><?php echo $data->description; ?></td>
                    <td><?php echo $data->date; ?></td>
                    <td><a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger btn-sm " href="?remove=<?php echo $data->id;?>">Remove</a>
                  <?php }?>
                  <?php }?>

                  </tr>
                  </tbody>
          </table>
        </div>

    </div>


  <?php
  include 'inc/footer.php';

  ?>
