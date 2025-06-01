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

	<!-- Aos CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/aos/aos.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/fontawesome/css/all.min.css">

	<!-- Select CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/plugins/select2/css/select2.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/css/feather.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/css/style.css">
</head>
<body>
	<div id="global-loader" >
		<div class="loader-img">
			<img src="<?=$frontendAssetUrl?>assets/img/loader.png" class="img-fluid" alt="Global">
		</div>
	</div>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<!-- Header -->
		<header class="header header-trans">
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
							<img src="<?=$frontendAssetUrl?>assets/img/logo.svg" class="img-fluid" alt="Logo">
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
							<li <?=$pgHomeActive?>><a href="index.php">Home</a></li>
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

                            <?php
                                if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
                            ?>
                                    <li class="login-link">
                                        <a class="dropdown-item" href="index.php?pg-nm=my-profile">My Profile</a>
                                    </li>
                                    <li class="login-link">
                                        <a class="dropdown-item" href="index.php?pg-nm=logout">Logout</a>
                                    </li>

                            <?php        
                                } else {
                            ?>
                                    <li class="login-link">
                                        <a href="#" onclick="registerForm()">Sign Up</a>
                                    </li>
                                    <li class="login-link">
                                        <a href="#" onclick="loginForm()">Sign In</a>
                                    </li>
                            <?php
                                }
                            ?>							
						</ul>
					</div>
                    <?php
                        if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
                    ?>                    
                            <ul class="nav header-navbar-rht">
                                <li class="nav-item dropdown has-arrow logged-item">
                                    <a href="#" class="dropdown-toggle nav-link show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <span class="user-img">
                                            <img class="rounded-circle" src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-05.jpg" width="31" alt="Darren Elder">
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end show" data-bs-popper="static">
                                        <div class="user-header">
                                            <div class="avatar avatar-sm">
                                                <img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-05.jpg" height="50" width="50" alt="User" class="avatar-img rounded-circle">
                                            </div>
                                            <div class="user-text">
                                                <h6><?=(!empty($_SESSION['userName'])?$_SESSION['userName']:'')?></h6>
                                                <a href="user-profile.html" class="text-profile mb-0">Go to Profile</a>
                                            </div>
                                        </div>
                                        <p><a class="dropdown-item" href="index.php?pg-nm=logout">Logout</a></p>
                                    </div>
                                </li>
                            </ul>
                    <?php        
                        } else {
                    ?>
                            <ul class="nav header-navbar-rht">
                                <li class="nav-item">
                                    <div class="nav-link btn btn-white log-register">
                                        <a href="#" data-toggle="modal" data-target="#register-form-modal" onclick="registerForm()"><span><i class="feather-users"></i></span>Login/Register</a>
                                    </div>
                                </li>
                            </ul>        
                    <?php
                        }
                    ?>					
				</nav>
			</div>
		</header>
		<!-- /Header -->
		<script type="text/javascript">
			function registerForm() {
                $("#login-form-modal").modal('hide');
                $('#register-form-modal').modal('show');
                $('#register-modal-title-text').text('Register');
            }

            function registerFormClose() {
                $("#register-form-modal").modal('hide');
            }

            function loginForm() {
                $("#register-form-modal").modal('hide');
                $('#login-form-modal').modal('show');
                $('#login-modal-title-text').text('Login');
            }

            function loginFormClose() {
                $("#login-form-modal").modal('hide');
            }
	    </script>
        <script src="<?=$frontendAssetUrl?>assets/js/jquery.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
        <script src="<?=$frontendAssetUrl?>assets/js/jquery.validate.js"></script>
        <script>
            $.noConflict();
            jQuery( document ).ready(function( $ ) {
                //validate the register form when it is submitted
                $.validator.addMethod(
                    "mobileValidation",
                    function(value, element) {
                        return !/^\d{8}$|^\d{10}$/.test(value) ? false : true;
                    },
                    "Mobile number invalid"
                );
                
                //validate signup form on keyup and submit
                $("#userRegisterForm").validate({
                    rules: {
                        userName: {
                            required: true,
                            minlength: 5
                        },
                        userPhoneNumber: {
                            required: true,
                            minlength: 10,
                            maxlength: 25,
                            mobileValidation: $("#userPhoneNumber").val()
                        }
                    },
                    messages: {
                        userName: {
                            required: "Please enter your Name.",
                            minlength: "Please enter minimum 5 character for Name."
                        },
                        userPhoneNumber: {
                            required: "Please enter your Phone Number.",
                            minlength: "Please enter minimum 10 character for Phone Number.",
                            maxlength: "Please enter minimum 25 character for Phone Number."
                        }
                    },
                    // Make sure the form is submitted to the destination defined
                    // in the "action" attribute of the form when valid
                    submitHandler: function(form) {
                        $.ajax({
                            type: "POST",
                            url: "./api/user/register.php",
                            data: $(form).serialize(),
                            success: function (resp) {
                                $(form).html("<div id='message'></div><div class='row'>&nbsp;</div>");
                                $('#haveanaccount').hide();
                                $('#message').html(resp.message);

                                setTimeout(function () {
                                    window.location.href='index.php';
                                }, 1500);
                            }
                        });
                        return false; // required to block normal submit since you used ajax
                    }
                });

                $("#userLoginForm").validate({
                    rules: {
                        userPhoneNumber: {
                            required: true,
                            minlength: 10,
                            maxlength: 25,
                            mobileValidation: $("#userPhoneNumber").val()
                        }
                    },
                    messages: {
                        userPhoneNumber: {
                            required: "Please enter your Phone Number.",
                            minlength: "Please enter minimum 10 character for Phone Number.",
                            maxlength: "Please enter minimum 25 character for Phone Number."
                        }
                    },
                    // Make sure the form is submitted to the destination defined
                    // in the "action" attribute of the form when valid
                    submitHandler: function(form) {
                        //form.submit();
                        $.ajax({
                            type: "POST",
                            url: "./api/user/login.php",
                            data: $(form).serialize(),
                            success: function (resp) {
                                console.log(resp);
                                $(form).html("<div id='message'></div><div class='row'>&nbsp;</div>");
                                $('#haveanaccountlogin').hide();
                                $('#message').html(resp.message);

                                if(resp.status_code == 201) {
                                    setTimeout(function () {
                                       window.location.href='index.php';
                                    }, 1500);
                                } else {
                                    window.location.href='index.php';
                                }                                
                            }
                        });
                        return false; // required to block normal submit since you used ajax
                    }
                });
            });
        </script>
        <style>
            .nav {
                --bs-nav-link-padding-x: 1rem;
                --bs-nav-link-padding-y: 0.5rem;
                --bs-nav-link-font-weight: ;
                --bs-nav-link-color: var(--bs-link-color);
                --bs-nav-link-hover-color: var(--bs-link-hover-color);
                --bs-nav-link-disabled-color: var(--bs-secondary-color) rgba(33, 37, 41, 0.75);
                display: flex;
                flex-wrap: wrap;
                padding-left: 0;
                margin-bottom: 0;
                list-style: none;
                font-size: 12px;
            }

            .modal-header .close {
                margin-left: 88%;
                margin-top: -2px;
                border:0px solid #fff;
                background-color: #fff;
            }

            .close {
                margin-left: 88%;
                margin-top: -2px;
                border:0px solid #fff;
                background-color: #fff;
            }

            .hideModalDiv {
                dispaly:none;
            }

            .spinner {
                width:25px;
                height:25px;
            }

            .eventFormMainDiv {
                float:left;
                width:100%;
                border:0px solid red;
            }

            .eventFormRow {
                float:left;
                width:100%;
                border:0px solid red;
            }

            .eventFormCol {    
                float:left;
                width:48%;
                border:0px solid red;
            }

            .eventFormSpacerDiv { 
                 float:left;
                 width:1%;
            }
            .bootstrap-select > .dropdown-toggle {
                height: 38px ;
            }

            .multiselect-container>li>a>label {
                margin: 0;
                height: 100%;
                cursor: pointer;
                font-weight: 400;
                padding: 3px 20px 3px 10px;
            }

            .multiselect-container {
                position: absolute;
                list-style-type: none;
                margin: 0;
                padding: 0;
                min-width: 100% !important;
            }

            span.has-error {  
                color: red;                
            }

            form label.error {
                color: #c00;
                font-size: 12px;
            }

            form input.form-control, form textarea.form-control {
                padding: 10px;
                border-radius: 8px;
                background: #ffffff;
                /*opacity: 0.6;*/
                border: 1px solid #e9e5e5;
                font-size: 12px;
            }           

            form input.form-control:focus, form textarea.form-control:focus {
                background: #ffffff;
            }

            form input {
                height: 55px;
            }   
            
            .content.map-content .map-list-blk {
                padding: 0px 0px;
                width:100%;
                height:100%;
            }      

            .modal-body {
                border-radius: 10px !important;
                /*background-image: url("<?=$frontendAssetUrl?>assets/img/register_with_bg.jpg");*/
                background-repeat:no-repeat;
                background-size: 100%;
                background-position: inherit;
                width:100%;
                height:100%;
            }

            @media (min-width: 992px) {
                .modal-lg, .modal-xl {
                    --bs-modal-height: 300px;
                    --bs-modal-width: 350px;
                }
            }

            .close {
                margin-left: 95%;
                margin-top: 0px;
                border: 0px solid #fff;
                background-color: transparent;
            }

            .modal-header {
                border-bottom: 0px solid red;
            }    

            .row {
                --bs-gutter-x: 1.5rem;
                --bs-gutter-y: 0;
                display: flex;
                flex-wrap: wrap;
                margin-top: calc(-1 * var(--bs-gutter-y));
                margin-right: calc(-.5 * var(--bs-gutter-x));
                margin-left: 0px;
            }

            form input {
                height: 35px;
            }

            .btn-secondary {
                color: #FFFFFF;
                background: #192335;
                border-color: #192335;
                height: 35px;
                font-size:12px;
            }

            .userCatTypeClass{
                font-size:12px;
            }

            .text-center {
                text-align: center !important;
                font-size: 12px;
            }

            .shadow-card {
                background: #FFFFFF;
                border-radius: 10px;
                padding: 0px;
                box-shadow: 0px 4px 44px rgba(211, 211, 211, 0.25);
            }

            #message {
                font-size: 12px;    
            }

            .header .header-navbar-rht.logged-in > li .dropdown-menu.show {
                margin-top: 0;
                padding: 15px;
            }

            .header .header-navbar-rht.logged-in > li .dropdown-menu {
                min-width: 200px;
                border-radius: 6px;
            }

            .avatar-sm {
                width: 2.5rem;
                height: 2.5rem;
            }    
        </style>
	    <div class="modal fade" id="register-form-modal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <button type="button" class="close" onclick="registerFormClose()" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>   
                        </div>    
                    </div>
                    <!-- <div class="shadow-card"> -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                                <form id="userRegisterForm" name="userRegisterForm" method="POST" enctype="multipart/form-data" action="./././api/user/register.php">
                                    <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
                                    <input type="hidden" class="form-control" name="userType" id="userType" value="4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" class="form-control" name="userName" id="userName" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="row">&nbsp;</div>
                                    <div class="row">   
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" class="form-control" name="userPhoneNumber" id="userPhoneNumber" placeholder="Enter Phone Number">
                                        </div>
                                    </div>            
                                     <div class="row">&nbsp;</div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="checkbox" name="userCatType" id="userCatType">
                                            <span class="userCatTypeClass">I am a Coach</span>
                                        </div>
                                    </div>
                                    <div class="row">&nbsp;</div>
                                    <div class="row">   
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <button class="btn btn-secondary register-btn d-inline-flex justify-content-center align-items-center w-100 btn-block" type="submit">Create Account<i class="feather-arrow-right-circle ms-2"></i></button>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <div class="login-options text-center">
                                            <span class="text">Or continue with</span>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <?php
                                            /*require_once 'vendor/autoload.php';

                                            $id_token = "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";

                                            // Get $id_token via HTTPS POST.
                                            $WEB_CLIENT_ID = "128065069669-fj47pvbnokrv2tvra4h1ebihr3qob570.apps.googleusercontent.com";
                                            $client = new Google_Client(['client_id' => $WEB_CLIENT_ID]);  // Specify the WEB_CLIENT_ID of the app that accesses the backend
                                            $payload = $client->verifyIdToken($id_token);
                                            if ($payload) {
                                              $userid = $payload['sub'];
                                              // If the request specified a Google Workspace domain
                                              //$domain = $payload['hd'];
                                            } else {
                                              // Invalid ID token
                                            }*/

                                        ?>
                                        <a href="google-oauth.php" class="google-login-btn">
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>
                                            </span>
                                            Login with Google
                                        </a>
                                        <ul class="social-login d-flex justify-content-center align-items-center">
                                            <li class="text-center">
                                                <button type="button" class="btn btn-social d-flex align-items-center justify-content-center">
                                                    <img src="<?=$frontendAssetUrl?>assets/img/icons/google.svg" class="img-fluid" alt="Google">
                                                </button>
                                            </li>
                                            <li class="text-center">
                                                <button type="button" class="btn btn-social d-flex align-items-center justify-content-center">
                                                    <img src="<?=$frontendAssetUrl?>assets/img/icons/facebook.svg" class="img-fluid" alt="Facebook">
                                                </button>
                                            </li>
                                        </ul>
                                    </div>                              
                                </form>
                            </div>                            
                        </div>
                    <!-- </div> -->
                    <div class="bottom-text text-center" id="haveanaccount">
                        Have an account? <a href="#" onclick="loginForm()">Sign In!</a>
                    </div>
                </div>                    
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /.card-header -->
    <div class="modal fade" id="login-form-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <button type="button" class="close" onclick="loginFormClose()" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>   
                    </div>    
                </div>
                <!--<div class="shadow-card">-->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                            <form id="userLoginForm" name="userLoginForm" method="POST" enctype="multipart/form-data" action="./././api/user/login.php">
                                <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
                                <input type="hidden" class="form-control" name="userType" id="userType" value="4">
                                <div class="row">   
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" name="userPhoneNumber" id="userPhoneNumber" placeholder="Enter Phone Number">
                                    </div>
                                </div>            
                                <div class="row">&nbsp;</div>
                                <div class="row">   
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <button class="btn btn-secondary register-btn d-inline-flex justify-content-center align-items-center w-100 btn-block" type="submit">Login<i class="feather-arrow-right-circle ms-2"></i></button>
                                    </div>
                                </div>                                    
                                <div class="form-group">
                                    <div class="login-options text-center">
                                        <span class="text">Or continue with</span>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <ul class="social-login d-flex justify-content-center align-items-center">
                                        <li class="text-center">
                                            <button type="button" class="btn btn-social d-flex align-items-center justify-content-center">
                                                <img src="<?=$frontendAssetUrl?>assets/img/icons/google.svg" class="img-fluid" alt="Google">
                                            </button>
                                        </li>
                                        <li class="text-center">
                                            <button type="button" class="btn btn-social d-flex align-items-center justify-content-center">
                                                <img src="<?=$frontendAssetUrl?>assets/img/icons/facebook.svg" class="img-fluid" alt="Facebook">
                                            </button>
                                        </li>
                                    </ul>
                                </div>                              
                            </form>
                        </div>                            
                    </div>
                <!--</div>-->
                <div class="bottom-text text-center" id="haveanaccountlogin">
                    Dont have an account? <a href="#" onclick="registerForm()">Sign Up!</a>
                </div>
            </div>                     
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.card-header -->