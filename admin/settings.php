<?php require_once('./private/init.php'); ?>
<?php
    $errors = Session::get_temp_session(new Errors());
	$message = Session::get_temp_session(new Message());
	$admin = Session::get_session(new Admin());

	if(!empty($admin)){
		$settings = new Setting();
		$settings = $settings->where(["admin_id" => 1])->one();

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
              <li class="breadcrumb-item active">Settings</li>
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
                        <h3 class="card-title">Settings</h3>
                    </div>
                </div>
              </div>
              <div class="modal fade" name="form-modal-msg" id="form-modal-msg">
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
                    .hideModalDiv {
                        dispaly:none;
                    }

                    .spinner {
                        width:25px;
                        height:25px;
                    }

                    .eventFormMainDiv {
                        float:left;
                        width:100%;
                        border:0px solid red;
                    }

                    .eventFormRow {
                        float:left;
                        width:100%;
                        border:0px solid red;
                    }

                    .eventFormCol {    
                        float:left;
                        width:48%;
                        border:0px solid red;
                    }

                    .eventFormSpacerDiv { 
                         float:left;
                         width:1%;
                    }
                    .bootstrap-select > .dropdown-toggle {
                        height: 38px ;
                    }

                    .multiselect-container>li>a>label {
                        margin: 0;
                        height: 100%;
                        cursor: pointer;
                        font-weight: 400;
                        padding: 3px 20px 3px 10px;
                    }

                    .multiselect-container {
                        position: absolute;
                        list-style-type: none;
                        margin: 0;
                        padding: 0;
                        min-width: 100% !important;
                    }

                    span.has-error {  
                        color: red;  
                    }

              		.required-field{
    					color:red;
    				}
              	</style>			
              <!-- /.card-header -->
              <div class="card-body">
                 <!-- <?php if($message) echo '<div class="ml-15 mt-15">' . $message->format() . '</div>'; ?> -->
				<div class="card card-info">
	              <div class="card-header">
	              	<h3 class="card-title">Api Token</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form data-validation="true" name="frmApiToken" id="frmApiToken" method="POST" action="./private/controllers/setting.php">
					<input type="hidden" name="id" value="<?php echo $settings->id; ?>"/>
					<input type="hidden" name="admin_id" value="<?php echo $settings->admin_id; ?>"/>
	                <div class="card-body">
	                  <div class="form-group row">
	                    <label for="inputPassword3" class="col-sm-2 col-form-label">Api Token<span class="required-field">*</span></label>
	                    <div class="col-sm-3">
	                      <input data-required="true" type="text" name="api_token" id="api_token" placeholder="API Token" value="<?php echo $settings->api_token; ?>" class="form-control">
	                    </div>
	                  </div>
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
	                  <button type="submit" class="btn btn-info">Update</button>
	                </div>
	                <!-- /.card-footer -->
	              </form>
	              	<?php 
	                	if(Session::get_session_by_key("type") == "api_token"){
	                    	Session::unset_session_by_key("type");
	                    	if($errors) echo $errors->format();
	                	}
	                ?>
	            </div>
				<div class="card card-info">
	              <div class="card-header">
	              	<h3 class="card-title">Currency</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form data-validation="true" name="frmCurrency" id="frmCurrency" method="POST" action="../admin/private/controllers/setting.php">
					<input type="hidden" name="id" value="<?php echo $settings->id; ?>"/>
					<input type="hidden" name="admin_id" value="<?php echo $settings->admin_id; ?>"/>
	                <div class="card-body">
	                  <div class="form-group row">
	                    <label for="inputEmail3" class="col-sm-2 col-form-label">Currency<span class="required-field">*</span></label>
	                    <div class="col-sm-3">
	                    	<?php if(CURRENCY_TYPES > 0){ ?>
								<select name="currency_type" id="currency_type" style="margin-top: 0; padding: 0 5px;" class="form-control">
									<?php foreach(CURRENCY_TYPES as $key => $value){ ?>
										<?php if($settings->currency_type == $key) $selected_cat = "selected";
										else $selected_cat = ""; ?>

										<option value="<?php echo $key; ?>"  <?php echo $selected_cat; ?>><?php echo $value; ?></option>
									<?php }?>
								</select>
							<?php  
								} 
							?>
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputPassword3" class="col-sm-2 col-form-label">Name<span class="required-field">*</span></label>
	                    <div class="col-sm-3">
	                      <input data-required="true" type="text" placeholder="eg. 100" name="currency_name" id="currency_name" value="<?php echo $settings->currency_name; ?>" class="form-control">
	                    </div>
	                  </div>
	                  <div class="form-group row">
	                    <label for="inputPassword3" class="col-sm-2 col-form-label">Font<span class="required-field">*</span></label>
	                    <div class="col-sm-3">
	                      <input data-required="true" type="text" placeholder="eg. 100" name="currency_font" id="currency_font" value="<?php echo $settings->currency_font; ?>" class="form-control">
	                    </div>
	                  </div>
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
	                  <button type="submit" class="btn btn-info">Update</button>
	                </div>
	                <!-- /.card-footer -->
	              </form>
	            </div>
	            <div class="card card-info">
	              <div class="card-header">
	              	<h3 class="card-title">Tax(%)</h3>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form data-validation="true" name="frmTax" id="frmTax" method="POST" action="../admin/private/controllers/setting.php">
					<input type="hidden" name="id" value="<?php echo $settings->id; ?>"/>
					<input type="hidden" name="admin_id" value="<?php echo $settings->admin_id; ?>"/>
	                <div class="card-body">
	                  <div class="form-group row">
	                    <label for="inputPassword3" class="col-sm-2 col-form-label">Tax in %<span class="required-field">*</span></label>
	                    <div class="col-sm-3">
	                      <input data-required="true" type="text" placeholder="eg. 20" name="tax" id="tax" value="<?php echo $settings->tax; ?>" class="form-control">
	                    </div>
	                  </div>
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
	                  <button type="submit" class="btn btn-info">Update</button>
	                </div>
	                <!-- /.card-footer -->
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
        <?php require("common/php/php-footer.php"); ?>
        <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- jquery-validation -->
        <script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script>
            $('#upd-msg-div').hide();

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#frmApiToken').validate({
                        rules: {
                            api_token: {
                                required: true,
                                minlength: 5,
                                maxlength: 20
                            }
                        },
                        messages: {
                            api_token: {
                                required: "Api Token should not be empty.",
                                minlength: "Api Token should be minimum of 5 characters.",
                                maxlength: "Api Token should be maximum of 20 characters."
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

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#frmCurrency').validate({
                        rules: {
                            currency_type: {
                                required: true
                            },
                            currency_name: {
                                required: true,
                                minlength: 5,
                                maxlength: 15
                            },
                            currency_font: {
                                required: true,
                                minlength: 3,
                                maxlength: 5
                            }
                        },
                        messages: {
                            currency_type: {
                                required: "Currency should not be empty."
                            },
                            currency_name: {
                                required: "Currency should not be empty.",
                                minlength: "Currency should be minimum of 5 characters.",
                                maxlength: "Currency should be maximum of 15 characters."
                            },
                            currency_font: {
                                required: "Currency should not be empty.",
                                minlength: "Currency should be minimum of 3 characters.",
                                maxlength: "Currency should be maximum of 5 characters."
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

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#frmTax').validate({
                        rules: {
                            tax: {
                                required: true,
                                minlength: 1,
                                maxlength: 3,
                                digits: true
                            }
                        },
                        messages: {
                            tax: {
                                required: "Tax should not be empty.",
                                minlength: "Tax should be minimum of 1 characters.",
                                maxlength: "Tax should be maximum of 3 characters.",
                                digits: "Tax should be a number."
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
                        $('#modal-title-text').text('Settings-Api Token');
                        $('#msg-div').text('Api Token Updated Successfully.');
                        $('#form-modal-msg').modal('show');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>
        <?php
                }elseif($pgMsg == 2){
        ?>
                    <script type="text/javascript">
                        $('#modal-title-text').text('Settings-Currency');
                        $('#msg-div').text('Currency Updated Successfully.');
                        $('#form-modal-msg').modal('show');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>
        
        <?php            
                }elseif($pgMsg == 3){
        ?>
                    <script type="text/javascript">
                        $('#modal-title-text').text('Settings-Tax');
                        $('#msg-div').text('Tax Updated Successfully.');
                        $('#form-modal-msg').modal('show');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>
        
        <?php
                }            
            }
        ?>

