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
        $users = new User();
        
        $column = "";
        $column .= " user.id AS userId, user.username AS userUserName, user.name AS userName, user.mobile AS userMobile, user.email AS userEmail, user.password AS userPassword, user.image AS userImage, user.type AS userType, user.is_coach AS userIsCoach, user.social_id AS userSocialId, oauth_provider AS userOauthProvider, user.oauth_uid AS userOauthUid, user.verification_token AS userVerificationToken, user.status AS userStatus, user.image_name AS userImageName, user.image_resolution AS userImageResolution, user.admin_id AS userAdminId, user.created AS userCreated, ";
        $column .= "admin.id AS adminId, admin.username AS adminUserName, admin.email AS adminEmail, admin.password AS adminPassword, admin.status AS adminStatus, ";
        $column .= "user_type.id AS userTypeId, user_type.name AS userTypeName, user_type.status AS userTypeStatus, user_type.admin_id AS userTypeAdminId, user_type.created AS userTypeCreated ";
        
        $joinColumn['join_table_name1'] = "user";
        $joinColumn['join_table_name2'] = "admin";
        $joinColumn['join_table_name3'] = "user_type";        
        $joinColumn['join_column_name1'] = "admin_id";
        $joinColumn['join_column_name3'] = "type";
        $joinColumn['join_column_city_state_country_id'] = "id";
        $joinColumn['join_column_child'] = "id";

        $all_users = (array) $users->allWithJoinThreeTables($column, $joinColumn);
   
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
        $delMsg = 'User Deleted Successfully.';
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
              <li class="breadcrumb-item active">Users</li>
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
                        <h3 class="card-title">Users</h3>
                    </div>  
                    <div style="width:9%;float:right;"> 
                        <a href="#" data-toggle="modal" data-target="#user-form-modal" class="btn btn-primary btn-sm" onclick="addEditUser('create','','')">Add User</a>
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
               <div class="modal fade" id="del-user-modal">
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
              <div class="modal fade" id="user-form-modal">
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

                            .error {
                                color: red;
                            }

                            .required-field{
                                color:red;
                            }
                        </style>
                        <form id="userForm" name="userForm" method="POST" enctype="multipart/form-data" action="../admin/private/controllers/users.php">
                            <input type="hidden" id="userId" name="userId" value="" />
                            <input type="hidden" id="userAction" name="userAction" value="" />   
                            <input type="hidden" id="userImageHidden" name="userImageHidden" value="" />
                            <div id="eventSucResponseDiv" style="color:green;"></div>
                            <div id="eventErrResponseDiv" style="color:green;"></div>
                            <div class="eventFormMainDiv" id="modal-div">
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>ID</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" disabled id="userID" name="userID" class="form-control" data-target="#userID" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>User Name</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" disabled id="userUserName" name="userUserName" class="form-control" data-target="#userUserName" />
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Name</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="text" id="userName" name="userName" class="form-control" data-target="#userName" />
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <div id="userTypeSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                        <div class="form-group">
                                            <label>User Type</label>
                                            <span class="required-field">*</span>
                                            <div id="userTypeDiv"></div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="eventFormRow">
                                    <div id="userTypeFieldsSpinnerDiv"><img src="./assets/images/spinner.png" class="spinner"></div>
                                    <div id="userTypeFieldsDiv"></div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Image</label>
                                        <div id="userImageSpinnerDiv">
                                            <img src="./assets/images/spinner.png" class="loader">
                                        </div>
                                        <div id="userImagePreview"></div>
                                        <div id="userImageError" style="color:red;"></div>
                                        <input name="userImage" id="userImage" type="file" class="form-control" />
                                    </div>                                    
                                </div>
                                <div class="eventFormRow">
                                    <div class="eventFormCol">
                                        <label>Status</label>
                                        <span class="required-field">*</span>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input class="form-check-input" type="radio" value="1" id="userStatusActive" name="userStatusActive" checked="">
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input class="form-check-input" type="radio" value="2" id="userStatusInActive" name="userStatusInActive">
                                                        <label class="form-check-label">In-Active</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="eventFormSpacerDiv">&nbsp;</div>
                                    <div class="eventFormCol">
                                        <label>Is Coach</label>
                                        <div class="form-group" data-target-input="nearest">
                                            <input type="checkbox" id="isCoach" name="isCoach" value="1" />
                                        </div>
                                    </div>                                  
                                </div>
                            </div>
                            <div class="modal-footer right-content-between">
                                <button type="submit" id="userSubmit" name="userSubmit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="view-user-modal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="view-user-modal-title-text"></span></h4>
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
                                        <span id="viewUserId" name="viewUserId" data-target="#viewUserId"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Name</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserName" name="viewUserName" data-target="#viewUserName"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>User Name</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserUserName" name="viewUserUserName" data-target="#viewUserUserName"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Mobile</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserMobile" name="viewUserMobile" data-target="#viewUserMobile"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>E-Mail</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserEmail" name="viewUserEmail" data-target="#viewUserEmail"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Type</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserType" name="viewUserType" data-target="#viewUserType"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Is Coach</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewIsCoach" name="viewIsCoach" data-target="#viewIsCoach"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Social Id</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewSocialId" name="viewSocialId" data-target="#viewSocialId"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Oauth Provider</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserOauthProvider" name="viewUserOauthProvider" data-target="#viewUserOauthProvider"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Oauth Uid</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserOauthUid" name="viewUserOauthUid" data-target="#viewUserOauthUid"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Image</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserImage" name="viewUserImage" data-target="#viewUserImage"></span>
                                    </div>
                                </div>
                                <div class="eventFormSpacerDiv">&nbsp;</div>
                                <div class="eventFormCol">
                                    <label>Verification Token</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserVerificationToken" name="viewUserVerificationToken" data-target="#viewUserVerificationToken"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="eventFormRow">
                                <div class="eventFormCol">
                                    <label>Status</label>
                                    <div class="form-group" data-target-input="nearest">
                                        <span id="viewUserStatus" name="viewUserStatus"></span>
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
                <table id="usersList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>E-Mail</th>
                        <th>Mobile</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="width40">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($all_users) > 0){
                            foreach ($all_users as $item){
                                $userId = "";
                                if((isset($item->userId)) && (!empty($item->userId))){
                                    $userId = $item->userId;
                                }

                                $userName = "";
                                if((isset($item->userName)) && (!empty($item->userName))){
                                    $userName = $item->userName;
                                }

                                $userUserName = "";
                                if((isset($item->userUserName)) && (!empty($item->userUserName))){
                                    $userUserName = $item->userUserName;
                                }

                                $userEmail = "";
                                if((isset($item->userEmail)) && (!empty($item->userEmail))){
                                    $userEmail = $item->userEmail;
                                }

                                $userMobile = "";
                                if((isset($item->userMobile)) && (!empty($item->userMobile))){
                                    $userMobile = $item->userMobile;
                                }

                                $userTypeName = "";
                                if((isset($item->userTypeName)) && (!empty($item->userTypeName))){
                                    $userTypeName = $item->userTypeName;
                                }
                    ?>
                              <tr>
                                <td>
                                    <?=$userId;?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view-user-modal" onclick="viewUser('view','<?=$userId;?>')"><?=$userName;?></a>
                                </td>
                                <td>
                                    <?=$userUserName;?>
                                </td>
                                <td>
                                    <?=$userEmail;?>
                                </td>
                                <td>
                                    <?=$userMobile;?>
                                </td>
                                <td>
                                    <?=$userTypeName;?>
                                </td>
                                <td>
                                    <?php 
                                        $status_class = "";
                                        $status = '<span class="badge badge-secondary">In-Active</span>';
                                        if($item->userStatus == 1){
                                            $status_class = "active";
                                            $status = '<span class="badge badge-success">Active</span>';
                                        }
                                    ?>
                                    <span class="table-status <?php echo $status_class; ?>"><?php echo $status; ?></span>
                                </td>
                                <td style="width:150px;">
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view-user-modal" onclick="viewUser('view','<?=$userId?>')"><i class="ion-eye"></i></a>
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#user-form-modal" onclick="addEditUser('edit','<?=$userId?>')"><i class="ion-compose"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del-user-modal" onclick="deleteUser('delete','<?=$userId?>')"><i class="ion-trash-a"></i></a>
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
                        <th>User Name</th>
                        <th>E-Mail</th>
                        <th>Mobile</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="width40">Action</th>
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
                $('#usersList').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    "pageLength": 25, // Sets the initial number of records per page to 25
                    "responsive": true, 
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    "searching": true,
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
            $('#msg-div').hide();

            function removeA(arr, eventFileName) {
                const myArray = arr.split(",");
                position = myArray.indexOf(eventFileName);
                delete myArray[position];
                return myArray;
            }

            function delUserImage(userFileName, respArray) {

                $('#userImagePreview').html('');

                respArr = removeA(respArray, userFileName);
                respArray1 = "'"+respArr+"'";

                var formdata = new FormData(); 
    
                formdata.append("userAction", "deleteUserCatImg");
                formdata.append("userFileName", userFileName);
    
                var respArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";

                $.ajax({
                    url: "./private/controllers/users.php", 
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
                                var delUserImage = 'onclick="delUserImage('+src+','+respArray1+')"';
                                $('#userImagePreview').append('<div><a href ="uploads/users/'+src1+'" target="_blank" class="deleteUserImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delUserImage+'><i class="ion-trash-a"><i></a></div>');
                                respFileNameArray[index] = src1;
                            }
                        }  

                        respFileName = respFileNameArray.toString();

                        $('#userImageHidden').val(respFileName);                
                    }
                });
            }

            $('#userFileDel').click(function(e) {
                console.log("delete file");
            });

            $('#userImage').change(function(e) {

                $('#userImagePreview').html('');
                $('#userFileSpinnerDiv').hide();
                $('#userImageError').html('');

                var fileData = $('#userImage').prop('files')[0];   
                var formdata = new FormData(); 

                // Read selected files
                var totalfiles = document.getElementById('userImage').files.length;
                var userName = $('#userName').val();
                for (var index = 0; index < totalfiles; index++) {
                    formdata.append("files[]", document.getElementById('userImage').files[index]);
                }   

                if (formdata) {
                    formdata.append("userAction", "upload");
                    formdata.append("userName", userName);
                }

                var respArray = new Array();
                var errorRespArray = new Array();
                var respFileNameArray = new Array();
                var respFileName = "";
                $.ajax({
                    url: "./private/controllers/users.php", 
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',                         
                    type: 'POST',
                    success: function(php_script_response) {
                        respArray = php_script_response['userImage'];
                        errorRespArray = php_script_response['userImageInvalid'];
                        respArray1 = "'"+php_script_response['userImage']+"'";
                        
                        if(respArray) {
                            var fileCount = respArray.length;

                            for (var index = 0; index < fileCount; index++) {
                                var src = "'"+respArray[index]+"'";
                                var src1 = respArray[index];
                                var delUserImage = 'onclick="delUserImage('+src+','+respArray1+')"';

                                $('#userImagePreview').append('<div><a href ="uploads/users/'+src1+'" target="_blank" class="deleteEventImage" id="'+src1+'">'+src1+'</a>&nbsp;<a href="#" '+delUserImage+'><i class="ion-trash-a"><i></a></div>');
                                respFileNameArray[index] = src1;
                            }   

                            respFileName = respFileNameArray.toString();

                            $('#userImageHidden').val(respFileName);
                        } else if(errorRespArray) {
                            $('#userImageError').append(errorRespArray);
                        }
                    }
                 });      
            });
      
            $('#userFileSpinnerDiv').hide();
            function deleteUser(userAction, userId) {
                window.location.href='private/controllers/users.php?userAction='+userAction+'&userId='+userId;
            }

            function addEditUser(userAction, userId) {
                $('#userTypeFieldsSpinnerDiv').hide();
                $('#userImageSpinnerDiv').hide();
                $("#eventImagePreview").html('');
                $("#eventSucResponseDiv").html('');

                if(userAction == "edit") {
                    userImage(userId);
                } else {
                    userTypeFunc('');
                }

                $("#userId").val('');
                $("#userName").val('');
                $("#userUserName").val('');
                $("#userMobile").val('');

                var formData = {};
                if(userAction == "create") {
                    $('#modal-title-text').text('Add User');
                    $("#userAction").val('add');
                } else if(userAction == "edit") {
                    $("#userAction").val('update');
                    $('#modal-title-text').text('Update User');
                    formData = {
                        "userId": userId,
                        "userAction": userAction
                    };
                } else if(userAction == "delete") {
                    formData = {
                        "userId": userId,
                        "userAction": userAction
                    };
                } 

                if(userAction == "edit") {
                    $.ajax({
                        url: "./private/controllers/users.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);

                            $("#userId").val(respArr.userId);
                            $("#userID").val(respArr.userId);                                
                            $("#userAction").val('update');
                            $("#userName").val(respArr.userName);
                            $("#userUserName").val(respArr.userUserName);
                            $("#userEmail").val(respArr.userEmail);
                            $("#userType").val(respArr.userType);
                            $("#userIsCoach").val(respArr.userIsCoach);

                            userTypeFunc(respArr.userType);
                            userTypeFieldsFunc(respArr.userType);

                            setTimeout(function() {
                                $("#userMobile").val(respArr.userMobile);
                            }, 100);

                            if(respArr.userIsCoach == 1) {
                                $('#isCoach').prop('checked',true); 
                            } else if(respArr.userIsCoach == 2) {
                                $("#isCoach").prop( "checked", false );
                            } else {
                                $("#isCoach").prop( "checked", false );
                            }

                            if(respArr.userStatus == 1) {
                                $("#userStatusActive").prop( "checked", true );
                                $("#userStatusInActive").prop( "checked", false );
                            } else if(respArr.userStatus == 2) {
                                $("#userStatusActive").prop( "checked", false );
                                $("#userStatusInActive").prop( "checked", true );
                            } else {
                                $("#userStatusActive").prop( "checked", false );
                                $("#userStatusInActive").prop( "checked", true );
                            }           
                        }
                    });
                } 
            }

            function viewUser(userAction, userId) {

                $('#view-user-modal-title-text').text('View User');

                var formData = {};
                if(userAction == "view") {
                    formData = {
                        "userId": userId,
                        "userAction": userAction
                    };
                
                    $.ajax({
                        url: "../admin/private/controllers/users.php",
                        cache: false,
                        type: "GET",
                        datatype:"JSON",
                        data: formData,
                        success: function(html) {
                            respArr = JSON.parse(html);
                            $("#viewUserId").text(respArr.userId);
                            $("#viewUserName").text(respArr.userName);
                            $("#viewUserUserName").html(respArr.userUserName);
                            $("#viewUserMobile").text(respArr.userMobile);
                            $("#viewUserEmail").text(respArr.userEmail);

                            var userType = "";
                            if(respArr.userType) {
                                if(respArr.userType == 1) {
                                    userType = "E-mail User";
                                } else if(respArr.userType == 2) {
                                    userType = "Facebook User";
                                } else if(respArr.userType == 3) {
                                    userType = "Google User";
                                } else if(respArr.userType == 4) {
                                    userType = "Number User";
                                } else if(respArr.userType == 5) {
                                    userType = "Apple User";
                                }
                            }

                            var userIsCoach = "No";
                            if(respArr.userIsCoach) {
                                if(respArr.userIsCoach == 1) {
                                    userIsCoach = "Yes";
                                } else if(respArr.userIsCoach == 2) {
                                    userIsCoach = "No";
                                }
                            }

                            $("#viewUserOauthProvider").text(respArr.userOauthProvider);
                            $("#viewUserOauthUid").text(respArr.userOauthUid);
                            $("#viewUserVerificationToken").text(respArr.userVerificationToken);
                            $("#viewIsCoach").text(userIsCoach);
                            $("#viewUserType").text(userType);
                            $("#viewUserStatus").text(respArr.userStatus);

                            var viewEventImage = "";
                            var hostname = location.hostname;
                            var viewUserImageLink = "";
                            if(hostname == "localhost"){
                                viewUserImageLink = "<a href='http://localhost/bookmysporto/admin/uploads/users/"+respArr.userImage+"' target='_blank'>"+respArr.userImage+"</a>";
                            } else {
                                viewUserImageLink = "<a href='https://bookmysporto.com/admin/uploads/users/"+respArr.userImage+"' target='_blank'>"+respArr.userImage+"</a>";
                            }

                            $("#viewUserImage").html(viewUserImageLink);

                            var userStatus = "";
                            if(respArr.userStatus) {
                                if(respArr.userStatus == 1) {
                                    userStatus = "Active";
                                } else if(respArr.venueStatus == 2) {
                                    userStatus = "In-Active";
                                }
                            }

                            $("#viewUserStatus").text(userStatus);                            
                        }
                    });
                }
            }            

            jQuery.noConflict();
            (function( $ ) {
                $(function () {
                    $('#userForm').validate({
                        rules: {
                            userName: {
                                required: true,
                                minlength: 10,
                                maxlength: 50
                            },
                            userType: {
                                required: true
                            },
                            userEmail: {
                                required: true,
                                minlength: 10,
                                maxlength: 25,
                                email: true
                            },
                            userPassword: {
                                required: true,
                                minlength: 10,
                                maxlength: 30
                            },
                            userMobile: {
                                required: true,
                                minlength: 10,
                                maxlength: 15,
                                number: true
                            },
                            userSocialId: {
                                required: true,
                                minlength: 10,
                                maxlength: 50
                            }
                        },
                        messages: {
                            userName: {
                                required: "Name should not be empty.",
                                minlength: "Name should be minimum of 10 characters.",
                                maxlength: "Name should not be beyond 50 characters."
                            },
                            userType: {
                                required: "Select User Type."
                            },
                            userEmail: {
                                required: "E-Mail should not be empty.",
                                minlength: "E-Mail should be minimum of 10 characters.",
                                maxlength: "E-Mail should not be beyond 25 characters.",
                                email: "Invalid E-Mail."
                            },
                            userPassword: {
                                required: "Password should not be empty.",
                                minlength: "E-Mail should be minimum of 10 characters.",
                                maxlength: "E-Mail should not be beyond 30 characters."
                            },
                            userMobile: {
                                required: "Mobile Number should not be empty.",
                                minlength: "Mobile Number should be minimum of 10 characters.",
                                maxlength: "Mobile Number should not be beyond 50 characters.",
                                email: "Invalid Mobile Number."
                            },
                            userSocialId: {
                                required: "Social ID cannot not be empty.",
                                minlength: "Social ID should be minimum of 10 characters.",
                                maxlength: "Social ID should not be beyond 50 characters."
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
                        $('#msg-modal-title-text').text('Create User');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').text('User Created Successfully.');
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
                        $('#msg-modal-title-text').text('Update User');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').text('User Updated Successfully.');
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
                        $('#msg-modal-title-text').text('Delete User');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').text('User Deleted Successfully.');
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
                        $('#msg-modal-title-text').text('Create User');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').text('User With Mobile Number Already Exist.');
                        $('#msg-div').show();
                        setTimeout(function() {
                            $('#event-form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }  else if($pgMsg == 5) {
        ?>
                    <script type="text/javascript">
                        $('#msg-modal-title-text').text('Update User');
                        $('#event-form-modal-msg').modal('show');
                        $('#msg-div').text('User With Mobile Number Already Exist.');
                        $('#msg-div').show();
                        setTimeout(function() {
                            $('#event-form-modal-msg').modal('hide');
                            $('#msg-div').hide();
                        }, 2000);
                    </script>  
        <?php            
                }
            }
        ?>