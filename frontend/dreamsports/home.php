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
								<h4>World Class Badminton Coaching & Premium Courts</h4>
								<h1>Choose Your <span>Coaches</span> and Start Your Training</h1>
								<p class="sub-info">Unleash Your Athletic Potential with Expert Coaching, State-of-the-Art Facilities, and Personalized Training Programs.</p>
								<div class="search-box">
									<form action="coaches-grid.html"> 
										<div class="search-input line">
											<div class="form-group mb-0">
												<label>Search for</label>
												<select class="select">
													<option>Courts</option>
													<option>Coaches</option>
												</select>
											</div>
										</div>
										<div class="search-input">
											<div class="form-group mb-0">
												<label>Where </label>
												<select class="form-control select">				
													<option value="">Choose Location</option>
													<option>Germany</option>
													<option>Russia</option>
													<option>France</option>
													<option>UK</option>
													<option>Colombia</option>
												</select>
											</div>
										</div>
										<div class="search-btn">
											<button class="btn" type="submit"><i class="feather-search"></i><span class="search-text">Search</span></button>
										</div>
									</form>
								</div>
							</div>
						</div>
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
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/work-icon1.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h5>
									<a href="register.html">Join Us</a>
								</h5>
								<p>Quick and Easy Registration: Get started on our software platform with a simple account creation process.</p>
								<a class="btn" href="register.html">
									Register Now <i class="feather-arrow-right"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/work-icon2.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h5>
									<a href="coaches-list.html">Select Coaches/Venues</a>
								</h5>
								<p>Book Badminton coaches and venues for expert guidance and premium facilities.</p>
								<a class="btn" href="coaches-list.html">
									Go To Coaches <i class="feather-arrow-right"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/work-icon3.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h5>
									<a href="coach-details.html">Booking Process</a>
								</h5>
								<p>Easily book, pay, and enjoy a seamless experience on our user-friendly platform.</p>
								<a class="btn" href="coach-details.html">
									Book Now <i class="feather-arrow-right"></i>
								</a>
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
					<h2>Featured <span>Venues</span></h2>
					<p class="sub-title">Advanced sports venues offer the latest facilities, dynamic and unique environments for enhanced badminton performance.</p>
				</div>
				<div class="row">
			        <div class="featured-slider-group ">
			        	<div class="owl-carousel featured-venues-slider owl-theme">

							<!-- Featured Item -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
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
											<a href="venue-details.html">Sarah Sports Academy</a>
										</h3>
										<div class="listing-details-group">
											<p>Elevate your athletic journey at Sarah Sports Academy, where excellence meets opportunity.</p>
											<ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>Port Alsworth, AK
													</span>
												</li>
												<li>
													<span>
														<i class="feather-calendar"></i>Next Availablity : <span class="primary-text">15 May 2023</span>
													</span>
												</li>
											</ul>
										</div>
										<div class="listing-button">
											<div class="listing-venue-owner">
												<a class="navigation" href="coach-detail.html">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-01.jpg" alt="Venue">Mart Sublin
												</a>												
											</div>
											<a href="venue-details.html" class="user-book-now"><span><i class="feather-calendar me-2"></i></span>Book Now</a>
										</div>	
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-02.jpg" class="img-fluid" alt="Venue">
										</a>
										<div class="fav-item-venues">
											<span class="tag tag-blue">Top Rated</span>		
											<h5 class="tag tag-primary">$200<span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content">
										<div class="list-reviews">							
											<div class="d-flex align-items-center">
												<span class="rating-bg">5.0</span><span>150 Reviews</span> 
											</div>
											<a href="javascript:void(0)" class="fav-icon">
												<i class="feather-heart"></i>
											</a>
										</div>	
										<h3 class="listing-title">
											<a href="venue-details.html">Badminton Academy</a>
										</h3>
										<div class="listing-details-group">
											<p>Unleash your badminton potential at our premier Badminton Academy, where champions are made.</p>
											<ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>Sacramento, CA
													</span>
												</li>
												<li>
													<span>
														<i class="feather-calendar"></i>Next Availablity : <span class="primary-text">15 May 2023</span>
													</span>
												</li>
											</ul>
										</div>
										<div class="listing-button">
											<div class="listing-venue-owner">
												<a class="navigation" href="coach-detail.html">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-02.jpg" alt="Venue">Rebecca
												</a>												
											</div>
											<a href="venue-details.html" class="user-book-now"><span><i class="feather-calendar me-2"></i></span>Book Now</a>
										</div>	
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-03.jpg" class="img-fluid" alt="Venue">
										</a>
										<div class="fav-item-venues">
											<h5 class="tag tag-primary">$350<span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content">
										<div class="list-reviews">							
											<div class="d-flex align-items-center">
												<span class="rating-bg">4.7</span><span>120 Reviews</span> 
											</div>
											<a href="javascript:void(0)" class="fav-icon">
												<i class="feather-heart"></i>
											</a>
										</div>	
										<h3 class="listing-title">
											<a href="venue-details.html">Manchester Academy</a>
										</h3>
										<div class="listing-details-group">
											<p>Manchester Academy: Where dreams meet excellence in sports education and training.</p>
											<ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>Guysville, OH
													</span>
												</li>
												<li>
													<span>
														<i class="feather-calendar"></i>Next Availablity : <span class="primary-text">16 May 2023</span>
													</span>
												</li>
											</ul>
										</div>
										<div class="listing-button">
											<div class="listing-venue-owner">
												<a class="navigation" href="coach-detail.html">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-03.jpg" alt="Venue">Andrew
												</a>												
											</div>
											<a href="venue-details.html" class="user-book-now"><span><i class="feather-calendar me-2"></i></span>Book Now</a>
										</div>	
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-02.jpg" class="img-fluid" alt="Venue">
										</a>
										<div class="fav-item-venues">
											<span class="tag tag-blue">Featured</span>		
											<h5 class="tag tag-primary">$450<span>/hr</span></h5>
										</div>
									</div>										
									<div class="listing-content">
										<div class="list-reviews">							
											<div class="d-flex align-items-center">
												<span class="rating-bg">4.5</span><span>300 Reviews</span> 
											</div>
											<a href="javascript:void(0)" class="fav-icon">
												<i class="feather-heart"></i>
											</a>
										</div>	
										<h3 class="listing-title">
											<a href="venue-details.html">ABC Sports Academy</a>
										</h3>
										<div class="listing-details-group">
											<p>Unleash your badminton potential at our premier ABC Sports Academy, where champions are made.</p>
											<ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>Little Rock, AR
													</span>
												</li>
												<li>
													<span>
														<i class="feather-calendar"></i>Next Availablity : <span class="primary-text">17 May 2023</span>
													</span>
												</li>
											</ul>
										</div>
										<div class="listing-button">
											<div class="listing-venue-owner">
												<a class="navigation" href="coach-detail.html">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-04.jpg" alt="Venue">Mart Sublin
												</a>												
											</div>
											<a href="venue-details.html" class="user-book-now"><span><i class="feather-calendar me-2"></i></span>Book Now</a>
										</div>	
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

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
										<a href="coach-detail.html">
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
										<a href="coach-details.html"><i class="feather-arrow-right"></i></a>
										<a href="coach-details.html" class="icon-hover"><i class="feather-calendar"></i></a>
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
										<span>3 Lessons</span>
										<h3><a href="coach-detail.html">Harry Richardson</a></h3>
										<a href="coach-details.html"><i class="feather-arrow-right"></i></a>
										<a href="coach-details.html" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
							<div class="featured-venues-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="coach-detail.html">
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
										<h3><a href="coach-detail.html">Evon Raddick</a></h3>
										<a href="coach-details.html"><i class="feather-arrow-right"></i></a>
										<a href="coach-details.html" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

							<!-- Featured Item -->
							<div class="featured-venues-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="coach-detail.html">
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
										<h3><a href="coach-detail.html">Angela Roudrigez</a></h3>
										<a href="coach-details.html"><i class="feather-arrow-right"></i></a>
										<a href="coach-details.html" class="icon-hover"><i class="feather-calendar"></i></a>
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
										<h3><a href="coach-detail.html">Harry Richardson</a></h3>
										<a href="coach-details.html"><i class="feather-arrow-right"></i></a>
										<a href="coach-details.html" class="icon-hover"><i class="feather-calendar"></i></a>
									</div>
								</div>
							</div>
							<!-- /Featured Item -->

						</div>
					</div>
				</div>
				<div class="view-all text-center aos" data-aos="fade-up">
					<a href="coaches-list.html" class="btn btn-secondary d-inline-flex align-items-center">
						View All Coaches  <span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span>
					</a>
				</div>
			</div>
		</section>
		<!-- /Featured Coaches -->

		<!-- Journey -->
		<section class="section journey-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 d-flex align-items-center">
						<div class="start-your-journey aos" data-aos="fade-up">
							<h2>Start Your Journey With <span class="active-sport">Dreamsports</span> Badminton Today.</h2>
							<p>At DreamSports Badminton, we prioritize your satisfaction and value your feedback as we continuously improve and evolve our learning experiences.</p>
							<p>Our instructors utilize modern methods for effective badminton lessons, offering introductory sessions for beginners and personalized development plans to foster individual growth.</p>
							<span class="stay-approach">Stay Ahead With Our Innovative Approach:</span>
							<div class="journey-list">
								<ul>
									<li><i class="fa-solid fa-circle-check"></i>Skilled Professionals</li>
									<li><i class="fa-solid fa-circle-check"></i>Modern Techniques</li>
									<li><i class="fa-solid fa-circle-check"></i>Intro Lesson</li>
								</ul>
								<ul>
									<li><i class="fa-solid fa-circle-check"></i>Personal Development</li>
									<li><i class="fa-solid fa-circle-check"></i>Advanced Equipment</li>
									<li><i class="fa-solid fa-circle-check"></i>Interactive Classes For Easy Learning.</li>
								</ul>
							</div>
							<div class="convenient-btns">
								<a href="register.html" class="btn btn-primary d-inline-flex align-items-center">
									<span><i class="feather-user-plus me-2"></i></span>Join With Us 
								</a>
								<a href="about-us.html" class="btn btn-secondary d-inline-flex align-items-center">
									<span><i class="feather-align-justify me-2"></i></span>Learn More 
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="journey-img aos" data-aos="fade-up">
							<img src="<?=$frontendAssetUrl?>assets/img/journey-01.png" class="img-fluid" alt="User">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Journey -->

		<!-- Group Coaching -->
		<section class="section group-coaching">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Our <span>Features</span></h2>
					<p class="sub-title">Discover your potential with our comprehensive training, expert trainers, and advanced facilities. Join us to improve your athletic career.</p>
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid coaching-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/coache-icon-01.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h3>Group Coaching</h3>
								<p>Accelerate your skills with tailored group coaching sessions for badminton players game.</p>
								<a href="javascript:void(0);">
									Learn More
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid coaching-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/coache-icon-02.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h3>Private Coaching</h3>
								<p>Find private badminton coaches and academies for a personalized approach to skill enhancement.</p>
								<a href="javascript:void(0);">
									Learn More
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid coaching-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/coache-icon-03.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h3>Equipment Store</h3>
								<p>Your one-stop shop for high-quality badminton equipment, enhancing your on-court performance.</p>
								<a href="javascript:void(0);">
									Learn More
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid coaching-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/coache-icon-04.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h3>Innovative Lessons</h3>
								<p>Enhance your badminton skills with innovative lessons, combining modern techniques and training methods</p>
								<a href="javascript:void(0);">
									Learn More
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid coaching-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/coache-icon-05.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h3>Badminton Community</h3>
								<p>Upraise your game with engaging lessons and a supportive community. Join us now and take your skills to new heights.</p>
								<a href="javascript:void(0);">
									Learn More
								</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="work-grid coaching-grid w-100 aos" data-aos="fade-up">
							<div class="work-icon">
								<div class="work-icon-inner">
									<img src="<?=$frontendAssetUrl?>assets/img/icons/coache-icon-06.svg" alt="Icon">
								</div>
							</div>
							<div class="work-content">
								<h3>Court Rental</h3>
								<p>Enjoy uninterrupted badminton sessions at DreamSports with our premium court rental services.</p>
								<a href="javascript:void(0);">
									Learn More
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Group Coaching -->

		<!-- Earn Money -->
		<section class="section earn-money">
			<div class="cock-img cock-position">
				<div class="cock-img-one ">
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
				<div class="row">
					<div class="col-md-6">
						<div class="private-venue aos" data-aos="fade-up">
							<div class="convenient-btns become-owner " role="tablist">
								<a href="javascript:void(0);" class="btn btn-secondary become-venue d-inline-flex align-items-center nav-link active" id="nav-Recent-tab" data-bs-toggle="tab" data-bs-target="#nav-Recent"  role="tab" aria-controls="nav-Recent" aria-selected="true">
									Become A Venue Member
								</a>
								<a href="javascript:void(0);" class="btn btn-primary become-coche d-inline-flex align-items-center nav-link" id="nav-RecentCoaching-tab" data-bs-toggle="tab" data-bs-target="#nav-RecentCoaching"  role="tab" aria-controls="nav-RecentCoaching" aria-selected="false">
									Become A Coach
								</a>
							</div>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="nav-Recent" role="tabpanel" aria-labelledby="nav-Recent-tab" tabindex="0">
									<h2>Earn Money Renting Out Your Private Coaches On Dreamsports</h2>
									<p>Join our network of private facility owners, offering rentals to local players, coaches, and teams.</p>
									<div class="earn-list">
										<ul>
											<li><i class="fa-solid fa-circle-check "></i>$1,000,000 liability insurance									</li>
											<li><i class="fa-solid fa-circle-check "></i>Build of Trust</li>
											<li><i class="fa-solid fa-circle-check "></i>Protected Environment for Your Activities									</li>
										</ul>
									</div>
									<div class="convenient-btns">
										<a href="register.html" class="btn btn-secondary d-inline-flex align-items-center">
											<span class="lh-1"><i class="feather-user-plus me-2"></i></span>Join With Us 
										</a>
									</div>
								</div>
							</div>
							<div class="tab-content">
								<div class="tab-pane fade show " id="nav-RecentCoaching" role="tabpanel" aria-labelledby="nav-Recent-tab" tabindex="0">
									<h2>Earn Money Renting Out Your Private Coaches On Dreamsports</h2>
									<p>Join our network of private facility owners, offering rentals to local players, coaches, and teams.</p>
									<div class="earn-list">
										<ul>
											<li><i class="fa-solid fa-circle-check "></i>$1,000,000 liability insurance									</li>
											<li><i class="fa-solid fa-circle-check "></i>Build of Trust</li>
											<li><i class="fa-solid fa-circle-check "></i>Protected Environment for Your Activities									</li>
										</ul>
									</div>
									<div class="convenient-btns">
										<a href="register.html" class="btn btn-secondary d-inline-flex align-items-center">
											<span class="lh-1"><i class="feather-user-plus me-2"></i></span>Join With Us 
										</a>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Earn Money -->

		<!-- Best Services -->
		<section class="section best-services">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Extra Benefits, Unmatched  <span>Service Excellence</span></h2>
					<p class="sub-title">Advance your badminton journey with DreamSports: Exclusive perks, exceptional service.</p>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="best-service-img aos" data-aos="fade-up">
							<img src="<?=$frontendAssetUrl?>assets/img/best-service.jpg" class="img-fluid" alt="Service">
							<div class="service-count-blk">
								<div class="coach-count">
									<h3>Coaches</h3>
									<h2><span class="counter-up" >88</span>+</h2>
									<h4>Highly skilled badminton coaches with extensive expertise in the sport.</h4>
								</div>
								<div class="coach-count coart-count">
									<h3>Courts</h3>
									<h2><span class="counter-up" >59</span>+</h2>
									<h4>Well-maintained courts for optimal badminton experiences.</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="ask-questions aos" data-aos="fade-up">
							<h3>Frequently Asked Questions</h3>
							<p>Here are some frequently asked questions about badminton at DreamSports:</p>
							<div class="faq-info">
								<div class="accordion" id="accordionExample">

									<!-- FAQ Item -->
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingOne">
											<a href="javascript:;" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												How can I book a badminton court at DreamSports? 
											</a>
										</h2>
										<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												<div class="accordion-content">
													<p>Book your DreamSports badminton court online or contact our customer service for seamless reservations. </p>
												</div> 
											</div>
										</div>
									</div>
									<!-- /FAQ Item -->

									<!-- FAQ Item -->
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingTwo">
											<a href="javascript:;" class="accordion-button collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												What is the duration of a badminton court booking?
											</a>
										</h2>
										<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												<div class="accordion-content">
													<p>Book your DreamSports badminton court online or contact our customer service for seamless reservations. </p>
												</div>
											</div>
										</div>
									</div>
									<!-- /FAQ Item -->

									<!-- FAQ Item -->
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingThree">
											<a href="javascript:;" class="accordion-button collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												Can I rent badminton equipment at DreamSports? 
											</a>
										</h2>
										<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												<div class="accordion-content">
													<p>Book your DreamSports badminton court online or contact our customer service for seamless reservations.</p>
												</div>
											</div>
										</div>
									</div>
									<!-- /FAQ Item -->

									<!-- FAQ Item -->
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingFour">
											<a href="javascript:;" class="accordion-button collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
												Are there any coaching services available  at DreamSports?
											</a>
										</h2>
										<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												<div class="accordion-content">
													<p>Book your DreamSports badminton court online or contact our customer service for seamless reservations.</p>
												</div>
											</div>
										</div>
									</div>
									<!-- /FAQ Item -->

									<!-- FAQ Item -->
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingFive">
											<a href="javascript:;" class="accordion-button collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
												Can I join badminton leagues or tournaments at DreamSports?
											</a>
										</h2>
										<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
											<div class="accordion-body">
												<div class="accordion-content">
													<p>Book your DreamSports badminton court online or contact our customer service for seamless reservations.</p>
												</div>
											</div>
										</div>
									</div>
									<!-- /FAQ Item -->
												
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Best Services -->

		<!-- Courts Near -->
		<section class="section court-near">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Find Courts <span>Near You</span></h2>
					<p class="sub-title">Discover nearby badminton courts for convenient and accessible gameplay.</p>
				</div>
				<div class="row">
			        <div class="featured-slider-group aos" data-aos="fade-up">
			        	<div class="owl-carousel featured-venues-slider owl-theme">

							<!-- Courts Item -->
						    <div class="featured-venues-item court-near-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-04.jpg" alt="Venue">
										</a>
										<div class="fav-item-venues">
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content ">	
										<h3 class="listing-title">
											<a href="venue-details.html">Smart Shuttlers</a>
										</h3>
										<div class="listing-details-group"><ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>1 Crowthorne Road, 4th Street, NY
													</span>
												</li>
											</ul>
										</div>
										<div class="list-reviews near-review">							
											<div class="d-flex align-items-center">
												<span class="rating-bg">4.2</span><span>300 Reviews</span> 
											</div>
											<span class="mile-away"><i class="feather-zap"></i>2.1 Miles Away</span>
										</div>
									</div>
								</div>
							</div>
							<!-- /Courts Item -->

							<!-- Courts Item -->
						    <div class="featured-venues-item court-near-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-05.jpg" alt="Venue">
										</a>
										<div class="fav-item-venues">
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content ">	
										<h3 class="listing-title">
											<a href="venue-details.html">Parlers Badminton</a>
										</h3>
										<div class="listing-details-group"><ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>Hope Street, Battersea, SW11 2DA
													</span>
												</li>
											</ul>
										</div>
										<div class="list-reviews near-review">							
											<div class="d-flex align-items-center">
												<span class="rating-bg">4.2</span><span>200 Reviews</span> 
											</div>
											<span class="mile-away"><i class="feather-zap"></i>9.3 Miles Away</span>
										</div>
									</div>
								</div>
							</div>
							<!-- /Courts Item -->

							<!-- Courts Item -->
						    <div class="featured-venues-item court-near-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-06.jpg" alt="Venue">
										</a>
										<div class="fav-item-venues">
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content ">	
										<h3 class="listing-title">
											<a href="venue-details.html">6 Feathers</a>
										</h3>
										<div class="listing-details-group"><ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>Lonsdale Road, Barnes, SW13 9QL
													</span>
												</li>
											</ul>
										</div>
										<div class="list-reviews near-review">							
											<div class="d-flex align-items-center">
												<span class="rating-bg">4.2</span><span>400 Reviews</span> 
											</div>
											<span class="mile-away"><i class="feather-zap"></i>10.8 Miles Away</span>
										</div>
									</div>
								</div>
							</div>
							<!-- /Courts Item -->

							<!-- Courts Item -->
						    <div class="featured-venues-item court-near-item">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="venue-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-05.jpg" alt="Venue">
										</a>
										<div class="fav-item-venues">
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content ">	
										<h3 class="listing-title">
											<a href="venue-details.html">Parlers Badminton</a>
										</h3>
										<div class="listing-details-group"><ul>
												<li>
													<span>
														<i class="feather-map-pin"></i>1 Crowthorne Road, 4th Street, NY
													</span>
												</li>
											</ul>
										</div>
										<div class="list-reviews near-review">							
											<div class="d-flex align-items-center">
												<span class="rating-bg">4.2</span><span>300 Reviews</span> 
											</div>
											<span class="mile-away"><i class="feather-zap"></i>8.1 Miles Away</span>
										</div>
									</div>
								</div>
							</div>
							<!-- /Courts Item -->

						</div>	
					</div>
				</div>

				<!-- View More -->
				<div class="view-all text-center aos" data-aos="fade-up">
					<a href="listing-grid.html" class="btn btn-secondary d-inline-flex align-items-center">View All Services <span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span></a>
				</div>
				<!-- View More -->

			</div>
		</section>
		<!-- /Courts Near -->

		<!-- Testimonials -->
		<section class="section our-testimonials">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>Our <span>Testimonials</span></h2>
					<p class="sub-title">Glowing testimonials from passionate badminton enthusiasts worldwide, showcasing our exceptional services.</p>
				</div>
				<div class="row">
			        <div class="featured-slider-group aos" data-aos="fade-up">
			        	<div class="owl-carousel testimonial-slide featured-venues-slider owl-theme">

							<!-- Testimonials Item -->
						    <div class="testimonial-group">
								<div class="testimonial-review">
									<div class="rating-point">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<span > 5.0</span>
								   </div>
									<h5>Personalized Attention</h5>		
									<p>DreamSports' coaching services enhanced my badminton skills. Personalized attention from knowledgeable coaches propelled my game to new heights.</p>
								</div>
								<div class="listing-venue-owner">
									<a class="navigation">
										<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-01.jpg" alt="User">
									</a>	
									<div class="testimonial-content">
										<h5><a href="javascript:;">Ariyan Rusov</a></h5>
										<a href="javascript:void(0);" class="btn btn-primary ">
											Badminton
										</a>
									</div>											
								</div>
							</div>
							<!-- /Testimonials Item -->

							<!-- Testimonials Item -->
						    <div class="testimonial-group">
								<div class="testimonial-review">
									<div class="rating-point">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<span > 5.0</span>
								   </div>
									<h5>Quality Matters !</h5>		
									<p>DreamSports' advanced badminton equipment has greatly improved my performance on the court. Their quality range of rackets and shoes made a significant impact.</p>
								</div>
								<div class="listing-venue-owner">
									<a class="navigation">
										<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-04.jpg" alt="User">
									</a>	
									<div class="testimonial-content">
										<h5><a href="javascript:;">Darren Valdez</a></h5>
										<a href="javascript:void(0);" class="btn btn-primary ">
											Badminton
										</a>
									</div>											
								</div>
							</div>
							<!-- /Testimonials Item -->

							<!-- Testimonials Item -->
						    <div class="testimonial-group">
								<div class="testimonial-review">
									<div class="rating-point">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<span > 5.0</span>
								   </div>
									<h5>Excellent Professionalism !</h5>		
									<p>DreamSports' unmatched professionalism and service excellence left a positive experience. Highly recommended for court rentals and equipment purchases.</p>
								</div>
								<div class="listing-venue-owner">
									<a class="navigation">
										<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-03.jpg" alt="User">
									</a>	
									<div class="testimonial-content">
										<h5><a href="javascript:;">Elinor Dunn</a></h5>
										<a href="javascript:void(0);" class="btn btn-primary ">
											Badminton
										</a>
									</div>											
								</div>
							</div>
							<!-- /Testimonials Item -->

							<!-- Testimonials Item -->
						    <div class="testimonial-group">
								<div class="testimonial-review">
									<div class="rating-point">
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<i class="fas fa-star filled"></i>
										<span > 5.0</span>
								   </div>
								   <h5>Quality Matters !</h5>		
								   <p>DreamSports' advanced badminton equipment has greatly improved my performance on the court. Their quality range of rackets and shoes made a significant impact.</p>
								</div>
								<div class="listing-venue-owner">
									<a class="navigation">
										<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-04.jpg" alt="User">
									</a>	
									<div class="testimonial-content">
										<h5><a href="javascript:;">Darren Valdez</a></h5>
										<a href="javascript:void(0);" class="btn btn-primary ">
											Badminton
										</a>
									</div>											
								</div>
							</div>
							<!-- /Testimonials Item -->

						</div>	
					</div>

					<!-- Testimonials Slide -->
					<div class="brand-slider-group aos" data-aos="fade-up">
			        	<div class="owl-carousel testimonial-brand-slider owl-theme">
							<div class="brand-logos">
								<img  src="<?=$frontendAssetUrl?>assets/img/testimonial-icon-01.svg" alt="Brand">
							</div>
							<div class="brand-logos">
								<img  src="<?=$frontendAssetUrl?>assets/img/testimonial-icon-04.svg" alt="Brand">
							</div>
							<div class="brand-logos">
								<img  src="<?=$frontendAssetUrl?>assets/img/testimonial-icon-03.svg" alt="Brand">
							</div>
							<div class="brand-logos">
								<img  src="<?=$frontendAssetUrl?>assets/img/testimonial-icon-04.svg" alt="Brand">
							</div>
							<div class="brand-logos">
								<img  src="<?=$frontendAssetUrl?>assets/img/testimonial-icon-05.svg" alt="Brand">
							</div>
							<div class="brand-logos">
								<img  src="<?=$frontendAssetUrl?>assets/img/testimonial-icon-03.svg" alt="Brand">
							</div>
							<div class="brand-logos">
								<img  src="<?=$frontendAssetUrl?>assets/img/testimonial-icon-04.svg" alt="Brand">
							</div>
						</div>
					</div>	
					<!-- /Testimonials Slide -->

				</div>
			</div>
		</section>
		<!-- /Testimonials -->

		<!-- Featured Plans -->
		<section class="section featured-plan">
			<div class="work-img ">
				<div class="work-img-right">
					<img src="<?=$frontendAssetUrl?>assets/img/bg/work-bg.png" alt="Icon">
				</div>
			</div>
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>We Have Excellent <span>Plans For You</span></h2>
					<p class="sub-title">Choose monthly or yearly plans for uninterrupted access to our premium badminton facilities. Join us and experience convenient excellence.</p>
				</div>
				<div class="interset-btn aos" data-aos="fade-up">
					<div class="status-toggle d-inline-flex align-items-center">
						Monthly
						<input type="checkbox" id="status_1" class="check">
						<label for="status_1" class="checktoggle">checkbox</label>
						Yearly
					</div>
				</div>
				<div class="price-wrap aos" data-aos="fade-up">
					<div class="row justify-content-center">
						<div class="col-lg-4 d-flex col-md-6">

							<!-- Price Card -->
						    <div class="price-card flex-fill ">
								<div class="price-head">
									<img  src="<?=$frontendAssetUrl?>assets/img/icons/price-01.svg" alt="Price">
									<h3>Professoinal</h3>						
								</div>	
								<div class="price-body">
									<div class="per-month">
										<h2><sup>$</sup><span>60.00</span></h2>
										<span>Per Month</span>
									</div>
									<div class="features-price-list">
										<h5>Features</h5>
										<p>Everything in our free Upto 10 users. </p>
										<ul>
											<li class="active"><i class="feather-check-circle"></i>Included : Quality Checked By Envato</li>
											<li class="active"><i class="feather-check-circle"></i>Included : Future Updates</li>
											<li class="active"><i class="feather-check-circle"></i>Technical Support</li>
											<li class="inactive"><i class="feather-x-circle"></i>Add Listing </li>
											<li class="inactive"><i class="feather-x-circle"></i>Approval of Listing</li>
										</ul>
									</div>
									<div class="price-choose">
										<a href="javascript:;" class="btn viewdetails-btn">Choose Plan</a>
									</div>
									<div class="price-footer">
										<p>Use, by you or one client, in a single end product which end users.  charged for. The total price includes the item price and a buyer fee.</p>
									</div>							
								</div>							
						    </div>
							<!-- /Price Card -->

						</div>
						<div class="col-lg-4 d-flex col-md-6">

							<!-- Price Card -->
						    <div class="price-card flex-fill">
								<div class="price-head expert-price">
									<img  src="<?=$frontendAssetUrl?>assets/img/icons/price-02.svg" alt="Price">
									<h3>Expert</h3>	
									<span>Recommended</span>					
								</div>	
								<div class="price-body">
									<div class="per-month">
										<h2><sup>$</sup><span>60.00</span></h2>
										<span>Per Month</span>
									</div>
									<div class="features-price-list">
										<h5>Features</h5>
										<p>Everything in our free Upto 10 users. </p>
										<ul>
											<li class="active"><i class="feather-check-circle"></i>Included : Quality Checked By Envato</li>
											<li class="active"><i class="feather-check-circle"></i>Included : Future Updates</li>
											<li class="active"><i class="feather-check-circle"></i>6 Months Technical Support</li>
											<li class="inactive"><i class="feather-x-circle"></i>Add Listing </li>
											<li class="inactive"><i class="feather-x-circle"></i>Approval of Listing</li>
										</ul>
									</div>
									<div class="price-choose active-price">
										<a href="javascript:;" class="btn viewdetails-btn">Choose Plan</a>
									</div>
									<div class="price-footer">
										<p>Use, by you or one client, in a single end product which end users.  charged for. The total price includes the item price and a buyer fee.</p>
									</div>							
								</div>							
						    </div>
							<!-- /Price Card -->
							
						</div>
						<div class="col-lg-4 d-flex col-md-6">

							<!-- Price Card -->
						    <div class="price-card flex-fill">
								<div class="price-head">
									<img  src="<?=$frontendAssetUrl?>assets/img/icons/price-03.svg" alt="Price">
									<h3>Enterprise</h3>						
								</div>	
								<div class="price-body">
									<div class="per-month">
										<h2><sup>$</sup><span>990.00</span></h2>
										<span>Per Month</span>
									</div>
									<div class="features-price-list">
										<h5>Features</h5>
										<p>Everything in our free Upto 10 users. </p>
										<ul>
											<li class="active"><i class="feather-check-circle"></i>Included : Quality Checked By Envato</li>
											<li class="active"><i class="feather-check-circle"></i>Included : Future Updates</li>
											<li class="active"><i class="feather-check-circle"></i>Technical Support</li>
											<li class="active"><i class="feather-check-circle"></i>Add Listing </li>
											<li class="active"><i class="feather-check-circle"></i>Approval of Listing</li>
										</ul>
									</div>
									<div class="price-choose">
										<a href="javascript:;" class="btn viewdetails-btn">Choose Plan</a>
									</div>
									<div class="price-footer">
										<p>Use, by you or one client, in a single end product which end users.  charged for. The total price includes the item price and a buyer fee.</p>
									</div>							
								</div>							
						    </div>
							<!-- /Price Card -->
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Featured Plans -->

		<!-- Latest News -->
		<section class="section featured-venues latest-news">
			<div class="container">
				<div class="section-heading aos" data-aos="fade-up">
					<h2>The Latest <span>News</span></h2>
					<p class="sub-title">Get the latest buzz from the badminton world- stay informed and inspired by the thrilling updates and remarkable achievements in the sport.</p>
				</div>
				<div class="row">
			        <div class="featured-slider-group ">
			        	<div class="owl-carousel featured-venues-slider owl-theme">

							<!-- News -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="blog-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-07.jpg" alt="User">
										</a>
										<div class="fav-item-venues news-sports">
											<span class="tag tag-blue">Badminton</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content news-content">
										<div class="listing-venue-owner listing-dates">
											<a href="javascript:;" class="navigation">
												<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-01.jpg" alt="User">Orlando Waters
												
											</a>			
											<span ><i class="feather-calendar"></i>15 May 2023</span>									
										</div>
										<h3 class="listing-title">
											<a href="blog-details.html">Badminton Gear Guide: Must-Have Equipment for Every Player</a>
										</h3>
										<div class="listing-button read-new">
											<ul class="nav">
												<li><a href="javascript:;"><i class="feather-heart"></i>45</a></li>
												<li><a href="javascript:;"><i class="feather-message-square"></i>45</a></li>
											</ul>
											<span><img src="<?=$frontendAssetUrl?>assets/img/icons/clock.svg" alt="User">10 Min To Read</span>
										</div>	
									</div>
								</div>
							</div>
							<!-- /News -->

							<!-- News -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="blog-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-08.jpg" alt="User">
										</a>
										<div class="fav-item-venues news-sports">
											<span class="tag tag-blue">Sports Activites</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content news-content">
										<div class="listing-venue-owner listing-dates">
											<a href="javascript:;" class="navigation">
												<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-03.jpg" alt="User">Nichols
											</a>
											<span ><i class="feather-calendar"></i>16 Jun 2023</span>												
										</div>
										<h3 class="listing-title">
											<a href="blog-details.html">Badminton Techniques: Mastering the Smash, Drop Shot, and Clear											</a>
										</h3>
										<div class="listing-button read-new">
											<ul class="nav">
												<li><a href="javascript:;"><i class="feather-heart"></i>35</a></li>
												<li><a href="javascript:;"><i class="feather-message-square"></i>35</a></li>
											</ul>
											<span><img src="<?=$frontendAssetUrl?>assets/img/icons/clock.svg" alt="Icon">12 Min To Read</span>
										</div>	
									</div>
								</div>
							</div>
							<!-- /News -->

							<!-- News -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="blog-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-09.jpg" alt="Venue">
										</a>
										<div class="fav-item-venues news-sports">
											<span class="tag tag-blue">Rules of Game</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content news-content">
										<div class="listing-venue-owner listing-dates">
											<a href="javascript:;" class="navigation">
												<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-06.jpg" alt="User">Joanna Le
											</a>
											<span ><i class="feather-calendar"></i>11 May 2023</span>												
										</div>
										<h3 class="listing-title">
											<a href="blog-details.html">The Evolution of Badminton:From Backyard Fun to Olympic Sport</a>
										</h3>
										<div class="listing-button read-new">
											<ul class="nav">
												<li><a href="javascript:;"><i class="feather-heart"></i>25</a></li>
												<li><a href="javascript:;"><i class="feather-message-square"></i>25</a></li>
											</ul>
											<span><img src="<?=$frontendAssetUrl?>assets/img/icons/clock.svg" alt="Clock">14 Min To Read</span>
										</div>	
									</div>
								</div>
							</div>
							<!-- /News -->

							<!-- News -->
						    <div class="featured-venues-item aos" data-aos="fade-up">
								<div class="listing-item mb-0">										
									<div class="listing-img">
										<a href="blog-details.html">
											<img src="<?=$frontendAssetUrl?>assets/img/venues/venues-08.jpg" alt="Venue">
										</a>
										<div class="fav-item-venues news-sports">
											<span class="tag tag-blue">Sports Activites</span>	
											<div class="list-reviews coche-star">
												<a href="javascript:void(0)" class="fav-icon">
													<i class="feather-heart"></i>
												</a>
											</div>
										</div>
									</div>										
									<div class="listing-content news-content">
										<div class="listing-venue-owner listing-dates">
											<a href="javascript:;" class="navigation">
												<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-01.jpg" alt="User">Mart Sublin
											</a>
											<span ><i class="feather-calendar"></i>12 May 2023</span>												
										</div>
										<h3 class="listing-title">
											<a href="blog-details.html">Sports Make Us A Lot Stronger And Healthier Than We Think</a>
										</h3>
										<div class="listing-button read-new">
											<ul class="nav">
												<li><a href="javascript:;"><i class="feather-heart"></i>35</a></li>
												<li><a href="javascript:;"><i class="feather-message-square"></i>35</a></li>
											</ul>
											<span><img src="<?=$frontendAssetUrl?>assets/img/icons/clock.svg" alt="Clock">12 Min To Read</span>
										</div>	
									</div>
								</div>
							</div>
							<!-- /News -->

						</div>	
					</div>
				</div>

				<!-- View More -->
				<div class="view-all text-center aos" data-aos="fade-up">
					<a href="blog-grid.html" class="btn btn-secondary d-inline-flex align-items-center">View All News <span class="lh-1"><i class="feather-arrow-right-circle ms-2"></i></span></a>
				</div>
				<!-- View More -->

			</div>
		</section>
		<!-- /Latest News -->

		<!-- Newsletter -->
		<section class="section newsletter-sport">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="subscribe-style aos" data-aos="fade-up">
							<div class="banner-blk">
								<img src="<?=$frontendAssetUrl?>assets/img/subscribe-bg.jpg" class="img-fluid" alt="Subscribe">
							</div>
							<div class="banner-info ">
								<img src="<?=$frontendAssetUrl?>assets/img/icons/subscribe.svg" class="img-fluid" alt="Subscribe">
								<h2>Subscribe to Newsletter</h2>
								<p>Just for you, exciting badminton news updates.</p>
								<div class="subscribe-blk bg-white">
									<div class="input-group align-items-center">
										<i class="feather-mail"></i>
										<input type="email" class="form-control" placeholder="Enter Email Address" aria-label="email">
										<div class="subscribe-btn-grp">
											<input type="submit" class="btn btn-secondary" value="Subscribe">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Newsletter -->
		<?php
			include("includes/footer.php");
		?>