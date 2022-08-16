<?php require_once "header.php"; ?>
<?php
if(isset($_POST['login']) && isset($_POST['password'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    //$query="INSERT INTO users(login,password)VALUES('$login','$password')";
    $query="SELECT * FROM users WHERE login='$login' and password='$password'";
	$result=mysqli_query($con,$query);
	if ($result->num_rows > 0) $_SESSION['user_login']=$login;
	header("location:index.php");
}

?>
<div class="form" >
    <div class="waper" <?php if (isset($_SESSION["user_login"])) echo 'hidden';?>>
<form method="POST" >
<div class="field">
    <p class="Logger">Login</p>
	<p style='color:red;'><?php if (($result->num_rows == 0) && (isset($_POST['login']))) echo 'Wrong Login or Password'; ?></p>
<input class="inlog" type="text" name="login"  placeholder="Login"required>
</div>
<div class="field">
<p class="Pass">Password</p>
<input  class="inpass" type="password" name="password" placeholder="Password"required>
</div>
<div class="field">
<button  class="btnn"type="submit">Enter the system</button>
</div>
</form>
</div>

<div>
<?php if (isset($_SESSION["user_login"]))
   {	
	 echo 'Ви увійшли як '.$_SESSION['user_login'];
     echo '<br><a href="index.php?logout"><button  class="btnn">Exit the system </button></a>';
   } 
   ?>
</div>


</div>

