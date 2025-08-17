<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $adminUser = new Admin();

    $delAuMsg = "";
    $pgAuId = "";
    $pgAuAction = "";
    if((isset($_GET["aUsrId"])) && (!empty($_GET["aUsrId"]))) {
        $pgAuId = $_GET['aUsrId'];
    } elseif((isset($_POST["adminUserId"])) && (!empty($_POST["adminUserId"]))) {
        $pgAuId = $_POST['adminUserId'];
    }

    if((isset($_GET["aUsrAction"])) && (!empty($_GET["aUsrAction"]))) {
        $pgAuAction = $_GET['aUsrAction'];
    } elseif((isset($_POST["adminAction"])) && (!empty($_POST["adminAction"]))) {
        $pgAuAction = $_POST['adminAction'];
    }

    $pgAUsrFileName = "";
    if((isset($_POST["aUsrFileName"])) && (!empty($_POST["aUsrFileName"]))) {
        $pgAUsrFileName = $_POST['aUsrFileName'];
    }    

    $viewAdminUserArray = array();
    if((Helper::is_get()) && (!empty($pgAuId)) && ($pgAuAction == "view")) {
        $viewAdminUserArray = (array) $adminUser->where(["id" => $pgAuId])->one();
        echo json_encode($viewAdminUserArray);
        exit;
    } else if((Helper::is_get()) && (!empty($pgAuId)) && ($pgAuAction == "edit")) {
        $viewAdminUserArray = (array) $adminUser->where(["id" => $pgAuId])->one();
        echo json_encode($viewAdminUserArray);
        exit;
    }

    if((Helper::is_post()) && ($pgAuAction == "deleteEventImg")) {
        
        $errorArrayDel = array();

        //Upload Location
        $upload_location = "../../uploads/admin_user/";

        if(file_exists($upload_location.$pgEventFileName)) {
            //Delete Uploaded File Delete
            unlink($upload_location.$pgEventFileName);
        } else {
            $errorArrayDel['noFile'] = "Error: File does not exist.";
        }    

        echo json_encode($errorArrayDel);
        die; 
    }

    if((Helper::is_post()) && ($pgAuAction == "upload")) {
        //Count total files
        $countfiles = count($_FILES['files']['name']);

        //Upload Location
        $upload_location = "../../uploads/admin_user/";
        $newfile = "";

        //To store uploaded files path
        $filesArray = $errorArray = array();

        $eventTitle = "";
        if((isset($_POST['eventTitle'])) && (!empty($_POST['eventTitle']))) {
            $eventTitle = strtolower($_POST['eventTitle']);
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
                                $errorArray['eventImage'][] = $newfile;
                            } else {
                                $errorArray['eventImageUploadDup'] = "Error: Image already exist.";
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
    }else{
        $errors = new Errors();
        $message = new Message();
        $adminUser = new Admin();

        if (Helper::is_post()) {
            if((empty($pgAuId)) && ($pgAuAction == "add")) {
                $viewAdminUser = new Admin();
                $viewAdminUser->username = trim($_POST['adminUserName']);
                $viewAdminUserArray = (array) $viewAdminUser->where(["username" => $viewAdminUser->username])->one();

                if((isset($viewAdminUserArray['id'])) && (!empty($viewAdminUserArray['id']))) {
                    Helper::redirect_to("../../admin-users.php?msg=4");
                } else {
                    $adminUser->username = trim($_POST['adminUserName']);
                    $adminUser->email = trim($_POST['adminUserEmail']);                    
                    //$adminUser->password = trim($_POST['adminUserPassword']);
                    //$adminUser->image_name = $_POST['eventFileHidden'];
                  
                    $errors = $adminUser->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $adminUser->save();
                            $has_error_creation = false;

                            Helper::redirect_to("../../admin-users.php?msg=1");
                            exit;
                        }
                    }
                }

                if(!$message->is_empty()){
                    Session::set_session($message);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-users.php");
                }else if(!$errors->is_empty()){
                    Session::set_session($errors);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-users.php");
                }
            } elseif((!empty($pgAuId)) && ($pgAuAction == "update")) {
                $viewAdminUser = new Admin();

                $viewAdminUser->id = $pgAuId;
                $viewAdminUser->username = trim($_POST['adminUserName']);
                $viewAdminUserArray = (array) $viewAdminUser->where(["username" => $viewAdminUser->username])->not(["id" => $pgAuId])->one();

                if((isset($viewAdminUserArray['id'])) && (!empty($viewAdminUserArray['id']))) {
                    Helper::redirect_to("../../admin-users.php?msg=5");
                    exit;
                } else {
                    $adminUser->id = $pgAuId;
                    $adminUser->username = trim($_POST['adminUserName']);
                    $adminUser->email = trim($_POST['adminUserEmail']);
                    //$adminUser->password = trim($_POST['adminUserPassword']);
                    //$adminUser->image_name = $_POST['eventFileHidden'];

                    $errors = $adminUser->get_errors();

                    if($errors->is_empty()){
                        if($adminUser->where(["id"=>$pgAuId])->update()){
                            Helper::redirect_to("../../admin-users.php?msg=2");
                            exit;
                        }
                    }
                }
            }
        } elseif((!empty($pgAuId)) && ($pgAuAction == "delete")) {
            $adminUser->id = $pgAuId;

            if(!empty($adminUser->id)) {
                $admin_usr_from_db = new Admin();
                $admin_usr_from_db = $adminUser->where(["id" => $pgAuId])->one();

                if($admin_usr_from_db) {
                    //$image = $admin_usr_from_db->image_name;
                    if($adminUser->where(["id" => $pgAuId])->delete()) {
                        $delAdminUsrMsg = 1;
                        $message->set_message($delAdminUsrMsg);
                    }else $errors->add_error("Error Occurred While Deleting");
                } else {
                    $errors->add_error("Invalid Event");
                }
            }else  $errors->add_error("Invalid Parameters.");

            Helper::redirect_to("../../admin-users.php?msg=3");
            exit;
        }
    }
?>