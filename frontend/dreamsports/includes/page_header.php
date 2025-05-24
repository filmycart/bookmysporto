<?php 
	/*echo "frontendAssetUrl-".$frontendAssetUrl;
	exit;*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title><?=($siteTitle)?$siteTitle:''?> - <?=($siteTagLine)?$siteTagLine:''?></title>
	<!-- Meta Tags -->
	<meta name="twitter:description" content="Elevate your badminton business with Dream Sports template. Empower coaches & players, optimize court performance and unlock industry-leading success for your brand.">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="Elevate your badminton business with Dream Sports template. Empower coaches & players, optimize court performance and unlock industry-leading success for your brand.">
	<meta name="keywords" content="badminton, coaching, event, players, training, courts, tournament, athletes, courts rent, lessons, court booking, stores, sports faqs, leagues, chat, wallet, invoice">
	<meta name="author" content="<?=($siteAuthor)?$siteAuthor:''?>">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@dreamguystech">
	<meta name="twitter:title" content="DreamSports -  Booking Coaches, Venue for tournaments, Court Rental template">

	<meta name="twitter:image" content="<?=$frontendAssetUrl?>assets/img/meta-image.jpg">
	<meta name="twitter:image:alt" content="DreamSports">

	<meta property="og:url" content="https://dreamsports.dreamguystech.com/">
	<meta property="og:title" content="DreamSports -  Booking Coaches, Venue for tournaments, Court Rental template">
	<meta property="og:description" content="Elevate your badminton business with Dream Sports template. Empower coaches & players, optimize court performance and unlock industry-leading success for your brand.">
	<meta property="og:image" content="<?=$frontendAssetUrl?>/assets/img/meta-image.jpg">
	<meta property="og:image:secure_url" content="<?=$frontendAssetUrl?>assets/img/meta-image.jpg">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="600">

	<link rel="shortcut icon" type="image/x-icon" href="<?=$frontendAssetUrl?>assets/img/favicon.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?=$frontendAssetUrl?>assets/img/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?=$frontendAssetUrl?>assets/img/apple-touch-icon-152x152.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/css/bootstrap.min.css">

	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/owl-carousel/owl.theme.default.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/fontawesome/css/all.min.css">

	<!-- Select CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/select2/css/select2.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/css/feather.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/css/style.css">

	<style type="text/css">
		.details {
			box-shadow: 0px 4px 44px rgba(211, 211, 211, 0.25);
			padding: 24px;
		}

		.details i {
		    width: 80px;
		    min-width: 80px;
		    height: 80px;
		    background: linear-gradient(93.86deg, #006177 -2.6%, #269089 67.39%, #7ABC82 110.84%);
		    border-radius: 10px;
		    font-size: 33px;
		    color: #FFFFFF;
		}

		.details .info {
    		margin-top: 15px;
    		margin-left: 15px;
		}

		form.contact-us {
    		padding: 24px;
    		background: #FFFFFF;
		}

		.contact-group .google-maps {
    		width: 100%;
		}
	</style>
</head>
<body>
	<div id="global-loader" >
		<div class="loader-img">
			<img src="<?=$frontendAssetUrl?>assets/img/loader.png" class="img-fluid" alt="Global">
		</div>
	</div>

	<!-- Main Wrapper -->
	<div class="main-wrapper aboutus-page">
		<!-- Header -->
		<header class="header header-sticky">
			<div class="container-fluid">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="index.php" class="navbar-brand logo">
							<img src="<?=$frontendAssetUrl?>assets/img/logo-black.svg" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="index.php" class="menu-logo">
								<img src="<?=$frontendAssetUrl?>assets/img/logo-black.svg" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
						</div>
						<ul class="main-nav">
							<li><a href="index.php">Home</a></li>
							<li class="has-submenu">
								<a href="#">Book <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li><a href="index.php?pg-nm=event">Event</a></li>
									<li><a href="index.php?pg-nm=venue">Venue</a></li>
									<li><a href="index.php?pg-nm=coach">Coach</a></li>
								</ul>
							</li>		
							<li <?=$pgAboutActive?>><a href="index.php?pg-nm=about-us">About Us</a></li>
							<li <?=$pgContactActive?>><a href="index.php?pg-nm=contact-us">Contact Us</a></li>
							<li class="login-link">
								<a href="index.php?pg-nm=register">Sign Up</a>
							</li>
							<li class="login-link">
								<a href="index.php?pg-nm=login">Sign In</a>
							</li>
						</ul>
					</div>
					<ul class="nav header-navbar-rht">
						<li class="nav-item">
							<div class="nav-link btn btn-primary log-register">
								<a href="index.php?pg-nm=login"><span><i class="feather-users"></i></span>Login</a> / <a href="index.php?pg-nm=register">Register</a>
							</div>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link btn btn-secondary" href="add-court.html"><span><i class="feather-check-circle"></i></span>List Your Court</a>
						</li> -->
					</ul>
				</nav>
			</div>
		</header>
		<!-- /Header -->