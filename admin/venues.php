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
        $url_current = "venues.php?";

        if(!empty($admin)) {
            $venues = new Venue();
            $sort_by = "id";
            $sort_type = "desc";        

            $column = "";
            $column .= "venue.id AS venueId, venue.title AS venueTitle, venue.description AS venueDescription, venue.address AS venueAddress, venue.state AS venueStateId, venue.city AS venueCity, venue.country AS venueCountry, venue.is_featured AS venueIsFeatured, venue.owner AS venueOwner, venue.image AS venueImage, venue.status AS venueStatus, ";
            $column .= "countries.id AS countryId, countries.shortname AS countryShortName, countries.name AS countryName, countries.phonecode AS countryPhoneCode, ";
            $column .= "state.id AS stateId, state.name AS stateName, state.country_id AS stateCountryId, ";
            $column .= "city.id AS cityId, city.name AS cityName, city.state_id AS cityCountryId ";

            $joinColumn['join_table_name1'] = "venue";
            $joinColumn['join_table_name2'] = "countries";
            $joinColumn['join_table_name3'] = "state";
            $joinColumn['join_table_name4'] = "city";

            $joinColumn['join_column_name1'] = "country";
            $joinColumn['join_column_name2'] = "state";
            $joinColumn['join_column_name3'] = "city";
            $joinColumn['join_column_city_state_country_id'] = "id";

            $all_venues = (array) $venues->where(["venue.admin_id" => 1])->allWithJoin($column, $joinColumn);

            $all_products = new Product();
            $pagination = "";
            $pagination_msg = "";

            if(Helper::is_get()){
                $page = Helper::get_val("page");
                $search = Helper::get_val("search");
                $sort_by = Helper::get_val("sort_by");
                $sort_type = Helper::get_val("sort_type");;
                $sub_category_id = Helper::get_val("sub_category_id");
                
                if($search) {
                    if($sub_category_id) {
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
    ?>
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
                  <li class="breadcrumb-item active">Venues</li>
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
                            <h3 class="card-title">Venues</h3>
                        </div>  
                        <div style="width:9%;float:right;">  
                            <a href="#" data-toggle="modal" data-target="#venue-form-modal" class="btn btn-primary btn-sm" onclick="addEditVenue('add','','101','4183','35','20','37','171','174')">Add Venue</a>
                        </div>
                    </div>
                  </div>
                   <div class="modal fade" id="venue-form-modal-msg">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><span id="msg-modal-title-text"></span></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div id="add-msg-div" style="color:green;">Venue Created Successfully.</div>
                            <div id="upd-msg-div" style="color:green;">Venue Updated Successfully.</div>
                            <div id="del-msg-div" style="color:green;">Venue Deleted Successfully.</div>
                            <div id="add-uniq-msg-div" style="color:red;">Venue Title Already Exist.</div>
                            <div id="upd-uniq-msg-div" style="color:red;">Venue Title Already Exist.</div>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  <div class="modal fade" id="venue-form-modal">
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
                            <form id="venueForm" name="venueForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/venue.php">
                                <input type="hidden" id="venueId" name="venueId" value="" />
                                <input type="hidden" id="venueAction" name="venueAction" value="" />
                                <input type="hidden" id="venueCountry" name="venueCountry" value="" />
                                <input type="hidden" id="lat" name="lat">
                                <input type="hidden" id="lon" name="lon">
                                <div id="venueSucResponseDiv" style="color:green;"></div>
                                <div id="venueErrResponseDiv" style="color:green;"></div>
                                <div class="venueFormMainDiv" id="modal-div">    
                                    <div class="venueFormRow">
                                        <div class="eventFormCol">
                                            <label>Title</label>
                                            <span class="required-field">*</span>
                                            <div class="form-group" data-target-input="nearest">
                                                <input type="text" id="venueTitle" name="venueTitle" class="form-control" data-target="#venueTitle" />
                                            </div>
                                        </div>
                                        <div class="eventFormSpacerDiv">&nbsp;</div>
                                        <div class="eventFormCol">
                                            <label>Address</label>
                                            <span class="required-field">*</span>
                                            <div class="form-group" data-target-input="nearest">
                                                <input type="text" id="venueAddress" name="venueAddress" class="form-control" data-target="#venueAddress" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="venueFormRow">
                                        <div class="eventFormCol">
                                            <label>Owner</label>
                                            <span class="required-field">*</span>
                                            <div class="form-group" data-target-input="nearest">
                                                <input type="text" id="venueOwner" name="venueOwner" class="form-control" data-target="#venueOwner" />
                                            </div>
                                        </div>
                                        <div class="eventFormSpacerDiv">&nbsp;</div>
                                        <div class="eventFormCol">
                                            <div id="venueFileSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                            <div id="venueImagePreview"></div>
                                            <div class="form-group" id="eventFileLabelDiv">
                                                <label>Image</label>
                                            </div>
                                            <div class="form-group" id="eventFileDiv">
                                                <input name="venueFile" id="venueFile" type="file" multiple />
                                                <input type="hidden" name="venueFileHidden" id="venueFileHidden" />
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
                                    <div class="venueFormRow">
                                        <label>Description</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <textarea id="venueDescription" name="venueDescription" class="form-control" data-target="#venueDescription"></textarea>
                                        </div>
                                    </div>
                                    <div class="venueFormRow">
                                        <div class="eventFormCol">
                                            <label>Status</label>
                                            <div class="form-group" data-target-input="nearest">
                                                <div class="form-check">
                                                    <input type="radio" id="venueStatus" name="venueStatus" class="form-check-input" value="1">
                                                    <label class="form-check-label">Active</label>
                                                    <span style="padding-left: 20px;">&nbsp;</span>
                                                    <input type="radio" id="venueStatus" name="venueStatus" class="form-check-input" value="2">
                                                    <label class="form-check-label">In-Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="modal-footer right-content-between">
                                  <button type="submit" id="venueSubmit" name="venueSubmit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>                    
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="modal fade" id="venue-view-modal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><span id="venue-view-modal-title-text"></span></h4>
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
                            </style>
                            <div class="venueFormMainDiv" id="modal-div">    
                                <div class="venueFormRow">
                                    <div class="eventFormCol">
                                        <label>ID</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueId" name="viewVenueId"></span>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Title</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueTitle" name="viewVenueTitle"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="venueFormRow">
                                    <div class="eventFormCol">
                                        <label>Address</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueAddress" name="viewVenueAddress"></span>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Owner</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueOwner" name="viewVenueOwner"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="venueFormRow">
                                    <div class="eventFormCol">
                                        <label>Image</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueImage" name="viewVenueImage" data-target="#viewVenueImage"></span>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>State</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueState" name="viewVenueState" data-target="#viewVenueState"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="venueFormRow">
                                    <div class="eventFormCol">
                                        <label>City</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueCity" name="viewVenueCity"></span>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Status</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <span id="viewVenueStatus" name="viewVenueStatus"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="venueFormRow">
                                    <label>Description</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewVenueDescription" name="viewVenueDescription"></span>
                                    </div>
                                </div>
                            </div>    
                        </div>                    
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="venuesList" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Status</th>
                            <th class="width20">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            if(count($all_venues) > 0){
                                foreach ($all_venues as $item) { 
                        ?>
                                  <tr>
                                    <td>
                                        <?php echo $item->venueId; ?>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#venue-view-modal" onclick="viewVenue('view','<?php echo $item->venueId; ?>')"><?php echo $item->venueTitle; ?></a>
                                    </td>
                                    <td>
                                        <?php 
                                            $address = "";
                                            if((isset($item->venueAddress)) && (!empty($item->venueAddress))){
                                                $address = $item->venueAddress;
                                            }     
                                        ?>
                                        <?php echo $address; ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $cityName = "";
                                            if((isset($item->cityName)) && (!empty($item->cityName))){
                                                $cityName = $item->cityName;
                                            }     
                                        ?>
                                        <?php echo $cityName; ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $stateName = "";
                                            if((isset($item->stateName)) && (!empty($item->stateName))){
                                                $stateName = $item->stateName;
                                            }     
                                        ?>
                                        <?php echo $stateName; ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $status_class = "";
                                            $status = '<span class="badge badge-secondary">In-Active</span>';
                                            if($item->venueStatus == 1) {
                                                $status_class = "active";
                                                $status = '<span class="badge badge-success">Active</span>';
                                            }     
                                        ?>
                                        <span class="table-status <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                    </td>
                                    <td style="width:100px;">
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#venue-view-modal" onclick="viewVenue('view','<?php echo $item->venueId; ?>')"><i class="ion-eye"></i></a>
                                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#venue-form-modal" onclick="addEditVenue('edit','<?php echo $item->venueId; ?>','<?php echo $item->venueCountry; ?>','<?php echo $item->venueCity; ?>','<?php echo $item->venueStateId; ?>')"><i class="ion-compose"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#venue-form-modal-msg" onclick="deleteVenue('delete','<?php echo $item->venueId; ?>')"><i class="ion-trash-a"></i></a>
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
                            <th>Address</th>
                            <th>State</th>
                            <th>City</th>
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
                $("#venuesList").DataTable({
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
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmssLDIr2k4I89ZsR3CjZDe0rQouWxFIs"></script>
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

            function delVenueImage(eventFileName, respArray) {

                $('#venueImagePreview').html('');

                respArr = removeA(respArray, eventFileName);
                respArray1 = "'"+respArr+"'";

                var formdata = new FormData(); 
    
                formdata.append("eventAction", "deleteEventImg");
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
                                var delVenueImage = 'onclick="delVenueImage('+src+','+respArray1+')"';
                                 $('#venueImagePreview').append('<div><a href ="uploads/venues/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a></div>');
                                respFileNameArray[index] = src1;
                            }
                        }  

                        respFileName = respFileNameArray.toString();

                        console.log("respFileNameArray",respFileNameArray);
                        console.log("respFileName",respFileName);

                        $('#eventFileHidden').val(respFileName);                
                    }
                });
            }

            $('#venueFile').change(function(e) {

                $('#venueImagePreview').html('');

                var fileData = $('#venueFile').prop('files')[0];   
                var formdata = new FormData(); 

                // Read selected files
                var totalfiles = document.getElementById('venueFile').files.length;
                var venueTitle = $('#venueTitle').val();
                for (var index = 0; index < totalfiles; index++) {
                    formdata.append("files[]", document.getElementById('venueFile').files[index]);
                }   

                if (formdata) {
                    formdata.append("venueAction", "upload");
                    formdata.append("venueTitle", venueTitle);
                }

                var respArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";
                $.ajax({
                    url: "./private/controllers/venue.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {
                        respArray = php_script_response['venueImage'];
                        respArray1 = "'"+php_script_response['venueImage']+"'";

                        var fileCount = respArray.length;
                        for (var index = 0; index < fileCount; index++) {
                            var src = "'"+respArray[index]+"'";
                            var src1 = respArray[index];
                            var delVenueImage = 'onclick="delVenueImage('+src+','+respArray1+')"';
                            $('#venueImagePreview').append('<div><a href ="uploads/venues/'+src1+'" target="_blank" class="deleteVenueImage" id="'+src1+'">'+src1+'</a>&nbsp;</div>');
                            respFileNameArray[index] = src1;
                        }   

                        respFileName = respFileNameArray.toString();

                        $('#venueFileHidden').val(respFileName);
                    }
                 });      
            });

            $('#stateSpinnerDiv').show();
            $('#citySpinnerDiv').hide();
            $('#typeSpinnerDiv').hide(); 
            $('#categorySpinnerDiv').hide();
            $('#categoryTypeSpinnerDiv').hide();            
            $('#subCategorySpinnerDiv').hide();
            $('#venueFileSpinnerDiv').hide();

            function deleteVenue(venueAction, venuId) {
                window.location.href='private/controllers/venue.php?venueAction='+venueAction+'&venueId='+venuId;
            }

            function viewVenue(venueAction, venueId) {

                $('#venue-view-modal-title-text').text('View Venue');

                var formData = {};
                if(venueAction == "view") {
                    formData = {
                        "venueId": venueId,
                        "venueAction": venueAction
                    };
                
                    $.ajax({
                        url: "../admin/private/controllers/venue.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            $("#viewVenueId").text(respArr.venueId);
                            $("#viewVenueTitle").text(respArr.venueTitle);
                            $("#viewVenueDescription").text(respArr.venueDescription);
                            $("#viewVenueAddress").text(respArr.venuAddress);
                            $("#viewVenueOwner").text(respArr.venuOwner);
                            $("#viewVenueState").text(respArr.stateName);
                            $("#viewVenueCity").text(respArr.cityName);

                            var viewVenueImage = "";
                            var hostname = location.hostname;
                            var viewVenueImageLink = "";
                            if(hostname == "localhost"){
                                viewVenueImageLink = "<a href='http://localhost/bookmysporto/admin/uploads/venues/"+respArr.venuImage+"' target='_blank'>"+respArr.venuImage+"</a>";
                            } else {
                                viewVenueImageLink = "<a href='https://bookmysporto.com/admin/uploads/venues/"+respArr.venuImage+"' target='_blank'>"+respArr.venuImage+"</a>";
                            }

                            console.log("viewVenueImageLink",viewVenueImageLink);

                            $("#viewVenueImage").html(viewVenueImageLink);

                            var venueStatus = "";
                            if(respArr.venueStatus) {
                                if(respArr.venueStatus == 1) {
                                    venueStatus = "Active";
                                } else if(respArr.venueStatus == 2) {
                                    venueStatus = "In-Active";
                                }
                            }

                            $("#viewVenueStatus").text(venueStatus);                            
                        }
                    });
                }
            }

            function addEditVenue(venueAction, venueId, countryId, cityId, stateId) {

                $('#venueImagePreview').html('');
                
                $("#venueSucResponseDiv").html('');
                $("#venueErrResponseDiv").html('');                
                $("#stateDiv").html('');
                $("#cityDiv").html('');
                $("#venueAction").val('');
                $("#venueId").val('');
                $("#venueAction").val('');
                $("#venueTitle").val('');
                $("#venueDescription").val('');
                $("#venueAddress").val('');
                $("#venueOwner").val('');
                $("#venueImage").val('');
                $("#venueCountry").val('');

                var venueModalTitle = "";
                if(venueId == "") {
                    venueModalTitle = "Add Venue";
                } else {
                    venueModalTitle = "Edit Venue";
                }

                $('#modal-title-text').text(venueModalTitle);
                $("#venueAction").val('create');
                $("#venueCountry").val(countryId);

                eventState(countryId, cityId, stateId);

                if(venueAction == "edit") {
                    venueImage(venueId);
                }
     
                var formData = {};
                if(venueAction == "delete") {
                    formData = {
                        "venueId": venueId,
                        "venueAction": venueAction
                    };
                } else if(venueAction == "edit") {
                    $("#venueAction").val(venueAction);
                    $("#venueCountry").val(countryId);

                    formData = {
                        "venueId": venueId,
                        "venueAction": venueAction
                    };

                    $.ajax({
                        url: "./private/controllers/venue.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            if(venueAction == "edit") {
                                $("#venueId").val(respArr.id);
                                $("#venueAction").val('update');
                                $("#venueTitle").val(respArr.title);
                                $("#venueDescription").val(respArr.description);
                                $("#venueAddress").val(respArr.address);
                                $("#venueOwner").val(respArr.owner);
                                $("#venueImage").val(respArr.image);
                                eventState(countryId, cityId, stateId);
                                $("#venueCountry").val(respArr.country);

                                var $radios = $('input:radio[name=venueStatus]');
                                if(respArr.status == 1) {
                                    $radios.filter('[value=1]').attr('checked', 'checked');  
                                }else if(respArr.status == 2) {
                                    $radios.filter('[value=2]').attr('checked', 'checked');
                                }
                            }          
                        }
                    });
                }
            }

            $("#venueAddress").change(function() {
                var venueAddress = $("#venueAddress").val();
                var venueState = $("#state").val();
                var venueCity = $("#city").val();
                var venueCountry = $("#venueCountry").val();
                var venueFullAddress = venueAddress+""+venueState+""+venueCity+""+venueCountry;

                if((venueAddress != "") && (venueState != "") && (venueCity != "") && (venueCountry != "")){
                    var geocoder =  new google.maps.Geocoder();
                    geocoder.geocode( { 'address': venueAddress}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            $('#lat').val(results[0].geometry.location.lat()); 
                            $('#lon').val(results[0].geometry.location.lng());
                        } else {
                            console.log("Something got wrong " + status);
                            console.log("Something got wrong " + status);
                        }
                    });
                }
            });

            jQuery.noConflict();
            (function( $ ) {
                $(function() {
                    $("#venueForm").validate({
                        rules: {
                            venueTitle: {
                                required: true,
                                letterswithspace: true
                            },
                            venueDescription: {
                                required: true,
                                letterswithspace: true
                            },
                            venueAddress: {
                                required: true,
                                minlength: 10,
                                maxlength: 150,
                            },
                            venueOwner: {
                                required: true,
                                minlength: 10,
                                maxlength: 50,
                            },
                            state: {
                                required: true
                            },
                            city: {
                                required: true
                            }
                        },
                        messages: {
                            venueTitle: {
                                required: "Please enter Title.",
                                letterswithspace: "Please enter a title with letters and spaces only."
                            },
                            venueDescription: {
                                required: "Please enter Description.",
                                letterswithspace: "Please enter a description with letters and spaces only."
                            },
                            venueAddress: {
                                required: "Please enter Address.",
                                minlength: "Please enter minimum 10 characters.",
                                maxlength: "Please enter maximum 150 characters."
                            },
                            venueOwner: {
                                required: "Please enter Address.",
                                minlength: "Please enter minimum 10 characters.",
                                maxlength: "Please enter maximum 50 characters."
                            },
                            state: {
                                required: "Please atleast one state."
                            },
                            city: {
                                required: "Please atleast one city."
                            }
                        },
                        errorElement: "span",
                        errorClass: "has-error",
                        highlight: function(element, errorClass, validClass) {
                            $(element).closest(".form-group").addClass("has-error");
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).closest(".form-group").removeClass("has-error");
                        },
                        submitHandler: function(form) {}
                    });
                });
            })(jQuery);
            $('#msg-modal-title-text').text('');
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
                        $('#msg-modal-title-text').text('Create Venue');
                        $('#venue-form-modal-msg').modal('show');
                        $('#add-msg-div').show();
                        setTimeout(function() { 
                            $('#venue-form-modal-msg').modal('hide');
                            $('#add-msg-div').hide();
                        }, 2000);
                    </script>                
        <?php
                } else if($pgMsg == 2) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update Venue');
                        $('#venue-form-modal-msg').modal('show');
                        $('#upd-msg-div').show();
                        setTimeout(function() { 
                            $('#venue-form-modal-msg').modal('hide');
                            $('#upd-msg-div').hide();
                        }, 2000);
                    </script>      
        <?php
                } else if($pgMsg == 3) {
        ?>          
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Delete Venue');
                        $('#venue-form-modal-msg').modal('show');
                        $('#del-msg-div').show();
                        setTimeout(function() { 
                            $('#venue-form-modal-msg').modal('hide');
                            $('#del-msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                } else if($pgMsg == 4) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Create Venue');
                        $('#venue-form-modal-msg').modal('show');
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
                        $('#msg-modal-title-text').text('Update Venue');
                        $('#venue-form-modal-msg').modal('show');
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
