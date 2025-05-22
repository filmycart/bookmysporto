		<?php
			include("includes/page_header.php");
		?>
		<!-- Breadcrumb -->
		<div class="breadcrumb breadcrumb-list mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h3 class="text-white">Contact US</h3>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li>Contact US</li>
				</ul>
			</div>
		</div>
		<!-- /Breadcrumb -->
		<!-- Page Content -->
		<div class="content blog-details contact-group">
			<div class="container">
				<section class="card mb-40">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-4">
							<aside class="card booking-details">
								<h3 class="border-bottom">Let's talk</h3>
								<div class="d-flex justify-content-start align-items-center details">
									<i class="feather-phone-call d-flex justify-content-center align-items-center"></i>
									<div class="info">
										<h4>Phone Number</h4>
										<p>+918792574405</p>
									</div>
								</div>
								<div class="d-flex justify-content-start align-items-center details">
									<i class="feather-phone-call d-flex justify-content-center align-items-center"></i>
									<div class="info">
										<h4>Phone Number</h4>
										<p>+918792574405</p>
									</div>
								</div>
								<div class="d-flex justify-content-start align-items-center details">
									<i class="feather-map-pin d-flex justify-content-center align-items-center"></i>
									<div class="info">
										<h4>Location</h4>
										<p>167/4c, Sivaperumal Street, Rathinasamypuram, Salem-636009.</p>
									</div>
								</div>
								<div class="d-flex justify-content-start align-items-center details">
									<div class="info">
										<p>&nbsp;</p>
										<p>&nbsp;</p>
									</div>
								</div>
							</aside>
						</div>
						<div class="col-12 col-sm-12 col-md-12 col-lg-8">
							<section class="card booking-form">
								<h3 class="border-bottom">Contact Form</h3>
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
							            $("#contactForm").validate({
							                rules: {
							                    contactName: {
							                        required: true,
							                        minlength: 5
							                    },
							                    contactEmail: {
							                        required: true,
							                        minlength: 25
							                    },
							                    contactPhone: {
							                        required: true,
							                        minlength: 10,
							                        maxlength: 25,
							                        mobileValidation: $("#contactPhone").val()
							                    },
							                    contactSubject: {
							                        required: true,
							                        minlength: 10,
							                        maxlength: 100
							                    },
							                    contactMessage: {
							                        required: true,
							                        minlength: 25,
							                        maxlength: 1000
							                    }
							                },
							                messages: {
							                    contactName: {
							                        required: "Please enter your Name.",
							                        minlength: "Please enter minimum 5 character for Name."
							                    },
							                    contactEmail: {
							                        required: "Please enter your E-Mail.",
							                        minlength: "Please enter minimum 25 character for E-Mail."
							                    },
							                    contactPhone: {
							                        required: "Please enter your Phone Number.",
							                        minlength: "Please enter minimum 10 digits for Phone Number."
							                    },
							                    contactSubject: {
							                        required: "Please enter your Subject.",
							                        minlength: "Please enter minimum 10 for Subject.",
							                        maxlength: "Please enter minimum 100 for Subject."
							                    },
							                    contactMessage: {
							                        required: "Please enter your Message.",
							                        minlength: "Please enter minimum 25 for Message.",
							                        maxlength: "Please enter minimum 100 for Message."
							                    },
							                },
							                // Make sure the form is submitted to the destination defined
							                // in the "action" attribute of the form when valid
							                submitHandler: function(form) {
							                  //form.submit();
							                  $.ajax({
							                     type: "POST",
							                     url: "./api/user/contact.php",
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
							    </style>
							    <form id="contactForm" name="contactForm" class="contact-us" method="POST" action="">
									<input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
									<div class="row">
										<label for="first-name" class="form-label">Name</label>
			  							<input type="text" class="form-control" name="contactName" id="contactName" placeholder="Enter Name">
									</div>
									<div class="row">	
										<label for="last-name" class="form-label">E-Mail</label>
			  							<input type="email" class="form-control" name="contactEmail" id="contactEmail" placeholder="Enter E-Mail">
									</div>
									<div class="row">	
										<label for="e-mail" class="form-label">Phone</label>
			  							<input type="text" class="form-control" name="contactPhone" id="contactPhone" placeholder="Enter Phone Number">
									</div>
									<div class="row">	
										<label for="subject" class="form-label">Subject</label>
				  						<input type="text" class="form-control" name="contactSubject" id="contactSubject" placeholder="Enter Subject">
									</div>
									<div class="row">
										<label for="comments" class="form-label">Comments</label>
										<textarea class="form-control" name="contactMessage" id="contactMessage" rows="3" placeholder="Enter Message"></textarea>
									</div>
									<div class="row">
										&nbsp;	
									</div>		
									<button type="submit" class="btn btn-secondary d-flex align-items-center">Submit<i class="feather-arrow-right-circle ms-2"></i></button>
								</form>
							</section>
						</div>
					</div>		
					<div class="row">
						&nbsp;	
					</div>	
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<div class="google-maps">
					    		<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.8862835683544!2d-73.98256668525309!3d41.93829486962529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89dd0ee3286615b7%3A0x42bfa96cc2ce4381!2s167/4c%20Kingston%20St%2C%20Kingston%2C%20NY%2012401%2C%20USA!5e0!3m2!1sen!2sin!4v1670922579281!5m2!1sen!2sin" height="445" style="border:0;width:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
			    				<div class="mapouter">
			    					<div class="gmap_canvas">
			    						<iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=167/4c, sivaperumal street, Rathinasamypuram, Salem-636009&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
			    						</iframe>
			    						<a href="https://embed-googlemap.com">embed google map</a>
			    					</div>
			    					<style>
			    						.mapouter {
			    							position:relative;
			    							text-align:right;
			    							width:100%;
			    							height:530px;
			    						}

			    						.gmap_canvas {
			    							overflow:hidden;
			    							background:none !important;
			    							width:100%;
			    							height:530px;
			    						}

			    						.gmap_iframe {
			    							height:530px !important;
			    						}
			    					</style>
			    				</div>
							</div>
						</div>	
					</div>
				</section>
			</div>	
		</div>
		<!-- /Page Content -->
		<?php
			include("includes/page_footer.php");
		?>