		<?php
			include("includes/header.php");
		?>
		<!-- Hero Section -->
		<section class="hero-section">	
			<div class="banner-cock-one">
				<img src="<?=$frontendAssetUrl?>assets/img/icons/banner-cock1.svg" alt="Banner">
			</div>
			<div class="banner-shapes">
				<div class="banner-dot-one">
					<span></span>
				</div>
				<div class="banner-cock-two">
					<img src="<?=$frontendAssetUrl?>assets/img/icons/banner-cock2.svg" alt="Banner">
					<span></span>
				</div>
				<div class="banner-dot-two">
					<span></span>
				</div>
			</div>	
			<div class="container">
				<div class="home-banner">
					<div class="row align-items-center w-100">
						<div class="col-lg-7 col-md-10 mx-auto">
							<div class="section-search aos" data-aos="fade-up">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<h1>Choose Your <span>Coaches</span> and Start Your Training</h1>
								<div class="search-box">
									<form name="searchForm" id="searchForm"> 
										<div class="search-input line">
											<div class="form-group mb-0">
												<select class="select" name="courtCoaches" id="courtCoaches">
													<option value="">Choose Court/Coaches</option>
													<option value="1">Court</option>
													<option value="2">Coach</option>
												</select>
											</div>
										</div>
										<div class="search-input">
											<div class="form-group mb-0">
												<select class="form-control select" name="searchLocation" id="searchLocation">				
													<option value="">Choose Location</option>
													<?php
														if((isset($stateResponseArr['data'])) && (!empty($stateResponseArr['data']))) {
															foreach($stateResponseArr['data'] as $stateRespVal) {
													?>
																<option value="<?=(!empty($stateRespVal['id'])?$stateRespVal['id']:'')?>"><?=(!empty($stateRespVal['name'])?$stateRespVal['name']:'')?></option>>
													<?php		
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="search-btn">
											<button class="btn" type="submit">
												<i class="feather-search"></i>
												<span class="search-text feather-search"></span>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<script>
				            jQuery.noConflict();
				            jQuery( document ).ready(function( $ ) {
				            	var ccid = '';
				            	var lid = '';
				                //validate signup form on keyup and submit
				                $("#searchForm").validate({
				                    rules: {
				                        courtCoaches: {
				                            required: true
				                        },
				                        searchLocation: {
				                            required: true
				                        }
				                    },
				                    messages: {
				                        courtCoaches: {
				                            required: "Please select Coach/Court."
				                        },
				                        searchLocation: {
				                            required: "Please enter your Location."
				                        }
				                    },
				                    // Make sure the form is submitted to the destination defined
				                    // in the "action" attribute of the form when valid
				                    submitHandler: function(form) {
				                    	ccid = $('#courtCoaches').val(); 
				                    	lid = $('#searchLocation').val();

				                    	window.location.href='index.php?pg-nm=coach&ccid='+ccid+'&lid='+lid;
				                    	return false; // required to block normal submit since you used ajax
				                    }
				                });
				            });    
				        </script>    
						<div class="col-lg-5">
							<div class="banner-imgs text-center aos" data-aos="fade-up">
								<img class="img-fluid" src="<?=$frontendAssetUrl?>assets/img/bg/banner-right.png" alt="Banner">
							</div>
						</div>
					</div>
				</div>	
			</div>
		</section>
		<!-- /Hero Section -->
		<!-- How It Works -->
		<section class="section work-section">
			<div class="work-cock-img">
				<img src="<?=$frontendAssetUrl?>assets/img/icons/work-cock.svg" alt="Icon">
			</div>
			<div class="work-img">
				<div class="work-img-right">
					<img src="<?=$frontendAssetUrl?>assets/img/bg/work-bg.png" alt="Icon">
				</div>
			</div>
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>How It <span>Works</span></h2>
					<p class="sub-title">Simplifying the booking process for coaches, venues, and athletes.</p>
				</div>
				<div class="row justify-content-center ">
					<div class="col-lg-3 col-md-5 d-flex">
						<div class="work-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/work-icon1.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h5>
									<?php
		                                if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
		                            ?>
		                                    <a href="index.php?pg-nm=my-profile">My Profile</a>

		                            <?php        
		                                } else {
		                            ?>
		                                    <a href="#" onclick="registerForm()">Join Us</a>
		                            <?php
		                                }
		                            ?>
								</h5>
								<p>Quick and Easy Registration: Get started on our software platform with a simple account creation process.</p>
								<?php
	                                if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
	                            ?>
	                                    <a class="btn" href="index.php?pg-nm=my-profile">
											My Profile<i class="feather-arrow-right"></i>
										</a>

	                            <?php        
	                                } else {
	                            ?>
	                                    <a class="btn" href="#" onclick="registerForm()">
											Register Now <i class="feather-arrow-right"></i>
										</a>
	                            <?php
	                                }
	                            ?>								
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-5 d-flex">
						<div class="work-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/booking-icon.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h5>
									<a href="index.php?pg-nm=events">Book Event</a>
								</h5>
								<p>
									Easily book events seamless experience on our user-friendly platform.
								</p>
								<a class="btn" href="index.php?pg-nm=events">
									Go To Events <i class="feather-arrow-right"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-5 d-flex">
						<div class="work-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/work-icon2.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h5>
									<a href="index.php?pg-nm=coaches">Book Coach</a>
								</h5>
								<p>
									Book Badminton coaches and venues for expert guidance and premium facilities.
								</p>
								<a class="btn" href="index.php?pg-nm=coaches">
									Go To Coaches <i class="feather-arrow-right"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-5 d-flex">
						<div class="work-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/work-icon3.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h5>
									<a href="index.php?pg-nm=venues">Book Court</a>
								</h5>
								<p>
									Easily book, pay, and enjoy a seamless experience on our user-friendly platform.
								</p>

								<?php
			                        if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
			                    ?>      
			                    		<a class="btn" href="index.php?pg-nm=venues">
											Book Now <i class="feather-arrow-right"></i>
										</a>
			                    <?php        
			                        } else {
			                    ?>
			                            <a class="btn" href="#">
											Book Now <i class="feather-arrow-right"></i>
										</a>   
			                    <?php
			                        }
			                    ?>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /How It Works -->
		<!-- Rental Deals -->

		<section class="section featured-venues">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Featured <span>Events</span></h2>
					<p class="sub-title">Advanced sports events offer the latest facilities, dynamic and unique environments for enhanced badminton performance.</p>
				</div>
				<div class="row">
			        <div class="featured-slider-group ">
			        	<div class="owl-carousel featured-venues-slider owl-theme">

			        		<?php
			        			if((isset($eventResponseHomePageArr['data'])) && (!empty($eventResponseHomePageArr['data']))) {
			        				foreach($eventResponseHomePageArr['data'] as $eventResponseHomePageVal) {

			        					$eventImageArray = array();
			    						$eventImage = "";
			    						if((isset($eventResponseHomePageVal['eventImage'])) && (!empty($eventResponseHomePageVal['eventImage']))) {
			    							$eventImageArray = explode(",",$eventImagePath.$eventResponseHomePageVal['eventImage']);
			    							if((isset($eventResponseHomePageVal['eventImage'])) && (!empty($eventResponseHomePageVal['eventImage']))) {
			    								$eventImage = $eventImageArray['0'];
			    							}
			    						} else {
			    							$eventImage = $eventNoImage;	
			    						}

			    						$eventStartDay = "";   
			    						if((isset($eventResponseHomePageVal['eventStartDate'])) && (!empty($eventResponseHomePageVal['eventStartDate']))) {
			        						$eventStartDay = date("m", strtotime($eventResponseHomePageVal['eventStartDate']));
										}	

			    						$eventStartMonthYear = "";   
			    						if((isset($eventResponseHomePageVal['eventStartDate'])) && (!empty($eventResponseHomePageVal['eventStartDate']))) {
			        						$eventStartMonthYear = date("F-Y", strtotime($eventResponseHomePageVal['eventStartDate']));
			        						//$eventStartMonthYear = date('d F Y', strtotime($eventResponseHomePageVal['eventStartDate'])); 
										}	

										$eventEndDay = "";   
			    						if((isset($eventResponseHomePageVal['eventEndDate'])) && (!empty($eventResponseHomePageVal['eventEndDate']))) {
			        						$eventEndDay = date("m", strtotime($eventResponseHomePageVal['eventEndDate']));
										}	

										$eventEndMonthYear = "";   
			    						if((isset($eventResponseHomePageVal['eventEndDate'])) && (!empty($eventResponseHomePageVal['eventEndDate']))) {
			        						$eventEndMonthYear = date("F-Y", strtotime($eventResponseHomePageVal['eventEndDate']));
										}		
			        		?>
			        					<div class="featured-venues-item aos" data-aos="fade-up">
											<div class="listing-item mb-0">										
												<div class="listing-img">
													<a href="index.php?pg-nm=event-details">
														<img src="<?=$eventImage?>" alt="Event">
													</a>
													<div class="fav-item-venues">
														<span class="tag tag-blue"><?=$eventStartDay?>-<?=$eventStartMonthYear?></span>	
														<span class="tag tag-blue"><?=$eventEndDay?>-<?=$eventEndMonthYear?></span>		
														<!-- <h5 class="tag tag-primary">$450<span>/hr</span></h5> -->
													</div>
												</div>										
												<div class="listing-content">
													<h3 class="listing-title">
														<?php
															// strip tags to avoid breaking any html
															$eventHomeTitle = strip_tags($eventResponseHomePageVal['eventTitle']);
															if (strlen($eventHomeTitle) > 25) {
															    // truncate string
															    $eventHomeTitleStringCut = substr($eventHomeTitle, 0, 25);
															    $eventHomeTitleEndPoint = strrpos($eventHomeTitleStringCut, ' ');

															    //if the string doesn't contain any space then it will cut without word basis.
															    $eventHomeTitle = $eventHomeTitleEndPoint? substr($eventHomeTitleStringCut, 0, $eventHomeTitleEndPoint) : substr($eventHomeTitleStringCut, 0);
															    $eventHomeTitle .= '...';
															}
														?>
														<a href="index.php?pg-nm=event-details"><?=$eventHomeTitle?></a>
													</h3>
													<div class="listing-details-group">
														<p>
															<?php
																// strip tags to avoid breaking any html
																$description = strip_tags($eventResponseHomePageVal['eventDescription']);
																if (strlen($description) > 120) {
																    // truncate string
																    $stringCut = substr($description, 0, 120);
																    $endPoint = strrpos($stringCut, ' ');

																    //if the string doesn't contain any space then it will cut without word basis.
																    $description = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
																    $description .= '...';
																}
																echo $description;
															?>
														</p>
														<ul>
															<li>
																<span>
																	<i class="feather-map-pin"></i><?=(!empty($eventResponseHomePageVal['eventAddress'])?$eventResponseHomePageVal['eventAddress']:'')?>
																</span>
															</li>
														</ul>
													</div>
													<div class="listing-button">
														<a href="index.php?pg-nm=event-details" class="user-book-now"><span><i class="feather-calendar me-2"></i></span>Event Details</a>
														<a href="venue-details.html" class="user-book-now"><span><i class="feather-calendar me-2"></i></span>Book Now</a>
													</div>	
												</div>
											</div>
										</div>
			        		<?php		
			        				}
			        			}
			        		?>								
						</div>	
					</div>
				</div>
				<!-- View More -->
				<div class="view-all text-center aos" data-aos="fade-up">
					<a href="index.php?pg-nm=events" class="btn btn-secondary d-inline-flex align-items-center">View All Events<span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span></a>
				</div>
				<!-- View More -->
			</div>
		</section>
		<!-- /Rental Deals -->
		<!-- Rental Deals -->
		<section class="section featured-venues">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Featured <span>Venues</span></h2>
					<p class="sub-title">Advanced sports venues offer the latest facilities, dynamic and unique environments for enhanced badminton performance.</p>
				</div>
				<div class="row">
			        <div class="featured-slider-group ">
			        	<div class="owl-carousel featured-venues-slider owl-theme">

			        		<?php
			        			if((isset($venueResponseArr['data'])) && (!empty($venueResponseArr['data']))) {
			        				foreach($venueResponseArr['data'] as $venueResponseVal) {
			        		?>
			        					<div class="featured-venues-item aos" data-aos="fade-up">
											<div class="listing-item mb-0">										
												<div class="listing-img">
													<a href="index.php?pg-nm=venue-details">
														<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-01.jpg" alt="Venue">
													</a>
													<div class="fav-item-venues">
														<span class="tag tag-blue">Featured</span>		
														<h5 class="tag tag-primary">$450<span>/hr</span></h5>
													</div>
												</div>										
												<div class="listing-content">
													<div class="list-reviews">							
														<div class="d-flex align-items-center">
															<span class="rating-bg">4.2</span><span>300 Reviews</span> 
														</div>
														<a href="javascript:void(0)" class="fav-icon">
															<i class="feather-heart"></i>
														</a>
													</div>	
													<h3 class="listing-title">
														<a href="index.php?pg-nm=venue-details"><?=(!empty($venueResponseVal['title'])?$venueResponseVal['title']:'')?></a>
													</h3>
													<div class="listing-details-group">
														<p>
															<?php
																// strip tags to avoid breaking any html
																$description = strip_tags($venueResponseVal['description']);
																if (strlen($description) > 120) {
																    // truncate string
																    $stringCut = substr($description, 0, 120);
																    $endPoint = strrpos($stringCut, ' ');

																    //if the string doesn't contain any space then it will cut without word basis.
																    $description = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
																    $description .= '...';
																}
																echo $description;
															?>
														</p>
														<ul>
															<li>
																<span>
																	<i class="feather-map-pin"></i><?=(!empty($venueResponseVal['address'])?$venueResponseVal['address']:'')?>
																</span>
															</li>
															<!-- <li>
																<span>
																	<i class="feather-calendar"></i>Next Availablity : <span class="primary-text">15 May 2023</span>
																</span>
															</li> -->
														</ul>
													</div>
													<div class="listing-button">
														<div class="listing-venue-owner">
															<a class="navigation" href="coach-detail.html">
																<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-01.jpg" alt="Venue"><?=(!empty($venueResponseVal['venueOwner'])?$venueResponseVal['venueOwner']:'')?>
															</a>												
														</div>
														<a href="index.php?pg-nm=venue-details" class="user-book-now"><span><i class="feather-calendar me-2"></i></span>Book Now</a>
													</div>	
												</div>
											</div>
										</div>
			        		<?php		
			        				}
			        			}
			        		?>								
						</div>	
					</div>
				</div>
				<!-- View More -->
				<div class="view-all text-center aos" data-aos="fade-up">
					<a href="listing-grid.html" class="btn btn-secondary d-inline-flex align-items-center">View All Featured<span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span></a>
				</div>
				<!-- View More -->
			</div>
		</section>
		<!-- /Rental Deals -->
		<!-- Services -->
		<section class="section service-section">
			<div class="work-cock-img">
				<img src="<?=$frontendAssetUrl?>assets/img/icons/work-cock.svg" alt="Service">
			</div>
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Explore Our <span>Services</span></h2>
					<p class="sub-title">Fostering excellence and empowering sports growth through tailored services for athletes, coaches, and enthusiasts.</p>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="service-grid w-100 aos" data-aos="fade-up">
							<div class="service-img">
								<a href="service-detail.html">
									<img src="<?=$frontendAssetUrl?>assets/img/services/service-01.jpg" class="img-fluid" alt="Service">
								</a>
							</div>
							<div class="service-content">
								<h4><a href="service-detail.html">Court Rent</a></h4>
								<a href="service-detail.html">Learn More</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="service-grid w-100 aos" data-aos="fade-up">
							<div class="service-img">
								<a href="service-detail.html">
									<img src="<?=$frontendAssetUrl?>assets/img/services/service-02.jpg" class="img-fluid" alt="Service">
								</a>
							</div>
							<div class="service-content">
								<h4><a href="service-detail.html">Group Lesson</a></h4>
								<a href="service-detail.html">Learn More</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="service-grid w-100 aos" data-aos="fade-up">
							<div class="service-img">
								<a href="service-detail.html">
									<img src="<?=$frontendAssetUrl?>assets/img/services/service-03.jpg" class="img-fluid" alt="Service">
								</a>
							</div>
							<div class="service-content">
								<h4><a href="service-detail.html">Training Program</a></h4>
								<a href="service-detail.html">Learn More</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="service-grid w-100 aos" data-aos="fade-up">
							<div class="service-img">
								<a href="service-detail.html">
									<img src="<?=$frontendAssetUrl?>assets/img/services/service-04.jpg" class="img-fluid" alt="Service">
								</a>
							</div>
							<div class="service-content">
								<h4><a href="service-detail.html">Private Lessons</a></h4>
								<a href="service-detail.html">Learn More</a>
							</div>
						</div>
					</div>
				</div>
				<div class="view-all text-center aos" data-aos="fade-up">
					<a href="services.html" class="btn btn-secondary d-inline-flex align-items-center">
						View All Services <span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span>
					</a>
				</div>
			</div>
		</section>
		<!-- /Services -->
		<!-- Convenient -->
		<section class="section convenient-section">
			<div class="cock-img">
				<div class="cock-img-one">
					<img src="<?=$frontendAssetUrl?>assets/img/icons/cock-01.svg" alt="Icon">
				</div>
				<div class="cock-img-two">
					<img src="<?=$frontendAssetUrl?>assets/img/icons/cock-02.svg" alt="Icon">
				</div>
				<div class="cock-circle">
					<img src="<?=$frontendAssetUrl?>assets/img/bg/cock-shape.png" alt="Icon">
				</div>
			</div>
			<div class="container">
				<div class="convenient-content aos" data-aos="fade-up">
					<h2>Convenient & Flexible Scheduling</h2>
					<p>Find and book coaches conveniently with our online system that matches your schedule and location.</p>
				</div>
				<div class="convenient-btns aos" data-aos="fade-up">
					<a href="coach-details.html" class="btn btn-primary d-inline-flex align-items-center">
						Book a Training <span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span>
					</a>
					<a href="pricing.html" class="btn btn-secondary d-inline-flex align-items-center">
						View Pricing Plan <span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span>
					</a>
				</div>
			</div>
		</section>
		<!-- /Convenient -->
		<!-- Featured Coaches -->
		<section class="section featured-section">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Featured <span>Coaches</span></h2>
					<p class="sub-title">Uplift your badminton game with our featured coaches, personalized instruction, and expertise to achieve your goals.</p>
				</div>
				<div class="row">
			        <div class="featured-slider-group aos" data-aos="fade-up">
			        	<div class="owl-carousel featured-coache-slider owl-theme">
							<!-- Featured Item -->
							<div class="featured-venues-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="index.php?coach-details">
											<img src="<?=$frontendAssetUrl?>assets/img/profiles/user-01.jpg" alt="User">
										</a>
										<div class="fav-item-venues">
											<span class="tag tag-blue">Rookie</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
										<div class="hour-list">
											<h5 class="tag tag-primary">From $250 <span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content list-coche-content">
										<span>4 Lessons</span>
										<h3><a href="coach-detail.html">Kevin Anderson</a></h3>
										<a href="index.php?coach-details"><i class="feather-arrow-right"></i></a>
										<a href="index.php?coach-details" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->
							<!-- Featured Item -->
							<div class="featured-venues-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="index.php?coach-details">
											<img src="<?=$frontendAssetUrl?>assets/img/profiles/user-02.jpg" alt="User">
										</a>
										<div class="fav-item-venues">
											<span class="tag tag-blue">Intermediate</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
										<div class="hour-list">
											<h5 class="tag tag-primary">From $150 <span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content list-coche-content">
										<span>3 Lessons</span>
										<h3><a href="index.php?coach-details">Harry Richardson</a></h3>
										<a href="index.php?coach-details"><i class="feather-arrow-right"></i></a>
										<a href="index.php?coach-details" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
							<div class="featured-venues-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="index.php?coach-details">
											<img src="<?=$frontendAssetUrl?>assets/img/profiles/user-03.jpg" alt="User">
										</a>
										<div class="fav-item-venues">
											<span class="tag tag-blue">Professional</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
										<div class="hour-list">
											<h5 class="tag tag-primary">From $350 <span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content list-coche-content">
										<span>2 Lessons</span>
										<h3><a href="index.php?coach-details">Evon Raddick</a></h3>
										<a href="index.php?coach-details"><i class="feather-arrow-right"></i></a>
										<a href="index.php?coach-details" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
							<div class="featured-venues-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="index.php?coach-details">
											<img src="<?=$frontendAssetUrl?>assets/img/profiles/user-04.jpg" alt="User">
										</a>
										<div class="fav-item-venues">
											<span class="tag tag-blue">Rookie</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
										<div class="hour-list">
											<h5 class="tag tag-primary">From $250 <span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content list-coche-content">
										<span>4 Lessons</span>
										<h3><a href="index.php?coach-details">Angela Roudrigez</a></h3>
										<a href="index.php?coach-details"><i class="feather-arrow-right"></i></a>
										<a href="index.php?coach-details" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
							<div class="featured-venues-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="coach-detail.html">
											<img src="<?=$frontendAssetUrl?>assets/img/profiles/user-02.jpg" alt="User">
										</a>
										<div class="fav-item-venues">
											<span class="tag tag-blue">Intermediate</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
										<div class="hour-list">
											<h5 class="tag tag-primary">From $150 <span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content list-coche-content">
										<span>4 Lessons</span>
										<h3><a href="index.php?coach-details">Harry Richardson</a></h3>
										<a href="index.php?coach-details"><i class="feather-arrow-right"></i></a>
										<a href="index.php?coach-details" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

						</div>
					</div>
				</div>
				<div class="view-all text-center aos" data-aos="fade-up">
					<a href="index.php?pg-nm=coaches" class="btn btn-secondary d-inline-flex align-items-center">
						View All Coaches  <span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span>
					</a>
				</div>
			</div>
		</section>
		<!-- /Featured Coaches -->		
		<?php
			include("includes/footer.php");
		?>