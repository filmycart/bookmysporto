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
    $url_current = "event-category.php?";

    if(!empty($admin)) {
        $event_category = new Category();

        $sort_by = "id";
        $sort_type = "desc";

        $column = "";
        $column = "category.id AS categoryId, category.parent_id AS categoryParentId, category.type_id AS categoryTypeId, category.admin_id AS categoryAdminId, category.title AS categoryTitle, category.status AS categoryStatus, category.image_name AS categoryImageName, category.image_resolution AS categoryImageResolution, category.created AS categoryCreated, ";
        $column .= "event_type.id AS eventTypeId, event_type.name AS eventTypeName, event_type.admin_id AS eventTypeAdminId, event_type.status AS eventTypeStatus";
        $joinColumn['join_table_name1'] = "category";
        $joinColumn['join_table_name2'] = "event_type";

        $joinColumn['join_column_name1'] = "type_id";
        $joinColumn['join_column_name2'] = "id";
        $joinColumn['join_column_child'] = "id";

        $adminId = $joinColumn['join_table_name1']."."."admin_id";  
        
        $all_event_category = (array) $event_category->where([$adminId => $admin->id])->orderBy('id')->orderType('desc')->allWithJoinTwoTables($column, $joinColumn);

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
              <li class="breadcrumb-item active">Event Category</li>
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
                        <h3 class="card-title">Event Category</h3>
                    </div>  
                    <div style="width:14%;float:right;">  
                        <a href="#" data-toggle="modal" data-target="#event-form-modal" class="btn btn-primary btn-sm" onclick="addEditEventCategory('create','20','')">Add Event Category</a>
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
                        <div id="add-msg-div" style="color:green;">Event Category Created Successfully.</div>
                        <div id="upd-msg-div" style="color:green;">Event Category Updated Successfully.</div>
                        <div id="del-msg-div" style="color:green;">Event Category Deleted Successfully.</div>
                        <div id="add-uniq-msg-div" style="color:red;">Event Category Name Already Exist.</div>
                        <div id="upd-uniq-msg-div" style="color:red;">Event Category Name Already Exist.</div>
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
                        <form id="eventCategoryForm" name="eventCategoryForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/event_category.php">
                            <input type="hidden" id="eventCategoryId" name="eventCategoryId" value="<?php echo (!empty($pgEventCategoryId)?$pgEventCategoryId:''); ?>" />
                            <input type="hidden" id="eventCategoryAction" name="eventCategoryAction" value="<?php echo (!empty($pgEventCategoryAction)?$pgEventCategoryAction:''); ?>" />
                            <div id="eventTypeSucResponseDiv" style="color:green;"></div>
                            <div id="eventTypeErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Title</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="eventCategoryTitle" name="eventCategoryTitle" class="form-control" data-target="#eventCategoryTitle" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="eventCategorySpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <span class="required-field">*</span>
                                            <div id="eventTypeDiv"></div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="eventCategoryFileSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div id="eventCategoryImagePreview"></div>
                                        <div id="eventCategoryImageError" style="color:red;"></div>
                                        <div class="form-group" id="eventFileLabelDiv">
                                            <label>Image</label>
                                        </div>
                                        <div class="form-group" id="eventFileDiv">
                                            <input name="eventCategoryFile" id="eventCategoryFile" type="file" multiple />
                                            <input type="hidden" name="eventCategoryFileHidden" id="eventCategoryFileHidden" />
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
                                                        <input class="form-check-input" type="radio" value="1" id="eventCategoryStatusActive" name="eventCategoryStatusActive" checked="">
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-check-input" type="radio" value="2" id="eventCategoryStatusInActive" name="eventCategoryStatusInActive">
                                                        <label class="form-check-label">In-Active</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="eventCategorySubmit" name="eventCategorySubmit" class="btn btn-primary">Save</button>
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
                                    <label>Title</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventCategoryTitle" name="viewEventCategoryTitle" data-target="#viewEventCategoryTitle"></span>
                                    </div>
                                </div>
                                <div class="eventFormCol">
                                    <label>Parent</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventCategoryParent" name="viewEventCategoryParent" data-target="#viewEventCategoryParent"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Type</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventCategoryType" name="viewEventCategoryType" data-target="#viewEventCategoryType"></span>
                                    </div>
                                </div>
                                <div class="eventFormCol">
                                    <label>Image</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventCategoryImage" name="viewEventCategoryImage" data-target="#viewEventCategoryImage"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Status</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewEventCategoryStatus" name="viewEventCategoryStatus" data-target="#viewEventCategoryStatus"></span>
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
                        <th>Parent</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        if(count($all_event_category) > 0){
                            foreach ($all_event_category as $item){
                    ?>
                              <tr>
                                <td>
                                    <?php echo $item->categoryId; ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view-event-modal" onclick="viewEventCategory('view','<?php echo $item->categoryId; ?>')"><?php echo $item->categoryTitle; ?></a>
                                </td>
                                <td>
                                    <?php
                                        $categoryParentName = "N/A";
                                        if($item->categoryParentId != 0){
                                            $categoryParentName = $item->categoryParentId;
                                        }
                                        echo $categoryParentName; ?>
                                </td>
                                <td>
                                    <?php echo $item->eventTypeName; ?>
                                </td>
                                <td>
                                    <?php 
                                        $status_class = "";
                                        $status = '<span class="badge badge-secondary">In-Active</span>';
                                        if($item->categoryStatus == 1){
                                            $status_class = "active";
                                            $status = '<span class="badge badge-success">Active</span>';
                                        }     
                                    ?>
                                    <span class="table-status <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                </td>
                                <td style="width:100px;">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view-event-modal" onclick="viewEventCategory('view','<?php echo $item->categoryId; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEventCategory('edit','<?php echo $item->categoryId; ?>','<?php echo $item->categoryTypeId; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-event-form-modal" onclick="deleteEventCategory('delete','<?php echo $item->categoryId; ?>')"><i class="ion-trash-a"></i></a>
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
                        <th>Parent</th>
                        <th>Type</th>
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
            $('#eventCategoryFileSpinnerDiv').hide();

            function removeA(arr, eventFileName) {
                const myArray = arr.split(",");
                position = myArray.indexOf(eventFileName);
                delete myArray[position];
                return myArray;
            }

            function delEventImage(eventFileName, respArray) {

                $('#eventCategoryImagePreview').html('');

                respArr = removeA(respArray, eventFileName);
                respArray1 = "'"+respArr+"'";

                var formdata = new FormData(); 
    
                formdata.append("eventCategoryAction", "deleteEventImg");
                formdata.append("eventFileName", eventFileName);
    
                var respArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";

                $.ajax({
                    url: "./private/controllers/event_category.php", 
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

                        $('#eventCategoryFileHidden').val(respFileName);       
                        $('#eventCategoryImagePreview').html('');     
                        $('#eventCategoryFile').val()    
                    }
                });
            }

            $('#eventFileDel').click(function(e) {
                console.log("delete file");
            });

            $('#eventCategoryFile').change(function(e) {

                $('#eventCategoryImagePreview').html('');
                $('#eventCategoryImageError').html('');

                var fileData = $('#eventCategoryFile').prop('files')[0];   
                var formdata = new FormData(); 

                // Read selected files
                var totalfiles = document.getElementById('eventCategoryFile').files.length;
                var eventCategoryTitle = $('#eventCategoryTitle').val();
                for (var index = 0; index < totalfiles; index++) {
                    formdata.append("files[]", document.getElementById('eventCategoryFile').files[index]);
                }   

                if (formdata) {
                    formdata.append("eventCategoryAction", "upload");
                    formdata.append("eventCategoryTitle", eventCategoryTitle);
                }

                var respArray = new Array();
                var errorRespArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";
                $.ajax({
                    url: "./private/controllers/event_category.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {
                        respArray = php_script_response['eventCategoryImage'];
                        errorRespArray = php_script_response['eventCategoryImageInvalid'];
                        respArray1 = "'"+php_script_response['eventCategoryImage']+"'";

                        if(respArray) {
                            var fileCount = respArray.length;

                            for (var index = 0; index < fileCount; index++) {
                                var src = "'"+respArray[index]+"'";
                                var src1 = respArray[index];
                                var delEventImage = 'onclick="delEventImage('+src+','+respArray1+')"';

                                $('#eventCategoryImagePreview').append('<div><a href ="uploads/event_category/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delEventImage+'><i class="ion-trash-a"><i></a></div>');
                                respFileNameArray[index] = src1;
                            }   

                            respFileName = respFileNameArray.toString();

                            $('#eventCategoryFileHidden').val(respFileName);
                        } else if(errorRespArray) {
                            $('#eventCategoryImageError').append(errorRespArray);
                        }
                    }
                 });      
            });

            $('#stateSpinnerDiv').show();
            $('#evenFileSpinnerDiv').hide();

            function deleteEventCategory(eventCatAction, eventCatId) {
                window.location.href='private/controllers/event_category.php?eventCategoryAction='+eventCatAction+'&eventCategoryId='+eventCatId;
            }

            function viewEventCategory(eventCatAction, eventCatId) {
                var formData = {};
                formData = {eventCategoryAction:eventCatAction, eventCategoryId:eventCatId};

                $('#view-modal-title-text').text('View Event Category');            
                
                if(eventCatAction == "view") {
                    $.ajax({
                        url: "./private/controllers/event_category.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);

                            if(eventCatAction == "view") {
                                $("#viewEventCategoryId").html(respArr.categoryId);
                                $("#viewEventCategoryTitle").html(respArr.categoryTitle);
                                $("#viewEventCategoryParent").html(respArr.categoryParentId);
                                $("#viewEventCategoryType").html(respArr.eventTypeName);
                                var viewEventCategoryImage = "";
                                var hostname = location.hostname;
                                var viewEventCategoryImageLink = "";
                                if(hostname == "localhost"){
                                    viewEventCategoryImageLink = "<a href='http://localhost/bookmysporto/admin/uploads/event_category/"+respArr.categoryImageName+"' target='_blank'>"+respArr.categoryImageName+"</a>";
                                } else {
                                    viewEventCategoryImageLink = "<a href='https://bookmysporto.com/admin/uploads/event_category/"+respArr.categoryImageName+"' target='_blank'>"+respArr.categoryImageName+"</a>";
                                }
                                $("#viewEventCategoryImage").html(viewEventCategoryImageLink);
                                                              
                                var viewEventStatus = "In-Active";
                                if(respArr.categoryStatus == 1){
                                    viewEventStatus = "Active";
                                } else if(respArr.categoryStatus == 2){
                                    viewEventStatus = "In-Active";
                                }
                                $("#viewEventCategoryStatus").html(viewEventStatus);
                            }                   
                        }
                    });
               } 
            }
            
            function addEditEventCategory(eventCategoryAction, eventCategoryId, eventTypeId) {
                $('#eventCategoryImagePreview').html('');
                var formData = {};
                if(eventCategoryAction == "create") {
                    $("#eventCategoryAction").val(eventCategoryAction);
                    $('#modal-title-text').text('Add Event Category');
                    $("#eventTypeId").val('');
                    $("#eventCategoryAction").val('add');
                    $("#eventCategoryName").val('');
                } else if(eventCategoryAction == "edit") {
                    $("#eventCategoryAction").val(eventCategoryAction);
                    $('#modal-title-text').text('Update Event Category');
                    formData = {
                        "eventCategoryId": eventCategoryId,
                        "eventCategoryAction": eventCategoryAction
                    };
                } else if(eventCategoryAction == "delete") {
                    formData = {
                        "eventCategoryId": eventCategoryId,
                        "eventCategoryAction": eventCategoryAction
                    };
                }

                eventType(eventTypeId);

                if(eventCategoryAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/event_category.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(eventCategoryAction == "edit") {
                                $("#eventCategoryId").val(respArr.id);
                                $("#eventCategoryAction").val('update');
                                $("#eventCategoryTitle").val(respArr.title);                            

                                if(respArr.status == 1) {
                                    $("#eventCategoryStatusActive").prop( "checked", true );
                                    $("#eventCategoryStatusInActive").prop( "checked", false );
                                } else if(respArr.status == 2) {
                                    $("#eventCategoryStatusActive").prop( "checked", false );
                                    $("#eventCategoryStatusInActive").prop( "checked", true );
                                } else {
                                    $("#eventCategoryStatusActive").prop( "checked", false );
                                    $("#eventCategoryStatusInActive").prop( "checked", true );
                                }
                            }                    
                        }
                    });
                    
                    eventCategoryImage(eventCategoryId);
                }
            }

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#eventCategoryForm').validate({
                        rules: {
                            eventCategoryTitle: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            },
                            eventType: {
                                required: true
                            },
                            eventCategoryStatus: {
                                required: true
                            }
                        },
                        messages: {
                            eventCategoryTitle: {
                                required: "Event Category Title should not be empty.",
                                minlength: "Event Category Title should be minimum of 5 characters.",
                                maxlength: "Event Category Title should not be beyond 20 characters."
                            },
                            eventType: {
                                required: "Select Event Type."
                            },
                            eventCategoryStatus: {
                                required: "Select Event Category Status."
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
                        $('#msg-modal-title-text').text('Create Event Category');
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
                        $('#msg-modal-title-text').text('Update Event Category');
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
                        $('#msg-modal-title-text').text('Delete Event Category');
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
                        $('#msg-modal-title-text').text('Create Event Category');
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
                        $('#msg-modal-title-text').text('Update Event Category');
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








      