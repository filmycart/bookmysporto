		<?php
			include("includes/details_page_header.php");

			$curlEvent = curl_init();

			$pgEventId = "";
		    if((isset($_GET["eid"])) && (!empty($_GET["eid"]))) {
		        $pgEventId = $_GET['eid'];
		    }

		    $eventDetailsUrl = "";
		    if($hostName == "localhost") {
		        $eventDetailsUrl = $requestScheme.'://localhost/sportifyv2/api/event/event_details.php';
		    } else {
		        $eventDetailsUrl = $requestScheme.'://bookmysporto.com/api/event/event_details.php';
		    }

		    $postValArray = array(
		                            'api_token' => '123456789',
		                            'id' => $pgEventId
		                        );

		    curl_setopt_array($curlEvent, array(
		      CURLOPT_URL => $eventDetailsUrl,
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

		    $eventDetailsResponse = curl_exec($curlEvent);

		    $eventDetailsResponseArr = array();
		    if(!empty($eventDetailsResponse)){
		        $eventDetailsResponseArr = json_decode($eventDetailsResponse, true);
		    }

		    curl_close($curlVenue);

		    $eventDetailData = array();
		    if((isset($eventDetailsResponseArr['data'])) && (!empty($eventDetailsResponseArr['data']))) {
		    	$eventDetailData = $eventDetailsResponseArr['data'];
		    }

			$eventImage = "";
			if((isset($eventDetailData['eventImage'])) && (!empty($eventDetailData['eventImage']))) {
				$eventImage = $eventDetailData['eventImage'];
			} else {
				$eventImage = $eventNoImage;
			}
		?>		
		<script type="text/javascript">
			jQuery.noConflict();
			jQuery( document ).ready(function( $ ) {
				$(".eventCategoryDiv").html('');
				$(".eventCategoryDispDiv").html('');	

				eventCategory();			

				//validate the register form when it is submitted
                $.validator.addMethod(
                    "attendeAge",
                    function(value, element) {
                        return !/^-?\d+$/.test(value) ? false : true;
                    },
                    "Age invalid"
                );

                $.validator.addMethod(
                    "attendePhoneNumber",
                    function(value, element) {
                        return !/^\d{8}$|^\d{10}$/.test(value) ? false : true;
                    },
                    "Mobile number invalid"
                );
                
                //validate signup form on keyup and submit
                $("#formEventBook").validate({
                    rules: {
                        eventCategory: {
                            required: true
                        },
                        attendeName: {
                            required: true,
                            minlength: 5
                        },
                        attendeAge: {
                            required: true,
                            minlength: 1,
                            maxlength: 2,
                            attendeAge: $("#attendeAge").val()
                        },
                        attendePhoneNumber: {
                            required: true,
                            minlength: 10,
                            maxlength: 25,
                            attendePhoneNumber: $("#attendePhoneNumber").val()
                        }
                    },
                    messages: {
                        eventCategory: {
                            required: "Please select Category."
                        },
                        attendeName: {
                            required: "Please enter your Name.",
                            minlength: "Please enter minimum 5 character for Name."
                        },
                        attendeAge: {
                            required: "Please enter your Age.",
                            minlength: "Please enter minimum 1 character for Age.",
                            maxlength: "Please enter minimum 2 character for Age."
                        },
                        attendePhoneNumber: {
                            required: "Please enter your Phone Number.",
                            minlength: "Please enter minimum 10 character for Phone Number.",
                            maxlength: "Please enter minimum 25 character for Phone Number."
                        }              
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            type: "POST",
                            url: "./api/event/book_event.php",
                            data: $(form).serialize(),
                            success: function (resp) {
                                /*if(resp.status_code == 200) {
                                    $(form).html("<div id='message' style='color:green;'></div><div class='row'>&nbsp;</div>");
                                    $('#message').html(resp.message);
                                } else if(resp.status_code == 201) {
                                    $(form).html("<div id='err_message' style='color:red;'></div><div class='row'>&nbsp;</div>");
                                    $('#err_message').html(resp.message);
                                }

                                $('#haveanaccount').hide();                                

                                setTimeout(function () {
                                    window.location.href='index.php';
                                }, 1500);*/
                            }
                        });
                        return false; // required to block normal submit since you used ajax
                    }
                });
			});			

			function eventBookForm() {
				$("#register-form-modal").modal('hide');
				$('#login-form-modal').modal('hide');
				$('#event-book-form-modal').modal('show');
				$('#event-book-form-modal-title-text').text('Book');
				eventCategorySelectBox();
			}

			function eventBookFormClose() {
				$("#event-book-form-modal").modal('hide');
			}

			function eventCategorySelectBox() {
			    $.ajax({
			        url: "api/category/category.php",
			        cache: false,
			        type: "POST",
			        data: {},
			        beforeSend: function() {
			            $('#categorySpinnerDiv').show();
			        },
			        complete: function(){
			            $('#categorySpinnerDiv').hide();
			        },
			        success: function(html){
			            $("#eventCategoryDiv").html(html);
			        }
			    });
			}

			// Read a page's GET URL variables and return them as an associative array.
			function getUrlVars() {
			    var vars = [], hash;
			    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			    for(var i = 0; i < hashes.length; i++) {
			        hash = hashes[i].split('=');
			        vars.push(hash[0]);
			        vars[hash[0]] = hash[1];
			    }
			    return vars;
			}

			function eventCategory() {
				var getQueryParameter = getUrlVars();
				var eid = getQueryParameter['eid'];

			    $.ajax({
			        url: "api/category/event_category.php",
			        cache: false,
			        type: "POST",
			        data: {eid : eid},
			        beforeSend: function() {
			            $('#eventCategorySpinnerDiv').show();
			        },
			        complete: function(){
			            $('#eventCategorySpinnerDiv').hide();
			        },
			        success: function(html){
			            $("#eventCategoryDispDiv").html(html);
			        }			        
			    });
			}
		</script>	
		<!-- /.modal -->
		<div class="modal fade" id="event-book-form-modal">
		    <div class="modal-dialog modal-lg">
		      	<div class="modal-content">
			        <div class="modal-body">
			        	<div class="row">
			                <div class="col-xl-12">
			                    <button type="button" class="close" onclick="eventBookFormClose()" data-dismiss="modal" aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>   
			                </div>    
			            </div>
			            <div class="tab-content" id="myTabContent">
			                <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
			                    <form id="formEventBook" name="formEventBook" method="POST" enctype="multipart/form-data" action="./././api/event/book_event.php">
			                        <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
	                                <div class="row">   
			                            <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
			                            	<div id="categorySpinnerDiv"><img src="./admin/assets/images/spinner.png" class="spinner"></div>
			                                <div id="eventCategoryDiv"></div>
			                            </div>
			                        </div>
			                        <div class="spacer-div"></div>
	                                <div class="row">   
	                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
	                                        <input type="text" class="form-control" name="attendeName" id="attendeName" placeholder="Enter Name">
	                                    </div>
	                                </div>  
	                                <div class="spacer-div"></div>
	                                <div class="row">   
	                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
	                                        <input type="text" class="form-control" name="attendeAge" id="attendeAge" placeholder="Enter Age">
	                                    </div>
	                                </div>
	                                <div class="spacer-div"></div>
	                                <div class="row">   
	                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
	                                        <input type="text" class="form-control" name="attendePhoneNumber" id="attendePhoneNumber" placeholder="Enter Phone Number">
	                                    </div>
	                                </div>   
	                                <div class="spacer-div"></div>
			                        <div class="row">   
			                            <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
			                                <button class="btn btn-secondary register-btn d-inline-flex justify-content-center align-items-center w-100 btn-block" type="submit">Submit<i class="feather-arrow-right-circle ms-2"></i></button>
			                            </div>
			                        </div>                         
			                    </form>
			                </div>                            
			            </div>
		        	</div>                     
		    	</div>
			</div>
		</div>
		<!-- Page Content -->
		<div class="content">
			<div class="container">
				<!-- Row -->
				<div class="white-bg row move-top card_new">
					<div class="card_new2 col-12 col-sm-12 col-md-12 col-lg-8">
						<div class="corner-radius-10 coach-info justify-content-start align-items-start">
							<div>
								<h1 class="d-flex align-items-center justify-content-start mb-0">
									<?=(!empty($eventDetailData['eventTitle'])?$eventDetailData['eventTitle']:'')?>
								</h1>
								<div class="clearfix"></div>
								<div class="profile-pic">
									<a href="javascript:void(0);"><img alt="User" class="corner-radius-10" src="<?=$eventFrontEndImageUploadPath?><?=$eventImage?>"></a>
								</div>
							</div>
							<div class="clearfix">&nbsp;</div>
							<div class="card corner-radius-10 coach-info justify-content-start align-items-start">
								<div class="font-semibold text-md"><h6>Overview: </h6></div>
								<?=(!empty($eventDetailData['eventDescription'])?$eventDetailData['eventDescription']:'')?>
							</div>
							<div class="clearfix">&nbsp;</div>
							<div class="card corner-radius-10 coach-info justify-content-start align-items-start">
								<div class="font-semibold text-md"><h6>Categories: </h6></div>
								<div id="eventCategorySpinnerDiv"><img src="./admin/assets/images/spinner.png" class="spinner"></div>
				                <div id="eventCategoryDispDiv"></div>
							</div>
						</div>
					</div>
					<aside class="col-12 col-sm-12 col-md-12 col-lg-4 theiaStickySidebar">
						<?php
                            if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))) {
                        ?>
                                <div class="clearfix">&nbsp;</div>
								<button type="button" class="btn btn-success" onclick="eventBookForm()">Book Ticket</button>
                        <?php        
                            } 
                        ?>
						<div class="clearfix">&nbsp;</div>
						<div class="card book-coach">
							<h4 class="border-bottom">Date & Time</h4>
							<h6>Starts At</h6>
							<p class="form-label"><?=(!empty($eventDetailData['eventStartDate'])?$eventDetailData['eventStartDate']:'')?></p>
							<h6>Ends At</h6>
							<p class="form-label"><?=(!empty($eventDetailData['eventEndDate'])?$eventDetailData['eventEndDate']:'')?></p>
						</div>
						<div class="clearfix">&nbsp;</div>
						<div class="card">
							<?php
								$venueLat = "";
								$venueLon = "";
								if((isset($eventDetailData['venueLat'])) && (!empty($eventDetailData['venueLat']))){
									$venueLat = $eventDetailData['venueLat'];
								}

								if((isset($eventDetailData['venueLon'])) && (!empty($eventDetailData['venueLon']))){
									$venueLon = $eventDetailData['venueLon']; 
								}
							?>							
							<h4 class="border-bottom">Location</h4>
							<h6 class="form-label"><?=(!empty($eventDetailData['venueTitle'])?$eventDetailData['venueTitle']:'')?></h6>
							<span class="form-label"><?=(!empty($eventDetailData['venueAddress'])?$eventDetailData['venueAddress']:'')?></span>
							<div class="spacer-div"></div>
							<div id="googleMap" style="width:100%;height:400px;"></div>
							<script>
								function myMap() {
									var mapProp = {
										center:new google.maps.LatLng(<?=$venueLat?>,<?=$venueLon?>),
										zoom:15,
									};
									var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
								}
							</script>
							<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmssLDIr2k4I89ZsR3CjZDe0rQouWxFIs&callback=myMap"></script>
						</div>						
						<div class="clearfix">&nbsp;</div>
					</aside>
				</div>
				<!-- /Row -->
			</div>
			<!-- /container -->			
		</div>
		<!-- /Page Content -->
		<?php
			include("includes/details_page_footer.php");
		?>