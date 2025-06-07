		<?php
			include("includes/header.php");
		?>
		<!-- Breadcrumb -->
		<section class="breadcrumb breadcrumb-list mb-0">
			<span class="primary-right-round"></span>
			<!-- <div class="container">
				<h1 class="text-white">Coaches Grid Sidebar</h1>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li>Coaches Grid Sidebar</li>
				</ul>
			</div> -->
		</section>
		<!-- /Breadcrumb -->
		<!-- Page Content -->
		<div class="content listing-page">
			<div class="container">
				<!-- Sort By -->
				<div class="row">
					<div class="col-lg-12">
						<div class="sortby-section">
							<div class="sorting-info">
								<div class="row d-flex align-items-center">
									<div class="col-xl-4 col-lg-3 col-sm-12 col-12">
										<div class="count-search">
											<p> <span>150</span> coaches are listed<p>							
                                        </div>
									</div>
									<div class="col-xl-8 col-lg-9 col-sm-12 col-12">
										<div class="sortby-filter-group">
											<div class="grid-listview">
												<ul class="nav">
													<li>
														<span>View as</span>
													</li>
													<li>
														<a href="index.php?pg-nm=coach" class="active">
															<img src="<?=$frontendAssetUrl?>assets/img/icons/sort-01.svg" alt="Icon">
														</a>
													</li>
													<li>
														<a href="index.php?pg-nm=coach">
															<img src="<?=$frontendAssetUrl?>assets/img/icons/sort-02.svg" alt="Icon">
														</a>
													</li>
													<li>
														<a href="index.php?pg-nm=coach">
															<img src="<?=$frontendAssetUrl?>assets/img/icons/sort-03.svg" alt="Icon">
														</a>
													</li>
												</ul>
											</div>
											<div class="sortbyset">
												<span class="sortbytitle">Sort By</span>
												<div class="sorting-select">
													<select class="form-control select">
														<option>Relevance</option>
														<option>Price</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<!-- Sort By -->
				<!-- Listing Content Group-->
                <div class="listing-list-sidebar">
					<div class="row">
                        <div class="col-lg-4 theiaStickySidebar">
							<div class="listing-filter-group listing-item">
                                <form action="#" autocomplete="off" class="sidebar-form listing-content">
                                    <!-- Customer -->
                                    <div class="sidebar-heading">
                                        <h3>Advanced <span>Search</span></h3>
                                        <p><a href="javascript:;">Clear All</a></p>
                                    </div>
                                    <div class="listing-search">								
                                        <div class="form-custom">														
                                            <input type="text" class="form-control" id="member_search1" placeholder="What are you looking for">
                                            <button class="btn"><span><i class="feather-search"></i></span></button>
                                        </div>
                                    </div>
                                    <div class="accordion" id="accordionMain1">
                                        <div class="card-header-new" id="headingOne">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Lesson type	
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"  data-bs-parent="#accordionExample1">
                                            <div class="card-body-chat">
                                                <div class="sorting-select">
                                                    <span><i class="feather-list"></i></span>
                                                    <select class="form-control select">
                                                        <option>Lesson 1</option>
                                                        <option>Lesson 2</option>
                                                        <option>Lesson 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Customer -->
        
                                    <div class="accordion" id="accordionMain2">
                                        <div class="card-header-new" id="headingTwo">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100 collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    Location
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"  data-bs-parent="#accordionExample2">
                                            <div class="card-body-chat">
                                                <div class="sorting-select">
                                                    <span><i class="feather-map-pin"></i></span>
                                                    <select class="form-control select">
                                                        <option>Select Location</option>
                                                        <option>Location 1</option>
                                                        <option>Location 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <!-- By Status -->
                                    <div class="accordion" id="accordionMain3">
                                        <div class="card-header-new" id="headingThree">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100 collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                    Radius
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"  data-bs-parent="#accordionExample3">
                                            <div class="card-body-chat">
                                                <div class="filter-range">
                                                    <input type="text"  class="input-range">
                                                </div>	
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /By Status -->
        
                                    <!-- Category -->
                                    <div class="accordion" id="accordionMain4">
                                        <div class="card-header-new" id="headingFour">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100 collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                    Price Range
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"  data-bs-parent="#accordionExample4">
                                            <div class="card-body-chat range-price">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-custom">														
                                                            <input type="text" class="form-control" placeholder="Enter Min Price">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-custom">														
                                                            <input type="text" class="form-control" placeholder="Enter Max Price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <!-- /Category -->
                                    
                                    <!-- Guests -->
                                    <div class="accordion" id="accordionMain5">
                                        <div class="card-header-new" id="headingFive">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100 collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                                    Guests
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"  data-bs-parent="#accordionExample5">
                                            <div class="card-body-chat">                                                	
                                                <div id="checkBoxes5">
                                                    <div class="selectBox-cont">
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>0-2
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span> 2-4
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span> 4-5
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span> More than 5+
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Guests -->

                                    <!-- Reviews -->
                                    <div class="accordion" id="accordionMain6">
                                        <div class="card-header-new" id="headingSix">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100 collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                                    Reviews
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix"  data-bs-parent="#accordionExample6">
                                            <div class="card-body-chat">
                                                <div id="checkBoxes4">
                                                    <div class="selectBox-cont">
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled "></i>
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled "></i>
                                                            <i class="fas fa-star filled"></i>
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled text-warning"></i>
                                                            <i class="fas fa-star filled "></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                        </label>
                                                        <div class="view-content">
                                                            <div class="viewall-Two">	
                                                                <label class="custom_check w-100">
                                                                    <input type="checkbox" name="username">
                                                                    <span class="checkmark"></span>
                                                                    <i class="fas fa-star filled text-warning"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                    <i class="fas fa-star filled"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Reviews -->

                                    <!-- Amenities -->
                                    <div class="accordion" id="accordionMain7">
                                        <div class="card-header-new" id="headingSeven">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100 collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                                    Availability
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"  data-bs-parent="#accordionExample7">
                                            <div class="card-body-chat datepicker-calendar">                                                	
                                                <div id="checkBoxes7">
                                                    <div class="selectBox-cont">
                                                        <div class="card-body">
                                                            <div id="calendar-doctor" class="calendar-container"></div>
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Amenities -->

                                    <!-- Amenities -->
                                    <div class="accordion" id="accordionMain8">
                                        <div class="card-header-new" id="headingEight">
                                            <h5 class="filter-title">
                                                <a href="javascript:void(0);" class="w-100 collapsed"  data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                                    Amenities
                                                    <span class="accordion-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                                                </a> 
                                            </h5>
                                        </div>
                                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight"  data-bs-parent="#accordionExample8">
                                            <div class="card-body-chat">                                                	
                                                <div id="checkBoxes8">
                                                    <div class="selectBox-cont">
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>Waiting Area
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>Waiting Area
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>Clothes
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>Wi-fi
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="category">
                                                            <span class="checkmark"></span>Parking
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Amenities -->

                                    <button type="submit" class="search-btn btn w-100 btn-primary">
                                        <span><i class="feather-search me-2"></i></span>Search Now
                                    </button>
                                </form>
                             </div>
						</div>
						<div class="col-lg-8">    
                            <!-- Listing Content -->
                            <div class="row justify-content-center">

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="assets/img/featured/featured-05.jpg" alt="Venue">
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
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Kevin Anderson</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Port Alsworth, AK
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Certified Badminton Coach with a deep understanding of the sport's techniques and strategies.</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>20 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>80 Reviews</span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="assets/img/featured/featured-06.jpg" alt="Venue">
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
                                                    <h5 class="tag tag-primary">From $120 <span>/hr</span></h5>
                                                </div>
                                            </div>										
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Angela Roudrigez</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Guysville, OH
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Experienced coach dedicated to enhancing your badminton skills and unlocking your full potential and strategies.</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>21 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>80 Reviews</span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="<?=$frontendAssetUrl?>assets/img/featured/featured-07.jpg" alt="Venue">
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
                                                    <h5 class="tag tag-primary">From $750 <span>/hr</span></h5>
                                                </div>
                                            </div>										
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Evon Raddick</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Little Rock, AR
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Passionate Badminton Coach unlocking players' potential through strategic gameplay</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>22 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>470 Reviews </span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="assets/img/featured/featured-08.jpg" alt="Venue">
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
                                                    <h5 class="tag tag-primary">From $550 <span>/hr</span></h5>
                                                </div>
                                            </div>										
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Harry Richardson</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Roanoke, VA
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Passionate Badminton Coach elevating skills and fostering love for the game and results.</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-details.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>27 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>180 Reviews</span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="assets/img/featured/featured-09.jpg" alt="Venue">
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
                                                    <h5 class="tag tag-primary">From $150 <span>/hr</span></h5>
                                                </div>
                                            </div>										
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Pete Hill</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Huntsville, AL
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Dedicated Badminton Coach refining players skills and techniques to ignite the game</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>22 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>150 Reviews</span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="assets/img/featured/featured-11.jpg" alt="Venue">
                                                </a>
                                                <div class="fav-item-venues">
                                                    <span class="tag tag-blue">Herman</span>	
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
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Washington, MD</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Port Alsworth, AK
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Dedicated badminton expert meticulously perfecting techniques for best results the game.</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>20 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>10 Reviews</span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="assets/img/featured/featured-12.jpg" alt="Venue">
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
                                                    <h5 class="tag tag-primary">From $180 <span>/hr</span></h5>
                                                </div>
                                            </div>										
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Joshua Rogers</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Port Alsworth, AK
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Detail-oriented badminton enthusiast with a patient coaching approach.</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>20 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>80 Reviews</span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->

                                <!-- Featured Item -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="featured-venues-item">
                                        <div class="listing-item listing-item-grid">										
                                            <div class="listing-img">
                                                <a href="coach-detail.html">
                                                    <img src="assets/img/featured/featured-13.jpg" alt="Venue">
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
                                                    <h5 class="tag tag-primary">From $150 <span>/hr</span></h5>
                                                </div>
                                            </div>										
                                            <div class="listing-content">
                                                <h3 class="listing-title">
                                                    <a href="coach-detail.html">Jamal Dean</a>
                                                </h3>
                                                <ul class="mb-2">
                                                    <li>
                                                        <span>
                                                            <i class="feather-map-pin me-2"></i>Roseau, MN
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="listing-details-group">
                                                    <p>Meticulous badminton enthusiast with a gentle coaching style</p>
                                                </div>
                                                <div class="coach-btn">
                                                    <ul>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-primary w-100"><i class="feather-eye me-2"></i>View Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="coach-detail.html" class="btn btn-secondary w-100"><i class="feather-calendar me-2"></i>Book Now</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="avalbity-review">
                                                    <ul>
                                                        <li>
                                                            <div class="avalibity-date">
                                                                <span><i class="feather-calendar"></i></span>
                                                                <div class="avalibity-datecontent">
                                                                    <h6>Next Availabilty</h6>
                                                                    <h5>20 May 2023</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="list-reviews mb-0">							
                                                                <div class="d-flex align-items-center">
                                                                    <span class="rating-bg">4.5</span><span>212 Reviews</span> 
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Featured Item -->
                                
                                <!--Pagination--> 
                                <div class="pagination-group">
                                    <nav>
                                        <ul class="pagination page-item justify-content-center">
                                            <li class="previtem">
                                                <a class="page-link" href="#"><span><i class="feather-chevrons-left"></i></span></a>
                                            </li>
                                            <li class="justify-content-center pagination-center"> 
                                                <div class="page-group">
                                                    <ul>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#"><span><i class="feather-chevron-left"></i></span></a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#">1</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="active page-link" href="#">2 <span class="visually-hidden">(current)</span></a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#">3</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#">4</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#"><span><i class="feather-chevron-right"></i></span></a>
                                                        </li>
                                                    </ul>
                                                </div>													
                                            </li>													
                                            <li class="nextlink">
                                                <a class="page-link" href="#"><span><i class="feather-chevrons-right"></i></span></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!--/Pagination-->
                                
                            </div>
                            <!-- /Listing Content -->
						</div>
					</div>
				</div>
				<!-- Listing Content Group-->	

			</div>

		</div>
		<!-- /Page Content -->
	</div>
	<!-- /Main Wrapper -->

	<!-- Calendar Js -->
    <script src="<?=$frontendAssetUrl?>assets/plugins/simple-calendar/jquery.simple-calendar.js"></script>
    <script src="<?=$frontendAssetUrl?>assets/js/calander.js"></script> 

	<!-- Rangeslider JS -->
    <script src="<?=$frontendAssetUrl?>assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="<?=$frontendAssetUrl?>assets/plugins/ion-rangeslider/js/custom-rangeslider.js"></script>

    <!-- Sticky Sidebar JS -->
	<script src="<?=$frontendAssetUrl?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
	<script src="<?=$frontendAssetUrl?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>	
	<?php
		include("includes/footer.php");
	?>