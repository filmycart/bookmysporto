		<?php
			include("includes/page_header.php");
			include("././validate_login.php");
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
									<a href="index.php?pg-nm=my-profile">
										<img src="<?=$frontendAssetUrl?>assets/img/icons/dashboard-icon.svg" alt="Icon">
										<span>Dashboard</span>
									</a>
								</li>
								<li>
									<a href="index.php?pg-nm=my-bookings" class="active">
										<img src="<?=$frontendAssetUrl?>assets/img/icons/booking-icon.svg" alt="Icon">
										<span>My Bookings</span>
									</a>
								</li>
								<!-- <li>
									<a href="index.php?pg-nm=my-profile">
										<img src="<?=$frontendAssetUrl?>assets/img/icons/profile-icon.svg" alt="Icon">
										<span>Profile Setting</span>
									</a>
								</li> -->
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
						<li><a class="active" href="index.php?pg-nm=my-profile">Profile</a></li>
						<li><a href="index.php?pg-nm=change-password">Change Password</a></li>
						<li><a href="index.php?pg-nm=user-settings">Other Settings</a></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-detail-group">
							<div class="card ">
								<form id="profileForm" name="profileForm" class="contact-us" method="POST" action="">
									<input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
									<div class="row">
										<div class="col-md-12">
											<div class="file-upload-text">
												<div class="file-upload">
													<img src="<?=$frontendAssetUrl?>assets/img/icons/img-icon.svg" class="img-fluid" alt="Upload">
													<p>Upload Photo</p>
													<span>
														<i class="feather-edit-3"></i>
														<input type="file" id="file-input">
													</span>
												</div>
												<h5>Upload a logo with a minimum size of 150 * 150 pixels (JPG, PNG, SVG).</h5>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="input-space">
												<label  class="form-label">Name</label>
												<input type="text" class="form-control" name="profileName" id="profileName" placeholder="Enter Name">
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="input-space">
												<label  class="form-label">E-Mail</label>
												<input type="email" class="form-control" name="profileEmail" id="profileEmail" placeholder="Enter Email Address">
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="input-space">
												<label  class="form-label">Phone Number</label>
												<input type="text" class="form-control" name="profilePhone" id="profilePhone" placeholder="Enter Phone Number">
											</div>
										</div>
										<div class="col-lg-12 col-md-12">
											<div class="info-about">
												<label for="comments" class="form-label">Information about You</label>
												<textarea class="form-control" name="profileInfo" id="profileInfo" rows="3" placeholder="About"></textarea>
											</div>
										</div>
									</div>
									<div class="spacer-div"></div>
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<div class="input-space mb-0">
												<button type="submit" class="btn btn-secondary d-flex align-items-center">Submit<i class="feather-arrow-right-circle ms-2"></i></button>
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