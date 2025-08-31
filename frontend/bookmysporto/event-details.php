		<?php
			include("includes/details_page_header.php");

			$curlEvent = curl_init();

			$pgEventId = "";
		    if((isset($_GET['id'])) && (!empty($_GET['id']))) {
		        $pgEventId = $_GET['id'];
		    }

		    $eventDetailsUrl = "";
		    if($hostName == "localhost") {
		        $eventDetailsUrl = $requestScheme.'://localhost/bookmysporto/api/event/event_details.php';
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

		    $pgVenueId = "";
		    if((isset($eventDetailData['venueId'])) && (!empty($eventDetailData['venueId']))) {
		        $pgVenueId = $eventDetailData['venueId'];
		    }

			$eventImage = "";
			if((isset($eventDetailData['eventImage'])) && (!empty($eventDetailData['eventImage']))) {
				$eventImage = $eventDetailData['eventImage'];
			} else {
				$eventImage = $eventNoImage;
			}
		?>	
		<style>
		    .important {
		        font-weight: bold;
		        font-size: xx-large;
		    }     

		    .txt-heading {
		    	padding: 5px 10px;
		    	font-size:1.1em;
		    	font-weight:bold;
		    	color:#999;
		    }
			
			a.btnRemoveAction {
				color:#D60202;
				border:0;
				padding:2px 10px;
				font-size:0.9em;
			}

			a.btnRemoveAction:visited {
				color:#D60202;
				border:0;
				padding:2px 10px;
				font-size:0.9em;
			}

			#btnEmpty {
				background-color:#D60202;
				border:0;
				padding:1px 10px;
				color:#FFF;
				font-size:0.8em;
				font-weight:normal;
				float:right;
				text-decoration:none;
			}

			.btnAddAction {
				background-color:#79b946;
				border:0;
				padding:3px 10px;
				color:#FFF;
				margin-left:1px;
				width:80px;
			}

			.btnAdded {
				background-color:#CCC;
				border:0;
				padding:3px 10px;
				color:#FFF;
				margin-left:1px;
				width:80px;
			}

			#shopping-cart {
				border-top: #79b946 2px solid;
				margin-bottom:30px;
			}

			#shopping-cart .txt-heading {
				background-color: #D3F5B8;
			}

			.cart-item {
				border-bottom: #79b946 1px dotted;
				padding: 10px;
			}

			#product-grid {
				border-top: #F08426 2px solid;
				margin-bottom:30px;
			}

			#product-grid .txt-heading {
				background-color: #FFD0A6;
			}

			.product-item {
				float:left;
				background:#F0F0F0;
				margin:0px;
				padding:0px;
				border-radius:5px;
			}

			.product-item div {
				text-align:center;
				margin:2px;
			}

			.product-price {
				color:#F08426;
			}

			.product-image {
				height:100px;
				background-color:#FFF;
			}

			.clear-float {
				clear:both;
				margin-bottom:40px;
			}

			.cart-action{
				cursor:pointer;
			}
		</style>	
		<script type="text/javascript">

			let cartItemsArray = new Array();

			function checkUncheckSubcat(thisVal, sId) {

				var eventCategory = $("#eventCategory").val();

				var checkedVal = $("#eventSubCategory_"+sId);

				if(checkedVal.is(':checked')) {
					cartItemsArray.push(thisVal);
				} else {
					cartItemsArray = $.grep(cartItemsArray, function(value) {
					    return value != thisVal;
					});
				}

				$.ajax({
			        url: "cart_items_src.php",
			        cache: false,
			        type: "POST",
			        data: {cartItemsArray : cartItemsArray, "eventCategory" : eventCategory},
			        success: function(html){
			            resp = JSON.parse(html);

			            $("#subtotal").val(resp.subTotal);
			            $("#subtotal2").val(resp.subTotal);
			            $("#subtotal-text").text('₹'+resp.subTotal);
			        }
			    });
			}

			function addToCart(element) {

				var productParent = $(element).closest('div.product-item');

				var price = $(productParent).find('.price span').text();
				var productName = $(productParent).find('.productname').text();
				var quantity = $(productParent).find('.product-quantity').val();

				var cartItem = {
					productName: productName,
					price: price,
					quantity: quantity
				};

				var cartItemJSON = JSON.stringify(cartItem);

				var cartArray = new Array();
				// If javascript shopping cart session is not empty
				if (sessionStorage.getItem('shopping-cart')) {
					cartArray = JSON.parse(sessionStorage.getItem('shopping-cart'));
				}

				cartArray.push(cartItemJSON);

				var cartJSON = JSON.stringify(cartArray);
				sessionStorage.setItem('shopping-cart', cartJSON);

				showCartTable();
			}

			function showCartTable() {
				var cartRowHTML = "";
				var itemCount = 0;
				var grandTotal = 0;

				var price = 0;
				var quantity = 0;
				var subTotal = 0;

				if (sessionStorage.getItem('shopping-cart')) {
					var shoppingCart = JSON.parse(sessionStorage.getItem('shopping-cart'));
					itemCount = shoppingCart.length;

					//Iterate javascript shopping cart array
					shoppingCart.forEach(function(item) {
						var cartItem = JSON.parse(item);
						price = parseFloat(cartItem.price);
						quantity = parseInt(cartItem.quantity);
						subTotal = price * quantity

						cartRowHTML += "<tr>" +
							"<td>" + cartItem.productName + "</td>" +
							"<td class='text-right'>" + price.toFixed(2) + "</td>" +
							"<td class='text-right'>" + quantity + "</td>" +
							"<td class='text-right'>" + subTotal.toFixed(2) + "</td>" +
							"</tr>";

						grandTotal += subTotal;
					});
				}

				$('#cartTableBody').html(cartRowHTML);
				$('#itemCount').text(itemCount);
				$('#totalAmount').text("" + grandTotal.toFixed(2));
			}

			function emptyCart() {
				if (sessionStorage.getItem('shopping-cart')) {
					// Clear JavaScript sessionStorage by index
					sessionStorage.removeItem('shopping-cart');
					showCartTable();
				}
			}

			function showProductGallery(product) {
				//Iterate javascript shopping cart array
				var productHTML = "";
				product.forEach(function(item) {
					productHTML += '<div class="product-item">'+
								'<div><img src="././admin/uploads/event_subcategory/' + item.image_name + '" height="30" width="30"></div>'+
								'<div class="productname">'+item.title+'</div>'+
								'<div class="price"><span>'+item.price+'</span></div>'+
								'<div class="cart-action">'+
									'<input type="hidden" class="product-quantity" name="quantity" value="1" size="1" disabled />'+
									''+
								'</div>'+
							'</div>';
							"<tr>";
					
				});
				$('#eventCategoryDispCart').html(productHTML);
			}

			jQuery( document ).ready(function( $ ) {
				$(".eventCategoryDiv").html('');
				$(".eventCategoryDispDiv").html('');
				$(".eventCategoryDispCart").html('');	
				$(".eventCategorySpinnerDiv").hide();
				$(".eventCategorySpinnerCart").hide();

				eventCategory();		
				eventCategoryAddToCart();	

				//validate the register form when it is submitted
                $.validator.addMethod(
                    "attendeAge",
                    function(value, element) {
                        return !/^-?\d+$/.test(value) ? false : true;
                    },
                    "Age invalid"
                );

                $.validator.addMethod(
                    "playerPhoneNumber",
                    function(value, element) {
                        return !/^\d{8}$|^\d{10}$/.test(value) ? false : true;
                    },
                    "Mobile number invalid"
                );

                $.validator.addMethod(
                    "playerPartnerPhoneNumber",
                    function(value, element) {
                        return !/^\d{8}$|^\d{10}$/.test(value) ? false : true;
                    },
                    "Mobile number invalid"
                );
                
                //validate signup form on keyup and submit
                $("#formBooking").validate({
                    rules: {
                        playerName: {
                            required: true,
                            minlength: 5,
                            maxlength: 25
                        },
                        playerPhoneNumber: {
                            required: true,
                            minlength: 10,
                            maxlength: 25,
                            playerPhoneNumber: $("#playerPhoneNumber").val()
                        },
                        playerAge: {
                            required: true,
                            minlength: 1,
                            maxlength: 2
                        },
                        playerPartnerName: {
                            required: true,
                            minlength: 5,
                            maxlength: 25
                        },
                        playerPartnerPhoneNumber: {
                            required: true,
                            minlength: 10,
                            maxlength: 25,
                            playerPartnerPhoneNumber: $("#playerPartnerPhoneNumber").val()
                        },
                        playerPartnerAge: {
                            required: true,
                            minlength: 1,
                            maxlength: 2
                        },
                    },
                    messages: {
                        playerName: {
                            required: "Please enter your player name.",
                            minlength: "Please enter minimum 5 character for player name.",
                            maxlength: "Please enter minimum 25 character for player name."
                        },
                        playerPhoneNumber: {
                            required: "Please enter your player phone number.",
                            minlength: "Please enter minimum 10 character for player phone number.",
                            maxlength: "Please enter minimum 25 character for player phone number."
                        },
                        playerAge: {
                            required: "Please enter your player age.",
                            minlength: "Please enter minimum 1 character for player age.",
                            maxlength: "Please enter minimum 2 character for player age."
                        },
                        playerPartnerName: {
                            required: "Please enter your partner player name.",
                            minlength: "Please enter minimum 5 character for partner player name.",
                            maxlength: "Please enter minimum 25 character for partner player name."
                        },  
                        playerPartnerPhoneNumber: {
                            required: "Please enter your partner player phone number.",
                            minlength: "Please enter minimum 10 character for partner player phone number.",
                            maxlength: "Please enter minimum 25 character for partner player phone number."
                        },          
                        playerPartnerAge: {
                            required: "Please enter your partner player age.",
                            minlength: "Please enter minimum 1 character for partner player age.",
                            maxlength: "Please enter minimum 2 character for partner player age."
                        },                 
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            type: "POST",
                            url: "./api/event/book_event.php",
                            data: $(form).serialize(),
                            success: function (resp) {
                            	addToCartMsgModal();
                            	//if(resp.status_code == 200) {
	                                setTimeout(function () {
	                                   window.location.href='index.php?pg-nm=my-booking';
	                                }, 1500);
	                            //}
                            }
                        });
                        return false; // required to block normal submit since you used ajax
                    }
                });
			});			

			function eventBookForm() {				
				$("#eventCategory-error").hide();
				$("#subtotal-error").hide();

				$("#register-form-modal").modal('hide');
				$('#login-form-modal').modal('hide');
				$('#add-to-cart-modal').modal('show');
				$('#add-to-cart-modal-title-text').text('Book Event');
				eventCategorySelectBox();
				eventSubCategoryCheckbBox();
				$("#cartItemsSpinnerDiv").hide();
			}

			function eventBookFormClose() {
				$("#add-to-cart-modal").modal('hide');
			}

			function eventBookForm2() {				
				$("#eventCategory-error").hide();
				$("#subtotal-error").hide();

				$("#register-form-modal").modal('hide');
				$('#login-form-modal').modal('hide');
				$('#add-to-cart-modal').modal('hide');
				$('#event-book-form-modal').modal('show');
				$('#event-book-form-modal-title-text').text('Book Event');

				var mixedDoublesarray = ['24','26','27'];
				if(jQuery.inArray($('#eventCategory').val(), mixedDoublesarray) !== -1) {
					$('#partner-player').show();					
				} else {
					$('#partner-player').hide();
				}
			}

			function eventBookFormClose2() {
				$("#event-book-form-modal").modal('hide');
			}

			function addToCartMsgModal() {
				$("#register-form-modal").modal('hide');
				$('#login-form-modal').modal('hide');
				$('#add-to-cart-modal').modal('hide');
				$('#event-book-form-modal').modal('hide');
				$("#add-to-cart-msg-modal").modal('show');
			}

			function goToSection(sectionId) {
				window.location.hash = sectionId;
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

			function eventSubCategoryCheckbBox() {
			    $.ajax({
			        url: "api/category/sub_category_checkbox.php",
			        cache: false,
			        type: "POST",
			        data: {},
			        beforeSend: function() {
			            $('#subCategorySpinnerDiv').show();
			        },
			        complete: function(){
			            $('#subCategorySpinnerDiv').hide();
			        },
			        success: function(html){
			            $("#eventSubCategoryDiv").html(html);
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

			function eventCategoryAddToCart() {

				var getQueryParameter = getUrlVars();
				var eid = getQueryParameter['eid'];

			    $.ajax({
			        url: "api/category/event_category_cart.php",
			        cache: false,
			        type: "POST",
			        data: {eid : eid},
			        beforeSend: function() {
			            $('#eventCategorySpinnerCart').show();
			        },
			        complete: function(){
			            $('#eventCategorySpinnerCart').hide();
			        },
			        success: function(html) {
			            var product = JSON.parse(html);
			            showProductGallery(product);
			        }	        
			    });
			}

			function validateAddToCart() {
				var eventCategory = $("#eventCategory").val();
				var subtotal = $("#subtotal").val();

	            if (eventCategory == "") {
	            	$("#eventCategory-error").show();
	            } else {
	            	$("#eventCategory-error").hide();
	            }

	            if ((subtotal == "") || (subtotal == 0)) {
	            	$("#subtotal-error").show();
	            } else {
	            	$("#subtotal-error").hide();
	            }	            

	            if((eventCategory != "") && (subtotal != "")){
	            	eventBookForm2();
	            }
			}
		</script>	
		<!-- /.modal -->
		<div class="modal fade" id="add-to-cart-msg-modal">
		    <div class="modal-dialog modal-sm">
		      	<div class="modal-content">
			        <div class="modal-body">
			            <div class="row">
			                <div class="col-xl-6">
			                    <h6 class="modal-title"><span id="add-to-cart-msg-modal-title-text"></span></h6>
			                </div> 
			                <div class="col-xl-12">
			                	<div id="booking-suc-msg-div" style="color:green;">Event Booked Successfully.</div>
			                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>  -->  
			                </div>   
			            </div>
		        	</div>                     
		    	</div>
			</div>
		</div>
		<div class="modal fade" id="add-to-cart-modal">
		    <div class="modal-dialog modal-lg">
		      	<div class="modal-content">
			        <div class="modal-body">
			            <div class="row">
			                <!-- <div class="col-xl-6">
			                    <h6 class="modal-title"><span id="add-to-cart-modal-title-text"></span></h6>
			                </div>  --> 
			                <div class="col-xl-12">
			                    <button type="button" class="close" onclick="eventBookFormClose()" data-dismiss="modal" aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>   
			                </div>    
			            </div>
			            <div class="tab-content" id="myTabContent">
			                <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
			                    <form id="formAddToCart" name="formAddToCart" method="POST" enctype="multipart/form-data" action="./././api/event/book_event.php">
			                    	<?php 
			                    		$userId = "";
			                    		if((isset($_SESSION['userId'])) && (!empty($_SESSION['userId']))){
			                    			$userId = $_SESSION['userId'];
			                    		}
			                    	?>
			                        <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
			                        <input type="hidden" id="subtotal" value="">
	                                <div class="row">   
			                            <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
			                            	<div id="categorySpinnerDiv"><img src="./admin/assets/images/spinner.png" class="spinner"></div>
			                                <div id="eventCategoryDiv"></div>
			                                <label id="eventCategory-error" class="error" for="eventCategory">Please select Category.</label>
			                            </div>
			                        </div>
			                        <div class="spacer-div"></div>
			                        <div class="row">   
			                            <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
			                            	<div id="subCategorySpinnerDiv"><img src="./admin/assets/images/spinner.png" class="spinner"></div>
			                                <div id="eventSubCategoryDiv"></div>
			                                <label id="subtotal-error" class="error" for="subtotal">Please check any Sub Category.</label>
			                                
			                            </div>
			                        </div>
			                        <div class="spacer-div"></div>
			                        <span id="subtotal-text"></span>
			                        <div class="spacer-div"></div>
			                        <div class="row">   
			                            <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
			                                <button class="btn btn-secondary register-btn d-inline-flex justify-content-center align-items-center w-100 btn-block" type="button" onclick="validateAddToCart()">Next<i class="feather-arrow-right-circle ms-2"></i></button>
			                            </div>
			                        </div>                         
			                    </form>
			                </div>                            
			            </div>
		        	</div>                     
		    	</div>
			</div>
		</div>
		<div class="modal fade" id="event-book-form-modal">
		    <div class="modal-dialog modal-lg">
		      	<div class="modal-content">
			        <div class="modal-body">
			        	<div class="row">
			                <!-- <div class="col-xl-6">
			                    <h4 class="modal-title"><span id="event-book-form-modal-title-text"></span></h4>
			                </div> -->
			                <div class="col-xl-12">
			                    <button type="button" class="close" onclick="eventBookFormClose2()" data-dismiss="modal" aria-label="Close">
			                        <span aria-hidden="true">&times;</span>
			                    </button>   
			                </div>    
			            </div>
			            <div class="tab-content" id="myTabContent">
			                <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
			                    <form id="formBooking" name="formBooking" method="POST" enctype="multipart/form-data" action="./././api/event/book_event.php">
			                        <input type="hidden" class="form-control" name="api_token" id="api_token" value="123456789">
			                        <input type="hidden" class="form-control" name="eventId" id="eventId" value="<?=$pgEventId?>">
			                        <input type="hidden" class="form-control" name="venueId" id="venueId" value="<?=$pgVenueId?>">
			                        <input type="hidden" class="form-control" name="userId" id="userId" value="<?=$userId;?>">
			                        <input type="hidden" name="subtotal2" id="subtotal2" value="">

			                        <fieldset name="player" id="player">
	                        			<div class="row">   
		                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
		                                        <input type="text" id="playerName" name="playerName" class="form-control" placeholder="Enter Player Name" />
		                                    </div>
		                                </div>  
		                                <div class="spacer-div"></div>
		                                <div class="row">   
		                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
		                                        <input type="text" id="playerPhoneNumber" name="playerPhoneNumber" class="form-control" placeholder="Enter Player Phone Number" />
		                                    </div>
		                                </div>  
		                                <div class="spacer-div"></div>
		                                <div class="row">   
		                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
		                                        <input type="text" id="playerAge" name="playerAge" class="form-control" placeholder="Enter Player Age" />
		                                    </div>
		                                </div>  
		                                <div class="spacer-div"></div>
	                            	</fieldset>
	                            	<fieldset name="partner-player" id="partner-player">
		                                <div class="row">   
		                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
		                                        <input type="text" id="playerPartnerName" name="playerPartnerName" class="form-control" placeholder="Enter Partner Player Name" />
		                                    </div>
		                                </div>  
		                                <div class="spacer-div"></div>
		                                <div class="row">   
		                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
		                                        <input type="text" id="playerPartnerPhoneNumber" name="playerPartnerPhoneNumber" class="form-control" placeholder="Enter Partner Player Phone Number" />
		                                    </div>
		                                </div>  
		                                <div class="spacer-div"></div>
		                                <div class="row">   
		                                    <div class="col-sm-12 col-md-12 col-lg-12 left-padding">
		                                        <input type="text" id="playerPartnerAge" name="playerPartnerAge" class="form-control" placeholder="Enter Partner Player Age" />
		                                    </div>
		                                </div>  
		                                <div class="spacer-div"></div>
		                            </fieldset>
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
                            } else {
                        ?>
                        		<div class="clearfix">&nbsp;</div>
                        		<button type="button" disabled class="btn btn-secondary active">Book Ticket</button>
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
						<!-- <div class="card corner-radius-10 coach-info justify-content-start align-items-start">
							<div class="font-semibold text-md"><h6>Categories: </h6></div>
							<div id="eventCategorySpinnerCart"><img src="./admin/assets/images/spinner.png" class="spinner"></div>
			                <div id="eventCategoryDispCart"></div>
						</div>
						<div class="clearfix">&nbsp;</div> -->
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