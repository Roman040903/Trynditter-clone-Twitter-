<?php require_once "right-sidebar.php"; ?>
<?php

$query = "SELECT * FROM posts ORDER BY posts_id DESC";
$data = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($data))
{
    $posts_text = $row['posts_text'];
    $posts_date = $row['posts_date'];
	$user_login = $row['user_login'];
  

?>
<div class="tweet_box">
    <div class="tweet__left">
    <img src="images\Trynditter.jpg" alt="">
    </div>
    <div class="tweet__body">
        <div class="tweet__header">
            <p class="tweet__name"><?php echo $user_login; ?> </p>
           
            <p class="tweet__date"><?php echo '&nbsp'.$posts_date; ?></p>    
         </div>   

   
        <p class="tweet__text"><?php echo $posts_text; ?></p>
        <div class="tweet__icons">
            <a href=""><i class="far fa-comment"></i></a>
            <a href=""><i class="fa fa-reply"></i></a>
            <a href=""><i class="far fa-heart"></i></a>
            <a href=""><i class="fa fa-upload"></i></a>
            <a href=""><i class="far fa-chart-bar"></i></a>
    </div>
    
    

	<div class="tweet_del" <?php if ($user_login <> $_SESSION["user_login"]) echo 'hidden' ?>>
        <div class="dropdown">
        <button   button class="dropbtn"><span class="fa fa-ellipsis-h"></span></button>
			<div class="dropdown-content">
				<a href="index.php?del=<?php echo $row['posts_id']; ?>"><i class="far fa-trash-alt"></i><span>Delete</span></a>
				<a href="index.php?edit=<?php echo $row['posts_id']; ?>&text=<?php echo $posts_text; ?>"><i class="far fa-edit"></i><span>Edit</span></a>
			</div>
	    </div>
    </div>
</div>



</div>
<?php
}
?>