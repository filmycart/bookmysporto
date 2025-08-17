<?php require_once('./private/init.php'); ?>
<?php
    $errors = Session::get_temp_session(new Errors());
	$message = Session::get_temp_session(new Message());
	$admin = Session::get_session(new Admin());

	if(!empty($admin)){
		$settings = new Setting();
		$settings = $settings->where(["admin_id" => 1])->one();

		$site_cofig = new Site_Config();
		$site_cofig = $site_cofig->where(["admin_id" => 1])->one();

		$smtp_config = new Smtp_Config();
		$smtp_config = $smtp_config->where(["admin_id" => 1])->one();

	}else Helper::redirect_to("login.php");    
?>
<link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<?php require("common/php/php-head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>
        <?php require("common/php/header.php"); ?>
        <?php require("common/php/sidebar.php"); ?>        
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Site Config</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <div style="width:100%;float:left;">
                    <div style="width:30%;float:left;">
                        <h3 class="card-title">Site Config</h3>
                    </div>  
                </div>
              </div>
              <div class="modal fade" id="form-modal-msg">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="msg-div" style="color:green;"></div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              	<style type="text/css">
              		.required-field{
						color:red;
					}
              	</style>				
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card card-info">
                	<?php if(Session::get_session_by_key("type") == "site_configuration"){
                    	if($message) echo $message->format();
                	}?>
	              <div class="card-header">
	              	<h3 class="card-title">Site Configuration</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form data-validation="true" action="private/controllers/site_config.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $site_cofig->id; ?>"/>
					<input type="hidden" name="admin_id" value="<?php echo $site_cofig->admin_id; ?>"/>
					<input type="hidden" name="prev_image" value="<?php echo $site_cofig->image_name; ?>"/>
	                <div class="card-body">
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-6 col-form-label">
								<i class="ion-ios-cloud-upload"></i>
                                <h5><b>Choose Your Image to Upload</b></h5>
                                <h6 class="mt-10 mb-70">Or Drop Your Image Here</h6>
							</label>
							<div class="col-sm-3">
								<input type="file" name="image_name" class="image-input" value="<?php echo $site_cofig->image_name; ?>"/>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-6 col-form-label">
								Logo(<?php echo "Max Image Size : " . MAX_IMAGE_SIZE . "MB. Required Format : png/jpg/jpeg"; ?>)
							</label>
							<div class="col-sm-3">
								<img class="max-h-200x uploaded-image" src="<?php if(!empty($site_cofig->image_name))
											echo UPLOADED_FOLDER .DIRECTORY_SEPARATOR . 'logo'. DIRECTORY_SEPARATOR. $site_cofig->image_name; ?>" height="50" width="50" alt="Image"/>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-6 col-form-label">
								Site Title
							</label>
							<div class="col-sm-3">
								<input type="text" data-required="true" placeholder="Site Title" name="title" value="<?php echo $site_cofig->title; ?>" class="form-control" />
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword3" class="col-sm-6 col-form-label">
								Site Tag Line
							</label>
							<div class="col-sm-3">
								<input type="text" data-required="true" placeholder="Site Tag Line" name="tag_line" value="<?php echo $site_cofig->tag_line; ?>" class="form-control" />
							</div>
						</div>
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
	                  <button type="submit" class="btn btn-info">Update</button>
	                </div>
	                <!-- /.card-footer -->
	                <?php 
	              		if(Session::get_session_by_key("type") == "site_configuration"){
                        	Session::unset_session_by_key("type");
                        	if($errors) echo $errors->format();
                    	}
                    ?>	
	              </form>
	            </div>
				<div class="card card-info">
				   	<?php 
				   		if(Session::get_session_by_key("type") == "smtp_config"){
                    		if($message) echo $message->format();
                		}
                	?>		
	              <div class="card-header">
	              	<h3 class="card-title">SMTP Configuration</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form data-validation="true" method="POST" action="private/controllers/smtp_config.php">
						<input type="hidden" name="id" value="<?php echo $smtp_config->id; ?>"/>
						<input type="hidden" name="admin_id" value="<?php echo $smtp_config->admin_id; ?>"/>
	                <div class="card-body">
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Host</label>
	                    <div class="col-sm-3">
	                    	<input data-required="true" type="text" placeholder="eg. smtp.gmail.com" name="host" value="<?php echo $smtp_config->host; ?>" class="form-control">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sender Email</label>
	                    <div class="col-sm-3">
	                    	<input data-required="true" type="text" placeholder="eg. doe@gmail.com" name="sender_email" value="<?php echo $smtp_config->sender_email; ?>" class="form-control">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name</label>
	                    <div class="col-sm-3">
	                    	<input data-required="true" type="text" placeholder="eg. abc" name="username" value="<?php echo $smtp_config->username; ?>" class="form-control">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
	                    <div class="col-sm-3">
	                    	<input data-required="true" type="password" placeholder="eg. password" name="password" value="<?php echo $smtp_config->password; ?>" class="form-control">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Port</label>
	                    <div class="col-sm-3">
	                    	<input data-required="true" type="text" placeholder="eg. 465" name="port" value="<?php echo $smtp_config->port; ?>" class="form-control">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Encryption</label>
	                    <div class="col-sm-3">
	                    	<input data-required="true" type="text" placeholder="eg. tls" name="encryption" value="<?php echo $smtp_config->encryption; ?>" class="form-control">
	                    </div>
	                  </div>
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
	                  <button type="submit" class="btn btn-info">Update</button>
	                </div>
	                <!-- /.card-footer -->
	                <?php 
	              		if(Session::get_session_by_key("type") == "smtp_config"){
							Session::unset_session_by_key("type");
							if($errors) echo $errors->format();
						}
					?>
	              </form>	              	
	            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>    
        <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../admin/plugins/jszip/jszip.min.js"></script>
        <script src="../admin/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../admin/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../admin/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../admin/dist/js/demo.js"></script>
        <script>
            /*jQuery.noConflict();
            (function( $ ) {
              $(function() {
                // More code using $ as alias to jQuery
                $("#eventsList").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    "order":  [[0, 'desc']],
                    "columnDefs": [{ "orderable": false, "targets": [6,7] }]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                $('#example2').DataTable({
                  "paging": true,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false,
                  "responsive": true,
                });
              });
            })(jQuery);*/
        </script>
        <?php require("common/php/php-footer.php"); ?>
        <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- jquery-validation -->
        <script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../admin/plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- date-range-picker -->
        <script src="../admin/plugins/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript">
            /*$(function () {
                $('#eventStartDate').datetimepicker({ icons: { time: 'far fa-clock' } });
                $('#eventEndDate').datetimepicker({ icons: { time: 'far fa-clock' } });
            });*/
        </script>
        <script>
            $('#add-msg-div').hide();
            $('#upd-msg-div').hide();
            $('#del-msg-div').hide();
            $('#upd-uniq-msg-div').hide();
            $('#add-uniq-msg-div').hide();

            function viewEvent(eventAction, eventId) {

                $('#view-event-modal-title-text').text('View Event');

                var formData = {};
                if(eventAction == "view") {
                    formData = {
                        "eventId": eventId,
                        "eventAction": eventAction
                    };
                
                    $.ajax({
                        url: "../admin/private/controllers/event.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            $("#viewEventId").text(respArr.eventId);
                            $("#viewEventTitle").text(respArr.eventTitle);
                            $("#viewEventDescription").html(respArr.eventDescription);
                            $("#viewEventVenue").text(respArr.venueTitle);
                            $("#viewEventStartDate").text(respArr.eventStartDate);
                            $("#viewEventEndDate").text(respArr.eventEndDate);
                            $("#viewVenueStatus").text(respArr.eventStatus);

                            viewEventCategory(respArr.eventCategoryId);
                            viewEventSubCategory(respArr.eventSubCategoryId);

                            var viewEventImage = "";
                            var hostname = location.hostname;
                            var viewEventImageLink = "";
                            if(hostname == "localhost"){
                                viewEventImageLink = "<a href='http://localhost/bookmysporto/admin/uploads/events/"+respArr.eventImageName+"' target='_blank'>"+respArr.eventImageName+"</a>";
                            } else {
                                viewEventImageLink = "<a href='https://bookmysporto.com/admin/uploads/events/"+respArr.eventImageName+"' target='_blank'>"+respArr.eventImageName+"</a>";
                            }

                            $("#viewEventImage").html(viewEventImageLink);

                            var eventStatus = "";
                            if(respArr.eventStatus) {
                                if(respArr.eventStatus == 1) {
                                    eventStatus = "Active";
                                } else if(respArr.venueStatus == 2) {
                                    eventStatus = "In-Active";
                                }
                            }

                            $("#viewEventStatus").text(eventStatus);                            
                        }
                    });
                }
            }

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#eventForm').validate({
                        rules: {
                            eventTitle: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            },
                            eventVenue: {
                                required: true
                            },
                            eventStartDate: {
                                required: true
                            },
                            eventEndDate: {
                                required: true
                            },
                            eventCategory: {
                                required: true
                            },
                            eventSubCategory: {
                                required: true    
                            },
                            eventType: {
                                required: true    
                            },
                            venue: {
                                required: true    
                            }
                        },
                        messages: {
                            eventTitle: {
                                required: "Event Title should not be empty.",
                                minlength: "Event Title should be minimum of 5 characters.",
                                maxlength: "Event Title should not be beyond 50 characters."
                            },
                            eventVenue: {
                                required: "Event Venue should not be empty."
                            },
                            eventStartDate: {
                                required: "Enter Start Date and Time."
                            },
                            eventEndDate: {
                                required: "Enter End Date and Time."
                            },
                            eventCategory: {
                                required: "Select Category."
                            },
                            eventSubCategory: {
                                required: "Select Sub Category."
                            },
                            eventType: {
                                required: "Select Type."
                            },
                            venue: {
                                required: "Select Venue."
                            }                      
                        },
                        errorElement: 'span',
                        errorClass: "has-error",
                        highlight: function(element, errorClass, validClass) {
                            $(element).closest(".form-group").addClass("has-error");
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).closest(".form-group").removeClass("has-error");
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            })(jQuery);
        </script>   

        <?php
            $pgMsg = '';
            if((isset($_GET['msg'])) && (!empty($_GET['msg']))) {
                $pgMsg = $_GET['msg'];
            }

            if(!empty($pgMsg)) {
                if($pgMsg == 1) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Create Event');
                        $('#event-form-modal-msg').modal('show');
                        $('#add-msg-div').show();
                        setTimeout(function() {
                            $('#event-form-modal-msg').modal('hide');
                            $('#add-msg-div').hide();
                        }, 2000);
                    </script>                
        <?php
                } else if($pgMsg == 2) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Event');
                        $('#event-form-modal-msg').modal('show');
                        $('#upd-msg-div').show();
                        setTimeout(function() { 
                            $('#event-form-modal-msg').modal('hide');
                            $('#upd-msg-div').hide();
                        }, 2000);
                    </script>      
        <?php
                } else if($pgMsg == 3) {
        ?>          
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Delete Event');
                        $('#event-form-modal-msg').modal('show');
                        $('#del-msg-div').show();
                        setTimeout(function() { 
                            $('#event-form-modal-msg').modal('hide');
                            $('#del-msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                } else if($pgMsg == 4) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Create Event');
                        $('#event-form-modal-msg').modal('show');
                        $('#add-uniq-msg-div').show();
                        $('#upd-uniq-msg-div').hide();
                        setTimeout(function() { 
                            $('#add-uniq-msg-div').modal('hide');
                            $('#add-msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }  else if($pgMsg == 5) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Event');
                        $('#event-form-modal-msg').modal('show');
                        $('#upd-uniq-msg-div').show();
                        $('#add-uniq-msg-div').hide();
                        setTimeout(function() { 
                            $('#upd-uniq-msg-div').modal('hide');
                            $('#add-msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }
            }
        ?>

