<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $viewEventCategory = new Category();
    $viewEventCategoryArray = array();

    $delEventTypeMsg = "";
    $pgEventCategoryId = "";
    $pgEventCategoryAction = "";
    if((isset($_GET["eventCategoryId"])) && (!empty($_GET["eventCategoryId"]))) {
        $pgEventCategoryId = $_GET['eventCategoryId'];
    } elseif((isset($_POST["eventCategoryId"])) && (!empty($_POST["eventCategoryId"]))) {
        $pgEventCategoryId = $_POST['eventCategoryId'];
    }

    if((isset($_GET["eventCategoryAction"])) && (!empty($_GET["eventCategoryAction"]))) {
        $pgEventCategoryAction = $_GET['eventCategoryAction'];
    } elseif((isset($_POST["eventCategoryAction"])) && (!empty($_POST["eventCategoryAction"]))) {
        $pgEventCategoryAction = $_POST['eventCategoryAction'];
    }

    $pgEventFileName = "";
    if((isset($_POST["eventFileName"])) && (!empty($_POST["eventFileName"]))) {
        $pgEventFileName = $_POST['eventFileName'];
    }    

    if((Helper::is_get()) && (!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "view")){
        $column = "";
        $column = "category.id AS categoryId, category.parent_id AS categoryParentId, category.type_id AS categoryTypeId, category.admin_id AS categoryAdminId, category.title AS categoryTitle, category.status AS categoryStatus, category.image_name AS categoryImageName, category.image_resolution AS categoryImageResolution, category.created AS categoryCreated, ";
        $column .= "event_type.id AS eventTypeId, event_type.name AS eventTypeName, event_type.admin_id AS eventTypeAdminId, event_type.status AS eventTypeStatus";
        $joinColumn['join_table_name1'] = "category";
        $joinColumn['join_table_name2'] = "event_type";

        $joinColumn['join_column_name1'] = "type_id";
        $joinColumn['join_column_name2'] = "id";
        $joinColumn['join_column_child'] = "id";

        $catId = $joinColumn['join_table_name1'].".".$joinColumn['join_column_child'] = "id";
        $adminId = $joinColumn['join_table_name1']."."."admin_id";  
        
        $viewEventCategoryArray = (array) $viewEventCategory->where([$catId => $pgEventCategoryId])->andWhere([$adminId => $admin->id])->orderBy('id')->orderType('desc')->allWithJoinTwoTablesSingleRecord($column, $joinColumn);

        if((isset($viewEventCategoryArray)) && (!empty($viewEventCategoryArray))){
            echo json_encode($viewEventCategoryArray);
            exit;
        }
    }elseif((Helper::is_get()) && (!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "edit")){
        $viewEventCategory->id = $pgEventCategoryId;
        $viewEventCategoryArray = (array) $viewEventCategory->where(["id" => $viewEventCategory->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewEventCategoryArray);
        exit;
    }elseif((Helper::is_get()) && (!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "delete")){
        $delEventCategory = new Category();        
        $delEventCategory->id = Helper::get_val('eventCategoryId');
        $delEventCategory->admin_id = $admin->id;

        if(!empty($delEventCategory->id)){
            $delEventCategoryDb = new Category();
            $delEventCategoryDb = $delEventCategoryDb->where(["id" => $delEventCategory->id])->one();

            if($delEventCategoryDb){
                if($delEventCategoryDb->where(["id" => $delEventCategoryDb->id])->delete()){
                    $delEventCategoryMsg = 1;
                }else $errors->add_error("Error Occurred While Deleting");
            } else {
                $errors->add_error("Invalid Event Category");
            }
        }else  $errors->add_error("Invalid Parameters.");

        Helper::redirect_to("../../event-category.php?msg=3");
        exit;
    }

    if((Helper::is_post()) && ($pgEventCategoryAction == "deleteEventImg")) {
        
        $errorArrayDel = array();

        //Upload Location
        $upload_location = "../../uploads/event_category/";

        if(file_exists($upload_location.$pgEventFileName)) {
            //Delete Uploaded File Delete
            unlink($upload_location.$pgEventFileName);
        } else {
            $errorArrayDel['noFile'] = "Error: File does not exist.";
        }    

        echo json_encode($errorArrayDel);
        die; 
    }

    if((Helper::is_post()) && ($pgEventCategoryAction == "upload")) {
        //Count total files
        $countfiles = count($_FILES['files']['name']);

        //Upload Location
        $upload_location = "../../uploads/event_category/";
        $newfile = "";

        //To store uploaded files path
        $filesArray = $errorArray = array();

        $eventCategoryTitle = "";
        if((isset($_POST['eventCategoryTitle'])) && (!empty($_POST['eventCategoryTitle']))) {
            $eventCategoryTitle = strtolower($_POST['eventCategoryTitle']);
        }

        //Loop all files
        for($index = 0;$index < $countfiles;$index++) {
             if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
                   //FileName
                   $filename = $_FILES['files']['name'][$index];

                   //GetExtension
                   $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                   //Valid Image Extension
                   $valid_ext = array("png","jpeg","jpg");
                   $newfile = rand().".".$ext; 
                   //Check Extension
                   if(!in_array($ext, $valid_ext)) {
                        $errorArray['eventImageInvalid'] = "Error: Invalid file format upload only files with format png, jpeg ,jpg.";
                        echo json_encode($errorArray);
                        die;
                   } elseif(in_array($ext, $valid_ext)) {
                        //File Path
                        $path = $upload_location.$filename;

                        if(!file_exists($upload_location.$newfile)) {
                            //Upload File
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $upload_location.$newfile)) {
                                $errorArray['eventCategoryImage'][] = $newfile;
                            } else {
                                $errorArray['eventCategoryImageUploadDup'] = "Error: Image already exist.";
                            }
                        }
                   }
             }
        }

        echo json_encode($errorArray);
        die;
    }

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    } else {
        $errors = new Errors();
        $message = new Message();
        $viewAddEventCategory = new Category();
        $addEventCategory = new Category();
        $updEventCategory = new Category();

        if (Helper::is_post()) {
            if((empty($pgEventCategoryId)) && ($pgEventCategoryAction == "add")) {
                $viewAddEventCategory = new Category();
                $viewAddEventCategory->title = trim($_POST['eventCategoryTitle']);
                $viewAddEventCategoryArray = (array) $viewAddEventCategory->where(["title" => $viewAddEventCategory->title])->one();

                if((isset($viewAddEventCategoryArray['id'])) && (!empty($viewAddEventCategoryArray['id']))) {
                    Helper::redirect_to("../../event-category.php?msg=4");
                } else {
                    $addEventCategory->title = trim($_POST['eventCategoryTitle']);
                    $addEventCategory->type_id = trim($_POST['eventType']);
                    $addEventCategory->image_name = trim($_POST['eventCategoryFileHidden']);
                    $addEventCategory->status = (isset($_POST['eventCategoryStatus'])) ? 1 : 1;
                    $addEventCategory->admin_id = $admin->id;

                    $errors = $addEventCategory->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $addEventCategory->save();
                            $has_error_creation = false;
                            Helper::redirect_to("../../event-category.php?msg=1");
                            exit;
                        }
                    }
                }
            } elseif((!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "update")) {
                $viewEditEventCategory = new Category();
                $viewEditEventCategory->title = trim($_POST['eventCategoryTitle']);
                $viewEditEventCategory->id = $pgEventCategoryId;
                $viewEditEventCategoryArray = (array) $viewEditEventCategory->where(["title" => $viewEditEventCategory->name])->not(["id" => $viewEditEventCategory->id])->one();

                if((isset($viewEditEventCategoryArray['id'])) && (!empty($viewEditEventCategoryArray['id']))) {
                    Helper::redirect_to("../../event-category.php?msg=5");
                    exit;
                } else {
                    $updEventCategory->id = $pgEventCategoryId;
                    $updEventCategory->title = trim($_POST['eventCategoryTitle']);
                    $updEventCategory->type_id = trim($_POST['eventType']);
                    $updEventCategory->image_name = trim($_POST['eventCategoryFileHidden']);
                    $updEventCategory->status = (isset($_POST['eventCategoryStatus'])) ? 1 : 1;
                    $updEventCategory->admin_id = $admin->id;
        
                    $errors = $updEventCategory->get_errors();

                    if($errors->is_empty()){
                        if($updEventCategory->where(["id"=>$updEventCategory->id])->andWhere(["admin_id" => $updEventCategory->admin_id])->update()){
                            Helper::redirect_to("../../event-category.php?msg=2");
                            exit;
                        }
                    }
                }           
            }
        }
    }
?>