		<?php
			include("includes/page_header.php");
			include("././validate_login.php");

			$curlUserProfile = curl_init();

		    $userProfileUrl = "";
		    if($hostName == "localhost") {
		        $userProfileUrl = $requestScheme.'://localhost/sportifyv2/api/user/user-profile.php';
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

		    curl_close($curlUserProfile);

		    /*print"<pre>";
		    print_r($userProfilePageArr['data']);
		    exit;*/

		    //$userProfilePageArr['data']['username'];
		?>
		<!-- Breadcrumb -->
		<section class="breadcrumb breadcrumb-list mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h1 class="text-white">Update Profile</h1>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li >Update Profile</li>
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
	    <script>
	        $.noConflict();
			jQuery( document ).ready(function( $ ) {

				$('#userImageSpinnerDiv2').hide();

				$('#userImage2').change(function(e) {

                    $('#userImagePreview2').html('');
                    $('#userImageError2').html('');

                    var fileData = $('#userImage2').prop('files')[0];   
                    var formdata = new FormData(); 

                    // Read selected files
                    var totalfiles = document.getElementById('userImage2').files.length;
                    var userName = $('#profileName').val();
                    var api_token = $('#api_token').val();

                    for (var index = 0; index < totalfiles; index++) {
                        formdata.append("files[]", document.getElementById('userImage2').files[index]);
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

                                    respFileNameArray[index] = src1;
                                }   

                                respFileName = respFileNameArray.toString();

                                $('#userImageHidden2').val(respFileName);
                            } else if(errorRespArray) {
                                $('#userImageError2').append(errorRespArray);
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
	            $("#updateProfileForm").validate({
	                rules: {
	                    profileName: {
	                        required: true,
	                        minlength: 5
	                    },
	                    profilePhone: {
	                        required: true,
	                        minlength: 10,
	                        maxlength: 25,
	                        mobileValidation: $("#updateProfileForm").val()
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
	                    }
	                },
	                // Make sure the form is submitted to the destination defined
	                // in the "action" attribute of the form when valid
	                submitHandler: function(form) {
						$.ajax({
							type: "POST",
							url: "./api/user/upd-user-profile.php",
							data: $(form).serialize(),
							success: function (resp) {
								$(form).html("<div id='message'></div>");
								$('#message').html("<h2>Updated Successfully.</h2>")
									.hide()
									.fadeIn(1500, function () {
								});

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
		<!-- Page Content -->
		<div class="content court-bg">
			<div class="container">
				<div class="coach-court-list profile-court-list">
					<ul class="nav">
						<li>
							<a href="index.php?pg-nm=my-profile" class="active">
								My Profile
							</a>
						</li>	
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-detail-group">
							<div class="card">
								<form id="updateProfileForm" name="updateProfileForm" class="contact-us" method="POST" action="">
									<input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
									<div class="row">
										<div class="col-lg-4 col-md-6">
											<div>
												<label class="form-label">Name</label>
											</div>	
											<div>
												<input name="profileName" id="profileName" type="text" class="form-control" value="<?=(!empty($userProfilePageArr['data']['name'])?$userProfilePageArr['data']['name']:'')?>" />
											</div>
										</div>
										<div class="spacer-div"></div>
										<div class="col-lg-4 col-md-6">
											<div>
												<label class="form-label">Phone Number - (User Name)</label>
											</div>	
											<div>
												<input name="profilePhone" id="profilePhone" type="text" class="form-control" value="<?=(!empty($userProfilePageArr['data']['username'])?$userProfilePageArr['data']['username']:'')?>" />
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div>
												<label class="form-label">Image</label>
											</div>
											<div>
												<div id="userImageSpinnerDiv2"><img src="./frontend/dreamsports/assets/img/loader.png" class="loader"></div>
		                                        <div id="userImagePreview2"></div>
		                                        <div id="userImageError2" style="color:red;"></div>
		                                        <input type="hidden" name="userImageHidden2" id="userImageHidden2" />
												<input name="userImage2" id="userImage2" type="file" class="form-control" value="<?=(!empty($userProfilePageArr['data']['image'])?$userProfilePageArr['data']['image']:'')?>" />
											</div>
										</div>
										<div class="spacer-div"></div>
										<div class="col-lg-4 col-md-6">
											<input type="submit" class="btn btn-primary register-btn d-inline-flex justify-content-center align-items-center" name="updProfileSubmit" id="updProfileSubmit" value="Submit">	
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