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
    $url_current = "contacts.php?";

    if(!empty($admin)){

        $contacts = new Contact();
        $category = new Category();

        $sort_by = "id";
        $sort_type = "desc";

        $all_contacts = $contacts->orderBy($sort_by)->orderType($sort_type)->all();

        $all_category = $category->where(["admin_id" => $admin->id])
                            ->orderBy($sort_by)->orderType($sort_type)->all();    

        $eventCategory = array();
        if(!empty($all_category)) {
            foreach($all_category as $category_val) {
                $eventCategory[$category_val->id] = $category_val; 
            }
        }

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
        $delMsg = 'Contact Deleted Successfully.';
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
              <li class="breadcrumb-item active">Contacts</li>
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
                        <h3 class="card-title">Contacts</h3>
                    </div>  
                </div>
              </div>
              <div class="modal fade" id="contact-form-modal-msg">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="msg-modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="add-msg-div" style="color:green;">Contact Created Successfully.</div>
                        <div id="upd-msg-div" style="color:green;">Contact Updated Successfully.</div>
                        <div id="del-msg-div" style="color:green;">Contact Deleted Successfully.</div>
                        <div id="add-uniq-msg-div" style="color:red;">Contact Title Already Exist.</div>
                        <div id="upd-uniq-msg-div" style="color:red;">Contact Title Already Exist.</div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
               <div class="modal fade" id="del-contact-form-modal">
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
              <div class="modal fade" id="contact-modal">
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
                        <form id="contactForm" name="contactForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/contact.php">
                            <input type="hidden" id="contactId" name="contactId" value="<?php echo (!empty($contactId)?$contactId:''); ?>" />
                            <input type="hidden" id="contactAction" name="contactAction" value="<?php echo (!empty($pgAction)?$pgAction:''); ?>" />
                            <div id="eventSucResponseDiv" style="color:green;"></div>
                            <div id="eventErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>ID</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" disabled id="contactID" name="contactID" class="form-control" data-target="#contactID" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Name</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="contactName" name="contactName" class="form-control" data-target="#contactName" />
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>E-Mail</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="contactEmail" name="contactEmail" class="form-control" data-target="#contactEmail" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Phone</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group date" data-target-input="nearest">
                                            <input type="text" id="contactPhone" name="contactPhone" class="form-control" data-target="#contactPhone" />
                                        </div>
                                    </div>
                                </div>
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Subject</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="contactSubject" name="contactSubject" class="form-control" data-target="#contactSubject" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                </div>
                                <div class="eventFormRow">           
                                    <label>Message</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group date" data-target-input="nearest">
                                        <textarea type="text" id="contactMessage" name="contactMessage" rows="5" cols="50" class="form-control" data-target="#textarea"></textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="contactSubmit" name="contactSubmit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
               <div class="modal fade" id="view-contact-modal">
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
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewContactId" name="viewContactId" data-target="#viewContactId"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Name</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewContactName" name="viewContactName" data-target="#viewContactName"></span>
                                    </div>
                                </div>
                            </div> 
                            <div class="eventFormRow">                                
                                <div class="eventFormCol">
                                    <label>E-Mail</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewContactEmail" name="viewContactEmail" data-target="#viewContactEmail"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Phone</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group date" data-target-input="nearest">
                                        <span id="viewContactPhone" name="viewContactPhone" data-target="#viewContactPhone"></span>
                                    </div>
                                </div>
                            </div> 
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Subject</label>
                                    <span class="required-field">*</span>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewContactSubject" name="viewContactSubject" data-target="#viewContactSubject"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <label>Message</label>
                                <span class="required-field">*</span>
                                <div class="form-group date" data-target-input="nearest">
                                    <span id="viewContactMessage" name="viewContactMessage" data-target="#viewContactMessage"></span>
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
                <table id="contactsList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($all_contacts) > 0) {
                            foreach ($all_contacts as $item) {
                    ?>
                              <tr>
                                <td>
                                    <?php echo $item->id; ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view-contact-modal" onclick="viewContact('view','<?php echo $item->id; ?>')"><?php echo $item->name; ?></a>
                                </td>
                                <td>
                                    <?php 
                                        $email = "";
                                        if((isset($item->email)) && (!empty($item->email))){
                                            $email = $item->email;
                                        }     
                                    ?>
                                    <?php echo $email; ?>
                                </td>
                                <td>
                                    <?php 
                                        $mobile = "";
                                        if((isset($item->mobile)) && (!empty($item->mobile))){
                                            $mobile = $item->mobile;
                                        }     
                                    ?>
                                    <?php echo $mobile; ?>
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
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view-contact-modal" onclick="viewContact('view','<?php echo $item->id; ?>')"><i class="fa fa-eye"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#contact-modal" onclick="addEditContact('edit','<?php echo $item->id; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-contact-form-modal" onclick="deleteContact('delete','<?php echo $item->id; ?>')"><i class="ion-trash-a"></i></a>
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
                        <th>E-Mail</th>
                        <th>Phone</th>
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
                $("#contactsList").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    "order":  [[0, 'desc']],
                    "columnDefs": [{ "orderable": true, "targets": [1,2,3,4] }]
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

            function deleteContact(contactAction, contactId) {
                window.location.href='private/controllers/contact.php?contactAction='+contactAction+'&contactId='+contactId;
            }
           
            function addEditContact(contactAction, contactId) {
                var formData = {};
                if(contactAction == "edit") {
                    $("#contactAction").val(contactAction);
                    $('#modal-title-text').text('Update Contact');
                    formData = {
                        "contactId": contactId,
                        "contactAction": contactAction
                    };
                } else if(contactAction == "delete") {
                    formData = {
                        "contactId": contactId,
                        "contactAction": contactAction
                    };
                }           

                if(contactAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/contact.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(contactAction == "edit") {
                                $("#contactId").val(respArr.id);
                                $("#contactID").val(respArr.id);                                
                                $("#contactAction").val('update');
                                $("#contactName").val(respArr.name);
                                $("#contactEmail").val(respArr.email);
                                $("#contactPhone").val(respArr.mobile);
                                $("#contactSubject").val(respArr.subject);
                                $("#contactMessage").val(respArr.message);
                            }                    
                        }
                    });
                } 
            }

            function viewContact(contactAction, contactId) {
                var formData = {};
                if(contactAction == "view") {
                    $('#view-modal-title-text').text('View Contact');
                    formData = {
                        "contactId": contactId,
                        "contactAction": contactAction
                    };
                } 

                if(contactAction == "view") {
                    $.ajax({
                        url: "./private/controllers/contact.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(contactAction == "view") {
                                $("#viewContactId").html(respArr.id);
                                $("#viewContactName").html(respArr.name);
                                $("#viewContactEmail").html(respArr.email);
                                $("#viewContactPhone").html(respArr.mobile);
                                $("#viewContactSubject").html(respArr.subject);
                                $("#viewContactMessage").html(respArr.message);
                            }                    
                        }
                    });
                } 
            }

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#contactForm').validate({
                        rules: {
                            contactName: {
                                required: true,
                                minlength: 5,
                                maxlength: 50
                            },
                            contactEmail: {
                                required: true,
                                minlength: 5,
                                maxlength: 50,
                                email: true
                            },
                            contactPhone: {
                                required: true,
                                minlength: 10,
                                maxlength: 15,
                                phoneIN: true
                            },
                            contactSubject: {
                                required: true,
                                minlength: 10,
                                maxlength: 100
                            },
                            contactMessage: {
                                required: true,
                                minlength: 25,
                                maxlength: 1000
                            }
                        },
                        messages: {
                            contactName: {
                                required: "Name should not be empty.",
                                minlength: "Name should be minimum of 5 characters.",
                                maxlength: "Name should not be beyond 50 characters."
                            },
                            contactEmail: {
                                required: "E-Mail should not be empty.",
                                minlength: "E-Mail should be minimum of 5 characters.",
                                maxlength: "E-Mail should not be beyond 50 characters.",
                                email: "E-Mail should be valid."
                            },
                            contactPhone: {
                                required: "Phone should not be empty.",
                                minlength: "Phone should be minimum of 10 characters.",
                                maxlength: "Phone should not be beyond 15 characters.",
                                phoneIN: "Phone should be valid."
                            },                            
                            contactSubject: {
                                required: "Subject should not be empty.",
                                minlength: "Subject should be minimum of 10 characters.",
                                maxlength: "Subject should not be beyond 100 characters."
                            },
                            contactMessage: {
                                required: "Message should not be empty.",
                                minlength: "Message should be minimum of 25 characters.",
                                maxlength: "Message should not be beyond 1000 characters."
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
                        $('#msg-modal-title-text').text('Create Contact');
                        $('#contact-form-modal-msg').modal('show');
                        $('#add-msg-div').show();
                        setTimeout(function() {
                            $('#contact-form-modal-msg').modal('hide');
                            $('#add-msg-div').hide();
                        }, 2000);
                    </script>                
        <?php
                } else if($pgMsg == 2) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Contact');
                        $('#contact-form-modal-msg').modal('show');
                        $('#upd-msg-div').show();
                        setTimeout(function() { 
                            $('#contact-form-modal-msg').modal('hide');
                            $('#upd-msg-div').hide();
                        }, 2000);
                    </script>      
        <?php
                } else if($pgMsg == 3) {
        ?>          
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Delete Contact');
                        $('#contact-form-modal-msg').modal('show');
                        $('#del-msg-div').show();
                        setTimeout(function() { 
                            $('#contact-form-modal-msg').modal('hide');
                            $('#del-msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                } else if($pgMsg == 4) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Create Contact');
                        $('#contact-form-modal-msg').modal('show');
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
                        $('#contact-form-modal-msg').modal('show');
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








      