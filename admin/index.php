<?php
session_start();
include('inc/config.php');
include('inc/functions.php');
if(isset($_POST['login']))
{
    $email=stripslashes(trim($_POST['username']));
    $password=md5($_POST['password']);
    
	$email_new =xss_clean($email);
    
	
	$sql ="SELECT UserName,Password FROM admin WHERE UserName=:email_new and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email_new', $email_new, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        $_SESSION['alogin']=$_POST['username'];
        echo "<script type='text/javascript'> document.location = 'settings.php'; </script>";
    } else{
        echo "<script>alert('Invalid Details');</script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="css/login.css">
</style>
</head>
<body>

<form method="POST">

	<h2>Admin Login</h2>

	<input type="text" name="username" class="text-field" placeholder="Username" />
    <input type="password" name="password" class="text-field" placeholder="Password" />
    
  <a href=""><input type="submit"  class="button" value="Log In"  name='login'/></a>

</form>

</body>
</html>