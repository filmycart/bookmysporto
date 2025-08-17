		<?php
			include("includes/page_header.php");
			include("././validate_login.php");

			/*$curlUserProfile = curl_init();

		    $userProfileUrl = "";
		    if($hostName == "localhost") {
		        $userProfileUrl = $requestScheme.'://localhost/bookmysporto/api/user/user-profile.php';
		    } else {
		        $userProfileUrl = $requestScheme.'://bookmysporto.com/api/user/user-profile.php';
		    }

		    $postValArray = array(
		                            'api_token' => '123456789',
		                            'user_id' => $_SESSION['userName']
		                        );

		    curl_setopt_array($curlUserProfile, array(
		        CURLOPT_URL => $userProfileUrl,
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

		    $responseUserProfile = curl_exec($curlUserProfile);

		    $userProfilePageArr = array();
		    if(!empty($responseUserProfile)) {
		        $userProfilePageArr = json_decode($responseUserProfile, true);
		    }

		    curl_close($curlUserProfile);*/
		?>
		<!-- Breadcrumb -->
		<section class="breadcrumb breadcrumb-list mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h1 class="text-white">My Profile</h1>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li >My Profile</li>
				</ul>
			</div>
		</section>
		<!-- /Breadcrumb -->
		<!-- Dashboard Menu -->
		<div class="dashboard-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="dashboard-menu">
							<ul>
								<li>
									<a href="index.php?pg-nm=my-profile" class="active">
										<img src="<?=$frontendAssetUrl?>assets/img/icons/dashboard-icon.svg" alt="Icon">
										<span>Dashboard</span>
									</a>
								</li>
								<li>
									<a href="index.php?pg-nm=my-booking">
										<img src="<?=$frontendAssetUrl?>assets/img/icons/booking-icon.svg" alt="Icon">
										<span>My Bookings</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Dashboard Menu -->
		<script src="<?=$frontendAssetUrl?>assets/js/jquery.js"></script>
	    <script src="<?=$frontendAssetUrl?>assets/js/jquery.validate.min.js"></script>
	    <script src="<?=$frontendAssetUrl?>assets/js/jquery.validate.js"></script>
		<script type="text/javascript" src="<?=$frontendAssetUrl?>assets/js/thickbox.js"></script>
		<link rel="stylesheet" href="<?=$frontendAssetUrl?>assets/css/thickbox.css" media="screen" />
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
	            $("#profileForm").validate({
	                rules: {
	                    profileName: {
	                        required: true,
	                        minlength: 5
	                    },
	                    profilePhone: {
	                        required: true,
	                        minlength: 10,
	                        maxlength: 25,
	                        mobileValidation: $("#profilePhone").val()
	                    },
	                    profileInfo: {
	                        required: true,
	                        minlength: 25,
	                        maxlength: 1000
	                    }
	                },
	                messages: {
	                    profileName: {
	                        required: "Please enter your Name.",
	                        minlength: "Please enter minimum 5 character for Name."
	                    },
	                    profilePhone: {
	                        required: "Please enter your Phone Number.",
	                        minlength: "Please enter minimum 10 digits for Phone Number."
	                    },
	                    profileInfo: {
	                        required: "Please enter your Information.",
	                        minlength: "Please enter minimum 25 for Information.",
	                        maxlength: "Please enter minimum 100 for Information."
	                    },
	                },
	                // Make sure the form is submitted to the destination defined
	                // in the "action" attribute of the form when valid
	                submitHandler: function(form) {
						$.ajax({
							type: "POST",
							url: "./api/user/user-profile.php",
							data: $(form).serialize(),
							success: function (resp) {
								$(form).html("<div id='message'></div>");
								$('#message').html("<h2>"+resp.message+"</h2>")
									.hide()
									.fadeIn(1500, function () {
								});
							}
						});
						return false; // required to block normal submit since you used ajax
	                }
	            });
	        });
	    </script>
		<!-- Page Content -->
		<div class="content court-bg">
			<div class="container">
				<div class="coach-court-list profile-court-list">
					<ul class="nav">
						<li>
							<a href="index.php?pg-nm=upd-profile" class="active">
								<!-- <i class="feather-edit-3"></i> -->
								Update Profile
							</a>
						</li>	
					</ul>
				</div>
				<?php
					/*$a = array(9, 4, 9, 6, 7, 4);

					$finArr = array_unique(array_diff_assoc($a, array_unique($a)));	
					$finArr = array_diff($a, $finArr);				

					print"<pre>";
					print_r($finArr);
					exit;*/

					/*function get_duplicates ($array) {
						$diff = array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
						$finarr = array_diff($array, $diff);
						return $finarr;	
					}

					$fin = get_duplicates ($a);*/					
				?>
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-detail-group">
							<div class="card">
								<form id="profileForm" name="profileForm" class="contact-us" method="POST" action="">
									<input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
									<div class="row">
										<div class="col-md-12">
											<div>
												<label class="form-label">Profile Image</label>
											</div>	
											<div>
												<?php
													$profileImage = "";
													if($hostName == "localhost") {
														if((isset($userProfilePageArr['data']['image'])) && (!empty($userProfilePageArr['data']['image']))) {
															$profileImage = "/bookmysporto/admin/uploads/users/".$userProfilePageArr['data']['image'];
														} else {
															$profileImage = $frontendAssetUrl."assets/img/profiles/avatar-05.jpg";
														}
													} else {
														if((isset($userProfilePageArr['data']['image'])) && (!empty($userProfilePageArr['data']['image']))) {
															$profileImage = $requestScheme.'://'.$hostName."/admin/uploads/users/".$userProfilePageArr['data']['image'];
														} else {
															$profileImage = $requestScheme.'://'.$hostName."/frontend/dreamsports/assets/img/profiles/avatar-05.jpg";
														}
													}
												?>
												<span>
													<a href="<?=$profileImage?>" title="" class="thickbox">
		                                            	<img class="user-profile-img rounded-circle2" src="<?=$profileImage?>" width="31" alt="User Profile Image">
		                                            </a>
		                                        </span>
		                                    </div>    
										</div>
										<div class="spacer-div"></div>
										<div class="col-lg-4 col-md-6">
											<div>
												<label class="form-label">Name</label>
											</div>	
											<div>
												<span name="profileName" id="profileName">
													<?php
														if((isset($userProfilePageArr['data']['name'])) && (!empty($userProfilePageArr['data']['name']))) {
															echo $userProfilePageArr['data']['name'];
														}
													?>													
												</span>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div>
												<label class="form-label">Phone Number - (User Name)</label>
											</div>
											<div>	
												<span name="profilePhone" id="profilePhone">
													<?php
														if((isset($userProfilePageArr['data']['username'])) && (!empty($userProfilePageArr['data']['username']))) {
															echo $userProfilePageArr['data']['username'];
														}
													?>
												</span>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content -->
		<?php
			include("includes/page_footer.php");
		?>
		<script src="<?=$frontendAssetUrl?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?=$frontendAssetUrl?>assets/plugins/datatables/datatables.min.js"></script>