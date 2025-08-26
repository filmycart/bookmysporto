<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $pgUserPermId = "";
    $pgUserPermAction = "";

    if((isset($_GET["userPermissionAction"])) && (!empty($_GET["userPermissionAction"]))) {
        $pgUserPermAction = $_GET['userPermissionAction'];
    } elseif((isset($_POST["userPermissionAction"])) && (!empty($_POST["userPermissionAction"]))) {
        $pgUserPermAction = $_POST['userPermissionAction'];
    }

    if((isset($_GET["userPermissionId"])) && (!empty($_GET["userPermissionId"]))) {
        $pgUserPermId = $_GET['userPermissionId'];
    } elseif((isset($_POST["userPermissionId"])) && (!empty($_POST["userPermissionId"]))) {
        $pgUserPermId = $_POST['userPermissionId'];
    }

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    }else{
        $errors = new Errors();
        $message = new Message();
        $adminUsePermission = new Admin_User_Permission();

        $viewAdminUserPermArray = array();
        if((Helper::is_get()) && (!empty($pgUserPermId)) && (($pgUserPermAction == "view") || ($pgUserPermAction == "edit"))) {
            $viewAdminUserPermArray = (array) $adminUsePermission->where(['id' => $pgUserPermId])->one();
            echo json_encode($viewAdminUserPermArray);
            exit;
        }

        if (Helper::is_post()) {
            if((empty($pgUserPermId)) && ($pgUserPermAction == "add")) {
                $viewAdminUserPermission = new Admin_User_Permission();
                
                $viewAdminUserPermission->name = trim($_POST['userPermissionName']);
                $viewviewAdminUserPermissionArray = (array) $viewAdminUserPermission->where(["name" => $viewAdminUserPermission->name])->one();

                if((isset($viewviewAdminUserPermissionArray['id'])) && (!empty($viewviewAdminUserPermissionArray['id']))) {
                    Helper::redirect_to("../../admin-user-permission.php?msg=4");
                } else {
                    $adminUsePermission->name = trim($_POST['userPermissionName']);
                    $adminUsePermission->status = $_POST['userPermissionStatus'];   
                    $adminUsePermission->admin_id = $admin->id;     
                 
                    $errors = $adminUsePermission->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $adminUsePermission->save();
                            $has_error_creation = false;

                            Helper::redirect_to("../../admin-user-permission.php?msg=1");
                            exit;
                        }
                    }
                }

                if(!$message->is_empty()){
                    Session::set_session($message);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-permission.php");
                }else if(!$errors->is_empty()){
                    Session::set_session($errors);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-permission.php");
                }
            } elseif((!empty($pgUserPermId)) && ($pgUserPermAction == "update")) {
                $viewAdminUserPermission = new Admin_User_Permission();
                $viewAdminUserPermission->name = trim($_POST['userPermissionName']);
                $viewAdminUserPermission->id = $pgUserPermId;
                $viewAdminUserPermissionArray = (array) $viewAdminUserPermission->where(["name" => $viewAdminUserPermission->name])->not(["id" => $pgUserPermId])->one();

                if((isset($viewAdminUserPermissionArray['id'])) && (!empty($viewAdminUserPermissionArray['id']))) {
                    Helper::redirect_to("../../admin-user-permission.php?msg=5");
                    exit;
                } else {
                    $adminUsePermission->id = $pgUserPermId;
                    $adminUsePermission->name = trim($_POST['userPermissionName']);
                    $adminUsePermission->status = $_POST['userPermissionStatus'];   
                    $adminUsePermission->admin_id = $admin->id;   

                    $errors = $adminUsePermission->get_errors();

                    if($errors->is_empty()){
                        if($adminUsePermission->where(["id"=>$pgUserPermId])->andWhere(["admin_id" => $adminUsePermission->admin_id])->update()) {
                            Helper::redirect_to("../../admin-user-permission.php?msg=2");
                            exit;
                        }
                    }
                }
            }

            if(!$message->is_empty()){
                Session::set_session($message);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-permission.php");
            }else if(!$errors->is_empty()){
                Session::set_session($errors);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-permission.php");
            }            
        } elseif((!empty($pgUserPermId)) && ($pgUserPermAction == "delete")) {
            $delAdminUserPermission = new Admin_User_Permission();
            $delAdminUserPermission->id = $pgUserPermId;
            $delAdminUserPermission->admin_id = $admin->id;

            if(!empty($delAdminUserPermission->id)) {
                $admin_user_permission_from_db = new Event();
                $admin_user_permission_from_db = $delAdminUserPermission->where(["id" => $pgUserPermId])->one();

                if($admin_user_permission_from_db) {
                    if($delAdminUserPermission->where(["id" => $delAdminUserPermission->id])->delete()) {
                        $delAdminUserPermissionMsg = 1;
                        $message->set_message($delAdminUserPermissionMsg);
                    }else $errors->add_error("Error Occurred While Deleting");
                } else {
                    $errors->add_error("Invalid User Permission");
                }
            }else  $errors->add_error("Invalid Parameters.");

            Helper::redirect_to("../../admin-user-permission.php?msg=3");
            exit;
        }
    }
?>