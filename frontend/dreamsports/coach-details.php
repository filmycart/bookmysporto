		<?php
			include("includes/header.php");
		?>
		<!-- Breadcrumb -->
		<div class="breadcrumb mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h1 class="text-white">Book A Coach</h1>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li>Book A Coach</li>
				</ul>
			</div>
		</div>
		<!-- /Breadcrumb -->
		<section class="booking-steps py-30">
			<span class="primary-right-round"></span>
			<div class="container">
				<ul class="d-xl-flex justify-content-center align-items-center">
					<li class="active"><h5><a href="coach-details.html"><span>1</span>Type of Booking</a></h5></li>
					<li><h5><a href="coach-timedate.html"><span>2</span>Time & Date</a></h5></li>
					<li><h5><a href="coach-personalinfo.html"><span>3</span>Personal Information</a></h5></li>
					<li><h5><a href="coach-order-confirm.html"><span>4</span>Order Confirmation</a></h5></li>
					<li><h5><a href="coach-payment.html"><span>5</span>Payment</a></h5></li>
				</ul>
			</div>
		</section>

		<!-- Page Content -->
		<div class="content book-cage">
			<div class="container">
				<section class="card mb-40">
					<div class="text-center mb-40">
						<h3 class="mb-1">Book A Coach</h3>
						<p class="sub-title">Unlock Your Potential with a Personal Coach</p>
					</div>
					<div class="master-academy dull-whitesmoke-bg card">
						<div class="d-sm-flex justify-content-between align-items-center">
							<div class="d-sm-flex justify-content-start align-items-center">
								<a href="javascript:void(0);"><img class="corner-radius-10" src="assets/img/profiles/avatar-02.png" alt="Venue"></a>
								<div class="info">
									<div class="d-flex justify-content-start align-items-center mb-3">
										<span class="text-white dark-yellow-bg color-white me-2 d-flex justify-content-center align-items-center">4.5</span>
										<span>300 Reviews</span>
									</div>
									<h3 class="mb-2">Kevin Anderson</h3>
									<p>Certified Badminton Coach with a deep understanding of the sport's  strategies.</p>
								</div>
							</div>
							<div class="white-bg">
								<p class="mb-1">Starts From</p>
								<h3 class="d-inline-block primary-text mb-0">$150</h3><span>/hr</span>
							</div>
						</div>
					</div>
				</section>
				<section class="text-center coach-types">
					<div class="border-block">
						<h3 class="mb-2">How do you prefer to book your Coach?</h3>
						<p>Please Select the Options below </p>
						<ul  class="d-flex justify-content-center align-items-center">
							<li class="d-flex justify-content-between align-items-center me-4 active">
								<p class="d-inline-block">Only Book a Coach for Session</p>
								<i class="fa-solid fa-angle-right"></i>
							</li>
							<li class="d-flex justify-content-between align-items-center coach-and-lessons">
								<p class="d-inline-block">Commit To Training With Coach & Lessons</p>
								<i class="fa-solid fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<div class="text-center btn-row">
						<a class="btn btn-primary me-3 btn-icon" href="javascript:void(0);"><i class="feather-arrow-left-circle me-1"></i> Back</a>
						<a class="btn btn-secondary btn-icon change-url" href="coach-timedate.html">Next <i class="feather-arrow-right-circle ms-1"></i></a>
					</div>
				</section>
			</div>
			<!-- /Container -->
		</div>
		<!-- /Page Content -->
		<?php
			include("includes/footer.php");
		?>