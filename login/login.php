<?php
require('connection.inc.php');
require('functions.inc.php');
$msg='';
if(isset($_POST['submit'])){
	$username=get_safe_value($con,$_POST['username']);
	$password=get_safe_value($con,$_POST['password']);
	$sql="select * from admin_users where username='$username' and password='$password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$username;
		header('location:categories.php');
		die();
	}else{
		$msg="Please enter correct login details";	
	}
	
}
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
	  <style>
	  .login-form {
           background: #fff;
           padding: 30px 30px 20px;
           border-radius: 2px
      }

      .login-form h4 {
           color: #878787;
           text-align: center;
           margin-bottom: 50px
      }

.login-form .checkbox {
    color: #878787
}

.login-form .checkbox label {
    text-transform: none
}

.login-form .btn {
    width: 100%;
    text-transform: uppercase;
    font-size: 14px;
    padding: 15px;
    border: 0
}

.login-form label {
    color: #878787;
    text-transform: uppercase
}

.login-form label a {
    color: #ff2e44
}
.login-content {
    max-width: 540px;
    margin: 20vh auto;
}
.field_error{
	color:red;
	margin-top:15px;
}
.bg-dark{
	background-color:#669cc787;
}

	  </style>
	   
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="http://localhost/login/css/style.css">
   </head>
    <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method="post">
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Login</button>
					</form>
					<div class="field_error"><?php echo $msg?></div>
               </div>
            </div>
         </div>
      </div>
      <script src="http://localhost/login/js/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="http://localhost/login/js/popper.min.js" type="text/javascript"></script>
      <script src="http://localhost/login/js/plugins.js" type="text/javascript"></script>
      <script src="http://localhost/login/js/main.js" type="text/javascript"></script>
   </body>
</html>