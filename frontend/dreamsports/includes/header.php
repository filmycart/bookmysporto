<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title><?=($siteTitle)?$siteTitle:''?> - <?=($siteTagLine)?$siteTagLine:''?></title>
	<!-- Meta Tags -->
	<meta name="twitter:description" content="<?=($siteDescription)?$siteDescription:''?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?=($siteDescription)?$siteDescription:''?><?=($siteDescription)?$siteDescription:''?>">
	<meta name="keywords" content="<?=($siteKeyword)?$siteKeyword:''?>">
	<meta name="author" content="<?=($siteAuthor)?$siteAuthor:''?>">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@sportify">
	<meta name="twitter:title" content="<?=($siteTitle)?$siteTitle:''?> - <?=($siteSubTitle)?$siteSubTitle:''?>">
	<meta name="twitter:image" content="<?=$frontendAssetUrl?>assets/img/meta-image.jpg">
	<meta name="twitter:image:alt" content="<?=($siteTitle)?$siteTitle:''?>">

	<meta property="og:url" content="https://dev.sportify.filmycart.in">
	<meta property="og:title" content="<?=($siteTitle)?$siteTitle:''?> - <?=($siteSubTitle)?$siteSubTitle:''?>">
	<meta property="og:description" content="<?=($siteDescription)?$siteDescription:''?>">
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

    <!-- Override CSS -->
    <link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/css/override.css">
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
									<li><a href="index.php?pg-nm=events">Event</a></li>
									<li><a href="index.php?pg-nm=venues">Court</a></li>
									<li><a href="index.php?pg-nm=coaches">Coach</a></li>
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
                        $profileImage = "";
                        if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
                            if((isset($_SESSION['userImage'])) && (!empty($_SESSION['userImage']))) {
                                if($hostName == "localhost") {
                                    $profileImage = "/sportifyv2/admin/uploads/users/".$_SESSION['userImage'];
                                } else {
                                    $profileImage = $requestScheme.'://'.$hostName."/admin/uploads/users/".$_SESSION['userImage'];
                                }
                            } else {
                                $profileImage = $frontendAssetUrl."assets/img/profiles/avatar-05.jpg";
                            }
                    ?>     
                            <ul class="nav header-navbar-rht logged-in"> 
                                <li class="nav-item dropdown has-arrow logged-item">
                                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                        <span class="user-img">
                                            <img class="rounded-circle" src="<?=$profileImage?>" width="31" alt="Darren Elder">
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <div class="user-header">
                                            <div class="avatar avatar-sm">
                                                <img src="<?=$profileImage?>" alt="User" class="avatar-img rounded-circle">
                                            </div>
                                            <div class="user-text">
                                                <h6><?=(!empty($_SESSION['userName'])?$_SESSION['userName']:'')?></h6>
                                                <a href="index.php?pg-nm=my-profile" class="text-profile mb-0">Go to Profile</a>
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
                                    <div class="nav-link btn btn-primary log-register">
                                        <a href="#" data-toggle="modal" data-target="#login-form-modal" onclick="loginForm()"><span><i class="feather-users"></i></span>Login
                                        </a>
                                    </div>
                                    &nbsp;
                                    <div class="nav-link btn btn-primary log-register">
                                        <a href="#" data-toggle="modal" data-target="#register-form-modal" onclick="registerForm()"><span><i class="feather-users"></i></span>Register
                                        </a>
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
        <script src="<?=$frontendAssetUrl?>assets/js/jquery.validate.min.js"></script>
        <script src="<?=$frontendAssetUrl?>assets/js/jquery.validate.js"></script>
        <script>
            jQuery.noConflict();
            jQuery( document ).ready(function( $ ) {

                $('#userImageSpinnerDiv').hide();

                function removeA(arr, eventFileName) {
                    const myArray = arr.split(",");
                    position = myArray.indexOf(eventFileName);
                    delete myArray[position];
                    return myArray;
                }

                function delUserImage(eventFileName, respArray) {

                    $('#userImagePreview').html('');

                    respArr = removeA(respArray, eventFileName);
                    respArray1 = "'"+respArr+"'";

                    var formdata = new FormData(); 
        
                    formdata.append("userImgAction", "deleteEventImg");
                    formdata.append("eventFileName", eventFileName);
        
                    var respArray = new Array();
                    var respFileNameArray = new Array();
                    var respFileName = "";

                    $.ajax({
                        url: "././api/user/user-image.php", 
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formdata,
                        dataType: 'json',                         
                        type: 'POST',
                        success: function(php_script_response) {

                            var fileCount = respArr.length;

                            for (var index = 0; index < fileCount; index++) {
                                var src = "'"+respArr[index]+"'";
                                var src1 = respArr[index];
                                if((src != undefined) && (src1 != undefined)) {
                                    var delUserImage = 'onclick="delUserImage('+src+','+respArray1+')"';
                                    $('#userImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteUserImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delUserImage+'><i class="ion-trash-a"><i></a></div>');
                                    respFileNameArray[index] = src1;
                                }
                            }  

                            respFileName = respFileNameArray.toString();

                            $('#userImageHidden').val(respFileName);                
                        }
                    });
                }

                $('#userImageDel').click(function(e) {
                    console.log("delete file");
                });

                $('#userImage').change(function(e) {

                    $('#userImagePreview').html('');
                    $('#userImageError').html('');

                    var fileData = $('#userImage').prop('files')[0];   
                    var formdata = new FormData(); 

                    // Read selected files
                    var totalfiles = document.getElementById('userImage').files.length;
                    var userName = $('#userName').val();
                    var api_token = $('#api_token').val();

                    for (var index = 0; index < totalfiles; index++) {
                        formdata.append("files[]", document.getElementById('userImage').files[index]);
                    }   

                    if (formdata) {
                        formdata.append("api_token", api_token);
                        formdata.append("userImgAction", "upload");
                        formdata.append("userName", userName);
                    }

                    var respArray = new Array();
                    var errorRespArray = new Array();
                    var respFileNameArray = new Array();
                    var respFileName = "";
                    var protocol = window.location.protocol;
                    var hostName = window.location.host;
                    var pathname = window.location.pathname;

                    var hostUrl = '';
                    if(hostName == "localhost") {
                        hostUrl = protocol+'//'+hostName+pathname+'admin/uploads/users/';
                    } else {
                        hostUrl = protocol+'//'+'bookmysporto.com/admin/uploads/users/';
                    }                   

                    $.ajax({
                        url: "././api/user/user-image.php", 
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formdata,
                        dataType: 'json',                         
                        type: 'POST',
                        success: function(php_script_response) {
                            respArray = php_script_response['userImage'];
                            errorRespArray = php_script_response['userImageInvalid'];
                            respArray1 = "'"+php_script_response['userImage']+"'";
                            
                            if(respArray) {
                                var fileCount = respArray.length;

                                for (var index = 0; index < fileCount; index++) {
                                    var src = "'"+respArray[index]+"'";
                                    var src1 = respArray[index];
                                    var delUserImage = 'onclick="delUserImage('+src+','+respArray1+')"';

                                    //$('#userImagePreview').append('<div><a href ="'+hostUrl+src1+'" target="_blank" class="deleteUserImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delUserImage+'><i class="ion-trash-a"><i></a></div>');
                                    respFileNameArray[index] = src1;
                                }   

                                respFileName = respFileNameArray.toString();

                                $('#userImageHidden').val(respFileName);
                            } else if(errorRespArray) {
                                $('#userImageError').append(errorRespArray);
                            }
                        }
                    });      
                });

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
                                if(resp.status_code == 200) {
                                    $(form).html("<div id='message' style='color:green;'></div><div class='row'>&nbsp;</div>");
                                    $('#message').html(resp.message);
                                } else if(resp.status_code == 201) {
                                    $(form).html("<div id='err_message' style='color:red;'></div><div class='row'>&nbsp;</div>");
                                    $('#err_message').html(resp.message);
                                }

                                $('#haveanaccount').hide();                                

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
                        $.ajax({
                            type: "POST",
                            url: "./api/user/login.php",
                            data: $(form).serialize(),
                            success: function (resp) {
                                if(resp.status_code == 200) {
                                    $(form).html("<div id='message' style='color:green;'></div><div class='row'>&nbsp;</div>");
                                    $('#message').html(resp.message);
                                } else if(resp.status_code == 201) {
                                    $(form).html("<div id='err_message' style='color:red;'></div><div class='row'>&nbsp;</div>");
                                    $('#err_message').html(resp.message);
                                }

                                $('#haveanaccountlogin').hide();                                

                                setTimeout(function () {
                                    window.location.href='index.php?pg-nm=my-profile';
                                }, 1500);                            
                            }
                        });
                        return false; // required to block normal submit since you used ajax
                    }
                });
            });
        </script>
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
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                            <form id="userRegisterForm" name="userRegisterForm" method="POST" enctype="multipart/form-data" action="./././api/user/register.php">
                                <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
                                <input type="hidden" class="form-control" name="userType" id="userType" value="4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
                                        <input type="text" class="form-control" name="userName" id="userName" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="spacer-div"></div>
                                <div class="row">   
                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
                                        <input type="text" class="form-control" name="userPhoneNumber" id="userPhoneNumber" placeholder="Enter Phone Number">
                                    </div>
                                </div> 
                                <div class="spacer-div"></div>
                                <div class="row">   
                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
                                        <div id="userImageSpinnerDiv"><img src="./frontend/dreamsports/assets/img/loader.png" class="loader"></div>
                                        <div id="userImagePreview"></div>
                                        <div id="userImageError" style="color:red;"></div>
                                        <input type="hidden" name="userImageHidden" id="userImageHidden" />
                                        <input name="userImage" id="userImage" type="file" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding display-flex">
                                        <div>
                                            <input type="checkbox" name="isCoach" id="isCoach" value="1">
                                        </div>
                                        <div class="left-padding-5p top-padding-2p">
                                            <span class="userCatTypeClass">I am a Coach</span>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">   
                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
                                        <button class="btn btn-secondary register-btn d-inline-flex justify-content-center align-items-center w-100 btn-block" type="submit">Create Account<i class="feather-arrow-right-circle ms-2"></i></button>
                                    </div>
                                </div>                                    
                                <!-- <div class="form-group">
                                    <div class="login-options text-center">
                                        <span class="text">Or continue with</span>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <a href="google-oauth.php" class="google-login-btn">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512"><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>
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
                                </div> -->                          
                            </form>
                        </div>                            
                    </div>
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
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                        <form id="userLoginForm" name="userLoginForm" method="POST" enctype="multipart/form-data" action="./././api/user/login.php">
                            <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
                            <input type="hidden" class="form-control" name="userType" id="userType" value="4">
                            <div class="row">   
                                <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
                                    <input type="text" class="form-control" name="userPhoneNumber" id="userPhoneNumber" placeholder="Enter Phone Number">
                                </div>
                            </div>    
                            <div class="spacer-div"></div>        
                            <div class="row">   
                                <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
                                    <button class="btn btn-secondary register-btn d-inline-flex justify-content-center align-items-center w-100 btn-block" type="submit">Login<i class="feather-arrow-right-circle ms-2"></i></button>
                                </div>
                            </div>                                    
                            <!-- <div class="form-group">
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
                            </div>  -->                             
                        </form>
                    </div>                            
                </div>
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
<?php
    $requestScheme = "";
    if((isset($_SERVER['REQUEST_SCHEME'])) && (!empty($_SERVER['REQUEST_SCHEME']))) {
        $requestScheme = $_SERVER['REQUEST_SCHEME'];    
    }

    $hostName = "";
    if((isset($_SERVER['HTTP_HOST'])) && (!empty($_SERVER['HTTP_HOST']))) {
        $hostName = $_SERVER['HTTP_HOST'];  
    }

    $baseUrl = "";
    $stateUrl = "";
    if($hostName == "localhost") {
        $stateUrl = $requestScheme.'://localhost/sportifyv2/api/location/state.php';
    } else {
        $stateUrl = $requestScheme.'://bookmysporto.com/api/location/state.php';
    }

    $curlState = curl_init();

    $stateUrl = "";
    if($hostName == "localhost") {
        $stateUrl = $requestScheme.'://localhost/sportifyv2/api/location/state.php';
    } else {
        $stateUrl = $requestScheme.'://bookmysporto.com/api/location/state.php';
    }

    curl_setopt_array($curlState, array(
      CURLOPT_URL => $stateUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('api_token' => '123456789'),
      CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=u3igrqn5stlv226gqh17mokl9s'
      ),
    ));

    $stateResponse = curl_exec($curlState);

    $stateResponseArr = array();
    if(!empty($stateResponse)){
        $stateResponseArr = json_decode($stateResponse, true);
    }

    curl_close($curlState);

    $curlVenue = curl_init();

    $venueUrl = "";
    if($hostName == "localhost") {
        $venueUrl = $requestScheme.'://localhost/sportifyv2/api/venue/venue.php';
    } else {
        $venueUrl = $requestScheme.'://bookmysporto.com/api/venue/venue.php';
    }

    $postValArray = array(
                            'api_token' => '123456789'
                        );

    curl_setopt_array($curlVenue, array(
      CURLOPT_URL => $venueUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $postValArray,
      CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=u3igrqn5stlv226gqh17mokl9s'
      ),
    ));

    $venueResponse = curl_exec($curlVenue);

    $venueResponseArr = array();
    if(!empty($venueResponse)){
        $venueResponseArr = json_decode($venueResponse, true);
    }

    curl_close($curlVenue);

    $curlEventHomePage = curl_init();

    $eventUrlHomePage = "";
    if($hostName == "localhost") {
        $eventUrlHomePage = $requestScheme.'://localhost/sportifyv2/api/event/event.php';
    } else {
        $eventUrlHomePage = $requestScheme.'://bookmysporto.com/api/event/event.php';
    }

    $postValArray = array(
                            'api_token' => '123456789'
                        );

    curl_setopt_array($curlEventHomePage, array(
        CURLOPT_URL => $eventUrlHomePage,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postValArray,
        CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=u3igrqn5stlv226gqh17mokl9s'
        ),
    ));

    $eventResponseHomePage = curl_exec($curlEventHomePage);

    $eventResponseHomePageArr = array();
    if(!empty($eventResponseHomePage)) {
        $eventResponseHomePageArr = json_decode($eventResponseHomePage, true);
    }

    curl_close($curlEventHomePage);
?>