<?php
$realm = 'Restricted area';

//user => password
$users = array('admin123' => 'admin123', 'guest' => 'guest');


if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

    die('Text to send if user hits Cancel button');
}


// analyze the PHP_AUTH_DIGEST variable
if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
    !isset($users[$data['username']]))
    die('Wrong Credentials!');


// generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] != $valid_response)
    die('Wrong Credentials!');

// ok, valid username & password
//echo 'You are logged in as: ' . $data['username'];


// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}
?>


<?php

function check_login($conn)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from tbl_users where id = '$id' limit 1";

		$result = mysqli_query($conn,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

}

function showComments()
{
	$comment="";
	
	$comment.=commenttree();
	
	echo $comment;
}

function commenttree($parentid=NULL)
{
	$comments='';
	$sql='';
	$blogid=$_GET['blogid'];
	
	if(is_null($parentid))
	{
	$sql="select * from comments where comment_id='0' AND blog_id=$blogid ";
	}
	else 
	{
		$sql="select * from comments where comment_id=$parentid AND blog_id=$blogid";
	}
	
	
	$result=mysqli_query($GLOBALS['conn'],$sql);
	
	while($data=mysqli_fetch_array($result))
	{
		// echo $data['comment_id'];
		
		// echo '<pre>';
		// print_r($data);
		
		
		if($data['comment_id']=='0')
		{
		 $comments.='
		 <div class="media border comment0 p-3">
    <div class="media-body">
      <h4>'.$data['name'].'<small><i> Posted on '.$data['date'].'</i></small></h4>
     
	 '.$data['description'].'
      
	  <p><a href="#postcomment" class="btn btn-primary mt-2 float-right" onclick="reply('.$data['id'].')">reply</a></p>
	 </div>
	 </div>
	  ';
		}
		else 
		{
			$comments.='<div class="media border reply p-3">
    <div class="media-body">
      <h4>'.$data['name'].'<small><i> Posted on '.$data['date'].'</i></small></h4>
     
	 '.$data['description'].'
      
	  <p><a href="#postcomment" class="btn btn-primary mt-2 float-right" onclick="reply('.$data['id'].')">reply</a></p>
	  </div>
	  </div>
	  ';
		}
	  	

        $comments.='<div class="media  parent  p-3">
    <div class="media-body">'.commenttree($data['id']).'</div></div>';

		}
	
	return $comments;

}



?>