<?php require_once('./private/init.php'); ?>

<?php
    $errors = Session::get_temp_session(new Errors());
    $message = Session::get_temp_session(new Message());
    $admin = Session::get_session(new Admin());

    $url_current = "admin-users.php?";

    if(!empty($admin)) {
        $adminUsers = new Admin();     
        $all_users = (array) $adminUsers->all();
    }else {
        Helper::redirect_to("login.php");
    }

    /*$memcache = new Memcache;
    $memcache->connect('localhost', 11211) or die ("Could not connect");*/

    $delMsg = '';
    if((isset($_GET['delmsg'])) && (!empty($_GET['delmsg']))) {
        $delMsg = 'Admin Deleted Successfully.';
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
              <li class="breadcrumb-item active">Admin Users</li>
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
                        <h3 class="card-title">Admin Users</h3>
                    </div>  
                    <div style="width:15%;float:right;"> 
                        <a href="#" data-toggle="modal" data-target="#admin-form-modal" class="btn btn-primary btn-sm" onclick="addEditAdmin('create','','','','','','')">Add Admin Users</a>
                    </div>
                </div>
              </div>

                  <!-- $('#msg-modal-title-text').text('Create Event');
                        $('#modal-msg').modal('show');
                        $('#msg-div').show(); -->
              <div class="modal fade" id="modal-msg">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="msg-modal-title-text"></span></h4>
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
              <div class="modal fade" id="admin-form-modal">
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
                        <form id="adminForm" name="adminForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/admin_users.php">
                            <input type="hidden" id="adminUserId" name="adminUserId" value="" />
                            <input type="hidden" id="adminAction" name="adminAction" value="" />
                            <div id="eventSucResponseDiv" style="color:green;"></div>
                            <div id="eventErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>User Name</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="adminUserName" name="adminUserName" class="form-control" data-target="#adminUserName" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>E-Mail</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="adminUserEmail" name="adminUserEmail" class="form-control" data-target="#adminUserEmail" />
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Password</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="adminUserPassword" name="adminUserPassword" class="form-control" data-target="#adminUserPassword" />
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="evenFileSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div id="eventImagePreview"></div>
                                        <div id="eventImageError" style="color:red;"></div>
                                        <div class="form-group" id="eventFileLabelDiv">
                                            <label>Image</label>
                                        </div>
                                        <div class="form-group" id="eventFileDiv">
                                            <input name="eventFile" id="eventFile" type="file" multiple />
                                            <input type="hidden" name="eventFileHidden" id="eventFileHidden" />
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="adminUserSubmit" name="adminUserSubmit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="view-admin-modal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="view-admin-modal-title-text"></span></h4>
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
                                        <span id="viewAdminUserId" name="viewAdminUserId" data-target="#viewAdminUserId"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>User Name</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewAdminUserName" name="viewAdminUserName" data-target="#viewAdminUserName"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>E-Mail</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewAdminUserEmail" name="viewAdminUserEmail" data-target="#viewAdminUserEmail"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Status</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewAdminUserStatus" name="viewAdminUserStatus"></span>
                                    </div>
                                </div>
                                <!-- <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Password</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewAdminUserPassword" name="viewAdminUserPassword" data-target="#viewAdminUserPassword"></span>
                                    </div>
                                </div> -->
                            </div>
                            <!-- <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Image</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewAdminUserImage" name="viewAdminUserImage" data-target="#viewAdminUserImage"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Status</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewAdminUserStatus" name="viewAdminUserStatus"></span>
                                    </div>
                                </div>
                            </div>   -->                          
                        </div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="eventsList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>E-Mail</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        /*print"<pre>";
                        print_r($_SESSION['bookmysporto_id']);
                        exit;*/

                        /*echo $_SESSION['bookmysporto_id'];
                        exit;*/

                        if(count($all_users) > 0){
                            foreach ($all_users as $item){
                                if($item->id != 1){
                                    //if($_SESSION['bookmysporto_id'] == $item->id){                                    
                    ?>
                                      <tr>
                                        <td>
                                            <?php echo $item->id; ?>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#view-admin-modal" onclick="viewAdmin('view','<?php echo $item->id; ?>')"><?php echo $item->username; ?></a>
                                        </td>
                                        <td>
                                            <?php
                                                $adminUserEmail = "";
                                                if((isset($item->email)) && (!empty($item->email))){
                                                    $adminUserEmail = $item->email;
                                                }     
                                            ?>
                                            <?php echo $adminUserEmail; ?>
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
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view-admin-modal" onclick="viewAdmin('view','<?php echo $item->id; ?>')"><i class="ion-eye"></i></a>
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#admin-form-modal" onclick="addEditAdmin('edit','<?php echo $item->id; ?>')"><i class="ion-compose"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-admin-form-modal" onclick="deleteAdmin('delete','<?php echo $item->id; ?>')"><i class="ion-trash-a"></i></a>
                                        </td>
                                      </tr>
                  <?php
                                //}
                            }
                        }
                    }    
                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>E-Mail</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
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
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../admin/dist/css/richtext.min.css">
        <script src="../admin/dist/js/jquery.richtext.js"></script> -->
        <script>
            jQuery.noConflict();
            (function( $ ) {
              $(function() {
                /*$('.content').richText({
                    useTabForNext: true,
                    maxlength: 1000,
                    maxlengthIncludeHTML: true
                });*/

                /*$('.content2').richText({
                    useTabForNext: true
                });*/

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
            })(jQuery);
        </script>
        <?php require("common/php/php-footer.php"); ?>
        <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- jquery-validation -->
        <script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../admin/plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- date-range-picker -->
        <!-- <script src="../admin/plugins/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#eventStartDate').datetimepicker({ icons: { time: 'far fa-clock' } });
                $('#eventEndDate').datetimepicker({ icons: { time: 'far fa-clock' } });
            });
        </script> -->
        <script>
            $('#msg-div').hide();
  
            function removeA(arr, eventFileName) {
                const myArray = arr.split(",");
                position = myArray.indexOf(eventFileName);
                delete myArray[position];
                return myArray;
            }

            function delEventImage(eventFileName, respArray) {

                $('#eventImagePreview').html('');

                respArr = removeA(respArray, eventFileName);
                respArray1 = "'"+respArr+"'";

                var formdata = new FormData(); 
    
                formdata.append("eventAction", "deleteEventCatImg");
                formdata.append("eventFileName", eventFileName);
    
                var respArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";

                $.ajax({
                    url: "./private/controllers/event.php", 
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
                                $('#eventImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delEventImage+'><i class="ion-trash-a"><i></a></div>');
                                respFileNameArray[index] = src1;
                            }
                        }  

                        respFileName = respFileNameArray.toString();

                        $('#eventFileHidden').val(respFileName);                
                    }
                });
            }

            $('#eventFileDel').click(function(e) {
                console.log("delete file");
            });

            $('#eventFile').change(function(e) {

                $('#eventImagePreview').html('');
                $('#eventImageError').html('');

                var fileData = $('#eventFile').prop('files')[0];   
                var formdata = new FormData(); 

                // Read selected files
                var totalfiles = document.getElementById('eventFile').files.length;
                var eventTitle = $('#eventTitle').val();
                for (var index = 0; index < totalfiles; index++) {
                    formdata.append("files[]", document.getElementById('eventFile').files[index]);
                }   

                if (formdata) {
                    formdata.append("eventAction", "upload");
                    formdata.append("eventTitle", eventTitle);
                }

                var respArray = new Array();
                var errorRespArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";
                $.ajax({
                    url: "./private/controllers/event.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {
                        respArray = php_script_response['eventImage'];
                        errorRespArray = php_script_response['eventImageInvalid'];
                        respArray1 = "'"+php_script_response['eventImage']+"'";
                        
                        if(respArray) {
                            var fileCount = respArray.length;

                            for (var index = 0; index < fileCount; index++) {
                                var src = "'"+respArray[index]+"'";
                                var src1 = respArray[index];
                                var delEventImage = 'onclick="delEventImage('+src+','+respArray1+')"';

                                $('#eventImagePreview').append('<div><a href ="uploads/events/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delEventImage+'><i class="ion-trash-a"><i></a></div>');
                                respFileNameArray[index] = src1;
                            }   

                            respFileName = respFileNameArray.toString();

                            $('#eventFileHidden').val(respFileName);
                        } else if(errorRespArray) {
                            $('#eventImageError').append(errorRespArray);
                        }
                    }
                 });      
            });

            function deleteAdmin(adminAction, adminId) {
                window.location.href='private/controllers/admin_users.php?aUsrAction='+adminAction+'&aUsrId='+adminId;
            }

            function addEditAdmin(adminAction, adminId) {
                /*if(adminAction == "edit") {
                    adminImage(adminId);
                }
                */

                $("#adminUserId").val('');
                $("#adminUserName").val('');
                $("#adminUserEmail").val('');

                var formData = {};
                if(adminAction == "create") {
                    //$("#adminAction").val(adminAction);
                    $('#modal-title-text').text('Add Admin User');
                    $("#adminAction").val('add');
                } else if(adminAction == "edit") {
                    //$("#adminAction").val(adminAction);
                    $('#modal-title-text').text('Update Admin User');
                    $("#adminAction").val('update');
                    formData = {
                        "aUsrId": adminId,
                        "aUsrAction": adminAction
                    };
                } else if(adminAction == "delete") {
                    formData = {
                        "aUsrId": adminId,
                        "aUsrAction": adminAction
                    };
                }           

                if(adminAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/admin_users.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            console.log("respArr",respArr.id);

                            if(adminAction == "edit") {
                                $("#adminUserId").val(respArr.id);
                                $("#adminUserName").val(respArr.username);
                                $("#adminUserEmail").val(respArr.email);
                                //$("#adminUserPassword").text(respArr.password);

                                var adminStatus = "In-Active";
                                if(respArr.status){
                                    if(respArr.status == 1){
                                        adminStatus = "Active"
                                    } else if(respArr.status == 2){
                                        adminStatus = "In-Active"
                                    }
                                }

                                $("#adminUserStatus").html(respArr.adminStatus);
                            }                    
                        }
                    });
                } 
            }

            function viewAdmin(adminAction, adminId) {

                $('#view-admin-modal-title-text').text('View Admin User');

                var formData = {};
                if(adminAction == "view") {
                    formData = {
                        "aUsrId": adminId,
                        "aUsrAction": adminAction
                    };
                
                    $.ajax({
                        url: "../admin/private/controllers/admin_users.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            $("#viewAdminUserId").text(respArr.id);
                            $("#viewAdminUserName").text(respArr.username);
                            $("#viewAdminUserEmail").html(respArr.email);
                            //$("#viewAdminUserPassword").text(respArr.password);

                            var adminStatus = "In-Active";
                            if(respArr.status){
                                if(respArr.status == 1){
                                    adminStatus = "Active"
                                } else if(respArr.status == 2){
                                    adminStatus = "In-Active"
                                }
                            }

                            $("#viewAdminUserStatus").text(adminStatus);

                            /*var viewEventImage = "";
                            var hostname = location.hostname;
                            var viewEventImageLink = "";
                            if(hostname == "localhost"){
                                viewEventImageLink = "<a href='http://localhost/bookmysporto/admin/uploads/events/"+respArr.eventImageName+"' target='_blank'>"+respArr.eventImageName+"</a>";
                            } else {
                                viewEventImageLink = "<a href='https://bookmysporto.com/admin/uploads/events/"+respArr.eventImageName+"' target='_blank'>"+respArr.eventImageName+"</a>";
                            }

                            $("#viewEventImage").html(viewEventImageLink);*/
                        }
                    });
                }
            }

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#adminForm').validate({
                        rules: {
                            adminUserName: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            },
                            adminUserEmail: {
                                required: true,
                                email: true
                            }/*,
                            adminUserPassword: {
                                required: true
                            }*/
                        },
                        messages: {
                            adminUserName: {
                                required: "User Name should not be empty.",
                                minlength: "User Name be minimum of 10 characters.",
                                maxlength: "User Name should not be beyond 20 characters."
                            },
                            adminUserEmail: {
                                required: "E-Mail should not be empty."
                            }/*,
                            adminUserPassword: {
                                required: "Password should not be empty.",
                                minlength: "Password be minimum of 10 characters.",
                                maxlength: "Password should not be beyond 30 characters."
                            }*/                   
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
                        $('#msg-modal-title-text').text('Create Admin User');
                        $('#msg-div').text('Admin User Created Successfully.');
                        $('#modal-msg').modal('show');                        
                        $('#msg-div').show();
                        setTimeout(function() {
                            $('#modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>                
        <?php
                } else if($pgMsg == 2) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Admin User');
                        $('#msg-div').text('Admin User Updated Successfully.');
                        $('#modal-msg').modal('show');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>      
        <?php
                } else if($pgMsg == 3) {
        ?>          
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Delete Admin User');
                        $('#msg-div').text('Admin User Deleted Successfully.');
                        $('#modal-msg').modal('show');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                } else if($pgMsg == 4) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Create Admin User');
                        $('#msg-div').text('Admin User Name Already Exist.');
                        $('#modal-msg').modal('show');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }  else if($pgMsg == 5) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Admin User');
                        $('#msg-div').text('Admin User Name Already Exist.');
                        $('#modal-msg').modal('show');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }
            }
        ?> 








      