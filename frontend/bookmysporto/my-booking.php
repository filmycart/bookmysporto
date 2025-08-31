		<?php
			include("includes/page_header.php");
			include("././validate_login.php");

			$curlBookings = curl_init();

		    $bookingUrl = "";
		    if($hostName == "localhost") {
		        $bookingUrl = $requestScheme.'://localhost/bookmysporto/api/event/bookings.php';
		    } else {
		        $bookingUrl = $requestScheme.'://bookmysporto.com/api/event/bookings.php';
		    }

		    $postValArray = array(
		                            'api_token' => '123456789',
		                            'id' => $_SESSION['userId']
		                        );

		    curl_setopt_array($curlBookings, array(
		      CURLOPT_URL => $bookingUrl,
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

		    $bookingresponse = curl_exec($curlBookings);

		    $bookingResponseArr = array();
		    if(!empty($bookingresponse)){
		        $bookingResponseArr = json_decode($bookingresponse, true);
		    }

			/*print"<pre>";
			print_r($bookingResponseArr);
			exit;*/

		    curl_close($curlBookings);
		?>
		<!-- Breadcrumb -->
		<section class="breadcrumb breadcrumb-list mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h1 class="text-white">My Bookings</h1>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li>My Bookings</li>
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
									<a href="user-dashboard.html">
										<img src="<?=$frontendAssetUrl?>assets/img/icons/dashboard-icon.svg" alt="Icon">
										<span>Dashboard</span>
									</a>
								</li>
								<li>
									<a href="user-bookings.html" class="active">
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

		<!-- Page Content -->
		<div class="content court-bg">
			<div class="container">

				<!-- Sort By -->
				<div class="row">
					<div class="col-lg-12">
						<div class="sortby-section court-sortby-section">
							<div class="sorting-info">
								<div class="row d-flex align-items-center">
									<div class="col-xl-7 col-lg-7 col-sm-12 col-12">
										<div class="coach-court-list">
											<ul class="nav">
												<li><a class="active" href="index.php?pg-nm=my-booking&pg-tm=upc">Upcoming</a></li>
												<li><a href="index.php?pg-nm=my-booking&pg-tm=com">Completed</a></li>
												<li><a href="index.php?pg-nm=my-booking&pg-tm=can">Cancelled</a></li>
											</ul>
										</div>
									</div>
									<div class="col-xl-5 col-lg-5 col-sm-12 col-12">
										<div class="sortby-filter-group court-sortby">
											<div class="sortbyset week-bg">
												<div class="sorting-select">
													<select class="form-control select">
														<option>This Week</option>
														<option>One Day</option>
													</select>
												</div>
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

				<div class="row">
					<div class="col-sm-12">
						<div class="court-tab-content">
							<div class="card card-tableset">
								<div class="card-body">
									<div class="coache-head-blk">
										<div class="row align-items-center">
											<div class="col-md-5">
												<div class="court-table-head">
													<h4>My Bookings</h4>
													<p>Manage and track all your upcoming bookings.</p>
												</div>
											</div>
											<div class="col-md-7">
												<div class="table-search-top">
													<div id="tablefilter"></div>
													<div class="request-coach-list">
														<div class="card-header-btns">
															<nav>
																<div class="nav nav-tabs" role="tablist">
																	<button class="nav-link active" id="nav-Recent-tab" data-bs-toggle="tab" data-bs-target="#nav-Recent" type="button" role="tab" aria-controls="nav-Recent" aria-selected="true">Event</button>
																	<!-- <button class="nav-link" id="nav-RecentCoaching-tab" data-bs-toggle="tab" data-bs-target="#nav-RecentCoaching" type="button" role="tab" aria-controls="nav-RecentCoaching" aria-selected="false">Coaches</button> -->
																</div>
															</nav>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="nav-Recent" role="tabpanel" aria-labelledby="nav-Recent-tab"
											tabindex="0">
											<div class="table-responsive table-datatble">
												<table class="table datatable">
													<thead class="thead-light">
														<tr>
														   <th>Event Name</th>	
														   <th>Player Name</th>
														   <th>Start Date & Time</th>
														   <th>End Date & Time</th>
														   <th>Price</th>
														   <th>Details</th>
														   <th>Event Type</th>
														   <th>Status</th>
														   <th></th>
														</tr>
													</thead>
													<tbody>
														<?php
															/*print"<pre>";
															print_r($bookingResponseArr['data']);
															exit;*/

															if((isset($bookingResponseArr['data'])) && (!empty($bookingResponseArr['data']))) {
																foreach($bookingResponseArr['data'] as $bookingResponseVal) {

																	$bookingArray = "";
																	if((isset($bookingResponseVal['booking'])) && (!empty($bookingResponseVal['booking']))) {
																		$bookingArray = json_decode($bookingResponseVal['booking']);
																	}

																	$bookingPlayerName = "";
																	if((isset($bookingResponseVal['bookingPlayerName'])) && (!empty($bookingResponseVal['bookingPlayerName']))) {
																		$bookingPlayerName = $bookingResponseVal['bookingPlayerName'];
																	}

																	$eventStartDate = "";
																	if((isset($bookingResponseVal['eventStartDate'])) && (!empty($bookingResponseVal['eventStartDate']))) {
																		$eventStartDate = $bookingResponseVal['eventStartDate'];
																	}

																	$eventStartDateStrToTime = strtotime($eventStartDate);
																	$eventStartDateTimeDay = date('d',$eventStartDateStrToTime);
																	$eventStartDateMonth = date("F",$eventStartDateStrToTime);
																	$eventStartDateYear = date("Y",$eventStartDateStrToTime);	
																	$eventStartDateTime = date("h:i A",$eventStartDateStrToTime);															

																	$eventStartDateStrToTimeWithoutTime = date("m/d/Y", strtotime($eventStartDate));
																
																    $currentTimestamp = strtotime("now");
																	$currentDateTime = date("m/d/Y", $currentTimestamp);

																    $eventBookingWhen = "";
																    if ($eventStartDateStrToTimeWithoutTime > $currentDateTime) {
																        $eventBookingWhen = "Future Event";
																    } else if ($eventStartDateStrToTimeWithoutTime < $currentDateTime) {
																        $eventBookingWhen = "Past Event";
																    } else {
																        $eventBookingWhen = "Current Event";
																    }

																	$eventEndDate = "";
																	if((isset($bookingResponseVal['eventEndDate'])) && (!empty($bookingResponseVal['eventEndDate']))) {
																		$eventEndDate = $bookingResponseVal['eventEndDate'];
																	}

																	$eventEndDateStrToTime = strtotime($eventEndDate);
																	$eventEndDateTimeDay = date('d',$eventEndDateStrToTime);
																	$eventEndDateMonth = date("F",$eventEndDateStrToTime);
																	$eventEndDateYear = date("Y",$eventEndDateStrToTime);	
																	$eventEndDateTime = date("h:i A",$eventEndDateStrToTime);															

																	$totalAmount = "";
																	if((isset($bookingResponseVal['bookingTotalAmount'])) && (!empty($bookingResponseVal['bookingTotalAmount']))) {
																		$totalAmount = $bookingResponseVal['bookingTotalAmount'];
																	}

																	$statusDisplay = "Payment Pending";
																	if((isset($bookingResponseVal['status'])) && (!empty($bookingResponseVal['status']))) {
																		if($bookingResponseVal['status'] == 1) {
																			$statusDisplay = "Payment Pending";
																		} else if($bookingResponseVal['status'] == 2) {
																			$statusDisplay = "Payment Done";
																		}
																	}

																	$eventTitle = "";
																	if((isset($bookingResponseVal['eventTitle'])) && (!empty($bookingResponseVal['eventTitle']))) {
																		$eventTitle = $bookingResponseVal['eventTitle'];
																	}

																	$eventId = "";
																	if((isset($bookingResponseVal['eventId'])) && (!empty($bookingResponseVal['eventId']))) {
																		$eventId = $bookingResponseVal['eventId'];
																	}																	

																	$eventUrl = 'index.php?pg-nm=event-details&id='.$eventId;
																	$eventTitleDisp = '<a href="'.$eventUrl.'" title="'.$eventTitle.'">'.substr($eventTitle, 0, 10).'...</a>';
														?>
															<tr>
																<td>
																	<h4><?=$eventTitleDisp?></h4>
																</td>
																<td>
																	<h2 class="table-avatar">
																		<!-- <a href="#" class="avatar avatar-sm  flex-shrink-0"><img class="avatar-img" src="<?=$frontendAssetUrl?>assets/img/booking/booking-03.jpg" alt="User"></a> -->
																		<span class="table-head-name flex-grow-1">
																			<span><?=$bookingPlayerName?></span>
																		</span>
																	</h2>
																</td>
																<td class="table-date-time">
																	<h4><?=$eventStartDateTimeDay?>, <?=$eventStartDateMonth?> <?=$eventStartDateYear?><span><?=$eventStartDateTime?></span></h4>
																</td>
																<td class="table-date-time">
																	<h4><?=$eventEndDateTimeDay?>, <?=$eventEndDateMonth?> <?=$eventEndDateYear?><span><?=$eventEndDateTime?></span></h4>
																</td>
																<!-- <td><span class="pay-dark fs-16">₹<?=$totalAmount?></span></td> -->
																<td><span class="pay-dark fs-16">₹<?=$totalAmount?></span></td>
																<td class="text-pink view-detail-pink"><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#upcoming-court"><i class="feather-eye"></i>View Details</a></td>
																<td><span class="badge bg-info"><i class="feather-clock me-1"></i><?=$eventBookingWhen?></span></td>
																<td><span class="badge bg-info"><?=$statusDisplay?></td>
																<!-- <td><a href="user-chat.html"><img src="<?=$frontendAssetUrl?>assets/img/icons/chat-icon-01.svg" alt="Chat" class="me-2">Chat</a></td> -->
																<td class="text-end">
																	<div class="dropdown dropdown-action table-drop-action">
																		<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
																		<div class="dropdown-menu dropdown-menu-end">
																			<a class="dropdown-item" href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#cancel-court"><i class="feather-corner-down-left"></i>Cancel Booking</a>
																			<a class="dropdown-item" href="javascript:void(0);"><i class="feather-edit"></i>Edit</a>
																			<a class="dropdown-item" href="javascript:void(0);"><i class="feather-trash"></i>Delete</a>
																		</div>
																	</div>
																</td>
															</tr>
														<?php 
																}
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>									
								</div>
							</div> 
							<div class="tab-footer">
								<div class="row">
									<div class="col-md-6">
										<div id="tablelength"></div>
									</div>
									<div class="col-md-6">
										<div id="tablepage"></div>
									</div>
								</div>
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
		<!-- upcoming Modal -->
		<div class="modal custom-modal fade request-modal" id="upcoming-court" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<div class="form-header modal-header-title">
							<h4 class="mb-0">Court Booking Details<span class="badge bg-info ms-2">Upcoming</span></h4>
						</div>
						<a  class="close" data-bs-dismiss="modal" aria-label="Close">
							<span class="align-center" aria-hidden="true"><i class="feather-x"></i></span>
						</a>
					</div>
					<div class="modal-body">

						<!-- Court Request -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Court Information</h4>
									</div>
									<div class="appointment-info">
										<ul class="appointmentset">
											<li>
												<div class="appointment-item">
													<div class="appointment-img">
														<img src="<?=$frontendAssetUrl?>assets/img/booking/booking-03.jpg" alt="Booking">
													</div>
													<div class="appointment-content">
														<h6>Wing Sports Academy</h6>
														<p class="color-green">Court 1</p>
													</div>
												</div>
											</li>
											<li>
												<h6>Booked On</h6>
												<p>$150 Upto 2 guests</p>
											</li>
											<li>
												<h6>Price Per Guest</h6>
												<p>$15</p>
											</li>
											<li>
												<h6>Maximum Number of Guests</h6>
												<p>2</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Appointment Information</h4>
									</div>
									<div class="appointment-info appoin-border">
										<ul class="appointmentset">
											<li>
												<h6>Booked On</h6>
												<p>Mon, Jul 14</p>
											</li>
											<li>
												<h6>Date & Time</h6>
												<p>Mon, Jul 14</p>
												<p>05:00 PM - 08:00 PM</p>
											</li>
											<li>
												<h6>Total Number of Hours</h6>
												<p>2</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Payment Details</h4>
									</div>
									<div class="appointment-info appoin-border double-row">
										<ul class="appointmentset">
											<li>
												<h6>Court Booking Amount</h6>
												<p>$150</p>
											</li>
											<li>
												<h6>Additional Guests</h6>
												<p>2</p>
											</li>
											<li>
												<h6>Amount Additional Guests</h6>
												<p>$30</p>
											</li>
											<li>
												<h6>Service Charge</h6>
												<p>$20</p>
											</li>
										</ul>
									</div>
									<div class="appointment-info appoin-border ">
										<ul class="appointmentsetview">
											<li>
												<h6>Total Amount Paid</h6>
												<p class="color-green">$180</p>
											</li>
											<li>
												<h6>Paid On</h6>
												<p>Mon, Jul 14</p>
											</li>
											<li>
												<h6>Transaction ID</h6>
												<p>#5464164445676781641</p>
											</li>
											<li>
												<h6>Payment type</h6>
												<p>Wallet</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- /Court Request -->

					</div>
					<div class="modal-footer">
						<div class="table-accept-btn">
							<a href="javascript:;" data-bs-dismiss="modal" class="btn cancel-table-btn">Cancel</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /upcoming Modal -->

		<!-- upcoming Modal -->
		<div class="modal custom-modal fade request-modal" id="upcoming-coach" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<div class="form-header modal-header-title">
							<h4 class="mb-0">Court Information<span class="badge bg-info ms-2">Upcoming</span></h4>
						</div>
						<a  class="close" data-bs-dismiss="modal" aria-label="Close">
							<span class="align-center" aria-hidden="true"><i class="feather-x"></i></span>
						</a>
					</div>
					<div class="modal-body">

						<!-- Court Request -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Court Information</h4>
									</div>
									<div class="appointment-info">
										<ul class="appointmentset">
											<li>
												<div class="appointment-item">
													<div class="appointment-img">
														<img src="<?=$frontendAssetUrl?>assets/img/featured/featured-06.jpg" alt="Venue">
													</div>
													<div class="appointment-content">
														<h6>Angela Roudrigez</h6>
														<div class="table-rating">
															<div class="rating-point">
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<span>30 Reviews</span>
														   </div>
														</div>
													</div>
												</div>
											</li>
											<li>
												<h6>Location</h6>
												<p>Santa Monica, CA</p>
											</li>
											<li>
												<h6>Price Per Hour</h6>
												<p class="text-primary fw-semibold fs-16">$200.00 / hr</p>
											</li>
											<li>
												<h6>Rank</h6>
												<p>Expert</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Appointment Information</h4>
									</div>
									<div class="appointment-info appoin-border">
										<ul class="appointmentset">
											<li>
												<h6>Booked On</h6>
												<p>Mon, Jul 14</p>
											</li>
											<li>
												<h6>Booking Type</h6>
												<p>Single Lesson</p>
												<p>3 Days * 1 hour  @ <span class="text-primary">$150.00</span></p>
											</li>
											<li>
												<h6>Total Number of Hours</h6>
												<p>2</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Booking Days</h4>
									</div>
									<div class="booking-days">
										<ul>
											<li class="active">
												<img src="<?=$frontendAssetUrl?>assets/img/icons/reset.svg" class="me-2" alt="Icon">
												<i class="feather-check-circle me-2"></i>
												14  May 2023 - 7:00 PM
												<i class="fa fa-check-circle ms-2"></i>
											</li>
											<li class="active">
												<img src="<?=$frontendAssetUrl?>assets/img/icons/reset.svg" class="me-2" alt="Icon">
												<i class="feather-check-circle me-2"></i>
												15  May 2023 - 7:00 PM
												<i class="fa fa-check-circle ms-2"></i>
											</li>
											<li>
												<img src="<?=$frontendAssetUrl?>assets/img/icons/reset.svg" class="me-2" alt="Icon">
												<i class="feather-check-circle me-2"></i>
												16  May 2023 - 7:00 PM
												<i class="fa fa-check-circle ms-2"></i>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Payment Details</h4>
									</div>
									<div class="appointment-info appoin-border double-row">
										<ul class="appointmentset">
											<li>
												<h6>Coaching Booking Amount</h6>
												<p>$200</p>
											</li>
											<li>
												<h6>Service Charge</h6>
												<p>$20</p>
											</li>
											<li>
												<h6>Total Amount Paid</h6>
												<p class="text-primary fs-16">$420</p>
											</li>
										</ul>
									</div>
									<div class="appointment-info appoin-border ">
										<ul class="appointmentset">
											<li>
												<h6>Paid On</h6>
												<p>Mon, Jul 14</p>
											</li>
											<li>
												<h6>Transaction ID</h6>
												<p>#5464164445676781641</p>
											</li>
											<li>
												<h6>Payment type</h6>
												<p>Visa Card</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- /Court Request -->

					</div>
					<div class="modal-footer">
						<div class="table-accept-btn">
							<a href="javascript:;" data-bs-dismiss="modal" class="btn cancel-table-btn">Cancel</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /upcoming Modal -->

		<!-- profile Modal -->
		<div class="modal custom-modal fade request-modal" id="profile-coach" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<div class="form-header modal-header-title">
							<h4 class="mb-0">Coach Profile</h4>
						</div>
						<a  class="close" data-bs-dismiss="modal" aria-label="Close">
							<span class="align-center" aria-hidden="true"><i class="feather-x"></i></span>
						</a>
					</div>
					<div class="modal-body">

						<!-- Court Request -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card dashboard-card court-information">
									<div class="profile-set">
										<div class="profile-set-image">
											<img src="<?=$frontendAssetUrl?>assets/img/featured/featured-05.jpg" alt="Venue">
										</div>
										<div class="profile-set-content">
											<h3>Kevin Anderson</h3>
											<div class="rating-city">
												<div class="profile-set-rating">
													<span>4.5</span>
													<h6>300 Reviews</h6>
												</div>
												<div class="profile-set-img">
													<img src="<?=$frontendAssetUrl?>assets/img/flag/usa.png" alt="User">
													<h6>Santamanica, United states</h6>
												</div>
											</div>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.industry's</p>
											<ul>
												<li>
													<img src="<?=$frontendAssetUrl?>assets/img/icons/rank.svg" alt="Icon">
													<h6>Rank : Expert</h6>
												</li>
												<li>
													<img src="<?=$frontendAssetUrl?>assets/img/icons/process.svg" alt="Icon">
													<h6>Sessions Completed : 25</h6>
												</li>
												<li>
													<img src="<?=$frontendAssetUrl?>assets/img/icons/calendar-alt.svg" alt="Icon">
													<h6>With Dreamsport since<span> Apr 5, 2023</span></h6>
												</li>
											</ul>
										</div>
										<div class="price-set-price">
											<h6>Start’s From</h6>
											<h5>$250<span>/hr</span></h5>
										</div>
									</div>
								</div>
								<div class="profile-tab">
									<ul class="nav nav-tabs"  role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
												role="tab"  aria-selected="true">Profile Info</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="appointment-tab" data-bs-toggle="tab" data-bs-target="#appointment" type="button"
												role="tab"  aria-selected="false">Appointment Details</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button"
												role="tab" aria-selected="false">Reviews</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="previous-tab" data-bs-toggle="tab" data-bs-target="#previous" type="button"
												role="tab"  aria-selected="false">Previous Booking</button>
										</li>
									</ul>
									<div class="tab-content" >
										<div class="tab-pane fade show active" id="profile" role="tabpanel" >
											<div class="profile-card mb-0">
												<div class="profile-card-title">
													<h4>Contact  Information</h4>
												</div>
												<div class="profile-contact-details">
													<ul>
														<li>
															<span>Email Address</span>
															<h6>contact@example.com</h6>
														</li>
														<li>
															<span>Phone Number</span>
															<h6>+1 56565 556558</h6>
														</li>
														<li>
															<span> Address</span>
															<h6>1653 Davisson Street,Indianapolis, IN 46225</h6>
														</li>
													</ul>
												</div>
												<div class="profile-card-title">
													<h4>Short Bio</h4>
												</div>
												<div class="profile-card-content">
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Varius consectetur a at est diam ultricies. Egestas eros leo dapibus tellus neque turpis. Nec in morbi adipiscing pretium accumsan urna ac,Lorem ipsum dolor sit amet, consectetur adipiscing elit. Varius consectetur a at est diam ultricies. Egestas eros leo dapibus tellus neque turpis. Nec in morbi adipiscing pretium accumsan urna ac,Lorem ipsum dolor sit amet, consectetur adipiscing elit. Varius consectetur a at est diam ultricies. Egestas eros leo dapibus tellus neque turpis. Nec in morbi adipiscing pretium accumsan urna ac,</p>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
											<!-- Accordian Contents -->
											<div class="accordion" >
												<div class="accordion-item mb-4" >
													<h4 class="accordion-header" >
														<button class="accordion-button" type="button" >
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/short-bio.svg" alt="Icon"></span> Short Bio
														</button>
													</h4>
													<div  class="accordion-collapse" >
														<div class="accordion-body">
															<div class="text show-more-height">
																<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>

																<ul>
																	<li>4 years of high school (3 years varsity)</li>
																	<li>3 years of college club badminton at Loyola Marymount</li>
																	<li>I grew up at North Venice Little League and represented</li><li>Southern California in 2017 for Senior State Champs.</li>
																	<li>3 years on Varsity   at Venice High School. Venice Varsity</li>
																	<li>badminton Western League Champs 2017.</li>
																	<li>2 years of Loyola Marymount University Club badminton.</li>
																</ul>
																<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
																<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
																<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
																<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
															</div>
															<div class="show-more d align-items-center primary-text"><i class="feather-plus-circle"></i>Show More</div>
														</div>
													</div>
												</div>
												<div class="accordion-item mb-4" >
													<h4 class="accordion-header" >
														<button class="accordion-button" type="button">
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/lesson-with-me.svg" alt="Icon"></span> Lesson With me
														</button>
													</h4>
													<div  class="accordion-collapse">
														<div class="accordion-body">
															<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
															<ul>
																<li><i class="feather-check-square"></i>Single Lesson</li>
																<li><i class="feather-check-square"></i>2 Player Lesson</li>
																<li><i class="feather-check-square"></i>Small group Lesson</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="accordion-item mb-4" >
													<h4 class="accordion-header" >
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/coaching.svg" alt="Icon"></span> Coaching
														</button>
													</h4>
													<div  class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-coaching">
														<div class="accordion-body">
															<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
														</div>
													</div>
												</div>
												<div class="accordion-item mb-4" >
													<h4 class="accordion-header" >
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" >
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/gallery.svg" alt="Icon"></span> Gallery
														</button>
													</h4>
													<div  class="accordion-collapse">
														<div class="accordion-body">
															<div class="owl-carousel gallery-slider owl-theme">
																<div>
																	<img class="img-fluid" alt="Gallery" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-15.jpg">
																</div>
																<div>
																	<img class="img-fluid" alt="Gallery" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-16.jpg">
																</div>
																<div>
																	<img class="img-fluid" alt="Gallery" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-17.jpg">
																</div>
																<div>
																	<img class="img-fluid" alt="Gallery" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-16.jpg">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="accordion-item" id="location">
													<h4 class="accordion-header" id="panelsStayOpen-location">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/location.svg" alt="Icon"></span> Location
														</button>
													</h4>
													<div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-location">
														<div class="accordion-body">
															<div class="google-maps">
																<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.8862835683544!2d-73.98256668525309!3d41.93829486962529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89dd0ee3286615b7%3A0x42bfa96cc2ce4381!2s132%20Kingston%20St%2C%20Kingston%2C%20NY%2012401%2C%20USA!5e0!3m2!1sen!2sin!4v1670922579281!5m2!1sen!2sin" height="170" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
															</div>
															<div class="dull-bg d-flex justify-content-start align-items-center mb-3">
																<div class="white-bg me-2">
																	<i class="fas fa-location-arrow"></i>
																</div>
																<div class="">
																	<h6>Our Venue Location</h6>
																	<p>70 Bright St New York, USA</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- Accordian Contents -->
										</div>
										<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
											<div class="review-box review-box-user d-flex">
												<div class="review-profile">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-01.jpg" class="img-fluid" alt="User">
												</div>
												<div class="review-info">
													<h6 class="mb-2 tittle">Amanda Booked on 06/04/2023</h6>
													<div class="rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<span class="">5.0</span>
												   </div>
													<span class="success-text"><i class="feather-check"></i>Yes, I would book again.</span>
													<h6>Absolutely perfect</h6>
													<p>If you are looking for a perfect place for friendly matches with your friends or a competitive match, It is the best place.</p>
													<ul class="review-gallery">
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-01.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-01.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-02.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-02.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-03.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-03.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-04.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-04.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-05.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-05.jpg">
															  </a>
														</li>
													</ul>
													<span class="post-date">Sent on 11/03/2023</span>
												</div>
											</div>
											<div class="review-box review-box-user d-flex">
												<div class="review-profile">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-02.jpg" class="img-fluid" alt="img">
												</div>
												<div class="review-info">
													<h6 class="mb-2 tittle">Amanda Booked on 06/04/2023</h6>
													<div class="rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<span class="">5.0</span>
												   </div>
													<h6>Awesome. Its very convenient to play.</h6>
													<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic!!</p>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="previous" role="tabpanel" aria-labelledby="previous-tab">
											<div class="preview-tab">
												<ul>
													<li>
														<div class="preview-tabcontent">
															<div class="preview-tabimg">
																<img src="<?=$frontendAssetUrl?>assets/img/services/service-01.jpg" alt="Service">
															</div>
															<div class="preview-tabname">
																<h4>Leap Sports Academy</h4>
																<h5>Court 1</h5>
																<ul>
																	<li><span>Guests : 4</span></li>
																	<li><span>2 Hrs</span></li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<h6>Date & Time</h6>
														<span class="d-block">Mon, Jul 11</span>
														<span>06:00 PM - 08:00 PM</span>
													</li>
													<li>
														<h6>$400</h6>
													</li>
												</ul>
											</div>
											<div class="preview-tab">
												<ul>
													<li>
														<div class="preview-tabcontent">
															<div class="preview-tabimg">
																<img src="<?=$frontendAssetUrl?>assets/img/services/service-02.jpg" alt="Service">
															</div>
															<div class="preview-tabname">
																<h4>Marsh Academy</h4>
																<h5>Court 1</h5>
																<ul>
																	<li><span>Guests : 4</span></li>
																	<li><span>2 Hrs</span></li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<h6>Date & Time</h6>
														<span class="d-block">Mon, Jul 11</span>
														<span>06:00 PM - 08:00 PM</span>
													</li>
													<li>
														<h6>$300</h6>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Court Request -->
					</div>
				</div>
			</div>
		</div>
		<!-- /upcoming Modal -->

		<!-- profile Modal -->
		<div class="modal custom-modal fade request-modal" id="profile-court" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<div class="form-header modal-header-title">
							<h4 class="mb-0">Coach Profile</h4>
						</div>
						<a  class="close" data-bs-dismiss="modal" aria-label="Close">
							<span class="align-center" aria-hidden="true"><i class="feather-x"></i></span>
						</a>
					</div>
					<div class="modal-body">

						<!-- Court Request -->
						<div class="row">
							<div class="col-lg-12">
								<div class="master-academy dull-whitesmoke-bg card master-academyview">
									<div class="row d-flex align-items-center justify-content-center">
										<div class="col-12 col-sm-12 col-md-12 col-lg-8">
											<div class="d-sm-flex justify-content-start align-items-center">
												<a href="javascript:void(0);"><img class="corner-radius-10" src="<?=$frontendAssetUrl?>assets/img/master-academy.png" alt="Academy"></a>
												<div class="info">
													<h3 class="mb-2">Manchester Academy</h3>
													<div class="profile-set-content w-100 p-0">
														<ul class="bg-transparent p-0">
															<li>
																<img src="<?=$frontendAssetUrl?>assets/img/icons/location.svg" alt="Icon">
																<h6> 70 Bright St New York, USA</h6>
															</li>
															<li>
																<img src="<?=$frontendAssetUrl?>assets/img/icons/call.svg" alt="Icon">
																<h6>+3 80992 31212</h6>
															</li>
															<li>
																<img src="<?=$frontendAssetUrl?>assets/img/icons/mail.svg" alt="Icon">
																<h6> yourmail@example.com</h6>
															</li>
														</ul>
													</div>
													<div class="coach-profile-set">
														<ul class="bg-transparent p-0">
															<li>
																<div class="coach-profile-set-img">
																	<img src="<?=$frontendAssetUrl?>assets/img/icons/indoor.svg" alt="Icon">
																</div>
																<div class="coach-profile-set-contemt">
																	<h5>Venue </h5>
																	<span> Indoor</span>
																</div>
															</li>
															<li>
																<div class="coach-profile-set-img ">
																	<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-01.jpg" alt="Icon">
																</div>
																<div class="coach-profile-set-contemt">
																	<h5>Venue </h5>
																	<span> Indoor</span>
																</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-12 col-md-12 col-lg-4">
											<ul class="d-sm-flex align-items-center justify-content-evenly">
												<li>
													<h3 class="d-inline-block">$150</h3><span>/hr</span>
													<p>up to 1 guests</p>
												</li>
												<li>
													<span><i class="feather-plus"></i></span>
												</li>
												<li class="text-center">
													<h3 class="d-inline-block">$5</h3><span>/hr</span>
													<p>each additional guest <br>up to 4 guests max</p>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="profile-tab">
									<ul class="nav nav-tabs"  role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile1" type="button"
												role="tab"  aria-selected="true">Profile Info</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="appointment-tab1" data-bs-toggle="tab" data-bs-target="#appointment1" type="button"
												role="tab" aria-selected="false">Appointment Details</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="reviews-tab1" data-bs-toggle="tab" data-bs-target="#reviews1" type="button"
												role="tab" aria-selected="false">Reviews</button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="previous-tab1" data-bs-toggle="tab" data-bs-target="#previous1" type="button"
												role="tab"  aria-selected="false">Previous Booking</button>
										</li>
									</ul>
									<div class="tab-content" >
										<div class="tab-pane fade show active" id="profile1" role="tabpanel" >
											<div class="profile-card mb-0">
												<div class="profile-card-title">
													<h4>Contact  Information</h4>
												</div>
												<div class="profile-contact-details mb-0">
													<ul>
														<li>
															<span>Email Address</span>
															<h6>contact@example.com</h6>
														</li>
														<li>
															<span>Phone Number</span>
															<h6>+1 56565 556558</h6>
														</li>
														<li>
															<span> Address</span>
															<h6>1653 Davisson Street,Indianapolis, IN 46225</h6>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="appointment1" role="tabpanel">
											<!-- Accordian Contents -->
											<div class="accordion" >
												<div class="accordion-item mb-4" >
													<h4 class="accordion-header">
														<button class="accordion-button" type="button">
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/Black.svg" alt="Icon"></span>Overview						
														</button>
													</h4>
													<div  class="accordion-collapse " >
														<div class="accordion-body">
															<div class="text">
																<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
																<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
																<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem IpsumLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
															</div>
														</div>
													</div>
												</div>
												<div class="accordion-item mb-4" >
													<h4 class="accordion-header" >
														<button class="accordion-button" type="button" >
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/lesson-with-me.svg" alt="Icon"></span> Rules
														</button>
													</h4>
													<div  class="accordion-collapse ">
														<div class="accordion-body">
															<p><i class="feather-alert-octagon text-danger me-2"></i>Non Marking Shoes are recommended not mandatory for Badminton.</p>
																<p><i class="feather-alert-octagon text-danger me-2"></i>A maximum number of members per booking per badminton court is admissible fixed by Venue Vendors</p>
																<p><i class="feather-alert-octagon text-danger me-2"></i>No pets, no seeds, no gum, no glass, no hitting or swinging outside of the cage</p>
														</div>
													</div>
												</div>
												<div class="accordion-item mb-4">
													<h4 class="accordion-header" >
														<button class="accordion-button" type="button">
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/lesson-with-me.svg" alt="Icon"></span> Amenities
														</button>
													</h4>
													<div  class="accordion-collapse">
														<div class="accordion-body">
															<ul class="amenities-set">
																<li>
																	<span><i class="fa fa-check-circle text-success me-2" aria-hidden="true"></i>Parking</span>
																</li>
																<li>
																	<span><i class="fa fa-check-circle text-success me-2" aria-hidden="true"></i>Drinking Water</span>
																</li>
																<li>
																	<span><i class="fa fa-check-circle text-success me-2" aria-hidden="true"></i>First Aid</span>
																</li>
																<li>
																	<span><i class="fa fa-check-circle text-success me-2" aria-hidden="true"></i>Change Room</span>
																</li>
																<li>
																	<span><i class="fa fa-check-circle text-success me-2" aria-hidden="true"></i>Shower</span>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="accordion-item mb-4" id="coaching">
													<h4 class="accordion-header" id="panelsStayOpen-coaching">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/includes1.svg" alt="Icon"></span> Includes
														</button>
													</h4>
													<div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-coaching">
														<div class="accordion-body includes-set">
															<ul>
																<li><i class="feather-check-square"></i>Badminton Racket Unlimited</li>
																<li><i class="feather-check-square"></i>Bats</li>
																<li><i class="feather-check-square"></i>Hitting Machines</li>
																<li><i class="feather-check-square"></i>Multiple Courts</li>
															</ul>
															<ul>
																<li><i class="feather-check-square"></i>Spare Players</li>
																<li><i class="feather-check-square"></i>Instant Racket</li>
																<li><i class="feather-check-square"></i>Hitting Machines</li>
																<li><i class="feather-check-square"></i>Green Turfs</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="accordion-item mb-4" >
													<h4 class="accordion-header">
														<button class="accordion-button" type="button" >
															<span class="icon-bg"><img src="<?=$frontendAssetUrl?>assets/img/icons/gallery.svg" alt="Image"></span> Gallery
														</button>
													</h4>
													<div  class="accordion-collapse ">
														<div class="accordion-body">
															<div class="owl-carousel gallery-slider owl-theme">
																<div>
																	<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-18.jpg">
																</div>
																<div>
																	<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-19.jpg">
																</div>
																<div>
																	<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-20.jpg">
																</div>
																<div>
																	<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery4/gallery-20.jpg">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- Accordian Contents -->
										</div>
										<div class="tab-pane fade" id="reviews1" role="tabpanel" >
											<div class="review-box review-box-user d-flex">
												<div class="review-profile">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-03.jpg" class="img-fluid" alt="User">
												</div>
												<div class="review-info">
													<h6 class="mb-2 tittle">Amanda Booked on 06/04/2023</h6>
													<div class="rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<span class="">5.0</span>
												   </div>
													<span class="success-text"><i class="feather-check"></i>Yes, I would book again.</span>
													<h6>Absolutely perfect</h6>
													<p>If you are looking for a perfect place for friendly matches with your friends or a competitive match, It is the best place.</p>
													<ul class="review-gallery">
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-01.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-01.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-02.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-02.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-03.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-03.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-04.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-04.jpg">
															  </a>
														</li>
														<li>
															<a href="<?=$frontendAssetUrl?>assets/img/gallery/gallery-05.jpg" data-fancybox="gallery">
																<img class="img-fluid" alt="Image" src="<?=$frontendAssetUrl?>assets/img/gallery/gallery-05.jpg">
															  </a>
														</li>
													</ul>
													<span class="post-date">Sent on 11/03/2023</span>
												</div>
											</div>
											<div class="review-box review-box-user d-flex">
												<div class="review-profile">
													<img src="<?=$frontendAssetUrl?>assets/img/profiles/avatar-02.jpg" class="img-fluid" alt="User">
												</div>
												<div class="review-info">
													<h6 class="mb-2 tittle">Amanda Booked on 06/04/2023</h6>
													<div class="rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<span class="">5.0</span>
												   </div>
													<h6>Awesome. Its very convenient to play.</h6>
													<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic!!</p>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="previous1" role="tabpanel" >
											<div class="profile-card">
												<div class="preview-tab">
													<ul>
														<li>
															<div class="preview-tabcontent">
																<div class="preview-tabimg">
																	<img src="<?=$frontendAssetUrl?>assets/img/featured/featured-05.jpg" alt="Venue">
																</div>
																<div class="preview-tabname">
																	<h4>Kevin Anderson</h4>
																	<h5>Onetime</h5>
																</div>
															</div>
														</li>
														<li>
															<h6>Date & Time</h6>
															<span class="d-block">Mon, Jul 11</span>
															<span>06:00 PM - 08:00 PM</span>
														</li>
														<li>
															<h6>$400</h6>
														</li>
													</ul>
												</div>
												<div class="preview-tab">
													<ul>
														<li>
															<div class="preview-tabcontent">
																<div class="preview-tabimg">
																	<img src="<?=$frontendAssetUrl?>assets/img/featured/featured-06.jpg" alt="Venue">
																</div>
																<div class="preview-tabname">
																	<h4>Evon Raddick</h4>
																	<h5>Onetime</h5>
																</div>
															</div>
														</li>
														<li>
															<h6>Date & Time</h6>
															<span class="d-block">Mon, Jul 11</span>
															<span>06:00 PM - 08:00 PM</span>
														</li>
														<li>
															<h6>$300</h6>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Court Request -->
					</div>
				</div>
			</div>
		</div>
		<!-- /profile Modal -->

		<!-- cancel Modal -->
		<div class="modal custom-modal fade request-modal" id="cancel-court" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<div class="form-header modal-header-title">
							<h4 class="mb-0">Coach Booking Details<span class="badge bg-danger ms-2">Cancelled</span></h4>
						</div>
						<a  class="close" data-bs-dismiss="modal" aria-label="Close">
							<span class="align-center" aria-hidden="true"><i class="feather-x"></i></span>
						</a>
					</div>
					<div class="modal-body">

						<!-- Court Request -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Court Information</h4>
									</div>
									<div class="appointment-info">
										<ul class="appointmentset">
											<li>
												<div class="appointment-item">
													<div class="appointment-img">
														<img src="<?=$frontendAssetUrl?>assets/img/featured/featured-06.jpg" alt="Venue">
													</div>
													<div class="appointment-content">
														<h6>Angela Roudrigez</h6>
														<div class="table-rating">
															<div class="rating-point">
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<span>30 Reviews</span>
														   </div>
														</div>
													</div>
												</div>
											</li>
											<li>
												<h6>Location</h6>
												<p>Santa Monica, CA</p>
											</li>
											<li>
												<h6>Price Per Hour</h6>
												<p>$200.00 / hr</p>
											</li>
											<li>
												<h6>Rank</h6>
												<p>Expert</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Appointment Information</h4>
									</div>
									<div class="appointment-info appoin-border">
										<ul class="appointmentset">
											<li>
												<h6>Booked On</h6>
												<p>Mon, Jul 14</p>
											</li>
											<li>
												<h6>Booking Type</h6>
												<p>Onetime</p>
											</li>
											<li>
												<h6>Date & Time</h6>
												<p>Mon, Jul 14
												<span>05:00 PM - 08:00 PM</span></p>

											</li>
											<li>
												<h6>Total Number of Hours</h6>
												<p>2</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information">
									<div class="card-header">
										<h4>Payment Details</h4>
									</div>
									<div class="appointment-info appoin-border double-row">
										<ul class="appointmentset">
											<li>
												<h6>Coaching Booking Amount</h6>
												<p>$200</p>
											</li>
											<li>
												<h6>Number of Hours</h6>
												<p>2</p>
											</li>
											<li>
												<h6>Service Charge</h6>
												<p>$20</p>
											</li>
										</ul>
									</div>
									<div class="appointment-info appoin-border ">
										<ul class="appointmentset">
											<li>
												<h6>Total Amount Paid</h6>
												<p class="color-green">$180</p>
											</li>
											<li>
												<h6>Paid On</h6>
												<p>Mon, Jul 14</p>
											</li>
											<li>
												<h6>Transaction ID</h6>
												<p>#5464164445676781641</p>
											</li>
											<li>
												<h6>Payment type</h6>
												<p>Wallet</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="card dashboard-card court-information mb-0">
									<div class="card-header">
										<h4>Reason for Cancellation</h4>
									</div>
									<div class="user-review-details">
										<div class="user-review-content">
											<h6 class="text-danger">Cancelled By Coach</h6>
											<p>If you are looking for a perfect place for friendly matches with your friends or a competitive match, It is the best place.</p>
											<h5>Sent on 11/03/2023</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Court Request -->

					</div>
					<div class="modal-footer">
						<div class="table-accept-btn table-btn-split">
							<a href="javascript:;"  class="btn initiate-table-btn">Initiate Refund</a>
							<a href="javascript:;" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /cancel Modal -->