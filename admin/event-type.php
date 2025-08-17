<?php require_once('./private/init.php'); ?>

<?php
    $errors = Session::get_temp_session(new Errors());
    $message = Session::get_temp_session(new Message());
    $admin = Session::get_session(new Admin());

    $sort_by_array["created"] = "Date";
    $sort_by_array["name"] = "Name";
    $sort_by_array["status"] = "Status";

    $sort_type_array["DESC"] = "Desc";
    $sort_type_array["ASC"] = "Asc";

    $sort_by = $sort_type = $search = "";
    $url_current = "event-type.php?";

    if(!empty($admin)) {
        $event_type = new Event_Type();

        $sort_by = "id";
        $sort_type = "desc";
        $all_event_type = $event_type->where(["admin_id" => $admin->id])
                            ->orderBy($sort_by)->orderType($sort_type)->all();

        $panel_setting = new Setting();
        $panel_setting = $panel_setting->where(["admin_id"=> $admin->id])->one();
    }else {
        Helper::redirect_to("login.php");
    }

    $delMsg = '';
    if((isset($_GET['delmsg'])) && (!empty($_GET['delmsg']))) {
        $delMsg = 'Event Type Deleted Successfully.';
    }
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
              <li class="breadcrumb-item active">Event Type</li>
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
                        <h3 class="card-title">Event Type</h3>
                    </div>  
                    <div style="width:12%;float:right;">  
                        <a href="#" data-toggle="modal" data-target="#event-form-modal" class="btn btn-primary btn-sm" onclick="addEditEventType('create','','101','4183','35','20','37','171','174')">Add Event Type</a>
                    </div>
                </div>
              </div>
              <div class="modal fade" id="event-type-form-modal-msg">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="msg-modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="add-msg-div" style="color:green;">Event Type Created Successfully.</div>
                        <div id="upd-msg-div" style="color:green;">Event Type Updated Successfully.</div>
                        <div id="del-msg-div" style="color:green;">Event Type Deleted Successfully.</div>
                        <div id="add-uniq-msg-div" style="color:red;">Event Type Name Already Exist.</div>
                        <div id="upd-uniq-msg-div" style="color:red;">Event Type Name Already Exist.</div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
               <div class="modal fade" id="del-event-form-modal">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="del-modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="delEventSucResponseDiv" style="color:green;"></div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <div class="modal fade" id="event-form-modal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <style>
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
                        <form id="eventTypeForm" name="eventTypeForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/event_type.php">
                            <input type="hidden" id="eventTypeId" name="eventTypeId" value="<?php echo (!empty($eventId)?$eventTypeId:''); ?>" />
                            <input type="hidden" id="eventTypeAction" name="eventTypeAction" value="<?php echo (!empty($pgAction)?$pgAction:''); ?>" />
                            <div id="eventTypeSucResponseDiv" style="color:green;"></div>
                            <div id="eventTypeErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Name</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="eventTypeName" name="eventTypeName" class="form-control" data-target="#eventTypeName" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Status</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input class="form-check-input" type="radio" value="1" id="eventTypeStatusActive" name="eventTypeStatusActive" checked="">
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-check-input" type="radio" value="2" id="eventTypeStatusInActive" name="eventTypeStatusInActive">
                                                        <label class="form-check-label">In-Active</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="eventTypeSubmit" name="eventTypeSubmit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="view-event-modal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="view-modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="eventFormMainDiv" id="modal-div">
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Name</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventTypeName" name="viewEventTypeName" data-target="#viewEventTypeName"></span>
                                    </div>
                                </div>
                                <div class="eventFormCol">
                                    <label>Status</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventTypeStatus" name="viewEventTypeStatus" data-target="#viewEventTypeStatus"></span>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="eventTypeList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th class="width10">ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($all_event_type) > 0){
                            foreach ($all_event_type as $item){ 
                    ?>
                              <tr>
                                <td>
                                    <?php echo $item->id; ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view-event-modal" onclick="viewEventType('view','<?php echo $item->id; ?>')"><?php echo $item->name; ?></a>
                                </td>
                                <td>
                                    <?php 
                                        $status_class = "";
                                        $status = '<span class="badge badge-secondary">In-Active</span>';
                                        if($item->status == 1){
                                            $status_class = "active";
                                            $status = '<span class="badge badge-success">Active</span>';
                                        }     
                                    ?>
                                    <span class="table-status <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                </td>
                                <td style="width:100px;">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view-event-modal" onclick="viewEventType('view','<?php echo $item->id; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEventType('edit','<?php echo $item->id; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-event-form-modal" onclick="deleteEventType('delete','<?php echo $item->id; ?>')"><i class="ion-trash-a"></i></a>
                                </td>
                              </tr>
                  <?php 
                            }
                        }    
                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th class="width10">ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
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
        <!-- Page specific script -->
        <script>
            jQuery.noConflict();
            (function( $ ) {
              $(function() {
                // More code using $ as alias to jQuery
                $("#eventTypeList").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    "order":  [[0, 'desc']],
                    "columnDefs": [{ "orderable": true, "targets": [1,2] }]
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
            })(jQuery);
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
            $(function () {
                $('#eventStartDate').datetimepicker({ icons: { time: 'far fa-clock' } });
                $('#eventEndDate').datetimepicker({ icons: { time: 'far fa-clock' } });
            });
        </script>
        <script>
            $('#add-msg-div').hide();
            $('#upd-msg-div').hide();
            $('#del-msg-div').hide();
            $('#upd-uniq-msg-div').hide();
            $('#add-uniq-msg-div').hide();

            function removeA(arr, eventFileName) {
                const myArray = arr.split(",");
                position = myArray.indexOf(eventFileName);
                delete myArray[position];
                return myArray;
            }

            $('#eventFileDel').click(function(e) {
                console.log("delete file");
            });

            function deleteEventType(eventTypeAction, eventTypeId) {
                window.location.href='private/controllers/event_type.php?eventTypeAction='+eventTypeAction+'&eventTypeId='+eventTypeId;
            }

            function viewEventType(eventTypeAction, eventTypeId) {
                var formData = {};
                formData = {eventTypeAction:eventTypeAction, eventTypeId:eventTypeId};

                $('#view-modal-title-text').text('View Event Type');               
                
                if(eventTypeAction == "view") {
                    $.ajax({
                        url: "./private/controllers/event_type.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(eventTypeAction == "view") {
                                $("#viewEventTypeId").html(respArr.id);
                                $("#viewEventTypeName").html(respArr.name);
                                                
                                var viewEventStatus = "In-Active";
                                if(respArr.status == 1){
                                    viewEventStatus = "Active";
                                } else if(respArr.status == 2){
                                    viewEventStatus = "In-Active";
                                }
                                $("#viewEventTypeStatus").html(viewEventStatus);
                            }                    
                        }
                    });
               } 
            }
            
            function addEditEventType(eventTypeAction, eventTypeId) {
                var formData = {};
                if(eventTypeAction == "create") {
                    $("#eventTypeAction").val(eventTypeAction);
                    $('#modal-title-text').text('Add Event Type');
                    $("#eventTypeId").val('');
                    $("#eventTypeAction").val('add');
                    $("#eventTypeName").val('');
                } else if(eventTypeAction == "edit") {
                    $("#eventTypeAction").val(eventTypeAction);
                    $('#modal-title-text').text('Update Event Type');
                    formData = {
                        "eventTypeId": eventTypeId,
                        "eventTypeAction": eventTypeAction
                    };
                } else if(eventAction == "delete") {
                    formData = {
                        "eventTypeId": eventTypeId,
                        "eventTypeAction": eventTypeAction
                    };
                }           

                if(eventTypeAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/event_type.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(eventTypeAction == "edit") {
                                $("#eventTypeId").val(respArr.id);
                                $("#eventTypeAction").val('update');
                                $("#eventTypeName").val(respArr.name);                                

                                if(respArr.status == 1) {
                                    $("#eventTypeStatusActive").prop( "checked", true );
                                    $("#eventTypeStatusInActive").prop( "checked", false );
                                } else if(respArr.status == 2) {
                                    $("#eventTypeStatusActive").prop( "checked", false );
                                    $("#eventTypeStatusInActive").prop( "checked", true );
                                } else {
                                    $("#eventTypeStatusActive").prop( "checked", false );
                                    $("#eventTypeStatusInActive").prop( "checked", true );
                                }
                            }                    
                        }
                    });
                } 
            }

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#eventTypeForm').validate({
                        rules: {
                            eventTypeName: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            }/*,
                            eventTypeStatus: {
                                required: true
                            }*/
                        },
                        messages: {
                            eventTypeName: {
                                required: "Event Type Name should not be empty.",
                                minlength: "Event Type Name should be minimum of 5 characters.",
                                maxlength: "Event Type Name should not be beyond 20 characters."
                            }/*,
                            eventTypeStatus: {
                                required: "Select Event Type Status."
                            }  */                 
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
                        $('#msg-modal-title-text').text('Create Event Type');
                        $('#event-type-form-modal-msg').modal('show');
                        $('#add-msg-div').show();
                        setTimeout(function() {
                            $('#event-type-form-modal-msg').modal('hide');
                            $('#add-msg-div').hide();
                        }, 2000);
                    </script>                
        <?php
                } else if($pgMsg == 2) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Event Type');
                        $('#event-type-form-modal-msg').modal('show');
                        $('#upd-msg-div').show();
                        setTimeout(function() { 
                            $('#event-type-form-modal-msg').modal('hide');
                            $('#upd-msg-div').hide();
                        }, 2000);
                    </script>      
        <?php
                } else if($pgMsg == 3) {
        ?>          
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Delete Event Type');
                        $('#event-type-form-modal-msg').modal('show');
                        $('#del-msg-div').show();
                        setTimeout(function() { 
                            $('#event-type-form-modal-msg').modal('hide');
                            $('#del-msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                } else if($pgMsg == 4) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Create Event Type');
                        $('#event-type-form-modal-msg').modal('show');
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
                        $('#msg-modal-title-text').text('Update Event Type');
                        $('#event-type-form-modal-msg').modal('show');
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








      