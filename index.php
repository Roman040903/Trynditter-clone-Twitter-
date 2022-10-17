<?php require_once "header.php"; ?>

<html>
<body>
     <?php
	 
	 $edit_id=$_GET['edit'];
	 $text_for_edit = $_GET['text'];
	 $Posts_Text = $_POST['post_text'];
	 $user_login = $_SESSION["user_login"];
	 
	 if(isset($_GET['logout'])) //exit session
	 {
		unset($_SESSION["user_login"]);
		unset($_SESSION['user_id']);
		header("location:index.php");
    }
    
	 if(isset($_POST['post_text']) && (!isset($_GET['edit'])) ) //ноий tweet
     {
        $sql = "INSERT INTO posts (posts_text, posts_date, user_login) VALUES('$Posts_Text',now(), '$user_login')";
        $result = mysqli_query($con,$sql);
		 if($sql){
            header("location:index.php");
        }
		
     }
	
    
    
	
     if(isset($_POST['post_text']) && (isset($_GET['edit'])) ) //редагування
     {
        $sql = "UPDATE posts SET posts_text='$Posts_Text' WHERE posts_id=$edit_id";
        $result = mysqli_query($con,$sql);
		 if($sql){
            header("location:index.php");
        }
    }
	
	if(isset($_GET['del'])) //Видалення
    {
        $Del_ID = $_GET['del'];
        $sql="delete from posts where posts_id='$Del_ID'";
        $post_query = mysqli_query($con,$sql);
        if($sql){
            header("location:index.php");
        }
    }

   //like
	if (isset($_GET['liked']) && isset($_SESSION['user_id'])) {
		$posts_id = $_GET['posts_id'];
		$user_id=$_SESSION['user_id'];
        $sql="UPDATE posts SET likes=likes+1 WHERE posts_id=$posts_id";
        $post_query = mysqli_query($con,$sql);
        $sql="INSERT INTO likes (user_id, post_id) VALUES ($user_id, $posts_id)";
        $post_query = mysqli_query($con,$sql);
        header("location:index.php");
        
	}
	
	  //unlike
	if (isset($_GET['unliked'])) {
		$posts_id = $_GET['posts_id'];
		$user_id=$_SESSION['user_id'];
		$sql="UPDATE posts SET likes=likes-1 WHERE posts_id=$posts_id";
        $post_query = mysqli_query($con,$sql);
        $sql="DELETE FROM likes WHERE user_id=$user_id AND post_id=$posts_id";
        $post_query = mysqli_query($con,$sql);
        header("location:index.php");
        
	}
	

    ?>

    <div class="grid-container">

    <?php require_once "left-sidebar.php";?>
    <div class="main">
       <div class="page_title">
    <p  ><?php if (isset($_GET['edit'])) echo 'Editing mode'; else echo 'Trynditter '; ?></p>
    
    <p style= "font-weight :  500; font-size: 17px;  font-style: italic;"> "Don't be afraid to speak" by Roman Yankevych</p>
    
    </div>
  <?php if (isset($_SESSION["user_login"])) 
    {;?>
        <div class="tweet__box tweet__add" >

            <div class="tweet_left">
              
            </div>
            <div class="tweet__body">
                <form method="post" enctype="multipart/form-data">
                <textarea name="post_text" id="" cols="100%" rows="3" placeholder='What is happening?'><?php echo $text_for_edit; ?></textarea>
                <div class="tweet__icons-wrapper">
                    <div class="tweet__icons-add">
                        <i class="far fa-images"></i>
                        <i class="far fa-chart-bar"></i>
                        <i class="far fa-smile"></i>
                        <i class="far fa-calendar-alt"></i>
                    </div>

                    <button class="button__tweet" type="submit" name="btn_add_post">Tryndit</button>
                </div>
                </form>
            </div>
        </div>
		<?php require_once "tweet.php" ?>
		</div>
		</div>
		<?php
	}
  require_once "right-sidebar.php"; ?>
   
    </body>
    