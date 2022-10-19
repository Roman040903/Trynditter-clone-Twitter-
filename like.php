<?php 
require_once('db.php');

if (isset($_POST['liked']))
	{
       $postid = $_POST['postid'];
	    $user_id = $_POST['user_id'];
		$query = "SELECT * FROM posts WHERE posts_id=$postid";
		$data = mysqli_query($con,$query);
			while($row = mysqli_fetch_assoc($data))
				{ $n = $row['likes']+1;}
		mysqli_query($con, "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $postid)");
		mysqli_query($con, "UPDATE posts SET likes=$n WHERE posts_id=$postid");

		echo $n;
		exit();
	}
	
if (isset($_POST['unliked']))
	{
       $postid = $_POST['postid'];
	    $user_id = $_POST['user_id'];
		$query = "SELECT * FROM posts WHERE posts_id=$postid";
		$data = mysqli_query($con,$query);
			while($row = mysqli_fetch_assoc($data))
				{ $n = $row['likes']-1;}
		mysqli_query($con, "DELETE FROM likes WHERE user_id=$user_id AND post_id=$postid");
		mysqli_query($con, "UPDATE posts SET likes=$n WHERE posts_id=$postid");

		echo $n;
		exit();
	}		
?>