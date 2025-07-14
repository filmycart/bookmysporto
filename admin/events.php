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
    $url_current = "events.php?";

    if(!empty($admin)) {
        $events = new Event();
        $category = new Category();

        $sort_by = "id";
        $sort_type = "desc";
        $all_events = $events->where(["admin_id" => $admin->id])
                            ->orderBy($sort_by)->orderType($sort_type)->all();

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

        $all_sub_categories = new Sub_Category();
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
        $delMsg = 'Event Deleted Successfully.';
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
              <li class="breadcrumb-item active">Events</li>
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
                        <h3 class="card-title">Events</h3>
                    </div>  
                    <div style="width:9%;float:right;">  
                        <a href="#" data-toggle="modal" data-target="#event-form-modal" class="btn btn-primary btn-sm" onclick="addEditEvent('create','','101','4183','35','20','37','171','174')">Add Event</a>
                    </div>
                </div>
              </div>
              <div class="modal fade" id="event-form-modal-msg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="msg-modal-title-text"></span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="add-msg-div" style="color:green;">Event Created Successfully.</div>
                        <div id="upd-msg-div" style="color:green;">Event Updated Successfully.</div>
                        <div id="del-msg-div" style="color:green;">Event Deleted Successfully.</div>
                        <div id="add-uniq-msg-div" style="color:red;">Event Title Already Exist.</div>
                        <div id="upd-uniq-msg-div" style="color:red;">Event Title Already Exist.</div>
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
                        <form id="eventForm" name="eventForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/event.php">
                            <input type="hidden" id="eventId" name="eventId" value="<?php echo (!empty($eventId)?$eventId:''); ?>" />
                            <input type="hidden" id="eventAction" name="eventAction" value="<?php echo (!empty($pgAction)?$pgAction:''); ?>" />
                            <input type="hidden" id="eventCategoryHidden" name="eventCategoryHidden" value="" />
                            <input type="hidden" id="eventCountry" name="eventCountry" value="101" />
                            <div id="eventSucResponseDiv" style="color:green;"></div>
                            <div id="eventErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Title</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="eventTitle" name="eventTitle" class="form-control" data-target="#eventTitle" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Venue</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="eventVenue" name="eventVenue" class="form-control" data-target="#eventVenue" />
                                        </div>
                                    </div>
                                </div> 
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Start Date</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group date" data-target-input="nearest">
                                            <input type="text" id="eventStartDate" name="eventStartDate" class="form-control datetimepicker-input" data-target="#eventStartDate" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>End Date</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group date" data-target-input="nearest">
                                            <input type="text" id="eventEndDate" name="eventEndDate" class="form-control datetimepicker-input" data-target="#eventEndDate" />
                                        </div>
                                    </div>
                                </div> 
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="typeSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <span class="required-field">*</span>
                                            <div id="eventTypeDiv"></div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="categorySpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <span class="required-field">*</span>
                                            <div id="eventCategoryDiv"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="stateSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>State</label>
                                            <span class="required-field">*</span>
                                            <div id="stateDiv"></div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="citySpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <span class="required-field">*</span>
                                            <div id="cityDiv"></div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <div id="categoryTypeSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>Sub-Category</label>
                                            <span class="required-field">*</span>
                                            <div id="eventSubCategoryDiv"></div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
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
                                </div>  
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="eventSubmit" name="eventSubmit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th class="width20">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($all_events) > 0){
                            foreach ($all_events as $item){
                    ?>
                              <tr>
                                <!-- <td>
                                    <img class="p-15" src="<?php echo UPLOADED_FOLDER . DIRECTORY_SEPARATOR . UPLOADED_THUMB_FOLDER . DIRECTORY_SEPARATOR . $item->image_name; ?>" alt="image" />
                                </td> -->
                                <td>
                                    <?php echo $item->id; ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEvent('edit','<?php echo $item->id; ?>','<?php echo $item->country_id; ?>','<?php echo $item->city_id; ?>','<?php echo $item->state_id; ?>','<?php echo $item->category_id; ?>','<?php echo $item->sub_category_id; ?>','<?php echo $item->type_id; ?>','<?php echo $item->category_type_id; ?>')"><?php echo $item->title; ?></a>
                                </td>
                                <?php 
                                    $current_category = $eventDispCat = "";
                                    $eventCategoryIdArray = explode(",",$item->category_id);
                                    if(!empty($eventCategoryIdArray)) {
                                        foreach($eventCategoryIdArray as $eventCategoryIdVal) {
                                            if((isset($eventCategory[$eventCategoryIdVal]->title)) && (!empty($eventCategory[$eventCategoryIdVal]->title))) {
                                                $eventDispCat = $eventCategory[$eventCategoryIdVal]->title; 
                                                $cat_param = $url_current . "category_id=" . $eventCategoryIdVal;
                                                $current_category .= "<div style='border:0px solid red;float:left;width:100%;'><div style='border:0px solid red;float:left;width:50%;'><a href='" . $cat_param . "'>" . $eventDispCat . "</a></div></div>";
                                            }
                                        }
                                    } else {
                                        $current_category = "Unknown";
                                    }
                                ?>
                                <td>
                                    <?php echo $current_category; ?>
                                </td>
                                <td>
                                    <?php 
                                        $address = "";
                                        if((isset($item->address)) && (!empty($item->address))){
                                            $address = $item->address;
                                        }     
                                    ?>
                                    <?php echo $address; ?>
                                </td>
                                <td>
                                    <?php 
                                        $startDate = "";
                                        if((isset($item->start_date)) && (!empty($item->start_date))){
                                            $startDate = date("d/m/Y h:i:s A",strtotime($item->start_date));
                                        }     
                                    ?>
                                    <?php echo $startDate; ?>
                                </td>
                                <td>
                                    <?php 
                                        $endDate = "";
                                        if((isset($item->end_date)) && (!empty($item->end_date))){
                                            $endDate = date("d/m/Y h:i:s A",strtotime($item->end_date));
                                        }     
                                    ?>
                                    <?php echo $endDate; ?>
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
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#event-booking-form-modal" onclick="addEventBooking('booking','<?php echo $item->id; ?>','<?php echo $item->country_id; ?>','<?php echo $item->city_id; ?>','<?php echo $item->state_id; ?>','<?php echo $item->category_id; ?>','<?php echo $item->sub_category_id; ?>','<?php echo $item->type_id; ?>','<?php echo $item->category_type_id; ?>')"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#event-form-modal" onclick="addEditEvent('edit','<?php echo $item->id; ?>','<?php echo $item->country_id; ?>','<?php echo $item->city_id; ?>','<?php echo $item->state_id; ?>','<?php echo $item->category_id; ?>','<?php echo $item->sub_category_id; ?>','<?php echo $item->type_id; ?>','<?php echo $item->category_type_id; ?>')"><i class="ion-compose"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-event-form-modal" onclick="deleteEvent('delete','<?php echo $item->id; ?>','<?php echo $item->admin_id; ?>')"><i class="ion-trash-a"></i></a>
                                    <!-- <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#venue-form-modal-msg" onclick="deleteEvent('delete','<?php echo $item->venueId; ?>')"><i class="ion-trash-a"></i></a> -->
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
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

            $('#stateSpinnerDiv').show();
            $('#citySpinnerDiv').hide();
            $('#typeSpinnerDiv').hide(); 
            $('#categorySpinnerDiv').hide();
            $('#categoryTypeSpinnerDiv').hide();            
            $('#subCategorySpinnerDiv').hide();
            $('#evenFileSpinnerDiv').hide();

            function deleteEvent(eventAction, eventId) {
                window.location.href='private/controllers/event.php?eventAction='+eventAction+'&eventId='+eventId;
            }
           
            function addEventBooking(eventAction, eventId, countryId, cityId, stateId, categoryId, subCategoryId, eventTypeId, categoryTypeId) {
                $(".eventImagePreview").html('');
                $(".eventSucResponseDiv").html('');
                $(".eventErrResponseDiv").html('');                
                $(".stateDiv").html('');
                $(".cityDiv").html('');
                $(".eventTypeDiv").html('');
                $(".eventCategoryDiv").html('');
                $(".eventCategoryTypeDiv").html('');
                $(".eventSubCategoryDiv").html('');

                eventState(countryId, cityId, stateId);
                eventCategory(categoryId, eventTypeId);
                eventType(eventTypeId);
                eventSubCategory(categoryId, subCategoryId);
                eventCategoryType(categoryId, eventTypeId, categoryTypeId);
                
                eventImage(eventId);             

                var formData = {};
               
                $(".eventAction").val(eventAction);
                formData = {
                    "eventId": eventId,
                    "eventAction": eventAction
                };               

                $.ajax({
                    url: "./private/controllers/event.php",
                    cache: false,
                    type: "GET",
                    datatype:"JSON",
                    data: formData,
                    success: function(html) {           
                        respArr = JSON.parse(html);
                        
                        $(".eventId").val(respArr.id);
                        $(".eventAction").val('booking');
                        $(".eventTitle").val(respArr.title);                        
                        $(".eventCountry").val(respArr.country_id);                       
                    }
                });
            }

            function addEditEvent(eventAction, eventId, countryId, cityId, stateId, categoryId, subCategoryId, eventTypeId, categoryTypeId) {
                $("#eventImagePreview").html('');
                $("#eventSucResponseDiv").html('');
                $("#eventErrResponseDiv").html('');                
                $("#stateDiv").html('');
                $("#cityDiv").html('');
                $("#eventTypeDiv").html('');
                $("#eventCategoryDiv").html('');
                $("#eventCategoryTypeDiv").html('');
                $("#eventSubCategoryDiv").html('');

                eventState(countryId, cityId, stateId);
                eventCategory(categoryId, eventTypeId);
                eventType(eventTypeId);
                eventSubCategory(categoryId, subCategoryId);
                eventCategoryType(categoryId, eventTypeId, categoryTypeId);

                if(eventAction == "edit") {
                    eventImage(eventId);
                }

                var formData = {};
                if(eventAction == "create") {
                    $("#eventAction").val(eventAction);
                    $('#modal-title-text').text('Add Event');
                    $("#eventId").val('');
                    $("#eventAction").val('add');
                    $("#eventTitle").val('');
                    $("#eventStartDate").val('');
                    $("#eventEndDate").val('');
                    $("#eventVenue").val('');
                } else if(eventAction == "edit") {
                    $("#eventAction").val(eventAction);
                    $('#modal-title-text').text('Update Event');
                    formData = {
                        "eventId": eventId,
                        "eventAction": eventAction
                    };
                } else if(eventAction == "delete") {
                    formData = {
                        "eventId": eventId,
                        "eventAction": eventAction
                    };
                }           

                if(eventAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/event.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(eventAction == "edit") {
                                $("#eventId").val(respArr.id);
                                $("#eventAction").val('update');
                                $("#eventTitle").val(respArr.title);
                                $("#eventStartDate").val(respArr.start_date);
                                $("#eventEndDate").val(respArr.end_date);
                                $("#eventVenue").val(respArr.address);
                                $("#eventCountry").val(respArr.country_id);
                            }                    
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
                                required: true,
                                minlength: 5,
                                maxlength: 200
                            },
                            eventStartDate: {
                                required: true
                            },
                            eventEndDate: {
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
                                required: "Event Venue should not be empty.",
                                minlength: "Event Venue should be minimum of 5 characters.",
                                maxlength: "Event Venue should not be beyond 200 characters."
                            },
                            eventStartDate: {
                                required: "Enter Start Date and Time."
                            },
                            eventEndDate: {
                                required: "Enter End Date and Time."
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








      