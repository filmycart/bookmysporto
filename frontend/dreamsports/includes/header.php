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
	<meta name="twitter:image" content="assets/img/meta-image.jpg">
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
							<div class="nav-link btn btn-white log-register">
                                <a href="#" data-toggle="modal" data-target="#register-form-modal" onclick="registerForm()"><span><i class="feather-users"></i></span>Register</a>
							</div>
						</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link btn btn-secondary" data-toggle="modal" data-target="#login-form-modal" onclick="loginForm()"><span><i class="feather-users"></i></span>Login</a>
                        </li>
						<!-- <li class="nav-item">
							<a class="nav-link btn btn-secondary" href="add-court.html"><span><i class="feather-check-circle"></i></span>List Your Court</a>
						</li> -->
					</ul>
				</nav>
			</div>
		</header>
		<!-- /Header -->
		<script type="text/javascript">
			function registerForm() {
                $('#register-form-modal').modal('show');
                $('#register-modal-title-text').text('Register');
            }

            function registerFormClose() {
                $("#register-form-modal").modal('hide');
            }

            function loginForm() {
                $('#login-form-modal').modal('show');
                $('#login-modal-title-text').text('Login');
            }

            function loginFormClose() {
                $("#login-form-modal").modal('hide');
            }
	    </script>
	    <div class="modal fade" id="register-form-modal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
<!--                 <div class="modal-header">
                  <h4 class="modal-title"><span id="register-modal-title-text"></span></h4>
                  <button type="button" class="close" onclick="registerFormClose()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> -->
                <div class="modal-body">
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
                                  //form.submit();
                                  $.ajax({
                                     type: "POST",
                                     url: "./api/user/register.php",
                                     data: $(form).serialize(),
                                     success: function (resp) {
                                        console.log(resp);
                                         $(form).html("<div id='message'></div>");
                                         $('#message').html("<h2>"+resp.message+"</h2>")
                                             //.append("<p></p>")
                                             .hide()
                                             .fadeIn(1500, function () {
                                             //$('#message').append("<img id='checkmark' src='images/ok.png' />");
                                         });
                                     }
                                 });
                                 return false; // required to block normal submit since you used ajax
                                }
                            });
                        });
                    </script>
                    <style>
                        form label.error {
                            color: #c00;
                        }

                        .modal-header .close {
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
                    </style>
                    <div class="content map-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-7">
                                    <div class="map-list-blk">
                                        left
                                    </div>
                                </div>
                                <div class="col-xl-5 map-right">
                                    <form id="userRegisterForm" name="userRegisterForm" method="POST" enctype="multipart/form-data" action="./././api/user/register.php">
                                        <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
                                        <input type="hidden" class="form-control" name="userType" id="userType" value="4">
                                        <div class="row">
                                            <label for="first-name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="userName" id="userName" placeholder="Enter Name">
                                        </div>
                                        <div class="row">   
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="userPhoneNumber" id="userPhoneNumber" placeholder="Enter Phone Number">
                                        </div>    
                                        <div class="row">
                                            <button type="submit" id="userRegisterSubmit" name="userRegisterSubmit" class="btn btn-primary">Save</button>
                                        </div>    
                                    </form>
                                </div>
                            </div>
                        </div>
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
                <div class="modal-header">
                  <h4 class="modal-title"><span id="login-modal-title-text"></span></h4>  
                  <button type="button" class="close" onclick="loginFormClose()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>                  
                </div>
                <div class="modal-body">
                    <style>
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
                    </style>
                    <form id="userLoginForm" name="userLoginForm" method="POST" enctype="multipart/form-data" action="./././api/user/login.php">
                        <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
                        <input type="hidden" class="form-control" name="userType" id="userType" value="4">
                        <div class="venueFormMainDiv" id="modal-div"> 
                            <div class="venueFormRow">
                                <div class="eventFormCol">
                                    <label>Phone Number</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <input type="text" id="userPhoneNumber" name="userPhoneNumber" class="form-control" data-target="#userPhoneNumber" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer right-content-between">
                              <button type="submit" id="userLoginSubmit" name="userLoginSubmit" class="btn btn-primary">Save</button>
                            </div>  
                        </div>
                    </form>        
                </div>                    
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /.card-header -->