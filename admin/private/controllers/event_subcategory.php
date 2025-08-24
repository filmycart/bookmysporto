<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $viewEventSubCategory = new Event_SubCategory();
    $viewEventSubCategoryArray = array();

    $delEventSubCatMsg = "";
    $pgEventSubCategoryId = "";
    $pgEventSubCategoryAction = "";
    if((isset($_GET["eventSubCategoryId"])) && (!empty($_GET["eventSubCategoryId"]))) {
        $pgEventSubCategoryId = $_GET['eventSubCategoryId'];
    } elseif((isset($_POST["eventSubCategoryId"])) && (!empty($_POST["eventSubCategoryId"]))) {
        $pgEventSubCategoryId = $_POST['eventSubCategoryId'];
    }

    if((isset($_GET["eventSubCategoryAction"])) && (!empty($_GET["eventSubCategoryAction"]))) {
        $pgEventSubCategoryAction = $_GET['eventSubCategoryAction'];
    } elseif((isset($_POST["eventSubCategoryAction"])) && (!empty($_POST["eventSubCategoryAction"]))) {
        $pgEventSubCategoryAction = $_POST['eventSubCategoryAction'];
    }

    $pgEventSubCatFileName = "";
    if((isset($_POST["eventSubCatFileName"])) && (!empty($_POST["eventSubCatFileName"]))) {
        $pgEventSubCatFileName = $_POST['eventSubCatFileName'];
    }    

    if((Helper::is_get()) && (!empty($pgEventSubCategoryId)) && ($pgEventSubCategoryAction == "view")){
        $viewEventSubCategory->id = $pgEventSubCategoryId;
        $viewEventSubCategoryArray = (array) $viewEventSubCategory->where(["id" => $viewEventSubCategory->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewEventSubCategoryArray);
        exit;
    }elseif((Helper::is_get()) && (!empty($pgEventSubCategoryId)) && ($pgEventSubCategoryAction == "edit")){
        $viewEventSubCategory->id = $pgEventSubCategoryId;
        $viewEventSubCategoryArray = (array) $viewEventSubCategory->where(["id" => $viewEventSubCategory->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewEventSubCategoryArray);
        exit;
    }elseif((Helper::is_get()) && (!empty($pgEventSubCategoryId)) && ($pgEventSubCategoryAction == "delete")){
        $delEventSubCategory = new Event_SubCategory();        
        $delEventSubCategory->id = Helper::get_val('eventSubCategoryId');
        $delEventSubCategory->admin_id = $admin->id;

        if(!empty($delEventSubCategory->id)){
            $delEventSubCategoryDb = new Event_SubCategory();
            $delEventSubCategoryDb = $delEventSubCategoryDb->where(["id" => $delEventSubCategory->id])->one();

            if($delEventSubCategoryDb){
                if($delEventSubCategoryDb->where(["id" => $delEventSubCategoryDb->id])->delete()){
                    $delEventSubCatCatId = new Event_Subcategory_Cat_Id();
                    if($delEventSubCatCatId->where(["sub_cat_id" => $delEventSubCategoryDb->id])->delete()){
                        $delEventSubCategoryMsg = 1;
                    }
                }else $errors->add_error("Error Occurred While Deleting");
            } else {
                $errors->add_error("Invalid Event Sub Category");
            }
        }else  $errors->add_error("Invalid Parameters.");

        Helper::redirect_to("../../event-subcategory.php?msg=3");
        exit;
    }

    if((Helper::is_post()) && ($pgEventSubCategoryAction == "deleteEventImg")) {
        
        $errorArrayDel = array();

        //Upload Location
        $upload_location = "../../uploads/event_subcategory/";

        if(file_exists($upload_location.$pgEventSubCatFileName)) {
            //Delete Uploaded File Delete
            unlink($upload_location.$pgEventSubCatFileName);
        } else {
            $errorArrayDel['noFile'] = "Error: File does not exist.";
        }    

        echo json_encode($errorArrayDel);
        die; 
    }

    if((Helper::is_post()) && ($pgEventSubCategoryAction == "upload")) {
        //Count total files
        $countfiles = count($_FILES['files']['name']);

        //Upload Location
        $upload_location = "../../uploads/event_subcategory/";
        $newfile = "";

        //To store uploaded files path
        $filesArray = $errorArray = array();

        $eventSubCategoryTitle = "";
        if((isset($_POST['eventSubCategoryTitle'])) && (!empty($_POST['eventSubCategoryTitle']))) {
            $eventSubCategoryTitle = strtolower($_POST['eventSubCategoryTitle']);
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
                                $errorArray['eventSubCategoryImage'][] = $newfile;
                            } else {
                                $errorArray['eventSubCategoryImageUploadDup'] = "Error: Image already exist.";
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
        $addEventSubCategory = new Event_SubCategory();
        $updEventSubCategory = new Event_SubCategory();

        if (Helper::is_post()) {
            if((empty($pgEventSubCategoryId)) && ($pgEventSubCategoryAction == "add")) {
                $viewAddEventSubCategory = new Event_SubCategory();
                $viewAddEventSubCategory->title = trim($_POST['eventSubCategoryTitle']);

                $viewAddEventSubCategoryArray = (array) $viewAddEventSubCategory->where(["title" => $viewAddEventSubCategory->title])->one();

                if((isset($viewAddEventSubCategoryArray['id'])) && (!empty($viewAddEventSubCategoryArray['id']))) {
                    Helper::redirect_to("../../event-subcategory.php?msg=4");
                } else {
                    $addEventSubCategory = new Event_SubCategory();
                    $addEventSubCategory->title = trim($_POST['eventSubCategoryTitle']);
                    $addEventSubCategory->price = trim($_POST['eventSubCategoryPrice']);
                    $addEventSubCategory->image_name = trim($_POST['eventSubCategoryFileHidden']);
                    $addEventSubCategory->status = (isset($_POST['eventSubCategoryStatus'])) ? 1 : 1;
                    $addEventSubCategory->category_id = trim($_POST['eventCategoryHidden']);
                    $addEventSubCategory->admin_id = $admin->id;

                    $errors = $addEventSubCategory->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $addEventSubCategory->save();
                            $has_error_creation = false;
                            Helper::redirect_to("../../event-subcategory.php?msg=1");
                            exit;
                        }
                    }
                }
            } elseif((!empty($pgEventSubCategoryId)) && ($pgEventSubCategoryAction == "update")) {
                $viewEditEventSubCategory = new Event_SubCategory();
                $viewEditEventSubCategory->title = trim($_POST['eventSubCategoryTitle']);
                $viewEditEventSubCategory->id = $pgEventSubCategoryId;
                $viewEditEventSubCategoryArray = (array) $viewEditEventSubCategory->where(["title" => $viewEditEventSubCategory->title])->not(["id" => $viewEditEventSubCategory->id])->one();

                if((isset($viewEditEventSubCategoryArray['id'])) && (!empty($viewEditEventSubCategoryArray['id']))) {
                    Helper::redirect_to("../../event-subcategory.php?msg=5");
                    exit;
                } else {
                    $updEventSubCategory->id = $pgEventSubCategoryId;
                    $updEventSubCategory->title = trim($_POST['eventSubCategoryTitle']);
                    $updEventSubCategory->price = trim($_POST['eventSubCategoryPrice']);
                    $updEventSubCategory->category_id = trim($_POST['eventCategoryHidden']);
                    $updEventSubCategory->image_name = trim($_POST['eventSubCategoryFileHidden']);               
                    $updEventSubCategory->status = (isset($_POST['eventSubCategoryStatus'])) ? 1 : 1;
                    $updEventSubCategory->admin_id = $admin->id;

                    $errors = $updEventSubCategory->get_errors();

                    if($errors->is_empty()){
                        if($updEventSubCategory->where(["id"=>$updEventSubCategory->id])->andWhere(["admin_id" => $updEventSubCategory->admin_id])->update()){
                            Helper::redirect_to("../../event-subcategory.php?msg=2");
                            exit;
                        }
                    }
                }              
            }
        }
    }
?>