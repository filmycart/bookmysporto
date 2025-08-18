<?php require_once('./private/init.php'); ?>

<?php
    $errors = Session::get_temp_session(new Errors());
    $message = Session::get_temp_session(new Message());
    $admin = Session::get_session(new Admin());

    $sort_by_array["created"] = "Date";
    $sort_by_array["title"] = "Title";
    $sort_by_array["current_price"] = "Selling Price";
    $sort_by_array["purchase_price"] = "Purchase Price";
    $sort_by_array["sub_category_id"] = "Sub Category";
    $sort_by_array["featured"] = "Featured";
    $sort_by_array["status"] = "Status";

    $sort_type_array["DESC"] = "Desc";
    $sort_type_array["ASC"] = "Asc";

    $sort_by = $sort_type = $search = "";
    $url_current = "admin-user-roles.php?";
    $all_user_permission = array();

    if(!empty($admin)) {
        $adminUserPermission = new Admin_User_Permission();
        $all_user_permission = (array) $adminUserPermission->all();

        $all_products = new Product();
        $pagination = "";
        $pagination_msg = "";

        if(Helper::is_get()){
            $page = Helper::get_val("page");
            $search = Helper::get_val("search");
            $sort_by = Helper::get_val("sort_by");
            $sort_type = Helper::get_val("sort_type");;
            $sub_category_id = Helper::get_val("sub_category_id");
            
            if($search){
                if($sub_category_id){
                    $url_for_pagination = $url_current . "sub_category_id=" . $sub_category_id . "&&";
                    $item_count = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                        ->like(["title" => $search])->search()->count();
                }else{
                    $url_for_pagination = $url_current;
                    $item_count = $all_products->where(["admin_id" => $admin->id])->like(["title" => $search])->search()->count();
                }

                if($item_count < 1) $pagination_msg = "Nothing Found.";

                $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $url_for_pagination);
                if($page){
                    if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
                }else {
                    $page = 1;
                    $pagination->set_page($page);
                }

                $start = ($page - 1) * BACKEND_PAGINATION;

                if($sub_category_id){
                    if($sort_by && $sort_type){
                        $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                            ->like(["title" => $search])->like(["tags" => $search])->search()
                            ->orderBy($sort_by)->orderType($sort_type)
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }else{
                        $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                            ->like(["title" => $search])->like(["tags" => $search])->search()
                            ->orderBy("created")->orderType("DESC")
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }
                }else{
                    if($sort_by && $sort_type){
                        $all_products = $all_products->where(["admin_id" => $admin->id])
                            ->like(["title" => $search])->like(["tags" => $search])->search()
                            ->orderBy($sort_by)->orderType($sort_type)
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }else{
                        $all_products = $all_products->where(["admin_id" => $admin->id])
                            ->like(["title" => $search])->like(["tags" => $search])->search()
                            ->orderBy("created")->orderType("DESC")
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }
                }

            }else{
                if($sub_category_id){
                    $url_for_pagination = $url_current . "sub_category_id=" . $sub_category_id . "&&";
                    $item_count = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])->count();
                }else{
                    $url_for_pagination = $url_current;
                    $item_count = $all_products->where(["admin_id" => $admin->id])->count();
                }
                
                $item_count = $all_products->where(["admin_id" => $admin->id])->count();
                if($item_count < 1) $pagination_msg = "Nothing Found.";
                
                $pagination = new Pagination($item_count, BACKEND_PAGINATION, $page, $url_for_pagination);
                if($page) {
                    if(($page > $pagination->get_page_count()) || ($page < 1)) $pagination_msg = "Nothing Found.";
                }else {
                    $page = 1;
                    $pagination->set_page($page);
                }

                $start = ($page - 1) * BACKEND_PAGINATION;

                if($sub_category_id){
                    if($sort_by && $sort_type){
                        $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                            ->orderBy($sort_by)->orderType($sort_type)
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }else{
                        $all_products = $all_products->where(["admin_id" => $admin->id])->andWhere(["sub_category_id" => $sub_category_id])
                            ->orderBy("created")->orderType("DESC")
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }
                }else{
                    if($sort_by && $sort_type){
                        $all_products = $all_products->where(["admin_id" => $admin->id])
                            ->orderBy($sort_by)->orderType($sort_type)
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }else{
                        $all_products = $all_products->where(["admin_id" => $admin->id])
                            ->orderBy("created")->orderType("DESC")
                            ->limit($start, BACKEND_PAGINATION)->all();
                    }
                }
            }
        }

        $panel_setting = new Setting();
        $panel_setting = $panel_setting->where(["admin_id"=> $admin->id])->one();

        $all_sub_categories = new Event_SubCategory();
        $all_sub_categories = $all_sub_categories->where(["admin_id" => $admin->id])->all();
        $sub_categories_assoc = [];
        foreach ($all_sub_categories as $item){
            $sub_categories_assoc[$item->id] = $item->title;
        }
    }else {
        Helper::redirect_to("login.php");
    }

    $delMsg = '';
    if((isset($_GET['delmsg'])) && (!empty($_GET['delmsg']))) {
        $delMsg = 'Admin User Permissions Deleted Successfully.';
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
              <li class="breadcrumb-item active">Admin User Permissions</li>
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
                        <h3 class="card-title">Admin User Permissions</h3>
                    </div>  
                    <div style="width:19%;float:right;">
                        <a href="#" data-toggle="modal" data-target="#usr-permission-form-modal" class="btn btn-primary btn-sm" onclick="addEditUserPermission('create','','','','','','')">
                            Add Admin User Permission
                        </a>
                    </div>
                </div>
              </div>
              <div class="modal fade" id="event-form-modal-msg">
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
              <div class="modal fade" id="usr-permission-form-modal">
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
                        <form id="adminUserPermissionRoleForm" name="adminUserPermissionForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/admin_user_permission.php">
                            <input type="hidden" id="userPermissionId" name="userPermissionId" value="" />
                            <input type="hidden" id="userPermissionAction" name="userPermissionAction" value="" />
                            <div id="eventSucResponseDiv" style="color:green;"></div>
                            <div id="eventErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Name</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="userPermissionName" name="userPermissionName" class="form-control" data-target="#userPermissionName" />
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
                                                        <input class="form-check-input" type="radio" value="1" id="userPermissionStatusActive" name="userPermissionStatusActive">
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-check-input" type="radio" value="2" id="userPermissionStatusInActive" name="userPermissionStatusInActive">
                                                        <label class="form-check-label">In-Active</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="userPermissionSubmit" name="userPermissionSubmit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="view-usr-permission-form-modal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="view-user-permission-title-text"></span></h4>
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
                                        <span id="viewUserPermissionId" name="viewUserPermissionId" data-target="#viewUserPermissionId"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Name</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserPermissionName" name="viewUserPermissionName" data-target="#viewUserPermissionName"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Status</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserPermissionStatus" name="viewUserPermissionStatus"></span>
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
                <table id="rolesList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        if(count($all_user_permission) > 0){
                            foreach ($all_user_permission as $item){
                    ?>
                              <tr>
                                <td>
                                    <?php echo $item->id; ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view-usr-permission-form-modal" onclick="viewUserPermission('view','<?php echo $item->id; ?>')"><?php echo $item->name; ?></a>
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
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view-usr-permission-form-modal" onclick="viewUserPermission('view','<?php echo $item->id; ?>')"><i class="ion-eye"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#usr-permission-form-modal" onclick="addEditUserPermission('edit','<?php echo $item->id; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-usr-permission-form-modal" onclick="deleteUserPermission('delete','<?php echo $item->id; ?>')"><i class="ion-trash-a"></i></a>
                                </td>
                              </tr>
                  <?php 
                        }
                    }    
                  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>ID</th>
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
        <script>
            jQuery.noConflict();
            (function( $ ) {
              $(function() {
                // More code using $ as alias to jQuery
                $("#rolesList").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    "order":  [[0, 'desc']],
                    "columnDefs": [{ "orderable": false, "targets": [6,7] }]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              });
            })(jQuery);
        </script>
        <?php require("common/php/php-footer.php"); ?>
        <!-- jQuery -->
        <script src="../admin/plugins/jquery/jquery.min.js"></script>
        <!-- jquery-validation -->
        <script src="../admin/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../admin/plugins/jquery-validation/additional-methods.min.js"></script>
        <script>
            $('#msg-div').hide();               
            function deleteUserPermission(userPermissionAction, userPermissionId) {
                window.location.href='private/controllers/admin_user_permission.php?userPermissionAction='+userPermissionAction+'&userPermissionId='+userPermissionId;
            }

            function addEditUserPermission(userPermissionAction, userPermissionId) {
                $("#userPermissionId").val('');
                $("#userPermissionName").val('');

                var formData = {};
                if(userPermissionAction == "create") {
                    $('#modal-title-text').text('Add Admin User Permission');
                    $("#userPermissionAction").val('add');
                    $("#userPermissionStatusActive").prop( "checked", true );
                } else if(userPermissionAction == "edit") {
                    $("#userPermissionAction").val('update');
                    $('#modal-title-text').text('Update Admin User Permission');
                    formData = {
                        "userPermissionId": userPermissionId,
                        "userPermissionAction": userPermissionAction
                    };
                } else if(userPermissionAction == "delete") {
                    formData = {
                        "userPermissionId": userPermissionId,
                        "userPermissionAction": userPermissionAction
                    };
                }           

                if(userPermissionAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/admin_user_permission.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(userPermissionAction == "edit") {
                                $("#userPermissionId").val(respArr.id);
                                $("#userPermissionAction").val('update');
                                $("#userPermissionName").val(respArr.name);

                                if(respArr.status == 1) {
                                    $("#userPermissionStatusActive").prop( "checked", true );
                                    $("#userPermissionStatusInActive").prop( "checked", false );
                                } else if(respArr.status == 2) {
                                    $("#userPermissionStatusActive").prop( "checked", false );
                                    $("#userPermissionStatusInActive").prop( "checked", true );
                                } else {
                                    $("#userPermissionStatusActive").prop( "checked", false );
                                    $("#userPermissionStatusInActive").prop( "checked", true );
                                }
                            }                    
                        }
                    });
                } 
            }

            function viewUserPermission(userPermissionAction, userPermissionId) {

                $('#view-user-permission-title-text').text('View User Permission');

                var formData = {};
                if(userPermissionAction == "view") {
                    formData = {
                        "userPermissionId": userPermissionId,
                        "userPermissionAction": userPermissionAction
                    };
                
                    $.ajax({
                        url: "../admin/private/controllers/admin_user_permission.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            $("#viewUserPermissionId").text(respArr.id);
                            $("#viewUserPermissionName").text(respArr.name);
                            
                            var userPermissionStatus = "";
                            if(respArr.status) {
                                if(respArr.status == "1") {
                                    userPermissionStatus = "Active";
                                } else if(respArr.status == "2") {
                                    userPermissionStatus = "In-Active";
                                }
                            } else {
                                 userPermissionStatus = "In-Active";
                            }

                            $("#viewUserPermissionStatus").html(userPermissionStatus);                            
                        }
                    });
                }
            }

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#adminUserPermissionRoleForm').validate({
                        rules: {
                            userPermissionName: {
                                required: true,
                                minlength: 5,
                                maxlength: 20
                            },
                            userPermissionStatus: {
                                required: true
                            }
                        },
                        messages: {
                            userPermissionName: {
                                required: "User Permission should not be empty.",
                                minlength: "User Permission should be minimum of 5 characters.",
                                maxlength: "User Permission should not be beyond 20 characters."
                            },
                            userPermissionStatus: {
                                required: "User Permission status should be selected."
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
                        $('#msg-modal-title-text').text('Create Admin User Permission');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').html('Admin User Permission Created successfully.');
                        $('#msg-div').show();
                        setTimeout(function() {
                            $('#event-form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>                
        <?php
                } else if($pgMsg == 2) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Admin User Permission');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').html('Admin User Permission updated successfully.');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#event-form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>      
        <?php
                } else if($pgMsg == 3) {
        ?>          
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Delete Admin User Permission');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').html('Admin User Permission delete successfully.');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#event-form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                } else if($pgMsg == 4) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Create Admin User Permission');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').html('Admin User Permission Already exist.');
                        $('#msg-div').show();
                        setTimeout(function() { 
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }  else if($pgMsg == 5) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Event');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').html('Admin User Permission Already exist.');
                        $('#msg-div').hide();
                        setTimeout(function() { 
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }
            }
        ?> 








      