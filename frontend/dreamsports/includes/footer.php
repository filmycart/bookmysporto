		<!-- Footer -->
		<footer class="footer">
			<div class="container">
				<!-- Footer Join -->
				<div class="footer-join aos" data-aos="fade-up">
					<h2>We Welcome Your Passion And Expertise</h2>
					<p class="sub-title">Join our empowering sports community today and grow with us.</p>
					<?php
                        if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
                    ?>
                            <a href="index.php?pg-name=my-profile" onclick="registerForm()" class="btn btn-primary"><i class="feather-user-plus"></i> My Profile</a>
                    <?php        
                        } else {
                    ?>
                            <a href="#" onclick="registerForm()" class="btn btn-primary"><i class="feather-user-plus"></i> Join With Us</a>
                    <?php
                        }
                    ?>
				</div>
				<!-- /Footer Join -->			
				<!-- Footer Top -->
				<div class="footer-top">
					<div class="row">
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Contact us</h4>
								<div class="footer-address-blk">
									<div class="footer-call">
										<p>+918105460391</p>
									</div>
									<div class="footer-call">
										<p>contact@filmycart.in</p>
									</div>
								</div>
								<div class="social-icon">
									<ul>
										<li>
											<a href="javascript:void(0);" class="facebook" ><i class="fab fa-facebook-f"></i> </a>
										</li>
										<li>
											<a href="javascript:void(0);" class="twitter" ><i class="fab fa-twitter"></i> </a>
										</li>
										<li>
											<a href="javascript:void(0);" class="instagram" ><i class="fab fa-instagram"></i></a>
										</li>
										<li>
											<a href="javascript:void(0);" class="linked-in" ><i class="fab fa-linkedin-in"></i></a>
										</li>
									</ul>
								</div>
							</div>
							<!-- /Footer Widget -->
						</div>
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Quick Links</h4>
								<ul>
									<li>
										<a href="index.php?pg-nm=about-us">About us</a>
									</li>
									<li>
										<a href="index.php?pg-nm=contact-us">Contact us</a>
									</li>
									<li>
										<a href="index.php?pg-nm=services">Services</a>
									</li>
									<li>
										<a href="index.php?pg-nm=events">Events</a>
									</li>									
								</ul>
							</div>
							<!-- /Footer Widget -->
						</div>
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Support</h4>
								<ul>
									<li>
										<a href="index.php?pg-nm=faq">Faq</a>
									</li>
									<li>
										<a href="index.php?pg-nm=privacy-policy">Privacy Policy</a>
									</li>
									<li>
										<a href="index.php?pg-nm=terms-of-service">Terms & Conditions</a>
									</li>
								</ul>
							</div>
							<!-- /Footer Widget -->
						</div>
					</div>
				</div>
				<!-- /Footer Top -->
			</div>			
			<!-- Footer Bottom -->
			<div class="footer-bottom">
				<div class="container">
					<!-- Copyright -->
					<div class="copyright">
						<div class="row align-items-center">
							<div class="col-md-6">
								<div class="copyright-text">
									<p class="mb-0">&copy; 2025 Sportify  - All rights reserved.</p>
								</div>
							</div>
						</div>
					</div>
					<!-- /Copyright -->
				</div>
			</div>
			<!-- /Footer Bottom -->			
		</footer>
		<!-- /Footer -->
	</div>
	<!-- /Main Wrapper -->
	<!-- scrollToTop start -->
	<div class="progress-wrap active-progress">
		<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;"></path>
		</svg>
	</div>
	<!-- scrollToTop end -->
	<!-- jQuery -->
	<script src="<?=$frontendAssetUrl?>assets/js/jquery-3.7.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="<?=$frontendAssetUrl?>assets/js/bootstrap.bundle.min.js"></script>

	<!-- Select JS -->
	<script src="<?=$frontendAssetUrl?>assets/plugins/select2/js/select2.min.js"></script>

	<!-- Owl Carousel JS -->
	<script src="<?=$frontendAssetUrl?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>

	<!-- Aos -->
	<script src="<?=$frontendAssetUrl?>assets/plugins/aos/aos.js"></script>

	<!-- Counterup JS -->
	<script src="<?=$frontendAssetUrl?>assets/js/jquery.waypoints.js"></script>
	<script src="<?=$frontendAssetUrl?>assets/js/jquery.counterup.min.js"></script>

	<!-- Top JS -->
	<script src="<?=$frontendAssetUrl?>assets/js/backToTop.js"></script>

	<!-- Custom JS -->
	<script src="<?=$frontendAssetUrl?>assets/js/script.js"></script>
</body>
</html>
