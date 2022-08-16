<?php require_once "header.php"; ?>

<html>
<body>
     <?php
	 //if (isset($_SESSION["user_login"])) echo 'user_login_Isset';
	 $edit_id=$_GET['edit'];
	 $text_for_edit = $_GET['text'];
	 $Posts_Text = $_POST['post_text'];
	 $user_login = $_SESSION["user_login"];
	 
	 if(isset($_GET['logout'])) //exit session
	 {
		unset($_SESSION["user_login"]);
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
   
    ?>

    <div class="grid-container">

    <?php require_once "left-sidebar.php";?>
    <div class="main">
    <p class = "page_title"><?php if (isset($_GET['edit'])) echo 'Editing mode'; else echo 'Trynditter'; ?></p>
        <div class="tweet__box tweet__add" <?php if (!isset($_SESSION["user_login"])) echo 'hidden';?> >

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
    <?php require_once "right-sidebar.php";?>
   
    </body>
    