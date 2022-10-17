<?php require_once "right-sidebar.php"; ?>
<?php

$query = "SELECT * FROM posts ORDER BY posts_id DESC";
$data = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($data))
{
    $posts_text = $row['posts_text'];
    $posts_date = $row['posts_date'];
	$user_login = $row['user_login'];
	$likes = $row['likes'];
	$user_id = $_SESSION['user_id'];
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
		
		
		<?php 
		
		$like = mysqli_query($con, "SELECT * FROM likes WHERE user_id=".$user_id." AND post_id=".$row['posts_id']."");
		if (mysqli_num_rows($like) >= 1 ):  
		 ?>
            <a href="index.php?unliked=1&posts_id=<?php echo $row['posts_id']; ?>"><span class="unlike fa fa-thumbs-up" data-id="<?php echo $likes; ?>"><?php echo " ".$likes; ?></span></a> 
			
		<?php else: ?>

			<a href="index.php?liked=1&posts_id=<?php echo $row['posts_id']; ?>"><span class="like fa fa-thumbs-o-up" data-id="<?php echo $likes; ?>"><?php echo " ".$likes; ?></span></a>

		<?php endif ?>	

	
	
						



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
<script src="jquery.min.js"></script>
<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var post_id = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'posts',
				data: {
					'liked': 1,
					'post_id': post_id
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var postid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'posts',
				data: {
					'unliked': 1,
					'postid': post_id
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>