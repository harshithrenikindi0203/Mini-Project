<?php 
require('connections.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$wishlist_count=0;
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
	$cat_arr[]=$row;
}
$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

if(isset($_SESSION['USER_LOGIN'])){
	$uid=$_SESSION['USER_ID'];
	
	if(isset($_GET['wishlist_id'])){
		$wid=get_safe_value($con,$_GET['wishlist_id']);
		mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
	}

	$wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
}
$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];

$meta_title="Five Little Monkeys";
$meta_desc="Five Little Monkeys";
$meta_keyword="Five Little Monkeys";
if($mypage=='product.php'){
	$product_id=get_safe_value($con,$_GET['id']);
	$product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
	$meta_title=$product_meta['meta_title'];
	$meta_desc=$product_meta['meta_desc'];
	$meta_keyword=$product_meta['meta_keyword'];
}if($mypage=='contact.php'){
	$meta_title='Contact Us';
}
?> 
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title?></title>
    <meta name="description" content="<?php echo $meta_desc?>">
	<meta name="keywords" content="<?php echo $meta_keyword?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mohave:ital,wght@0,700;1,300;1,500;1,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://themes.googleusercontent.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://assets.zendesk.com;">
    <link rel="preconnect" href="https://fonts.gstatic.com" >
    <link href="https://fonts.googleapis.com/css2?family=Mohave:ital,wght@0,700;1,300;1,500;1,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://localhost/ecom/css/style.css">
	<link rel="stylesheet" href="http://localhost/ecom/css/home.css">
	<link rel="stylesheet" href="http://localhost/ecom/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/ecom/css/owl.carousel.min.css">
    <link rel="stylesheet" href="http://localhost/ecom/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="http://localhost/ecom/css/core.css">
    <link rel="stylesheet" href="http://localhost/ecom/css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="http://localhost/ecom/css/responsive.css">
    <link rel="stylesheet" href="http://localhost/ecom/css/custom.css">
	<link rel="stylesheet" href="http://localhost/ecom/css/font-awesome.css">
	<link rel="stylesheet" href="http://localhost/ecom/css/jquery-ui.min.css">
    <link rel="stylesheet" href="http://localhost/ecom/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="http://localhost/ecom/fonts/Simple-Line-Icons.woff">
    <link rel="stylesheet" href="http://localhost/ecom/fonts/Simple-Line-Icons.woff2">
	
	<style>
	.htc__shopping__cart a span.htc__wishlist {
		background: #c43b68;
		border-radius: 100%;
		color: #fff;
		font-size: 9px;
		height: 17px;
		line-height: 19px;
		position: absolute;
		right: 18px;
		text-align: center;
		top: -4px;
		width: 17px;
	}
	</style>

	</head>

<body>
    <div class="header">

        <div class="container">
            <div class="navbar">

                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.php">Home</a></li>
					<?php
							foreach($cat_arr as $list){
					?>
						<li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
					<?php
						}
					?>
                        <li><a href="contact.php">Contact</a></li>
                        
                    </ul>
                </nav>
				         
                               <div class="header__right">
									<?php 
									$class="mr15";
									if(isset($_SESSION['USER_LOGIN'])){
										$class="";
									}
									?>
									<div class="header__search search search__open <?php echo $class?>">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
									
                                    <div class="header__account">
										<?php if(isset($_SESSION['USER_LOGIN'])){
											?>
											<nav class="navbar navbar-expand-lg navbar-light bg-light">
											   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
												<span class="navbar-toggler-icon"></span>
											  </button>

											  <div class="collapse navbar-collapse" id="navbarSupportedContent">
						                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
													<div class="dropdown-menu" aria-labelledby="navbarDropdown">
													  <a class="dropdown-item" href="my_order.php">Order</a>
													  <div class="dropdown-divider"></div>
													  <a class="dropdown-item" href="profile.php">Profile</a>
													  <div class="dropdown-divider"></div>
													  <a class="dropdown-item" href="logout.php">Logout</a>
													</div>
												</div>
											</nav>
											<?php
										}else{
											echo '<a href="login.php" class="mr15">Login/Register</a>';
										}
										?>
									</div>
          
                                    <div class="htc__shopping__cart">
										<?php
										if(isset($_SESSION['USER_ID'])){
										?>
										<a href="wishlist.php" class="mr15"><i class="icon-heart icons"></i></a>
                                        <a href="wishlist.php"><span class="htc__wishlist"><?php echo $wishlist_count?></span></a>
										<?php } ?>
                                        <a href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>
                                    </div>
                                </div>
								
                     
                <img src="http://localhost/ecom/img/menu.png" width="10px" height="20px" class="menu-icon" onclick="menutoogle()">
                            
            </div>
			<div class="body__overlay"></div>
		<div class="offset__wrapper">
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-2">
                    <h1>Shopping is <br>A Great relaxation!!</h1>
                    <p>Our online portal provides the great shopping experience without any troubles.<br>We also it
                        provides the best quality at reasonalble prices</p>
                    <br><br>
                    <a href="" class="btn">Explore Now &#10147;</a>
                </div>
                <div class="col-2">
                    <img src="http://localhost/ecom/img/logo2.png" width="400px" height="400px">
                </div>
            </div>
        </div>
    </div>