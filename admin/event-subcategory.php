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
    $url_current = "event-subcategory.php?";

    if(!empty($admin)) {
        $event_sub_category = new Event_SubCategory();

        $sort_by = "id";
        $sort_type = "desc";
        
        //$all_event_sub_category = (array) $event_sub_category->where(["admin_id" => $admin->id])->orderBy('id')->orderType('desc')->all();

        $all_event_sub_category = $event_sub_category->where(["admin_id" => $admin->id])->orderBy('id')->orderType('desc')->all();

/*        print"<pre>";
        print_r($all_event_sub_category['0']);
        exit;*/
        //$all_event_sub_category['0']?->image_name = null;
        /*if($all_event_sub_category['0']?->image_name){
            echo $all_event_sub_category['0']->image_name;
            exit;
        }*/

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
              <li class="breadcrumb-item active">Event Sub Category</li>
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
                        <h3 class="card-title">Event Sub Category</h3>
                    </div>  
                    <div style="width:17%;float:right;">  
                        <a href="#" data-toggle="modal" data-target="#event-form-modal" class="btn btn-primary btn-sm" onclick="addEditEventSubCategory('create','20','171')">Add Event Sub Category</a>
                    </div>
                </div>
              </div>
              <div class="modal fade" id="event-type-form-modal-msg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="msg-modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="add-msg-div" style="color:green;">Event Sub Category Created Successfully.</div>
                        <div id="upd-msg-div" style="color:green;">Event Sub Category Updated Successfully.</div>
                        <div id="del-msg-div" style="color:green;">Event Sub Category Deleted Successfully.</div>
                        <div id="add-uniq-msg-div" style="color:red;">Event Sub Category Name Already Exist.</div>
                        <div id="upd-uniq-msg-div" style="color:red;">Event Sub Category Name Already Exist.</div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
               <div class="modal fade" id="del-event-form-modal">
                <div class="modal-dialog modal-lg">
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
                        <form id="eventSubCategoryForm" name="eventSubCategoryForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/event_subcategory.php">
                            <input type="hidden" id="eventSubCategoryId" name="eventSubCategoryId" value="<?php echo (!empty($pgEventSubCategoryId)?$pgEventSubCategoryId:''); ?>" />
                            <input type="hidden" id="eventSubCategoryAction" name="eventSubCategoryAction" value="<?php echo (!empty($pgEventSubCategoryAction)?$pgEventSubCategoryAction:''); ?>" />
                            <input type="hidden" id="eventCategoryHidden" name="eventCategoryHidden" value="" />
                            <div id="eventTypeSucResponseDiv" style="color:green;"></div>
                            <div id="eventTypeErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Title</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="eventSubCategoryTitle" name="eventSubCategoryTitle" class="form-control" data-target="#eventSubCategoryTitle" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="eventCategorySpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <span class="required-field">*</span>
                                            <div id="eventCategoryDiv"></div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="eventSubCategoryFileSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div id="eventSubCategoryImagePreview"></div>
                                        <div id="eventSubCategoryImageError" style="color:red;"></div>
                                        <div class="form-group" id="eventFileLabelDiv">
                                            <label>Image</label>
                                        </div>
                                        <div class="form-group" id="eventFileDiv">
                                            <input name="eventSubCategoryFile" id="eventSubCategoryFile" type="file" multiple />
                                            <input type="text" name="eventSubCategoryFileHidden" id="eventSubCategoryFileHidden" />
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
                                                        <input class="form-check-input" type="radio" value="1" id="eventSubCategoryStatusActive" name="eventSubCategoryStatusActive" checked="">
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-check-input" type="radio" value="2" id="eventSubCategoryStatusInActive" name="eventSubCategoryStatusInActive">
                                                        <label class="form-check-label">In-Active</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="eventSubCategorySubmit" name="eventSubCategorySubmit" class="btn btn-primary">Save</button>
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
                                    <label>ID</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventSubCategoryId" name="viewEventSubCategoryId" data-target="#viewEventSubCategoryId"></span>
                                    </div>
                                </div>
                                <div class="eventFormCol">
                                    <label>Title</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventSubCategoryTitle" name="viewEventSubCategoryTitle" data-target="#viewEventSubCategoryTitle"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Category</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventCategoryType" name="viewEventCategoryType" data-target="#viewEventCategoryType"></span>
                                    </div>
                                </div>
                                <div class="eventFormCol">
                                    <label>Image</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventSubCategoryImage" name="viewEventSubCategoryImage" data-target="#viewEventSubCategoryImage"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Status</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventSubCategoryStatus" name="viewEventSubCategoryStatus" data-target="#viewEventSubCategoryStatus"></span>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($all_event_sub_category) > 0){
                            foreach ($all_event_sub_category as $item){ 
                    ?>
                              <tr>
                                <td>
                                    <?php echo $item->id; ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view-event-modal" onclick="viewEventSubCategory('view','<?php echo $item->id; ?>')"><?php echo $item->title; ?></a>
                                </td>
                                <td>
                                    &nbsp;
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
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view-event-modal" onclick="viewEventSubCategory('view','<?php echo $item->id; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEventSubCategory('edit','<?php echo $item->id; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-event-form-modal" onclick="deleteEventSubCategory('delete','<?php echo $item->id; ?>')"><i class="ion-trash-a"></i></a>
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
                        <th>Title</th>
                        <th>Category</th>
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
            $('#eventCategorySpinnerDiv').hide();
            $('#eventSubCategoryFileSpinnerDiv').hide();

            function removeA(arr, eventFileName) {
                const myArray = arr.split(",");
                position = myArray.indexOf(eventFileName);
                delete myArray[position];
                return myArray;
            }

            function delEventImage(eventFileName, respArray) {

                $('#eventSubCategoryImagePreview').html('');

                respArr = removeA(respArray, eventFileName);
                respArray1 = "'"+respArr+"'";

                var formdata = new FormData(); 
    
                formdata.append("eventSubCategoryAction", "deleteEventImg");
                formdata.append("eventFileName", eventFileName);
    
                var respArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";

                $.ajax({
                    url: "./private/controllers/event_subcategory.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {

                        var fileCount = respArr.length;

                        for (var index = 0; index < fileCount; index++) {
                            var src = "'"+respArr[index]+"'";
                            var src1 = respArr[index];
                            if((src != undefined) && (src1 != undefined)) {
                                var delEventImage = 'onclick="delEventImage('+src+','+respArray1+')"';
                                $('#eventCategoryImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delEventImage+'><i class="ion-trash-a"><i></a></div>');
                                respFileNameArray[index] = src1;
                            }
                        }  

                        respFileName = respFileNameArray.toString();

                        $('#eventSubCategoryFileHidden').val(respFileName);       
                        $('#eventSubCategoryImagePreview').html('');     
                        $('#eventSubCategoryFile').val()    
                    }
                });
            }

            $('#eventFileDel').click(function(e) {
                console.log("delete file");
            });

            $('#eventSubCategoryFile').change(function(e) {

                $('#eventSubCategoryImagePreview').html('');
                $('#eventSubCategoryImageError').html('');

                var fileData = $('#eventSubCategoryFile').prop('files')[0];   
                var formdata = new FormData(); 

                // Read selected files
                var totalfiles = document.getElementById('eventSubCategoryFile').files.length;
                var eventCategoryTitle = $('#eventSubCategoryTitle').val();
                for (var index = 0; index < totalfiles; index++) {
                    formdata.append("files[]", document.getElementById('eventSubCategoryFile').files[index]);
                }   

                if (formdata) {
                    formdata.append("eventSubCategoryAction", "upload");
                    formdata.append("eventSubCategoryTitle", eventCategoryTitle);
                }

                var respArray = new Array();
                var errorRespArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";
                $.ajax({
                    url: "./private/controllers/event_subcategory.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {
                        respArray = php_script_response['eventSubCategoryImage'];
                        errorRespArray = php_script_response['eventSubCategoryImageInvalid'];
                        respArray1 = "'"+php_script_response['eventSubCategoryImage']+"'";

                        if(respArray) {
                            var fileCount = respArray.length;

                            for (var index = 0; index < fileCount; index++) {
                                var src = "'"+respArray[index]+"'";
                                var src1 = respArray[index];
                                var delEventImage = 'onclick="delEventImage('+src+','+respArray1+')"';

                                $('#eventSubCategoryImagePreview').append('<div><a href ="uploads/event_subcategory/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delEventImage+'><i class="ion-trash-a"><i></a></div>');
                                respFileNameArray[index] = src1;
                            }   

                            respFileName = respFileNameArray.toString();

                            $('#eventSubCategoryFileHidden').val(respFileName);
                        } else if(errorRespArray) {
                            $('#eventSubCategoryImageError').append(errorRespArray);
                        }
                    }
                 });      
            });

            $('#evenFileSpinnerDiv').hide();

            function deleteEventSubCategory(eventSubCatAction, eventSubCatId) {
                window.location.href='private/controllers/event_subcategory.php?eventSubCategoryAction='+eventSubCatAction+'&eventSubCategoryId='+eventSubCatId;
            }

            function viewEventSubCategory(eventSubCatAction, eventSubCatId) {
                var formData = {};
                formData = {eventSubCategoryAction:eventSubCatAction, eventSubCategoryId:eventSubCatId};

                $('#view-modal-title-text').text('View Event Sub Category');               
                
                if(eventSubCatAction == "view") {
                    $.ajax({
                        url: "./private/controllers/event_subcategory.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(eventSubCatAction == "view") {
                                $("#viewEventSubCategoryId").html(respArr.id);
                                $("#viewEventSubCategoryTitle").html(respArr.title);

                                var hostname = location.hostname;
                                var viewEventSubCategoryImageLink = "";
                                if(hostname == "localhost"){
                                    viewEventCategoryImageLink = "<a href='http://localhost/sportifyv2/admin/uploads/event_subcategory/"+respArr.image_name+"' target='_blank'>"+respArr.image_name+"</a>";
                                } else {
                                    viewEventCategoryImageLink = "<a href='https://bookmysporto.com/admin/uploads/event_subcategory/"+respArr.image_name+"' target='_blank'>"+respArr.image_name+"</a>";
                                }
                                $("#viewEventSubCategoryImage").html(viewEventCategoryImageLink);
                                                              
                                var viewEventSubCatStatus = "In-Active";
                                if(respArr.status == 1){
                                    viewEventSubCatStatus = "Active";
                                } else if(respArr.status == 2){
                                    viewEventSubCatStatus = "In-Active";
                                }
                                $("#viewEventSubCategoryStatus").html(viewEventSubCatStatus);
                            }                    
                        }
                    });
               } 
            }
            
            function addEditEventSubCategory(eventSubCategoryAction, eventSubCategoryId) {

                eventCategory('','171');

                var formData = {};
                if(eventSubCategoryAction == "create") {
                    $("#eventSubCategoryAction").val(eventSubCategoryAction);
                    $('#modal-title-text').text('Add Event Sub Category');
                    $("#eventSubCategoryAction").val('add');
                    $("#eventSubCategoryTitle").val('');
                } else if(eventSubCategoryAction == "edit") {
                    $("#eventSubCategoryAction").val(eventSubCategoryAction);
                    $('#modal-title-text').text('Update Event Sub Category');
                    formData = {
                        "eventSubCategoryId": eventSubCategoryId,
                        "eventSubCategoryAction": eventSubCategoryAction
                    };
                } else if(eventSubCategoryAction == "delete") {
                    formData = {
                        "eventSubCategoryId": eventSubCategoryId,
                        "eventSubCategoryAction": eventSubCategoryAction
                    };
                }

                if(eventSubCategoryAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/event_subcategory.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(eventSubCategoryAction == "edit") {
                                $("#eventSubCategoryId").val(respArr.id);
                                $("#eventSubCategoryAction").val('update');
                                $("#eventSubCategoryTitle").val(respArr.title);                            

                                if(respArr.status == 1) {
                                    $("#eventSubCategoryStatusActive").prop( "checked", true );
                                    $("#eventSubCategoryStatusInActive").prop( "checked", false );
                                } else if(respArr.status == 2) {
                                    $("#eventSubCategoryStatusActive").prop( "checked", false );
                                    $("#eventSubCategoryStatusInActive").prop( "checked", true );
                                } else {
                                    $("#eventSubCategoryStatusActive").prop( "checked", false );
                                    $("#eventSubCategoryStatusInActive").prop( "checked", true );
                                }
                            }                    
                        }
                    });
                    
                    eventSubCategoryImage(eventSubCategoryId);
                }
            }

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#eventSubCategoryForm').validate({
                        rules: {
                            eventSubCategoryTitle: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            },
                            eventSubCategoryStatus: {
                                required: true
                            }
                        },
                        messages: {
                            eventSubCategoryTitle: {
                                required: "Event Sub Category Title should not be empty.",
                                minlength: "Event Sub Category Title should be minimum of 5 characters.",
                                maxlength: "Event Sub Category Title should not be beyond 20 characters."
                            },
                            eventSubCategoryStatus: {
                                required: "Select Event Sub Category Status."
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
                        $('#msg-modal-title-text').text('Create Event Sub Category');
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
                        $('#msg-modal-title-text').text('Update Event Sub Category');
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
                        $('#msg-modal-title-text').text('Delete Event Sub Category');
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
                        $('#msg-modal-title-text').text('Create Event Sub Category');
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
                        $('#msg-modal-title-text').text('Update Event Sub Category');
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
        <script type="text/javascript">
            $("#eventCategory").change(function() {
                var eventTypeId = $("#eventType").val();
                var categoryId = $("#eventCategoryHidden").val();
                $.ajax({
                    url: "sub_category.php",
                    cache: false,
                    type: "POST",
                    data: {categoryId : categoryId},
                    success: function(html){
                        $("#eventSubCategoryDiv").html(html);
                    }
                });
            });
        </script>








      