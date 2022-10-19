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

<?php 
require_once('db.php');
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
		
		<!-- tweet block -->		
<?php 
		$like = mysqli_query($con, "SELECT * FROM likes WHERE user_id=".$user_id." AND post_id=".$row['posts_id']."");
			if (mysqli_num_rows($like) == 1 ): ?>
			<!-- user already likes post -->
				<span  style="color:#5dd418;"class="unlike fa fa-thumbs-up" data-id="<?php echo $row['posts_id']; ?>" data-user_id="<?php echo $user_id; ?>"></span> 
				<span  style="color:#5dd418;"class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['posts_id']; ?>" data-user_id="<?php echo $user_id; ?>"></span> 
	<?php else: ?>
			<!-- user has not yet liked post -->
				<span style="color:#5dd418;"class="like fa fa-thumbs-o-up" data-id="<?php echo $row['posts_id']; ?>" data-user_id="<?php echo $user_id; ?>"></span> 
				<span style="color:r#5dd418;" class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['posts_id']; ?>" data-user_id="<?php echo $user_id; ?>"></span> 
    <?php endif ?>
				<span  class="likes_count"><?php echo $row['likes']; ?> likes</span>
		<!--end tweet block-->
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

<script src="js/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var postid = $(this).data('id');
			    $post = $(this);
				user_id = $(this).data('user_id');
			$.ajax({
				url: 'like.php',
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid,	
					'user_id': user_id
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
			user_id = $(this).data('user_id');

			$.ajax({
				url: 'like.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid,
					'user_id': user_id
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