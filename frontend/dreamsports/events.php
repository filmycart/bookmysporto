	<!-- Main Wrapper -->
	<div class="main-wrapper events-page innerpagebg">
		<?php
			include("includes/page_header.php");

			$curlEvent = curl_init();

		    $eventUrl = "";
		    if($hostName == "localhost") {
		        $eventUrl = $requestScheme.'://localhost/sportifyv2/api/event/event.php';
		    } else {
		        $eventUrl = $requestScheme.'://bookmysporto.com/api/event/event.php';
		    }

		    $postValArray = array(
		                            'api_token' => '123456789'
		                        );

		    curl_setopt_array($curlEvent, array(
		      CURLOPT_URL => $eventUrl,
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

		    $eventesponse = curl_exec($curlEvent);

		    $eventResponseArr = array();
		    if(!empty($eventesponse)){
		        $eventResponseArr = json_decode($eventesponse, true);
		    }

		    curl_close($curlVenue);
		?>
		<!-- Breadcrumb -->
		<div class="breadcrumb breadcrumb-list mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h1 class="text-white">Events</h1>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li>Events</li>
				</ul>
			</div>
		</div>
		<!-- /Breadcrumb -->
		<!-- Page Content -->
		<div class="content">
			<div class="container">
				<section class="services">
					<div class="row">
						<?php
	        				if((isset($eventResponseArr['data'])) && (!empty($eventResponseArr['data']))) {
	        					foreach($eventResponseArr['data'] as $eventResponseVal) {
	        						$eventImageArray = array();
	        						$eventImage = "";
	        						if((isset($eventResponseVal['eventImage'])) && (!empty($eventResponseVal['eventImage']))) {
	        							$eventImageArray = explode(",",$eventImagePath.$eventResponseVal['eventImage']);
	        							if((isset($eventResponseVal['eventImage'])) && (!empty($eventResponseVal['eventImage']))) {
	        								$eventImage = $eventImageArray['0'];
	        							}
	        						} else {
	        							$eventImage = $eventNoImage;	
	        						}

	        						$eventStartDay = "";   
	        						if((isset($eventResponseVal['eventStartDate'])) && (!empty($eventResponseVal['eventStartDate']))) {
		        						$eventStartDay = date("m", strtotime($eventResponseVal['eventStartDate']));
    								}	

	        						$eventStartMonthYear = "";   
	        						if((isset($eventResponseVal['eventStartDate'])) && (!empty($eventResponseVal['eventStartDate']))) {
		        						$eventStartMonthYear = date("F, Y", strtotime($eventResponseVal['eventStartDate']));
		        						//$eventStartMonthYear = date('d F Y', strtotime($eventResponseVal['eventStartDate'])); 
    								}	

    								$eventEndDay = "";   
	        						if((isset($eventResponseVal['eventEndDate'])) && (!empty($eventResponseVal['eventEndDate']))) {
		        						$eventEndDay = date("m", strtotime($eventResponseVal['eventEndDate']));
    								}	

    								$eventEndMonthYear = "";   
	        						if((isset($eventResponseVal['eventEndDate'])) && (!empty($eventResponseVal['eventEndDate']))) {
		        						$eventEndMonthYear = date("F, Y", strtotime($eventResponseVal['eventEndDate']));
    								}					
	        			?>
									<div class="col-12 col-sm-12 col-md-6 col-lg-4">
										<div class="listing-item">
											<div class="listing-img">
												<a href="index.php?pg-nm=event-details?eid=<?=(!empty($eventResponseVal['eventId'])?$eventResponseVal['eventId']:'')?>"><?=(!empty($eventResponseVal['eventTitle'])?$eventResponseVal['eventTitle']:'')?>
													<img src="<?=$eventImage?>" class="img-fluid" alt="Event">
												</a>
												<div class="date-info text-center">
													<h2><?=$eventStartDay?></h2>
													<h6><?=$eventStartMonthYear?></h6>
												</div>
											</div>
											<div class="listing-content">
												<ul class="d-flex justify-content-start align-items-center">
													<li>
														<i class="feather-clock"></i>06:20 AM
													</li>
													<li>
														<i class="feather-map-pin"></i>152, 1st Street New York
													</li>
												</ul>
												<h4 class="listing-title">
													<a href="index.php?pg-nm=event-details?eid=<?=(!empty($eventResponseVal['eventId'])?$eventResponseVal['eventId']:'')?>"><?=(!empty($eventResponseVal['eventTitle'])?$eventResponseVal['eventTitle']:'')?></a>
												</h4>
											</div>
										</div>
									</div>
						<?php
								}
							}
						?>			
					</div>
				</section>
			</div>

		</div>
		<!-- /Page Content -->
		
	</div>

	<?php
		include("includes/page_footer.php");
	?>

