	<!-- Main Wrapper -->
	<div class="main-wrapper events-page innerpagebg">
		<?php
			include("includes/page_header.php");

			$curlEvent = curl_init();

		    $eventUrl = "";
		    if($hostName == "localhost") {
		        $eventUrl = $requestScheme.'://localhost/bookmysporto/api/event/event.php';
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
					<li><a href="index.php">Home</a></li>
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
		        						$eventStartMonthYear = date("M Y", strtotime($eventResponseVal['eventStartDate'])); 
    								}

    								$eventStartTime = "";   
	        						if((isset($eventResponseVal['eventStartDate'])) && (!empty($eventResponseVal['eventStartDate']))) {
		        						$eventStartTime = date("h:i A", strtotime($eventResponseVal['eventStartDate']));
    								}	

    								$eventEndDay = "";   
	        						if((isset($eventResponseVal['eventStartDate'])) && (!empty($eventResponseVal['eventStartDate']))) {
		        						$eventEndDay = date("m", strtotime($eventResponseVal['eventStartDate']));
    								}	

    								$eventEndMonthYear = "";   
	        						if((isset($eventResponseVal['eventEndDate'])) && (!empty($eventResponseVal['eventEndDate']))) {
		        						$eventEndMonthYear = date("M Y", strtotime($eventResponseVal['eventEndDate']));
    								}	

    								$eventEndTime = "";   
	        						if((isset($eventResponseVal['eventEndDate'])) && (!empty($eventResponseVal['eventEndDate']))) {
		        						$eventEndTime = date("h:i A", strtotime($eventResponseVal['eventEndDate']));
    								}					
	        			?>
									<div class="col-12 col-sm-12 col-md-6 col-lg-4">
										<div class="listing-item">
											<div class="listing-img">
												<a href="index.php?pg-nm=event-details&id=<?=(!empty($eventResponseVal['eventId'])?$eventResponseVal['eventId']:'')?>">
													<img src="<?=$eventImage?>" class="img-fluid" alt="Event">
												</a>
												<div class="fav-item-venues">
													<span class="tag tag-blue"><?=$eventStartDay?> <?=$eventStartMonthYear?></span>
													<span class="tag tag-blue"><?=$eventStartDay?> <?=$eventEndMonthYear?></span>		
												</div>
											</div>
											<div class="listing-content">
												<?php
													// strip tags to avoid breaking any html
													$eventTitle = strip_tags($eventResponseVal['eventTitle']);
													if (strlen($eventTitle) > 25) {
													    // truncate string
													    $eventTitleStringCut = substr($eventTitle, 0, 25);
													    $eventTitleEndPoint = strrpos($eventTitleStringCut, ' ');

													    //if the string doesn't contain any space then it will cut without word basis.
													    $eventTitle = $eventTitleEndPoint? substr($eventTitleStringCut, 0, $eventTitleEndPoint) : substr($eventTitleStringCut, 0);
													    $eventTitle .= '...';
													}
												?>
												<h3 class="listing-title">
													<a href="index.php?pg-nm=event-details&id=<?=(!empty($eventResponseVal['eventId'])?$eventResponseVal['eventId']:'')?>"><?=$eventTitle?></a>
													<span>
														<?=(!empty($eventResponseVal['eventAddress'])?$eventResponseVal['eventAddress']:'')?>
													</span>
												</h3>
												<div>&nbsp;</div>
												<p>
													<?php
														// strip tags to avoid breaking any html
														$description = strip_tags($eventResponseVal['eventDescription']);
														if (strlen($description) > 80) {
														    // truncate string
														    $stringCut = substr($description, 0, 80);
														    $endPoint = strrpos($stringCut, ' ');

														    //if the string doesn't contain any space then it will cut without word basis.
														    $description = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
														    $description .= '...';
														}
														echo $description;
													?>
												</p>
												<ul class="d-flex justify-content-start align-items-center">
													<li>
														<i class="feather-clock"></i><?=$eventStartTime?> - <?=$eventEndTime?>
													</li>
												</ul>
												<span><i class="feather-map-pin"></i>152, 1st Street New York</span>
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

