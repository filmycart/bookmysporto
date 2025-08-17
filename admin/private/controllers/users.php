<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $user = new User();

    $delUserMsg = "";
    $pgUserId = "";
    if((isset($_GET["userId"])) && (!empty($_GET["userId"]))) {
        $pgUserId = $_GET['userId'];
    } elseif((isset($_POST["userId"])) && (!empty($_POST["userId"]))) {
        $pgUserId = $_POST['userId'];
    }

    $pgUserAction = "";
    if((isset($_GET["userAction"])) && (!empty($_GET["userAction"]))) {
        $pgUserAction = $_GET['userAction'];
    } elseif((isset($_POST["userAction"])) && (!empty($_POST["userAction"]))) {
        $pgUserAction = $_POST['userAction'];
    }

    $pgUserFileName = "";
    if((isset($_POST["userFileName"])) && (!empty($_POST["userFileName"]))) {
        $pgUserFileName = $_POST['userFileName'];
    }    

    $viewUserArray = array();
    if((Helper::is_get()) && (!empty($pgUserId)) && ($pgUserAction == "view")) {
        $user = new User();
        $column = "";
        $column .= " user.id AS userId, user.username AS userUserName, user.name AS userName, user.mobile AS userMobile, user.email AS userEmail, user.password AS userPassword, user.image AS userImage, user.type AS userType, user.is_coach AS userIsCoach, user.social_id AS userSocialId, oauth_provider AS userOauthProvider, user.oauth_uid AS userOauthUid, user.verification_token AS userVerificationToken, user.status AS userStatus, user.image_name AS userImageName, user.image_resolution AS userImageResolution, user.admin_id AS userAdminId, user.created AS userCreated, ";
        $column .= "admin.id AS adminId, admin.username AS adminUserName, admin.email AS adminEmail, admin.password AS adminPassword, admin.status AS adminStatus ";
        $joinColumn['join_table_name1'] = "user";
        $joinColumn['join_table_name2'] = "admin";        
        $joinColumn['join_column_name1'] = "admin_id";
        $joinColumn['join_column_city_state_country_id'] = "id";
        $joinColumn['join_column_child'] = "id";

        $viewUserArray = (array) $user->where(["user.id" => $pgUserId])->allWithJoinTwoTables($column, $joinColumn);
        echo json_encode($viewUserArray['0']);
        exit;
    } else if((Helper::is_get()) && (!empty($pgUserId)) && ($pgUserAction == "edit")) {
        $column = "";
        $column .= " user.id AS userId, user.username AS userUserName, user.name AS userName, user.mobile AS userMobile, user.email AS userEmail, user.password AS userPassword, user.image AS userImage, user.type AS userType, user.is_coach AS userIsCoach, user.social_id AS userSocialId, oauth_provider AS userOauthProvider, user.oauth_uid AS userOauthUid, user.verification_token AS userVerificationToken, user.status AS userStatus, user.image_name AS userImageName, user.image_resolution AS userImageResolution, user.admin_id AS userAdminId, user.created AS userCreated, ";
        $column .= "admin.id AS adminId, admin.username AS adminUserName, admin.email AS adminEmail, admin.password AS adminPassword, admin.status AS adminStatus ";
        $joinColumn['join_table_name1'] = "user";
        $joinColumn['join_table_name2'] = "admin";        
        $joinColumn['join_column_name1'] = "admin_id";
        $joinColumn['join_column_city_state_country_id'] = "id";
        $joinColumn['join_column_child'] = "id";

        $viewUserArray = (array) $user->where(["user.id" => $pgUserId])->allWithJoinTwoTables($column, $joinColumn);
        echo json_encode($viewUserArray['0']);
        exit;
    }

    if((Helper::is_post()) && ($pgUserAction == "deleteImg")) {        
        $errorArrayDel = array();
        //Upload Location
        $upload_location = "../../uploads/users/";

        if(file_exists($upload_location.$pgUserFileName)) {
            //Delete Uploaded File Delete
            unlink($upload_location.$pgUserFileName);
        } else {
            $errorArrayDel['noFile'] = "Error: File does not exist.";
        }    

        echo json_encode($errorArrayDel);
        die; 
    }

    if((Helper::is_post()) && ($pgUserAction == "upload")) {
        //Count total files
        $countfiles = count($_FILES['files']['name']);

        //Upload Location
        $upload_location = "../../uploads/users/";
        $newfile = "";

        //To store uploaded files path
        $filesArray = $errorArray = array();

        $userName = "";
        if((isset($_POST['userName'])) && (!empty($_POST['userName']))) {
            $userName = strtolower($_POST['userName']);
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
                        $errorArray['userImageInvalid'] = "Error: Invalid file format upload only files with format png, jpeg ,jpg.";
                        echo json_encode($errorArray);
                        die;
                   } elseif(in_array($ext, $valid_ext)) {
                        //File Path
                        $path = $upload_location.$filename;

                        if(!file_exists($upload_location.$newfile)) {
                            //Upload File
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $upload_location.$newfile)) {
                                $errorArray['userImage'][] = $newfile;
                            } else {
                                $errorArray['userImageUploadDup'] = "Error: Image already exist.";
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
        $user = new User();

        if (Helper::is_post()) {
            if((empty($pgUserId)) && ($pgUserAction == "add")) {           
                if(Helper::post_val("userType") == NUMBER_USER) {
                    if(isset($_POST["userName"]) && isset($_POST["userMobile"]) && isset($_POST["userType"])) {
                        $user->mobile = Helper::post_val("userMobile");
                        $user->username = Helper::post_val("userMobile");
                        $user->name = Helper::post_val("userName");
                        $user->type = Helper::post_val("userType");
                        $user->image = Helper::post_val("userImageHidden");
                        $user->is_coach = Helper::post_val("isCoach");

                        $user->validate_with(["mobile", "username"]);
                        $errors = $user->get_errors();
                        if($errors->is_empty()){
                            $viewUser = new User();
                            $viewUser->mobile = trim($_POST['userMobile']);
                            $viewUserArray = (array) $viewUser->where(["mobile" => $viewUser->mobile])->one();

                            if((isset($viewUserArray['id'])) && (!empty($viewUserArray['id']))) {
                                Helper::redirect_to("../../users.php?msg=4");
                            } else {
                                $user->id = $user->save();
                                if(!empty($user->id)) {
                                    Helper::redirect_to("../../users.php?msg=1");
                                    exit;
                                }
                            }
                        }
                    }    
                }

                if(!$message->is_empty()){
                    Session::set_session($message);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/users.php");
                }else if(!$errors->is_empty()){
                    Session::set_session($errors);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/users.php");
                }
            } elseif((!empty($pgUserId)) && ($pgUserAction == "update")) {
                if(Helper::post_val("userType") == NUMBER_USER) {
                    if(isset($_POST["userName"]) && isset($_POST["userMobile"]) && isset($_POST["userType"])) {
                        $updUser = new User();
                        $updUser->id = $pgUserId;
                        $updUser->mobile = Helper::post_val("userMobile");
                        $updUser->username = Helper::post_val("userMobile");
                        $updUser->name = Helper::post_val("userName");
                        $updUser->type = Helper::post_val("userType");
                        $updUser->image = Helper::post_val("userImageHidden");
                        $updUser->is_coach = Helper::post_val("isCoach");

                        $updUser->validate_with(["mobile", "username"]);
                        $errors = $updUser->get_errors();
                        if($errors->is_empty()){
                            $viewUser = new User();
                            $viewUser->mobile = trim($_POST['userMobile']);
                            $viewUserArray = (array) $viewUser->where(["mobile" => $viewUser->mobile])->not(["id" => $pgUserId])->one();

                            if((isset($viewUserArray['id'])) && (!empty($viewUserArray['id']))) {
                                Helper::redirect_to("../../users.php?msg=4");
                            } else {
                                if($updUser->where(["id"=>$updUser->id])->update()){
                                    Helper::redirect_to("../../users.php?msg=2");
                                    exit;
                                }
                            }
                        }
                    }    
                }
            }
        } elseif((!empty($pgUserId)) && ($pgUserAction == "delete")) {
            $user->id = $pgUserId;
            if(!empty($user->id)) {
                $user_from_db = new User();
                $user_from_db = $user_from_db->where(["id" => $user->id])->one();

                if($user_from_db) {
                    $image = $user_from_db->image_name;
                    if($user->where(["id" => $user->id])->delete()) {
                        $delUserMsg = 1;
                        $message->set_message($delUserMsg);
                    }else $errors->add_error("Error Occurred While Deleting");
                } else {
                    $errors->add_error("Invalid Event");
                }
            }else  $errors->add_error("Invalid Parameters.");

            Helper::redirect_to("../../users.php?msg=3");
            exit;
        }
    }
?>